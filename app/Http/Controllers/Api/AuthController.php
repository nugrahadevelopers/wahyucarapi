<?php

namespace App\Http\Controllers\Api;

use App\User;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $creds = $request->only([
            'email',
            'password'
        ]);

        if (!$token = auth()->attempt($creds)) {
            return response()->json([
                'success' => false,
                'message' => 'invalid credentials'
            ]);
        }

        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => Auth::user()
        ]);
    }

    public function register(Request $request)
    {
        $encryptedPass = Hash::make($request->password);

        $user = new User;
        try {
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = $encryptedPass;
            $user->save();
            return $this->login($request);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
    }

    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::parseToken($request->token));
            return response()->json([
                'success' => true,
                'message' => 'logout success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }

    public function SaveUserInfo(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->phone = $request->phone;
        $user->noktp = $request->noktp;
        $photo = '';

        if ($request->photo != '') {
            $photo = time() . '.jpg';
            file_put_contents('storage/profiles/' . $photo, base64_decode($request->photo));
            $user->photo = $photo;
        }

        $user->update();

        return response()->json([
            'success' => true,
            'photo' => $photo
        ]);
    }

    public function editProfil(Request $request)
    {
        $encryptedPass = Hash::make($request->password);

        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->noktp = $request->noktp;
        $user->password = $encryptedPass;

        $photo = '';

        if ($request->photo != '') {
            $photo = time() . '.jpg';
            file_put_contents('storage/profiles/' . $photo, base64_decode($request->photo));
            $user->photo = $photo;
        }

        $user->update();

        return response()->json([
            'success' => true,
            'user' => Auth::user()
        ]);
    }
}
