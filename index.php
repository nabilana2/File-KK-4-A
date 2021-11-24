<?php
    //koneksi
    $server   = "localhost";
    $user     = "root";
    $pass     = "";
    $database = "db_sekolah";

    $koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error());

    
    //untuk button
    if(isset($_POST['ksimpan']))
    {
        //memunculkan
        if($_GET['hal'] == "edit")
        {
            //mengedit data
            $edit = mysqli_query($koneksi, "UPDATE data_siswa SET
                                                nis     = '$_POST[cNIS]',       
                                                nama_siswa = '$_POST[cnama]',       
                                                jenis_kelamin = '$_POST[cjeniskelamin]',       
                                                alamat = '$_POST[calamat]',       
                                                id_jurusan = '$_POST[cidjurusan]',       
                                                jurusan = '$_POST[cjurusan]'
                                              WHERE id_siswa = '$_GET[id]'       
                                            ");
            if($edit)
            {
                echo "<script>
                    alert('edit data success!');
                    document.location= 'index.php';
                </script>";                
            }
            else
            {
                echo "<script>
                    alert('edit data gagal!');
                    document.location= 'index.php';
                </script>";
            }
        }            
        else
        {
            //menyimpan data baru 
            $simpan = mysqli_query($koneksi, "INSERT INTO data_siswa (nis, nama_siswa, jenis_kelamin, alamat, id_jurusan, jurusan)
                                              VALUES ('$_POST[cNIS]', 
                                                      '$_POST[cnama]', 
                                                      '$_POST[cjeniskelamin]', 
                                                      '$_POST[calamat]', 
                                                      '$_POST[cidjurusan]', 
                                                      '$_POST[cjurusan]')       
                                            ");
            if($simpan){
                echo "<script>
                alert('simpan data succes!');
                document.location= 'index.php';
                </script>";                
            }else{
                echo "<script>
                alert('simpan data gagal!');
                document.location= 'index.php';
                </script>";
            }
        }      
    }    
   

    //tombol edit atau hapus
    if(isset($_GET['hal']))
    {
        //tampilan yang akan diedit
        if($_GET['hal'] == 'edit')
        {
            $tampil = mysqli_query($koneksi, "SELECT * FROM data_siswa WHERE id_siswa = '$_GET[id]'");
            $data = mysqli_fetch_array($tampil);            
            if($data)
            {
                $hNIS  = $data['nis'];
                $hnama = $data['nama_siswa'];
                $hjeniskelamin = $data['jenis_kelamin'];
                $halamat = $data['alamat'];
                $hidjurusan = $data['id_jurusan'];
                $hJurusan = $data['jurusan'];
            }
        }
        else if ($_GET['hal'] == "hapus")
        {
            //hapus data
            $hapus = mysqli_query($koneksi, "DELETE FROM data_siswa WHERE id_siswa = '$_GET[id]' ");
            if($hapus){
                echo "<script>
                        alert('hapus data berhasil!');
                        document.location= 'index.php';
                    </script>";
            }
        }
    }
   
   
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BIODATA SISWA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" href="51704590.jpg">
    <style>
        .text-center{
            margin-top:18px;
        }
    </style>

</head>
<body>
<div class="container">
    <h3 class="text-center">Biodata Siswa</h3>
    <h3 class="text-center">XI RPL 6</h3>

    <h5>Mau Cari Siapa?</h5>
    
    <form action="index.php" method="get">
        <label>Cari Siswa XI RPL 6:</label>
        <input type="text" name="cari">
        <input type="submit" value="cari">       
    </form>


    <!--Awal Card -->
    <div class="card mt-3">
        <div class="card-header">
            <h5>Masukan Biodata Kamu</h5>
        </div>
        <div class="card-body ">
            <form method="POST" action="">                
                <div class="form-group mt-3">
                    <label>NIS</label>
                    <input type="text" name="tNIS" value="<?=@$vNIS?>" class="form-control" placeholder="Masukan NIS Kamu" required>
                </div>
                <div class="form-group mt-3">
                    <label>Nama</label>
                    <input type="text" name="tnama" value="<?=@$vnama?>"class="form-control" placeholder="Masukan Nama Lengkap Kamu" required>
                </div>
                <div class="form-group mt-3">
                    <label>Jenis Kelamin</label>
                    <input type="text" name="tjeniskelamin" value="<?=@$vjeniskelamin?>" class="form-control" placeholder="Masukan Jenis Kelamin Kamu" required>
                </div>
                <div class="form-group mt-3">
                    <label>Alamat</label>
                    <textarea class="form-control" name="talamat" placeholder="Masukan Alamat Kamu"><?=@$valamat?></textarea>
                </div>
                <div class="form-group mt-3">
                    <label>ID Jurusan</label>
                    <input type="text" name="tidjurusan" value="<?=@$vidjurusan?>" class="form-control" placeholder="Masukan ID Jurusan Kamu" required>
                </div>
                <div class="form-group mt-3">
                    <label>Jurusan</label>
                    <select class= "form-control" name="cjurusan" >
                        <option value="<?=@$vJurusan?>">--Apa Jurusanmu?--</option>
                        <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>

                    </select>
                </div>

                <button type="submit" class="btn btn-success mt-3" name="bsimpan">Save</button>
                
            </form>
        </div>`
    </div>
    <!--Akhir Card 1-->
    

     <!--Awal Card 2-->
     <div class="card mt-3 mb-5">
        <div class="card-header bg-secondary text-white">
            <h5> Daftar Biodata Siswa XI RPL 6</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th>No.</th>                    
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>ID Jurusan</th>
                        <th>Jurusan</th>
                        <th>Aksi</th>
                    </tr>
                </thead> 
                <tbody>
                    <?php
                    $no= 1;
                    $query = mysqli_query($koneksi, "SELECT * FROM data_siswa");

                    if(isset($_GET['cari'])){
                        $query = mysqli_query($koneksi, "SELECT * FROM data_siswa WHERE nama_siswa LIKE '%".
                            $_GET['cari']."%'");

                    }

                    while ($dt = mysqli_fetch_assoc($query))
                    {
                    ?>

                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $dt['nis']; ?></td>
                        <td><?= $dt['nama_siswa']; ?></td>
                        <td><?= $dt['jenis_kelamin']; ?></td>
                        <td><?= $dt['alamat']; ?></td>
                        <td><?= $dt['id_jurusan']; ?></td>
                        <td><?= $dt['jurusan']; ?></td>
                        <td>
                            <a href="index.php?hal=edit&id=<?=$dt['id_siswa']?>" class="btn btn-warning">Edit</a>
                            <a href="index.php?hal=hapus&id=<?=$dt['id_siswa']?>" onclick="return confirm('ingin menghapus data?')" class="btn btn-danger">Hapus</a>
                        </td>
                        
                    </tr>

                    <?php
                    }
                    ?>
                </tbody>              
               

               
        
            </table>
        </div>`
    </div>
    <!--Akhir Card 2-->



</div> 


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

