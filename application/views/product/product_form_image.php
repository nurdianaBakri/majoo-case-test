<h2 style="margin-top:0px">Upload Image Product </h2>
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
                    value="<?php echo $nama; ?>" readonly/>
            </div> 
			<div class="form-group">
                <label for="int">Gambar <?php echo form_error('gambar') ?></label>
				<input type="file" class="form-control" name="gambar" id="gambar" placeholder="gambar"
                    />
            </div> 

            <input type="hidden" class="form-control" name="id_user" id="id_user" placeholder="Id User"
                value="" />

			<input type="hidden" class="form-control" name="id_produk" id="id_produk" placeholder="Id User"
                value="<?php echo $id_produk; ?>" /> 

            <input type="hidden" name="id_produk" value="<?php echo $id_produk; ?>" />
            <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
            <a href="<?php echo site_url('product') ?>" class="btn btn-default">Cancel</a>
        </form>
    </div>
 