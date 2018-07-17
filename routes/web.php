<?php

Auth::routes();
Lang::setLocale('en');
Route::get('/home', 'HomeController@index')->name('home');

Route::match(['get', 'post'], 'register', function() {
  return redirect('/');
});

// Sitemap
Route::group(['prefix' => 'sitemap', 'middleware' => ['web']], function() {
  Route::get('/sitemap', 'SitemapController@index')->name('sitemap.index');
  Route::get('/sitemap-home', 'SitemapController@home')->name('sitemap.home');
  Route::get('/sitemap_berita', 'SitemapController@berita')->name('sitemap.berita');
  Route::get('/sitemap_produk', 'SitemapController@produk')->name('sitemap.produk');
  Route::get('/sitemap_menu', 'SitemapController@menu')->name('sitemap.menu');
});

// Homepage
Route::group(['prefix' => '', 'middleware' => ['web','activity']], function () {
  // LOGIN //
  Route::get('/login', 'AuthController@showLoginForm')->name('login');
  Route::post('/login', 'AuthController@login')->name('post.login');

  // VEFIFICATION //
  Route::get('/verification/{email}/{verifyToken}', 'AuthController@verification')->name('verifikasi');
  Route::put('/verification/{email}/{verifyToken}', 'AuthController@save')->name('save');

  // Berita
  Route::get('/', 'HomepageController@home')->name('homepage');
  Route::get('/beranda/berita/{slug}', 'HomepageController@v_berita')->name('berita.detail');
  Route::get('/beranda/berita/kategori/{kategori}', 'HomepageController@kategori_berita')->name('berita.kategori');

  // Menu Navigation
  Route::get('/beranda/profil/rbc', 'HomepageController@rbc_profil')->name('profil.rbc');
  Route::get('/beranda/profil/pedado', 'HomepageController@pedado_profil')->name('profil.pedado');
  Route::get('/beranda/programs/rumah-jamur', 'HomepageController@pr_rmh_jmr')->name('program.rmh');
  Route::get('/beranda/programs/hydropolik', 'HomepageController@pr_hydropolik')->name('program.hydro');
  Route::get('/beranda/programs/pendidikan', 'HomepageController@pr_pendidikan')->name('program.pendidikan');
  Route::get('/beranda/ukm/katur', 'HomepageController@ukm_katur')->name('ukm.katur');
  Route::get('/beranda/ukm/kar', 'HomepageController@ukm_kar')->name('ukm.kar');
  Route::get('/beranda/ukm/lampu-hias', 'HomepageController@ukm_lampu')->name('ukm.lampu');

  // Produk
  Route::get('/beranda/produk', 'HomepageController@listproduk')->name('produk.list');
  Route::get('/beranda/produk/{slug}', 'HomepageController@slugproduk')->name('produk.detail');
  Route::get('/beranda/produk/kategori/{kategori}', 'HomepageController@kategori_produk')->name('produk.kategori.home');
  Route::post('/beranda/produk/{slug}/komen', 'HomepageController@komen_produk')->name('produk.komen');

  // Pesan
  Route::get('/beranda/pesan', 'CartController@pesan')->name('cart.pesan');
  Route::post('/beranda/pesan', 'CartController@postPesan')->name('cart.pesan.post');

  // Cart
  Route::resource('/beranda/cart','CartController')->except(['create','show','edit']);
  Route::delete('emptyCart','CartController@emptyCart')->name('cart.clear');

  // Extension
  Route::get('/beranda/gallery', 'HomepageController@gallery')->name('home.gallery');
  Route::get('/beranda/gallery/album/{album_id}','HomepageController@foto')->name('home.gallery.photo');
  Route::get('/beranda/maps', 'HomepageController@maps')->name('home.maps');
  Route::get('/beranda/kontak/kami', 'KontakController@create')->name('home.kontak.create');
  Route::post('/beranda/kontak/kami', 'KontakController@store')->name('home.kontak.store');

  // Pembayaran
  Route::get('/beranda/upload/bukti-pembayaran/{email}/{kode_order}','HomepageController@upload_bukti')->name('upload.bukti');
  Route::post('/beranda/upload/bukti-pembayaran/{email}/{kode_order}', 'HomepageController@post_upload')->name('post.upload');

  Route::get('/files/invoice/{token}/{kode_order}/download','DownloadController@download')->name('detail.invoice');
  Route::get('/verifikasi/terima-barang/{email}/{kode_order}/{kode_unik}/','HomepageController@terima_brg')->name('terima.barang');
  Route::post('/penilaian/pemesanan/produk/{kode_order}','HomepageController@penilaian')->name('penilaian');

  // Errors
  Route::get('/404', function() {
    return view('frontend.errors.404');
  })->name('404');
});

