<form action="simproka1/editSimproka" method="post" enctype="multipart/form-data">
    <input type="hidden" name="kode" id="kode" value="<?= trim(dot_array_search('0.kode', $data)) ?>">
    <input type="hidden" name="detail" id="detail" value="<?= trim(dot_array_search('0.detail', $data)) ?>">
    <?php if (0 != ($kode)) { ?>
        <input type="hidden" name="kro" id="kro" value=<?= $kode; ?>>
    <?php }  ?>
    <div class="row">
        <div class="col-sm-4 col-md-4">
            <div class="mb-3">
                <label class="form-label required">Volume Target</label>
                <input class="form-control xlock" id="volume_target" name="volume_target" placeholder="Isikan Volume Target!" value="<?= trim(dot_array_search('0.volume_target', $data)) ?>">
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="mb-3">
                <label class="form-label required">Volume Capaian</label>
                <input class="form-control xlock" id="capaian_volume" name="capaian_volume" placeholder="Isikan Capaian Volume!" value="<?= trim(dot_array_search('0.capaian_volume', $data)) ?>" required="">
            </div>

        </div>
        <div class="col-sm-4 col-md-4">
            <div class="mb-3">
                <label class="form-label required">Satuan</label>
                <input type="text" class="form-control xlock" id="satuan" name="satuan" placeholder="Isikan Satuan!" value="<?= trim(dot_array_search('0.volume_target', $data)) ?>" required="">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label required">Progress Fisik</label>
            <textarea class="form-control xlock" id="progres" name="progres" data-bs-toggle="autosize" placeholder="Isikan Progress!" required="" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 56px;"><?= trim(dot_array_search('0.progres', $data)) ?></textarea>
        </div>
        <div class="col-sm-6 col-md-6">
            <div class="mb-3">
                <label class="form-label required">Realisasi Rill</label>
                <textarea class="form-control xlock" id="capaian_rill" name="capaian_rill" data-bs-toggle="autosize" placeholder="Isikan Realisasi Rill!" required="" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 56px;"><?= trim(dot_array_search('0.capaian_rill', $data)) ?></textarea>
            </div>
        </div>

        <div class="col-sm-6 col-md-6">
            <div class="mb-3">
                <label class="form-label required">Satuan Rill</label>
                <textarea class="form-control xlock" id="satuan_rill" name="satuan_rill" data-bs-toggle="autosize" placeholder="Isikan Satuan Rill!" required="" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 56px;"><?= trim(dot_array_search('0.satuan_rill', $data)) ?></textarea>
            </div>
        </div>

        <div class="col-sm-6 col-md-6">
            <div class="mb-3">
                <label class="form-label required">Status Progress</label>
                <select name="status" id="status" class="form-select xlock">
                    <option value="Pelaksanaan"> Pelaksanaan
                    </option>
                    <option value="Selesai"> Selesai
                    </option>

                </select>
            </div>
        </div>
        <div class="col-sm-6 col-md-6">
            <div class="mb-3">
                <label class="form-label required">Keterangan Progress</label>
                <textarea class="form-control xlock" id="penjelasan" name="penjelasan" data-bs-toggle="autosize" placeholder="Isikan Keterangan Progress!" required="" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 56px;"><?= trim(dot_array_search('0.penjelasan', $data)) ?></textarea>
            </div>
        </div>
        <div class="col-sm-6 col-md-6">
            <div class="mb-3">
                <label class="form-label required">Kendala</label>
                <select name="kendala" id="kendala" class="form-select xlock">
                    <option value="Pagu/Anggaran/Lokasi"> Pagu/Anggaran/Lokasi
                    </option>
                    <option value="Barang/Material"> Barang/Material
                    </option>
                    <option value="Penerima Manfaat"> Penerima Manfaat
                    </option>
                    <option value="Waktu"> Waktu
                    </option>
                    <option value="Lokasi"> Lokasi
                    </option>
                    <option value="Desain Perencanaan/Konsep"> Desain Perencanaan/Konsep
                    </option>
                    <option value="Cara/Metode Pelaksanaan"> Cara/Metode Pelaksanaan
                    </option>
                    <option value="Aparatur Pemerintahan"> Aparatur Pemerintahan
                    </option>
                    <option value="Stake Holders Terkait"> Stake Holders Terkait
                    </option>
                    <option value="Persepsi/Pengendalian"> Persepsi/Pengendalian
                    </option>
                    <option value="Force Majeure"> Force Majeure
                    </option>
                    <option value="Tidak ada Masalah"> Tidak ada Masalah
                    </option>
                </select>
            </div>
        </div>
        <div class="col-sm-6 col-md-6">
            <div class="mb-3">
                <label class="form-label required">Keterangan Kendala</label>
                <textarea class="form-control xlock" id="keterangan_kendala" name="keterangan_kendala" data-bs-toggle="autosize" placeholder="Isikan Keterangan Kendala!" required style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 56px;"><?= trim(dot_array_search('0.keterangan_kendala', $data)) ?></textarea>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label required">Solusi atau Tindaklanjut</label>
            <textarea class="form-control xlock" id="tindak_lanjut" name="tindak_lanjut" data-bs-toggle="autosize" placeholder="Solusi atau Tindaklanjut!" required="" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 56px;"><?= trim(dot_array_search('0.tindak_lanjut', $data)) ?></textarea>
        </div>
        <div class="mb-3">
            <input name="dok[]" id="dok[]" type="file" onchange="validateSize(this)" accept="image/*,.pdf" class="form-control mr-auto  xlock" multiple ref="fileref" @change="onChange">
            <p id="size"></p>
        </div>
        <div class="card-footer text-end">
            <div class="d-flex" align="right">

                <button type="submit" id="simpanEdit" name="simpanEdit" class="btn btn-success ms-auto" <?php if (empty(trim(dot_array_search('0.capaian_rill', $data)))) { ?> disabled <?php } ?>>Simpan Perubahan</button>
            </div>
        </div>

    </div>
</form>

<script src="<?php echo base_url() ?>/asset/jquery/jquery-3.6.1.min.js"></script>
<script>
    $(document).ready(function() {
        if ($("#simpanEdit").prop('disabled')) {
            $(".xlock").prop('disabled', true);
        }
    });
</script>
<script>
    $(document).ready(function() {
        $var = "<?php echo  trim(dot_array_search('0.kendala', $data)) ?>";
        $('#kendala option[value="' + $var + '"]').attr("selected", "selected");
    });
</script>
<script>
    $(document).ready(function() {
        $var2 = "<?php echo  trim(dot_array_search('0.status', $data)) ?>";
        $('#status option[value="' + $var2 + '"]').attr("selected", "selected");
    });
</script>