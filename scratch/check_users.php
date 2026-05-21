<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "Active connection: " . DB::connection()->getName() . "\n";
    echo "Database: " . DB::connection()->getDatabaseName() . "\n";
    
    // Check tables
    $tables = DB::select('SHOW TABLES');
    echo "Tables in database:\n";
    foreach ($tables as $table) {
        $tableArray = (array)$table;
        echo "- " . reset($tableArray) . "\n";
    }
    
    // List all users
    $users = User::all();
    echo "\nTotal users: " . $users->count() . "\n";
    foreach ($users as $user) {
        echo sprintf(
            "ID: %d | Name: %s | Email: %s | Is Admin: %d | Is Suspended: %d | Password length: %d\n",
            $user->id,
            $user->name,
            $user->email,
            $user->is_admin,
            $user->is_suspended,
            strlen($user->password)
        );
        
        // Test verifying admin password
        if ($user->email === 'admin@sessitrading.com') {
            $passwordsToTest = [
                'AdminSecurePassword2026!',
                'AdminSecurePassword2026'
            ];
            foreach ($passwordsToTest as $password) {
                $check = Hash::check($password, $user->password);
                echo sprintf("  Testing password '%s': %s\n", $password, $check ? 'VALID' : 'INVALID');
            }
        }
    }
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n" . $e->getTraceAsString() . "\n";
}
