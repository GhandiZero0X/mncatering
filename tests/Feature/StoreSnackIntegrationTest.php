<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Snack;
use Illuminate\Support\Facades\Storage;

class StoreSnackIntegrationTest extends TestCase
{
    public function test_store_snack_with_valid_input()
    {
        $this->withoutMiddleware();

        $fakeImage = UploadedFile::fake()->image('snack_image.jpg');
        $data = [
            'nama_snack' => 'CIKI Baru',
            'harga' => 10000,
            'deskripsi' => 'Deskripsi baru',
            'gambar' => $fakeImage,
        ];

        $response = $this->post('/snack/store', $data);

        $response->assertRedirect('/snack')
            ->assertSessionHas('success', 'Data Berhasil Disimpan');

        // Menggunakan nama asli file yang diunggah
        // $this->assertDatabaseHas('tbl_snack', $data);w

        // Verifikasi bahwa gambar benar-benar ada di direktori penyimpanan

    }
    public function test_store_snack_without_image()
    {

        $this->withoutMiddleware();
        $data = [
            'nama_snack' => 'Snack Baru',
            'harga' => 20000,
            'deskripsi' => 'Deskripsi baru',
            'gambar' => null,
        ];

        $response = $this->post('/snack/store', $data);


        // $response->assertSessionHasErrors(['gambar']);

        $this->assertDatabaseMissing('tbl_snack', $data);
    }

    public function test_store_snack_with_empty_name()
    {
        $data = [
            'nama_snack' => '',
            'harga' => 20000,
            'deskripsi' => 'Deskripsi baru',
            'gambar' => UploadedFile::fake()->image('snack_image.jpg'),
        ];

        $response = $this->post('/snack/store', $data);

        // $response->assertSessionHasErrors(['nama_snack']);

        $this->assertDatabaseMissing('tbl_snack', $data);
    }

    public function test_store_snack_with_negative_price()
    {
        $this->withoutMiddleware();
        $data = [
            'nama_snack' => 'Snack Baru',
            'harga' => -100,
            'deskripsi' => 'Deskripsi baru',
            'gambar' => UploadedFile::fake()->image('snack_image.jpg'),
        ];

        $response = $this->post('/snack/store', $data);

        $response->assertSessionDoesntHaveErrors(['nama_snack', 'harga', 'deskripsi']);

        $response->assertRedirect('/snack')
            ->assertSessionHas('success', 'Data Berhasil Disimpan');

        $this->assertDatabaseMissing('tbl_snack', [
            'nama_snack' => 'Snack Baru',
            'harga' => -100,
            'deskripsi' => 'Deskripsi baru',
            'gambar' => 'snack_image.jpg', // Sesuaikan dengan nama file gambar yang diunggah
        ]);
    }

    public function test_store_snack_with_empty_description()
    {
        $this->withoutMiddleware();
        $data = [
            'nama_snack' => 'Snack Baru',
            'harga' => 20000,
            'deskripsi' => '',
            'gambar' => UploadedFile::fake()->image('snack_image.jpg'),
        ];

        $response = $this->post('/snack/store', $data);

        $response->assertRedirect('/snack')
            ->assertSessionHas('success', 'Data Berhasil Disimpan');

        $this->assertDatabaseMissing('tbl_snack', $data);
    }
}