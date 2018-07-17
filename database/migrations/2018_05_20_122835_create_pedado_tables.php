<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedadoTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('websites', function (Blueprint $table) {
          $table->increments('website_id');
          $table->string('nama_web');
          $table->enum('kategori_website', ['rbc','pedado','rumah-jamur','hydropolik','pendidikan','katur-lihab','kar-flanet','lampu-hias',''])->default('');
          $table->text('description');
          $table->timestamps();
        });

        Schema::create('kontaks', function (Blueprint $table) {
            $table->increments('kontak_id');
            $table->string('nama');
            $table->string('email');
            $table->string('telepon');
            $table->text('alamat');
            $table->text('pesan');
            $table->enum('read',['0','1'])->default('0');
            $table->timestamps();
        });

        Schema::create('albums', function (Blueprint $table) {
            $table->increments('album_id');
            $table->string('name');
            $table->text('description');
            $table->string('cover');
            $table->timestamps();
        });

        Schema::create('photos', function (Blueprint $table) {
            $table->increments('photo_id');
            $table->integer('album_id')->unsigned();
            $table->string('image');
            $table->string('description');
            $table->timestamps();

            $table->foreign('album_id')->references('album_id')->on('albums')
                  ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('kategori_beritas', function (Blueprint $table) {
          $table->increments('kategori_berita_id');
          $table->string('nama_kategori_berita');
        });

        Schema::create('beritas', function (Blueprint $table) {
          $table->increments('berita_id');
          $table->integer('user_id')->unsigned();
          $table->integer('kategori_berita_id')->unsigned();
          $table->string('title')->unique();
          $table->text('slug');
          $table->enum('post_status',['Draft','Publikasi'])->default('Draft');
          $table->enum('headline',['Ya','Tidak'])->default('Tidak');
          $table->string('images',255)->default('/photos/no-images.jpg');
          $table->longtext('description');
          $table->timestamps();

          $table->foreign('kategori_berita_id')->references('kategori_berita_id')->on('kategori_beritas')
                ->onUpdate('cascade')->onDelete('cascade');

          $table->foreign('user_id')->references('user_id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

        });

        Schema::create('kategori_produks', function (Blueprint $table) {
          $table->increments('kategori_produk_id');
          $table->string('nama_kategori_produk');
        });

        Schema::create('produks', function (Blueprint $table) {
          $table->increments('produk_id');
          $table->integer('kategori_produk_id')->unsigned();
          $table->string('title')->unique();
          $table->text('slug');
          $table->string('images',255)->default('/photos/no-images.jpg');
          $table->integer('harga');
          $table->integer('stock');
          $table->longtext('description');
          $table->timestamps();

          $table->foreign('kategori_produk_id')->references('kategori_produk_id')->on('kategori_produks')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->increments('comment_id');
            $table->integer('produk_id')->unsigned();
            $table->string('name');
            $table->string('email');
            $table->text('description');
            $table->enum('read',['0','1'])->default('0');
            $table->timestamps();

            $table->foreign('produk_id')->references('produk_id')->on('produks')
                  ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('orders', function (Blueprint $table) {
          $table->increments('order_id');
          $table->string('kode_order')->unique();
          $table->integer('kode_unik');
          $table->integer('total');
          $table->string('nama');
          $table->string('email');
          $table->string('telepon');
          $table->text('alamat');
          $table->enum('status_pembayaran',['Lunas','Belum Lunas'])->default('Belum Lunas');
          $table->enum('status_pengiriman',['Proses','Kemas','Kirim','Sampai'])->default('Proses');
          $table->enum('read',['0','1'])->default('0');
          $table->timestamps();
        });

        Schema::create('produk_orders', function (Blueprint $table) {
          $table->increments('produk_order_id');
          $table->integer('produk_id')->unsigned()->nullable();
          $table->integer('order_id')->unsigned()->nullable();
          $table->integer('jumlah');

          $table->foreign('produk_id')->references('produk_id')->on('produks')
                ->onUpdate('cascade')->onDelete('set null');

          $table->foreign('order_id')->references('order_id')->on('orders')
                ->onUpdate('cascade')->onDelete('set null');
        });

        Schema::create('trackings', function (Blueprint $table) {
          $table->increments('tracking_id');
          $table->integer('order_id')->unsigned()->nullable();
          $table->string('jasa_pengiriman');
          $table->string('no_resi');
          $table->timestamps();

          $table->foreign('order_id')->references('order_id')->on('orders')
                ->onUpdate('cascade')->onDelete('set null');
        });

        Schema::create('ratings', function (Blueprint $table) {
          $table->increments('rating_id');
          $table->integer('order_id')->unsigned();
          $table->integer('nilai');

          $table->foreign('order_id')->references('order_id')->on('orders')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('banks', function (Blueprint $table) {
          $table->increments('bank_id');
          $table->string('nama_bank');
          $table->string('no_rek');
          $table->string('atas_nama');
        });

        Schema::create('konfir_bayar', function (Blueprint $table) {
          $table->increments('bayar_id');
          $table->integer('bank_id')->unsigned();
          $table->integer('order_id')->unsigned();
          $table->string('files');
          $table->enum('read',['0','1'])->default('0');
          $table->timestamps();

          $table->foreign('bank_id')->references('bank_id')->on('banks')
                ->onUpdate('cascade')->onDelete('cascade');
          $table->foreign('order_id')->references('order_id')->on('orders')
                ->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konfir_bayar');
        Schema::dropIfExists('banks');
        Schema::dropIfExists('ratings');
        Schema::dropIfExists('trackings');
        Schema::dropIfExists('produk_orders');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('produks');
        Schema::dropIfExists('kategori_produks');
        Schema::dropIfExists('beritas');
        Schema::dropIfExists('kategori_beritas');
        Schema::dropIfExists('photos');
        Schema::dropIfExists('albums');
        Schema::dropIfExists('kontaks');
        Schema::dropIfExists('websites');
    }
}
