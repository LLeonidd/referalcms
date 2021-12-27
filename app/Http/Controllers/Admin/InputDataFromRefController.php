<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\ReferalResource;

class InputDataFromRefController extends Controller
{
    public function main()
    {
      return view('inputpoint');
    }

    public function refdata_store(Request $request)
    {
      // $validatedData = $request->validate([
      //     'title' => ['required', 'unique:posts', 'max:255'],
      //     'body' => ['required'],
      // ]);
      //return $request;
      //return new ReferalResource(User::first());
      return ReferalResource::collection(User::all());
      //return response()->json(['link' => 'WWWW', 'msg' => 'EEEE']);;
    }
}
