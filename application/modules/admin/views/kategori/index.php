<div class="row">
    <div class="col-md-12">
        <div class="card card-success card-outline">
            <div class="card-header py-3">
                <a href="<?= base_url('admin/pengguna/tambah') ?>" class="btn btn-sm btn-perak btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Tambah Pengguna</span>
                </a> &nbsp;
                <a href="<?= base_url('admin/pengguna/upload') ?>" class="btn btn-sm btn-perak btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-upload"></i>
                    </span>
                    <span class="text">Upload Pengguna</span>
                </a>

                <span class="float-right">
                    <select id="selectpengguna">
                        <option value="">-- Pilih Pengguna --</option>
                        <option value="Dosen">Dosen</option>
                        <option value="Mahasiswa">Mahasiswa</option>
                        <option value="Pascasarjana">Pascasarjana</option>
                        <option value="Program Studi">Program Studi</option>
                    </select>
                </span>

            </div>

            <div class="card-body box-profile">
                <table id="kategorisurat" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Kategori Surat</th>
                            <th>Pengguna</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($kategori_surat as $kategori) :

                            if ($kategori['klien'] == 'm') {
                                $klien = 'Mahasiswa';
                            } elseif ($kategori['klien'] == 'd') {
                                $klien = 'Dosen';
                            } elseif ($kategori['klien'] == 'p') {
                                $klien = 'Pascasarjana';
                            } elseif ($kategori['klien'] == 'j') {
                                $klien = 'Program Studi';
                            }
                            echo "<tr>";
                            echo "<td>" . $kategori['kategori_surat'] . "</td>";
                            echo "<td>" . $klien . "</td>";
                            echo "<td class='text-center'><a class='btn btn-info btn-sm' href='" . base_url('admin/kategorisurat/edit/' . $kategori['id']) . "'><i class='fas fa-pencil-alt'></i> Edit</a></td>";
                            echo "</tr>";
                        endforeach;
                        ?>

                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>