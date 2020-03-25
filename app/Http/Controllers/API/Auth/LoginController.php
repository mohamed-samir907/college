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
                'code' => 2,
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

            $data['user'] = new UserResource($user);

            return response()->json([
                'code' => 0,
                'data' => $data
            ]);

        } else {
            return response()->json([
                'code' => 1,
                'data' => [
                    "error" => ["phone or password not valid"]
                ]
            ], 400);
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
            'code' => 0,
            'data' => [
                "success" => "Logged out successfully"
            ]
            ], 200);
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
