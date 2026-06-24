<?php

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'username' => 'testuser',
        'phone' => '0599999999',
        'address' => 'Nablus',
        'role' => 'client',

        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);
$response->assertSessionHasNoErrors();

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});