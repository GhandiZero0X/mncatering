<?php
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginCekUnitTest extends TestCase
{
    use DatabaseTransactions;

    // Test Case 1: Valid email and password
    public function testValidEmailAndPassword()
    {
        $response = $this->post('/cek_login', [
            'email' => 'hgrphantom01@gmail.com',
            'password' => 'phantomzero021003',
        ]);

        $response->assertStatus(302);
        $this->assertAuthenticated();
        $response->assertRedirect('/homeUser');
    }

     // Test Case 2: Valid email and incorrect password
    public function testValidEmailAndIncorrectPassword()
    {
        $response = $this->post('/cek_login', [
            'email' => 'hgrphantom01@gmail.com',
            'password' => 'phantomzero021024',
        ]);

        $response->assertStatus(302);
        $this->assertGuest();
        $response->assertRedirect('/login');
    }

    // Test Case 3: Incorrect email and valid password
    public function testIncorrectEmailAndValidPassword()
    {
        $response = $this->post('/cek_login', [
            'email' => 'paladintrinity@gmail.com',
            'password' => 'phantomzero021003',
        ]);

        $response->assertStatus(302);
        $this->assertGuest();
        $response->assertRedirect('/login');
    }

    // Test Case 4: Unregistered email and valid password
    public function testUnregisteredEmailAndValidPassword()
    {
        $response = $this->post('/cek_login', [
            'email' => 'rudeboys.phantom01@gmail.com',
            'password' => 'phantomzero021003',
        ]);

        $response->assertStatus(302);
        $this->assertGuest();
        $response->assertRedirect('/login');
    }

    // Test Case 5: Unregistered email and incorrect password
    public function testUnregisteredEmailAndIncorrectPassword()
    {
        $response = $this->post('/cek_login', [
            'email' => 'rudeboys.phantom01@gmail.com',
            'password' => 'phantomzero021024',
        ]);

        $response->assertStatus(302);
        $this->assertGuest();
        $response->assertRedirect('/login');
    }

    // Test Case 6: empty email and correct password
    public function testEmptyEmailAndCorrectPassword()
    {
        $response = $this->post('/cek_login', [
            'email' => '',
            'password' => 'phantomzero021003',
        ]);

        $response->assertStatus(302);
        $this->assertGuest();
        $response->assertRedirect('/login');
    }

    // Test Case 7: Registered email and empty password
    public function testRegisteredEmailAndEmptyPassword()
    {
        $response = $this->post('/cek_login', [
            'email' => 'hgrphantom01@gmail.com',
            'password' => '',
        ]);

        $response->assertStatus(302);
        $this->assertGuest();
        $response->assertRedirect('/login');
    }

    // Test Case 8: Successful login as 'pelanggan'
    public function testSuccessfulLoginAsPelanggan()
    {
        $response = $this->post('/cek_login', [
            'email' => 'hgrphantom01@gmail.com',
            'password' => 'phantomzero021003',
        ]);

        $response->assertStatus(302);
        $this->assertAuthenticated();
        $response->assertRedirect('/homeUser');
    }

    // Test Case 9: Successful login as 'admin'
    public function testSuccessfulLoginAsAdmin()
    {
        $response = $this->post('/cek_login', [
            'email' => 'phantom.zero2022.3@gmail.com',
            'password' => 'phantomzero021003',
        ]);

        $response->assertStatus(302);
        $this->assertAuthenticated();
        $response->assertRedirect('/home');
    }
}
