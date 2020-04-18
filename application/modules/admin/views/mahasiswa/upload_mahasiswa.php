<div class="row">
	<div class="col-md-12">
		

				<?php

                if (isset($_POST['submit'])) {

                    // Buat sebuah tag form untuk proses import data ke database
                    echo form_open_multipart(base_url('keuanganhaji/import_sdhi_rupiah/' . $file_excel), 'class="form-horizontal"');

                    echo "<p class='alert alert-warning'>Data bulan " . $sheet['1']['E'] . " " . $sheet['1']['F'] . "</p>";

                    echo "<table class='table table-bordered table-striped'>
         
                        <tr>
                            <th>No.</th>
                            <th>NIM</th>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>          
                        </tr>";

                    $numrow = 1;
                    $kosong = 0;

                    foreach ($sheet as $row) {
                        // Ambil data pada excel sesuai Kolom



                        if ($numrow > 1) {

                            echo "<tr>";
                            echo "<td>" . $numrow . "</td>";
                            echo "<td>" . $sheet['1']['A'] . "</td>";
                            echo "<td>" . $sheet['1']['B'] . "</td>";
                            echo "<td>" . $sheet['1']['C'] . "</td>";
                            echo "</tr>";
                        }

                        $numrow++; // Tambah 1 setiap kali looping
                    }

                    echo "</table>";

                    echo "<hr>";
                    // Buat sebuah tombol untuk mengimport data ke database
                    echo "<button class='btn btn-success' type='submit' name='import'>Import</button>";
                    echo " <a class='btn btn-warning' href='" . base_url("keuanganhaji/sdhi_rupiah") . "'>Cancel</a>";

                    echo form_close();
                } else {

                    echo form_open_multipart(base_url('admin/mahasiswa/upload_mahasiswa'), 'class="form-horizontal"') ?>
			
                            <div class="form-group">
								<i class="fa fa-exclamation-triangle"></i><strong> Panduan Import
                                    Mahasiswa</strong </div> </div> </div> 
                                <ol class="panduan-pengisian">
								    <li>Ekstensi File yang didukung hanya .xlsx</li>
								    <li>Data yang diimport harus mengikuti template yang sudah disediakan. <a
										href="<?= base_url('public/template-excel/import_mahasiswa.xlsx'); ?>"
										class="btn btn-success btn-xs"><i class="fas fa-file-excel"></i> Unduh Template
										Excel</a></li>
								</ol>

								<input type="file" name="file" class="form-control">
                            </div>
				            
							<div class="form-group">
								<input type="submit" name="submit" value="Upload" class="btn btn-default pull-right">
							</div>
                      
					<?php echo form_close();
                }
                ?>
    </div>
</div>

						