<form class="mb-3 mt-3 dm-uploader p-4" id="drag-and-drop-zone">
	<div class="form-row">
		<div class="col-md-12 col-sm-12">
			<div class="from-group mb-2">

				<input type="text" class="form-control" aria-describedby="fileHelp" placeholder="No image uploaded..."
					readonly="readonly">

				<div class="progress mb-2 d-none">
					<div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar"
						style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0">
						0%
					</div>
				</div>

			</div>
			<div class="form-group">
				<div role="button" class="btn btn-primary">
					<i class="fas fa-folder fa-fw"></i> Browse Files
					<input type="file" title="Click to add Files">

				</div>

			</div>
		</div>
	</div>
</form>

<div class="col-md-12 col-sm-12">
	<div class="card h-100">
		<div class="card-header">
			File List
		</div>

		<div class="row" id="files">
			<?php foreach ($media as $row) { ?>
			<div class="col-md-4 media"><img src="<?= base_url($row['file']); ?>" width="100%" height="auto"/></div>
			<?php } ?>
		</div>
	</div>
</div>





<!-- File item template -->
<script type="text/html" id="files-template">
	<div class="col-md-4">
		<img src="<?= base_url(); ?>%%filename%%" width="100%" height="auto" />			
	</div>
</script>

