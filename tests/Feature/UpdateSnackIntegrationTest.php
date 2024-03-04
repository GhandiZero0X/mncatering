<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Snack;

class UpdateSnackIntegrationTest extends TestCase
{
    public function testUpdateSnackWithoutChangingImage()
    {
        // Arrange
        $snack = Snack::factory()->create();
        $data = [
            'nama_snack' => 'New Name',
            'harga' => 10.5,
            'deskripsi' => 'New Description',
        ];

        // Act
        $response = $this->post("/snack/update/{$snack->id}", $data);

        // Assert
        $response->assertRedirect('/snack');
        $this->assertDatabaseHas('tbl_snack', $data);
    }

    public function testUpdateSnackWithChangingImage()
    {
        // Arrange
        Storage::fake('public');
        $snack = Snack::factory()->create();
        $image = UploadedFile::fake()->image('new_image.jpg');
        $data = [
            'nama_snack' => 'New Name',
            'harga' => 10.5,
            'deskripsi' => 'New Description',
            'gambar' => $image,
        ];

        // Act
        $response = $this->post("/snack/update/{$snack->id}", $data);

        // Assert
        $response->assertRedirect('/snack');
        $this->assertDatabaseHas('tbl_snack', ['gambar' => $image->hashName()]);
        Storage::disk('public')->assertExists($image->hashName());
    }

    public function testUpdateSnackWithEmptyName()
    {
        // Arrange
        $snack = Snack::factory()->create();
        $data = ['nama_snack' => '', 'harga' => 10.5, 'deskripsi' => 'New Description'];

        // Act
        $response = $this->post("/snack/update/{$snack->id}", $data);

        // Assert
        $response->assertSessionHasErrors(['nama_snack']);
    }

    public function testUpdateSnackWithNegativePrice()
    {
        // Arrange
        $snack = Snack::factory()->create();
        $data = ['nama_snack' => 'New Name', 'harga' => -5, 'deskripsi' => 'New Description'];

        // Act
        $response = $this->post("/snack/update/{$snack->id}", $data);

        // Assert
        $response->assertSessionHasErrors(['harga']);
    }

    public function testUpdateSnackWithEmptyDescription()
    {
        // Arrange
        $snack = Snack::factory()->create();
        $data = ['nama_snack' => 'New Name', 'harga' => 10.5, 'deskripsi' => ''];

        // Act
        $response = $this->post("/snack/update/{$snack->id}", $data);

        // Assert
        $response->assertSessionHasErrors(['deskripsi']);
    }

    public function testUpdateSnackWithInvalidImageFormat()
    {
        // Arrange
        $snack = Snack::factory()->create();
        $data = [
            'nama_snack' => 'New Name',
            'harga' => 10.5,
            'deskripsi' => 'New Description',
            'gambar' => UploadedFile::fake()->create('invalid_file.txt'),
        ];

        // Act
        $response = $this->post("/snack/update/{$snack->id}", $data);

        // Assert
        $response->assertSessionHasErrors(['gambar']);
    }
}