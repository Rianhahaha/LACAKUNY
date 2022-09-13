<?= $this->include('layout/header'); ?>
<!-- copy dibawah ini yan -->

<div class="page scroll">
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                    <ul>
                      <?php foreach($pengguna as $p): ?>
                    <li>
                        <?= $p; ?>
                    </li>
                    <?php endforeach; ?>
                    </ul>

                    </div>
                 </div>
            </div>
        </div>
     </div>
</div>
              


<!-- batas -->
<?= $this->include('layout/footer'); ?>