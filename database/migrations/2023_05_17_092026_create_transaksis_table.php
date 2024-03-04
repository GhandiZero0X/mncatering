<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaksi');
            $table->integer('id_pelanggan');
            $table->date('tgl_pesan')->nullable();
            $table->string('waktu_acara', 10)->nullable();
            $table->text('catatan')->nullable();
            $table->bigInteger('total_harga')->nullable();
            $table->date('tgl_bayar')->nullable();
            $table->enum('status', ['Belum DP', 'Belum Lunas', 'Lunas', 'Tolak'])->nullable();
            $table->string('bukti_dp')->nullable();
            $table->string('bukti_lunas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_transaksi');
    }
};
