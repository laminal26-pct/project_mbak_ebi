<!-- BEGIN NAVIGATION -->
<div class="header-navigation pull-right font-transform-inherit">
  <ul>
    <li class="<?php echo e(set_active('homepage')); ?> <?php echo e(set_active('berita.detail')); ?> <?php echo e(set_active('berita.kategori')); ?>"><a href="<?php echo e(route('homepage')); ?>">Beranda</a></li>
    <li class="dropdown <?php echo e(set_active('profil.rbc')); ?> <?php echo e(set_active('profil.pedado')); ?>">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-target="#">Profil</a>
      <ul class="dropdown-menu">
        <li class="<?php echo e(set_active('profil.rbc')); ?>"><a href="<?php echo e(route('profil.rbc')); ?>">RBC</a></li>
        <li class="<?php echo e(set_active('profil.pedado')); ?>"><a href="<?php echo e(route('profil.pedado')); ?>">PEDADO</a></li>
      </ul>
    </li>
    <li class="dropdown <?php echo e(set_active('program.rmh')); ?> <?php echo e(set_active('program.hydro')); ?> <?php echo e(set_active('program.pendidikan')); ?>">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-target="#">Program RBC</a>
      <ul class="dropdown-menu">
        <li class="<?php echo e(set_active('program.rmh')); ?>"><a href="<?php echo e(route('program.rmh')); ?>">Rumah Jamur</a></li>
        <li class="<?php echo e(set_active('program.hydro')); ?>"><a href="<?php echo e(route('program.hydro')); ?>">Hydropolik</a></li>
        <li class="<?php echo e(set_active('program.pendidikan')); ?>"><a href="<?php echo e(route('program.pendidikan')); ?>">Pendidikan</a></li>
      </ul>
    </li>
    <li class="dropdown <?php echo e(set_active('ukm.katur')); ?><?php echo e(set_active('ukm.kar')); ?><?php echo e(set_active('ukm.lampu')); ?>">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-target="#">UKM</a>
      <ul class="dropdown-menu">
        <li class="<?php echo e(set_active('ukm.katur')); ?>"><a href="<?php echo e(route('ukm.katur')); ?>">Katur Lihab</a></li>
        <li class="<?php echo e(set_active('ukm.kar')); ?>"><a href="<?php echo e(route('ukm.kar')); ?>">Kar Flanet</a></li>
        <li class="<?php echo e(set_active('ukm.lampu')); ?>"><a href="<?php echo e(route('ukm.lampu')); ?>">Lampu Hias</a></li>
      </ul>
    </li>
    <li class="<?php echo e(set_active('produk.list')); ?> <?php echo e(set_active('produk.detail')); ?> <?php echo e(set_active('produk.form')); ?> <?php echo e(set_active('produk.kategori.home')); ?>"><a href="<?php echo e(route('produk.list')); ?>">Produk</a></li>
    <li class="<?php echo e(set_active('home.gallery')); ?> <?php echo e(set_active('home.gallery.photo')); ?>"><a href="<?php echo e(route('home.gallery')); ?>">Galeri</a></li>
    <li class="<?php echo e(set_active('home.maps')); ?>"><a href="<?php echo e(route('home.maps')); ?>">Peta Lokasi</a></li>
    <li class="<?php echo e(set_active('cart.index')); ?>"><a href="<?php echo e(route('cart.index')); ?>"><i class="fa fa-shopping-cart"></i>&nbsp;(<?php echo e(Cart::instance('default')->count(false)); ?>)</a></li>
  </ul>
</div>
<!-- END NAVIGATION -->
