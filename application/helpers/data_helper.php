<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


// -----------------------------------------------------------------------------
function getUserbyId($id)
{
	$CI = &get_instance();
	return $CI->db->get_where('profil', array('id_user' => $id))->row_array()['nama'];
}


function indonesian_date($timestamp = '', $date_format = 'j F Y', $suffix = 'WIB')
{
	if (trim($timestamp) == '') {
		$timestamp = time();
	} elseif (!ctype_digit($timestamp)) {
		$timestamp = strtotime($timestamp);
	}
	# remove S (st,nd,rd,th) there are no such things in indonesia :p
	$date_format = preg_replace("/S/", "", $date_format);
	$pattern = array(
		'/Mon[^day]/', '/Tue[^sday]/', '/Wed[^nesday]/', '/Thu[^rsday]/',
		'/Fri[^day]/', '/Sat[^urday]/', '/Sun[^day]/', '/Monday/', '/Tuesday/',
		'/Wednesday/', '/Thursday/', '/Friday/', '/Saturday/', '/Sunday/',
		'/Jan[^uary]/', '/Feb[^ruary]/', '/Mar[^ch]/', '/Apr[^il]/', '/May/',
		'/Jun[^e]/', '/Jul[^y]/', '/Aug[^ust]/', '/Sep[^tember]/', '/Oct[^ober]/',
		'/Nov[^ember]/', '/Dec[^ember]/', '/January/', '/February/', '/March/',
		'/April/', '/June/', '/July/', '/August/', '/September/', '/October/',
		'/November/', '/December/',
	);
	$replace = array(
		'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min',
		'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu',
		'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des',
		'Januari', 'Februari', 'Maret', 'April', 'Juni', 'Juli', 'Agustus', 'Sepember',
		'Oktober', 'November', 'Desember',
	);
	$date = date($date_format, $timestamp);
	$date = preg_replace($pattern, $replace, $date);
	$date = "{$date} {$suffix}";
	return $date;
}

function getUserPhoto($id)
{

	$CI = &get_instance();
	return $CI->db->get_where('profil', array('id_user' => $id))->row_array()['photo'];
}

function transposeData($data)
{
	$retData = array();
	foreach ($data as $row => $columns) {
		foreach ($columns as $row2 => $column2) {
			$retData[$row2][$row] = $column2;
		}
	}
	return $retData;
}

