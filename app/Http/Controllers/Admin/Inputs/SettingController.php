<?php

namespace App\Http\Controllers\Admin\Inputs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;

class SettingController extends Controller
{
  public function store(Request $request)
  {

    $validated = $request->validate([
        'user_id' => ['required', 'max:50'],
        'name_setting' => ['required', 'max:200'],
        'site_id' => ['required', 'max:50'],
        'phone_id' => ['nullable', 'max:50'],
        'email_id' => ['nullable', 'max:50'],
        'address_id' => ['nullable', 'max:50'],
    ]);

       $setting = new Setting;

       $setting->enabled = $request->enabled;
       $setting->user_id = $request->user_id;
       $setting->name = $request->name_setting;
       $setting->site_id = $request->site_id;
       $setting->phone_id = $request->phone_id;
       $setting->email_id = $request->email_id;
       $setting->address_id = $request->address_id;
       $setting->save();

      return response()->json(['success'=>'Реферальная программа успешно добавлена']);

    }


    public function update(Request $request)
    {

      $validated = $request->validate([
          'user_id' => ['required', 'max:50'],
          'name_setting' => ['required', 'max:200'],
          'site_id' => ['required', 'max:50'],
          'phone_id' => ['nullable', 'max:50'],
          'email_id' => ['nullable', 'max:50'],
          'address_id' => ['nullable', 'max:50'],
      ]);

         // $setting = new Setting;
         //
         // $setting->enabled = $request->enabled;
         // $setting->user_id = $request->user_id;
         // $setting->name = $request->name_setting;
         // $setting->site_id = $request->site_id;
         // $setting->phone_id = $request->phone_id;
         // $setting->email_id = $request->email_id;
         // $setting->address_id = $request->address_id;
         // $setting->save();

         Setting::where([ 'id' => $request->id, 'user_id' => Auth::user()->id,])->update([
             'name' => $request->name_setting,
             'site_id' => $request->site_id,
             'phone_id' => $request->phone_id,
             'email_id' => $request->email_id,
             'address_id' => $request->address_id,
         ]);
         return response()->json(['success'=>'Настройки успешно обновлены']);

      }


      public function delete(Request $request)
      {

        $validated = $request->validate([
            'id'=>['required', 'max:50'],
        ]);
        Setting::where([
              'id' => $request->id,
              'user_id' => Auth::user()->id,
              ])
              ->delete();

        return response()->json(['success'=>'Настройка успешно удалена']);
      }

}
