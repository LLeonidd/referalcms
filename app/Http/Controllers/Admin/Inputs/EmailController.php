<?php

namespace App\Http\Controllers\Admin\Inputs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Email;
use App\Rules\UniqueField;

class EmailController extends Controller
{
  public function store(Request $request)
  {

    $validated = $request->validate([
        'email_address' => ['required', 'max:50', 'email:rfc',new UniqueField(new Email, 'email'),],
    ]);

       $email = new Email;

       $email->email = $request->email_address;
       $email->user_id = Auth::user()->id;
       $email->save();

      return response()->json(['success'=>'Email успешно добавлен']);

    }
}
