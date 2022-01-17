<h2 style="margin-top:0px">Detail Product</h2>
<table class="table">
    <tr>
        <td>Nama</td>
        <td><?= $nama; ?></td>
    </tr>
    <tr>
        <td>Deskripsi</td>
        <td><?= $deskripsi; ?></td>
    </tr>
    <tr>
        <td>Kategori</td>
        <td><?= $nm_kategori;  ?></td>
    </tr> 
    <tr>
        <td>Tanggal Update</td>
        <td><?= $date; ?></td>
    </tr>
	<tr>
        <td>Harga</td>
        <td><?= number_format($harga,2); ?></td>
    </tr>
 
	<tr>
        <td></td>
        <td>
			<img src="<?= base_url()."uploads/".$gambar ?>"   width="200" height="auto"> 
		</td>
    </tr>   
    <tr>
        <td></td>
        <td><a href="<?= site_url('product') ?>" class="btn btn-warning">Kembali</a></td>
    </tr>


	
</table>
