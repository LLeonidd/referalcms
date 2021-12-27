<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AccountPageController extends Controller
{
    public function main()
    {
      $account = User::select(['id','name', 'email as login'])->where('id', Auth::user()->id)->get();


      $content = [
        'account' => $account[0],
      ];
      return view( 'account', $content);
    }
}
