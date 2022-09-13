<?= $this->include('layout/header'); ?>
<div class="page" style="overflow-y: hidden; overflow-x: hidden;">
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="col-md-12">
                    <div class="card card-stacked">
                        <div class="card-body">
                            <table width='100%'>
                                <tr>
                                    <td width='50%' style='vertical-align: middle;'>
                                        <p>
                                        <h3 class="card-title">Info Satker</h3>
                                        </p>
                                    </td>
                                    <?php if ($id_pengguna == 1230) : ?>
                                        <td width='50%'>
                                            <p align='right'><a href='#' class='btn btn-dark' data-bs-toggle="modal" data-bs-target="#modalUpdateSatker">Edit</a></p>
                                        </td>
                                    <?php endif; ?>
                                </tr>

                            </table>
                            <table class='table table-bordered table-striped table-hover' width='100%'>
                                <thead>
                                    <tr>
                                        <td class='text-center text-white bg-dark'>No</td>
                                        <td class='text-center text-white bg-dark'>Nomenklatur</td>
                                        <td class='text-center text-white bg-dark'>Uraian</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $number = 1;
                                    foreach ($satker as $s) : ?>
                                        <tr valign=middle>
                                            <td class='text-center'><?= $number ?></td>
                                            <td>
                                                <?= $s['nomenklatur']; ?>
                                            </td>
                                            <td>
                                                <?= $s['uraian']; ?>
                                            </td>
                                        </tr>

                                </tbody>
                            <?php $number++;
                                    endforeach; ?>
                            </table>

                        </div>
                    </div>

                    <div class="card card-stacked" style='margin-top:2vw; margin-bottom: 20vw;'>
                        <div class="card-body">
                            <h3 class="card-title">Tugas</h3>
                            <p align='justify'>memimpin penyelenggaraan pendidikan, penelitian, dan pengabdian
                                kepada masyarakat, serta membina pendidik, tenaga kependidikan, mahasiswa dan
                                hubungannya dengan lingkungan</p>
                            <h3 class="card-title">Fungsi</h3>
                            <p align='justify'>
                            <ol>
                                <li>pelaksanaan dan pengembangan pendidikan tinggi</li>
                                <li>pelaksanaan penelitian untuk pengembangan ilmu pengetahuan dan/atau teknologi
                                </li>
                                <li>pelaksanaan pengabdian kepada masyarakat</li>
                                <li>pelaksanaan pembinaan pendidik, tenaga kependidikan, mahasiswa, dan hubungannya
                                    dengan lingkungan</li>
                                <li>pelaksanaan kegiatan layanan administratif</li>
                            </ol>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="modalUpdateSatker" tabindex="-1" aria-labelledby="modalUpdateSatkerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title" id="modalUpdateSatkerLabel">Update Satker</h5>
            </div>
            <div class="modal-body" style='height: 30vw;'>
                <form action="<?php echo base_url('satker/edit'); ?>" method="post" enctype="multipart/form-data">
                    <?php foreach ($satker as $s) : ?>
                        <div class="mb-3">
                            <label for="inputUnitKerja" class="form-label"><?= $s['nomenklatur']; ?></label>
                            <input type="text" class="form-control" id="<?= $s['id_satker']; ?>" name='<?= $s['id_satker']; ?>' value='<?= $s['uraian']; ?>'>
                        </div>
                    <?php endforeach; ?>
                    <!-- <div class="mb-3">
                            <label for="inputSatker" class="form-label">Nama Satuan Kerja</label>
                            <input type="text" class="form-control" id="inputSatker" name='inputSatker'
                                value='UNIVERSITAS NEGERI YOGYAKARTA (677509)'>
                        </div>
                        <div class="mb-3">
                            <label for="inputNIK" class="form-label">NIK Kepala Kantor</label>
                            <input type="text" class="form-control" id="inputNIK" name='inputNIK'
                                value='3404100103650002'>
                        </div>
                        <div class="mb-3">
                            <label for="inputNIP" class="form-label">NIP Kepala Unit Kerja</label>
                            <input type="text" class="form-control" id="inputNIP" name='inputNIP'
                                value='196503011990011001'>
                        </div>
                        <div class="mb-3">
                            <label for="inputNamaKepala" class="form-label">Nama Kepala Unit Kerja</label>
                            <input type="text" class="form-control" id="inputNamaKepala" name='inputNamaKepala'
                                value='Prof. Dr. Sumaryanto, M.Kes'>
                        </div>
                        <div class="mb-3">
                            <label for="inputJabatan" class="form-label">Nama Jabatan</label>
                            <input type="text" class="form-control" id="inputJabatan" name='inputJabatan'
                                value='Rektor Universitas Negeri Yogyakarta'>
                        </div>
                        <div class="mb-3">
                            <label for="inputAlamat" class="form-label">Alamat Unit Kerja</label>
                            <input type="text" class="form-control" id="inputAlamat" name='inputAlamat'
                                value='Jalan Colombo Nomor 1, Karangmalang, Yogyakarta'>
                        </div>
                        <div class="mb-3">
                            <label for="inputOperator" class="form-label">Nama Operator</label>
                            <input type="text" class="form-control" id="inputOperator" name='inputOperator'
                                value='Hariyono'>
                        </div>
                        <div class="mb-3">
                            <label for="inputTelepon" class="form-label">No HP</label>
                            <input type="text" class="form-control" id="inputTelepon" name='inputTelepon'
                                value='081392408723'>
                        </div>
                        <div class="mb-3">
                            <label for="inputEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="inputEmail" name='inputEmail'
                                value='hariyono@uny.ac.id'>
                        </div> -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?= $this->include('layout/footer'); ?>