function countSurat($status)
{
	$CI = &get_instance();
	$query = $CI->db->query("SELECT COUNT(*) as JUMLAH
		FROM surat_status s
		WHERE s.id_surat NOT IN (SELECT ss.id_surat FROM surat_status ss WHERE ss.id_status='3') AND s.id_status!='1'
        ");
	$result = $query->row_array();
	return $result['JUMLAH'];
}
//menampilkan kategori keterangan surat
function kat_keterangan_surat($id)
{
	$CI = &get_instance();
	return $CI->db->get_where('kat_keterangan_surat', array('id' => $id))->row_array();
}

//menampilkan kategori keterangan surat
function generate_form_field($id, $id_surat)
{
	$CI = &get_instance();
	$fields = $CI->db->select('kks.*, ks.value')->from('kat_keterangan_surat kks')
		->join('keterangan_surat ks', 'ks.id_kat_keterangan_surat=kks.id', 'left')
		->where(array('kks.id' => $id))
		->where(array('ks.id_surat' => $id_surat))
		->get()->row_array(); ?>

	<?php
	if ($fields['type'] == 'image') {

		$image_id = (validation_errors()) ? set_value('dokumen[' . $id . ']') :  $fields['value'];

		$image = $CI->db->select('*')->from('media')
			->where(array('id' => $image_id))->get()->row_array();
		$thumb = $image['thumb'];
		$image = base_url($thumb);
	?>

		<figure style="background:url('<?= $image; ?>') center center no-repeat" class="d-flex align-items-center justify-content-center upload-dokumen <?= (form_error('dokumen[' . $id . ']')) ? 'is-invalid' : ''; ?>">
			<?php if ($thumb) { ?>
				<button id="opener-<?= $id; ?>" class="opener hapus btn btn-danger btn-md" type="button"><i class="fas fa-trash"></i> Hapus</button>
			<?php } else { ?>
				<button id="opener-<?= $id; ?>" class="opener btn btn-info btn-md" type="button" data-toggle="modal" data-target="#fileUploader"><i class="fas fa-plus"></i> Upload</button>
			<?php } ?>

			<input type="hidden" value="<?= (validation_errors()) ? set_value('dokumen[' . $id . ']') :  $fields['value'];  ?>" class="dokumen" id="input-<?= $id; ?>" name="dokumen[<?= $id; ?>]" />
		</figure>
		<span class="text-danger"><?php echo form_error('dokumen[' . $id . ']'); ?></span>

	<?php } elseif ($fields['type'] == 'textarea') { ?>

		<textarea class="form-control <?= (form_error('dokumen[' . $id . ']')) ? 'is-invalid' : ''; ?>" id="input-<?= $id; ?>" name="dokumen[<?= $id; ?>]"><?= (validation_errors()) ? set_value('dokumen[' . $id . ']') :  $fields['value'];  ?></textarea>
		<span class="text-danger"><?php echo form_error('dokumen[' . $id . ']'); ?></span>

	<?php }
}

function fileUploaderModal()
{
	$CI = &get_instance();
	$CI->db->order_by('id', 'DESC');
	$media = $CI->db->get_where('media', array('id_user' => $CI->session->userdata('user_id')))->result_array();

	?>

	<div id="fileUploader" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Pilih File</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a class="nav-item nav-link active" id="nav-upload-tab" data-toggle="tab" href="#nav-upload" role="tab" aria-controls="nav-upload" aria-selected="true">Upload</a>
							<a class="nav-item nav-link" id="nav-galeri-tab" data-toggle="tab" href="#nav-galeri" role="tab" aria-controls="nav-galeri" aria-selected="false">Galeri</a>

						</div>
					</nav>

					<div class="tab-content" id="nav-tabContent">
						<div class="tab-pane fade show active" id="nav-upload" role="tabpanel" aria-labelledby="nav-upload-tab">
							<form class="mb-3 mt-3 dm-uploader p-5" id="drag-and-drop-zone">
								<div class="form-row">
									<div class="col-md-12 col-sm-12">
										<div class="form-group mb-2">
											<input type="hidden" class="value" value="" />

											<input type="hidden" class="form-control" aria-describedby="fileHelp" placeholder="No image uploaded..." readonly="readonly">

											<div class="progress mb-2 d-none">
												<div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0">
													0%
												</div>
											</div>

										</div>
										<div class="form-group">
											<div role="button" class="btn btn-primary">
												<i class="fas fa-folder fa-fw"></i> Cari file atau seret ke sini
												<input type="file" title="Klik untuk menambahkan file">

											</div>

										</div>
									</div>

								</div>

							</form>

						</div>
						<div class="tab-pane fade" id="nav-galeri" role="tabpanel" aria-labelledby="nav-galeri-tab">
							<small class="status text-muted"></small>
							<div class="row pt-3 pb-3 " id="files">
								<?php
								foreach ($media as $row) { ?>
									<div class="col-md-3 media mb-3">
										<figure class="img-thumbnail d-flex align-items-center justify-content-center" style="min-height:200px; border:1px solid #ddd;">
											<a title="Klik pada file yang ingin digunakan" href="#" class="link" id="<?= $row['id']; ?>">
												<img class="img rounded mx-auto d-block" src="<?= base_url($row['thumb']); ?>" width="100%" height="auto" />
											</a>
											<figure>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>

				</div>
			</div>
		</div>
	</div>

	<!-- File item template -->
	<script type="text/html" id="files-template">
		<div class="col-md-3 media mb-3">
			<figure class="img-thumbnail d-flex align-items-center justify-content-center" style="min-height:200px; border:1px solid #ddd;">
				<a title="Klik pada file yang ingin digunakan" href="#" class="link" id="%%id%%">
					<img class="img rounded mx-auto d-block" src="<?= base_url(); ?>%%filename%%" width="100%" height="auto" />
				</a>
			</figure>
		</div>
	</script>

	<script src="<?= base_url() ?>/public/vendor/danielupload/dist/js/jquery.dm-uploader.min.js"></script>
	<script src="<?= base_url() ?>/public/vendor/danielupload/demo/ui-single.js"></script>

	<script>
		$(function() {

			$('#drag-and-drop-zone').dmUploader({ //
				url: '<?= base_url('mahasiswa/surat'); ?>/doupload/',
				maxFileSize: 3000000, // 3 Megs max
				multiple: false,
				allowedTypes: 'image/*',
				extFilter: ['jpg', 'jpeg', 'png', 'gif'],
				onDragEnter: function() {
					// Happens when dragging something over the DnD area
					this.addClass('active');
				},
				onDragLeave: function() {
					// Happens when dragging something OUT of the DnD area
					this.removeClass('active');
				},
				onInit: function() {
					this.find('input[type="text"]').val('');
				},
				onComplete: function() {

				},
				onNewFile: function(id, file) {

					if (typeof FileReader !== "undefined") {
						var reader = new FileReader();
						var img = this.find('img');

						reader.onload = function(e) {
							img.attr('src', e.target.result);
						}
						reader.readAsDataURL(file);
					}

				},
				onBeforeUpload: function(id) {
					ui_single_update_progress(this, 0, true);
					ui_single_update_active(this, true);

					ui_single_update_status(this, 'Uploading...');
				},
				onUploadProgress: function(id, percent) {
					// Updating file progress
					ui_single_update_progress(this, percent);
				},
				onUploadSuccess: function(id, data) {
					var response = JSON.stringify(data);
					var obj = JSON.parse(response);

					ui_single_update_active(this, false);

					this.find('input[type="text"]').val(response);

					ui_single_update_status(this, 'Upload completed.', 'success');

					var template = $('#files-template').text();
					template = template.replace('%%filename%%', obj.thumb);
					template = template.replace('%%id%%', obj.id);

					template = $(template);
					template.prop('id', 'uploaderFile' + id);
					template.data('file-id', id);

					$('#files').prepend(template);

					$('#nav-tab a[href="#nav-galeri"]').tab('show');
				},
				onUploadError: function(id, xhr, status, message) {
					// Happens when an upload error happens
					ui_single_update_active(this, false);
					ui_single_update_status(this, 'Error: ' + message, 'danger');
				},

				onFileSizeError: function(file) {
					//   ui_single_update_status(this, 'File excess the size limit', 'danger');

					// ui_add_log('File \'' + file.name + '\' cannot be added: size excess limit', 'danger');
				},
				onFileTypeError: function(file) {
					ui_single_update_status(this, 'File type is not an image', 'danger');

					// ui_add_log('File \'' + file.name + '\' cannot be added: must be an image (type error)', 'danger');
				},
				onFileExtError: function(file) {
					ui_single_update_status(this, 'File extension not allowed', 'danger');

					//ui_add_log('File \'' + file.name + '\' cannot be added: must be an image (extension error)', 'danger');
				}
			});
		});

		$("button.opener").click(function(event) {
			$('.value').val(event.target.id);
		});

		$(document).on('click', '.link', function() {

			var link = $(this).attr('id'); /*ambil id gambar */
			var img = $(this).children().attr('src'); /*ambil id gambar */
			var value = $('.value').val(); /* ambil id button */
			console.log(value);
			var openerinput = $("#" + value).siblings(".dokumen").attr("id");

			$("#" + openerinput).val(link); /*insert value ke field hidden */
			$("#" + openerinput).parent("figure").siblings('span.text-danger').hide();
			$("#" + openerinput).parent("figure").removeClass('is-invalid');
			$("#" + openerinput).parent("figure").css('background-image', 'none');
			$("#" + openerinput).parent("figure").css('background', 'url("' + img + '") center center no-repeat');

			$('#fileUploader').modal('hide');
			$("#" + value).html('<i class="fas fa-plus"></i> Hapus');
			$("#" + value).addClass('btn-danger hapus').removeClass('btn-info');
			$("#" + value).removeAttr('data-toggle data-target');

			return false;
		})

		$(document).on('click', '.hapus', function() {

			$(this).siblings(".dokumen").val('');
			$(this).parent("figure").css('background', 'none');
			$(this).parent("figure").css('background', 'none');
			$(this).addClass('btn-info').removeClass('btn-danger hapus');
			$(this).html('<i class="fas fa-plus"></i> Upload');
			$(this).attr("data-toggle", "modal").attr("data-target", "#fileUploader");

		})
		$('textarea.form-control').on('keyup', function(e) {
			$(this).removeClass('is-invalid');
			$(this).siblings('span.text-danger').hide();
		})
	</script>

<?php }


//menampilkan kategori keterangan surat
function generate_keterangan_surat($id, $id_surat)
{
	$CI = &get_instance();
	$fields = $CI->db->select('kks.*, ks.value')->from('kat_keterangan_surat kks')
		->join('keterangan_surat ks', 'ks.id_kat_keterangan_surat=kks.id', 'left')
		->where(array('kks.id' => $id))
		->where(array('ks.id_surat' => $id_surat))
		->get()->row_array(); ?>

	<?php
	if ($fields['type'] == 'image') {

		$image_id = (validation_errors()) ? set_value('dokumen[' . $id . ']') :  $fields['value'];

		$image = $CI->db->select('*')->from('media')
			->where(array('id' => $image_id))->get()->row_array();
		$img_full = $image['file'];
		$thumb = $image['thumb'];
		$image = base_url($thumb);
	?>

		<figure style="background:url('<?= $image; ?>') center center no-repeat" class="d-flex align-items-start justify-content-start preview-dokumen">
			<a data-href="<?= base_url($img_full); ?>" class="opener btn btn-warning btn-md" type="button" data-toggle="modal" data-target="#fileZoom"><i class="fas fa-search-plus"></i></a>
			
		</figure>

	<?php } elseif ($fields['type'] == 'textarea') { ?>

		<textarea class="form-control" id="input-<?= $id; ?>" disabled><?= $fields['value'];  ?></textarea>

	<?php } ?>

	<div id="fileZoom" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Preview</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<figure class="img_full"></figure>					
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>

				</div>
			</div>
		</div>
	</div>

	<script>
		$("a.opener").click(function(event) {
			var $gbr = $(this).attr('data-href');
			console.log($gbr);
			$('.img_full').empty();
			$('.img_full').prepend("<img style='width:100%;' src=" + $gbr + " />");
		});
		
	</script>

<?php }
