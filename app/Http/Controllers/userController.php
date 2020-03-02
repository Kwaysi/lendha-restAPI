<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use Tymon\JWTAuth\Contracts\JWTSubject;

class userController extends Controller
{
    //
    public function index(Request $request)
    {
        $user = User::all();

        return response()->json(['data' => $user, 'msg' => 'success']);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['msg' => 'Invalid Credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['msg' => 'Could not create token'], 500);
        }

        return response()->json(compact('token', 'user'));
    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        if (User::where('email', $request->get('email'))->first()) {

            return response()->json(['msg' => 'Your email already exists'], 401);

        } else {

            $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
            ]);

            $token = JWTAuth::fromUser($user);

            return response()->json(compact('user', 'token'), 201);
        }
    }
}
