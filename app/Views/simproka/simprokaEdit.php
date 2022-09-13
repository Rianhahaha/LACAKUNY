<?php
$page = "simproka"; ?>
<?= $this->include('layout/header'); ?>
<?= $this->include('layout/sidebarSimproka'); ?>

<script src="<?php echo base_url() ?>/asset/jquery/jquery-3.6.1.min.js"></script>
<div class="container-xl">
    <div class="card">
        <div class="card-body">
            <h1> Capaian Laporan Reguler</h1>
            <div class="row">
                <form action="simproka1/formEditAdmin" method="post">
                    <div class="mb-3">
                        <label class="form-label required">Kode</label>
                        <div class="input-group">
                            <input type="hidden" id="detail" name="detail" value="<?= trim(dot_array_search('0.detail', $data)) ?>">
                            <input type="hidden" id="oldKode" name="oldKode" value="<?= trim(dot_array_search('0.kode', $data)) ?>">
                            <input class="form-control" id="newKode" name="newKode" value="<?= trim(dot_array_search('0.kode', $data)) ?>" disabled>
                            <button type="button" class="btn btn-ghost-primary btn-icon" onclick="toggle()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <rect x="5" y="11" width="14" height="10" rx="2"></rect>
                                    <circle cx="12" cy="16" r="1"></circle>
                                    <path d="M8 11v-4a4 4 0 0 1 8 0v4"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Uraian</label>
                        <div class="input-group">
                            <textarea class="form-control" id="uraian" name="uraian" data-bs-toggle="autosize" disabled style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 56px;"><?= trim(dot_array_search('0.uraian', $data)) ?></textarea>
                            <button type="button" class="btn btn-ghost-primary btn-icon" onclick="toggle1()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <rect x="5" y="11" width="14" height="10" rx="2"></rect>
                                    <circle cx="12" cy="16" r="1"></circle>
                                    <path d="M8 11v-4a4 4 0 0 1 8 0v4"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pilih PIC</label>
                        <select type="text" class="form-select joss" placeholder="Select a date" id="id_pengguna" name="id_pengguna" value="">
                            <?php foreach ($pic as $p) : ?>
                                <option value="<?= trim($p['id_pengguna']); ?>" <?= trim($p['tampilan']) == strtoupper(trim(dot_array_search('0.pic', $data))) ? 'selected' : '' ?>>
                                    <?= $p['tampilan']; ?>
                                </option>
                            <?php endforeach; ?>
                            <!-- <option>Admisi</option>
                        <option>Bid Kemahasiswaan dan Alumni</option>
                        <option>BMN</option>
                        <option>LPMPP</option>
                        <option>PPG</option>
                        <option>ULP</option>
                        <option>BID Akademik</option>
                        <option>Keuangan</option>
                        <option>LPPM</option>
                        <option>Rumah Tangga</option> -->
                        </select>
                    </div>
                    <script>
                        $(document).ready(function() {
                            $var = "<?php echo  trim(dot_array_search('0.kendala', $data)) ?>";
                            $('#kendala option[value="' + $var + '"]').attr("selected", "selected");
                        });
                    </script>
                    <div class="mb-3">

                        <div class="col" align="right">
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        </div>

                    </div>
                </form>
            </div>

            <ul class="nav nav-tabs nav-fill" data-bs-toggle="tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="#reviu" class="nav-link <?= $select == 'REVIU' ? 'active' : '' ?>" style="justify-content: center;" data-bs-toggle="tab" aria-selected="true" role="tab" tabindex="-1">
                        <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <polyline points="5 12 3 12 12 3 21 12 19 12"></polyline>
                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                        </svg>
                        Reviu Informasi
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="#inputcapaian" class="nav-link <?= $select == 'INPUT' ? 'active' : '' ?>" data-bs-toggle="tab" style="justify-content: center;" aria-selected="false" role="tab" tabindex="-1">
                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                        </svg>
                        Input Capaian
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="#editcapaian" class="nav-link <?= $select == 'EDIT' ? 'active' : '' ?>" data-bs-toggle="tab" style="justify-content: center;" aria-selected="false" role="tab">
                        <!-- Download SVG icon from http://tabler-icons.io/i/activity -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M3 12h4l3 8l4 -16l3 8h4"></path>
                        </svg>
                        Edit Capaian
                    </a>
                </li>
            </ul>


            <!-- Konten Reviu Info -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane <?= $select == 'REVIU' ? 'active' : '' ?> show" id="reviu" role="tabpanel">
                        <table class="table">
                            <thead>
                                <tr align=middle>
                                    <td>
                                        <b>Bulan</b>
                                    </td>
                                    <td>
                                        <b>%Target Keuangan (Riil perBulan)</b>
                                    </td>
                                    <td>
                                        <b>Target Fisik (Riil perBulan)</b>
                                    </td>
                                    <td>
                                        <b>Status Validasi</b>
                                    </td>
                            </thead>
                            <tbody>
                                <!-- Januari -->
                                <tr valign=middle>
                                    <td>
                                        <b> Januari </b>
                                    </td>
                                    <td>
                                        <!--  %Target Keuangan (Riil perBulan) -->
                                        <input style="direction: rtl; text-align: center;" type="text" class="form-control" placeholder="40">

                                    </td>
                                    <td>
                                        <!--  Target Fisik (Riil perBulan) -->
                                        <input style="direction: rtl; text-align: center;" type="text" class="form-control" placeholder="40">
                                    </td>
                                    <!-- end Januari -->
                                    <!-- februari -->
                                <tr valign=middle>
                                    <td>
                                        <b> Februari </b>
                                    </td>
                                    <td>
                                        <!--  %Target Keuangan (Riil perBulan) -->
                                        <input style="direction: rtl; text-align: center;" type="text" class="form-control" placeholder="40">

                                    </td>
                                    <td>
                                        <!--  Target Fisik (Riil perBulan) -->
                                        <input style="direction: rtl; text-align: center;" type="text" class="form-control" placeholder="40">
                                    </td>
                                    <!-- end februari -->
                                    <!-- Maret -->
                                <tr valign=middle>
                                    <td>
                                        <b> Maret </b>
                                    </td>
                                    <td>
                                        <!--  %Target Keuangan (Riil perBulan) -->
                                        <input style="direction: rtl; text-align: center;" type="text" class="form-control" placeholder="40">

                                    </td>
                                    <td>
                                        <!--  Target Fisik (Riil perBulan) -->
                                        <input style="direction: rtl; text-align: center;" type="text" class="form-control" placeholder="40">
                                    </td>
                                    <!-- end maret -->
                                    <!-- April -->
                                <tr valign=middle>
                                    <td>
                                        <b> April </b>
                                    </td>
                                    <td>
                                        <!--  %Target Keuangan (Riil perBulan) -->
                                        <input style="direction: rtl; text-align: center;" type="text" class="form-control" placeholder="40">

                                    </td>
                                    <td>
                                        <!--  Target Fisik (Riil perBulan) -->
                                        <input style="direction: rtl; text-align: center;" type="text" class="form-control" placeholder="40">
                                    </td>
                                    <!-- end april -->
                                    <!-- Mei -->
                                <tr valign=middle>
                                    <td>
                                        <b> Mei </b>
                                    </td>
                                    <td>
                                        <!--  %Target Keuangan (Riil perBulan) -->
                                        <input style="direction: rtl; text-align: center;" type="text" class="form-control" placeholder="40">

                                    </td>
                                    <td>
                                        <!--  Target Fisik (Riil perBulan) -->
                                        <input style="direction: rtl; text-align: center;" type="text" class="form-control" placeholder="40">
                                    </td>
                                    <!-- end Mei -->
                                    <!-- Juni -->
                                <tr valign=middle>
                                    <td>
                                        <b> Juni </b>
                                    </td>
                                    <td>
                                        <!--  %Target Keuangan (Riil perBulan) -->
                                        <input style="direction: rtl; text-align: center;" type="text" class="form-control" placeholder="40">

                                    </td>
                                    <td>
                                        <!--  Target Fisik (Riil perBulan) -->
                                        <input style="direction: rtl; text-align: center;" type="text" class="form-control" placeholder="40">
                                    </td>
                                    <!-- end Juni -->
                                    <!-- Juli -->
                                <tr valign=middle>
                                    <td>
                                        <b> Juli </b>
                                    </td>
                                    <td>
                                        <!--  %Target Keuangan (Riil perBulan) -->
                                        <input style="direction: rtl; text-align: center;" type="text" class="form-control" placeholder="40">

                                    </td>
                                    <td>
                                        <!--  Target Fisik (Riil perBulan) -->
                                        <input style="direction: rtl; text-align: center;" type="text" class="form-control" placeholder="40">
                                    </td>
                                    <!-- end juli -->
                                    <!-- Agustus -->
                                <tr valign=middle>
                                    <td>
                                        <b> Agustus </b>
                                    </td>
                                    <td>
                                        <!--  %Target Keuangan (Riil perBulan) -->
                                        <input style="direction: rtl; text-align: center;" type="text" class="form-control" placeholder="40">

                                    </td>
                                    <td>
                                        <!--  Target Fisik (Riil perBulan) -->
                                        <input style="direction: rtl; text-align: center;" type="text" class="form-control" placeholder="40">
                                    </td>
                                    <!-- end agustus -->
                                    <!-- September -->
                                <tr valign=middle>
                                    <td>
                                        <b> September </b>
                                    </td>
                                    <td>
                                        <!--  %Target Keuangan (Riil perBulan) -->
                                        <input style="direction: rtl; text-align: center;" type="text" class="form-control" placeholder="40">

                                    </td>
                                    <td>
                                        <!--  Target Fisik (Riil perBulan) -->
                                        <input style="direction: rtl; text-align: center;" type="text" class="form-control" placeholder="40">
                                    </td>
                                    <!-- end september -->
                                    <!-- Oktober -->
                                <tr valign=middle>
                                    <td>
                                        <b> Oktober </b>
                                    </td>
                                    <td>
                                        <!--  %Target Keuangan (Riil perBulan) -->
                                        <input style="direction: rtl; text-align: center;" type="text" class="form-control" placeholder="40">

                                    </td>
                                    <td>
                                        <!--  Target Fisik (Riil perBulan) -->
                                        <input style="direction: rtl; text-align: center;" type="text" class="form-control" placeholder="40">
                                    </td>
                                    <!-- end OKtober -->
                                    <!-- nov -->
                                <tr valign=middle>
                                    <td>
                                        <b> November </b>
                                    </td>
                                    <td>
                                        <!--  %Target Keuangan (Riil perBulan) -->
                                        <input style="direction: rtl; text-align: center;" type="text" class="form-control" placeholder="40">

                                    </td>
                                    <td>
                                        <!--  Target Fisik (Riil perBulan) -->
                                        <input style="direction: rtl; text-align: center;" type="text" class="form-control" placeholder="40">
                                    </td>
                                    <!-- end okt -->
                                    <!-- des -->
                                <tr valign=middle>
                                    <td>
                                        <b> Desember </b>
                                    </td>
                                    <td>
                                        <!--  %Target Keuangan (Riil perBulan) -->
                                        <input style="direction: rtl; text-align: center;" type="text" class="form-control" placeholder="40">

                                    </td>
                                    <td>
                                        <!--  Target Fisik (Riil perBulan) -->
                                        <input style="direction: rtl; text-align: center;" type="text" class="form-control" placeholder="40">
                                    </td>
                                    <!-- end OKtober -->
                            </tbody>
                        </table>

                    </div>
                    <!-- Konten Reviu Info end -->


                    <!-- Konten input Capaian -->

                    <div class="tab-pane <?= $select == 'INPUT' ? 'active' : '' ?>" id="inputcapaian" role="tabpanel">
                        <div class="row">
                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="form-label required text-danger">Pilih bulan terlebih
                                        dahulu!</label>
                                    <div class="btn-group">
                                        <select id="sistem" name="sistem" class="form-select month">
                                            <option value="0" selected>Pilih bulan....
                                            </option>
                                            <option value="1"> Januari
                                            </option>
                                            <option value="2"> Februari
                                            </option>
                                            <option value="3"> Maret
                                            </option>
                                            <option value="4">April
                                            </option>
                                            <option value="5">Mei
                                            </option>
                                            <option value="6">Juni
                                            </option>
                                            <option value="7">Juli
                                            </option>
                                            <option value="8">Agustus
                                            </option>
                                            <option value="9">September
                                            </option>
                                            <option value="10">Oktober
                                            </option>
                                            <option value="11">November
                                            </option>
                                            <option value="12">Desember
                                            </option>
                                        </select>
                                        <!-- <button class="btn btn-outline-primary"> Pilih </button> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script src="<?php echo base_url() ?>/asset/jquery/jquery-3.6.1.min.js"></script>
                        <script>
                            console.log("Hello world!");
                            $(document).ready(function() {
                                $("#sistem").change(function() {
                                    var data = $(this).val();

                                    $.ajax({
                                        type: 'POST',
                                        url: "<?php echo base_url("simproka1/aksesData"); ?>",
                                        data: {
                                            data: data
                                        },
                                        cache: false,
                                        success: function(data) {
                                            $('#formInput').load("<?php echo base_url("/simproka1/formInput"); ?>");
                                        }
                                    });
                                });
                            });
                        </script>

                        <!-- data INPUT akan muncul disini -->
                        <div id="formInput"></div>

                    </div>
                    <!-- Konten Input Capaian end -->

                    <!-- Konten Edit Capaian -->
                    <div class="tab-pane <?= $select == 'EDIT' ? 'active' : '' ?>" id="editcapaian" role="tabpanel">

                        <div class="row">
                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="form-label required text-danger">Pilih bulan terlebih
                                        dahulu!</label>
                                    <div class="btn-group">
                                        <select name="sistemEdit" id="sistemEdit" class="form-select month">
                                            <option value="0" selected>Pilih bulan....
                                            </option>
                                            <option value="1"> Januari
                                            </option>
                                            <option value="2"> Februari
                                            </option>
                                            <option value="3"> Maret
                                            </option>
                                            <option value="4">April
                                            </option>
                                            <option value="5">Mei
                                            </option>
                                            <option value="6">Juni
                                            </option>
                                            <option value="7">Juli
                                            </option>
                                            <option value="8">Agustus
                                            </option>
                                            <option value="9">September
                                            </option>
                                            <option value="10">Oktober
                                            </option>
                                            <option value="11">November
                                            </option>
                                            <option value="12">Desember
                                            </option>
                                        </select>
                                        <!-- <button class="btn btn-outline-primary"> Pilih </button> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            $(document).ready(function() {
                                $("#sistemEdit").change(function() {
                                    var data = $(this).val();

                                    $.ajax({
                                        type: 'POST',
                                        url: "<?php echo base_url("simproka1/aksesData"); ?>",
                                        data: {
                                            "data": data
                                        },
                                        cache: false,
                                        success: function(data) {
                                            $('#formEdit').load("<?php echo base_url("/simproka1/formEdit"); ?>");
                                        }
                                    });
                                });
                            });
                        </script>
                        <script>
                            $(document).ready(function() {
                                $var = "<?php echo $sistem; ?>";
                                $("#sistemEdit option").each(function() {
                                    if (parseInt($(this).val()) > parseInt($var)) {
                                        $('.month option[value="' + $(this).val() + '"]').hide();
                                        $('.month option[value="0"]').hide();
                                    }
                                });
                            });
                        </script>
                        <!-- data EDIT akan muncul disini -->
                        <div id="formEdit"></div>

                    </div>
                    <!-- Konten Input Capaian end -->

                </div>
                <!-- Konten Edit Capaian end -->

            </div>
        </div>
    </div>
</div>


</div>
<!-- Page title -->
</div>


<!-- MODAL -->

<!-- modal pilih PIC -->
<div class="modal fade" id="pilihpic" aria-labelledby="EditPK" data-bs-backdrop="static" data-bs-keyboard="false">
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
            <button type="button" class="btn btn-danger" data-bs-toggle="modal">Kembali</button>
            <button type="submit" class="btn btn-success">Simpan
                Perubahan</button>
        </div>
    </div>
</div>
</div>

<!-- end modal pilih PIC -->

<!-- MODAL END -->
<?= $this->include('layout/footer'); ?>