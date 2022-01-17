<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Setting;


class AccountPageController extends Controller
{
    public function main()
    {
      $account = User::select(['id','name', 'email as login'])->where('id', Auth::user()->id)->get();
      $default_setting = Setting::join('sites', 'site_id', 'sites.id')->where(['user_id' => Auth::user()->id, 'default'=>true])->first();

      $content = [
        'account' => $account[0],
        'default_setting' => $default_setting,
      ];
      return view( 'account', $content);
    }
}
