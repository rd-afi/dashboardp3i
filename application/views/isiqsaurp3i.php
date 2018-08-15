<!DOCTYPE html>
<html lang="en">

<?php
$this->load->view('bar/head');
function rupiah($angka){
    $hasil_rupiah = "Rp. " . number_format($angka,2,',','.');
    return $hasil_rupiah;
}
function usd($angka){
    $hasil_rupiah = "$ " . number_format($angka,2,',','.');
    return $hasil_rupiah;
}
?>
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Indikator QS AUR</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Indikator QS AUR</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                                <div class="card-body">
                                    <form action="<?php echo site_url('isiqsaurp3i')?>" class="form-inline" method="POST">
                                    <table class="table-responsive display nowrap" style="width:100%">
                                    <div class="form-group">
                                        <tr>
                                            <td class="p-10" style="width:100%">
                                            <select name="tahun" required class="btn btn-pink btn-outline m-b-10 m-l-5 form-control">
                                            <option selected="" disabled="">Pilih Semester & Tahun</option>
                                            <?php
                                                for($i=16;$i<=date('y');$i++){
                                                    $x = $i + 1;
                                                    $y = $x + 1;
                                                // if($i == date('y')){
                                                //     echo '<option selected disabled>Pilih Tahun Semester</option>';
                                                // }else{
                                                    echo '<option value="1-'.$i.$x.'/2-'.$i.$x.'"> Ganjil&nbsp;&ensp;- '.$i.'/'.$x.' | Genap&nbsp;- '.$i.'/'.$x.'</option>';
                                                    echo '<option value="2-'.$i.$x.'/1-'.$x.$y.'"> Genap&nbsp;- '.$i.'/'.$x.' | Ganjil&nbsp;&nbsp;&nbsp;- '.$x.'/'.$y.'</option>';
                                                // }   
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
                        <div class="card">
                            <div class="card-body">
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
                                <div class="basic-form">
                                    <form>
                                        <div class="form-group table-responsive">
                                            <table id="qsaur" class="table table-bordered display nowrap" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Indikator</th>
                                                        <th>Full Time</th>
                                                        <th>Part Time</th>
                                                        <th>Headcount</th>
                                                        <th>FTE</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- FACULTY STAFF -->
                                                <tr>
                                                    <td colspan="5" style="border-style: none; background-color: #E4F1FE;"><b>Faculty Staff</b></td>
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                </tr>
                                                <tr>
                                                    <td>International Faculty Staff</td>
                                                    <td>0</td>
                                                    <td> <?php echo $visiting_inbound_parttime ?> </td>
                                                    <td> <?php echo $visiting_inbound_parttime ?> </td>
                                                    <td> <?php echo $visiting_inbound_parttime ?> </td>
                                                </tr>
                                                <tr>
                                                    <td>Visiting International Faculty Staff - Inbound</td>
                                                    <td>0</td>
                                                    <td> <?php echo $visiting_inbound_parttime ?> </td>
                                                    <td> <?php echo $visiting_inbound_parttime ?> </td>
                                                    <td> <?php echo $visiting_inbound_parttime ?> </td>
                                                </tr>
                                                <tr>
                                                    <td>Visiting International Faculty Staff - Outbound</td>
                                                    <td>0 <?php ?> </td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                </tr>
                                                <tr>
                                                    <td>Staff with PhD</td>
                                                    <td><a target="_blank" href="<?php echo site_url('isiqsaurp3i/efidence_phd_staff_dosen_full') ?>"> 
                                                        <?php echo $staff_phd_full ?></a></td>
                                                    <td> <?php echo $staff_phd_part = $staff_phd_dosen_part + $staff_phd_tamu_part ?> </td>
                                                    <td> <?php echo $staff_phd_full + $staff_phd_part ?> </td>
                                                    <td> <?php echo round($staff_phd_full + ($staff_phd_part / 3)) ?> </td>
                                                </tr>
                                                <tr>
                                                    <td>Faculty Staff</td>
                                                    <td><a target="_blank" href="<?php echo site_url('isiqsaurp3i/efidence_faculty_staff_dosen_full') ?>"> 
                                                        <?php echo $staff_dosen_full ?></a></td>
                                                    <td><a target="_blank" href="<?php echo site_url('isiqsaurp3i/efidence_faculty_staff_dosen_parttime') ?>"> 
                                                        <?php echo $staff_tamu_part ?></a></td><!-- 
                                                    <td><a href="<?php echo site_url('isiqsaurp3i/efidence_faculty_staff_dosen_parttime') ?>"> 
                                                        <?php echo $staff_parttime = ($staff_dosen_part + $staff_tamu_part) ?></a></td> -->
                                                    <!-- <td> <?php echo $staff_dosen_full + $staff_parttime ?> </td> -->
                                                    <td> <?php echo $staff_dosen_full + $staff_tamu_part ?> </td>
                                                    <td> <?php echo round($staff_dosen_full + ($staff_tamu_part / 3)) ?> </td>
                                                </tr>

                                                <!-- STUDENT - UNDERGRADUATE -->
                                                <tr>
                                                    <td colspan="5" style="border-style: none; background-color: #E4F1FE;"><b>Student - Undergraduate</b></td>
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                </tr>
                                                <tr>
                                                    <td>Undergraduate International Student</td>
                                                    <td><a target="_blank" href="<?php echo site_url('isiqsaurp3i/efidence_undergraduate_international_fulltime') ?>">
                                                        <?php echo $undergraduate_international_students ?> </td>
                                                    <td>0</td>
                                                    <td> <?php echo $undergraduate_international_students ?> </td>
                                                    <td> <?php echo $undergraduate_international_students ?> </td>
                                                </tr>
                                                <tr>
                                                    <td>Undergraduate Student</td>
                                                    <td> <?php echo $undergraduate_students ?> </td>
                                                    <td>0</td>
                                                    <td> <?php echo $undergraduate_students ?> </td>
                                                    <td> <?php echo $undergraduate_students ?> </td>
                                                </tr>
                                                <tr>
                                                    <td>Undergraduate exchange student - Inbound</td>
                                                    <td> <?php echo $undergraduate_inbound_students ?> </td>
                                                    <td>0</td>
                                                    <td> <?php echo $undergraduate_inbound_students ?> </td>
                                                    <td> <?php echo $undergraduate_inbound_students ?> </td>
                                                </tr>
                                                <tr>
                                                    <td>Undergraduate exchange student - Outbound</td>
                                                    <td> <?php echo $undergraduate_outbound_students ?> </td>
                                                    <td>0</td>
                                                    <td> <?php echo $undergraduate_outbound_students ?> </td>
                                                    <td> <?php echo $undergraduate_outbound_students ?> </td>
                                                </tr>
                                                <tr>
                                                    <td>Undergraduate student - First Year</td>
                                                    <td><a target="_blank" href="<?php echo site_url('isiqsaurp3i/efidence_undergraduate_first_fulltime') ?>">
                                                        <?php echo $undergraduate_firstyear_student ?> </td>
                                                    <td>0</td>
                                                    <td> <?php echo $undergraduate_firstyear_student ?> </td>
                                                    <td> <?php echo $undergraduate_firstyear_student ?> </td>
                                                </tr>
                                                <!-- STUDENT - GRADUATE / POSTGRADUATE -->
                                                <tr>
                                                    <td colspan="5" style="border-style: none; background-color: #E4F1FE;"><b>Student - Graduate/Postgraduate</b></td>
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                </tr>
                                                <tr>
                                                    <td>Graduate / Postgraduate International Students</td>
                                                    <td> <?php echo $grapost_international_students ?> </td>
                                                    <td>0</td>
                                                    <td> <?php echo $grapost_international_students ?> </td>
                                                    <td> <?php echo $grapost_international_students ?> </td>
                                                </tr>
                                                <tr>
                                                    <td>Graduate / Postgraduate Inbound Exchange Students</td>
                                                    <td> <?php echo $grapost_inbound_students ?> </td>
                                                    <td>0</td>
                                                    <td> <?php echo $grapost_inbound_students ?> </td>
                                                    <td> <?php echo $grapost_inbound_students ?> </td>
                                                </tr>
                                                <tr>
                                                    <td>Graduate / Postgraduate Outbound Exchange Students</td>
                                                    <td> <?php echo $grapost_outbound_students ?> </td>
                                                    <td>0</td>
                                                    <td> <?php echo $grapost_outbound_students ?> </td>
                                                    <td> <?php echo $grapost_outbound_students ?> </td>
                                                </tr>
                                                <tr>
                                                    <td>Graduate / Postgraduate Students</td>
                                                    <td> <?php echo $grapost_students ?> </td>
                                                    <td>0</td>
                                                    <td> <?php echo $grapost_students ?> </td>
                                                    <td> <?php echo $grapost_students ?> </td>
                                                </tr>
                                                <!-- STUDENT - OVERALL -->
                                                <tr>
                                                    <td colspan="5" style="border-style: none; background-color: #E4F1FE;"><b>Student - Overall</b></td>
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                </tr>
                                                <tr>
                                                    <td>Student - Overall</td>
                                                    <td> <?php echo $overall_students ?> </td>
                                                    <td>0</td>
                                                    <td> <?php echo $overall_students ?> </td>
                                                    <td> <?php echo $overall_students ?> </td>
                                                </tr>
                                                <tr>
                                                    <td>Number of Female Students</td>
                                                    <td> <?php echo $female ?> </td>
                                                    <td>0</td>
                                                    <td> <?php echo $female ?> </td>
                                                    <td> <?php echo $female ?> </td>
                                                </tr>
                                                <tr>
                                                    <td>International Students - Overall</td>
                                                    <td> <?php echo $overall_international ?> </td>
                                                    <td>0</td>
                                                    <td> <?php echo $overall_international ?> </td>
                                                    <td> <?php echo $overall_international ?> </td>
                                                </tr>
                                                <tr>
                                                    <td>Number of Male Students</td>
                                                    <td> <?php echo $male ?> </td>
                                                    <td>0</td>
                                                    <td> <?php echo $male ?> </td>
                                                    <td> <?php echo $male ?> </td>
                                                </tr>
                                                <tr>
                                                    <td>Exchange Students - Inbound</td>
                                                    <td> <?php echo $inbound ?> </td>
                                                    <td>0</td>
                                                    <td> <?php echo $inbound ?> </td>
                                                    <td> <?php echo $inbound ?> </td>
                                                </tr>
                                                <tr>
                                                    <td>Exchange Students - Outbound</td>
                                                    <td> <?php echo $outbound ?> </td>
                                                    <td>0</td>
                                                    <td> <?php echo $outbound ?> </td>
                                                    <td> <?php echo $outbound ?> </td>
                                                </tr>
                                                <!-- AVERAGE TUITION FEES -->
                                                <tr>
                                                    <td colspan="5" style="border-style: none; background-color: #E4F1FE;"><b>Average Tuition Fees</b></td>
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                </tr>
                                                <tr>
                                                    <td>Undergraduate Fees - International</td>
                                                    <td colspan="2" align="center"><?php
                                                    if (round(($fees_undergraduate_students_international->fee)+0)<0) {
                                                        echo 0;
                                                    } else {
                                                        echo rupiah(round((($fees_undergraduate_students_international->fee)+0)/$undergraduate_international_students));
                                                    }
                                                    ?></td>
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                    <td colspan="2" align="center"><?php
                                                    echo usd(round(((($fees_undergraduate_students_international->fee)+0)/$undergraduate_international_students)/14000)); ?></td>
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                    <!-- <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td> -->
                                                </tr>
                                                <tr>
                                                    <td>Undergraduate Fees - Domestic</td>
                                                    <td colspan="2" align="center"><?php
                                                    if (round(($fees_undergraduate_student_domestic->fee)+0)<0) {
                                                        echo 0;
                                                    } else {
                                                        echo rupiah(round((($fees_undergraduate_student_domestic->fee)+0)/$res_undergraduate_domestic));
                                                    }
                                                    ?></td>
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                    <td colspan="2" align="center"><?php
                                                    echo usd(round(((($fees_undergraduate_student_domestic->fee)+0)/$res_undergraduate_domestic)/14000)); ?></td>
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                    <!-- <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td> -->
                                                </tr>
                                                <tr>
                                                    <td>Graduate / Postgraduate Fees - Domestic</td>
                                                    <td colspan="2" align="center"><?php
                                                    echo rupiah(round((($fees_grapost_student_domestic->fee)+0)/$res_grapost_domestic)) ?></td>
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                    <td colspan="2" align="center"><?php
                                                    echo usd(round(((($fees_grapost_student_domestic->fee)+0)/$res_grapost_domestic)/14000)); ?></td>
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                    <!-- <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td> -->
                                                </tr>
                                                <tr>
                                                    <td>Graduate / Postgraduate Fees - International</td>
                                                    <td colspan="2" align="center"><?php
                                                    if (round(($fees_grapost_student_international->fee)+0)<0) {
                                                        echo 0;
                                                    } else {
                                                        echo rupiah(round((($fees_grapost_student_international->fee)+0)/$grapost_international_students));
                                                    }
                                                    ?></td>
                                                    <!-- <td colspan="4" align="center">N/A</td> -->
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                    <td colspan="2" align="center"><?php
                                                    echo usd(round(((($fees_grapost_student_international->fee)+0)/$grapost_international_students)/14000)); ?></td>
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                    <!-- <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td> -->
                                                </tr>
                                                <tr>
                                                    <td>Overall Student Fees - Domestic</td>
                                                    <td colspan="2" align="center"><?php
                                                    if (round(($fees_student_domestic->fee)+0)<0) {
                                                        echo 0;
                                                    } else {
                                                        echo rupiah(round((($fees_student_domestic->fee)+0)/$res_student_domestic));
                                                    }
                                                    ?></td>
                                                    <!-- <td colspan="4" align="center">N/A</td> -->
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                    <td colspan="2" align="center"><?php
                                                    echo usd(round(((($fees_student_domestic->fee)+0)/$res_student_domestic)/14000)); ?></td>
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                    <!-- <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td> -->
                                                </tr>
                                                <tr>
                                                    <td>Overall Student Fees - International</td>
                                                    <td colspan="2" align="center"><?php
                                                    if (round(($fees_students_international->fee)+0)<0) {
                                                        echo 0;
                                                    } else {
                                                        echo rupiah(round((($fees_students_international->fee)+0)/$res_student_international));
                                                    }
                                                    ?></td>
                                                    <!-- <td colspan="4" align="center">N/A</td> -->
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                    <td colspan="2" align="center"><?php
                                                    echo usd(round(((($fees_students_international->fee)+0)/$res_student_international)/14000)); ?></td>
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                    <!-- <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td> -->
                                                </tr>


                                                </tbody>
                                            </table>
                                        </div>
                                        
                                    </form>
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
    $(document).ready(function() {
        $('#qsaur').DataTable( {
            destroy: true,
            ordering: false,
            searching: false,
            paging: false,
            bInfo : false,
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        } );
    } );
</script>