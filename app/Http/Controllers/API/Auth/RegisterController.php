<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Register New User through the API
     *
     * @param  \Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validation = $this->validator($request->all());

        if ($validation->fails()) {
            return response()->json([
                'status' => 400,
                'msg' => 'error',
                'data' => $validation->errors()
            ], 400);
        }

        $user   = $this->create($request->except('payment_verified'));
        $token  = $user->createToken('authToken');

        $data['token'] = [
            'accessToken' => $token->accessToken,
            'expiresAt' => strtotime($token->token->expires_at)
        ];
        $data['user'] = new UserResource($user);

        return response()->json([
            'status'    => 200,
            'msg'       => 'success',
            'data'      => $data
        ], 200);
    }

    /**
     * Validate the given data
     *
     * @param array $data
     * @return \Validator
     */
    private function validator(array $data)
    {
        return Validator::make($data, [
            'name'              => 'required|string|max:50',
            'email'             => 'bail|nullable|email|unique:users|max:50',
            'password'          => 'required|string|min:8',
            'confirm_password'  => 'required|same:password',
            'phone'             => 'required|regex:/(01)[0-9]{9}/|unique:users',
            'level'             => 'required|in:1,2,3,4',
            'group'             => 'required|in:a,b'
        ]);
    }

    /**
     * Create New User
     *
     * @param  array $date
     * @return \App\User
     */
    private function create(array $data)
    {
        return User::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => bcrypt($data['password']),
            'phone'     => $data['phone'],
            'level'     => $data['level'],
            'group'     => $data['group']
        ]);
    }
}