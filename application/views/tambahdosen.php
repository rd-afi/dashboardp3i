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
                    <h3 class="text-primary">Data Dosen</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Dosen</li>
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
                    <a href="<?php echo base_url().'template_dosen' ?>" class="btn btn-warning m-b-10 m-l-5 btn-sm">Download Template</a>
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
                                        <!-- UPLOAD DATA EXCEL -->
                                        <div class="tab-pane active" id="upload" role="tabpanel">
                                            <div class="p-20">
                                                    <div class="button-list">
                                                <!-- <form action="<?php echo base_url();?>datadsn/importir/" method="post" enctype="multipart/form-data"> -->
                                                <form action="<?php echo base_url();?>dosen/upload" method="post" enctype="multipart/form-data">
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
                                                echo "<form method='post' action='".base_url("dosen/import")."'>";
                                                
                                                // Buat sebuah div untuk alert validasi kosong
                                                echo "<div style='color: red;' id='kosong'>
                                                Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
                                                </div>";
                                                
                                                echo "
                                                <table id='myTable' class='table table-responsive table-striped table-bordered table-hover display nowrap' style='width:100%'>
                                                    <thead>
                                                        <tr>
                                                            <th>NIP</th>
                                                            <th>Nama</th>
                                                            <th>Posisi</th>
                                                            <th>Status Pegawai</th>
                                                            <th>SK Pertama</th>
                                                            <th>SK Posisi</th>
                                                            <th>TMT</th>
                                                            <th>Pendidikan</th>
                                                            <th>Kewarganegaraan</th>
                                                        </tr>
                                                    </thead>";
                                                
                                                $numrow = 1;
                                                $kosong = 0;
                                                
                                                // Lakukan perulangan dari data yang ada di excel
                                                // $sheet adalah variabel yang dikirim dari controller
                                                foreach($sheet as $row){ 
                                                    // Ambil data pada excel sesuai Kolom
                                                    $nip = $row['A']; // Ambil data nama
                                                    $nama = $row['B']; // Ambil data gender
                                                    $posisi = $row['C']; // Ambil data jenis kelamin
                                                    $employeestatus = $row['D']; // Ambil data alamat
                                                    $sk_pertama = $row['E']; // Ambil data alamat
                                                    $sk_posisi = $row['F']; // Ambil data alamat
                                                    $tmt = $row['G']; // Ambil data alamat
                                                    $pendidikan = $row['H']; // Ambil data alamat
                                                    $kewarganegaraan = $row['I']; // Ambil data alamat
                                                    
                                                    // Cek jika semua data tidak diisi
                                                    if(empty($nip) && empty($nama) && empty($posisi) && empty($employeestatus) && empty($sk_pertama) && empty($sk_posisi) && empty($tmt) && empty($pendidikan) && empty($kewarganegaraan))
                                                        continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
                                                    
                                                    // Cek $numrow apakah lebih dari 1
                                                    // Artinya karena baris pertama adalah nama-nama kolom
                                                    // Jadi dilewat saja, tidak usah diimport
                                                    if($numrow > 1){
                                                        // Validasi apakah semua data telah diisi
                                                        $nip_td = ( ! empty($nip))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
                                                        $nama_td = ( ! empty($nama))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
                                                        $posisi_td = ( ! empty($posisi))? "" : " style='background: #E07171;'"; // Jika Negara Asal kosong, beri warna merah
                                                        $employeestatus_td = ( ! empty($employeestatus))? "" : " style='background: #E07171;'"; // Jika Nama Perusahaan kosong, beri warna merah
                                                        $sk_pertama_td = ( ! empty($sk_pertama))? "" : " style='background: #E07171;'"; // Jika Nama Kegiatan kosong, beri warna merah
                                                        $sk_posisi_td = ( ! empty($sk_posisi))? "" : " style='background: #E07171;'"; // Jika Jabtan kosong, beri warna merah
                                                        $tmt_td = ( ! empty($tmt))? "" : " style='background: #E07171;'"; // Jika Pendidikan Terakhir kosong, beri warna merah
                                                        $pendidikan_td = ( ! empty($pendidikan))? "" : " style='background: #E07171;'"; // Jika Tanggal Pelaksanaan kosong, beri warna merah
                                                        $kewarganegaraan_td = ( ! empty($kewarganegaraan))? "" : " style='background: #E07171;'"; // Jika Uraian Kegiatan kosong, beri warna merah
                                                        
                                                        // Jika salah satu data ada yang kosong
                                                        if(empty($nip) or empty($nama) or empty($posisi) or empty($employeestatus) or empty($sk_pertama) or empty($sk_posisi) or empty($tmt) or empty($pendidikan) or empty($kewarganegaraan)){
                                                            $kosong++; // Tambah 1 variabel $kosong
                                                        }
                                                        
                                                        echo "<tr>";
                                                        echo "<td".$nip_td.">".$nip."</td>";
                                                        echo "<td".$nama_td.">".$nama."</td>";
                                                        echo "<td".$posisi_td.">".$posisi."</td>";
                                                        echo "<td".$employeestatus_td.">".$employeestatus."</td>";
                                                        echo "<td".$sk_pertama_td.">".$sk_pertama."</td>";
                                                        echo "<td".$sk_posisi_td.">".$sk_posisi."</td>";
                                                        echo "<td".$tmt_td.">".$tmt."</td>";
                                                        echo "<td".$pendidikan_td.">".$pendidikan."</td>";
                                                        echo "<td".$kewarganegaraan_td.">".$kewarganegaraan."</td>";
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
                                                    echo "<button class='btn btn-success btn-default' type='submit' name='import'>Import</button>";
                                                    echo "<button href='".base_url("dosen/tambah")."' class='btn btn-danger btn-default' type='submit' name='import'>Cancel</button>";
                                                    // echo "<a href='".base_url("dosen/tambah")."'>Cancel</a>";
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
        $('#myTable').DataTable({
            scrollX: true;
        });
    } );
</script>