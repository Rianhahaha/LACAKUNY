<?= $this->include('layout/header'); ?>
<?= $this->include('layout/sidebarKinerja'); ?>
<!-- copy dibawah ini yan -->

<div class="page scroll">
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card card-stacked">
                    <div class="card-body">
                        <!-- validation upload file -->
                        <?php $validation = \Config\Services::validation(); ?>
                        <?php if (!empty(session()->getFlashdata('pesan'))) { ?>
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
                        <table width="100%">
                            <tbody>
                                <tr>
                                    <td width=50% style='vertical-align: middle;'>
                                        <p>
                                        <h1 class="card-title">Pengukuran Kinerja Per Triwulan</h1>
                                        </p>
                                    </td>
                                    <p valign='right'>
                                        <td>
                                            <form action="kinerja/downloadFormat" method="get">
                                                <?= csrf_field(); ?>
                                                <!-- <a href="/uploads/file/Format_Pengukuran_Kinerja_Triwulan_2022.xlsx" download > -->
                                                <button type="submit" class="btn btn-success">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-description" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                                        </path>
                                                        <path d="M9 17h6"></path>
                                                        <path d="M9 13h6"></path>
                                                    </svg> Download Format tabel
                                                </button>
                                                <!-- </a> -->
                                            </form>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                            <form action="<?php echo base_url('kinerja2/readExcelCreate'); ?>" method="post" enctype="multipart/form-data">
                                                <?= csrf_field(); ?>

                                                <div class="input-group">

                                                    <input type="file" class="form-control <?= ($validation->hasError('excel')) ? 'is-invalid' : ''; ?>" id="excel" aria-describedby="inputGroupFileAddon04" name="excel" aria-label="Upload">

                                                    <button class="btn btn-outline-secondary " type="submit" id="inputGroupFileAddon04" value="Upload">Create</button>
                                                </div>
                                    </p>
                                    </form>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        <form action="<?php echo base_url('kinerja2/readExcel'); ?>" method="post" enctype="multipart/form-data">
                                            <?= csrf_field(); ?>

                                            <div class="input-group">

                                                <input type="file" class="form-control <?= ($validation->hasError('excel')) ? 'is-invalid' : ''; ?>" id="excel" aria-describedby="inputGroupFileAddon04" name="excel" aria-label="Upload">

                                                <button class="btn btn-outline-secondary " type="submit" id="inputGroupFileAddon04" value="Upload">Update</button>
                                            </div>
                                            </p>
                                        </form>
                                    </td>
                                </tr>
                                <a class="btn btn-dark" data-bs-toggle="offcanvas" href="#offcanvasStart" role="button" aria-controls="offcanvasStart">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <polyline points="7 7 12 12 7 17"></polyline>
                                        <polyline points="13 7 18 12 13 17"></polyline>
                                    </svg>
                                    Menu Kinerja
                                </a>



                            </tbody>
                        </table>
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr valign=middle class="text-center text- text-light bg-dark">
                                            <td rowspan=2>
                                                No
                                            </td>
                                            <td rowspan=2>
                                                Sasaran Kinerja (SK)
                                            </td>
                                            <td rowspan=2>
                                                Indikator kinerja Kegiatan (IKK) </td>
                                            <td rowspan=2>
                                                Target PK
                                            </td>
                                            <td rowspan=2>
                                                Target TW
                                            </td>
                                            <td rowspan=2>
                                                Capaian TW
                                            </td>
                                            <td rowspan=2>
                                                Persentase Capaian TW
                                            </td>
                                            <td rowspan=2>
                                                Analisis Progress Capaian Tri Wulan
                                            </td>
                                            <td colspan=2>
                                                Data Dukung Capaian
                                            </td>
                                            <td rowspan=2>
                                                PIC
                                            </td>
                                            <td rowspan=2>
                                                Komentar
                                            </td>
                                            <td rowspan=2>

                                            </td>

                                        <tr class="text-center text-light bg-dark">

                                            <td>Dokumen</td>
                                            <td>Foto kegiatan</td>
                                    </thead>

                                    <!-- isi tabel 1 -->
                                    <tbody>
                                        <!-- $i untuk increment rowspan, $x increment nomor, $y increment target modal -->
                                        <?php $admin = false;
                                        $i = 1;
                                        $y = 1;
                                        foreach ($coba as $d) :
                                            if (($id == 1230) || ($admin == true)) {
                                                $id = $d['id_pengguna'];
                                                $admin = true;
                                            }

                                            if ($d['id_pengguna'] == $id) : ?>

                                                <tr valign=middle>
                                                    <td class='text-center' rowspan='<?= $i; ?>'>
                                                        <?= $d['id_ik']; ?>
                                                    </td>
                                                    <td class='text-left' rowspan='<?= $i; ?>'>
                                                        <?= $d['sk']; ?>
                                                    </td>
                                                    <td class='text-left'>
                                                        <?= $d['indikator']; ?>
                                                    </td>
                                                    <td class='text-center'>
                                                        <?= $d['target_pk']; ?>
                                                    </td>
                                                    <td class='text-center'>
                                                        <?= $d['target_tw']; ?>
                                                    </td>
                                                    <td class='text-center'>
                                                        <?= $d['capaian']; ?>
                                                    </td>
                                                    <td class='text-center'>
                                                        <?= $d['presentase']; ?>
                                                    </td>

                                                    <td align=middle>
                                                        <!-- Analisis TW -->
                                                        <span class="btn btn-primary btn" data-bs-toggle="modal" data-bs-target="#det<?= $y; ?>">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tdetaildocabler icon-tabler-list-details" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                                </path>
                                                                <path d="M13 5h8"></path>
                                                                <path d="M13 9h5"></path>
                                                                <path d="M13 15h8"></path>
                                                                <path d="M13 19h5"></path>
                                                                <rect x="3" y="4" width="6" height="6" rx="1"></rect>
                                                                <rect x="3" y="14" width="6" height="6" rx="1"></rect>
                                                            </svg>
                                                            detail
                                                        </span>

                                                    </td>
                                                    <td align=middle>
                                                        <!-- Dokumen -->
                                                        <span class="btn btn-primary btn" data-bs-toggle="modal" data-bs-target="#doc<?= $y; ?>">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-import" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                                </path>
                                                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                                <path d="M5 13v-8a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5.5m-9.5 -2h7m-3 -3l3 3l-3 3">
                                                                </path>
                                                            </svg>
                                                            1
                                                        </span>
                                                    </td>
                                                    <td align=middle>
                                                        <!-- foto -->

                                                        <span class="btn btn-primary btn" data-bs-toggle="modal" data-bs-target="#foto<?= $y; ?>">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-camera-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                                </path>
                                                                <circle cx="12" cy="13" r="3"></circle>
                                                                <path d="M5 7h2a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h2m9 7v7a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2">
                                                                </path>
                                                                <line x1="15" y1="6" x2="21" y2="6"></line>
                                                                <line x1="18" y1="3" x2="18" y2="9"></line>
                                                            </svg>
                                                            1

                                                        </span>


                                                    </td>
                                                    <td class='text-center'>
                                                        <?= $d['pic']; ?>
                                                    </td>
                                                    </td>
                                                    <td class='text-center'>
                                                        <?= $d['komentar']; ?>
                                                    </td>

                                                    <td rowspan=1>
                                                        <a class="form-control" data-bs-toggle="modal" data-bs-target="#pic<?= $y; ?>">

                                                            Edit
                                                        </a>

                                                    </td>
                                            <?php $y++;
                                            endif;
                                        endforeach; ?>


                                            <!-- end isi tabel -->
                                    </tbody>
                                </table>
                                <!-- tambah tabel -->
                                <button class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-plus" width="30" height="30" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <rect x="4" y="4" width="16" height="16" rx="2"></rect>
                                        <line x1="9" y1="12" x2="15" y2="12"></line>
                                        <line x1="12" y1="9" x2="12" y2="15"></line>
                                    </svg>
                                    Tambah tabel
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Modal det1 -->
                    <!-- $i untuk increment id-->
                    <?= $i = 1; ?>
                    <?php foreach ($coba as $d) :
                        if (($id == 1230) || ($admin == true)) {
                            $id = $d['id_pengguna'];
                            $admin = true;
                        }
                        if ($d['id_pengguna'] == $id) : ?>
                            <div class="modal fade" id="det<?= $i; ?>" aria-labelledby="EditPK" data-bs-backdrop="static" data-bs-keyboard="false">
                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <h2> Analisis Progress Capaian Triwulan </h2>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <h3><?= $d['pic']; ?> </h3>

                                                    <tr valign=middle class="text-center text- text-light bg-dark">
                                                        <td>
                                                            Progress
                                                        </td>
                                                        <td>
                                                            Kendala
                                                        </td>
                                                        <td>
                                                            Strategi
                                                        </td>
                                                        <td>

                                                        </td>
                                                    </tr>
                                                </thead>
                                                <!-- isi tabel 1 -->
                                                <form action="<?php echo base_url('kinerja2/saveCapaian'); ?>" method="POST">
                                                    <?= csrf_field(); ?>
                                                    <tbody>
                                                        <input type="hidden" name="id<?= $i; ?>" id="id<?= $i; ?>" value="<?= $d['id_pengguna']; ?>">
                                                        <input type="hidden" name="iku<?= $i; ?>" id="iku<?= $i; ?>" value="<?= $d['iku']; ?>">
                                                        <input type="hidden" name="index" id="index" value="<?= $i; ?>">
                                                        <td>
                                                            <textarea name="progres<?= $i; ?>" id="progres<?= $i; ?>" class="form-control" data-bs-toggle="autosize"> <?= $d['progres']; ?></textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="kendala<?= $i; ?>" id="kendala<?= $i; ?>" class="form-control" data-bs-toggle="autosize"> <?= $d['kendala']; ?> </textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="strategi<?= $i; ?>" id="strategi<?= $i; ?>" class="form-control" data-bs-toggle="autosize"> <?= $d['strategi']; ?> </textarea>
                                                        </td>
                                                    </tbody>
                                            </table>

                                        </div>

                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                                            <button type="submit" class="btn btn-success">Simpan
                                                Perubahan</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Modal pic1 -->
                            <div class="modal fade" id="pic<?= $i; ?>" aria-labelledby="EditPK" data-bs-backdrop="static" data-bs-keyboard="false">
                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <table class="table table-bordered">

                                                <form action="<?php echo base_url('kinerja2/editIKK'); ?>" method="post" enctype="multipart/form-data">
                                                    <?= csrf_field(); ?>
                                                    <thead>
                                                        <h3> <?= $d['pic']; ?> </h3>
                                                        <tr valign=middle class="text-center text- text-light bg-dark">
                                                            <td style="width:50%;">
                                                                Indikator kinerja Kegiatan (IKK) </td>
                                                            <td>
                                                                Target PK
                                                            </td>
                                                            <td>
                                                                Target PW
                                                            </td>
                                                            <td>
                                                                Capaian TW
                                                            </td>
                                                            <td>
                                                                Persentase Capaian TW(%)
                                                            </td>
                                                            <td style="width:50%;">
                                                                Komentar
                                                            </td>
                                                        </tr>
                                                    </thead>
                                                    <!-- isi tabel 1 -->
                                                    <tbody>
                                                        <input type="hidden" name="id<?= $i; ?>" id="id<?= $i; ?>" value="<?= $d['id_pengguna']; ?>">
                                                        <input type="hidden" name="iku<?= $i; ?>" id="iku<?= $i; ?>" value="<?= $d['iku']; ?>">
                                                        <input type="hidden" name="index" id="index" value="<?= $i; ?>">
                                                        <td>
                                                            <!-- IKK -->
                                                            <textarea name="ikk<?= $i; ?>" id="ikk<?= $i; ?>" class="form-control" data-bs-toggle="autosize"> <?= $d['indikator']; ?></textarea>
                                                        </td>
                                                        <td class="position:relative">
                                                            <!-- Target PK -->
                                                            <input name="target_pk<?= $i; ?>" id="target_pk<?= $i; ?>" class="form-control" placeholder="<?= $d['target_pk']; ?>">

                                                        </td>
                                                        <td>
                                                            <!-- Target TW -->
                                                            <input name="target_tw<?= $i; ?>" id="target_tw<?= $i; ?>" class="form-control" placeholder=" <?= $d['target_tw']; ?>">

                                                        </td>
                                                        <td>
                                                            <!-- Capaian TW -->
                                                            <input name="capaian_tw<?= $i; ?>" id="capaian_tw<?= $i; ?>" class="form-control" placeholder="<?= $d['capaian']; ?>">

                                                        </td>
                                                        <td>
                                                            <!-- Persentase TW -->
                                                            <input name="presentase_tw<?= $i; ?>" id="presentase_tw<?= $i; ?>" class="form-control" placeholder=" <?= $d['presentase']; ?>">

                                                        </td>
                                                        <td>
                                                            <!-- Komentar -->
                                                            <textarea name="komentar<?= $i; ?>" id="komentar<?= $i; ?>" class="form-control" data-bs-toggle="autosize"></textarea>
                                                        </td>
                                                    </tbody>
                                            </table>

                                        </div>

                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                                            <button type="submit" class="btn btn-success">Simpan
                                                Perubahan</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal pic1 end -->
                            <!-- Modal foto1 -->
                            <div class="modal fade" id="foto<?= $i; ?>" aria-labelledby="EditPK" data-bs-backdrop="static" data-bs-keyboard="false">
                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-body card-body">
                                            <h3><?= $d['pic']; ?></h3>
                                            <table class="table table-bordered">
                                                <?php $iku = $d['iku'];
                                                $odd = 1;
                                                $x = 1;
                                                foreach ($foto as $f) :
                                                    if (($f['id_pengguna'] == $id) && ($f['iku'] == $iku)) : ?>
                                                        <?php if ($odd == 1) { ?>
                                                            <tr align=middle>
                                                                <td>
                                                                    <div>
                                                                        <img class="img" style="height:300px" src="<?= $f['lokasi']; ?>" alt="<?= $f['foto']; ?>">
                                                                    </div>
                                                                    <form action="<?php echo base_url('kinerja2/deleteImage'); ?>" method="post" enctype="multipart/form-data">
                                                                        <div class="input-group">
                                                                            <input type="hidden" name="id_pengguna<?= $x; ?>" id="id_pengguna<?= $x; ?>" value="<?= $d['id_pengguna']; ?>">
                                                                            <input type="hidden" name="id_ft<?= $x; ?>" id="id_ft<?= $x; ?>" value="<?= $f['id_ft']; ?>">
                                                                            <input type="hidden" name="iku<?= $x; ?>" id="iku<?= $x; ?>" value="<?= $d['iku']; ?>">
                                                                            <input type="hidden" name="tahun<?= $x; ?>" id="tahun<?= $x; ?>" value="<?= $d['tahun']; ?>">
                                                                            <input type="hidden" name="index" id="index" value="<?= $x; ?>">
                                                                            <input type="hidden" name="lokasi<?= $x; ?>" id="lokasi<?= $x; ?>" value="<?= $f['lokasi']; ?>">
                                                                            <input type="hidden" name="foto<?= $x; ?>" id="foto<?= $x; ?>" value="<?= $f['foto']; ?>">
                                                                            <button type="submit" class="btn btn-outline-secondary">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                                    <path d="M4 7h16"></path>
                                                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                                                    <path d="M10 12l4 4m0 -4l-4 4"></path>
                                                                                </svg>
                                                                                Hapus
                                                                            </button>
                                                                    </form>
                                                                </td>
                                                            <?php $odd = 0;
                                                        } else {  ?>
                                                                <td>
                                                                    <div>
                                                                        <img class="img" style="height:300px" src="<?= $f['lokasi']; ?>" alt="<?= $f['foto']; ?>">
                                                                    </div>
                                                                    <form action="<?php echo base_url('kinerja2/deleteImage'); ?>" method="post" enctype="multipart/form-data">
                                                                        <div class="input-group">
                                                                            <input type="hidden" name="id_pengguna<?= $x; ?>" id="id_pengguna<?= $x; ?>" value="<?= $d['id_pengguna']; ?>">
                                                                            <input type="hidden" name="id_ft<?= $x; ?>" id="id_ft<?= $x; ?>" value="<?= $f['id_ft']; ?>">
                                                                            <input type="hidden" name="iku<?= $x; ?>" id="iku<?= $x; ?>" value="<?= $d['iku']; ?>">
                                                                            <input type="hidden" name="tahun<?= $x; ?>" id="tahun<?= $x; ?>" value="<?= $d['tahun']; ?>">
                                                                            <input type="hidden" name="index" id="index" value="<?= $x; ?>">
                                                                            <input type="hidden" name="lokasi<?= $x; ?>" id="lokasi<?= $x; ?>" value="<?= $f['lokasi']; ?>">
                                                                            <input type="hidden" name="foto<?= $x; ?>" id="foto<?= $x; ?>" value="<?= $f['foto']; ?>">
                                                                            <button type="submit" class="btn btn-outline-secondary">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                                    <path d="M4 7h16"></path>
                                                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                                                    <path d="M10 12l4 4m0 -4l-4 4"></path>
                                                                                </svg>
                                                                                Hapus
                                                                            </button>
                                                                    </form>
                                                                </td>
                                                            </tr><?php $odd = 1;
                                                                }
                                                            endif;
                                                            $x++;
                                                        endforeach ?>
                                            </table>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                                            <div>
                                                <form action="<?php echo base_url('kinerja2/storeMultipleImage'); ?>" method="post" enctype="multipart/form-data">
                                                    <div class="input-group">
                                                        <input type="hidden" name="id<?= $i; ?>" id="id<?= $i; ?>" value="<?= $d['id_pengguna']; ?>">
                                                        <input type="hidden" name="iku<?= $i; ?>" id="iku<?= $i; ?>" value="<?= $d['iku']; ?>">
                                                        <input type="hidden" name="tahun<?= $i; ?>" id="tahun<?= $i; ?>" value="<?= $d['tahun']; ?>">
                                                        <input type="hidden" name="index" id="index" value="<?= $i; ?>">
                                                        <input name="foto<?= $i; ?>[]" id="foto<?= $i; ?>[]" type="file" class="form-control mr-auto" multiple>
                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
                <!-- Modal foto1 end -->
                <!-- Modal doc1 -->
                <div class="modal fade" id="doc<?= $i; ?>" aria-labelledby="EditPK" data-bs-backdrop="static" data-bs-keyboard="false">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-body card-body">
                                <h3><?= $d['pic']; ?> </h3>
                                <table class="table table-bordered">
                                    <?php $x = 1;
                                    foreach ($doc as $dc) :
                                        if (($dc['id_pengguna'] == $id) && ($dc['iku'] == $iku)) : ?>
                                            <tr align=middle>
                                                <td>
                                                    <h2><?= $dc['dokumen']; ?></h2>
                                                    <div>
                                                        <object data="<?= $dc['lokasi']; ?>" type="application/pdf" width="600" height="678"></object>
                                                    </div>
                                                    <form action="<?php echo base_url('kinerja2/deleteDokumen'); ?>" method="post" enctype="multipart/form-data">
                                                        <input type="hidden" name="id_pengguna<?= $x; ?>" id="id_pengguna<?= $x; ?>" value="<?= $d['id_pengguna']; ?>">
                                                        <input type="hidden" name="id_dk<?= $x; ?>" id="id_dk<?= $x; ?>" value="<?= $dc['id_dk']; ?>">
                                                        <input type="hidden" name="iku<?= $x; ?>" id="iku<?= $x; ?>" value="<?= $d['iku']; ?>">
                                                        <input type="hidden" name="tahun<?= $x; ?>" id="tahun<?= $x; ?>" value="<?= $d['tahun']; ?>">
                                                        <input type="hidden" name="index" id="index" value="<?= $x; ?>">
                                                        <input type="hidden" name="lokasi<?= $x; ?>" id="lokasi<?= $x; ?>" value="<?= $dc['lokasi']; ?>">
                                                        <input type="hidden" name="doc<?= $x; ?>" id="doc<?= $x; ?>" value="<?= $dc['dokumen']; ?>">
                                                        <button type="submit" class="btn btn-outline-secondary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M4 7h16"></path>
                                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                                <path d="M10 12l4 4m0 -4l-4 4"></path>
                                                            </svg>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                    <a href="<?= $dc['lokasi']; ?>" class="btn btn-outline-secondary" target="_blank">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                                        </svg>
                                                        Lihat
                                                    </a>

                                                </td>
                                            </tr>
                                    <?php endif;
                                        $x++;
                                    endforeach ?>
                                </table>
                            </div>

                            <form action="<?php echo base_url('kinerja2/storeMultipleFile'); ?>" method="POST" enctype="multipart/form-data">
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                                    <div>
                                        <div class="input-group">
                                            <input type="hidden" name="id<?= $i; ?>" id="id<?= $i; ?>" value="<?= $d['id_pengguna']; ?>">
                                            <input type="hidden" name="iku<?= $i; ?>" id="iku<?= $i; ?>" value="<?= $d['iku']; ?>">
                                            <input type="hidden" name="tahun<?= $i; ?>" id="tahun<?= $i; ?>" value="<?= $d['tahun']; ?>">
                                            <input type="hidden" name="index" id="index" value="<?= $i; ?>">
                                            <input name="doc<?= $i; ?>[]" id="doc<?= $i; ?>[]" type="file" class="form-control mr-auto" multiple>
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal doc1 end -->
    <?php $i++;
                        endif;
                    endforeach; ?>


    <!-- tabel -->
        </div>
    </div>
</div>
</div>
</div>
<script>
    autosize();

    function autosize() {
        var text = $('.autosize');

        text.each(function() {
            $(this).attr('rows', 1);
            resize($(this));
        });

        text.on('input', function() {
            resize($(this));
        });

        function resize($text) {
            $text.css('height', 'auto');
            $text.css('height', $text[0].scrollHeight + 'px');
        }
    }
</script>




<!-- batas -->
<?= $this->include('layout/footer'); ?>