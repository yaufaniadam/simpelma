<div class="row">
    <div class="col-md-8">
        <div class="card card-success card-outline">
            <div class="card-body box-profile">
                <table class="table table-striped table-bordered">
                    <?php foreach ($kategori_surat as $kategori) :
                        echo "<tr>";
                        echo "<td>" . $kategori['kategori_surat'] . "</td><td class='text-center'><a class='btn btn-info btn-sm' href='" . base_url('admin/kategorisurat/edit/' . $kategori['id']) . "'><i class='fas fa-pencil-alt'></i> Edit</a></td>";
                        echo "</tr>";
                    endforeach;
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>