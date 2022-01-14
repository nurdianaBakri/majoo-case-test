
<!-- Page Heading --> <h2 style="margin-top:0px">Metode_pembayaran <?php echo $button ?></h2>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
            </div>
        </div>
    </div>
    <div class="card-body">
        
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama Metode Pembayaran <?php echo form_error('nama_metode_pembayaran') ?></label>
            <input type="text" class="form-control" name="nama_metode_pembayaran" id="nama_metode_pembayaran" placeholder="Nama Metode Pembayaran" value="<?php echo $nama_metode_pembayaran; ?>" />
        </div>
	    <div class="form-group">
            <label for="tinyint">Deleted <?php echo form_error('deleted') ?></label>
            <input type="text" class="form-control" name="deleted" id="deleted" placeholder="Deleted" value="<?php echo $deleted; ?>" />
        </div>
	    <input type="hidden" name="kd_pembayaran" value="<?php echo $kd_pembayaran; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('metode_pembayaran') ?>" class="btn btn-default">Cancel</a>
	</form>
</div>