<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;

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

    public function debug()
    {
      $users = DB::select('select * from users', [1]);
      // Group::all();
      // dump(Group::where('name','user')->get());
      // print(Group::where('name','user')->first()->id);
      // print(Group::where('name','user')->value('id'));
      // // Получить одну строку по значению столбца id
      // print(Group::where('name','user')->find(2));
      // // output: {"id":2,"name":"user","description":"\u041f\u043e\u043b\u044c\u0437\u043e\u0432\u0430\u0442\u0435\u043b\u044c"}
      //
      // // Получить список значение столбца таблицы
      // print(Group::pluck('name'));
      // //print(DB::table('groups')->pluck('name'));
      // // output ["admin","user"]
      //
      // // ПОЛУЧИТЬ СВЯЗАННУЮ таблицу
      // //dump(User::groups()->all()->get());
      //
      // //dump(User::find(1)->group->value('name'));
      // dump(Group::find(1)->user);

    }
}
