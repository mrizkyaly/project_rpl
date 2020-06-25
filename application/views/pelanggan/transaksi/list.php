<p>
  <a href="<?php echo base_url('pelanggan/transaksi/beli') ?>" class="btn btn-success btn-m">
    <i class="nav-icon fa fa-plus"></i> Beli Produk</a>
</p>

<?php  
  // Notifikasi
  if ($this->session->flashdata('sukses')) {
    echo '<p class="alert alert-success">';
    echo $this->session->flashdata('sukses');
  }
?>

<table id="example2" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>NO</th>
      <th>GAMBAR</th>
      <th>NAMA</th>
      <th>KATEGORI</th>
      <th>JENIS</th>
      <th>UKURAN</th>
      <th>HARGA</th>
      <th>USER</th>
    </tr>
  </thead>
  <tbody>
    <?php $no=1; foreach ($produk as $produk) { ?>
      <tr>
        <td><?php echo $no ?></td>
        <td>
          <img src="<?php echo base_url('assets/upload/image/thumbs/'.$produk->gambar) ?>" class="img img-responsive img-thumbnail" width="70">
        </td>
        <td><?php echo $produk->nama_produk ?></td>
        <td><?php echo $produk->nama_kategori ?></td>
        <td><?php echo $produk->nama_jenis ?></td>
        <td><?php echo $produk->ukuran ?></td>
        <td><?php echo number_format($produk->harga,'0',',','.') ?></td>
        <td><?php echo $produk->username ?></td>
      </tr>
    <?php $no++; } ?>
  </tbody>
</table>