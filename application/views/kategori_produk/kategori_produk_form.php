
<!-- Page Heading --> <h2 style="margin-top:0px">Kategori_produk <?php echo $button ?></h2>
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
            <label for="varchar">Nm Kategori <?php echo form_error('nm_kategori') ?></label>
            <input type="text" class="form-control" name="nm_kategori" id="nm_kategori" placeholder="Nm Kategori" value="<?php echo $nm_kategori; ?>" />
        </div>
	    <input type="hidden" name="kd_kategori" value="<?php echo $kd_kategori; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('kategori_produk') ?>" class="btn btn-default">Cancel</a>
	</form>
</div>