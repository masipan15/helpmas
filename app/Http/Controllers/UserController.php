<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $data = User::create([
            'name' => $request->name,
            'password' => bcrypt($request->password),
        ]);
        return response()->json($data, 200);
    }
}
