<?php

namespace App\Http\Controllers\Admin\Inputs;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Phone;
use App\Rules\UniqueField;

class PhoneController extends Controller
{
  public function store(Request $request)
  {

    $validated = $request->validate([
        'phone_number' => ['required', 'max:20', new UniqueField(new Phone, 'number')],
        'phone_message' => ['nullable', 'max:200'],
    ]);

      $phone = new Phone;

      $phone->number = $request->phone_number;
      $phone->message = $request->phone_message;
      $phone->user_id = Auth::user()->id;

      $phone->save();

      return response()->json(['success'=>'Телефон успешно добавлен']);

    }


    public function update(Request $request)
    {

      $validated = $request->validate([
          'id'=>['required', 'max:50'],
          'phone_edit_number' => ['required', 'max:20', new UniqueField(new Phone, 'number')],
          'phone_edit_message' => ['nullable', 'max:200'],
      ]);

      $phone = new Phone;
      Phone::where([
            'id' => $request->id,
            'user_id' => Auth::user()->id,
            ])
            ->update([
                'number' => $request->phone_edit_number,
                'message' => $request->phone_edit_message,
              ]);

      return response()->json(['success'=>'Телефон успешно обновлен']);
    }

    public function delete(Request $request)
    {

      $validated = $request->validate([
          'id'=>['required', 'max:50'],
      ]);

      $phone = new Phone;
      Phone::where([
            'id' => $request->id,
            'user_id' => Auth::user()->id,
            ])
            ->delete();

      return response()->json(['success'=>'Телефон успешно удален']);
    }



}
