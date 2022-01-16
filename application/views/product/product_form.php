 
 <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

 
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
                     <option value='<?= $key->kd_kategori ?>'
                         <?php if($key->kd_kategori==$kd_kategori){ echo "selected"; } ?>><?= $key->nm_kategori ?>
                     </option>
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
             <input type="hidden" name="id_produk" value="<?php echo $id_produk; ?>" id="id_produk" />
             <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
             <a href="<?php echo site_url('product') ?>" class="btn btn-warning">Cancel</a>
         </form>

		<form action="uploadFile.php" class="dropzone" >  

		</form> 

		 <!-- <table class="table">
                     <?php
					foreach ($gambar as $key ) { ?>
                     <tr>
                         <td>
                             <img src="<?= base_url()."uploads/".$key->gambar ?>" width="auto" height="100">
                         </td>
                         <td> <a href="<?php echo site_url('product/hapusGambar/'.$key->id_detail) ?>"
                                 class="btn btn-danger">Hapus</a> </td> 
                     </tr>
                     <?php } ?>
                 </table> -->

         <script src="<?php echo base_url()."/assets" ?>/ckeditor/ckeditor.js"></script>
         <script src="<?php echo base_url()."/assets" ?>/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

         <script>
         $(function() {
             // Replace the <textarea id="editor1"> with a CKEditor 
             // instance, using default configuration. 
             CKEDITOR.replace('editor1') 
         })

         $(document).ready(function() {
             $("#kd_kategori").select2();
         });
         </script>


<script type="text/javascript"> 
  Dropzone.autoDiscover = false;

  $(".dropzone").dropzone({
    init: function() {

      myDropzone = this;
      $.ajax({
        url: '<?= base_url('Product/fileUpload') ?>', 
        type: 'post',
        data: {
			request: 'fetch',
			id_produk: '3b5609d7-76c0-11ec-a087-74852a1cb96f'
		},
        dataType: 'json',
        success: function(response){
          $.each(response, function(key,value) {
            var mockFile = { name: value.name, size: value.size};
			myDropzone.emit("addedfile", mockFile);
			myDropzone.emit("thumbnail", mockFile, value.path);
			myDropzone.emit("complete", mockFile);
          });
        }
      });
    }
  });

</script>
