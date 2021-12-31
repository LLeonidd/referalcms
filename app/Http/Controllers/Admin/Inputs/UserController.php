<?php

namespace App\Http\Controllers\Admin\Inputs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Rules\UniqueField;

class UserController extends Controller
{
  public function update(Request $request)
  {

    $validated = $request->validate([
         'name_user' => ['required', 'max:20',],
         'email_user' => ['required', 'max:50', 'email:rfc',
            //new UniqueField(new User, 'email'),
          ],
    ]);

        User::where(['id' => $request->id,])
              ->update([
                  'name' => $request->name_user,
                  'email' => $request->email_user,
                ]);

      return response()->json(['success'=>'Данные пользователя обновлены успешно']);

    }
}
