<?= $this->include('layout/header'); ?>
<!-- copy dibawah ini yan -->
<div class="page-body">
    <div class="page-wrapper">
        <div class="container-fluid">
            <!-- validation upload file -->
            <?php $validation = \Config\Services::validation(); ?>
            <?php if (!empty(session()->getFlashdata('errorPW'))) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('errorPW'); ?>
                </div>
            <?php }
            if (!empty(session()->getFlashdata('pesan'))) { ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php } ?>
            <?php if ($validation->hasError('excel')) { ?>
                <div class='alert alert-danger mt-2'>
                    <?= $error = $validation->getError('excel'); ?>
                </div>
            <?php }
            $validation->reset(); ?>
            <!-- end validation -->
            <!-- Header -->
            <h2 class="page-title"> Pengukuran Kinerja Triwulan
                <?= $sistem; ?> Tahun
                <?= $tahun; ?>
            </h2>
            <!-- <h3> 2022 </h3> -->
            </td>
            <script src="<?php echo base_url() ?>/asset/jquery/jquery-3.6.1.min.js"></script>
            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col">
                        <!-- Page pre-title -->
                        <form method="post">
                            <div class="page-pretitle">Pilih Triwulan</div>
                            <div class="btn-group">
                                <select id="sistem" class="form-control" placeholder="Pilih Tahun">
                                    <option value="1">Triwulan 1
                                    </option>
                                    <option value="2">Triwulan 2
                                    </option>
                                    <option value="3">Triwulan 3
                                    </option>
                                    <option value="4">Triwulan 4
                                    </option>

                                </select>
                                <!-- <button class="btn btn-outline-secondary"> Pilih </button> -->
                            </div>
                        </form>
                    </div>



                    <script type="text/javascript">
                        console.log("Hello world!");
                        $(document).ready(function() {
                            $("#sistem").change(function() {
                                var data = $(this).val();
                                console.log(data);

                                $.ajax({
                                    type: 'POST',
                                    url: "<?php echo base_url("kinerja/aksesData"); ?>",
                                    data: {
                                        data: data
                                    },
                                    cache: false,
                                    success: function(data) {
                                        $('#tampil').load("<?php echo base_url("/kinerja/tabelKinerja"); ?>");
                                        console.log("Hello world!3");
                                    }
                                });
                                console.log("Hello world!4");
                            });
                        });
                    </script>

                    <?php $admin = false;
                    $koor = false;
                    foreach ($user as $usr => $value) {
                        if (trim($value['status']) == 'ADMIN') {
                            $admin = true;
                        } else if (trim($value['status']) == 'KOOR') {
                            $koor = true;
                        }
                    } ?>
                    <?php if ($admin == true) : ?>
                        <!-- Page title actions -->
                        <div class="col-12 col-md-auto">
                            <div class="btn-list">
                                <button class="btn d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modaltanggal">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-event text-primary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                                        <line x1="16" y1="3" x2="16" y2="7"></line>
                                        <line x1="8" y1="3" x2="8" y2="7"></line>
                                        <line x1="4" y1="11" x2="20" y2="11"></line>
                                        <rect x="8" y="15" width="2" height="2"></rect>
                                    </svg>
                                    Pengaturan Tanggal
                                </button>
                                <?php if (empty($data)) : ?>
                                    <form action="<?php echo base_url('kinerja/readExcel'); ?>" method="post" enctype="multipart/form-data">
                                        <?= csrf_field(); ?>
                                        <div class="input-group">
                                            <input type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" class="form-control  <?= ($validation->hasError('excel')) ? 'is-invalid' : ''; ?>" id="excel" aria-describedby="inputGroupFileAddon04" name="excel" aria-label="Upload">
                                            <button class="btn btn-outline-secondary  " type="submit" id="inputGroupFileAddon04" value="Upload">Submit</button>
                                            <!-- <button class="btn btn-outline-secondary d-sm-none"  onclick="document.getElementById('excel').click()">Upload Excel</button>
                                                <input type='file' 
                                                        class="form-control d-none d-sm-inline-block "
                                                    id="excel" aria-describedby="inputGroupFileAddon04" name="excel"
                                                    aria-label="Upload" style="display:none">  -->
                                        </div>
                                    </form>
                                <?php endif; ?>
                                <div>
                                    <form action="kinerja/downloadFormat" method="get">
                                        <?= csrf_field(); ?>
                                        <!-- <a href="/uploads/file/Format_Pengukuran_Kinerja_Triwulan_2022.xlsx" download > -->
                                        <button type="submit" class="btn btn-successq d-none d-sm-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon text-success icon-tabler icon-tabler-file-download" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                                <path d="M12 17v-6"></path>
                                                <path d="M9.5 14.5l2.5 2.5l2.5 -2.5"></path>
                                            </svg>
                                            Download Format tabel
                                        </button>
                                        <button type="submit" class="btn btn-successq d-sm-none btn-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon text-success icon-tabler icon-tabler-file-import" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                <path d="M5 13v-8a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5.5m-9.5 -2h7m-3 -3l3 3l-3 3">
                                                </path>
                                            </svg>
                                        </button>
                                        <!-- </a> -->
                                    </form>
                                </div>
                                <?php if (!empty($data)) : ?>
                                    <div>
                                        <form action="kinerja/writeExcel" method="get">
                                            <?= csrf_field(); ?>
                                            <button type="submit" class="btn btn-primaryq d-none d-sm-inline-block">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-import text-primary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                    <path d="M5 13v-8a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5.5m-9.5 -2h7m-3 -3l3 3l-3 3">
                                                    </path>
                                                </svg>
                                                Export
                                            </button>
                                            <button type="submit" class="btn btn-primaryq d-sm-none btn-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-import text-primary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                    <path d="M5 13v-8a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5.5m-9.5 -2h7m-3 -3l3 3l-3 3">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>

                                    <div>
                                        <button href="kinerja/delete" class="btn btn-danger d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M4 7h16"></path>
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12">
                                                </path>
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                <path d="M10 12l4 4m0 -4l-4 4"></path>
                                            </svg>
                                            Hapus semua
                                        </button>
                                        <button href="kinerja/delete" class="btn btn-danger d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M4 7h16"></path>
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12">
                                                </path>
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                <path d="M10 12l4 4m0 -4l-4 4"></path>
                                            </svg>
                                        </button>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!-- TABEL DATA MULAI -->
                        <div id="tampil">
                            <!-- ISI TABEL -->
                        </div>
                        <!-- TABEL DATA END -->

                    </div>
                </div>

            </div>

            <?php $i = 1;
            $idx = 1;
            $number = 1;
            foreach ($data as $dat => $value) :
                foreach ($value as $val => $d) {
                    $mod = $idx;


                    // if($d['id_pengguna']==$id_pengguna):
            ?>

            <?php $idx++;
                    $i++;
                    $number++;
                }
            endforeach; ?>

            <!-- tabel -->
        </div>
    </div>
