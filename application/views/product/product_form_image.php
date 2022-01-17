<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

<h2 style="margin-top:0px">Upload gambar Product </h2>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3"> </div>
    <div class="card-body">

	<form action="<?= base_url('Product/fileUpload') ?>" enctype="multipart/form-data" class="dropzone" id="image-upload">

		<input type="hidden" name="request" value="add">
		<input type="hidden" class="form-control" name="id_user" id="id_user" placeholder="Id User" value="" />

        <input type="hidden" class="form-control" name="id_produk" id="id_produk" placeholder="Id User"
                value="<?php echo $id_produk; ?>" />

			<div> 
			<h3>Drag gambar kesini untuk mengunggah foto produk</h3> 
			</div> 
		</form> 
		<a href="<?php echo site_url('product') ?>" class="btn btn-success">Selesai</a>
    </div>


    <script type="text/javascript"> 

    Dropzone.autoDiscover = false; 
    var myDropzone = new Dropzone(".dropzone", { 
        acceptedFiles: ".png",
        maxFilesize: 1, // MB
        // addRemoveLinks: true, 
        renameFile: function (file) {
            console.log(file);
            let newName = new Date().getTime() + '_' +'.png';
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
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) :
                void 0;
        }
    });
    </script>
