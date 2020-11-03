<h3 style="text-align:center"><?= $surat['kategori_surat'] ?></h3>
<hr />
<table style="width:100%">
  <tr>
    <td width="50%">
      <table>
        <tr>
          <td width="30%">Nomor</td>
          <td>: <?= $no_surat['no_surat'] . "/" . $no_surat['kode'] . "." . $no_surat['kode_tujuan'] . "-" . $no_surat['kode_us'] . "/" . bulan_romawi($no_surat['bulan']) . "/" . $no_surat['tahun']; ?></td>
        </tr>
        <tr>
          <td width="30%">Hal</td>
          <td>: <?= $surat['kategori_surat']; ?></td>
        </tr>
      </table>
    </td>
    <td style="text-align:right;vertical-align:top;">Yogyakarta, <?= $no_surat['tanggal_full']; ?> </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
      <p>Kepada Yth:<br />
        <strong><?= ($no_surat['instansi']) ? $no_surat['instansi'] : $surat['tujuan_surat']; ?></strong>
        di-<br />
        Tempat
      </p>
    </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
      <p><em>Assalamulaiakum warahmatullaahi wabarakatuh</em></p>
      <p>Yang bertanda tangan di bawah ini saya: </p>

      <table style="width:100%">
        <tr>
          <td style="width:150px;">Nama</td>
          <td> : <?= $surat['fullname']; ?></td>
        </tr>
        <tr>
          <td>NIM</td>
          <td> : <?= $surat['username']; ?></td>
        </tr>
        <tr>
          <td>Program Studi</td>
          <td> : <?= $surat['prodi']; ?></td>
        </tr>

      </table>
      <br />

      <p>Bermaksud untuk mengajukan permohonan cuti/berhenti kuliah sementara untuk semester <strong><?= get_meta_value('semester', $surat['id'], false); ?></strong> tahun akademik <strong><?= get_meta_value('thn_akademik', $surat['id'], false); ?></strong> karena : <strong><?= get_meta_value('alasan_cuti', $surat['id'], false); ?></strong></p>
      <p>Bersama ini saya lampirkan: </p>
      <ol>
        <li>Slip pembayaran biaya cuti kuliah</li>
        <li>Surat keterangan bebas tunggakan SPP</li>
        <li>Surat keterangan bebas pinjaman pustaka</li>
        <li>Fotokopi kartu tanda mahasiswa (KTM)</li>
      </ol>
      <p>Demikian atas perhatiannya kami ucapkan terima kasih.</p>
      <p><em>Wassalamulaiakum warahmatullaahi wabarakatuh</em></p>

    </td>
  </tr>
  <tr>
    <td colspan="2" style="text-align: right;">Yogyakarta, <?= $no_surat['tanggal_full']; ?> </td>
  </tr>
  <tr>
    <td style="text-align: center;">
      <p>Mengetahui, </p>
      <p>Direktur </p>
      <br />
      <br />
      <br />
      <br />
      <p>(Ir.Sri Atmaja P. Rosyidi, M.Sc.Eng., Ph.D., P.Eng.,IPM)</p>
    </td>
    <td style="text-align: center;">
      <p>&nbsp; </p>
      <p>Hormat saya, </p>
      <br />
      <br />
      <br />
      <br />
      <p>(<?= $surat['fullname']; ?>)</p>
    </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>

  <!-- panggil dokumen pelengkap-->

  <tr>
    <td colspan="2">
      <h3>Lampiran Persyaratan</h3>
      <hr />
    </td>
  </tr>

  <?php $dokumen = get_dokumen_syarat($surat['id']);

  foreach ($dokumen as $dokumen) { ?>
    <tr>
      <td colspan="2">
        <p><?= $dokumen['kat_keterangan_surat']; ?></p><img src="<?= base_url($dokumen['file']); ?>" />
      </td>
    </tr>
  <?php } ?>

</table>