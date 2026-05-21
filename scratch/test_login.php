<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Set up a mock request to the login route
$request = Request::create('/login', 'POST', [
    '_token' => 'dummy_token', // usually verified, but in testing or mock we can see
    'email' => 'admin@sessitrading.com',
    'password' => 'AdminSecurePassword2026!',
]);

// Since CSRF might block a direct request run through the kernel, we can use Laravel's request lifecycle
// or use the router directly, or simulate authentication attempt like the controller does.

echo "--- Bootstrapping Application ---\n";
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "--- Verifying Admin User in DB ---\n";
$user = \App\Models\User::where('email', 'admin@sessitrading.com')->first();
if (!$user) {
    echo "ERROR: Admin user not found in DB!\n";
    exit(1);
}

echo "Admin exists:\n";
echo "Name: " . $user->name . "\n";
echo "Email: " . $user->email . "\n";
echo "Is Admin: " . ($user->is_admin ? 'YES' : 'NO') . "\n";
echo "Is Suspended: " . ($user->is_suspended ? 'YES' : 'NO') . "\n";
echo "Email Verified At: " . ($user->email_verified_at ?: 'NULL') . "\n";

echo "\n--- Attempting Login Programmatically ---\n";
$credentials = ['email' => 'admin@sessitrading.com', 'password' => 'AdminSecurePassword2026!'];
$attempt = Auth::attempt($credentials);
echo "Auth::attempt result: " . ($attempt ? 'SUCCESS' : 'FAILED') . "\n";

if ($attempt) {
    $loggedInUser = Auth::user();
    echo "Logged in user: " . $loggedInUser->email . "\n";
    echo "Is Admin: " . ($loggedInUser->is_admin ? 'YES' : 'NO') . "\n";
    
    // Simulate redirection logic in AuthenticatedSessionController
    if ($loggedInUser->is_suspended) {
        echo "Redirect: login (suspended)\n";
    } elseif ($loggedInUser->is_admin) {
        echo "Redirect: route('admin.dashboard') -> " . route('admin.dashboard') . "\n";
    } else {
        echo "Redirect: RouteServiceProvider::HOME -> /dashboard\n";
    }
}
