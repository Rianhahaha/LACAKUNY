<?php $admin=false; $koor=false;
                                foreach ($user as $usr => $value){
                                    if(trim($value['status'])=='ADMIN'){
                                        $admin=true;
                                    }else if(trim($value['status'])=='KOOR'){
                                        $koor=true;
                                    }
                                } ?>
<table id="tabel" class="table table-bordered table-hover">
                                <?php if(empty($data)){ ?>
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col">
                                                <br><br>
                                                <h1>Data Pengukuran Kinerja Triwulan <?= $sistem; ?> Tahun <?= $tahun;?> masih kosong!</h1>
                                                <a>Jika sudah memasuki tanggal pengisian kinerja triwulan <?= $sistem; ?> namun data masih kosong, silahkan hubungi <b> admin</b>. <br> Terima Kasih...</a>
                                                <br><br><br>    
                                            </div>
                                        </div>
                                    </div>
                                <?php } else{ ?>
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
                                <?php } ?>
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
                                            <a class="btn btn-ghost-primary" data-bs-toggle="modal"
                                                data-bs-target="#pic<?=$mod;?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                    <path d="M16 5l3 3"></path>
                                                </svg> Edit
                                            </a>
                                        </td>
                                        <td align=middle>
                                            <?php if(($admin==true)){
                                                if(trim($d['status'])=='validasi'){?>



                                            <form action="<?php echo base_url('kinerja/setStatus'); ?>" method="POST">
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
                                            <form action="<?php echo base_url('kinerja/setStatus'); ?>" method="POST">
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
                                            <button id="AS" class="btn btn-success btn-icon" disabled>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M5 12l5 5l10 -10"></path>
                                            </svg>
                                            </button>
                                                <button id="AA" class="btn btn-danger btn-icon"  data-bs-toggle="modal" data-bs-target="#modal-batal<?=$idx;?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg>       
                                            </button>
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
                                                            <form action="<?php echo base_url('kinerja/setStatus'); ?>"
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
                                                                
                                                                    <form action="<?php echo base_url('kinerja/setStatus'); ?>" method="POST">
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
                                                            <form action="<?php echo base_url('kinerja/setStatus'); ?>"
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
                                                    class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"> Analisis Progress Capaian Triwulan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                        <div class="modal-body" style="text-align:left">
                                                            <table>
                                                                <form
                                                                    action="<?php echo base_url('kinerja/saveDetail'); ?>"
                                                                    method="post" enctype="multipart/form-data">
                                                                    <?= csrf_field(); ?>
                                                                    <h2 class="page-pretitle" style="text-align:left">
                                                                        <?= $d['pic'];?>
                                                                    </h2>
                                                                    <input type="hidden" name="id<?=$idx;?>"
                                                                        id="id<?=$idx;?>"
                                                                        value="<?= $d['id_pengguna']; ?>">
                                                                    <input type="hidden" name="iku<?=$idx;?>"
                                                                        id="iku<?=$idx;?>" value="<?= $d['iku']; ?>">
                                                                    <input type="hidden" name="index" id="index"
                                                                        value="<?=$idx;?>">
                                                                    <!-- Kendala -->
                                                                    <label class="form-label">Kendala</label>
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
                                                    class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"> Analisis Progress Capaian Triwulan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                        <div class="modal-body" style="text-align:left">
                                                            <table>

                                                                <form
                                                                    action="<?php echo base_url('kinerja/saveDetail'); ?>"
                                                                    method="post" enctype="multipart/form-data">
                                                                    <?= csrf_field(); ?>

                                                                    <h2 class="page-pretitle">
                                                                        <?= $d['pic'];?>
                                                                    </h2>


                                                                    <input type="hidden" name="id<?=$idx;?>"
                                                                        id="id<?=$idx;?>"
                                                                        value="<?= $d['id_pengguna']; ?>">
                                                                    <input type="hidden" name="iku<?=$idx;?>"
                                                                        id="iku<?=$idx;?>" value="<?= $d['iku']; ?>">
                                                                    <input type="hidden" name="index" id="index"
                                                                        value="<?=$idx;?>">
                                                                    <!-- Strategi -->
                                                                    <label class="form-label">Strategi</label>
                                                                    <textarea name="strategi<?=$idx;?>" id="stretegi<?=$idx; ?>"
                                                                        class="form-control" data-bs-toggle="autosize"
                                                                        placeholder="isikan strategi..." <?php
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

                                            <!-- Modal pic new -->
                                            <div class="modal fade" id="pic<?=$mod;?>" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
                                                    data-bs-backdrop="false" data-bs-keyboard="false">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body" style="text-align:left">
                                                                <h3 class="page-pretitle"><?= $d['pic']; ?></h3>
                                                            <form action="<?php echo base_url('kinerja/editIKK'); ?>"
                                                            method="post" enctype="multipart/form-data">
                                                            <?= csrf_field(); ?>
                                                                <div class="row">
                                                                <input type="hidden" name="id<?=$idx;?>"
                                                                        id="id<?=$idx;?>"
                                                                        value="<?= $d['id_pengguna']; ?>">
                                                                    <input type="hidden" name="iku<?=$idx;?>"
                                                                        id="iku<?=$idx;?>"
                                                                        value="<?= $d['iku']; ?>">
                                                                    <input type="hidden" name="index" id="index"
                                                                        value="<?=$idx;?>">
                                                                    <?php if($admin==true){?>
                                                                    <div class="col-9">
                                                                        <div class="mb-3">
                                                                            <input type="hidden" class="form-control" name="detail" id="detail" value="KRO">
                                                                            <label class="form-label required" >Indikator kinerja Kegiatan (IKK)</label>
                                                                            <textarea name="ikk<?=$idx;?>"
                                                                                id="ikk<?=$idx;?>"
                                                                                class="form-control"
                                                                                data-bs-toggle="autosize" required
                                                                                <?php if((trim($d['status'])=='selesai')||(trim($d['status'])=='validasi')){ ?> disabled
                                                                                <?php } ?>> <?= $d['indikator']; ?></textarea>
                                                                        </div>
                                                                        </div>
                                                                
                                                                    <div class="col-3">
                                                                        <div class="mb-3">
                                                                            <label class="form-label required">Target PK</label>
                                                                            <input name="target_pk<?=$idx;?>"
                                                                                id="target_pk<?=$idx;?>"
                                                                                class="form-control"
                                                                                placeholder="<?= $d['target_pk']; ?>" value="<?= $d['target_pk']; ?>" required 
                                                                                <?php if((trim($d['status'])=='selesai')||(trim($d['status'])=='validasi')){ ?> disabled
                                                                                <?php } ?>>
                                                                        </div>
                                                                    </div>
                                                                    <?php } ?>
                                                                    <div class="col-9">
                                                                        <div class="mb-3">
                                                                            <label class="form-label required">Target TW</label>
                                                                            <input name="target_tw<?=$idx;?>"
                                                                                id="target_tw<?=$idx;?>"
                                                                                class="form-control"
                                                                                placeholder=" <?= $d['target_tw']; ?>" value="<?= $d['target_tw']; ?>" required 
                                                                                <?php if((trim($d['status'])=='selesai')||(trim($d['status'])=='validasi')){ ?> disabled
                                                                                <?php } ?>>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div class="mb-3">
                                                                            <label class="form-label required">Capaian TW</label>
                                                                            <input name="capaian_tw<?=$idx;?>"
                                                                                id="capaian_tw<?=$idx;?>"
                                                                                class="form-control"
                                                                                placeholder="<?= $d['capaian']; ?>" value="<?= $d['capaian']; ?>" required
                                                                                <?php if((trim($d['status'])=='selesai')||(trim($d['status'])=='validasi')){ ?> disabled
                                                                                <?php } ?>>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label required"">Komentar</label>
                                                                        <textarea name="komentar<?=$idx;?>"
                                                                            id="komentar<?=$idx;?>"
                                                                            class="form-control"
                                                                            data-bs-toggle="autosize" required
                                                                            <?php if((trim($d['status'])=='selesai')||(trim($d['status'])=='validasi')){ ?> disabled
                                                                            <?php } ?>><?= $d['komentar']; ?></textarea>
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
                                            <!-- Modal pic new end -->

                                            <!-- Modal pic old -->
                                            <div class="modal fade" aria-labelledby="EditPK"
                                                data-bs-backdrop="static" data-bs-keyboard="false">
                                                <div
                                                    class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <table class="table table-bordered">
                                                                <form action="<?php echo base_url('kinerja/editIKK'); ?>"
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
                                            <!-- Modal pic old end -->
                                              <!-- Modal data dukung -->
                                              <div class="modal fade" id="doc<?=$mod;?>" aria-labelledby="EditPK" data-bs-backdrop="static" data-bs-backdrop="false"
                                                data-bs-keyboard="false">
                                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Data Dukung</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                        <div class="modal-body card-body" style="text-align:left">
                                                            <h3>
                                                                <?= $d['pic'];?>
                                                            </h3>
                                                            <h5 style="color:red;"> file pdf atau foto </h5>
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
                                                                        <form action="<?php echo base_url('kinerja/downloadFile');?>" method="post"
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
                                                                        <form action="<?php echo base_url('kinerja/deleteDokumen');?>" method="post"
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
                                                        <form name="formsubmit" action="<?php echo base_url('kinerja/storeMultipleFile'); ?>"
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
                                                            <div class="text-muted">Menghapus semua data? Data yang dihapus <b>tidak</b> bisa dikembalikan.</div>
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
                                             <div class="modal-dialog modal-sm modal-dialog-centered">
                                                    <form action="<?php echo base_url('kinerja/deleteAll');?>" method="post">
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
                                                            <h3>Apakah anda benar-benar yakin??</h3>
                                                            <div class="text-muted">Harap masukkan <b>password admin</b> untuk menlanjutkan penghapusan.</div>
                                                            <br>
                                                            
                                                            <div class="input-group input-group-flat">
                                                            <input name="password" id="password" type="password" class="form-control" placeholder="Password" autocomplete="off">
                                                            <span class="input-group-text">
                                                                <a href="#" class="link-secondary" title="" data-bs-toggle="tooltip" onclick="showPW()" data-bs-original-title="Show password">
                                                                <!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <circle cx="12" cy="12" r="2"></circle>
                                                                    <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path>
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
                                        

                                            <!--modal progres new-->
                                            <div class="modal fade" id="progres<?=$mod;?>" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
                                                data-bs-backdrop="false" data-bs-keyboard="false">
                                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Analisis Progress Capaian Triwulan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body" style="text-align:left">
                                                        <h3 class="page-pretitle"><?= $d['pic']; ?></h3>
                                                       
                                                        <form
                                                            action="<?php echo base_url('kinerja/saveDetail'); ?>"
                                                            method="POST">
                                                            <?= csrf_field(); ?>
                                                            <div class="row">
                                                            <input type="hidden" name="id<?=$idx;?>"id="id<?=$idx;?>"value="<?= $d['id_pengguna']; ?>">
                                                                        <input type="hidden" name="iku<?=$idx;?>"id="iku<?=$idx;?>" value="<?= $d['iku']; ?>">
                                                                        <input type="hidden" name="index" id="index" value="<?=$idx;?>">
                                                                <div class="col-10">
                                                                    <div class="mb-1">
                                                                        <input type="hidden" class="form-control" name="detail" id="detail" value="KRO">
                                                                        <label class="form-label required">Progress</label>
                                                                        <textarea name="progres<?=$idx;?>"
                                                                                id="progres<?=$idx;?>"
                                                                                class="form-control"
                                                                                data-bs-toggle="autosize"
                                                                                placeholder="Isikan Progres!"
                                                                                required
                                                                                <?php if((trim($d['status'])=='selesai')||(trim($d['status'])=='validasi')){ ?> disabled
                                                                                <?php } ?>><?= $d['progres'];?></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-2">
                                                                    <div class="mb-1">
                                                                        <input type="hidden" class="form-control" name="detail" id="detail" value="KRO">
                                                                        <label class="form-label">Data dukung</label>
                                                                        <span class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#doc<?=$mod; ?>">

                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="icon icon-tabler icon-tabler-file-description" width="24" height="24"
                                                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                                                <path
                                                                                    d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                                                                </path>
                                                                                <path d="M9 17h6"></path>
                                                                                <path d="M9 13h6"></path>
                                                                            </svg>  <?= $totalFile[$d['iku']]; ?>
                                                                         </span>
                                                                    </div>
                                                                </div>
                                                                <?php if($admin==true){ ?>
                                                                <div class="mb-3">
                                                                    <label class="form-label required">Keterangan</label>
                                                                    <textarea name="deskripsi<?=$idx;?>"
                                                                    id="deskripsi<?=$idx;?>" class="form-control"
                                                                    data-bs-toggle="autosize"
                                                                    placeholder="Isikan keterangan untuk PIC!"
                                                                    ><?php if(!empty(trim($d['deskripsi']))){?><?=$d['deskripsi'];}?></textarea>
                                                                    </div>

                                                                    <?php }  if(($admin==false)&&(!empty(trim($d['deskripsi'])))){ ?>
                                                                <div class="mb-3">
                                                                    <label class="form-label required">Keterangan</label>
                                                                    <textarea name="deskripsi<?=$idx;?>"
                                                                    id="deskripsi<?=$idx;?>" class="form-control"
                                                                    data-bs-toggle="autosize"
                                                                    placeholder="Isikan keterangan untuk PIC!"
                                                                    ><?php if(!empty(trim($d['deskripsi']))){?><?=$d['deskripsi'];}?></textarea>
                                                                    </div>
                                                                    <?php } ?>
                                                            </div>
                                                            <h5 style="color:red;">Semua data termasuk Data Dukung wajib terisi!</h5>
                                                        </div>

                                                        <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">Keluar</button>
                                                        <button type="submit" class="btn btn-success" <?php
                                                            if((($admin!=true)&&($totalFile[$d['iku']]==0))){ ?> disabled
                                                            <?php } ?>>Simpan Perubahan
                                                        </button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                            </div>
                                            <!--modal progres new end-->

                                            <!--modal progres-->
                                            <div class="modal fade" aria-labelledby="EditPK"
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
                                                                    action="<?php echo base_url('kinerja/saveDetail'); ?>"
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
                                                                                placeholder="Isikan Progres!"
                                                                                required
                                                                                <?php if((trim($d['status'])=='selesai')||(trim($d['status'])=='validasi')){ ?> disabled
                                                                                <?php } ?>><?= $d['progres'];?></textarea>
                                                                        </td>
                                                                        <!-- data dukung -->
                                                                        <td valign=middle align=middle>
                                                                            <span class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#doc<?=$mod; ?>">
                                                                            
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
                                                                placeholder="Isikan keterangan untuk PIC!"
                                                                ><?php if(!empty(trim($d['deskripsi']))){?><?=$d['deskripsi'];}?></textarea>
                                                        </div>
                                                        <?php }  if(($admin==false)&&(!empty(trim($d['deskripsi'])))){ ?>
                                                        <div style="text-align:left" class="page-pretitle">Keterangan
                                                        </div>
                                                        <div style="text-align:left">
                                                            <?= $d['deskripsi'];?>
                                                        </div>
                                                    
                                                    <?php } ?>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">Keluar</button>
                                                        <button type="submit" class="btn btn-success" <?php
                                                            if((($admin!=true)&&($totalFile[$d['iku']]==0))){ ?> disabled
                                                            <?php } ?>>Simpan
                                                            Perubahan
                                                        </button>
                                                    </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- modal progress end -->
                                          
                                            <?php $idx++; $i++;$number++; } endforeach; ?>
                                        </td>
                                </tbody>
                            </table>


                            <script src="./dist/libs/nouislider/dist/nouislider.min.js"></script>
  <script src="./dist/libs/litepicker/dist/litepicker.js"></script>
  <script src="./dist/libs/tom-select/dist/js/tom-select.base.min.js"></script>
  <!-- Tabler Core -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="./dist/js/tabler.min.js"></script>
  <script src="./dist/js/demo.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" type="text/javascript" language="javascript"></script>
  <script src="./dist/js/jquery.MultiFile.js" type="text/javascript" language="javascript"></script>