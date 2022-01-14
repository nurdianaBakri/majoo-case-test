<h2 style="margin-top:0px"><?php echo $button ?> Product </h2>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message"> 
                </div>
                <div class="col-md-1 text-right">
                </div>
                <div class="col-md-3 text-right">
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">


        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="varchar">Nama Produk<?php echo form_error('nama') ?></label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama"
                    value="<?php echo $nama; ?>" />
            </div>
            <div class="form-group">
                <label for="varchar">Deskripsi Produk<?php echo form_error('deskripsi') ?></label>
                <textarea id="editor1" class="form-control" name="deskripsi" rows="10" cols="80"
                    required><?php echo $deskripsi; ?></textarea>
            </div> 
            <div class="form-group">
                <label for="int">Kategori <?php echo form_error('kategori') ?></label>
                <select class="form-control" name="kd_kategori" id="kd_kategori" placeholder="kd_kategori">
                    <?php  
						foreach ($kat as $key ) { ?>
                    <option value='<?= $key->kd_kategori ?>'><?= $key->nm_kategori ?></option>
                    <?php } ?>
                </select>
            </div>

			<div class="form-group">
                <label for="int">Harga <?php echo form_error('harga') ?></label>
				<input type="number" class="form-control" name="harga" id="harga" placeholder="harga"
                    value="<?php echo $harga; ?>" />
            </div> 
			
            <input type="hidden" class="form-control" name="id_user" id="id_user" placeholder="Id User"
                value="<?php echo $id_user; ?>" />


            <input type="hidden" name="id_produk" value="<?php echo $id_produk; ?>" />
            <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
            <a href="<?php echo site_url('product') ?>" class="btn btn-default">Cancel</a>
        </form>
    </div>

	<script src="<?php echo base_url()."/assets" ?>/ckeditor/ckeditor.js"></script>
    <script src="<?php echo base_url()."/assets" ?>/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

    <script>
    $(function() {
        // Replace the <textarea id="editor1"> with a CKEditor 
        // instance, using default configuration.

        CKEDITOR.replace('editor1')

        //bootstrap WYSIHTML5 - text editor 
        $('.textarea').wysihtml5() 
    })

    $(document).ready(function() {
        $("#kd_kategori").select2(); 
    });
    </script>
