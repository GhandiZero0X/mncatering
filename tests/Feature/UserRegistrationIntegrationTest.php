<?php
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Tests\TestCase;
use App\Http\Controllers\UserController;
use App\Models\User;

class UserRegistrationIntegrationTest extends TestCase
{
    public function test_user_registration_success()
    {
        $userData = [
            'nama_user' => 'John Doe',
            'nohp' => '123456789',
            'email' => 'john.doe@example.com',
            'password' => 'password123',
            'alamat' => '123 Street, City',
        ];

        $request = new Request($userData);

        $controller = new UserController();
        $response = $controller->store($request);

        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertTrue(session()->has('success'));
        $this->assertEquals('Data Berhasil Disimpan', session()->get('success'));
    }

    public function test_user_registration_duplicate_email()
    {
        $existingUser = User::factory()->create(['email' => 'existing.email@example.com']);

        $userData = [
            'nama_user' => 'Jane Doe',
            'nohp' => '987654321',
            'email' => 'existing.email@example.com',
            'password' => 'password123',
            'alamat' => '456 Street, City',
        ];

        $request = new Request($userData);

        $controller = new UserController();
        $response = $controller->store($request);

        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertTrue(session()->has('success'));
    }

    public function test_user_registration_invalid_input()
    {
        $userData = [
            'nama_user' => 'John Doe',
            'nohp' => '123456789',
            'email' => 'invalid.email',
            'password' => 'password123',
            'alamat' => '123 Street, City',
        ];

        $request = new Request($userData);

        $controller = new UserController();
        $response = $controller->store($request);

        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertTrue(session()->has('success'));
        $this->assertFalse(session()->get('error'));
    }

    public function test_user_registration_empty_address()
    {
        $userData = [
            'nama_user' => 'John Doe',
            'nohp' => '123456789',
            'email' => 'john.doe@example.com',
            'password' => 'password123',
            'alamat' => '',
        ];

        $request = new Request($userData);

        $controller = new UserController();
        $response = $controller->store($request);

        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertTrue(session()->has('success'));
    }

    public function test_user_registration_weak_password()
    {
        $userData = [
            'nama_user' => 'John Doe',
            'nohp' => '123456789',
            'email' => 'john.doe@example.com',
            'password' => '123',
            'alamat' => '123 Street, City',
        ];

        $request = new Request($userData);

        $controller = new UserController();
        $response = $controller->store($request);

        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertTrue(session()->has('success'));
    }
}