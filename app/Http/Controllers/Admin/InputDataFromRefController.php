<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Site;
use App\Models\Setting;
use App\Models\Statistic;
use App\Http\Resources\ReferalResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InputDataFromRefController extends Controller
{
    public function main()
    {
      return view('inputpoint');
    }


    private static function _if_exist($array, $key){
      /*
      Returns if the array key exists
      */
      if (array_key_exists($key, $array)){
        return (string)$array[$key];
      } else {
        return null;
      }
    }


    public function refdata_store(Request $request)
    {
      $validatedData = $request->validate([
          '_ref' => ['required', 'max:10'],
          '_headers.Host' => ['required', 'max:300'],
          '_headers.User-Agent' => ['nullable','max:1000'],
          '_headers.referer' => ['nullable','max:1000'],
      ]);

      $user_id = (int)$validatedData['_ref'];
      $site_url = (string)$validatedData['_headers']['Host'];
      $referer_host = $this->_if_exist($validatedData['_headers'], 'referer');
      $user_agent = $this->_if_exist($validatedData['_headers'], 'User-Agent');


      if (User::pluck('id')->containsStrict($user_id)){ //Check if user in db safety
        $statistic_id = Statistic::create([
          'referer_host' => $referer_host,
          'user_agent' => $user_agent,
          'user_id' => User::select('id')->find($user_id)->id,
          'site_id' => Site::select('id')->where('url',$site_url)->limit(1)->value('id'),
        ]);
      }


      $res = Setting::select([
                'phones.number as number',
                'phones.message as message',
                'addresses.address',
                'emails.email as email',
                'sites.rules as rules',
                ]
              )
              ->join('sites', 'settings.site_id', '=','sites.id')
              ->leftJoin('phones', 'settings.phone_id', '=', 'phones.id')
              ->leftJoin('addresses', 'settings.address_id', '=', 'addresses.id')
              ->leftJoin('emails', 'settings.email_id', '=', 'emails.id')
              ->where('settings.user_id',$user_id)
              ->where('sites.url', $site_url)->limit(1)->get();

      return [
        'setting' => ReferalResource::collection($res),
        'statistic_id' => $statistic_id->id,
      ];
    }
}
