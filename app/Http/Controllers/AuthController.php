<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function index()
    {
        return view('Auth.register');
    }

    public function storeRegister(AuthRequest $authRequest)
    {
        DB::beginTransaction();
        try {
            // dd($authRequest->validated());
            $data = $authRequest->validated();
            $data['role'] = 'User';
            User::create($data);
            DB::commit();
            return redirect()->route('login')->with(['message' => 'User Register Successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Something Went Wrong']);
        }
    }
    public function login()
    {
        return view('Auth.login');
    }

    public function storeLogin(AuthRequest $authRequest)
    {
        try {
            if (Auth::attempt(['email' => $authRequest->email, 'password' => $authRequest->password])) {
                if (Auth::user()->role == 'Admin') {
                    session('email', $authRequest->email);
                    return redirect()->route('admin.user');
                } else {
                    return redirect()->route('first.index');
                }
            } else {
                return back()->with(['error' => 'Invalid Login Crediantials']);
            }
        } catch (\Exception $e) {
            return back()->with(['error' => 'Something Went Wrong' . $e->getMessage()]);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with(['message'=>'Logout Successfully']);
    }
}
