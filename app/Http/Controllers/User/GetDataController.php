<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetDataController extends Controller
{
    /**
     * Показать список всех пользователей приложения.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users = DB::select('select * from users', [1]);
      foreach ($users as $user) {
          //dump($user);
          //print($user->id);
      }
      return view('home', ['users' => $users, 'id'=>$user->id, ]);
    }
}
