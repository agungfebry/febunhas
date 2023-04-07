<!--/ Section Contact-Footer Star /-->
<section class="paralax-mf footer-paralax bg-image pt-4 route" style="background-image: url(<?php echo base_url(); ?>assets_frontend/img/overlay-bg.jpg)">
  <div class="overlay-mf"></div>
  <footer>
    <div class="container mt-4">
      <div class="row">
        <div class="col-md-6 mb-3 card-deck">
          <div class="card border-0 shadow">
            <div class="card-header bg-white text-muted text-left border-0">
              <span class="text-uppercase font-weight-bold ">KONTAK KAMI</span>
            </div>
            <div class="card-body">
              <table class="table text-left table-borderless text-muted  w-100">
                <tbody>
                  <tr>
                    <td width="30%" style="font-size: 13px; letter-spacing: .5px; font-weight: 700;">ALAMAT</td>
                    <td width="70%" style="font-size: 14px; font-weight: 400;letter-spacing: .5px;"><?= $pengaturan->alamat ?></td>
                  </tr>
                  <tr>
                    <td width="30%" style="font-size: 13px; letter-spacing: .5px; font-weight: 700;">TELEPON</td>
                    <td width="70%" style="font-size: 14px; font-weight: 400;letter-spacing: .5px;"><?= $pengaturan->phone ?></td>
                  </tr>
                  <tr>
                    <td width="30%" style="font-size: 13px; letter-spacing: .5px; font-weight: 700;">EMAIL</td>
                    <td width="70%" style="font-size: 14px; font-weight: 400;letter-spacing: .5px;"><?= $pengaturan->email ?></td>
                  </tr>
                  <tr>
                    <td width="30%" style="font-size: 13px; letter-spacing: .5px; font-weight: 700;">FACEBOOK</td>
                    <td width="70%" style="font-size: 14px; font-weight: 400;letter-spacing: .5px;"><?= $pengaturan->link_facebook ?></td>
                  </tr>
                  <tr>
                    <td width="30%" style="font-size: 13px; letter-spacing: .5px; font-weight: 700;">INSTAGRAM</td>
                    <td width="70%" style="font-size: 14px; font-weight: 400;letter-spacing: .5px;"><?= $pengaturan->link_instagram ?></td>
                  </tr>
                  <tr>
                    <td width="30%" style="font-size: 13px; letter-spacing: .5px; font-weight: 700;">TWITTER</td>
                    <td width="70%" style="font-size: 14px; font-weight: 400;letter-spacing: .5px;"><?= $pengaturan->link_twitter ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <div class="card border-0 shadow">
            <div class="card-header bg-white text-muted text-left border-0">
              <span class="text-uppercase font-weight-bold "><?= $pengaturan->nama ?> ON MAPS</span>
            </div>
            <div class="card-body">
              <iframe src="<?= $pengaturan->maps ?>" class="rounded" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-12">
          <div class="copyright-box">
            <p class="copyright" style="font-size: 14px; letter-spacing: .5px;">Copyright &copy; <?= date('Y') ?> <?php echo $pengaturan->nama ?>. All Rights Reserved</p>
            <!-- <div class="credits">
              Tutorial by <a href="https://www.malasngoding.com/"><?= $pengaturan->nama ?></a>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </footer>
</section>
<!--/ Section Contact-footer End /-->

<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
<div id="preloader"></div>

<!-- JavaScript Libraries -->
<script src="<?php echo base_url(); ?>assets_frontend/lib/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets_frontend/lib/jquery/jquery-migrate.min.js"></script>
<script src="<?php echo base_url(); ?>assets_frontend/lib/popper/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets_frontend/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets_frontend/lib/easing/easing.min.js"></script>
<script src="<?php echo base_url(); ?>assets_frontend/lib/counterup/jquery.waypoints.min.js"></script>
<script src="<?php echo base_url(); ?>assets_frontend/lib/counterup/jquery.counterup.js"></script>
<script src="<?php echo base_url(); ?>assets_frontend/lib/owlcarousel/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>assets_frontend/lib/lightbox/js/lightbox.min.js"></script>
<script src="<?php echo base_url(); ?>assets_frontend/lib/typed/typed.min.js"></script>
<!-- Contact Form JavaScript File -->
<script src="<?php echo base_url(); ?>assets_frontend/contactform/contactform.js"></script>

<!-- Template Main Javascript File -->
<script src="<?php echo base_url(); ?>assets_frontend/js/main.js"></script>
<script>
  $('#dropdownMenuButton').click(function() {
    $(this).find('.dropdown-menu').addClass('show');
  });

  $('ul .dropdown-menu').on('click', function(e) {
    if (!$(this).next().hasClass('show')) {
      $(this).parents('.dropdown-menu').first().find('.show').removeClass('show');
    }
    var $subMenu = $(this).next('.dropdown-menu');
    $subMenu.toggleClass('show');


    $(this).parents('li.dropdown-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
      $('.dropdown-submenu .show').removeClass('show');
    });


    return false;
  });
</script>
</body>

</html>