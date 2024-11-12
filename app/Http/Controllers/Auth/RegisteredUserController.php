<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;
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


public function store(Request $request): RedirectResponse
{
    // dd($request->all());
    try {
        // Validate the request
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
           
        ]);

       // Create user based on user type
       if ($request->user_type === 'user') {
        // Handle user registration
        $user = User::create([
            'name' => $request->name,
            'role' => $request->user_type,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    } elseif ($request->user_type === 'vendor') {
        // Handle vendor registration
        $user = User::create([
            'name' => $request->name,
            'role' => $request->user_type,
            'email' => $request->email,
            'business_name' => $request->business_name, // Assuming you added this field in your form
            'business_type' => $request->business_type,
            'terms_and_conditions' => $request->has('terms'), 
            'password' => Hash::make($request->password),
        ]);
    } else {
        throw new \Exception("Invalid user type.");
    }

    // Trigger event for new registration
    event(new Registered($user));

    // Log the user in
    $url = "";
    if($request->user_type === "admin"){
        $url = "admin/dashboard";
    }elseif($request->user_type === "vendor"){
        $url = "vendor/dashboard";
    }elseif($request->user_type === "user"){
        $url = "user/dashboard";
    }
    else{
        $url = "dashboard";  
    }
    Auth::login($user);
    return redirect()->intended($url);
    // Redirect to home page
    //return redirect(RouteServiceProvider::HOME);

    } catch (ValidationException $e) {
        // If validation fails, return the errors and redirect back to the form
        return back()->withErrors($e->errors())->withInput();
    }
}

}
