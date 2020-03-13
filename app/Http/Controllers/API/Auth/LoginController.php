<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Login the user through the API
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validation = $this->validator($request->all());

        if ($validation->fails()) {
            return response()->json([
                'status' => 400,
                'msg' => 'error',
                'data' => $validation->errors()
            ], 400);
        }

        if (Auth::attempt(
                [
                    'phone' => $request->phone,
                    'password' => $request->password
                ],
                true
            )
        ) {

            $user   = Auth::user();
            $token  = $user->createToken('authToken');

            $data['token'] = [
                'accessToken' => $token->accessToken,
                'expiresAt' => strtotime($token->token->expires_at)
            ];

            return response()->json([
                'status' => 200,
                'msg' => 'success',
                'data' => $data
            ]);

        } else {
            return abort(401);
        }
    }

    /**
     * Logout the authenticated user
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'status' => 200,
            'msg' => 'Logged out successfully',
            'data' => ''
        ]);
    }

    /**
     * Get the logged in user data
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function user(Request $request)
    {
        return new UserResource($request->user());
    }

    /**
     * Validate the given data
     *
     * @param  array $data
     * @return \Illuminate\Support\Facades\Validator
     */
    private function validator(array $data)
    {
        return Validator::make($data, [
            'phone'     => 'required|regex:/(01)[0-9]{9}/|exists:users,phone',
            'password'  => 'required|string|min:8',
        ]);
    }
}