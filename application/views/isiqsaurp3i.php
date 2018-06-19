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
                            <!-- <div class="card-title">
                                <h4></h4>

                            </div> -->
                            <div class="card-body">
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
                                                    <!-- <td> <?php echo $staff_international ?> </td> -->
                                                    <td>0</td>
                                                    <td> <?php echo $visiting_inbound_parttime ?> </td>
                                                    <td> <?php echo $visiting_inbound_parttime ?> </td>
                                                    <td> <?php echo $visiting_inbound_parttime ?> </td>
                                                    <!-- <td> <?php echo $staff_international ?> </td> -->
                                                    <!-- <td> <?php echo $staff_international ?> </td> -->
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
                                                    <td> <?php echo $staff_phd_full ?> </td>
                                                    <td> <?php echo $staff_phd_part = $staff_phd_dosen_part + $staff_phd_tamu_part ?> </td>
                                                    <td> <?php echo $staff_phd_full + $staff_phd_part ?> </td>
                                                    <td> <?php echo round($staff_phd_full + ($staff_phd_part / 3)) ?> </td>
                                                </tr>
                                                <tr>
                                                    <td>Faculty Staff</td>
                                                    <td> <?php echo $staff_dosen_full ?> </td>
                                                    <td> <?php echo $staff_parttime = ($staff_dosen_part + $staff_tamu_part) ?> </td>
                                                    <td> <?php echo $staff_dosen_full + $staff_parttime ?> </td>
                                                    <td> <?php echo round($staff_dosen_full + ($staff_parttime / 3)) ?> </td>
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
                                                    <td> <?php echo $undergraduate_international_students ?> </td>
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
                                                    <td> <?php echo $undergraduate_firstyear_student ?> </td>
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
                                                    <td colspan="4" align="center">N/A</td>
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                    <!-- <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td> -->
                                                </tr>
                                                <tr>
                                                    <td>Undergraduate Fees - Domestic</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                </tr>
                                                <tr>
                                                    <td>Graduate / Postgraduate Fees - Domestic</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                </tr>
                                                <tr>
                                                    <td>Graduate / Postgraduate Fees - International</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                </tr>
                                                <tr>
                                                    <td>Overall Student Fees - Domestic</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                </tr>
                                                <tr>
                                                    <td>Overall Student Fees - International</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
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