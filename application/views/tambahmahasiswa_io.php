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
                    <h3 class="text-primary">Tambah Data Mahasiswa (IO)</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Tambah Data Mahasiswa (IO)</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">

            <div class="card-content">
                <div class="alert alert-secondary">
                    <h4 class="alert-heading"><b>PERHATIAN!</b></h4>
                    Sebelum melakukan upload file excel silahkan untuk mendownload petunjuk dan template berikut ini.
                    <p></p>
                    <hr>
                    <a href="<?php echo base_url().'template_mhs_io' ?>" class="btn btn-warning m-b-10 m-l-5 btn-sm">Download Petunjuk</a>
                    <a href="<?php echo base_url().'template_mhs_io' ?>" class="btn btn-warning m-b-10 m-l-5 btn-sm">Download Template</a>
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
                                                <form action="<?php echo base_url();?>mahasiswa/upload_io/" method="post" enctype="multipart/form-data">
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
                                                echo "<form method='post' action='".base_url("mahasiswa/import_io")."'>";
                                                
                                                // Buat sebuah div untuk alert validasi kosong
                                                echo "<div style='color: red;' id='kosong'>
                                                Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
                                                </div>";
                                                
                                                echo "
                                                <table id='myTable' class='table table-responsive table-striped table-bordered table-hover display nowrap' style='width:100%'>
                                                    <thead>
                                                        <tr>
                                                            <th>School Year</th>
                                                            <th>Semester</th>
                                                            <th>NIM</th>
                                                            <th>Name</th>
                                                            <th>Generatin</th>
                                                            <th>Faculty</th>
                                                            <th>Study Program</th>
                                                            <th>Degree</th>
                                                            <th>Gender</th>
                                                            <th>Status</th>
                                                            <th>Fee</th>
                                                            <th>Country of Origin</th>
                                                            <th>Univ. Origin</th>
                                                            <th>Univ. Destination</th>
                                                            <th>Exchange Period</th>
                                                            <th>Passport ID</th>
                                                            <th>Information</th>
                                                        </tr>
                                                    </thead>";
                                                
                                                $numrow = 1;
                                                $kosong = 0;
                                                
                                                // Lakukan perulangan dari data yang ada di excel
                                                // $sheet adalah variabel yang dikirim dari controller
                                                foreach($sheet as $row){ 
                                                    // Ambil data pada excel sesuai Kolom
                                                    $schoolyear = $row['A'];
                                                    $semester = $row['B'];
                                                    $nim = $row['C'];
                                                    $name = $row['D'];
                                                    $generation = $row['E'];
                                                    $faculty = $row['F'];
                                                    $study_program = $row['G'];
                                                    $degree = $row['H'];
                                                    $gender = $row['I'];
                                                    $status = $row['J'];
                                                    $fee = $row['K'];
                                                    $country_of_origin = $row['L'];
                                                    $univ_origin = $row['M'];
                                                    $univ_dest = $row['N'];
                                                    $exchange_period = $row['O'];
                                                    $passport = $row['P'];
                                                    $inf = $row['Q'];
                                                    
                                                    // Cek jika semua data tidak diisi
                                                    if(empty($schoolyear) && empty($semester) && empty($nim) && empty($name) && empty($generation) && empty($faculty) && empty($study_program) && empty($degree) && empty($gender) && empty($status) && empty($fee) && empty($country_of_origin) && empty($univ_origin) && empty($univ_dest) && empty($exchange_period) && empty($passport) && empty($inf))
                                                        continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
                                                    
                                                    // Cek $numrow apakah lebih dari 1
                                                    // Artinya karena baris pertama adalah nama-nama kolom
                                                    if($numrow > 1){
                                                        // Validasi apakah semua data telah diisi
                                                        // Jika data kosong akan diberi warna merah
                                                        $schoolyear_td = ( ! empty($schoolyear))? "" : " style='background: #E07171;'";
                                                        $semester_td = ( ! empty($semester))? "" : " style='background: #E07171;'";
                                                        $nim_td = ( ! empty($nim))? "" : " style='background: #E07171;'";
                                                        $name_td = ( ! empty($name))? "" : " style='background: #E07171;'";
                                                        $generation_td = ( ! empty($generation))? "" : " style='background: #E07171;'";
                                                        $faculty_td = ( ! empty($faculty))? "" : " style='background: #E07171;'";
                                                        $study_program_td = ( ! empty($study_program))? "" : " style='background: #E07171;'";
                                                        $degree_td = ( ! empty($degree))? "" : " style='background: #E07171;'";
                                                        $gender_td = ( ! empty($gender))? "" : " style='background: #E07171;'";
                                                        $status_td = ( ! empty($status))? "" : " style='background: #E07171;'";
                                                        $fee_td = ( ! empty($fee))? "" : " style='background: #E07171;'";
                                                        $country_of_origin_td = ( ! empty($country_of_origin))? "" : " style='background: #E07171;'";
                                                        $univ_origin_td = ( ! empty($univ_origin))? "" : " style='background: #E07171;'";
                                                        $univ_dest_td = ( ! empty($univ_dest))? "" : " style='background: #E07171;'";
                                                        $exchange_period_td = ( ! empty($exchange_period))? "" : " style='background: #E07171;'";
                                                        $passport_td = ( ! empty($passport))? "" : " style='background: #E07171;'";
                                                        $inf_td = ( ! empty($inf))? "" : " style='background: #E07171;'";
                                                        
                                                        // Jika salah satu data ada yang kosong
                                                        if(empty($schoolyear) or empty($semester) or empty($nim) or empty($name) or empty($generation) or empty($faculty) or empty($study_program) or empty($degree) or empty($gender) or empty($status) or empty($fee) or empty($country_of_origin) or empty($univ_origin) or empty($univ_dest) or empty($exchange_period) or empty($passport) or empty($inf)){
                                                            $kosong++; // Tambah 1 variabel $kosong
                                                        }
                                                        
                                                        echo "<tr>";
                                                        echo "<td".$schoolyear_td.">".$schoolyear."</td>";
                                                        echo "<td".$semester_td.">".$semester."</td>";
                                                        echo "<td".$nim_td.">".$nim."</td>";
                                                        echo "<td".$name_td.">".$name."</td>";
                                                        echo "<td".$generation_td.">".$generation."</td>";
                                                        echo "<td".$faculty_td.">".$faculty."</td>";
                                                        echo "<td".$study_program_td.">".$study_program."</td>";
                                                        echo "<td".$degree_td.">".$degree."</td>";
                                                        echo "<td".$gender_td.">".$gender."</td>";
                                                        echo "<td".$status_td.">".$status."</td>";
                                                        echo "<td".$fee_td.">".$fee."</td>";
                                                        echo "<td".$country_of_origin_td.">".$country_of_origin."</td>";
                                                        echo "<td".$univ_origin_td.">".$univ_origin."</td>";
                                                        echo "<td".$univ_dest_td.">".$univ_dest."</td>";
                                                        echo "<td".$exchange_period_td.">".$exchange_period."</td>";
                                                        echo "<td".$passport_td.">".$passport."</td>";
                                                        echo "<td".$inf_td.">".$inf."</td>";
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
                                                    echo "<button href='".base_url("mahasiswa_io")."' class='btn btn-danger btn-default' type='submit' name='cancel'>Cancel</button>";
                                                    echo "<button class='btn btn-primary btn-default pull-right' style='margin-left:10px;' type='submit' name='import'>Import</button>";
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