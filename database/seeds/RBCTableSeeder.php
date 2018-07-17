<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\KategoriProduk;
use App\Models\KategoriBerita;
use App\Models\Berita;
use App\Models\Produk;
use App\Models\Bank;
use App\Models\Website;

class RBCTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $description = '<p style="text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque orci iaculis accumsan rutrum. Integer ac est ac nibh condimentum egestas nec non neque. Donec sagittis nulla eget libero varius, eget mattis nisi iaculis. In dolor lorem, porttitor non ante sit amet, elementum faucibus tortor. Cras quis lobortis ligula. Integer ac arcu id arcu lacinia lacinia. Pellentesque eleifend, lacus non laoreet cursus, dolor purus molestie dolor, sit amet tempor quam tortor sit amet metus. Curabitur nunc eros, placerat rutrum blandit in, consequat et lorem. Curabitur lorem risus, dapibus vitae justo sit amet, feugiat gravida erat. Integer ac elit mi. Curabitur felis mauris, malesuada eget tempus maximus, volutpat sed sem. Aliquam viverra vel leo sit amet varius. Maecenas blandit, leo in condimentum semper, nunc massa scelerisque arcu, consequat lacinia arcu tortor vitae orci. Integer aliquam ex nec semper consequat.</p>
<p style="text-align: justify;">Sed tempus ex lectus, sed dictum orci maximus sit amet. Etiam at velit lectus. Nam ornare, odio at auctor mattis, orci orci tincidunt tellus, a interdum nunc orci sed ante. Suspendisse mi urna, malesuada at auctor a, ornare sit amet dui. Donec porttitor sed elit at auctor. Suspendisse nunc diam, congue vitae pharetra eget, hendrerit non ipsum. Sed in enim lorem.</p>
<p style="text-align: justify;">Vivamus nisl sem, facilisis nec est in, fermentum dictum lectus. Sed vitae nulla ex. Vivamus ligula sapien, semper et mauris et, blandit dapibus elit. Morbi eleifend, diam vitae blandit scelerisque, metus ligula dignissim sapien, eu commodo erat urna et metus. Suspendisse porttitor ex dui, et pellentesque lacus egestas vitae. Donec congue hendrerit commodo. Fusce et pulvinar nunc.</p>
<p style="text-align: justify;">Quisque vel vehicula ipsum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin turpis lorem, elementum ac molestie sit amet, finibus eu ipsum. Vestibulum malesuada, lorem et consectetur viverra, orci purus finibus est, sit amet finibus diam erat et magna. Nullam vitae sem aliquam, efficitur ex quis, tincidunt nulla. Pellentesque ac pretium quam. Donec maximus ligula vitae rutrum suscipit. Nulla scelerisque mauris sed lectus elementum, at efficitur urna vehicula. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec urna et metus maximus volutpat.</p>
<p style="text-align: justify;">Vestibulum sollicitudin nec risus ut sollicitudin. Etiam bibendum semper nulla, id vestibulum felis tempus et. Donec volutpat ac tortor quis lacinia. Nunc porta nulla nec nisi porta, scelerisque ultrices magna pellentesque. Mauris faucibus sollicitudin diam, ut luctus nulla tincidunt ut. Praesent blandit metus nec ante dapibus efficitur. Vestibulum sed rhoncus mi, a aliquet libero. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae</p>';

      $superadminRole = new Role();
      $superadminRole->name = "superadmin";
      $superadminRole->display_name = "Super Administrator";
      $superadminRole->description = "Only Super Administrator";
      $superadminRole->save();

      $adminRole = new Role();
      $adminRole->name = "admin";
      $adminRole->display_name = "Administrator";
      $adminRole->description = "Only Administrator";
      $adminRole->save();

      $superadmin = new User();
      $superadmin->name = 'Super Administrator';
      $superadmin->email = 'admin@kampungpedado.com';
      $superadmin->password = bcrypt('superadmin');
      $superadmin->status = "Activated";
      $superadmin->save();
      $superadmin->attachRole($superadminRole);

      $admin = new User();
      $admin->name = 'Administrator';
      $admin->email = 'editor@kampungpedado.com';
      $admin->password = bcrypt('admin123');
      $admin->status = "Activated";
      $admin->save();
      $admin->attachRole($adminRole);
      /*
      $kategori = [
        [
          'nama_kategori_produk' => 'testing'
        ],
        [
          'nama_kategori_produk' => 'debug'
        ],
        [
          'nama_kategori_produk' => 'release'
        ],
        [
          'nama_kategori_produk' => 'produk testing'
        ],
      ];

      $kat_berita = [
        [
          'nama_kategori_berita' => 'testing'
        ],
        [
          'nama_kategori_berita' => 'debug'
        ],
        [
          'nama_kategori_berita' => 'release'
        ],
        [
          'nama_kategori_berita' => 'berita testing'
        ],
      ];

      $bank = [
        [
          'nama_bank' => 'BANK CENTRAL ASIA (BCA)',
          'no_rek' => '123456790',
          'atas_nama' => 'Kampung Pedado',
        ],
        [
          'nama_bank' => 'BANK NEGARA INDONESIA (BNI)',
          'no_rek' => '123456790',
          'atas_nama' => 'Kampung Pedado',
        ],
        [
          'nama_bank' => 'BANK MANDIRI',
          'no_rek' => '123456790',
          'atas_nama' => 'Kampung Pedado',
        ],
        [
          'nama_bank' => 'BANK RAKYAT INDONESIA (BRI)',
          'no_rek' => '123456790',
          'atas_nama' => 'Kampung Pedado',
        ],
      ];
      */
      $kat_web = ['rbc','pedado','rumah-jamur','hydropolik','pendidikan','katur-lihab','kar-flanet','lampu-hias'];
      $i = 0;
      $web = [
        [
          'nama_web' => 'Profil RBC',
          'kategori_website' => $kat_web[$i++],
          'description' => $description
        ],
        [
          'nama_web' => 'Profil Pedado',
          'kategori_website' => $kat_web[$i++],
          'description' => $description
        ],
        [
          'nama_web' => 'Rumah Jamur',
          'kategori_website' => $kat_web[$i++],
          'description' => $description
        ],
        [
          'nama_web' => 'Hydropolik',
          'kategori_website' => $kat_web[$i++],
          'description' => $description
        ],
        [
          'nama_web' => 'Pendidikan',
          'kategori_website' => $kat_web[$i++],
          'description' => $description
        ],
        [
          'nama_web' => 'Katur Lihab',
          'kategori_website' => $kat_web[$i++],
          'description' => $description
        ],
        [
          'nama_web' => 'Kar Flanet',
          'kategori_website' => $kat_web[$i++],
          'description' => $description
        ],
        [
          'nama_web' => 'Lampu Hias',
          'kategori_website' => $kat_web[$i++],
          'description' => $description
        ],
      ];
      /*
      foreach ($kategori as $key => $value) {
        KategoriProduk::create($value);
      }

      foreach ($kat_berita as $key => $value) {
        KategoriBerita::create($value);
      }

      foreach ($bank as $key => $value) {
        Bank::create($value);
      }
      */
      foreach ($web as $key => $value) {
        Website::create($value);
      }
      /*
      for ($i=1; $i <= 24; $i++) {
        Berita::create([
          'user_id' => rand(1,2),
          'kategori_berita_id' => rand(1,4),
          'title' => 'Judul Berita Ke-'.$i,
          'slug' => str_slug('Judul Berita Ke '.$i,'-'),
          'post_status' => 'Publikasi',
          'headline' => 'Tidak',
          'images' => '/photos/no-images.jpg',
          'description' => $description
        ]);
      }

      for ($i=1; $i <= 24; $i++) {
        Produk::create([
          'kategori_produk_id' => rand(1,4),
          'title' => 'Produk '.$i,
          'slug' => str_slug('produk '.$i,'-'),
          'harga' => rand(10000,99999),
          'stock' => rand(10,99),
          'images' => '/photos/no-images.jpg',
          'description' => $description
        ]);
      }
      */
    }
}
