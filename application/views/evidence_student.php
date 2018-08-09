<?php
$this->load->view('bar/head');
?>

        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary"><?php echo $title; ?></h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo site_url('isiqsaurp3i') ?>">Indikator QS AUR</a></li>
                        <li class="breadcrumb-item active"><?php echo $title; ?></li>
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
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab" role="tabpanel">
                                            <div class="p-20">
                                            <table id="myTable" class="table table-responsive table-striped table-bordered table-hover display nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Schoolyear</th>
                                                <th>Semester</th>
                                                <th>NIM</th>
                                                <th>Name</th>
                                                <th>Generation</th>
                                                <th>Faculty</th>
                                                <th>Study Program</th>
                                                <th>Degree</th>
                                                <th>Gender</th>
                                                <th>Status</th>
                                                <th>Fee</th>
                                                <th>Country of Origin</th>
                                                <th>University of Origin</th>
                                                <th>University of Destination</th>
                                                <th>Exchange Period</th>
                                                <th>Information</th>
                                                <th>Information 2</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $no = 1;
                                            foreach($data_evidence as $d){ 
                                            ?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo $d->schoolyear ?></td>
                                                <td><?php echo $d->semester ?></td>
                                                <td><?php echo $d->nim ?></td>
                                                <td><?php echo $d->name ?></td>
                                                <td><?php echo $d->generation ?></td>
                                                <td><?php echo $d->faculty ?></td>
                                                <td><?php echo $d->study_program ?></td>
                                                <td><?php echo $d->degree ?></td>
                                                <td><?php echo $d->gender ?></td>
                                                <td><?php echo $d->status ?></td>
                                                <td><?php echo $d->fee ?></td>
                                                <td><?php echo $d->country_of_origin ?></td>
                                                <td><?php echo $d->univ_origin ?></td>
                                                <td><?php echo $d->univ_dest ?></td>
                                                <td><?php echo $d->exchange_period ?></td>
                                                <td><?php echo $d->inf ?></td>
                                                <td><?php echo $d->inf2 ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                            </div>
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
            <footer class="footer"> © 2018 All rights reserved.</footer>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->


<?php
$this->load->view('bar/js');
?>