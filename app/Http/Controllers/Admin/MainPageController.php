<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Statistic;
use App\Models\Setting;

class MainPageController extends Controller
{
    /**
     * Показать список всех пользователей приложения.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $default_setting = Setting::join('sites', 'site_id', 'sites.id')->where(['user_id' => Auth::user()->id, 'default'=>true])->first();

      
      $content = [
        'user' => Auth::user(),
        'default_setting' => $default_setting,
        'statistics' => Statistic::select([
          "referer_host",
          "sites.url as url",
          "users.name as name",
          "statistics.user_agent as user_agent",
          "statistics.session_id as session_id",
          "statistics.created_at as ca",
          "statistics.datetime_end as ce",
        ])
          ->leftJoin('sites', 'sites.id', 'statistics.site_id')
          ->leftJoin('users', 'users.id', 'statistics.user_id')
          ->where('user_id', Auth::user()->id)->get(),
      ];
      return view('home', $content);
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
