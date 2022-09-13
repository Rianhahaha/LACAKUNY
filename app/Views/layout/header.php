<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta5
* @link https://tabler.io
* Copyright 2018-2022 The Tabler Authors
* Copyright 2018-2022 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">


<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Aplikasi Mirror Spasikita</title>
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <!-- <link rel="shortcut icon" type="image/png" href="/favicon.ico"/> -->
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="theme-color" content="#ffffff">
  <!-- CSS files -->
  <link href="./dist/css/tabler.min.css" rel="stylesheet" />
  <link href="./dist/css/tabler-flags.min.css" rel="stylesheet" />
  <link href="./dist/css/tabler-payments.min.css" rel="stylesheet" />
  <link href="./dist/css/tabler-vendors.min.css" rel="stylesheet" />
  <link href="./dist/css/demo.min.css" rel="stylesheet" />
  <link href="./dist/css/check.css" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/d3js/7.6.1/d3.min.js"></script>
</head>

<body>
  <div class="theme-light">
    <div class="row sticky-top">
      <div class="navbar-expand-md">
        <div class="navbar navbar-expand-md navbar-light d-print-none uflex-nowrap ">
          <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="group">
              <h1 class="navbar-brand d-none-navbar-horizontal pe-0 pe-m-3 d-none d-sm-inline-block">
                <a href="#">
                  <img src="./asset/img/UNY.svg" style="height:8vh !important;" alt="Mirror Spasikita" class="navbar-brand-image">
                </a>
              </h1>
              <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-m-3 ">
                <a href="#">
                  <img src="./asset/img/AplikasiLacak.svg" style="height:8vh !important;" alt="Mirror Spasikita" class="navbar-brand-image">
                </a>


              </h1>
            </div>
            <div class="navbar-nav flex-row order-md-last">
              <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Enable dark mode">
                <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z"></path>
                </svg>
              </a>
              <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
                <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <circle cx="12" cy="12" r="4" />
                  <path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                </svg>
              </a>
              <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" style="width: 30px; height: 30px;" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                  </svg>

                  <div class="d-none d-xl-block ps-2">
                    <div>
                      <?= !empty($ket_pengguna) ? $ket_pengguna : 'User' ?>
                    </div>
                    <!-- <div class="mt-1 small text-muted">Admin</div> -->
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <!-- <a href="#" class="dropdown-item">Profile & account</a>
              <a href="#" class="dropdown-item">Settings</a> -->
                  <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modaluser">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon text-primary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <circle cx="9" cy="7" r="4"></circle>
                      <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                      <path d="M16 11h6m-3 -3v6"></path>
                    </svg>
                    Tambah Akun</a>
                  <a href="#" class="dropdown-item">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon text-primary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M7 10h3v-3l-3.5 -3.5a6 6 0 0 1 8 8l6 6a2 2 0 0 1 -3 3l-6 -6a6 6 0 0 1 -8 -8l3.5 3.5"></path>
                    </svg>
                    Pengelolaan User</a>
                  <a href="login/logout" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logout">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M7 6a7.75 7.75 0 1 0 10 0"></path>
                      <line x1="12" y1="4" x2="12" y2="12"></line>
                    </svg>
                    Logout</a>

                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
          <div class="navbar navbar-light">
            <div class="container-fluid">
              <ul class="navbar-nav">
                <li class="nav-item <?= uri_string() == 'beranda' ? 'active' : '' ?>">
                  <a class="nav-link" href="<?= base_url('/beranda'); ?>">
                    <span class="nav-link-icon">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <polyline points="5 12 3 12 12 3 21 12 19 12" />
                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                      </svg>
                    </span>
                    <span class="nav-link-title ">
                      Beranda
                    </span>
                  </a>
                </li>
                <li class="nav-item <?= uri_string() == 'simproka1' ? 'active' : '' ?>">
                  <a class="nav-link" href="<?= base_url(trim($ket_pengguna) == 'ADMIN' ? '/KRO' : '/general'); ?>">
                    <span class=" nav-link-icon">
                      <!-- Download SVG icon from http://tabler-icons.io/i/package -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3" />
                        <line x1="12" y1="12" x2="20" y2="7.5" />
                        <line x1="12" y1="12" x2="12" y2="21" />
                        <line x1="12" y1="12" x2="4" y2="7.5" />
                        <line x1="16" y1="5.25" x2="8" y2="9.75" />
                      </svg>
                    </span>
                    <span class="nav-link-title">
                      Simproka
                    </span>
                  </a>

                </li>
                <li class="nav-item <?= uri_string() == 'kinerja' ? 'active' : '' ?>">
                  <a class="nav-link" href="<?= base_url('/kinerja'); ?>">
                    <span class="nav-link-icon">
                      <!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <polyline points="9 11 12 14 20 6" />
                        <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                      </svg>
                    </span>
                    <span class="nav-link-title">
                      Pengukuran Kinerja
                    </span>
                  </a>
                </li>
                <li class="nav-item <?= uri_string() == 'satker' ? 'active' : '' ?>">
                  <a class="nav-link" href="<?= base_url('/satker'); ?>">
                    <span class="nav-link-icon">
                      <!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <polyline points="9 11 12 14 20 6" />
                        <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                      </svg>
                    </span>
                    <span class="nav-link-title">
                      Info Satker
                    </span>
                  </a>
                </li>
                <li class="nav-item hidden">
                  <a class="nav-link" href="<?= base_url('/pohonKinerja'); ?>">
                    <span class="nav-link-icon">
                      <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-hierarchy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <circle cx="12" cy="5" r="2"></circle>
                        <circle cx="5" cy="19" r="2"></circle>
                        <circle cx="19" cy="19" r="2"></circle>
                        <path d="M6.5 17.5l5.5 -4.5l5.5 4.5"></path>
                        <line x1="12" y1="7" x2="12" y2="13"></line>
                      </svg>
                    </span>
                    <span class="nav-link-title">
                      Pohon Kinerja
                    </span>
                  </a>
                </li>
                <?php if (isset($id_pengguna) && ($id_pengguna == 1230)) : ?>
                  <li class="nav-item hidden">
                    <a class="nav-link" href="<?= base_url('/dev'); ?>">
                      <span class="nav-link-icon">
                        <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-hierarchy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                          <circle cx="12" cy="5" r="2"></circle>
                          <circle cx="5" cy="19" r="2"></circle>
                          <circle cx="19" cy="19" r="2"></circle>
                          <path d="M6.5 17.5l5.5 -4.5l5.5 4.5"></path>
                          <line x1="12" y1="7" x2="12" y2="13"></line>
                        </svg>
                      </span>
                      <span class="nav-link-title">
                        DEVELOP
                      </span>
                    </a>
                  </li>
                <?php endif; ?>

                <!-- tambahan coba coba -->
                <li class="nav-item hidden">
                  <a class="nav-link" href="<?= base_url('/pengguna'); ?>">
                    <span class="nav-link-icon">
                      <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-hierarchy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <circle cx="12" cy="5" r="2"></circle>
                        <circle cx="5" cy="19" r="2"></circle>
                        <circle cx="19" cy="19" r="2"></circle>
                        <path d="M6.5 17.5l5.5 -4.5l5.5 4.5"></path>
                        <line x1="12" y1="7" x2="12" y2="13"></line>
                      </svg>
                    </span>
                    <span class="nav-link-title">
                      pengguna online
                    </span>
                  </a>
                </li>
                <script src="<?php echo base_url() ?>/asset/jquery/jquery-3.6.1.min.js"></script>
                <script>
                  console.log("Hello world!");
                  $(window).on('load', hideData());

                  function hideData() {
                    $(".hidden").hide();
                    $(".warn-p").hide();
                  }
                  // $(document).ready(function() {
                  //   $(".hidden").hide();
                  //   $(".warn-p").hide();
                  //   console.log("Hello world!4");
                  // });
                  // });
                </script>
              </ul>
              <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
                <form action="." method="get">
                  <div class="input-icon">
                    <span class="input-icon-addon">
                      <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <circle cx="10" cy="10" r="7" />
                        <line x1="21" y1="21" x2="15" y2="15" />
                      </svg>
                    </span>
                    <input type="text" class="form-control" placeholder="Cari Aplikasi..." aria-label="Search in website">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal logout -->
    <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="modal-status bg-danger"></div>
          <div class="modal-body text-center py-4">
            <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M12 9v2m0 4v.01" />
              <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
            </svg>
            <h3>Log out?</h3>
            <div class="text-muted">Data yang <b>tidak</b> tersimpan akan hilang.</div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="submit" class="btn" data-bs-dismiss="modal">
              Batal
            </button>
            <form action="<?php echo base_url('login/logout'); ?>" method="post" enctype="multipart/form-data">
              <button type="submit" class="btn btn-danger">
                Log out
              </button>
            </form>

          </div>
        </div>
      </div>
    </div>
    <!-- Modal logout end -->

    <!-- modal tambah User -->
    <div class="modal fade" id="modaluser" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-backdrop="false" data-bs-keyboard="false">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form action="simproka1/formRegistrasi" method="post">

          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah User</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="mb-3">

                  <label class="form-label required">Masukkan Email</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Isikan email" required>
                </div>



                <div class="mb-3">
                  <label class="form-label required">Buat Password</label>
                  <div class="input-group input-group-flat">
                    <input name="password" id="password" type="password" class="form-control" placeholder="Masukkan password" autocomplete="off">
                    <span class="input-group-text">
                      <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip" onclick=showPW()>
                        <!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                          <circle cx="12" cy="12" r="2" />
                          <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                        </svg>
                      </a>
                    </span>
                  </div>
                </div>
                <p class="warn-p" style="color:red">Password tidak sama!</p>
                <div class="mb-3">
                  <label class="form-label required">Ketik Ulang Password</label>
                  <div class="input-group input-group-flat">
                    <input name="password2" id="password2" type="password" class="form-control" placeholder="Ketik ulang password" autocomplete="off">
                    <span class="input-group-text">
                      <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip" onclick=showPW()>
                        <!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                          <circle cx="12" cy="12" r="2" />
                          <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                        </svg>
                      </a>
                    </span>
                  </div>
                </div>
                <p class="warn-p" style="color:red">Password tidak sama!</p>
                <div class="mb-3">
                  <label class="form-label required">Nama Bidang</label>
                  <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Isi nama bidang" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Pilih Status</label>
                  <select type="text" class="form-select" placeholder="Pilih Status" id="drop-status-user" name="status" value="">
                    <option value="PIC">PIC</option>
                    <option value="KOOR">KOOR</option>
                    <option value="ADMIN">ADMIN</option>
                  </select>
                </div>

              </div>
            </div>

            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
              <button type="submit" id="btn-sbt" class="btn btn-success" disabled>Tambah User</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <script src="<?php echo base_url() ?>/asset/jquery/jquery-3.6.1.min.js"></script>
    <script>
      $('#password2').focusout(function() {
        var pass = $('#password').val();
        var pass2 = $('#password2').val();

        if (pass != pass2) {
          $(".warn-p").show();
        } else {
          $(".warn-p").hide();
        }

      });
    </script>
    <script>
      $('#password').focusout(function() {
        var pass = $('#password').val();
        var pass2 = $('#password2').val();
        if (pass2) {
          if (pass != pass2) {
            $(".warn-p").show();
          } else {
            $(".warn-p").hide();
          }
        }

      });
    </script>
    <script>
      if ($('.warn-p').is(":visible")) {
        $('#btn-sbt').prop('disabled', true);
      } else {
        $('#btn-sbt').prop('disabled', false);
      };
    </script>
    <!-- modal tambah User end -->