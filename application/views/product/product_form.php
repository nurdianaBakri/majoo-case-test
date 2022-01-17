 <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
 <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

 <h2 style="margin-top:0px"><?php echo $button ?> Product </h2>
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="card-header py-3"> Data Produk </div>
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

             <div class="row">
                 <div class="col-md-6">

                     <div class="form-group">
                         <label for="int">Kategori <?php echo form_error('kategori') ?></label>
                         <select class="form-control" name="kd_kategori" id="kd_kategori" placeholder="kd_kategori">
                             <?php  
                                foreach ($kat as $key ) { ?>
                             <option value='<?= $key->kd_kategori ?>'
                                 <?php if($key->kd_kategori==$kd_kategori){ echo "selected"; } ?>>
                                 <?= $key->nm_kategori ?>
                             </option>
                             <?php } ?>
                         </select>
                     </div>

                 </div>
                 <div class="col-md-6">
                     <div class="form-group">
                         <label for="int">Harga <?php echo form_error('harga') ?></label>
                         <input type="number" class="form-control" name="harga" id="harga" placeholder="harga"
                             value="<?php echo $harga; ?>" />
                     </div>
                 </div>
             </div>

             <input type="hidden" class="form-control" name="id_user" id="id_user" placeholder="Id User"
                 value="<?php echo $id_user; ?>" />
             <input type="hidden" name="id_produk" value="<?php echo $id_produk; ?>" id="id_produk" />
             <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
             <a href="<?php echo site_url('product') ?>" class="btn btn-warning">Cancel</a>
         </form>
     </div>
 </div>

 <?php if($button=='Update'){ ?>

 <div class="card shadow mb-4">
     <div class="card-header py-3"> Foto Produk </div>
     <div class="card-body">

         <div class="row">
             <div class="col-md-6">
                 <img src="<?= base_url()."uploads/".$gambar ?>" width="200" height="auto">

             </div>
             <div class="col-md-6">
                 <form action="<?= base_url('Product/fileUpload') ?>" enctype="multipart/form-data" class="dropzone"
                     id="image-upload">

                     <input type="hidden" name="request" value="add">
                     <input type="hidden" class="form-control" name="id_user" id="id_user" placeholder="Id User"
                         value="" />

                     <input type="hidden" class="form-control" name="id_produk" id="id_produk" placeholder="Id User"
                         value="<?php echo $id_produk; ?>" />

                     <div>
                         <h3>Drag gambar untuk merubah foto Produk</h3>
                     </div>
                 </form>
             </div>
         </div>
     </div>
     <?php  }  ?> 


     <script src="<?php echo base_url()."/assets" ?>/ckeditor/ckeditor.js"></script>
     <script src="<?php echo base_url()."/assets" ?>/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

     <script>
     $(document).ready(function() {
         CKEDITOR.replace('editor1');

         $("#kd_kategori").select2();
     });

     Dropzone.autoDiscover = false;
     var myDropzone = new Dropzone(".dropzone", {
         acceptedFiles: ".jpg",
         maxFilesize: 1, // MB
         // addRemoveLinks: true, 
         renameFile: function(file) {
             console.log(file);
             let newName = new Date().getTime() + '_' + '.jpg';
             console.log(newName);
             return newName;
         },
         removedfile: function(file) {
             var fileName = file.name;

             $.ajax({
                 type: 'POST',
                 url: '<?= base_url('Product/fileUpload') ?>',
                 data: {
                     name: fileName,
                     request: 'delete'
                 },
                 sucess: function(data) {
                     console.log('success: ' + data);
                 }
             });
             var _ref;
             return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file
                     .previewElement) :
                 void 0;
         }
     });
     </script>
