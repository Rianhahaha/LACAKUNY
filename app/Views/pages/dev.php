<?= $this->include('layout/header'); ?>
<!-- copy dibawah ini yan -->

<div class="page scroll">
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!-- validation upload file -->
                        <?php $validation = \Config\Services::validation();?>
                        <?php if (!empty(session()->getFlashdata('pesan'))) { ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                        <?php } ?>
                        <?php if($validation->hasError('excel')) {?>
                        <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('excel'); ?>
                        </div>
                        <?php } $validation->reset();?>
                        <!-- end validation -->
                        <!-- Header -->
                        <h2 class="page-title"> Pengukuran Kinerja Triwulan
                            <?= $sistem; ?> Tahun
                            <?= $tahun; ?>
                        </h2>
                        <!-- <h3> 2022 </h3> -->
                        </td>
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col">
                                    <!-- Page pre-title -->
                                    <form action="kinerja1/aksesData" method="get">
                                        <div class="page-pretitle">Pilih Triwulan</div>
                                        <div class="btn-group">
                                            <select name="sistem" class="form-control" placeholder="Pilih Tahun">
                                                <option value="1" <?=$sistem=='1' ? 'selected' :'' ?>>Triwulan 1
                                                </option>
                                                <option value="2" <?=$sistem=='2' ? 'selected' :'' ?>>Triwulan 2
                                                </option>
                                                <option value="3" <?=$sistem=='3' ? 'selected' :'' ?>>Triwulan 3
                                                </option>
                                                <option value="4" <?=$sistem=='4' ? 'selected' :'' ?>>Triwulan 4
                                                </option>
                                            </select>
                                            <button class="btn btn-outline-secondary"> Pilih </button>
                                        </div>
                                    </form>
                                </div>
                                <?php $admin=false; $koor=false;
                                foreach ($user as $usr => $value){
                                    if(trim($value['status'])=='ADMIN'){
                                        $admin=true;
                                    }else if(trim($value['status'])=='KOOR'){
                                        $koor=true;
                                    }
                                } ?>
                                <?php if($admin==true):?>
                                <!-- Page title actions -->
                                <div class="col-12 col-md-auto">
                                    <div class="btn-list">
                                        <form action="<?php echo base_url('kinerja1/readExcel'); ?>" method="post"
                                            enctype="multipart/form-data">
                                            <?= csrf_field(); ?>
                                            <div class="input-group">
                                                <input type="file"
                                                    accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                                                    class="form-control  <?= ($validation->hasError('excel'))?'is-invalid':'';?>"
                                                    id="excel" aria-describedby="inputGroupFileAddon04" name="excel"
                                                    aria-label="Upload">
                                                <button class="btn btn-outline-secondary  " type="submit"
                                                    id="inputGroupFileAddon04" value="Upload">Submit</button>
                                                <!-- <button class="btn btn-outline-secondary d-sm-none"  onclick="document.getElementById('excel').click()">Upload Excel</button>
                                                <input type='file' 
                                                        class="form-control d-none d-sm-inline-block "
                                                    id="excel" aria-describedby="inputGroupFileAddon04" name="excel"
                                                    aria-label="Upload" style="display:none">  -->
                                            </div>
                                        </form>
                                        <div>
                                            <form action="kinerja1/downloadFormat" method="get">
                                                <?= csrf_field(); ?>
                                                <!-- <a href="/uploads/file/Format_Pengukuran_Kinerja_Triwulan_2022.xlsx" download > -->
                                                <button type="submit" class="btn btn-success d-none d-sm-inline-block">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-file-import" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                        <path
                                                            d="M5 13v-8a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5.5m-9.5 -2h7m-3 -3l3 3l-3 3">
                                                        </path>
                                                    </svg>
                                                    Download Format tabel
                                                </button>
                                                <button type="submit" class="btn btn-success d-sm-none btn-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-file-import" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                        <path
                                                            d="M5 13v-8a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5.5m-9.5 -2h7m-3 -3l3 3l-3 3">
                                                        </path>
                                                    </svg>
                                                </button>
                                                <!-- </a> -->
                                            </form>
                                        </div>
                                        <div>
                                            <form action="kinerja1/writeExcel" method="get">
                                                <?= csrf_field(); ?>
                                                <button type="submit" class="btn btn-primary d-none d-sm-inline-block">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-file-import" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                        <path
                                                            d="M5 13v-8a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5.5m-9.5 -2h7m-3 -3l3 3l-3 3">
                                                        </path>
                                                    </svg>
                                                    Export
                                                </button>
                                                <button type="submit" class="btn btn-primary d-sm-none btn-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-file-import" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                        <path
                                                            d="M5 13v-8a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5.5m-9.5 -2h7m-3 -3l3 3l-3 3">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>

                                        <div>
                                            <button href="kinerja1/delete"
                                                class="btn btn-danger d-none d-sm-inline-block" data-bs-toggle="modal"
                                                data-bs-target="#modal-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-trash-x" width="24" height="24"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M4 7h16"></path>
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12">
                                                    </path>
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                    <path d="M10 12l4 4m0 -4l-4 4"></path>
                                                </svg>
                                                Hapus semua
                                            </button>
                                            <button href="kinerja1/delete" class="btn btn-danger d-sm-none btn-icon"
                                                data-bs-toggle="modal" data-bs-target="#modal-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-trash-x" width="24" height="24"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M4 7h16"></path>
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12">
                                                    </path>
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                    <path d="M10 12l4 4m0 -4l-4 4"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr style="height: 100px;" valign=middle
                                        class="text-center text- text-light bg-dark">
                                        <td rowspan=2>
                                            No
                                        </td>
                                        <td rowspan=2>
                                            Kode SK
                                        </td>
                                        <td rowspan=2>
                                            Sasaran Kinerja (SK)
                                        </td>
                                        <td rowspan=2>
                                            Kode IKU
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
                                        <td rowspan=2>
                                            PIC
                                        </td>
                                        <td rowspan=2>
                                            Komentar
                                        </td>
                                        <td rowspan=2>
                                            #
                                        </td>
                                        <td rowspan=2>
                                            Status Validasi
                                        </td>

                                </thead>

                                <!-- isi tabel 1 -->
                                <tbody>
                                    <!-- $i untuk increment rowspan, $x increment nomor, $mod increment target modal -->
                                    <?php $i=1 ;$idx=1; $number=1 ;foreach ($data as $dat=>$value) : 
                                        foreach ($value as $val => $d) {
                                            $mod=$idx;

                            
                            // if($d['id_pengguna']==$id_pengguna):?>

                                    <tr valign=middle>
                                        <td class='text-center'>
                                            <?= $number; ?>
                                        </td>
                                        <td class='text-left'>
                                            <?= $d['kode_sk']; ?>
                                        </td>
                                        <td class='text-left'>
                                            <?= $d['sk']; ?>
                                        </td>
                                        <td class='text-left'>
                                            <?= $d['iku']; ?>
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
                                            <!-- progress -->
                                            <span class="btn btn-outline-primary" id="btn-progres<?$mod;?>"
                                                data-bs-toggle="modal" style="width:90px;"
                                                data-bs-target="#progres<?=$mod;?>">
                                                Progress
                                            </span>
                                            <span class="btn btn-outline-primary" id="btn-kendala<?$mod;?>"
                                                data-bs-toggle="modal" style="width:90px;"
                                                data-bs-target="#kendala<?=$mod;?>">
                                                Kendala
                                            </span>
                                            <span class="btn btn-outline-primary" data-bs-toggle="modal"
                                                style="width:90px;" data-bs-target="#strategi<?=$mod;?>">
                                                Strategi
                                            </span>
                                        </td>

                                        <td class='text-center'>
                                            <?= $d['pic']; ?>
                                        </td>
                                        <td class='text-center'>
                                            <?= $d['komentar']; ?>
                                        </td>

                                        <td rowspan=1>
                                            <a class="btn btn-outline-primary" data-bs-toggle="modal"
                                                data-bs-target="#pic<?=$mod;?>">
                                                Edit
                                            </a>
                                        </td>
                                        <td align=middle>
                                            <?php if(($admin==true)){
                                                if(trim($d['status'])=='validasi'){?>



                                            <form action="<?php echo base_url('kinerja1/setStatus'); ?>" method="POST">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="id<?=$idx;?>" id="id<?=$idx;?>"
                                                    value="<?= $d['id_pengguna']; ?>">
                                                <input type="hidden" name="iku<?=$idx;?>" id="iku<?=$idx;?>"
                                                    value="<?= $d['iku']; ?>">
                                                <input type="hidden" name="status<?=$idx;?>" id="status<?=$idx;?>"
                                                    value="selesai">
                                                <input type="hidden" name="index" id="index" value="<?=$idx;?>">
                                                <button id="AS" class="btn btn-success" style="width:90px;"
                                                    onclick="valid()">
                                                    Validasi</button>
                                            </form>
                                            <form action="<?php echo base_url('kinerja1/setStatus'); ?>" method="POST">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="id<?=$idx;?>" id="id<?=$idx;?>"
                                                    value="<?= $d['id_pengguna']; ?>">
                                                <input type="hidden" name="iku<?=$idx;?>" id="iku<?=$idx;?>"
                                                    value="<?= $d['iku']; ?>">
                                                <input type="hidden" name="status<?=$idx;?>" id="status<?=$idx;?>"
                                                    value="revisi">
                                                <input type="hidden" name="index" id="index" value="<?=$idx;?>">
                                                <button id="AA" class="btn btn-danger" style="width:90px;"
                                                    onclick="rev()">
                                                    Tolak</button>
                                            </form>
                                            <?php }else if(trim($d['status'])=='selesai'){ ?>
                                            <button id="AS" class="btn btn-success" disabled>
                                                <?= $d['status']; ?>
                                            </button>
                                                <button id="AA" class="btn btn-danger" style="width:90px;" data-bs-toggle="modal" data-bs-target="#modal-batal<?=$idx;?>">
                                                    Batalkan</button>
                                            </form>
                                            <?php }else if(trim($d['status'])=='revisi'){ ?>
                                            <button id="AS" class="btn btn-danger" disabled>
                                                <?= $d['status']; ?>
                                            </button>
                                            <?php }else { ?>
                                            <button id="AS" class="btn btn-primary" disabled>
                                                <?= $d['status']; ?>
                                            </button>
                                            <?php } ?>
                                            <?php                         // $id_pengguna=$d['id_pengguna'];
                                                               
                                                            }  ?>

                                            <?php if($admin==false){
                                        ?>
                                            <?php if(trim($d['status'])=='selesai'){ ?>
                                            <button id="AS" class="btn btn-success" disabled>
                                                <?= $d['status']; ?>
                                            </button>
                                            <?php }else if(trim($d['status'])=='validasi'){ ?>
                                            <button id="AS" class="btn btn-warning" disabled>
                                                <?= $d['status']; ?>
                                            </button>
                                            <?php }else if(trim($d['status'])=='revisi'){ ?>
                                            <button id="AS" class="btn btn-danger" disabled>
                                                <?= $d['status']; ?>
                                            </button>
                                            <?php }else{ ?>
                                            <button id="AS" class="btn btn-primary" disabled>
                                                <?= $d['status']; ?>
                                            </button>
                                            <?php } ?>

                                            <?php                         // $id_pengguna=$d['id_pengguna'];
                                        } if($koor==true){ ?>

                                            <?php if((trim($d['status'])!='selesai')&&(trim($d['status'])!='validasi')){ ?>
                                            <button type="submit" id="AS<?=$idx;?>" class="btn btn-outline-yellow"
                                                style="width:90px;" data-bs-toggle="modal"
                                                data-bs-target="#modal-valid<?=$idx;?>" <?php
                                                if(($d['presentase']==0)||($totalFile[$d['iku']]==0)||($d['komentar']==''
                                                )): ?> disabled
                                                <?php endif; ?>>
                                                Ajukan
                                            </button>
                                            <?php } }?>

                                            <!-- Modal batalkan -->
                                            <div class="modal fade" id="modal-batal<?=$idx;?>" tabindex="-1"
                                                role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-sm modal-dialog-centered"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                        <div class="modal-status bg-danger"></div>
                                                        <div class="modal-body text-center py-4">
                                                            <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="icon mb-2 text-danger icon-lg" width="24"
                                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M12 9v2m0 4v.01" />
                                                                <path
                                                                    d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                                                            </svg>
                                                            <h3>Apakah anda yakin?</h3>
                                                            <div class="text-muted">Dengan ini, status validasi akan berubah</div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="submit" class="btn btn-outline-secondary"
                                                                data-bs-dismiss="modal">
                                                                Kembali
                                                            </button>
                                                            <form action="<?php echo base_url('kinerja1/setStatus'); ?>"
                                                                method="POST">
                                                                <?= csrf_field(); ?>
                                                                <input type="hidden" name="id<?=$idx;?>"
                                                                    id="id<?=$idx;?>" value="<?= $d['id_pengguna']; ?>">
                                                                <input type="hidden" name="iku<?=$idx;?>"
                                                                    id="iku<?=$idx;?>" value="<?= $d['iku']; ?>">
                                                                <input type="hidden" name="status<?=$idx;?>"
                                                                    id="status<?=$idx;?>" value="validasi">
                                                                <input type="hidden" name="index" id="index"
                                                                    value="<?=$idx;?>">
                                                                
                                                                    <form action="<?php echo base_url('kinerja1/setStatus'); ?>" method="POST">
                                                                        <?= csrf_field(); ?>
                                                                        <input type="hidden" name="id<?=$idx;?>" id="id<?=$idx;?>"
                                                                            value="<?= $d['id_pengguna']; ?>">
                                                                        <input type="hidden" name="iku<?=$idx;?>" id="iku<?=$idx;?>"
                                                                            value="<?= $d['iku']; ?>">
                                                                        <input type="hidden" name="status<?=$idx;?>" id="status<?=$idx;?>"
                                                                            value="revisi">
                                                                        <input type="hidden" name="index" id="index" value="<?=$idx;?>">
                                                                        <button id="AA" class="btn btn-danger" style="width:90px;"
                                                                            onclick="rev()">
                                                                            Batalkan</button>
                                                                    </form>
                                                                
                                                            </form>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- modal batalkan end -->

                                            <!-- Modal valid -->
                                            <div class="modal fade" id="modal-valid<?=$idx;?>" tabindex="-1"
                                                role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-sm modal-dialog-centered"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                        <div class="modal-status bg-danger"></div>
                                                        <div class="modal-body text-center py-4">
                                                            <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="icon mb-2 text-danger icon-lg" width="24"
                                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M12 9v2m0 4v.01" />
                                                                <path
                                                                    d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                                                            </svg>
                                                            <h3>Apakah anda yakin?</h3>
                                                            <div class="text-muted">Dengan ini, kami menyatakan bahwa
                                                                data dan informasi yang disampaikan adalah benar dan
                                                                sudah melalui proses verifikasi dan validasi, terhitung
                                                                mulai tanggal ketika data dan informasi tersebut
                                                                terunggah.</div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="submit" class="btn btn-outline-secondary"
                                                                data-bs-dismiss="modal">
                                                                Batal
                                                            </button>
                                                            <form action="<?php echo base_url('kinerja1/setStatus'); ?>"
                                                                method="POST">
                                                                <?= csrf_field(); ?>
                                                                <input type="hidden" name="id<?=$idx;?>"
                                                                    id="id<?=$idx;?>" value="<?= $d['id_pengguna']; ?>">
                                                                <input type="hidden" name="iku<?=$idx;?>"
                                                                    id="iku<?=$idx;?>" value="<?= $d['iku']; ?>">
                                                                <input type="hidden" name="status<?=$idx;?>"
                                                                    id="status<?=$idx;?>" value="validasi">
                                                                <input type="hidden" name="index" id="index"
                                                                    value="<?=$idx;?>">
                                                                
                                                                <button type="submit" id="AS<?=$idx;?>" class="btn btn-danger"
                                                                    style="width:90px;" >
                                                                    
                                                                    Ajukan
                                                                </button>
                                                                
                                                            </form>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- modal valid end -->

                                            <!-- end isi tabel -->

                                            <!-- modal kendala -->
                                            <div class="modal fade" id="kendala<?=$mod;?>" aria-labelledby="EditPK"
                                                data-bs-backdrop="static" data-bs-keyboard="false">
                                                <div
                                                    class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <table>
                                                                <form
                                                                    action="<?php echo base_url('kinerja1/saveDetail'); ?>"
                                                                    method="post" enctype="multipart/form-data">
                                                                    <?= csrf_field(); ?>

                                                                    <h2 style="text-align:left">
                                                                        <?= $d['pic'];?>
                                                                    </h2>
                                                                    <h3 style="text-align:left">
                                                                        Kendala
                                                                    </h3>
                                                                    <input type="hidden" name="id<?=$idx;?>"
                                                                        id="id<?=$idx;?>"
                                                                        value="<?= $d['id_pengguna']; ?>">
                                                                    <input type="hidden" name="iku<?=$idx;?>"
                                                                        id="iku<?=$idx;?>" value="<?= $d['iku']; ?>">
                                                                    <input type="hidden" name="index" id="index"
                                                                        value="<?=$idx;?>">
                                                                    <!-- IKK -->
                                                                    <textarea name="kendala<?=$idx;?>" id="kendala<?=$idx;?>"
                                                                        class="form-control" data-bs-toggle="autosize"
                                                                        placeholder="isikan kendala..." <?php
                                                            if((trim($d['status'])=='selesai')||(trim($d['status'])=='validasi')){ ?> disabled
                                                            <?php } ?>><?= $d['kendala']; ?></textarea>
                                                            </table>
                                                        </div>

                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-danger"
                                                                data-bs-dismiss="modal">Keluar</button>
                                                                <?php if((trim($d['status'])!='selesai')&&(trim($d['status'])!='validasi')){ ?>
                                                            <button type="submit" class="btn btn-success">Simpan
                                                                Perubahan</button>
                                                                <?php } ?>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal kendala end -->

                                            <!-- modal strategi -->
                                            <div class="modal fade" id="strategi<?=$mod;?>" aria-labelledby="EditPK"
                                                data-bs-backdrop="static" data-bs-keyboard="false">
                                                <div
                                                    class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <table>

                                                                <form
                                                                    action="<?php echo base_url('kinerja1/saveDetail'); ?>"
                                                                    method="post" enctype="multipart/form-data">
                                                                    <?= csrf_field(); ?>

                                                                    <h2 style="text-align:left">
                                                                        <?= $d['pic'];?>
                                                                    </h2>
                                                                    <h3 style="text-align:left">
                                                                        Strategi
                                                                    </h3>


                                                                    <input type="hidden" name="id<?=$idx;?>"
                                                                        id="id<?=$idx;?>"
                                                                        value="<?= $d['id_pengguna']; ?>">
                                                                    <input type="hidden" name="iku<?=$idx;?>"
                                                                        id="iku<?=$idx;?>" value="<?= $d['iku']; ?>">
                                                                    <input type="hidden" name="index" id="index"
                                                                        value="<?=$idx;?>">
                                                                    <!-- IKK -->
                                                                    <textarea name="strategi<?=$idx;?>" id="stretegi<?=$idx; ?>"
                                                                        class="form-control" data-bs-toggle="autosize"
                                                                        placeholder="isikan strategi" <?php
                                                            if((trim($d['status'])=='selesai')||(trim($d['status'])=='validasi')){ ?> disabled
                                                            <?php } ?>><?= $d['strategi']; ?></textarea>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-danger"
                                                                data-bs-dismiss="modal">Keluar</button>
                                                                <?php if((trim($d['status'])!='selesai')&&(trim($d['status'])!='validasi')){ ?>
                                                        
                                                            <button type="submit" class="btn btn-success">Simpan
                                                                Perubahan</button>
                                                                <?php } ?>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal strategi end -->

                                            <!-- Modal pic1 -->
                                            <div class="modal fade" id="pic<?=$mod;?>" aria-labelledby="EditPK"
                                                data-bs-backdrop="static" data-bs-keyboard="false">
                                                <div
                                                    class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <table class="table table-bordered">
                                                                <form
                                                                    action="<?php echo base_url('kinerja1/editIKK'); ?>"
                                                                    method="post" enctype="multipart/form-data">
                                                                    <?= csrf_field(); ?>
                                                                    <thead>
                                                                        <h3 style="text-align:left">
                                                                            <?= $d['pic'];?>
                                                                        </h3>
                                                                        <h5 style="color:red; text-align:left">
                                                                            Semua isian termasuk komentar wajib diisi!
                                                                        </h5>
                                                                        <tr valign=middle
                                                                            class="text-center text- text-light bg-dark">
                                                                            <?php if($admin==true){?>
                                                                            <td style="width:50%;" >
                                                                                Indikator kinerja Kegiatan (IKK) </td>
                                                                            <td>
                                                                                Target PK
                                                                            </td>
                                                                            <?php } ?>
                                                                            <td>
                                                                                Target PW
                                                                            </td>
                                                                            <td>
                                                                                Capaian TW
                                                                            </td>
                                                                            <!-- <td>
                                                    Persentase Capaian TW(%)
                                                </td> -->
                                                                            <td style="width:50%;">
                                                                                Komentar
                                                                            </td>
                                                                        </tr>
                                                                    </thead>
                                                                    <!-- isi tabel 1 -->
                                                                    <tbody>
                                                                        <input type="hidden" name="id<?=$idx;?>"
                                                                            id="id<?=$idx;?>"
                                                                            value="<?= $d['id_pengguna']; ?>">
                                                                        <input type="hidden" name="iku<?=$idx;?>"
                                                                            id="iku<?=$idx;?>"
                                                                            value="<?= $d['iku']; ?>">
                                                                        <input type="hidden" name="index" id="index"
                                                                            value="<?=$idx;?>">
                                                                        <tr>
                                                                            <?php if($admin==true){?>
                                                                            <td>
                                                                                <!-- IKK -->
                                                                                <textarea name="ikk<?=$idx;?>"
                                                                                    id="ikk<?=$idx;?>"
                                                                                    class="form-control"
                                                                                    data-bs-toggle="autosize"
                                                                                    <?php if((trim($d['status'])=='selesai')||(trim($d['status'])=='validasi')){ ?> disabled
                                                                                    <?php } ?>> <?= $d['indikator']; ?></textarea>
                                                                            </td>
                                                                            <td class="position:relative">
                                                                                <!-- Target PK -->
                                                                                <input name="target_pk<?=$idx;?>"
                                                                                    id="target_pk<?=$idx;?>"
                                                                                    class="form-control"
                                                                                    placeholder="<?= $d['target_pk']; ?>"
                                                                                    <?php if((trim($d['status'])=='selesai')||(trim($d['status'])=='validasi')){ ?> disabled
                                                                                    <?php } ?>>

                                                                            </td>
                                                                            <?php } ?>
                                                                            <td>
                                                                                <!-- Target TW -->
                                                                                <input name="target_tw<?=$idx;?>"
                                                                                    id="target_tw<?=$idx;?>"
                                                                                    class="form-control"
                                                                                    placeholder=" <?= $d['target_tw']; ?>"
                                                                                    <?php if((trim($d['status'])=='selesai')||(trim($d['status'])=='validasi')){ ?> disabled
                                                                                    <?php } ?>>

                                                                            </td>
                                                                            <td>
                                                                                <!-- Capaian TW -->
                                                                                <input name="capaian_tw<?=$idx;?>"
                                                                                    id="capaian_tw<?=$idx;?>"
                                                                                    class="form-control"
                                                                                    placeholder="<?= $d['capaian']; ?>"
                                                                                    <?php if((trim($d['status'])=='selesai')||(trim($d['status'])=='validasi')){ ?> disabled
                                                                                    <?php } ?>>

                                                                            </td>
                                                                            <td>
                                                                                <!-- Komentar -->
                                                                                <textarea name="komentar<?=$idx;?>"
                                                                                    id="komentar<?=$idx;?>"
                                                                                    class="form-control"
                                                                                    data-bs-toggle="autosize"
                                                                                    <?php if((trim($d['status'])=='selesai')||(trim($d['status'])=='validasi')){ ?> disabled
                                                                                    <?php } ?>> <?= $d['komentar']; ?></textarea>
                                                                            </td>

                                                                            <!-- </tr>
                                            <tr>
                                                <td  colspan="4">
                                                <textarea name="deskripsi<?=$idx;?>" id="deskripsi<?=$idx;?>"
                                                    class="form-control" data-bs-toggle="autosize" placeholder="Berikan keterangan disini!"  ><?= $d['deskripsi']?>;</textarea>
                                                </td>
                                            </tr> -->
                                                                    </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-danger"
                                                                data-bs-dismiss="modal">Keluar</button>
                                                                <?php if((trim($d['status'])!='selesai')&&(trim($d['status'])!='validasi')){ ?>
                                                            <button type="submit" class="btn btn-success">Simpan
                                                                Perubahan</button>
                                                                <?php } ?>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal pic1 end -->
                                              <!-- Modal data dukung -->
                                              <div class="modal fade" id="doc<?=$mod;?>" aria-labelledby="EditPK" data-bs-backdrop="static" data-bs-backdrop="false"
                                                data-bs-keyboard="false">
                                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-body card-body">
                                                            <h2 style="text-align:left">
                                                                Data Dukung
                                                            </h2>
                                                            <h3 style="text-align:left">
                                                                <?= $d['pic'];?>
                                                            </h3>
                                                            <h5 style="color:red; text-align:left">
                                                                  Unggah file pdf atau foto
                                                            </h5>
                                                            <table class="table table-bordered">
                                                                <?php $x=1; foreach
                                                                            ($doc as $dc) : 
                                                                                    if(($dc['iku']==$d['iku'])):?>
                                                                <tr>
                                                                    <td>
                                                                        <h3>
                                                                            <?= $dc['dokumen']; ?>
                                                                        </h3>

                                                                    </td>
                                                                    <td align=middle style="width: 10px;">
                                                                        <form action="<?php echo base_url('Kinerja1/downloadFile');?>" method="post"
                                                                                enctype="multipart/form-data">
                                                                                <input type="hidden" name="id_dk<?=$x;?>" id="id_dk<?=$x;?>"
                                                                                    value="<?= $dc['id_dk']; ?>">
                                                                                <input type="hidden" name="index" id="index" value="<?=$x;?>">
                                                                                <input type="hidden" name="lokasi<?=$x;?>" id="lokasi<?=$x;?>"
                                                                                    value="<?= $dc['lokasi']; ?>">
                                                                            <button type="submit"class="btn btn-outline-secondary btn-icon"
                                                                                target="_blank">
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
                                                                            <a href="<?= $dc['lokasi']; ?>" class="btn btn-outline-secondary btn-icon"
                                                                                target="_blank">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    class="icon icon-tabler icon-tabler-file" width="24" height="24"
                                                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                                                    <path
                                                                                        d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                                                                    </path>
                                                                                </svg>
                                                                                <!-- Lihat -->
                                                                            </a>
                                                                        </td>
                                                                    <td style="width: 10px;">
                                                                        <form action="<?php echo base_url('Kinerja1/deleteDokumen');?>" method="post"
                                                                            enctype="multipart/form-data">
                                                                            <input type="hidden" name="id_pengguna<?=$x;?>" id="id_pengguna<?=$x;?>"
                                                                                value="<?= $d['id_pengguna']; ?>">
                                                                            <input type="hidden" name="id_dk<?=$x;?>" id="id_dk<?=$x;?>"
                                                                                value="<?= $dc['id_dk']; ?>">
                                                                            <input type="hidden" name="iku<?=$x;?>" id="iku<?=$x;?>"
                                                                                value="<?= $d['iku']; ?>">
                                                                            <input type="hidden" name="tahun<?=$x;?>" id="tahun<?=$x;?>"
                                                                                value="<?= $d['tahun']; ?>">
                                                                            <input type="hidden" name="index" id="index" value="<?=$x;?>">
                                                                            <input type="hidden" name="lokasi<?=$x;?>" id="lokasi<?=$x;?>"
                                                                                value="<?= $dc['lokasi']; ?>">
                                                                            <input type="hidden" name="dok<?=$x;?>" id="dok<?=$x;?>"
                                                                                value="<?= $dc['dokumen']; ?>">
                                                                            <button type="submit" class="btn btn-outline-secondary btn-icon">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    class="icon icon-tabler icon-tabler-trash-x" width="24" height="24"
                                                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
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
                                                                <?php endif; $x++;endforeach?>
                                                            </table>
                                                        </div>
                                                        <form name="formsubmit" action="<?php echo base_url('Kinerja1/storeMultipleFile'); ?>"
                                                        method="POST" enctype="multipart/form-data">
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-danger" data-bs-target="#progres<?=$mod;?>" data-bs-toggle="modal">Kembali</button>
                                                            <div>
                                                                <div class="input-group">
                                                                    <input type="hidden" name="id<?=$i;?>" id="id<?=$i;?>"
                                                                    value="<?= $d['id_pengguna']; ?>">
                                                                        <input type="hidden" name="iku<?=$i;?>" id="iku<?=$i;?>"
                                                                            value="<?= $d['iku']; ?>">
                                                                        <input type="hidden" name="tahun<?=$i;?>" id="tahun<?=$i;?>"
                                                                        value="<?= $d['tahun']; ?>">
                                                                        <input type="hidden" name="index" id="index" value="<?=$i;?>">
                                                                        <?php if((trim($d['status'])!='selesai')&&(trim($d['status'])!='validasi')){ ?>
                                                                        <input name="dok[]" id="dok[]" type="file" onchange="validateSize(this)" accept="image/*,.pdf"
                                                                        class="form-control mr-auto" multiple ref="fileref" @change="onChange">
                                                                        <p id="size"></p>
                                                                        <button id="file-submit" type="submit" class="btn btn-success">Submit</button>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                        </form>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal data dukung end -->

                                         <!-- Modal hapus -->
                                         <div class="modal fade" id="modal-danger" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        <div class="modal-status bg-danger"></div>
                                                        <div class="modal-body text-center py-4">
                                                            <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24"
                                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M12 9v2m0 4v.01" />
                                                                <path
                                                                    d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                                                            </svg>
                                                            <h3>Apakah anda yakin?</h3>
                                                            <div class="text-muted">Menghapus semua data? Data yang dihapus <b>tidak<b> bisa dikembalikan.</div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="submit" class="btn" data-bs-dismiss="modal">
                                                                Batal
                                                            </button>
                                                            <form action="<?php echo base_url('Kinerja1/deleteAll');?>" method="post">
                                                                <button type="submit" class="btn btn-danger">
                                                                    Hapus semua
                                                                </button>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- modal hapus end -->

                                            <!--modal progres-->
                                            <div class="modal fade" id="progres<?=$mod;?>" aria-labelledby="EditPK"
                                                data-bs-backdrop="static" data-bs-keyboard="false">
                                                <div
                                                    class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <h2 style="text-align:left"> Analisis Progress Capaian
                                                                Triwulan </h2>
                                                            <table class="table table-bordered table">
                                                                <thead>
                                                                    <h3 style="text-align:left">
                                                                        <?= $d['pic']; ?>
                                                                    </h3>
                                                                    <h5 style="color:red; text-align:left ">
                                                                        Semua isian termasuk dokumen wajib diisi!
                                                                    </h5>

                                                                    <tr valign=middle
                                                                        class="text-center text- text-light bg-dark">
                                                                        <td width=90%>
                                                                            Progress
                                                                        </td>
                                                                        <td>
                                                                            Data dukung
                                                                        </td>
                                                                    </tr>
                                                                </thead>
                                                                <!-- isi tabel 1 -->
                                                                <form
                                                                    action="<?php echo base_url('kinerja1/saveDetail'); ?>"
                                                                    method="POST">
                                                                    <?= csrf_field(); ?>
                                                                    <tbody>
                                                                        <input type="hidden" name="id<?=$idx;?>"id="id<?=$idx;?>"value="<?= $d['id_pengguna']; ?>">
                                                                        <input type="hidden" name="iku<?=$idx;?>"id="iku<?=$idx;?>" value="<?= $d['iku']; ?>">
                                                                        <input type="hidden" name="index" id="index" value="<?=$idx;?>">
                                                                        <td>
                                                                            <textarea name="progres<?=$idx;?>"
                                                                                id="progres<?=$idx;?>"
                                                                                class="form-control"
                                                                                data-bs-toggle="autosize"
                                                                                <?php if((trim($d['status'])=='selesai')||(trim($d['status'])=='validasi')){ ?> disabled
                                                                                <?php } ?>> <?= $d['progres'];?></textarea>
                                                                        </td>
                                                                        <!-- data dukung -->
                                                                        <td valign=middle align=middle>
                                                                            <span class="btn btn-outline-primary"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#doc<?=$mod; ?>">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"class="icon icon-tabler icon-tabler-file-description"
                                                                                    width="24" height="24"viewBox="0 0 24 24" stroke-width="2"stroke="currentColor" fill="none"
                                                                                    stroke-linecap="round" stroke-linejoin="round"><path stroke="none"d="M0 0h24v24H0z" fill="none"></path>
                                                                                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                                                                    <path d="M9 17h6"></path>
                                                                                    <path d="M9 13h6"></path>
                                                                                </svg>
                                                                                <?= $totalFile[$d['iku']]; ?>
                                                                            </span>
                                                                        </td>
                                                                    </tbody>
                                                            </table>
                                                            <!-- keterangan -->
                                                            <?php if($admin==true){ ?>
                                                            <div style="text-align:left" class="page-pretitle">
                                                                Keterangan</div>
                                                            <textarea name="deskripsi<?=$idx;?>"
                                                                id="deskripsi<?=$idx;?>" class="form-control"
                                                                data-bs-toggle="autosize"
                                                                placeholder="Isikan keterangan untuk PIC!"><?php if(!empty(trim($d['deskripsi']))){?><?=$d['deskripsi'];}?></textarea>
                                                        </div>
                                                        <?php }  if(($admin==false)&&(!empty(trim($d['deskripsi'])))){ ?>
                                                        <div style="text-align:left" class="page-pretitle">Keterangan
                                                        </div>
                                                        <div style="text-align:left">
                                                            <?= $d['deskripsi'];?>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">Keluar</button>
                                                        <button type="submit" class="btn btn-success" <?php
                                                            if((($totalFile[$d['iku']]==0)&&$admin!=true)){ ?> disabled
                                                            <?php } ?>>Simpan
                                                            Perubahan
                                                        </button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- modal progress end -->
                                          
                                            <?php $idx++; $i++;$number++; } endforeach; ?>
                                        </td>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <?php $i=1 ;$idx=1; $number=1 ;foreach ($data as $dat=>$value) : 
foreach ($value as $val => $d) {
    $mod=$idx;

                            
                            // if($d['id_pengguna']==$id_pengguna):?>

                <?php $idx++; $i++;$number++; } endforeach; ?>

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






<!-- batas -->
<?= $this->include('layout/footer'); ?>