<?php

use App\Models\User;

it('can login', function () {
    $credentials = [
        'email' => 'test@example.com',
        'password' => 'password',
    ];

    $response = $this->postJson(route('api.auth.login.post'), $credentials);
    $response->assertStatus(200);
    $response->assertJsonStructure(['token']);
    $this->assertAuthenticatedAs(User::first());
})->group('auth');


it('wrong passwrod no login', function () {
    $credentials = [
        'email' => 'test@example.com',
        'password' => 'wrong_password',
    ];

    $response = $this->postJson(route('api.auth.login.post'), $credentials);
    $response->assertStatus(401);
});
