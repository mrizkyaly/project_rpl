<?php  
	// Notifikasi error
	echo validation_errors('<div class="alert alert-warning">','</div>');

	// Form Open
	echo form_open_multipart(base_url('pelanggan/transaksi/beli'),' class="form_horizontal"');
?>

<div class="card card-primary">
	<div class="card-header"></div>
	<form role="form">
		<div class="card-body">
			<div class="form-group">
				<label>Produk</label>
				<select name="id_produk"class="form-control">
					<?php foreach ($produk as $produk) {?>
						<option value="<?php echo $produk->id_produk ?>">
							<?php echo $produk->nama_produk ?>
						</option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Bayar</label>
				<input type="text" name="bayar" class="form-control" placeholder="Bayar" value="<?php echo set_value('bayar') ?>" required>
			</div>
			<div class="form-group">
				<button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
				<button type="reset" name="reset" class="btn btn-danger"><i class="fa fa-times"></i> Reset</button>
			</div>
		</div>
	</form>
</div>

<?php echo form_close(); ?>