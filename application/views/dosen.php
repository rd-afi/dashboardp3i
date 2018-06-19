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
                                <!-- <div class="table-responsive m-t-40"> -->
                                    <table id="myTable" class="table table-responsive table-striped table-bordered table-hover display nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
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
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $no = 1;
                                            foreach($dosen as $d){ 
                                            ?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo $d->nip ?></td>
                                                <td><?php echo $d->nama ?></td>
                                                <td><?php echo $d->posisi ?></td>
                                                <td><?php echo $d->employeestatus ?></td>
                                                <td><?php echo $d->sk_pertama ?></td>
                                                <td><?php echo $d->sk_posisi ?></td>
                                                <td><?php echo $d->tmt ?></td>
                                                <td><?php echo $d->pendidikan ?></td>
                                                <td><?php echo $d->kewarganegaraan ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <!-- </div> -->
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