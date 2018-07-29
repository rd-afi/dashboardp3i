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

            <div class="card-content">
                <div class="alert alert-secondary">
                    <h4 class="alert-heading"><b>PERHATIAN!</b></h4>
                    Sebelum melakukan upload file excel silahkan untuk mendownload petunjuk dan template berikut ini.
                    <p></p>
                    <hr>
                    <a href="<?php echo base_url().'template_dosen_tamu' ?>" class="btn btn-warning m-b-10 m-l-5 btn-sm">Download Petunjuk</a>
                    <a href="<?php echo base_url().'template_dosen_tamu' ?>" class="btn btn-warning m-b-10 m-l-5 btn-sm">Download Template</a>
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
                                                <form action="<?php echo base_url();?>dosen_tamu/upload" method="post" enctype="multipart/form-data">
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
                                                
                                                echo "
                                                <table id='myTable' class='table table-responsive table-striped table-bordered table-hover display nowrap' style='width:100%'>
                                                    <thead>
                                                        <tr>
                                                            <th>School Year</th>
                                                            <th>Semester</th>
                                                            <th>Name</th>
                                                            <th>Gender</th>
                                                            <th>Country of Origin</th>
                                                            <th>Institution</th>
                                                            <th>Event</th>
                                                            <th>Position</th>
                                                            <th>Education</th>
                                                            <th>Time Period</th>
                                                            <th>Venue</th>
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
                                                    $name = $row['C'];
                                                    $gender = $row['D'];
                                                    $country_of_origin = $row['E'];
                                                    $institution = $row['F'];
                                                    $event = $row['G'];
                                                    $position = $row['H'];
                                                    $education = $row['I'];
                                                    $time_period = $row['J'];
                                                    $venue = $row['K'];
                                                    
                                                    // Cek jika semua data tidak diisi
                                                    if(empty($schoolyear) && empty($semester) && empty($name) && empty($gender) && empty($country_of_origin) && empty($institution) && empty($event) && empty($position) && empty($education) && empty($time_period) && empty($venue))
                                                        continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
                                                    
                                                    // Cek $numrow apakah lebih dari 1
                                                    // Artinya karena baris pertama adalah nama-nama kolom
                                                    // Jadi dilewat saja, tidak usah diimport
                                                    if($numrow > 1){
                                                        // Validasi apakah semua data telah diisi
                                                        $schoolyear_td = ( ! empty($schoolyear))? "" : " style='background: #E07171;'";
                                                        $semester_td = ( ! empty($semester))? "" : " style='background: #E07171;'";
                                                        $name_td = ( ! empty($name))? "" : " style='background: #E07171;'";
                                                        $gender_td = ( ! empty($gender))? "" : " style='background: #E07171;'";
                                                        $country_of_origin_td = ( ! empty($country_of_origin))? "" : " style='background: #E07171;'";
                                                        $institution_td = ( ! empty($institution))? "" : " style='background: #E07171;'";
                                                        $event_td = ( ! empty($event))? "" : " style='background: #E07171;'";
                                                        $position_td = ( ! empty($position))? "" : " style='background: #E07171;'";
                                                        $education_td = ( ! empty($education))? "" : " style='background: #E07171;'";
                                                        $time_period_td = ( ! empty($time_period))? "" : " style='background: #E07171;'";
                                                        $event_td = ( ! empty($event))? "" : " style='background: #E07171;'";
                                                        
                                                        // Jika salah satu data ada yang kosong
                                                        if(empty($schoolyear) or empty($semester) or empty($name) or empty($gender) or empty($country_of_origin) or empty($institution) or empty($event) or empty($position) or empty($education) or empty($time_period) or empty($venue)){
                                                            $kosong++; // Tambah 1 variabel $kosong
                                                        }
                                                        
                                                        echo "<tr>";
                                                        echo "<td".$schoolyear_td.">".$schoolyear."</td>";
                                                        echo "<td".$semester_td.">".$semester."</td>";
                                                        echo "<td".$name_td.">".$name."</td>";
                                                        echo "<td".$gender_td.">".$gender."</td>";
                                                        echo "<td".$country_of_origin_td.">".$country_of_origin."</td>";
                                                        echo "<td".$institution_td.">".$institution."</td>";
                                                        echo "<td".$event_td.">".$event."</td>";
                                                        echo "<td".$position_td.">".$position."</td>";
                                                        echo "<td".$education_td.">".$education."</td>";
                                                        echo "<td".$time_period_td.">".$time_period."</td>";
                                                        echo "<td".$event_td.">".$event."</td>";
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
                                                    echo "<button href='".base_url("dosen_tamu")."' class='btn btn-danger btn-default' type='submit' name='cancel'>Cancel</button>";
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
            <footer class="footer"> © 2018 All rights reserved.</footer>
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