</div>
</div>
</div>
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    function validateSize(input) {

        const fileSize = input.files[0].size / 1024 / 1024; // in MiB

        if (fileSize > 20) {
            alert('Ukuran Maksimal 20 MB');
            $('input[type=file]').val('');

            //for clearing with Jquery
        } else {
            // Proceed further
        }
    }

    function onlyOne(checkbox) {
        var checkboxes = document.getElementsByName('check')
        checkboxes.forEach((item) => {
            if (item !== checkbox) item.checked = false
        })
    }

    function toggle() {
        document.getElementById("toggle").toggleAttribute("hidden");

    }
</script>

<!-- modal kalender -->
<div class="modal fade" id="modaltanggal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-backdrop="false" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">


            <div class="modal-header">
                <h5 class="modal-title">Atur Penanggalan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row">

                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Buka tanggal</label>
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                                        <line x1="16" y1="3" x2="16" y2="7"></line>
                                        <line x1="8" y1="3" x2="8" y2="7"></line>
                                        <line x1="4" y1="11" x2="20" y2="11"></line>
                                        <line x1="11" y1="15" x2="12" y2="15"></line>
                                        <line x1="12" y1="15" x2="12" y2="18"></line>
                                    </svg>
                                </span>
                                <input class="form-control" placeholder="Pilih tanggal buka..." id="tanggal_buka" value="2020-06-20">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="page-pretitle text-red">Format 24 jam</label>
                            <input type="time" name="input-mask" class="form-control" data-mask="00:00" data-mask-visible="true" placeholder="00 : 00" autocomplete="off">
                        </div>


                    </div>

                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Tutup tanggal</label>
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                                        <line x1="16" y1="3" x2="16" y2="7"></line>
                                        <line x1="8" y1="3" x2="8" y2="7"></line>
                                        <line x1="4" y1="11" x2="20" y2="11"></line>
                                        <line x1="11" y1="15" x2="12" y2="15"></line>
                                        <line x1="12" y1="15" x2="12" y2="18"></line>
                                    </svg>
                                </span>
                                <input class="form-control" placeholder="Pilih tanggal tutup..." id="tanggal_tutup" value="2020-06-20">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="page-pretitle text-red">Format 24 jam</label>
                            <input type="time" value="22:00" name="input-mask" class="form-control" data-mask="00:00" data-mask-visible="true" placeholder="00 : 00" autocomplete="off">
                        </div>


                    </div>

                </div>

            </div>


            <div class="modal-footer justify-content-between">
                <button type="button" class="btn" data-bs-dismiss="modal">Keluar</button>
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            </div>
            </form>
        </div>

    </div>

</div>

<!-- modal kalender end -->





<!-- batas -->
<?= $this->include('layout/footer'); ?>