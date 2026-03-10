
<?php
// Auth routes with isLogin middleware
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\Request;

Route::middleware('isLogin')->group(function () {

    Route::get('/register', [AuthController::class, 'index'])->name('register');
    Route::post('/register', [AuthController::class, 'storeRegister'])->name('register.store');

    Route::get('/admin/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login/store', [AuthController::class, 'storeLogin'])->name('login.store');

    Route::get('/auth/google/redirect', function () {
        return Socialite::driver('google')->redirect();
    })->name('google.redirect');

    Route::get('/auth/google/callback', function (Request $request) {
        $userdata = Socialite::driver('google')->user();
        $user = User::updateOrCreate(
            ['google_id' => $userdata->id],
            [
                'full_name' => $userdata->name,
                'email' => $userdata->email,
                'role' => 'User',
                'image' => $userdata->avatar,
            ]
        );
        Auth::login($user);
        return redirect()->route('first.index');
    })->name('google.callback');
});
