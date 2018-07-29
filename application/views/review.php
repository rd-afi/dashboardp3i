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
                                    <form action="<?php echo site_url('review')?>" class="form-inline" method="POST">
                                    <table class="table-responsive display nowrap" style="width:100%">
                                    <div class="form-group">
                                        <tr>
                                            <td class="p-10">
                                            <select id="semester" name="semester" required class="btn btn-pink btn-outline m-b-10 m-l-5 form-control">
                                                <option selected="" disabled=""> - Semester - </option>
                                                <option value="12">Ganjil - Genap</option>
                                                <option value="21">Genap - Ganjil</option>
                                            </select>
                                            </td>

                                            <td class="p-10" style="width:100%">
                                            <select name="tahun" required class="btn btn-pink btn-outline m-b-10 m-l-5 form-control">
                                            <option selected="" disabled="">Pilih Tahun</option>
                                            <?php
                                                for($i=2016;$i<=date('Y');$i++){
                                                if($i == date('Y')){
                                                    echo '<option selected="" value="'.$i.'">'.$i.'</option>';
                                                }else{
                                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                                }   
                                                }
                                            ?>
                                            </select>
                                            </td>

                                            <td class="p-10" style="width:100%">&</td>

                                            <td class="p-10">
                                            <select id="semester2" name="semester2" required class="btn btn-pink btn-outline m-b-10 m-l-5 form-control">
                                                <option selected="" disabled=""> - Semester - </option>
                                                <option value="12">Ganjil - Genap</option>
                                                <option value="21">Genap - Ganjil</option>
                                            </select>
                                            </td>

                                            <td class="p-10" style="width:100%">
                                            <select name="tahun2" required class="btn btn-pink btn-outline m-b-10 m-l-5 form-control">
                                            <option selected="" disabled="">Pilih Tahun</option>
                                            <?php
                                                for($i=2016;$i<=date('Y');$i++){
                                                if($i == date('Y')){
                                                    echo '<option selected="" value="'.$i.'">'.$i.'</option>';
                                                }else{
                                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                                }   
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
                            <!-- <div class="card-title">
                                <h4></h4>

                            </div> -->
                            <div class="card-body">
                                <center><h4> Periode Semester <?php
                                if ($semester == "12") {
                                    $smt = "Ganjil - Genap";
                                } else {
                                    $smt = "Genap - Ganjil";
                                }
                                echo $smt." ".$tahun." & ".$tahun2; ?></h4></center>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>1. International Faculty Staff</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="graf1" width="600" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>2. Visiting International Faculty Staff - Inbound</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="graf2" width="600" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>3. Visiting International Faculty Staff - Outbound</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="graf3" width="600" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>4. Staff with PhD</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="graf4" width="600" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>5. Faculty Staff</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="graf5" width="600" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- STUDENT - UNDERGRADUATE -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>6. Undergraduate International Student</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="graf6" width="600" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>7. Undergraduate Student</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="graf7" width="600" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>8. Undergraduate Exchange Student - Inbound</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="graf8" width="600" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>9. Undergraduate Exchange Student - Outbound</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="graf9" width="600" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>10. Undergraduate First Year</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="graf10" width="600" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- STUDENT GRADUATE/POSTGRADUATE -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>11. Graduate / Postgraduate International Students</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="graf11" width="600" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>12. Graduate / Postgraduate Inbound Exchange Students</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="graf12" width="600" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>13. Graduate / Postgraduate Outbound Exchange Students</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="graf13" width="600" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>14. Graduate / Postgraduate Students</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="graf14" width="600" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- STUDENT - OVERALL -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>15. Student - Overall</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="graf15" width="600" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>16. Number of Female Students</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="graf16" width="600" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>17. International Students - Overall</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="graf17" width="600" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>18. Number of Male Students</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="graf18" width="600" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>19. Exchange Students - Inbound</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="graf19" width="600" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>20. Exchange Students - Outbound</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="graf20" width="600" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- AVERAGE TUITION FEES -->
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>21. Undergraduate Fees - International (Rp.)</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="graf21" width="600" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>21. Undergraduate Fees - International ($USD)</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="graf21a" width="600" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>22. Undergraduate Fees - Domestic (Rp.)</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="graf22" width="600" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>22. Undergraduate Fees - Domestic ($USD)</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="graf22a" width="600" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>23. Graduate / Postgraduate Fees - Domestic (Rp.)</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="graf23" width="600" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>23. Graduate / Postgraduate Fees - Domestic ($USD)</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="graf23a" width="600" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>24. Graduate / Postgraduate Fees - International (Rp.)</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="graf24" width="600" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>24. Graduate / Postgraduate Fees - International ($USD)</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="graf24a" width="600" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>25. Overall Student Fees - Domestic (Rp.)</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="graf25" width="600" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>25. Overall Student Fees - Domestic ($USD)</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="graf25a" width="600" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>26. Overall Student Fees - International (Rp.)</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="graf26" width="600" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-title">
                                                <h4>26. Overall Student Fees - International ($USD)</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="graf26a" width="600" height="200"></canvas>
                                            </div>
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
            <footer class="footer"> © 2018 All rights reserved</footer>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->




<?php
$this->load->view('bar/js');
?>

<script>
    $(document).ready(function() {

    var graf1 = document.getElementById("graf1");
    var graf2 = document.getElementById("graf2");
    var graf3 = document.getElementById("graf3");
    var graf4 = document.getElementById("graf4");
    var graf5 = document.getElementById("graf5");
    var graf6 = document.getElementById("graf6");
    var graf7 = document.getElementById("graf7");
    var graf8 = document.getElementById("graf8");
    var graf9 = document.getElementById("graf9");
    var graf10 = document.getElementById("graf10");
    var graf11 = document.getElementById("graf11");
    var graf12 = document.getElementById("graf12");
    var graf13 = document.getElementById("graf13");
    var graf14 = document.getElementById("graf14");
    var graf15 = document.getElementById("graf15");
    var graf16 = document.getElementById("graf16");
    var graf17 = document.getElementById("graf17");
    var graf18 = document.getElementById("graf18");
    var graf19 = document.getElementById("graf19");
    var graf20 = document.getElementById("graf20");
    var graf21 = document.getElementById("graf21");
    var graf21a = document.getElementById("graf21a");
    var graf22 = document.getElementById("graf22");
    var graf22a = document.getElementById("graf22a");
    var graf23 = document.getElementById("graf23");
    var graf23a = document.getElementById("graf23a");
    var graf24 = document.getElementById("graf24");
    var graf24a = document.getElementById("graf24a");
    var graf25 = document.getElementById("graf25");
    var graf25a = document.getElementById("graf25a");
    var graf26 = document.getElementById("graf26");
    var graf26a = document.getElementById("graf26a");

    var barChart = new Chart(graf1, {
        type: 'bar',
        data: {
            labels: ["Full Time", "Part Time", "Headcount", "FTE"],
            datasets: [{
            label: 'Data 1',
            data: [<?php echo 0; ?>, <?php echo $visiting_inbound_parttime; ?>, <?php echo $visiting_inbound_parttime ?>, <?php echo $visiting_inbound_parttime ?>],
            backgroundColor: "rgba(255, 99, 132, 0.6)"
            },{
            label: 'Data 2',
            data: [<?php echo 0; ?>, <?php echo $visiting_inbound_parttime2; ?>, <?php echo $visiting_inbound_parttime2; ?>, <?php echo $visiting_inbound_parttime2; ?> ],
            backgroundColor: "rgba(255, 206, 86, 0.6)"
            }]
        }
    });
    var barChart = new Chart(graf2, {
        type: 'bar',
        data: {
            labels: ["Full Time", "Part Time", "Headcount", "FTE"],
            datasets: [{
            label: 'Data 1',
            data: [<?php echo 0; ?>, <?php echo $visiting_inbound_parttime; ?>, <?php echo $visiting_inbound_parttime ?>, <?php echo $visiting_inbound_parttime ?>],
            backgroundColor: "rgba(255, 99, 132, 0.6)"
            },{
            label: 'Data 2',
            data: [<?php echo 0; ?>, <?php echo $visiting_inbound_parttime2; ?>, <?php echo $visiting_inbound_parttime2; ?>, <?php echo $visiting_inbound_parttime2; ?> ],
            backgroundColor: "rgba(255, 206, 86, 0.6)"
            }]
        }
    });
    var barChart = new Chart(graf3, {
        type: 'bar',
        data: {
            labels: ["Full Time", "Part Time", "Headcount", "FTE"],
            datasets: [{
            label: 'Data 1',
            data: [<?php echo 0; ?>, <?php echo 0; ?>, <?php echo 0; ?>, <?php echo 0; ?>],
            backgroundColor: "rgba(255, 99, 132, 0.6)"
            },{
            label: 'Data 2',
            data: [<?php echo 0; ?>, <?php echo 0; ?>, <?php echo 0; ?>, <?php echo 0; ?> ],
            backgroundColor: "rgba(255, 206, 86, 0.6)"
            }]
        }
    });
    var barChart = new Chart(graf4, {
        type: 'bar',
        data: {
            labels: ["Full Time", "Part Time", "Headcount", "FTE"],
            datasets: [{
            label: 'Data 1',
            data: [<?php echo $staff_phd_full; ?>, <?php echo $staff_phd_part = $staff_phd_dosen_part + $staff_phd_tamu_part; ?>, <?php echo $staff_phd_full + $staff_phd_part; ?>, <?php echo round($staff_phd_full + ($staff_phd_part / 3)); ?>],
            backgroundColor: "rgba(255, 99, 132, 0.6)"
            },{
            label: 'Data 2',
            data: [<?php echo $staff_phd_full2; ?>, <?php echo $staff_phd_part2 = $staff_phd_dosen_part2 + $staff_phd_tamu_part2; ?>, <?php echo $staff_phd_full2 + $staff_phd_part2; ?>, <?php echo round($staff_phd_full2 + ($staff_phd_part2 / 3)); ?>],
            backgroundColor: "rgba(255, 206, 86, 0.6)"
            }]
        }
    });
    var barChart = new Chart(graf5, {
        type: 'bar',
        data: {
            labels: ["Full Time", "Part Time", "Headcount", "FTE"],
            datasets: [{
            label: 'Data 1',
            data: [<?php echo $staff_dosen_full ?>, <?php echo $staff_tamu_part ?>, <?php echo $staff_dosen_full + $staff_tamu_part ?>, <?php echo round($staff_dosen_full + ($staff_tamu_part / 3)) ?>],
            backgroundColor: "rgba(255, 99, 132, 0.6)"
            },{
            label: 'Data 2',
            data: [<?php echo $staff_dosen_full2 ?>, <?php echo $staff_tamu_part2 ?>, <?php echo $staff_dosen_full2 + $staff_tamu_part2 ?>, <?php echo round($staff_dosen_full2 + ($staff_tamu_part2 / 3)) ?>],
            backgroundColor: "rgba(255, 206, 86, 0.6)"
            }]
        }
    });
    var barChart = new Chart(graf6, {
        type: 'bar',
        data: {
            labels: ["Full Time", "Part Time", "Headcount", "FTE"],
            datasets: [{
            label: 'Data 1',
            data: [<?php echo $undergraduate_international_students ?>, <?php echo 0; ?>, <?php echo $undergraduate_international_students ?>, <?php echo $undergraduate_international_students ?>],
            backgroundColor: "rgba(255, 99, 132, 0.6)"
            },{
            label: 'Data 2',
            data: [<?php echo $undergraduate_international_students2; ?>, <?php echo 0; ?>, <?php echo $undergraduate_international_students2; ?>, <?php echo $undergraduate_international_students2; ?> ],
            backgroundColor: "rgba(255, 206, 86, 0.6)"
            }]
        }
    });
    var barChart = new Chart(graf7, {
        type: 'bar',
        data: {
            labels: ["Full Time", "Part Time", "Headcount", "FTE"],
            datasets: [{
            label: 'Data 1',
            data: [<?php echo $undergraduate_students ?>, <?php echo 0; ?>, <?php echo $undergraduate_students ?>, <?php echo $undergraduate_students ?>],
            backgroundColor: "rgba(255, 99, 132, 0.6)"
            },{
            label: 'Data 2',
            data: [<?php echo $undergraduate_students2; ?>, <?php echo 0; ?>, <?php echo $undergraduate_students2; ?>, <?php echo $undergraduate_students2; ?> ],
            backgroundColor: "rgba(255, 206, 86, 0.6)"
            }]
        }
    });
    var barChart = new Chart(graf8, {
        type: 'bar',
        data: {
            labels: ["Full Time", "Part Time", "Headcount", "FTE"],
            datasets: [{
            label: 'Data 1',
            data: [<?php echo $undergraduate_inbound_students ?>, <?php echo 0; ?>, <?php echo $undergraduate_inbound_students ?>, <?php echo $undergraduate_inbound_students ?>],
            backgroundColor: "rgba(255, 99, 132, 0.6)"
            },{
            label: 'Data 2',
            data: [<?php echo $undergraduate_inbound_students2; ?>, <?php echo 0; ?>, <?php echo $undergraduate_inbound_students2; ?>, <?php echo $undergraduate_inbound_students2; ?> ],
            backgroundColor: "rgba(255, 206, 86, 0.6)"
            }]
        }
    });
    var barChart = new Chart(graf9, {
        type: 'bar',
        data: {
            labels: ["Full Time", "Part Time", "Headcount", "FTE"],
            datasets: [{
            label: 'Data 1',
            data: [<?php echo $undergraduate_outbound_students ?>, <?php echo 0; ?>, <?php echo $undergraduate_outbound_students ?>, <?php echo $undergraduate_outbound_students ?>],
            backgroundColor: "rgba(255, 99, 132, 0.6)"
            },{
            label: 'Data 2',
            data: [<?php echo $undergraduate_outbound_students2; ?>, <?php echo 0; ?>, <?php echo $undergraduate_outbound_students2; ?>, <?php echo $undergraduate_outbound_students2; ?> ],
            backgroundColor: "rgba(255, 206, 86, 0.6)"
            }]
        }
    });
    var barChart = new Chart(graf10, {
        type: 'bar',
        data: {
            labels: ["Full Time", "Part Time", "Headcount", "FTE"],
            datasets: [{
            label: 'Data 1',
            data: [<?php echo $undergraduate_firstyear_student ?>, <?php echo 0; ?>, <?php echo $undergraduate_firstyear_student ?>, <?php echo $undergraduate_firstyear_student ?>],
            backgroundColor: "rgba(255, 99, 132, 0.6)"
            },{
            label: 'Data 2',
            data: [<?php echo $undergraduate_firstyear_student2; ?>, <?php echo 0; ?>, <?php echo $undergraduate_firstyear_student2; ?>, <?php echo $undergraduate_firstyear_student2; ?> ],
            backgroundColor: "rgba(255, 206, 86, 0.6)"
            }]
        }
    });
    var barChart = new Chart(graf11, {
        type: 'bar',
        data: {
            labels: ["Full Time", "Part Time", "Headcount", "FTE"],
            datasets: [{
            label: 'Data 1',
            data: [<?php echo $grapost_international_students ?>, <?php echo 0; ?>, <?php echo $grapost_international_students ?>, <?php echo $grapost_international_students ?>],
            backgroundColor: "rgba(255, 99, 132, 0.6)"
            },{
            label: 'Data 2',
            data: [<?php echo $grapost_international_students2 ?>, <?php echo 0; ?>, <?php echo $grapost_international_students2 ?>, <?php echo $grapost_international_students2 ?>],
            backgroundColor: "rgba(255, 206, 86, 0.6)"
            }]
        }
    });
    var barChart = new Chart(graf12, {
        type: 'bar',
        data: {
            labels: ["Full Time", "Part Time", "Headcount", "FTE"],
            datasets: [{
            label: 'Data 1',
            data: [<?php echo $grapost_inbound_students ?>, <?php echo 0; ?>, <?php echo $grapost_inbound_students ?>, <?php echo $grapost_inbound_students ?>],
            backgroundColor: "rgba(255, 99, 132, 0.6)"
            },{
            label: 'Data 2',
            data: [<?php echo $grapost_inbound_students2; ?>, <?php echo 0; ?>, <?php echo $grapost_inbound_students2; ?>, <?php echo $grapost_inbound_students2; ?> ],
            backgroundColor: "rgba(255, 206, 86, 0.6)"
            }]
        }
    });
    var barChart = new Chart(graf13, {
        type: 'bar',
        data: {
            labels: ["Full Time", "Part Time", "Headcount", "FTE"],
            datasets: [{
            label: 'Data 1',
            data: [<?php echo $grapost_outbound_students ?>, <?php echo 0; ?>, <?php echo $grapost_outbound_students ?>, <?php echo $grapost_outbound_students ?>],
            backgroundColor: "rgba(255, 99, 132, 0.6)"
            },{
            label: 'Data 2',
            data: [<?php echo $grapost_outbound_students2; ?>, <?php echo 0; ?>, <?php echo $grapost_outbound_students2; ?>, <?php echo $grapost_outbound_students2; ?> ],
            backgroundColor: "rgba(255, 206, 86, 0.6)"
            }]
        }
    });
    var barChart = new Chart(graf14, {
        type: 'bar',
        data: {
            labels: ["Full Time", "Part Time", "Headcount", "FTE"],
            datasets: [{
            label: 'Data 1',
            data: [<?php echo $grapost_students ?>, <?php echo 0; ?>, <?php echo $grapost_students ?>, <?php echo $grapost_students ?>],
            backgroundColor: "rgba(255, 99, 132, 0.6)"
            },{
            label: 'Data 2',
            data: [<?php echo $grapost_students; ?>, <?php echo 0; ?>, <?php echo $grapost_students; ?>, <?php echo $grapost_students; ?> ],
            backgroundColor: "rgba(255, 206, 86, 0.6)"
            }]
        }
    });
    var barChart = new Chart(graf15, {
        type: 'bar',
        data: {
            labels: ["Full Time", "Part Time", "Headcount", "FTE"],
            datasets: [{
            label: 'Data 1',
            data: [<?php echo $overall_students ?>, <?php echo 0; ?>, <?php echo $overall_students ?>, <?php echo $overall_students ?>],
            backgroundColor: "rgba(255, 99, 132, 0.6)"
            },{
            label: 'Data 2',
            data: [<?php echo $overall_students2; ?>, <?php echo 0; ?>, <?php echo $overall_students2; ?>, <?php echo $overall_students2; ?> ],
            backgroundColor: "rgba(255, 206, 86, 0.6)"
            }]
        }
    });
    var barChart = new Chart(graf16, {
        type: 'bar',
        data: {
            labels: ["Full Time", "Part Time", "Headcount", "FTE"],
            datasets: [{
            label: 'Data 1',
            data: [<?php echo $female ?>, <?php echo 0; ?>, <?php echo $female ?>, <?php echo $female ?>],
            backgroundColor: "rgba(255, 99, 132, 0.6)"
            },{
            label: 'Data 2',
            data: [<?php echo $female2; ?>, <?php echo 0; ?>, <?php echo $female2; ?>, <?php echo $female2; ?> ],
            backgroundColor: "rgba(255, 206, 86, 0.6)"
            }]
        }
    });
    var barChart = new Chart(graf17, {
        type: 'bar',
        data: {
            labels: ["Full Time", "Part Time", "Headcount", "FTE"],
            datasets: [{
            label: 'Data 1',
            data: [<?php echo $overall_international ?>, <?php echo 0; ?>, <?php echo $overall_international ?>, <?php echo $overall_international ?>],
            backgroundColor: "rgba(255, 99, 132, 0.6)"
            },{
            label: 'Data 2',
            data: [<?php echo $overall_international2; ?>, <?php echo 0; ?>, <?php echo $overall_international2; ?>, <?php echo $overall_international2; ?> ],
            backgroundColor: "rgba(255, 206, 86, 0.6)"
            }]
        }
    });
    var barChart = new Chart(graf18, {
        type: 'bar',
        data: {
            labels: ["Full Time", "Part Time", "Headcount", "FTE"],
            datasets: [{
            label: 'Data 1',
            data: [<?php echo $male ?>, <?php echo 0; ?>, <?php echo $male ?>, <?php echo $male ?>],
            backgroundColor: "rgba(255, 99, 132, 0.6)"
            },{
            label: 'Data 2',
            data: [<?php echo $male2; ?>, <?php echo 0; ?>, <?php echo $male2; ?>, <?php echo $male2; ?> ],
            backgroundColor: "rgba(255, 206, 86, 0.6)"
            }]
        }
    });
    var barChart = new Chart(graf19, {
        type: 'bar',
        data: {
            labels: ["Full Time", "Part Time", "Headcount", "FTE"],
            datasets: [{
            label: 'Data 1',
            data: [<?php echo $inbound ?>, <?php echo 0; ?>, <?php echo $inbound ?>, <?php echo $inbound ?>],
            backgroundColor: "rgba(255, 99, 132, 0.6)"
            },{
            label: 'Data 2',
            data: [<?php echo $inbound2; ?>, <?php echo 0; ?>, <?php echo $inbound2; ?>, <?php echo $inbound2; ?> ],
            backgroundColor: "rgba(255, 206, 86, 0.6)"
            }]
        }
    });
    var barChart = new Chart(graf20, {
        type: 'bar',
        data: {
            labels: ["Full Time", "Part Time", "Headcount", "FTE"],
            datasets: [{
            label: 'Data 1',
            data: [<?php echo $outbound ?>, <?php echo 0; ?>, <?php echo $outbound ?>, <?php echo $outbound ?>],
            backgroundColor: "rgba(255, 99, 132, 0.6)"
            },{
            label: 'Data 2',
            data: [<?php echo $outbound2 ?>, <?php echo 0; ?>, <?php echo $outbound2 ?>, <?php echo $outbound2 ?>],
            backgroundColor: "rgba(255, 206, 86, 0.6)"
            }]
        }
    });
    var barChart = new Chart(graf21, {
        type: 'bar',
        data: {
            labels: ["IDR"],
            datasets: [{
            label: 'Data 1',
            data: [<?php echo round((($fees_undergraduate_students_international->fee)+0)/$undergraduate_international_students); ?>],
            },{
            label: 'Data 2',
            data: [<?php echo round((($fees_undergraduate_students_international2->fee)+0)/$undergraduate_international_students2); ?>],
            backgroundColor: "rgba(255, 206, 86, 0.6)"
            }]
        }
    });
    var barChart = new Chart(graf21a, {
        type: 'bar',
        data: {
            labels: ["USD"],
            datasets: [{
            label: 'Data 1',
            data: [<?php echo round(((($fees_undergraduate_students_international->fee)+0)/$undergraduate_international_students)/14000); ?>],
            },{
            label: 'Data 2',
            data: [<?php echo round(((($fees_undergraduate_students_international2->fee)+0)/$undergraduate_international_students2)/14000); ?>],
            backgroundColor: "rgba(255, 206, 86, 0.6)"
            }]
        }
    });
    var barChart = new Chart(graf22, {
        type: 'bar',
        data: {
            labels: ["IDR"],
            datasets: [{
            label: 'Data 1',
            data: [<?php echo round((($fees_undergraduate_students_international->fee)+0)/$undergraduate_international_students); ?>],
            backgroundColor: "rgba(255, 99, 132, 0.6)"
            },{
            label: 'Data 2',
            data: [<?php echo round((($fees_undergraduate_students_international2->fee)+0)/$undergraduate_international_students2); ?>],
            backgroundColor: "rgba(255, 206, 86, 0.6)"
            }]
        }
    });
    var barChart = new Chart(graf22a, {
        type: 'bar',
        data: {
            labels: ["USD"],
            datasets: [{
            label: 'Data 1',
            data: [<?php echo round(((($fees_undergraduate_students_international->fee)+0)/$undergraduate_international_students)/14000); ?>],
            backgroundColor: "rgba(255, 99, 132, 0.6)"
            },{
            label: 'Data 2',
            data: [<?php echo round(((($fees_undergraduate_students_international2->fee)+0)/$undergraduate_international_students2)/14000); ?>],
            backgroundColor: "rgba(255, 206, 86, 0.6)"
            }]
        }
    });
    var barChart = new Chart(graf23, {
        type: 'bar',
        data: {
            labels: ["IDR"],
            datasets: [{
            label: 'Data 1',
            data: [<?php echo round((($fees_undergraduate_students_international->fee)+0)/$undergraduate_international_students); ?>],
            backgroundColor: "rgba(255, 99, 132, 0.6)"
            },{
            label: 'Data 2',
            data: [<?php echo round((($fees_undergraduate_students_international2->fee)+0)/$undergraduate_international_students2); ?>],
            backgroundColor: "rgba(255, 206, 86, 0.6)"
            }]
        }
    });
    var barChart = new Chart(graf23a, {
        type: 'bar',
        data: {
            labels: ["USD"],
            datasets: [{
            label: 'Data 1',
            data: [<?php echo round(((($fees_undergraduate_students_international->fee)+0)/$undergraduate_international_students)/14000); ?>],
            backgroundColor: "rgba(255, 99, 132, 0.6)"
            },{
            label: 'Data 2',
            data: [<?php echo round(((($fees_undergraduate_students_international2->fee)+0)/$undergraduate_international_students2)/14000); ?>],
            backgroundColor: "rgba(255, 206, 86, 0.6)"
            }]
        }
    });
    var barChart = new Chart(graf24, {
        type: 'bar',
        data: {
            labels: ["IDR"],
            datasets: [{
            label: 'Data 1',
            data: [<?php echo round((($fees_undergraduate_students_international->fee)+0)/$undergraduate_international_students); ?>],
            backgroundColor: "rgba(255, 99, 132, 0.6)"
            },{
            label: 'Data 2',
            data: [<?php echo round((($fees_undergraduate_students_international2->fee)+0)/$undergraduate_international_students2); ?>],
            backgroundColor: "rgba(255, 206, 86, 0.6)"
            }]
        }
    });
    var barChart = new Chart(graf24a, {
        type: 'bar',
        data: {
            labels: ["USD"],
            datasets: [{
            label: 'Data 1',
            data: [<?php echo round(((($fees_undergraduate_students_international->fee)+0)/$undergraduate_international_students)/14000); ?>],
            backgroundColor: "rgba(255, 99, 132, 0.6)"
            },{
            label: 'Data 2',
            data: [<?php echo round(((($fees_undergraduate_students_international2->fee)+0)/$undergraduate_international_students2)/14000); ?>],
            backgroundColor: "rgba(255, 206, 86, 0.6)"
            }]
        }
    });
    var barChart = new Chart(graf25, {
        type: 'bar',
        data: {
            labels: ["IDR"],
            datasets: [{
            label: 'Data 1',
            data: [<?php echo round((($fees_undergraduate_students_international->fee)+0)/$undergraduate_international_students); ?>],
            backgroundColor: "rgba(255, 99, 132, 0.6)"
            },{
            label: 'Data 2',
            data: [<?php echo round((($fees_undergraduate_students_international2->fee)+0)/$undergraduate_international_students2); ?>],
            backgroundColor: "rgba(255, 206, 86, 0.6)"
            }]
        }
    });
    var barChart = new Chart(graf25a, {
        type: 'bar',
        data: {
            labels: ["USD"],
            datasets: [{
            label: 'Data 1',
            data: [<?php echo round(((($fees_undergraduate_students_international->fee)+0)/$undergraduate_international_students)/14000); ?>],
            backgroundColor: "rgba(255, 99, 132, 0.6)"
            },{
            label: 'Data 2',
            data: [<?php echo round(((($fees_undergraduate_students_international2->fee)+0)/$undergraduate_international_students2)/14000); ?>],
            backgroundColor: "rgba(255, 206, 86, 0.6)"
            }]
        }
    });
    var barChart = new Chart(graf26, {
        type: 'bar',
        data: {
            labels: ["IDR"],
            datasets: [{
            label: 'Data 1',
            data: [<?php echo round((($fees_undergraduate_students_international->fee)+0)/$undergraduate_international_students); ?>],
            backgroundColor: "rgba(255, 99, 132, 0.6)"
            },{
            label: 'Data 2',
            data: [<?php echo round((($fees_undergraduate_students_international2->fee)+0)/$undergraduate_international_students2); ?>],
            backgroundColor: "rgba(255, 206, 86, 0.6)"
            }]
        }
    });
    var barChart = new Chart(graf26a, {
        type: 'bar',
        data: {
            labels: ["USD"],
            datasets: [{
            label: 'Data 1',
            data: [<?php echo round(((($fees_undergraduate_students_international->fee)+0)/$undergraduate_international_students)/14000); ?>],
            backgroundColor: "rgba(255, 99, 132, 0.6)"
            },{
            label: 'Data 2',
            data: [<?php echo round(((($fees_undergraduate_students_international2->fee)+0)/$undergraduate_international_students2)/14000); ?>],
            backgroundColor: "rgba(255, 206, 86, 0.6)"
            }]
        }
    });

    } );
</script>