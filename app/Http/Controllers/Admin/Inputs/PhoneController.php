<?php

namespace App\Http\Controllers\Admin\Inputs;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Phone;
use App\Models\Setting;
use App\Models\Site;
use App\Rules\UniqueField;
use Illuminate\Support\Facades\DB;

class PhoneController extends Controller
{
  public function store(Request $request)
  {

    $validated = $request->validate([
        'phone_number' => ['required', 'max:20', new UniqueField(new Phone, 'number')],
        'phone_message' => ['nullable', 'max:200'],
    ]);

    try {
        DB::beginTransaction();

        $phone = new Phone;
        $phone->number = $request->phone_number;
        $phone->message = $request->phone_message;
        $phone->user_id = Auth::user()->id;
        $phone->save();

         // DB::table('users')
         //     ->updateOrInsert(
         //         ['email' => 'john@example.com', 'name' => 'John'],
         //         ['votes' => '2']
         //     );

        $setting = Setting::join('sites', 'site_id', 'sites.id')->where(['user_id'=>Auth::user()->id, 'default'=>true]);
        if ($setting->count()==0){
          // Создаем дефолтную настройку
          $new_setting = new Setting;
          $new_setting->enabled = true;
          $new_setting->name = 'Default Setting';
          $new_setting->user_id = Auth::user()->id;
          $new_setting->site_id = Site::where('default', true)->value('id');
          $new_setting->phone_id = $phone->id;
          $new_setting->save();
        }
        else if ($setting->count()==1){
          // Дополняем дефолтную настройку, если для нее не заполнены данные по телефону
          if ($setting->value('phone_id') == null){
             $setting->update(['phone_id'=>$phone->id]);
          }
        }

        DB::commit();

    } catch( \Exaption $exaption ){
      DB::rollBack();
      return $exaption;
    }





      return response()->json(['success'=>'Телефон успешно добавлен']);

    }


    public function update(Request $request)
    {

      $validated = $request->validate([
          'id'=>['required', 'max:50'],
          'phone_edit_number' => ['required', 'max:20', new UniqueField(new Phone, 'number')],
          'phone_edit_message' => ['nullable', 'max:200'],
      ]);

      $phone = new Phone;
      Phone::where([
            'id' => $request->id,
            'user_id' => Auth::user()->id,
            ])
            ->update([
                'number' => $request->phone_edit_number,
                'message' => $request->phone_edit_message,
              ]);

      return response()->json(['success'=>'Телефон успешно обновлен']);
    }

    public function delete(Request $request)
    {

      $validated = $request->validate([
          'id'=>['required', 'max:50'],
      ]);

      $phone = new Phone;
      Phone::where([
            'id' => $request->id,
            'user_id' => Auth::user()->id,
            ])
            ->delete();

      return response()->json(['success'=>'Телефон успешно удален']);
    }



}
