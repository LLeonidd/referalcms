<?php

namespace App\Http\Controllers\Admin\Inputs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use App\Rules\UniqueField;

class AddressController extends Controller
{
  public function store(Request $request)
  {

    $validated = $request->validate([
        'address' => ['required', 'max:300', new UniqueField(new Address, 'address'),],
    ]);

       $address = new Address;

       $address->address = $request->address;
       $address->user_id = Auth::user()->id;
       $address->save();

      return response()->json(['success'=>'Адрес успешно добавлен']);

    }
}
