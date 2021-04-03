<?php
  // koneksi database
	$server = "localhost";
	$user = "root";
	$pass = "";
	$database =	"tugasgit-pi";

	$koneksi =	mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));

	// jika tombol simpan di klik
	if(isset($_POST['bsimpan']))
	{
		// pengujian apakah data akan diedit atau disimpan baru
		if($_GET['hal'] == "edit")
		{
			 // Data akan diedit
				$edit = mysqli_query($koneksi, " UPDATE tmhs set
												nim = '$_POST[tnim]',
												nama = '$_POST[tnama]',
												alamat = '$_POST[talamat]',
												prodi = '$_POST[tprodi]'
												WHERE id_mhs = '$_GET[id]'
											   ");
			if($edit) //jika edit sukses
			{
				echo "<script>
						alert('edit data sukses!');
						document.location='index.php';
					</script>";
			}
			else
			{
				echo "<script>
						alert('edit data GAGAL!!');
						document.location='index.php';
					</script>";
			}	
		}
		else
		{
			// data akan disimpan baru
				$simpan = mysqli_query($koneksi, "INSERT INTO tmhs (nim, nama, alamat, prodi)
											VALUES ('$_POST[tnim]',
											 '$_POST[tnama]', 
											 '$_POST[talamat]',
											  '$_POST[tprodi]')
											");
			if($simpan) //jika simpan sukses
			{
				echo "<script>
						alert('Simpan data sukses!');
						document.location='index.php';
					</script>";
			}
			else
			{
				echo "<script>
						alert('Simpan data GAGAL!!');
						document.location='index.php';
					</script>";
			}	
		}


		
	}


// pengujian jika tombol edit atau hapus di klik
	if(isset($GET['hal']))
	{
		 // pengujian jika edit data
		if($_GET['hal'] == "edit")
		{
			// tampilkan data yang akan edit
			$tampil = mysqli_query($koneksi, "SELECT * FROM tmhs WHERE id_mhs = '$_GET[id]' ");
			$data = mysqli_fetch_array($tampil);
			if($data)
			{
				// jika data ditemukan, maka data ditampung dulu ke dalam variabel
				$vnim = $data['nim'];
				$vnama = $data['nama'];
				$valamat = $data['alamat'];
				$vprodi = $data['prodi'];
			}
		}
		else if($_GET['hal'] == "hapus")
		{
			// persiapan hapus data
			$hapus = mysqli_query($koneksi, "DELETE FROM tmhs WHERE id_mhs = '$_GET[id]' ");
			if($hapus){
				echo "<script>
						alert('Hapus data sukses!!');
						document.location='index.php';
					</script>";
			}
		}
	}

?>

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