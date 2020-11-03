<div class="card card-success card-outline">
    <div class="card-header py-3">
        <button class="btn btn-success" type='button' id='btn' onclick='printDiv();'><i class="fas fa-print"></i> Print</button>
    </div>
    <div class="card-body box-profile">
        <div id='DivIdToPrint'>
            <?php

            $file = FCPATH . 'application/modules/admin/views/surat/template/' . $surat['template'];

            if ($surat['template']) {

                if (file_exists($file)) {
                    include $file;
                } else {
                    echo "template tidak tersedia. Hubungi admin.";
                }
            } else {
                echo "template belum diset. Hubungi admin.";
            } ?>
        </div>
    </div>
</div>


<script>
    function printDiv() {

        var divToPrint = document.getElementById('DivIdToPrint');

        var newWin = window.open('', 'Print-Window');

        newWin.document.open();

        newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');

        newWin.document.close();

        setTimeout(function() {
            newWin.close();
        }, 10);

    }
</script>