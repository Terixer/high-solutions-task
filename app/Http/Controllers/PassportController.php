<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAuthRequest;
use App\Http\Requests\RegisterAuthRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PassportController extends Controller
{

    /**
     * Create user
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function register(RegisterAuthRequest $request)
    {
        $request->validated();

        $user = User::create([
            'email' => $request->email,
            'password' =>  Hash::make($request->password)
        ]);

        $data = [
            'access_token' => $user->createToken(config('app.key'))->accessToken
        ];

        return response()->json($data, 200);
    }

    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginAuthRequest $request)
    {
        $request->validated();

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages(
                [
                    'email' => 'Incorrect email or password.',
                    'password' => 'Incorrect email or password.'
                ]
            );
        }

        $user = $request->user();
        $tokenResult = $user->createToken(config('app.key'));
        $token = $tokenResult->token;

        $token->save();

        $data = [
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ];

        return response()->json($data, 200);
    }
}
