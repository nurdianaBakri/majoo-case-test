<h2 style="margin-top:0px">Product <?php echo $button ?></h2>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                    <!-- </div> -->
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
                    <label for="varchar">Nama Produk<?php echo form_error('nama') ?></label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama"
                        value="<?php echo $nama; ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">Deskripsi Produk<?php echo form_error('deskripsi') ?></label>
                    <textarea id="editor1" value="<?php echo $deskripsi; ?>" class="form-control" name="deskripsi"
                        rows="10" cols="80" required></textarea>

                </div>
                <div class="form-group">
                    <label for="varchar">Kategori <?php echo form_error('kd_kategori') ?></label>
                    <input type="text" class="form-control" name="kd_kategori" id="kd_kategori" placeholder="Kategori"
                        value="<?php echo $kd_kategori; ?>" />
                </div>
                <div class="form-group">
                    <label for="int">Id User <?php echo form_error('id_user') ?></label>
                    <input type="text" class="form-control" name="id_user" id="id_user" placeholder="Id User"
                        value="<?php echo $id_user; ?>" />
                </div>
                <div class="form-group">
                    <label for="timestamp">Date <?php echo form_error('date') ?></label>
                    <input type="text" class="form-control" name="date" id="date" placeholder="Date"
                        value="<?php echo $date; ?>" />
                </div>
                <input type="hidden" name="id_produk" value="<?php echo $id_produk; ?>" />
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                <a href="<?php echo site_url('product') ?>" class="btn btn-default">Cancel</a>
            </form>
        </div>
