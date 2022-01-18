<?php

namespace App\Http\Controllers\Admin\Inputs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Email;
use App\Models\Setting;
use App\Models\Site;
use App\Rules\UniqueField;

class EmailController extends Controller
{
  public function store(Request $request)
  {

    $validated = $request->validate([
        'email_address' => ['required', 'max:50', 'email:rfc',new UniqueField(new Email, 'email'),],
    ]);

       try {
           DB::beginTransaction();
           $email = new Email;
           $email->email = $request->email_address;
           $email->user_id = Auth::user()->id;
           $email->save();
           $setting = Setting::join('sites', 'site_id', 'sites.id')->where(['user_id'=>Auth::user()->id, 'default'=>true]);
           if ($setting->count()==0){
             // Создаем дефолтную настройку
             $new_setting = new Setting;
             $new_setting->enabled = true;
             $new_setting->name = 'Default Setting';
             $new_setting->user_id = Auth::user()->id;
             $new_setting->site_id = Site::where('default', true)->value('id');
             $new_setting->email_id = $email->id;
             $new_setting->save();
           }
           else if ($setting->count()==1){
             // Дополняем дефолтную настройку, если для нее не заполнены данные по телефону
             if ($setting->value('email_id') == null){
                $setting->update(['email_id'=>$email->id]);
             }
           }
           DB::commit();
       } catch( \Exaption $exaption ){
         DB::rollBack();
         return $exaption;
       }
      return response()->json(['success'=>'Email успешно добавлен']);
    }


    public function update(Request $request)
    {
      $validated = $request->validate([
          'id'=>['required', 'max:10'],
          'email_address' => ['max:50', 'nullable'],
      ]);
      Email::where([ 'id' => $request->id, 'user_id' => Auth::user()->id,])->update(['email' => $request->email_address,]);
      return response()->json(['success'=>'Email успешно обновлен']);
    }


    public function delete(Request $request)
    {
      $validated = $request->validate(['id'=>['required', 'max:50'],]);
      Email::where(['id' => $request->id, 'user_id' => Auth::user()->id,])->delete();
      return response()->json(['success'=>'Email успешно удален']);
    }
}
