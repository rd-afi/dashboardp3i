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
                    <h3 class="text-primary">Tambah Data Mahasiswa (SISFO)</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Tambah Data Mahasiswa (SISFO)</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">

            <div class="card-content">
                <div class="alert alert-secondary">
                    <h4 class="alert-heading"><b>PERHATIAN!</b></h4>
                    Sebelum melakukan upload file excel silahkan untuk mendownload dan menyesuaikan template berikut ini.
                    <p></p>
                    <hr>
                    <a href="<?php echo base_url().'template_mhs' ?>" class="btn btn-warning m-b-10 m-l-5 btn-sm">Download Template</a>
                </div>
            </div>

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
                                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#upload" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Uploads</span></a> </li>
                                        <!-- <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#input" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Input</span></a> </li> -->
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="upload" role="tabpanel">
                                            <div class="p-20">
                                                    <div class="button-list">
                                                <!-- <form action="<?php echo base_url();?>datadsn/importir/" method="post" enctype="multipart/form-data"> -->
                                                <form action="<?php echo base_url();?>mahasiswa/upload/" method="post" enctype="multipart/form-data">
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
                                                echo "<form method='post' action='".base_url("mahasiswa/import")."'>";
                                                
                                                // Buat sebuah div untuk alert validasi kosong
                                                echo "<div style='color: red;' id='kosong'>
                                                Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
                                                </div>";
                                                
                                                echo "
                                                <table id='myTable' class='table table-responsive table-striped table-bordered table-hover display nowrap' style='width:100%'>
                                                    <thead>
                                                        <tr>
                                                            <th>Schoolyear</th>
                                                            <th>Semester</th>
                                                            <th>NIM</th>
                                                            <th>Nama</th>
                                                            <th>Angkatan</th>
                                                            <th>Fakultas</th>
                                                            <th>Prodi</th>
                                                            <th>Jenjang</th>
                                                            <th>Gender</th>
                                                            <th>Status</th>
                                                            <th>BPP</th>
                                                            <th>Negara Asal</th>
                                                            <th>Universitas Origin</th>
                                                            <th>Universitas Destination</th>
                                                            <th>Exchange Period</th>
                                                            <th>LOA</th>
                                                            <th>MOA</th>
                                                            <th>Keterangan</th>
                                                            <th>Keterangan 2</th>
                                                        </tr>
                                                    </thead>";
                                                
                                                $numrow = 1;
                                                $kosong = 0;
                                                
                                                // Lakukan perulangan dari data yang ada di excel
                                                // $sheet adalah variabel yang dikirim dari controller
                                                foreach($sheet as $row){ 
                                                    // Ambil data pada excel sesuai Kolom
                                                    $schoolyear = $row['A']; // Ambil data nama
                                                    $semester = $row['B']; // Ambil data gender
                                                    $nim = $row['C']; // Ambil data jenis kelamin
                                                    $nama = $row['D']; // Ambil data alamat
                                                    $angkatan = $row['E']; // Ambil data alamat
                                                    $fakultas = $row['F']; // Ambil data alamat
                                                    $prodi = $row['G']; // Ambil data alamat
                                                    $jenjang = $row['H']; // Ambil data alamat
                                                    $gender = $row['I']; // Ambil data alamat
                                                    $status = $row['J']; // Ambil data alamat
                                                    $bpp = $row['K']; // Ambil data alamat
                                                    $negara_asal = $row['L']; // Ambil data alamat
                                                    $univ_origin = $row['M']; // Ambil data alamat
                                                    $univ_dest = $row['N']; // Ambil data alamat
                                                    $exchange_period = $row['O']; // Ambil data alamat
                                                    $loa = $row['P']; // Ambil data alamat
                                                    $moa = $row['Q']; // Ambil data alamat
                                                    $ket = $row['R']; // Ambil data alamat
                                                    $ket2 = $row['S']; // Ambil data alamat
                                                    
                                                    // Cek jika semua data tidak diisi
                                                    if(empty($schoolyear) && empty($semester) && empty($nim) && empty($nama) && empty($angkatan) && empty($fakultas) && empty($prodi) && empty($jenjang) && empty($gender) && empty($status) && empty($bpp) && empty($negara_asal) && empty($univ_origin) && empty($univ_dest) && empty($exchange_period) && empty($loa) && empty($moa) && empty($ket) && empty($ket2))
                                                        continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
                                                    
                                                    // Cek $numrow apakah lebih dari 1
                                                    // Artinya karena baris pertama adalah nama-nama kolom
                                                    // Jadi dilewat saja, tidak usah diimport
                                                    if($numrow > 1){
                                                        // Validasi apakah semua data telah diisi
                                                        $schoolyear_td = ( ! empty($schoolyear))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
                                                        $semester_td = ( ! empty($semester))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
                                                        $nim_td = ( ! empty($nim))? "" : " style='background: #E07171;'"; // Jika Negara Asal kosong, beri warna merah
                                                        $nama_td = ( ! empty($nama))? "" : " style='background: #E07171;'"; // Jika Nama Perusahaan kosong, beri warna merah
                                                        $angkatan_td = ( ! empty($angkatan))? "" : " style='background: #E07171;'"; // Jika Nama Kegiatan kosong, beri warna merah
                                                        $fakultas_td = ( ! empty($fakultas))? "" : " style='background: #E07171;'"; // Jika Jabtan kosong, beri warna merah
                                                        $prodi_td = ( ! empty($prodi))? "" : " style='background: #E07171;'"; // Jika Pendidikan Terakhir kosong, beri warna merah
                                                        $jenjang_td = ( ! empty($jenjang))? "" : " style='background: #E07171;'"; // Jika Tanggal Pelaksanaan kosong, beri warna merah
                                                        $gender_td = ( ! empty($gender))? "" : " style='background: #E07171;'"; // Jika Uraian Kegiatan kosong, beri warna merah
                                                        $status_td = ( ! empty($status))? "" : " style='background: #E07171;'"; // Jika Tempat kosong, beri warna merah
                                                        $bpp_td = ( ! empty($bpp))? "" : " style='background: #E07171;'"; // Jika Tempat kosong, beri warna merah
                                                        $negara_asal_td = ( ! empty($negara_asal))? "" : " style='background: #E07171;'"; // Jika Tempat kosong, beri warna merah
                                                        $univ_origin_td = ( ! empty($univ_origin))? "" : " style='background: #E07171;'"; // Jika Tempat kosong, beri warna merah
                                                        $univ_dest_td = ( ! empty($univ_dest))? "" : " style='background: #E07171;'"; // Jika Tempat kosong, beri warna merah
                                                        $exchange_period_td = ( ! empty($exchange_period))? "" : " style='background: #E07171;'"; // Jika Tempat kosong, beri warna merah
                                                        $loa_td = ( ! empty($loa))? "" : " style='background: #E07171;'"; // Jika Tempat kosong, beri warna merah
                                                        $moa_td = ( ! empty($moa))? "" : " style='background: #E07171;'"; // Jika Tempat kosong, beri warna merah
                                                        $ket_td = ( ! empty($ket))? "" : " style='background: #E07171;'"; // Jika Tempat kosong, beri warna merah
                                                        $ket2_td = ( ! empty($ket2))? "" : " style='background: #E07171;'"; // Jika Tempat kosong, beri warna merah
                                                        
                                                        // Jika salah satu data ada yang kosong
                                                        if(empty($schoolyear) or empty($semester) or empty($nim) or empty($nama) or empty($angkatan) or empty($fakultas) or empty($prodi) or empty($jenjang) or empty($gender) or empty($status) or empty($bpp) or empty($negara_asal) or empty($univ_origin) or empty($univ_dest) or empty($exchange_period) or empty($loa) or empty($moa) or empty($ket) or empty($ket2)){
                                                            $kosong++; // Tambah 1 variabel $kosong
                                                        }
                                                        
                                                        echo "<tr>";
                                                        echo "<td".$schoolyear_td.">".$schoolyear."</td>";
                                                        echo "<td".$semester_td.">".$semester."</td>";
                                                        echo "<td".$nim_td.">".$nim."</td>";
                                                        echo "<td".$nama_td.">".$nama."</td>";
                                                        echo "<td".$angkatan_td.">".$angkatan."</td>";
                                                        echo "<td".$fakultas_td.">".$fakultas."</td>";
                                                        echo "<td".$prodi_td.">".$prodi."</td>";
                                                        echo "<td".$jenjang_td.">".$jenjang."</td>";
                                                        echo "<td".$gender_td.">".$gender."</td>";
                                                        echo "<td".$status_td.">".$status."</td>";
                                                        echo "<td".$bpp_td.">".$bpp."</td>";
                                                        echo "<td".$negara_asal_td.">".$negara_asal."</td>";
                                                        echo "<td".$univ_origin_td.">".$univ_origin."</td>";
                                                        echo "<td".$univ_dest_td.">".$univ_dest."</td>";
                                                        echo "<td".$exchange_period_td.">".$exchange_period."</td>";
                                                        echo "<td".$loa_td.">".$loa."</td>";
                                                        echo "<td".$moa_td.">".$moa."</td>";
                                                        echo "<td".$ket_td.">".$ket."</td>";
                                                        echo "<td".$ket2_td.">".$ket2."</td>";
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
                                                    echo "<a href='".base_url("mahasiswa")."'>Cancel</a>";
                                                // }
                                                
                                                echo "</form>";

                                            }
                                            ?>
                                        </div>
                                        <div class="tab-pane p-20" id="input" role="tabpanel">2</div>
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
            <footer class="footer"> © 2018 All rights reserved</footer>
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