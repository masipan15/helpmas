<?php

namespace App\Http\Controllers;

use App\Models\Societies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class SocietiesController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_card' => 'required',
            'password' => 'required',
            'gender' => 'required',
            'born_date' => 'required',
            'regional_id' => 'required',
            'name' => 'required',
            'addres' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 422);
        }
        $data = Societies::create([
            'id_card' => $request->id_card,
            'gender' => $request->gender,
            'regional_id' => $request->regional_id,
            'addres' => $request->addres,
            'born_date' => $request->born_date,
            'name' => $request->name,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'id_card' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 422);
        }

        $societies = Societies::firstWhere('id_card', $request->id_card);
        $regional = Societies::with('regional')->firstWhere('id_card', $request->id_card);

        if (!$societies || !Hash::check($request->password, $societies->password)) {
            return response()->json([
                'error' => ['error' => 'Bad Credentials'],
            ], 401);
        }
        $token = $societies->createToken('Token')->plainTextToken;

        return response()->json([
            'id' => $societies->id,
            'name' => $societies->name,
            'born_date' => $societies->born_date,
            'gender' => $societies->gender,
            'addres' => $societies->addres,
            'token' => $token,
            'regional' => $societies->regional
        ], 200);
    }

    public function logout(Request $request)
    {
        $a = $request->token;
        if ($token = PersonalAccessToken::findToken($a)) {
            $token->delete();
            return response()->json([
                'Message' => 'Logout Successfully'
            ], 200);
        } else {
            return response()->json([
                'Message' => 'Invalid Token'
            ], 401);
        }
    }
}
