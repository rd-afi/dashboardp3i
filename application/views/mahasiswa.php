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
                    <h3 class="text-primary">Data Mahasiswa (SISFO)</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Mahasiswa (SISFO)</li>
                    </ol>
                </div>
            </div>
            <div class="container-fluid">
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
                                <div class="card-body">
                                    <form action="<?php echo site_url('mahasiswa')?>" class="form-inline" method="POST">
                                    <table class="table-responsive display nowrap" style="width:100%">
                                    <div class="form-group">
                                        <tr>
                                            <!-- DROPDOWN SEMESTER & TAHUN -->
                                            <td class="p-10" style="width:100%">
                                            <select name="tahun" required class="btn btn-pink btn-outline m-b-10 m-l-5 form-control">
                                            <option selected="" disabled="">Pilih Semester & Tahun</option>
                                            <?php
                                                for($i=16;$i<=date('y');$i++){
                                                    $x = $i + 1;
                                                    $y = $x + 1;
                                                    echo '<option value="1-'.$i.$x.'/2-'.$i.$x.'"> Ganjil&nbsp;&ensp;- '.$i.'/'.$x.' | Genap&nbsp;- '.$i.'/'.$x.'</option>';
                                                    echo '<option value="2-'.$i.$x.'/1-'.$x.$y.'"> Genap&nbsp;- '.$i.'/'.$x.' | Ganjil&nbsp;&nbsp;&nbsp;- '.$x.'/'.$y.'</option>';
                                                }
                                            ?>
                                            </select>
                                            </td>

                                            <td class="p-10" style="width:100%">
                                                <button type="submit" class="btn btn-primary btn-md m-b-5 m-l-5 pull-right"> View </button>
                                            </td>
                                        </tr>
                                    </div>
                                    </table>
                                    </form>
                                </div>
                            </div>
                            <!-- TABEL -->
                            <div class="card">
                                <center><h4> Periode Semester <?php
                                $year = substr($tahun, 0,2);
                                $year1 = $year+1;
                                $year2 = $year1+1;
                                if ($semester == "12") {
                                    $smt1 = "Ganjil - ".$year.$year1;
                                    $smt2 = "Genap - ".$year.$year1;
                                } else {
                                    $smt1 = "Genap - ".$year.$year1;
                                    $smt2 = "Ganjil - ".$year1.$year2;
                                }
                                echo $smt1." & ".$smt2; ?></h4></center>
                                <div class="card-body p-b-0">
                                    <!-- Tab panes -->
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
                                            foreach($mhs as $d){ 
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
            <footer class="footer"> © 2018 All rights reserved.</footer>
        </div>

<?php
$this->load->view('bar/js');
?>

<script type="text/javascript">

    $('#myTable').dataTable();
</script>