<?php

/**
 * ONE-TIME account sync — aligns live staff/customer credentials with the
 * preview panel reference data (scripts/seed-staff-logins.mjs + seed.mjs).
 *
 * Security: random filename + random token guard; self-deletes on run
 * so it can never be replayed.
 */

$TOKEN = '7c7de05ed314f2c9d009b68db0148344';

if (! isset($_GET['t']) || ! hash_equals($TOKEN, (string) $_GET['t'])) {
    http_response_code(404);
    exit('Not found');
}

$base = dirname(__DIR__);
require $base.'/vendor/autoload.php';
$app = require $base.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

header('Content-Type: application/json; charset=utf-8');

$accounts = [
    ['username' => 'admin',   'password' => 'admin',    'role' => 'admin',    'full_name' => 'OSSZ Administrator', 'email' => 'admin@osszcollection.com'],
    ['username' => 'manager', 'password' => 'manager',  'role' => 'admin',    'full_name' => 'OSSZ Manager',       'email' => 'manager@osszcollection.com'],
    ['username' => 'staff',   'password' => 'staff',    'role' => 'staff',    'full_name' => 'OSSZ Staff',         'email' => 'staff@osszcollection.com'],
    ['username' => null,      'password' => 'ossz2026', 'role' => 'uploader', 'full_name' => 'Clarisse Mbah',      'email' => 'studio@osszcollections.cm'],
    ['username' => null,      'password' => 'ossz2026', 'role' => 'customer', 'full_name' => 'Sandrine Kouam',     'email' => 'client@example.com'],
];

$out = ['ok' => true, 'accounts' => []];

foreach ($accounts as $a) {
    try {
        $query = App\Models\User::query();
        if ($a['username'] !== null) {
            $user = $query->where('username', $a['username'])->orWhere('email', $a['email'])->first();
        } else {
            $user = $query->where('email', $a['email'])->first();
        }

        $data = [
            'email' => $a['email'],
            'username' => $a['username'],
            'full_name' => $a['full_name'],
            'role' => $a['role'],
            'password_hash' => password_hash($a['password'], PASSWORD_BCRYPT),
        ];

        if ($user) {
            $user->fill($data)->save();
            $out['accounts'][] = ['login' => $a['username'] ?: $a['email'], 'role' => $a['role'], 'action' => 'updated'];
        } else {
            App\Models\User::create($data);
            $out['accounts'][] = ['login' => $a['username'] ?: $a['email'], 'role' => $a['role'], 'action' => 'created'];
        }
    } catch (Throwable $e) {
        $out['ok'] = false;
        $out['accounts'][] = ['login' => $a['username'] ?: $a['email'], 'error' => $e->getMessage()];
    }
}

echo json_encode($out);

// Self-delete so the endpoint cannot be replayed.
@unlink(__FILE__);
