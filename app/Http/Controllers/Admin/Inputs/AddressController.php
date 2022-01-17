<?php

namespace App\Http\Controllers\Admin\Inputs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Address;
use App\Models\Site;
use App\Models\Setting;
use App\Rules\UniqueField;

class AddressController extends Controller
{
  public function store(Request $request)
  {

    $validated = $request->validate([
        'address' => ['required', 'max:300', new UniqueField(new Address, 'address'),],
    ]);

       try {
           DB::beginTransaction();

           $address = new Address;
           $address->address = $request->address;
           $address->user_id = Auth::user()->id;
           $address->save();


           $setting = Setting::join('sites', 'site_id', 'sites.id')->where(['user_id'=>Auth::user()->id, 'default'=>true]);
           if ($setting->count()==0){
             // Создаем дефолтную настройку
             $new_setting = new Setting;
             $new_setting->enabled = true;
             $new_setting->name = 'Default Setting';
             $new_setting->user_id = Auth::user()->id;
             $new_setting->site_id = Site::where('default', true)->value('id');
             $new_setting->address_id = $address->id;
             $new_setting->save();
           }
           else if ($setting->count()==1){
             // Дополняем дефолтную настройку, если для нее не заполнены данные по телефону
             if ($setting->value('address_id') == null){
                $setting->update(['address_id'=>$address->id]);
             }
           }

           DB::commit();

       } catch( \Exaption $exaption ){
         DB::rollBack();
         return $exaption;
       }


      return response()->json(['success'=>'Адрес успешно добавлен']);

    }
}
