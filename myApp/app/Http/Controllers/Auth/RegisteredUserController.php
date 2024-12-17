<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    private function generateUniqueRandCode()
    {
        do {
            $randCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT); // Tạo mã ngẫu nhiên 6 chữ số
        } while (DB::table('users')->where('rand_code_user', $randCode)->exists());

        return $randCode;
    }
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone_number' => ['required', 'string', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:houseRenter,viewer'], // Validate role

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'rand_code_user' => $this->generateUniqueRandCode(),
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole($request->role);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('welcome', absolute: false));
    }
}
