<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Snack;

class ModelSnackTest extends TestCase
{

    // UT.2 - Test Case 1: Menyimpan Snack dengan Data Valid
    public function testSaveSnackWithValidData()
    {
        $snackData = [
            'nama_snack' => 'Choco Bar',
            'harga' => 10,
            'deskripsi' => 'Snack lezat dengan cokelat',
            'gambar' => 'choco_bar.jpg',
        ];

        $snack = Snack::create($snackData);

        $this->assertDatabaseHas('tbl_snack', $snackData);
    }

    // UT.2 - Test Case 2: Menyimpan Snack dengan Harga 0
    public function testSaveSnackWithZeroPrice()
    {
        $snackData = [
            'nama_snack' => 'potato',
            'harga' => 0,
            'deskripsi' => 'gratis',
            'gambar' => 'zero_price_snack.jpg',
        ];

        $snack = Snack::create($snackData);

        $this->assertDatabaseHas('tbl_snack', $snackData);
    }

    // UT.2 - Test Case 3: Menyimpan Snack tanpa Nama
    public function testSaveSnackWithoutName()
    {
        $snackData = [
            'harga' => 5.99,
            'deskripsi' => 'Snack tanpa nama',
            'gambar' => 'no_name_snack.jpg',
        ];

        $snack = Snack::create($snackData);

        $this->assertDatabaseMissing('tbl_snack', $snackData);
    }

    // UT.2 - Test Case 4: Menyimpan Snack dengan Deskripsi Panjang
    public function testSaveSnackWithLongDescription()
    {
        $snackData = [
            'nama_snack' => 'Long Description Snack',
            'harga' => 8.99,
            'deskripsi' => str_repeat('A', 500),
            'gambar' => 'long_description_snack.jpg',
        ];

        $snack = Snack::create($snackData);

        $this->assertDatabaseMissing('tbl_snack', $snackData);
    }

    // UT.2 - Test Case 5: Menyimpan Snack dengan Gambar Kosong
    public function testSaveSnackWithEmptyImage()
    {
        $snackData = [
            'nama_snack' => 'Empty Image Snack',
            'harga' => 12.99,
            'deskripsi' => 'Snack tanpa gambar',
            'gambar' => '',
        ];

        $snack = Snack::create($snackData);

        $this->assertDatabaseMissing('tbl_snack', $snackData);
    }

    // UT.2 - Test Case 6: Menyimpan Snack dengan Harga Negatif
    public function testSaveSnackWithNegativePrice()
    {
        $snackData = [
            'nama_snack' => 'Negative Price Snack',
            'harga' => -5.99,
            'deskripsi' => 'Snack dengan harga negatif',
            'gambar' => 'negative_price_snack.jpg',
        ];

        $snack = Snack::create($snackData);

        $this->assertDatabaseMissing('tbl_snack', $snackData);
    }

    // UT.2 - Test Case 7: Menyimpan Snack dengan Nama yang Sudah Ada
    public function testSaveSnackWithDuplicateName()
    {
        Snack::create([
            'nama_snack' => 'Duplicate Snack',
            'harga' => 9.99,
            'deskripsi' => 'Snack dengan nama yang sama',
            'gambar' => 'duplicate_snack.jpg',
        ]);

        $duplicateSnackData = [
            'nama_snack' => 'Duplicate Snack',
            'harga' => 15.99,
            'deskripsi' => 'Snack dengan nama yang sama',
            'gambar' => 'updated_duplicate_snack.jpg',
        ];

        $snack = Snack::create($duplicateSnackData);

        $this->assertDatabaseMissing('tbl_snack', $duplicateSnackData);
    }

    // UT.2 - Test Case 8: Menyimpan Snack tanpa Harga
    public function testSaveSnackWithoutPrice()
    {
        $snackData = [
            'nama_snack' => 'coki coki',
            'deskripsi' => 'gratis',
            'gambar' => 'no_price_snack.jpg',
        ];

        $snack = Snack::create($snackData);

        $this->assertDatabaseHas('tbl_snack', $snackData);
    }

    // UT.2 - Test Case 9: Menyimpan Snack dengan Gambar Invalid
    public function testSaveSnackWithInvalidImage()
    {
        $snackData = [
            'nama_snack' => 'Invalid Image Snack',
            'harga' => 11.99,
            'deskripsi' => 'Snack dengan gambar invalid',
            'gambar' => 'invalid_image.txt',
        ];

        $snack = Snack::create($snackData);

        $this->assertDatabaseMissing('tbl_snack', $snackData);
    }

    // UT.2 - Test Case 10: Menyimpan Snack dengan Data Valid dan Deskripsi Singkat
    public function testSaveSnackWithValidDataAndShortDescription()
    {
        $snackData = [
            'nama_snack' => 'indomie',
            'harga' => 7000,
            'deskripsi' => 'pokoknya enak dan sehat',
            'gambar' => 'short_description_snack.jpg',
        ];

        $snack = Snack::create($snackData);

        $this->assertDatabaseHas('tbl_snack', $snackData);
    }
}
