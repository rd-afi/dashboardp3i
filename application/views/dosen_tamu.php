<!DOCTYPE html>
<html lang="en">

<?php
$this->load->view('bar/head');
?>

        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Data Dosen Tamu</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Dosen Tamu</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-md-12">
                        <?php 
                        $sms = $this->session->flashdata('msg');
                        if($this->session->userdata('msg') != ""){
                            echo '
                            <div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Error!</strong> '.$sms.'
                            </div>
                            ';
                        }
                        
                        ?> 
                            <div class="card">
                                <div class="card-body p-b-0">
                                    <!-- <h4 class="card-title">Customtab2 Tab</h4> -->
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs customtab2" role="tablist">
                                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tab" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Tabel</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#input" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Input</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#upload" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Uploads</span></a> </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab" role="tabpanel">
                                            <div class="p-20">
                                                <table id="myTable" class="table table-responsive table-striped table-bordered table-hover display nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Negara Asal</th>
                                                <th>Nama Perusahaan</th>
                                                <th>Nama Kegiatan</th>
                                                <th>Jabatan</th>
                                                <th>Pendidikan Terakhir</th>
                                                <th>Tanggal Pelaksanaan</th>
                                                <th>Uraian Kegiatan</th>
                                                <th>Tempat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $no = 1;
                                            foreach($dosen_tamu as $d){ 
                                            ?>
                                            <tr>
                                                <td><?php echo $d->no ?></td>
                                                <td><?php echo $d->nama ?></td>
                                                <td><?php echo $d->gender ?></td>
                                                <td><?php echo $d->negara_asal ?></td>
                                                <td><?php echo $d->nama_perusahaan ?></td>
                                                <td><?php echo $d->nama_kegiatan ?></td>
                                                <td><?php echo $d->jabatan ?></td>
                                                <td><?php echo $d->pendidikan_terakhir ?></td>
                                                <td><?php echo $d->tgl_pelaksanaan ?></td>
                                                <td><?php echo $d->uraian_kegiatan ?></td>
                                                <td><?php echo $d->tempat ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane p-20" id="input" role="tabpanel">2</div>
                                        <div class="tab-pane" id="upload" role="tabpanel">
                                            <div class="p-20">
                                                    <div class="button-list">
                                                <!-- <form action="<?php echo base_url();?>datadsn/importir/" method="post" enctype="multipart/form-data"> -->
                                                <form action="<?php echo base_url();?>dosen_tamu/form/" method="post" enctype="multipart/form-data">
                                                        <div class="btn-group">
                                                            <input class="btn btn-success" type="file" name="file"/>
                                                            <input class="btn btn-primary" type="submit" name="preview" value="Upload file"/>
                                                        </div>
                                                </form>
                                                <!-- <button class="btn btn-success btn-rounded ">Preview</button> -->
                                                    </div>
                                            </div>
                                            <?php
                                            if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form 
                                                if(isset($upload_error)){ // Jika proses upload gagal
                                                    echo "<div style='color: red;'>".$upload_error."</div>"; // Muncul pesan error upload
                                                    die; // stop skrip
                                                }
                                                echo "<div style='overflow-x:auto;'>";
                                                // Buat sebuah tag form untuk proses import data ke database
                                                echo "<form method='post' action='".base_url("dosen_tamu/import")."'>";
                                                
                                                // Buat sebuah div untuk alert validasi kosong
                                                echo "<div style='color: red;' id='kosong'>
                                                Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
                                                </div>";
                                                
                                                echo "<table border='1' cellpadding='8'>
                                                <tr>
                                                    <th colspan='10'>Preview Data</th>
                                                </tr>
                                                <tr>
                                                    <th>Nama Tenaga Ahli / Pakar</th>
                                                    <th>Gender</th>
                                                    <th>Negara Asal</th>
                                                    <th>Nama Perusahaan / Instansi Tenaga Ahli</th>
                                                    <th>Nama Kegiatan</th>
                                                    <th>Jabatan Tenaga Ahli</th>
                                                    <th>Pendidikan Terakhir Tenaga Ahli</th>
                                                    <th>Waktu Pelaksanaan</th>
                                                    <th>Uraian Kegiatan</th>
                                                    <th>Tempat</th>
                                                </tr>";
                                                
                                                $numrow = 1;
                                                $kosong = 0;
                                                
                                                // Lakukan perulangan dari data yang ada di excel
                                                // $sheet adalah variabel yang dikirim dari controller
                                                foreach($sheet as $row){ 
                                                    // Ambil data pada excel sesuai Kolom
                                                    $nama = $row['A']; // Ambil data nama
                                                    $gender = $row['B']; // Ambil data gender
                                                    $negara_asal = $row['C']; // Ambil data jenis kelamin
                                                    $nama_perusahaan = $row['D']; // Ambil data alamat
                                                    $nama_kegiatan = $row['E']; // Ambil data alamat
                                                    $jabatan = $row['F']; // Ambil data alamat
                                                    $pendidikan_terakhir = $row['G']; // Ambil data alamat
                                                    $tgl_pelaksanaan = $row['H']; // Ambil data alamat
                                                    $uraian_kegiatan = $row['I']; // Ambil data alamat
                                                    $tempat = $row['J']; // Ambil data alamat
                                                    
                                                    // Cek jika semua data tidak diisi
                                                    if(empty($nama) && empty($gender) && empty($negara_asal) && empty($nama_perusahaan) && empty($nama_kegiatan) && empty($jabatan) && empty($pendidikan_terakhir) && empty($tgl_pelaksanaan) && empty($uraian_kegiatan) && empty($tempat))
                                                        continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
                                                    
                                                    // Cek $numrow apakah lebih dari 1
                                                    // Artinya karena baris pertama adalah nama-nama kolom
                                                    // Jadi dilewat saja, tidak usah diimport
                                                    if($numrow > 1){
                                                        // Validasi apakah semua data telah diisi
                                                        $nama_td = ( ! empty($nama))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
                                                        $gender_td = ( ! empty($gender))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
                                                        $negara_asal_td = ( ! empty($negara_asal))? "" : " style='background: #E07171;'"; // Jika Negara Asal kosong, beri warna merah
                                                        $nama_perusahaan_td = ( ! empty($nama_perusahaan))? "" : " style='background: #E07171;'"; // Jika Nama Perusahaan kosong, beri warna merah
                                                        $nama_kegiatan_td = ( ! empty($nama_kegiatan))? "" : " style='background: #E07171;'"; // Jika Nama Kegiatan kosong, beri warna merah
                                                        $jabatan_td = ( ! empty($jabatan))? "" : " style='background: #E07171;'"; // Jika Jabtan kosong, beri warna merah
                                                        $pendidikan_terakhir_td = ( ! empty($pendidikan_terakhir))? "" : " style='background: #E07171;'"; // Jika Pendidikan Terakhir kosong, beri warna merah
                                                        $tgl_pelaksanaan_td = ( ! empty($tgl_pelaksanaan))? "" : " style='background: #E07171;'"; // Jika Tanggal Pelaksanaan kosong, beri warna merah
                                                        $uraian_kegiatan_td = ( ! empty($uraian_kegiatan))? "" : " style='background: #E07171;'"; // Jika Uraian Kegiatan kosong, beri warna merah
                                                        $tempat_td = ( ! empty($tempat))? "" : " style='background: #E07171;'"; // Jika Tempat kosong, beri warna merah
                                                        
                                                        // Jika salah satu data ada yang kosong
                                                        if(empty($nama) or empty($gender) or empty($negara_asal) or empty($nama_perusahaan) or empty($nama_kegiatan) or empty($jabatan) or empty($pendidikan_terakhir) or empty($tgl_pelaksanaan) or empty($uraian_kegiatan) or empty($tempat)){
                                                            $kosong++; // Tambah 1 variabel $kosong
                                                        }
                                                        
                                                        echo "<tr>";
                                                        echo "<td".$nama_td.">".$nama."</td>";
                                                        echo "<td".$gender_td.">".$gender."</td>";
                                                        echo "<td".$negara_asal_td.">".$negara_asal."</td>";
                                                        echo "<td".$nama_perusahaan_td.">".$nama_perusahaan."</td>";
                                                        echo "<td".$nama_kegiatan_td.">".$nama_kegiatan."</td>";
                                                        echo "<td".$jabatan_td.">".$jabatan."</td>";
                                                        echo "<td".$pendidikan_terakhir_td.">".$pendidikan_terakhir."</td>";
                                                        echo "<td".$tgl_pelaksanaan_td.">".$tgl_pelaksanaan."</td>";
                                                        echo "<td".$uraian_kegiatan_td.">".$uraian_kegiatan."</td>";
                                                        echo "<td".$tempat_td.">".$tempat."</td>";
                                                        echo "</tr>";
                                                    }
                                                    
                                                    $numrow++; // Tambah 1 setiap kali looping
                                                }
                                                
                                                echo "</table>";
                                                echo "</div>";
                                                
                                                // Cek apakah variabel kosong lebih dari 1
                                                // Jika lebih dari 1, berarti ada data yang masih kosong
                                                // if($kosong > 1){
                                                ?>  
                                                     <script>
                                                    $(document).ready(function(){
                                                        // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
                                                        $("#jumlah_kosong").html('<?php echo $kosong; ?>');
                                                        
                                                        $("#kosong").show(); // Munculkan alert validasi kosong
                                                    });
                                                    </script>
                                                <?php
                                                // }else{ // Jika semua data sudah diisi
                                                    echo "<hr>";
                                                    
                                                    // Buat sebuah tombol untuk mengimport data ke database
                                                    echo "<button class='btn btn-success btn-rounded' type='submit' name='import'>Import</button>";
                                                    echo "<a href='".base_url("dosen_tamu")."'>Cancel</a>";
                                                // }
                                                
                                                echo "</form>";

                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->

                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
            <!-- footer -->
            <footer class="footer"> © 2018 All rights reserved. Template designed by <a href="https://colorlib.com">Colorlib</a></footer>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->


<?php
$this->load->view('bar/js');
?>

<script>
    var table;
    $(document).ready(function() {
        $('#myTable').DataTable();
    } );
</script>