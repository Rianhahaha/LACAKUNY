<?php
$page = "simproka"; ?>
<?= $this->include('layout/header'); ?>
<?= $this->include('layout/sidebarSimproka'); ?>

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

            <div class="btn-group">
                <button class="btn btn-ghost-dark btn-icon" data-bs-toggle="offcanvas" href="#sidebarsimproka" role="button" aria-controls="offcanvasStart">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <line x1="4" y1="6" x2="20" y2="6"></line>
                        <line x1="4" y1="12" x2="20" y2="12"></line>
                        <line x1="4" y1="18" x2="20" y2="18"></line>
                    </svg>
                </button>
                <h1 class="page-title">SIMPROKA</h1>
            </div>
            <!-- <div class="btn-group">
                             <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#pilihkro">
                                Pilih KRO
                             </button> -->
            <!-- <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#pilihpic">
                                Pilih PIC
                             </button> -->


            <div class="row align-items-end">
                <div class="col">
                    <form action="simproka1/KRO" method="get">
                        <input type="hidden" name="detail" id="detail" value="KRO">
                        <?php if ($bagian == 'RO') { ?>

                            <button type="submit" class="btn">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1"></path>
                                </svg>
                                Halaman Sebelumnya
                            </button>

                        <?php } ?>
                    </form>
                    <br>

                </div>

                <div class="col-12 col-md-auto">
                    <div class="btn-list">
                        <?php if ($bagian == 'KRO') { ?>

                            <!-- Pengaturan Tanggal -->
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
                            <!-- Pengaturan Tanggal END -->
                            <?php if (empty($data)) : ?>
                                <form action="<?php echo base_url('simproka1/readExcel'); ?>" method="post" enctype="multipart/form-data">
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
                                <!-- KRO -->
                                <button class="btn d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modalkro">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus text-primary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                    Tambah KRO
                                </button>
                                <button class="btn d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modalkro">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus text-primary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                                <button class="btn d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#hapuskro1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-x text-danger" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 7h16"></path>
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12">
                                        </path>
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                        <path d="M10 12l4 4m0 -4l-4 4"></path>
                                    </svg>
                                    Hapus KRO
                                </button>
                                <button class="btn d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#hapuskro1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-x text-danger" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 7h16"></path>
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12">
                                        </path>
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                        <path d="M10 12l4 4m0 -4l-4 4"></path>
                                    </svg>
                                </button>
                            <?php } ?>
                            <!-- KRO btn -->

                            </div>
                            <!-- RO -->
                            <?php if ($bagian == 'RO') { ?>
                                <button class="btn" data-bs-toggle="modal" data-bs-target="#pilihedit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus text-primary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                    Tambah Data
                                </button>

                                <button class="btn" data-bs-toggle="modal" data-bs-target="#hapusdata">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-x text-danger" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 7h16"></path>
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12">
                                        </path>
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                        <path d="M10 12l4 4m0 -4l-4 4"></path>
                                    </svg>
                                    Hapus Data
                                </button>
                            <?php } ?>
                            <!-- RO btn -->
                            <?php if ($bagian == 'KRO') { ?>
                                <div>
                                    <form action="<?php echo base_url('simproka1/downloadFormat'); ?>" method="get">
                                        <?= csrf_field(); ?>
                                        <!-- <a href="/uploads/file/Format_Pengukuran_KinerjaOLD_Triwulan_2022.xlsx" download > -->



                                        <button type="submit" class="btn d-none d-sm-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-download text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                                </path>
                                                <path d="M12 17v-6"></path>
                                                <path d="M9.5 14.5l2.5 2.5l2.5 -2.5"></path>
                                            </svg>
                                            Download Format tabel
                                        </button>
                                        <button type="submit" class="btn d-sm-none btn-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-upload text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                                </path>
                                                <path d="M12 11v6"></path>
                                                <path d="M9.5 13.5l2.5 -2.5l2.5 2.5"></path>
                                            </svg>
                                        </button>
                                        <!-- </a> -->
                                    </form>
                                </div>

                                <?php if (!empty($data)) : ?>
                                    <div>
                                        <form action="" method="get">
                                            <?= csrf_field(); ?>
                                            <button type="submit" class="btn d-none d-sm-inline-block">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-import text-primary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                    <path d="M5 13v-8a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5.5m-9.5 -2h7m-3 -3l3 3l-3 3">
                                                    </path>
                                                </svg>
                                                Export
                                            </button>
                                            <button type="submit" class="btn d-sm-none btn-icon">
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

                                        <button class="btn btn-danger d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-danger">
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
                                        <button class="btn btn-danger d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-danger">
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
                            <?php } ?>
                    </div>
                    <br>



                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <!-- <h3 class="page-pretitle"> DK.4470.BEI.001.004 </h3> -->
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <?php if ((empty($data)) && ($bagian != 'RO')) { ?>
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col">
                                                <br><br>
                                                <h1>Data Simproka bulan
                                                    <?= $sistem; ?> Tahun
                                                    <?= $tahun; ?> masih kosong!
                                                </h1>
                                                <a>Jika sudah memasuki tanggal pengisian simproka
                                                    <?= $sistem; ?> namun data masih kosong, silahkan hubungi <b>
                                                        admin</b>. <br> Terima Kasih...
                                                </a>
                                                <br><br><br>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <thead>
                                        <tr style="height: 100px;" valign=middle class="text-center text- text-light bg-dark">
                                            <td rowspan=1>
                                                Input
                                            </td>
                                            <td rowspan=1>
                                                Kode
                                            </td>
                                            <td rowspan=1>
                                                Uraian
                                            </td>
                                            <td rowspan=1>
                                                Satuan
                                            </td>
                                            <td rowspan=1>
                                                Volume Target
                                            </td>
                                            <td rowspan=1>
                                                PIC
                                            </td>
                                            <td rowspan=1>
                                                CAPAIAN Volume
                                            </td>
                                            <td rowspan=1>
                                                Progress
                                            </td>
                                            <td rowspan=1>
                                                Capaian Rill
                                            </td>
                                            <td rowspan=1>
                                                Satuan Rill
                                            </td>
                                            <td rowspan=1>
                                                Status
                                            </td>
                                            <td rowspan=1>
                                                Penjelasan
                                            </td>
                                            <td rowspan=1>
                                                Kendala
                                            </td>
                                            <td rowspan=1>
                                                Tindak Lanjut
                                            </td>
                                            <td rowspan=1>
                                                Data Dukung
                                            </td>
                                            <td colspan=2>
                                                #
                                            </td>

                                    </thead>
                                <?php } ?>
                                <!-- isi tabel 1 -->
                                <tbody>
                                    <?php
                                    $abjad = 65;
                                    $idx = 1;
                                    $mod = 1;
                                    foreach ($data as $d) : ?>
                                        <tr class='text-center' valign=middle data-bs-trigger="hover">
                                            <td>
                                                <?php if (trim($d['status_validasi']) == "pengisian") { ?>
                                                    <!-- input -->
                                                    <form action="simproka1/editPage" method="post">
                                                        <input type="hidden" name="select" id="select" value="INPUT">
                                                        <input type="hidden" name="detail" id="detail" value="<?= trim($d['detail']); ?>">
                                                        <input type="hidden" name="kode" id="kode" value=<?= trim($d['kode']); ?>>
                                                        <?php if (isset($d['kro'])) { ?>
                                                            <input type="hidden" name="kro" id="kro" value=<?= trim($d['kro']); ?>>
                                                        <?php }  ?>
                                                        <button type="submit" class="btn btn-ghost-primary">
                                                            Input
                                                        </button>
                                                    </form>

                                                <?php
                                                }  ?>
                                            </td>
                                            <td align=center>
                                                <!-- KRO -->

                                                <form action="simproka1/RO" method="post">
                                                    <div class="btn-group">
                                                        <input type="hidden" name="detail" id="detail" value="RO">
                                                        <input type="hidden" name="KRO" id="KRO" value=<?= $d['kode']; ?>>
                                                        <?php if (trim($d['detail']) == 'KRO') { ?>
                                                            <button type="submit" class="btn btn-ghost-primary">
                                                                <?= $d['kode']; ?>
                                                            </button>
                                                        <?php } else if ((trim($d['detail']) == 'RO') || (trim($d['detail']) == 'OTHER')) { ?>
                                                            <a>
                                                                <?= $d['kode']; ?>
                                                            </a>
                                                        <?php $abjad = 65;
                                                        } else if (trim($d['detail']) == 'KOMPONEN') { ?>
                                                            <a><?= $d['kode']; ?></a>
                                                        <?php $abjad = 65;
                                                        } else { ?>
                                                            <a>
                                                                <?= chr($abjad);  ?>
                                                            </a>
                                                        <?php $abjad++;
                                                        } ?>
                                                    </div>

                                                </form>

                                            </td>
                                            <td align=left>
                                                <!-- uraian -->
                                                <?= $d['uraian']; ?>
                                            </td>
                                            <td>
                                                <!-- satuan -->
                                                <?php if (trim($d['satuan']) != "0") { ?>
                                                    <?= $d['satuan']; ?>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <!-- volume target -->
                                                <?php if ($d['volume_target'] != 0) { ?>
                                                    <?= $d['volume_target']; ?>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <!-- PIC -->
                                                <?php if (trim($d['pic']) != "0") { ?>
                                                    <?= $d['pic']; ?>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <!-- Capaian Volume -->
                                                <?= $d['capaian_volume']; ?>
                                            </td>
                                            <td>
                                                <!-- progress -->
                                                <?= $d['progres']; ?>
                                            </td>
                                            <td>
                                                <!-- Capaian ril -->
                                                <?= $d['capaian_rill']; ?>
                                            </td>
                                            <td>
                                                <!-- Satuan ril -->
                                                <?= $d['satuan_rill']; ?>
                                            </td>
                                            <td>
                                                <!-- status -->
                                                <?= $d['status']; ?>
                                            </td>
                                            <td>
                                                <!-- penjelasan -->
                                                <?= $d['penjelasan']; ?>
                                            </td>
                                            <td>
                                                <!-- kendala -->
                                                <?= $d['kendala']; ?>
                                            </td>
                                            <td>
                                                <!-- tindak lanjut -->
                                                <?= $d['tindak_lanjut']; ?>
                                            </td>
                                            <?php if (trim($d['detail']) != 'OTHER') { ?>
                                                <td>
                                                    <!-- Data Dukung -->
                                                    <span class="btn btn-ghost-primary" data-bs-toggle="modal" data-bs-target="#doc<?= $mod; ?>">

                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-description" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                                            </path>
                                                            <path d="M9 17h6"></path>
                                                            <path d="M9 13h6"></path>
                                                        </svg>
                                                        <?= $totalFile[trim($d['kode'])]; ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <!-- edit -->

                                                    <form action="simproka1/editPage" method="post">
                                                        <input type="hidden" name="select" id="select" value="EDIT">
                                                        <input type="hidden" name="detail" id="detail" value="<?= trim($d['detail']); ?>">
                                                        <input type="hidden" name="kode" id="kode" value=<?= trim($d['kode']); ?>>
                                                        <?php if (isset($kode)) { ?>
                                                            <input type="hidden" name="kro" id="kro" value=<?= trim($kode); ?>>
                                                        <?php }  ?>
                                                        <button type="submit" class="btn btn-ghost-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                                                                </path>
                                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                                                </path>
                                                                <path d="M16 5l3 3"></path>
                                                            </svg>
                                                            Edit
                                                        </button>
                                                    </form>
                                                    <!-- <button class="btn btn-ghost-primary" data-bs-toggle="modal"
                                                    data-bs-target="#editkro<?= $mod; ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                        <path d="M16 5l3 3"></path>
                                                     </svg>
                                                    Edit
                                                </button> -->

                                                </td>
                                                <td colspan=1>
                                                    <span class="form-help" data-bs-trigger="hover" data-bs-toggle="popover" data-bs-content="Terakhir disunting pada <?= $d['tanggal'] . ' oleh ' . trim($d['pengedit']) . '.'; ?>">?</span>
                                                </td>
                                            <?php } ?>
                                        </tr>

                                    <?php $mod++;
                                    endforeach;  ?>

                            </table>
                            <tr><br></tr>
                            <tr>
                                <?php if ($bagian == 'RO') { ?>
                                    <form action="simproka1/KRO" method="post">

                                        <input type="hidden" name="detail" id="detail" value="KRO">

                                        <button type="submit" class="btn btn-outline-danger d-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1"></path>
                                            </svg>
                                            Halaman Sebelumnya
                                        </button>

                                    </form>
                                <?php } ?>
                                <?php if ($bagian == 'RO') { ?>
                                    <a class="btn" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <polyline points="7 11 12 6 17 11"></polyline>
                                            <polyline points="7 17 12 12 17 17"></polyline>
                                        </svg>
                                        Ke atas
                                    </a>
                                <?php } ?>
                            </tr>
                            <!-- tabel -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>
</div>
</div>
<!-- modal pilih KRO -->
<!-- <div class="modal fade" id="pilihkro" aria-labelledby="EditPK" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-body">
                <h2>Pilih KRO</h2>
                <table class="table table-bordered table-hover">
                    <tr>
                        <td>DK.4470.BEI.001.004</td>
                        <td align="middle">
                            <button class="btn btn-outline-success">
                                Pilih
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>DK.4471.CAA.001.051</td>
                        <td align="middle">
                            <button class="btn btn-outline-success">
                                Pilih
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>DK.4471.CBJ.001.051</td>
                        <td align="middle">
                            <button class="btn btn-outline-success">
                                Pilih
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>DK.4471.DBA.001.060 </td>
                        <td align="middle">
                            <button class="btn btn-outline-success">
                                Pilih
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>DK.4471.DBA.003.051</td>
                        <td align="middle">
                            <button class="btn btn-outline-success">
                                Pilih
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>DK.4471.DBA.003.053</td>
                        <td align="middle">
                            <button class="btn btn-outline-success">
                                Pilih
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>DK.4471.DBA.004.051</td>
                        <td align="middle">
                            <button class="btn btn-outline-success">
                                Pilih
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>DK.4471.DBA.004.052</td>
                        <td align="middle">
                            <button class="btn btn-outline-success">
                                Pilih
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>WA.4257.EBA.994.001</td>
                        <td align="middle">
                            <button class="btn btn-outline-success">
                                Pilih
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>WA.4257.EBA.994.002 </td>
                        <td align="middle">
                            <button class="btn btn-outline-success">
                                Pilih
                            </button>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div> -->
<!-- end modal pilih KRO -->

<!-- modal tambah KRO -->
<div class="modal fade" id="modalkro" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-backdrop="false" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form action="<?php echo base_url('simproka1/insertSimproka'); ?>" method="POST">
            <?= csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah KRO</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3">
                            <input type="hidden" class="form-control" name="detail" id="detail" value="KRO">
                            <label class="form-label required">Kode</label>
                            <input type="text" class="form-control" name="kode" id="kode" placeholder="Isikan kode!" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Uraian</label>
                            <input type="text" class="form-control" name="uraian" id="uraian" placeholder="Isikan uraian!" required>
                        </div>



                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required">Satuan</label>
                                <input type="text" class="form-control" name="satuan" id="satuan" placeholder="Isikan satuan!" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required">Volume Target</label>
                                <input type="text" class="form-control" name="volume_target" id="volume_target" placeholder="Isikan volume target!" required>
                            </div>
                        </div>
                        <!-- <label class="form-label"><br></label>
                        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#pilihpic<?= $mod; ?>">Pilih
                            PIC</button> -->
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-success">Tambah KRO</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- modal tambah KRO end -->

<!-- modal tambah pilih -->
<div class="modal fade" id="pilihedit" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-backdrop="false" data-bs-keyboard="false">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body text-center py-4">

                <div class="mb-3">
                    <button class="btn btn-outline-primary" style="width:200px;" data-bs-toggle="modal" data-bs-target="#modalro"> Tambah RO</button>
                </div>
                <div class="mb-3">
                    <button class="btn btn-outline-primary" style="width:200px;" data-bs-toggle="modal" data-bs-target="#modalkomponen"> Tambah Komponen</button>
                </div>
                <div class="mb-3">
                    <button class="btn btn-outline-primary" style="width:200px;" data-bs-toggle="modal" data-bs-target="#modalsubkomponen"> Tambah Subkomponen</button>
                </div>


            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>
<!-- modal tambah pilih end -->

<!-- modal hapus data -->
<div class="modal fade" id="hapusdata" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-backdrop="false" data-bs-keyboard="false">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body text-center py-4">

                <div class="mb-3">
                    <button class="btn btn-outline-danger" style="width:200px;" data-bs-toggle="modal" data-bs-target="#hapus-ro"> Hapus RO</button>
                </div>
                <div class="mb-3">
                    <button class="btn btn-outline-danger" style="width:200px;" data-bs-toggle="modal" data-bs-target="#hapus-komponen"> Hapus Komponen</button>
                </div>
                <div class="mb-3">
                    <button class="btn btn-outline-danger" style="width:200px;" data-bs-toggle="modal" data-bs-target="#hapus-subkomponen"> Hapus Subkomponen</button>
                </div>


            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn" data-bs-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>
<!-- modal hapus data end -->

<!-- modal tambah RO -->
<div class="modal fade" id="modalro" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-backdrop="false" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form action="<?php echo base_url('simproka1/insertSimproka'); ?>" method="POST">
            <?= csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah RO</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="mb-3">
                                <input type="hidden" class="form-control" name="detail" id="detail" value="RO">
                                <label class="form-label required">Kode</label>
                                <input type="text" class="form-control" value="<?= $kode; ?>" disabled>
                                <input type="hidden" class="form-control" name="kro" id="kro" value="<?= $kode; ?>">
                                <input type="hidden" class="form-control" name="kode1" id="kode1" value="<?= $kode; ?>">
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="mb-3">
                                <label class="form-label"><br></label>
                                <input type="text" class="form-control" name="kode2" id="kode2" placeholder="Isikan kode!">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Uraian</label>
                            <input type="text" class="form-control" name="uraian" id="uraian" placeholder="Isikan uraian!">
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required">Satuan</label>
                                <input type="text" class="form-control" name="satuan" id="satuan" placeholder="Isikan satuan!">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required">Volume Target</label>
                                <input type="text" class="form-control" name="volume_target" id="volume_target" placeholder="Isikan volume target!">
                            </div>
                        </div>
                        <!-- <label class="form-label"><br></label>
                        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#pilihpic<?= $mod; ?>">Pilih
                            PIC</button> -->
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#pilihedit">Kembali</button>
                    <button type="submit" class="btn btn-success">Tambah RO</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- modal tambah RO end -->

<!-- modal tambah komponen -->
<div class="modal fade" id="modalkomponen" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-backdrop="false" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Komponen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo base_url('simproka1/insertSimproka'); ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <input type="hidden" class="form-control" name="kro" id="kro" value="<?= $kode; ?>">
                            <input type="hidden" class="form-control" name="detail" id="detail" value="KOMPONEN">
                            <div class="mb-3">
                                <label class="form-label required">Kode</label>
                                <select name="kode1" id="kode1" class="form-control">
                                    <?php foreach ($data as $d) : if (trim($d['detail']) == 'RO') : ?>
                                            <option value="<?= trim($d['kode']); ?>"><?= $d['kode']; ?>
                                            </option>
                                    <?php endif;
                                    endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="mb-3">
                                <label class="form-label"><br></label>
                                <input type="text" class="form-control" name="kode2" id="kode2" placeholder="Isikan kode!">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Uraian</label>
                            <input type="text" class="form-control" name="uraian" id="uraian" placeholder="Isikan uraian!">
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required">Satuan</label>
                                <input type="text" class="form-control" name="satuan" id="satuan" placeholder="Isikan satuan!">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required">Volume Target</label>
                                <input type="text" class="form-control" name="volume_target" id="volume_target" placeholder="Isikan volume target!">
                            </div>
                        </div>
                        <!-- <label class="form-label"><br></label>
                        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#pilihpic<?= $mod; ?>">Pilih
                            PIC</button> -->
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#pilihedit">Kembali</button>
                    <button type="submit" class="btn btn-success">Tambah Komponen</button>
                </div>
        </div>
        </form>
    </div>
</div>
<!-- modal tambah komnponen end -->

<!-- modal tambah subkomponen -->
<div class="modal fade" id="modalsubkomponen" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-backdrop="false" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Subkomponen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo base_url('simproka1/insertSimproka'); ?>" method="POST">
                <div class="modal-body">
                    <div class="row">

                        <input type="hidden" class="form-control" name="detail" id="detail" value="SUBKOMPONEN">
                        <input type="hidden" class="form-control" name="kro" id="kro" value="<?= $kode; ?>">
                        <label class="form-label required">Kode</label>
                        <!-- <input type="text" class="form-control" name="example-text-input" value="DK.4471.CBJ" disabled> -->


                        <div class="col-4">
                            <div class="mb-3">
                                <label class="form-label"><br></label>

                                <select name="kode3" id="kode3" class="form-control">
                                    <?php foreach ($data as $d) : if (trim($d['detail']) == 'RO') : ?>
                                            <option value="<?= trim($d['kode']); ?>">
                                                <?= $d['kode']; ?>
                                            </option>
                                    <?php endif;
                                    endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label class="form-label"><br></label>
                                <select name="kode4" id="kode4" class="form-control">
                                    <?php foreach ($data as $d) : if (trim($d['detail']) == 'KOMPONEN') : ?>
                                            <?php $coba = explode('.', $d['kode']); ?>
                                            <option value="<?= trim($coba[4]); ?>">
                                                <?= $coba[4] ?>
                                            </option>
                                    <?php endif;
                                    endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label class="form-label"><br></label>
                                <!-- <input type="hidden" name="kode1" id="kode2" value=""> -->
                                <input name="kode5" id="kode5" type="text" class="form-control" name="example-text-input" placeholder="Isikan kode!">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Uraian</label>
                            <input name="uraian" id="uraian" type="text" class="form-control" name="example-text-input" placeholder="Isikan uraian!">
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required">Satuan</label>
                                <input name="satuan" id="satuan" type="text" class="form-control" name="example-text-input" placeholder="Isikan satuan!">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required">Volume Target</label>
                                <input name="volume_target" id="volume_target" type="text" class="form-control" name="example-text-input" placeholder="Isikan volume target!">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pilih PIC</label>
                            <select type="text" class="form-select" placeholder="Select a date" id="select-tags-advanced" value="">
                                <option>Admisi</option>
                                <option>Bid Kemahasiswaan dan Alumni</option>
                                <option>BMN</option>
                                <option>LPMPP</option>
                                <option>PPG</option>
                                <option>ULP</option>
                                <option>BID Akademik</option>
                                <option>Keuangan</option>
                                <option>LPPM</option>
                                <option>Rumah Tangga</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#pilihedit">Kembali</button>
                    <button type="submit" class="btn btn-success">Tambah Subkomponen</button>
                </div>

            </form>


        </div>

    </div>

</div>
<!-- modal tambah subkomponen end -->




<!-- Modal hapus -->
<div class="modal fade" id="modal-danger" tabindex="-1" role="dialog" aria-hidden="true">
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
                <h3>Apakah anda yakin?</h3>
                <div class="text-muted">Menghapus semua data? Data yang dihapus <b>tidak</b> bisa dikembalikan.
                </div>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn" data-bs-dismiss="modal">
                    Batal
                </button>

                <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-hapuspw">
                    Hapus semua
                </button>


            </div>
        </div>
    </div>
</div>
<!-- modal hapus end -->

<!-- Modal hapus password -->
<div class="modal fade" id="modal-hapuspw" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <form action="<?php echo base_url('simproka1/deleteAll'); ?> " method="post">
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
                    <h3>Apakah anda benar-benar yakin??</h3>
                    <div class="text-muted">Harap masukkan <b>password admin</b> untuk menlanjutkan penghapusan.
                    </div>
                    <br>
                    <div class="input-group input-group-flat">
                        <input name="password" id="password" type="password" class="form-control" placeholder="Password" autocomplete="off">
                        <span class="input-group-text">
                            <a href="#" class="link-secondary" title="" data-bs-toggle="tooltip" onclick="showPW()" data-bs-original-title="Show password">
                                <!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="12" cy="12" r="2"></circle>
                                    <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7">
                                    </path>
                                </svg>
                            </a>
                        </span>
                    </div>
                    <br>
                    <div class="input-group">
                        <label class="form-check">
                            <input class="form-check-input" type="checkbox" id="hapusDokumen" name="hapusDokumen" value="true">
                            <span class="form-check-label">Hapus beserta dokumen</span>
                        </label>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-danger">
                        Hapus semua
                    </button>
                </div>
            </div>
    </div>
    </form>
</div>
<!-- modal hapus password end -->



<?php $mod = 1;
foreach ($data as $d) :  ?>

    <!-- Modal data dukung -->
    <div class="modal fade" id="doc<?= $mod; ?>" aria-labelledby="EditPK" data-bs-backdrop="static" data-bs-backdrop="false" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Data Dukung</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body card-body">
                    <h5 style="color:red; text-align:left">
                        Unggah file pdf atau foto
                    </h5>
                    <table class="table table-bordered">
                        <?php foreach ($file as $fl) : if ((trim($fl['kode'])) == (trim($d['kode']))) : ?>
                                <tr>
                                    <td>
                                        <h3>
                                            <?= $fl['file']; ?>
                                        </h3>

                                    </td>
                                    <td align=middle style="width: 10px;">
                                        <form action="<?php echo base_url('simproka1/downloadFile'); ?>" method="post" enctype="multipart/form-data">
                                            <button type="submit" class="btn btn-outline-secondary btn-icon" target="_blank">
                                                <input type="hidden" name="id_file" id="id_file" value="<?= $fl['id_file']; ?>">
                                                <input type="hidden" name="lokasi" id="lokasi" value="<?= $fl['lokasi']; ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-bar-to-down" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <line x1="4" y1="20" x2="20" y2="20"></line>
                                                    <line x1="12" y1="14" x2="12" y2="4"></line>
                                                    <line x1="12" y1="14" x2="16" y2="10"></line>
                                                    <line x1="12" y1="14" x2="8" y2="10"></line>
                                                </svg>
                                                <!-- unduh -->
                                            </button>
                                        </form>
                                    </td>
                                    <td style="width: 10px;">
                                        <a href="<?= $fl['lokasi']; ?>" class="btn btn-outline-secondary btn-icon" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                                </path>
                                            </svg>
                                            <!-- Lihat -->
                                        </a>
                                    </td>
                                    <td style="width: 10px;">
                                        <form action="<?php echo base_url('simproka1/deleteDokumen'); ?>" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="kode" id="kode" value="<?= $fl['kode']; ?>">
                                            <input type="hidden" name="detail" id="detail" value="<?= trim($d['detail']) ?>">
                                            <input type="hidden" name="file" id="file" value="<?= $fl['file']; ?>">
                                            <input type="hidden" name="lokasi" id="lokasi" value="<?= $fl['lokasi']; ?>">
                                            <input type="hidden" name="id_file" id="id_file" value="<?= $fl['id_file']; ?>">
                                            <button type="submit" class="btn btn-outline-secondary btn-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M4 7h16"></path>
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                    <path d="M10 12l4 4m0 -4l-4 4"></path>
                                                </svg>
                                                <!-- Hapus -->
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                        <?php endif;
                        endforeach; ?>
                    </table>
                </div>
                <form name="formsubmit" action="<?php echo base_url('simproka1/storeMultipleFile'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-bs-target="#progres<?= $mod; ?>" data-bs-toggle="modal">Kembali</button>
                        <div>
                            <div class="input-group">

                                <input type="hidden" name="detail" id="detail>" value="<?= $d['detail']; ?>">
                                <input type="hidden" name="kode" id="kode>" value="<?= $d['kode']; ?>">
                                <input name="dok[]" id="dok[]" type="file" onchange="validateSize(this)" accept="image/*,.pdf" class="form-control mr-auto" multiple ref="fileref" @change="onChange">
                                <p id="size"></p>
                                <button id="fi  le-submit" type="submit" class="btn btn-success">Submit</button>

                            </div>
                        </div>
                </form>
            </div>
            </form>
        </div>
    </div>
    </div>
    </div>
    <!-- Modal data dukung end -->

    <!-- modal input -->
    <div class="modal fade" id="input<?= $mod; ?>" aria-labelledby="EditKRO" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-backdrop="false" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-scorllable modal-lg modal-dialog-centered" role="document">
            <form action="<?php echo base_url('simproka1/editSimproka'); ?>" method="POST">
                <?= csrf_field(); ?>
                <input type="hidden" name="kode" id="kode" value="<?= $d['kode']; ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Input</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label required">Volume Target</label>
                                    <input class="form-control" id="volume_target" name="volume_target" placeholder="Isikan Volume Target!" value="<?= $d['volume_target']; ?>" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label required">Capaian Volume</label>
                                    <input type="text" class="form-control" id="capaian_volume" name="capaian_volume" placeholder="Isikan Capaian Volume!" value="<?= $d['capaian_volume']; ?>" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label required">Progress</label>
                                <textarea class="form-control" id="progres" name="progres" data-bs-toggle="autosize" placeholder="Isikan Progress!" required><?= $d['progres']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Capaian Rill</label>
                                <textarea class="form-control" id="capaian_rill" name="capaian_rill" data-bs-toggle="autosize" placeholder="Isikan Capaian Rill!" required><?= $d['capaian_rill']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Satuan Rill</label>
                                <textarea class="form-control" id="satuan_rill" name="satuan_rill" data-bs-toggle="autosize" placeholder="Isikan Satuan Rill!" required><?= $d['satuan_rill']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Status</label>
                                <textarea class="form-control" id="status" name="status" data-bs-toggle="autosize" placeholder="Isikan Status!" required><?= $d['status']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Penjelasan</label>
                                <textarea class="form-control" id="penjelasan" name="penjelasan" data-bs-toggle="autosize" placeholder="Isikan Penjelasan!" required><?= $d['penjelasan']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Kendala</label>
                                <textarea class="form-control" id="kendala" name="kendala" data-bs-toggle="autosize" placeholder="Isikan Kendala!" required><?= $d['kendala']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Tindak Lanjut</label>
                                <textarea class="form-control" id="tindak_lanjut" name="tindak_lanjut" data-bs-toggle="autosize" placeholder="Isikan Tindak Lanjut!" required><?= $d['tindak_lanjut']; ?></textarea>
                            </div>


                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- modal input end -->



    <!-- modal edit -->
    <div class="modal fade" id="editkro<?= $mod; ?>" aria-labelledby="EditKRO" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-backdrop="false" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-scorllable modal-lg modal-dialog-centered" role="document">
            <form action="<?php echo base_url('simproka1/editSimproka'); ?>" method="POST">
                <?= csrf_field(); ?>
                <input type="hidden" name="kode" id="kode" value="<?= $d['kode']; ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-10">
                                <div class="mb-3">
                                    <label class="form-label required">Kode</label>
                                    <input class="form-control" id="newKode" name="newKode" value="<?= $d['kode']; ?>" disabled>
                                </div>
                            </div>
                            <!-- <div class="col-2">
                                <div class="mb-3">
                                    <label class="form-label"><br></label>
                                    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#pilihpic<?= $mod; ?>">Pilih PIC</button>
                                </div>
                            </div> -->
                            <div class="mb-3">
                                <label class="form-label required">Uraian</label>
                                <textarea class="form-control" id="uraian" name="uraian" data-bs-toggle="autosize"><?= $d['uraian']; ?></textarea>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label required">Satuan</label>
                                    <input class="form-control" id="satuan" name="satuan" value="<?= $d['satuan']; ?>">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label required">Volume Target</label>
                                    <input class="form-control" id="volume_target" name="volume_target" placeholder="Isikan Volume Target!" value="<?= $d['volume_target']; ?>" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label required">Capaian Volume</label>
                                    <input type="text" class="form-control" id="capaian_volume" name="capaian_volume" placeholder="Isikan Capaian Volume!" value="<?= $d['capaian_volume']; ?>" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label required">Progress</label>
                                <textarea class="form-control" id="progres" name="progres" data-bs-toggle="autosize" placeholder="Isikan Progress!" required><?= $d['progres']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Capaian Rill</label>
                                <textarea class="form-control" id="capaian_rill" name="capaian_rill" data-bs-toggle="autosize" placeholder="Isikan Capaian Rill!" required><?= $d['capaian_rill']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Satuan Rill</label>
                                <textarea class="form-control" id="satuan_rill" name="satuan_rill" data-bs-toggle="autosize" placeholder="Isikan Satuan Rill!" required><?= $d['satuan_rill']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Status</label>
                                <textarea class="form-control" id="status" name="status" data-bs-toggle="autosize" placeholder="Isikan Status!" required><?= $d['status']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Penjelasan</label>
                                <textarea class="form-control" id="penjelasan" name="penjelasan" data-bs-toggle="autosize" placeholder="Isikan Penjelasan!" required><?= $d['penjelasan']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Kendala</label>
                                <textarea class="form-control" id="kendala" name="kendala" data-bs-toggle="autosize" placeholder="Isikan Kendala!" required><?= $d['kendala']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Tindak Lanjut</label>
                                <textarea class="form-control" id="tindak_lanjut" name="tindak_lanjut" data-bs-toggle="autosize" placeholder="Isikan Tindak Lanjut!" required><?= $d['tindak_lanjut']; ?></textarea>
                            </div>


                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- modal edit end -->

    <!-- modal edit lama -->
    <div class="modal fade" id="" aria-labelledby="EditKRO" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm">
            <form action="<?php echo base_url('simproka1/editSimproka'); ?>" method="POST">
                <?= csrf_field(); ?>
                <input type="hidden" name="kode" id="kode" value="<?= $d['kode']; ?>">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tr>
                                    <td valign="middle" width="20px"> <b>Kode</b></td>
                                    <td> <input class="form-control" id="newKode" name="newKode" value="<?= $d['kode']; ?>" disabled></td>
                                </tr>
                                <tr>
                                    <td valign="middle" width="20px"> <b>Uraian</b></td>
                                    <td> <textarea class="form-control" id="uraian" name="uraian" data-bs-toggle="autosize"><?= $d['uraian']; ?></textarea></td>
                                </tr>
                                <tr>
                                    <td valign="middle"> <b>Satuan</b></td>
                                    <td> <input class="form-control" id="satuan" name="satuan" value="<?= $d['satuan']; ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="middle"> <b>Volume Target</b></td>
                                    <td> <input class="form-control" id="volume_target" name="volume_target" placeholder="Isikan Volume Target!" value="<?= $d['volume_target']; ?>" required></td>
                                </tr>
                                <tr>

                                    <td valign="middle"> <b>PIC</b></td>

                                    <!-- <td align=left>
                                        <button class="btn" data-bs-toggle="modal" data-bs-target="#pilihpic<?= $mod; ?>">
                                            Pilih PIC</button>
                                    </td> -->

                                </tr>
                                <tr>
                                    <td valign="middle"><b>Capaian Volume</b></td>
                                    <td> <input type="text" class="form-control" id="capaian_volume" name="capaian_volume" placeholder="Isikan Capaian Volume!" value="<?= $d['capaian_volume']; ?>" required> </td>

                                </tr>
                                <tr>
                                    <td valign="middle"><b>Progres</b></td>
                                    <td> <textarea class="form-control" id="progres" name="progres" data-bs-toggle="autosize" placeholder="Isikan Progress!" required><?= $d['progres']; ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="middle"><b>Capaian Rill</b></td>
                                    <td> <textarea class="form-control" id="capaian_rill" name="capaian_rill" data-bs-toggle="autosize" placeholder="Isikan Capaian Rill!" required><?= $d['capaian_rill']; ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="middle"><b>Satuan Rill</b></td>
                                    <td> <textarea class="form-control" id="capaian_rill" name="capaian_rill" data-bs-toggle="autosize" placeholder="Isikan Satuan Rill!" required> </textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="middle"><b>Status</b></td>
                                    <td> <textarea class="form-control" id="status" name="status" data-bs-toggle="autosize" placeholder="Isikan Status!" required><?= $d['status']; ?></textarea></td>
                                </tr>
                                <tr>
                                    <td valign="middle"><b>Penjelasan</b></td>
                                    <td> <textarea class="form-control" id="penjelasan" name="penjelasan" data-bs-toggle="autosize" placeholder="Isikan Penjelasan!" required><?= $d['penjelasan']; ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="middle"><b>Kendala</b></td>
                                    <td> <textarea class="form-control" id="kendala" name="kendala" data-bs-toggle="autosize" placeholder="Isikan Kendala!" required><?= $d['kendala']; ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="middle"><b>Tindak Lanjut</b></td>
                                    <td> <textarea class="form-control" id="tindak_lanjut" name="tindak_lanjut" data-bs-toggle="autosize" placeholder="Isikan Tindak Lanjut!" required><?= $d['tindak_lanjut']; ?></textarea>
                                    </td>
                                </tr>
                            </table>
                            <!-- tabel -->
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn btn-success">Simpan
                            Perubahan</button>
                    </div>
                </div>
        </div>
    </div>
    </form>
    <!-- end modal edit lama -->

    <!-- modal pilih PIC -->
    <div class="modal fade" id="pilihpic<?= $mod; ?>" aria-labelledby="EditPK" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <h2>Pilih PIC</h2>
                    <table class="table table-bordered table-hover">
                        <div class="form-label">Pilih PIC</div>
                        <div>
                            <tr>
                                <td> <label class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                        <span class="form-check-label">Admisi</span>
                                    </label> </td>
                                <td> <label class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                        <span class="form-check-label">Bid Akademik</span>
                                    </label> </td>
                            </tr>
                            <tr>
                                <td> <label class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                        <span class="form-check-label">Bid Kemahasiswaan dan Alumni</span>
                                    </label></td>
                                <td> <label class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                        <span class="form-check-label">Bid Perencanaan dan Kerjasama</span>
                                    </label></td>
                            </tr>
                            <tr>
                                <td><label class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                        <span class="form-check-label">BMN</span>
                                    </label></td>
                                <td><label class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                        <span class="form-check-label">Keuangan</span>
                                    </label></td>
                            </tr>
                            <tr>
                                <td><label class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                        <span class="form-check-label">LPMPP</span>
                                    </label></td>
                                <td><label class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                        <span class="form-check-label">LPPM</span>
                                    </label></td>
                            </tr>
                            <tr>
                                <td><label class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                        <span class="form-check-label">PPG</span>
                                    </label></td>
                                <td><label class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                        <span class="form-check-label">Rumah Tangga</span>
                                    </label></td>
                            </tr>
                            <tr>
                                <td><label class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                        <span class="form-check-label">ULP</span>
                                    </label></td>
                        </div>
                </div>
                <!-- <tr>
                        <td>DK.4470.BEI.001.004</td>
                        <td align="middle">
                            <button class="btn btn-outline-success">
                                Pilih
                            </button>
                        </td>
                    </tr> -->

                </table>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#editkro<?= $mod; ?>">Kembali</button>
                <button type="submit" class="btn btn-success">Simpan
                    Perubahan</button>
            </div>
        </div>
    </div>
    </div>

    <!-- end modal pilih PIC -->
<?php $mod++;
endforeach; ?>

<!-- modal hapus KRO11 -->
<div class="modal fade" id="hapuskro1" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-backdrop="false" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?php echo base_url('simproka1/deleteSimproka'); ?>" method="POST">

                <div class="modal-header">
                    <h5 class="modal-title">Hapus KRO</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <input type="hidden" name="detail" id="detail" value="KRO">
                        <label class="form-label">Pilih KRO</label>
                        <select type="text" class="form-select tomselected ts-hidden-accessible" placeholder="Select a date" id="kode" name="kode" tabindex="-1">
                            <?php foreach ($data as $d) : ?>
                                <option value="<?= trim($d['kode']); ?>">
                                    <?= $d['kode']; ?>
                                </option>
                            <?php endforeach; ?>
                            <!-- <option value="JavaScript">JavaScript</option>
                              <option value="CSS">CSS</option>
                              <option value="jQuery">jQuery</option>
                              <option value="Bootstrap">Bootstrap</option>
                              <option value="Ruby">Ruby</option>
                              <option value="Python">Python</option> -->
                            <!-- <option value="HTML">HTML</option></select> -->
                        </select>
                    </div>
                </div>


                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn" data-bs-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-danger">Hapus KRO</button>
                </div>
            </form>
        </div>

    </div>

</div>

<!-- modal hapus KRO11 end -->

<!-- modal hapus RO -->
<div class="modal fade" id="hapus-ro" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-backdrop="false" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?php echo base_url('simproka1/deleteSimproka'); ?>" method="POST">

                <div class="modal-header">
                    <h5 class="modal-title">Hapus RO</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <input type="hidden" name="detail" id="detail" value="RO">
                        <?php if (isset($kode)) { ?>
                            <input type="hidden" name="kro" id="kro" value=<?= trim($kode); ?>>
                        <?php }  ?>
                        <label class="form-label"> RO</label>
                        <select type="text" class="form-select tomselected ts-hidden-accessible" placeholder="Select a date" id="kode" name="kode" tabindex="-1">
                            <?php foreach ($data as $d) : ?>
                                <?php if ((trim($d['detail']) == 'RO')) { ?>
                                    <option value="<?= trim($d['kode']); ?>">
                                        <?= $d['kode']; ?>
                                    </option>
                                <?php
                                }  ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>


                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#hapusdata">Kembali</button>
                    <button type="submit" class="btn btn-danger">Hapus RO</button>
                </div>
            </form>
        </div>

    </div>

</div>

<!-- modal hapus RO end -->

<!-- modal hapus komponen -->
<div class="modal fade" id="hapus-komponen" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-backdrop="false" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?php echo base_url('simproka1/deleteSimproka'); ?>" method="POST">

                <div class="modal-header">
                    <h5 class="modal-title">Hapus Komponen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <input type="hidden" name="detail" id="detail" value="KOMPONEN">
                        <?php if (isset($kode)) { ?>
                            <input type="hidden" name="kro" id="kro" value=<?= trim($kode); ?>>
                        <?php }  ?>
                        <label class="form-label"> Komponen</label>
                        <select type="text" class="form-select tomselected ts-hidden-accessible" placeholder="Select a date" id="kode" name="kode" tabindex="-1">
                            <?php foreach ($data as $d) : ?>
                                <?php if ((trim($d['detail']) == 'KOMPONEN')) { ?>
                                    <option value="<?= trim($d['kode']); ?>">
                                        <?= $d['kode']; ?>
                                    </option>
                                <?php
                                }  ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>


                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#hapusdata">Kembali</button>
                    <button type="submit" class="btn btn-danger">Hapus Komponen</button>
                </div>
            </form>
        </div>

    </div>

</div>

<!-- modal hapus komponen end -->

<!-- modal hapus subkomponen -->
<div class="modal fade" id="hapus-subkomponen" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-backdrop="false" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?php echo base_url('simproka1/deleteSimproka'); ?>" method="POST">

                <div class="modal-header">
                    <h5 class="modal-title">Hapus Subkomponen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <input type="hidden" name="detail" id="detail" value="SUBKOMPONEN">
                        <?php if (isset($kode)) { ?>
                            <input type="hidden" name="kro" id="kro" value=<?= trim($kode); ?>>
                        <?php }  ?>
                        <label class="form-label"> Subkomponen</label>
                        <select type="text" class="form-select tomselected ts-hidden-accessible" placeholder="Select a date" id="kode" name="kode" tabindex="-1">
                            <?php foreach ($data as $d) : ?>
                                <?php if ((trim($d['detail']) == 'SUBKOMPONEN')) { ?>
                                    <option value="<?= trim($d['kode']); ?>">
                                        <?= $d['kode']; ?>
                                    </option>
                                <?php }  ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>


                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#hapusdata">Kembali</button>
                    <button type="submit" class="btn btn-danger">Hapus Subkomponen</button>
                </div>
            </form>
        </div>

    </div>

</div>

<!-- modal hapus subkomponen end -->


<!-- modal kalender -->
<div class="modal fade" id="modaltanggal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-backdrop="false" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

        <form action="<?php echo base_url('simproka1/setDate'); ?>" method="POST">
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
                                    <input class="form-control" placeholder="Pilih tanggal buka..." id="tanggal_buka" name="tanggal_buka" value="<?= $tanggal; ?>">
                                </div>
                            </div>
                            <div class="mb-3">

                                <input type="time" name="waktu_buka" class="form-control" data-mask="00:00" data-mask-visible="true" placeholder="00 : 00" autocomplete="off">
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
                                    <input class="form-control" placeholder="Pilih tanggal tutup..." id="tanggal_tutup" name="tanggal_tutup" value="<?= $tanggal; ?>">
                                </div>
                            </div>
                            <div class="mb-3">

                                <input type="time" name="waktu_tutup" class="form-control" data-mask="00:00" data-mask-visible="true" placeholder="00 : 00" autocomplete="off">
                            </div>


                        </div>

                    </div>
        </form>
    </div>


    <div class="modal-footer justify-content-between">
        <button type="button" class="btn" data-bs-dismiss="modal">Keluar</button>
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </div>
</div>

</form>
</div>

</div>

<!-- modal kalender end -->

<?= $this->include('layout/footer'); ?>