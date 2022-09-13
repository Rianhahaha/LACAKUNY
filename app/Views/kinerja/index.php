<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
  <div class="row">
    <div class="col">
      <h1 class="mt-2">Kinerja</h1>
      <table class="table">
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
              Capaian TW
            </td>
            <td rowspan=2>
              Persentase Capaian TW
            </td>
            <td colspan=3>
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

          <tr class="text-center text-light bg-dark">
            <td>progress</td>
            <td>kendala</td>
            <td>Strategi</td>
            <td>Dokumen</td>
            <td>Foto kegiatan</td>
        </thead>
        <tbody>
          <?= $i = 1; ?>
          <?php foreach ($kinerja as $k) : ?>
            <tr valign=middle>
              <th scope="row"><?= $i++; ?></th>
              <td rowspan=3>
                <?= $k['indikator']; ?>
              </td>
              <td rowspan=3>
                <?= $k['target_pk']; ?>
              </td>
              <td rowspan=1>
                <?= $k['target_pw']; ?>
              </td>
              <td rowspan=1>
                <!-- PK (2.1)  --> 20
              </td>

            </tr>
          <?php endforeach; ?>
        </tbody>

      </table>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>