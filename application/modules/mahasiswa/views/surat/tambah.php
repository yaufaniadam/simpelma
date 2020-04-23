<div class="row">
    <div class="col-md-12">
        <p><i class="fa fa-exclamation-triangle"></i> Sebelum mengajukan surat, pastikan semua persyaratan yang dibutuhkan sudah dilengkapi.</p>
        <?php if (isset($msg) || validation_errors() !== '') : ?>
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fas fa-exclamation-triangle"></i> Alert!</h4>
                <?= validation_errors(); ?>
                <?= isset($msg) ? $msg : ''; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?php 
        echo "<pre>";
        print_r($surat); 
        echo "</pre>";
        ?>
        <?php echo form_open_multipart(base_url('mahasiswa/surat/tambah'), '') ?>
        <div class="card card-secondary">

            <div class="card-body">
                
                <?php /* $keterangan_surat = explode(',',$surat['kat_keterangan_surat']); 
                
                echo "<pre>";
                print_r($keterangan_surat); 
                echo "</pre>";
                */
                ?>



                <div class="form-group">
                    <label for="keterangan">Keterangan (opsional)</label>
                    <textarea name="keterangan" id="keterangan" class="form-control" rows="4"><?php if (validation_errors()) {
                                                                                                    echo set_value('keterangan');
                                                                                                } ?></textarea>
                </div>
                

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    <div class="col-md-12 py-4">
        <a href="<?= base_url('mahasiswa/surat'); ?>" class="btn btn-secondary">Batal</a>
        <input type="submit" name="submit" value="Lanjut" class="btn btn-success float-right">
    </div>
    <?php echo form_close(); ?>
</div>