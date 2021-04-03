<!DOCTYPE html>
<html>
<head>
	<title>TUGAS GIT PI</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		
	<h1 class="text-center">Universitas</h1>
	<h2 class="text-center">Sumatera Utara</h2>

	<!-- Awal card form -->
	<div class="card" mt-3>
	  <div class="card-header bg-primary text-white">
	    Form Input Data Mahasiswa
	  </div>
	  <div class="card-body">
	   <form method="post" action="" >
	   	<div class="form-group">
	   		<label>Nim</label>
	   		<input type="text" name="tnim" value="<?=@$vnim?>" class="form-control" placeholder="Input Nim anda di sini!" required>
	   	</div>
	   	<div class="form-group">
	   		<label>Nama</label>
	   		<input type="text" name="tnama" value="<?=@$vnama?>" class="form-control" placeholder="Input Nama anda di sini!" required>
	   	</div>
	   	<div class="form-group">
	   		<label>Alamat</label>
	   		<textarea class="form-control" name="talamat" placeholder="Input Alamat anda di sini!"><?=@$valamat?></textarea>
	   	</div>
	   	<div class="form-group">
	   		<label>Program studi</label>
	   		<select class="form-control" name="tprodi">
	   			<option value="<?=@$vprodi?>"><?=@$vprodi?></option>
	   			<option value="S1-TI">S1-TI</option>
	   			<option value="S1-Ilmu Komputer">S1-Ilmu Komputer</option>
	   			<option value="S2-TI">S2-TI</option>
	   		</select>
	   	</div>

	   	<button type="submit" class="btn btn-success" name="bsimpan">Simpan</button>
	   	<button type="reset" class="btn btn-danger" name="breset">Kosongkan</button>

	   </form>
	  </div>
	</div>
	<!-- Akhir card form -->

	<!-- Awal card tabel -->
	<div class="card" mt-3>
	  <div class="card-header bg-success text-white">
	    Daftar Mahasiswa
	  </div>
	  <div class="card-body">
	  
	  	<table class="table table-bordered table-stripped">
	  		<tr>
	  			<th>No</th>
	  			<th>Nim</th>
	  			<th>Nama</th>
	  			<th>Alamat</th>
	  			<th>program Studi</th>
	  			<th>Aksi</th>
	  		</tr>
	  		<?php
	  			$no = 1;
	  			$tampil = mysqli_query($koneksi, "SELECT * from tmhs order by id_mhs desc");
	  			while($data = mysqli_fetch_array($tampil)) : 

	  		?>
	  		<tr>
	  			<td><?=$no++;?></td>
	  			<td><?=$data['nim']?></td>
	  			<td><?=$data['nama']?></td>
	  			<td><?=$data['alamat']?></td>
	  			<td><?=$data['prodi']?></td>
	  			<td>
	  				<a href="index.php?hal=edit&id=<?=$data['id_mhs']?>" class="btn btn-warning">Edit</a>
	  				<a href="index.php?hal=hapus&id=<?=$data['id_mhs']?>" onclick="return confirm('Apakah yakin ingin menghapus data ini?')" class="btn btn-danger">Hapus</a>
	  			</td>
	  		</tr>
	  	<?php endwhile; // penutup perulangan while ?>
	  	</table>

	  </div>
	</div>
	<!-- Akhir card tabel -->
</div>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>
