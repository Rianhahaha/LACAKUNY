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
  <!-- CSS files -->
  <link href="./dist/css/tabler.min.css" rel="stylesheet" />
  <link href="./dist/css/tabler-flags.min.css" rel="stylesheet" />
  <link href="./dist/css/tabler-payments.min.css" rel="stylesheet" />
  <link href="./dist/css/tabler-vendors.min.css" rel="stylesheet" />
  <link href="./dist/css/demo.min.css" rel="stylesheet" />
</head>
<style type="text/css">
  body {
    background: url(images/bg.jpg) no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
  }
</style>



<body class=" border-top-wide border-primary d-flex flex-column" style="background-image:url(./asset/img/uny2.jpg) ;">

  <div class="page page-center">
    <div class="container-tight">
    
      <a href="#">
        <img src="./asset/img/Login_Lacak.svg">   
      </a>
      
      <form action="<?php echo base_url('login/process'); ?>" method="post" enctype="multipart/form-data" class="card card-md" autocomplete="off">
        <?= csrf_field(); ?>

        <div class="card-body">
        <?php $validation = \Config\Services::validation();?>
        <?php if(!empty($validation->getErrors())) {?>
                        <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('username');?> <br>
                            <?= $error = $validation->getError('password');?>
                        </div>
                        <?php } $validation->reset();?>
        <div class="mb-3">
          <div id="tahun" class="form-group">
            <label class="form-label">Pilih Tahun</label>
            <select id="tahun" name="tahun"class="form-control" placeholder="Pilih Tahun">
              <option value="2020"<?= $tahun == '2020' ? 'selected':'' ?>>2020</option>
              <option value="2021"<?= $tahun == '2021' ? 'selected':'' ?>>2021</option>
              <option value="2022"<?= $tahun == '2022' ? 'selected':'' ?>>2022</option>
            </select>
          </div>
        </div>
          <script>
            var options = document.getElementById("tahun").options;
            for (var i = 0; i < options.length; i++) {
              if (options[i].value== <?= $tahun; ?>) {
                options[i].selected = true;
                break;
              }
            }
          </script>
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input name="username"id="username"type="email" class="form-control <?= ($validation->hasError('username'))?'is-invalid':'';?>" placeholder="Username  ">
          </div>
          <div class="mb-2">
            <label class="form-label">
              Password
              <span class="form-label-description">
                <a href="#">I forgot password</a>
              </span>
            </label>
            <div class="input-group input-group-flat">
              <input name="password"id="password" type="password" class="form-control  <?= ($validation->hasError('password'))?'is-invalid':'';?>" placeholder="Password" autocomplete="off">
              <span class="input-group-text">
                <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip" onclick=showPW()>
                  <!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <circle cx="12" cy="12" r="2" />
                    <path
                      d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                  </svg>
                </a>
              </span>
            </div>
          </div>
          <div class="mb-2">
            <label class="form-check">
              <input type="checkbox" class="form-check-input" />
              <span class="form-check-label">Remember me on this device</span>
            </label>
          </div>
          <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">Log in</button>
          </div>
          </form>
        </div>
        <div class="hr-text">atau</div>
        <div class="card-body">
          <div class="row">
            <div class="col"><a href="#" class="btn btn-white w-100">
                <!-- Download SVG icon from http://tabler-icons.io/i/brand-github -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-key" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <circle cx="8" cy="15" r="4"></circle>
                  <line x1="10.85" y1="12.15" x2="19" y2="4"></line>
                  <line x1="18" y1="5" x2="20" y2="7"></line>
                  <line x1="15" y1="8" x2="17" y2="10"></line>
                </svg>
                Login with SSO
              </a></div>
          </div>
        </div>
      
    </div>
  </div>
  <!-- Libs JS -->
  <!-- Tabler Core -->
  <script src="./dist/js/tabler.min.js"></script>
  <script src="./dist/js/demo.min.js"></script>
  <script>
  function showPW() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
</body>

</html>