<?php


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Transaksi;
use App\Http\Controllers\TransaksiController;
use Illuminate\Http\Request;
use App\Models\User;

class TransaksiIntegrasiTest extends TestCase
{
    public function testIndex()
    {

        // Membuat data pengguna baru
        $user = User::factory()->create();

        // Membuat data transaksi terkait dengan pengguna
        $transaksi = Transaksi::factory()->create([
            'id_pelanggan' => $user->id,
        ]);


        $response = $this->actingAs($user)->withoutMiddleware()->get('/transaksi');


        $response->assertStatus(200);

        // Memeriksa bahwa view yang dihasilkan adalah 'admin.transaksi.list'
        $response->assertViewIs('admin.transaksi.list');

        // Memeriksa bahwa data transaksi dilewatkan ke view
        $response->assertViewHas('data_transaksi', function ($data) use ($transaksi) {
            return $data->contains($transaksi);
        });
    }

    public function testIndexNoidUser()
    {

        // Membuat data pengguna baru
        $user = User::factory()->create();

        // Membuat data transaksi terkait dengan pengguna
        $transaksi = Transaksi::factory()->create([
            'id_pelanggan' => '',
        ]);


        $response = $this->actingAs($user)->withoutMiddleware()->get('/transaksi');


        $response->assertStatus(200);

        // Memeriksa bahwa view yang dihasilkan adalah 'admin.transaksi.list'
        $response->assertViewIs('admin.transaksi.list');

        // Memeriksa bahwa data transaksi dilewatkan ke view
        $response->assertViewHas('data_transaksi', function ($data) use ($transaksi) {
            return $data->contains($transaksi);
        });
    }

    public function testDetail()
    {
        // Membuat data pengguna
        $user = User::factory()->create();

        // Membuat data transaksi terkait dengan pengguna
        $transaksi = Transaksi::factory()->create(['id_pelanggan' => $user->id]);

        // Menjalankan HTTP request ke endpoint /transaksi/{no_transaksi}
        $response = $this->actingAs($user)->withoutMiddleware()->get('/transaksi/detail/' . $transaksi->no_transaksi);

        // Memeriksa bahwa respons memiliki status kode 200 (OK)
        $response->assertStatus(200);

        // Memeriksa bahwa view yang dihasilkan adalah 'admin.transaksi.detail'
        $response->assertViewIs('admin.transaksi.detail');
    }

    public function testCetak()
    {
        // Membuat data pengguna
        $user = User::factory()->create();

        // Membuat data transaksi terkait dengan pengguna
        $transaksi = Transaksi::factory()->create(['id_pelanggan' => $user->id]);

        // Menjalankan HTTP request ke endpoint /transaksi/cetak/{no_transaksi}
        $response = $this->actingAs($user)->withoutMiddleware()
            ->get('/transaksi/cetak/' . $transaksi->no_transaksi);

        // Memeriksa bahwa respons memiliki status kode 200 (OK)
        $response->assertStatus(200);

        // Memeriksa bahwa view yang dihasilkan adalah 'admin.transaksi.cetak'
        $response->assertViewIs('admin.transaksi.cetak');
    }
}