// Super Administrator
Route::group(['prefix' => 'dashboard/administrator', 'middleware' => ['auth','role:superadmin','activity']], function () {
  Route::get('/', 'DashboardController@admin')->name('dashboard.admin');
  Route::get('/password', 'DashboardController@showPasswordForm')->name('admin.password.form');
  Route::put('/password', 'DashboardController@postPassword')->name('admin.password.post');
  Route::get('/gallery', 'DashboardController@gallery')->name('admin.gallery');
  Route::get('/files', 'DashboardController@files')->name('admin.files');

  // Berita
  Route::resource('/berita', 'BeritaController');
  Route::patch('/berita/update/poststatus/publish/{berita_id}','BeritaController@updateAdmin');

  // Produk
  Route::resource('/produk', 'ProdukController');

  // Komentar
  Route::resource('/produk/daftar/komentar', 'CommentController');

  // Kontak
  Route::resource('/kontak','KontakController')->only(['index','show','destroy']);
  
  // Order Request
  Route::resource('/order', 'OrderController')->except(['create','store','edit','update']);
  Route::patch('/order/pembayaran/{kode_order}', 'OrderController@upPembayaran')->name('order.pembayaran');
  Route::patch('/order/pengiriman/{kode_order}', 'OrderController@upPengiriman')->name('order.pengiriman');
  Route::get('/order/pengiriman/form/{kode_order}', 'OrderController@upForm')->name('order.pengiriman.form');
  Route::put('/order/pengiriman/form/{kode_order}', 'OrderController@postForm')->name('order.pengiriman.post');

  // Bank
  Route::resource('/bank', 'BankController')->except(['create','show']);

  // Konfirmasi
  Route::get('/konfirmasi-pembayaran','DashboardController@index_konfir')->name('konfirmasi.index');
  Route::get('/konfirmasi-pembayaran/{id}/foto','DashboardController@show_konfir')->name('konfirmasi.show');
  Route::patch('/konfirmasi-pembayaran/{kode_order}', 'DashboardController@upPembayaran')->name('konfirmasi.pembayaran');

  // Manajemen User
  Route::resource('/pengguna', 'UserController');

  // Manajemen Web
  Route::resource('/konfig-web', 'WebsiteController');

  // Kategori Berita
  Route::group(['prefix' => '/berita'], function () {
    Route::get('/kategori/home', 'KategoriController@katber_index')->name('berita.kategori.index');
    Route::post('/kategori/store', 'KategoriController@katber_store')->name('berita.kategori.store');
    Route::get('/kategori/{id}/edit', 'KategoriController@katber_edit')->name('berita.kategori.edit');
    Route::put('/kategori/{id}/update', 'KategoriController@katber_update')->name('berita.kategori.update');
    Route::delete('kategori/{id}/delete', 'KategoriController@katber_destroy')->name('berita.kategori.delete');
  });

  // Kategori Produk
  Route::group(['prefix' => '/produk'], function () {
    Route::get('/kategori/home', 'KategoriController@katpro_index')->name('produk.kategori');
    Route::post('/kategori/store', 'KategoriController@katpro_store')->name('produk.kategori.store');
    Route::get('/kategori/{id}/edit', 'KategoriController@katpro_edit')->name('produk.kategori.edit');
    Route::put('/kategori/{id}/update', 'KategoriController@katpro_update')->name('produk.kategori.update');
    Route::delete('/kategori/{id}/delete', 'KategoriController@katpro_destroy')->name('produk.kategori.delete');
  });

  // Penjualan
  Route::resource('/penjualan','PenjualanController');
  Route::get('/penjualan/download/{kode_unik}/{kode_transaksi}', 'DownloadController@download')->name('penjualan.download');

  Route::resource('/albums','AlbumController');
  Route::get('/albums/{album_id}/tambah/foto','PhotoController@create')->name('photos.create');
  Route::post('/albums/{album_id}/tambah/foto/simpan','PhotoController@store')->name('photos.store');
  Route::delete('/albums/{album_id}/hapus/foto/{photo_id}','PhotoController@destroy')->name('photos.destroy');

});

// Editor
Route::group(['prefix' => 'dashboard/editor', 'middleware' => ['auth','role:admin','activity']], function () {
  Route::get('/', 'DashboardController@editor')->name('dashboard.editor');
  Route::get('/password', 'DashboardController@showPasswordForm')->name('editor.password.form');
  Route::post('/password', 'DashboardController@postPassword')->name('editor.password.post');
  Route::resource('/berita-editor','BeritaController');
});
