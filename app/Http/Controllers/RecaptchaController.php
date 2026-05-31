<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RecaptchaController extends Controller
{
    public function verify(Request $request)
    {
        // $request->validate([
        //     'token' => 'required',
        // ]);

        // $response = Http::asForm()->post(
        //     'https://www.google.com/recaptcha/api/siteverify',
        //     [
        //         'secret' => config('google_recaptcha.secret_key'),
        //         'response' => $request->token,
        //         'remoteip' => $request->ip(),
        //     ]
        // );

        // $result = $response->json();
        // dd($result);
        // // v3 check
        // $success = $result['success'] ?? false;
        // $score = $result['score'] ?? 0;
        // $action = $result['action'] ?? '';

        // if (!$success || $score < 0.5) {
        //     return response()->json([
        //         'ok' => false,
        //         'message' => 'Bot detected'
        //     ], 403);
        // }

        return response()->json([
            'ok' => true
        ]);
    }
}
