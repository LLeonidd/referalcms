<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;

class SettingsPageController extends Controller
{
  public function main()
  {
    $settings = Setting::select([
                    'settings.id as id',
                    'settings.name as settings_name',
                    'sites.url as sites_url',
                    'phones.number',
                    'emails.email',
                    'addresses.address'
                  ])
                  -> join('users', 'user_id', 'users.id')
                  -> join('emails', 'email_id', 'emails.id')
                  -> join('phones', 'phone_id', 'phones.id')
                  -> join('addresses', 'address_id', 'addresses.id')
                  -> join('sites', 'site_id', 'sites.id')
                  -> where('settings.user_id', Auth::user()->id)
                  -> get();
    $content = [
      'settings' => $settings,
      'settings_count' =>$settings->count(),
      'user_id' => Auth::user()->id,
    ];
    return view('settings', $content);
  }
}
