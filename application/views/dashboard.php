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
                    <h3 class="text-primary">Dashboard</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <!-- <div class="row">
                    <div class="col-md-3">
                        <div class="card bg-primary p-20">
                            <div class="media widget-ten">
                                <div class="media-left meida media-middle">
                                    <span><i class="ti-user f-s-40"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2 class="color-white"><?php echo $mahasiswairisan ?></h2>
                                    <p class="m-b-0">Mahasiswa</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-pink p-20">
                            <div class="media widget-ten">
                                <div class="media-left meida media-middle">
                                    <span><i class="ti-user f-s-40"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2 class="color-white"><?php echo $dosen ?></h2>
                                    <p class="m-b-0">Dosen</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success p-20">
                            <div class="media widget-ten">
                                <div class="media-left meida media-middle">
                                    <span><i class="ti-user f-s-40"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2 class="color-white"><?php echo $dosen_tamu ?></h2>
                                    <p class="m-b-0">Dosen Tamu</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="row">
                    
                </div>

                <div class="row">
                    <!-- <div class="col-lg-6">
                        <div class="card">
                            <div class="card-title">
                                <h4>International Faculty Staff</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="InternationalFacultyStaff" width="600" height="400"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-title">
                                <h4>STUDENT - OVERALL</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="chartStudent" width="600" height="400"></canvas>
                            </div>
                        </div>
                    </div> -->
                    <!-- /# column -->
                    <!-- <div class="col-lg-6">
                        <div class="card">
                            <div class="card-title">
                                <h4>STUDENT - GENDER</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="chartGender" width="600" height="400"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-title">
                                <h4>STUDENT - INBOUND & OUTBOUND</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="chartInOut" width="600" height="400"></canvas>
                            </div>
                        </div>
                    </div> -->
                </div>

                
                        </div>
                    </div> -->
                </div>
                    <!-- /# column -->
                    

                </div>


                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
            <!-- footer -->
            <footer class="footer"> © 2018 All rights reserved.</footer>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->
    </div>
    <!-- End Wrapper -->

<?php
$this->load->view('bar/js');
?>

</body>

</html>

<script type="text/javascript">
    var chartStudent = document.getElementById("chartStudent");
    var chartGender = document.getElementById("chartGender");
    var chartInOut = document.getElementById("chartInOut");
    var chartIFS = document.getElementById("InternationalFacultyStaff");
    // var chartStudent = document.getElementById("chartStudent");
    // var chartStudent = document.getElementById("chartStudent");

    var barChart = new Chart(chartStudent, {
        type: 'bar',
        data: {
            labels: ["Student", "International"],
            datasets: [{
            label: 'Student',
            data: [<?php echo $overall_students ?>, <?php echo $overall_international ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)',
                'rgba(255, 159, 64, 0.6)',
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)'
            ]
            }]
        }
    });
    var barChart = new Chart(chartGender, {
        type: 'bar',
        data: {
            labels: ["Male", "Female"],
            datasets: [{
            label: 'Student',
            data: [<?php echo $male ?>, <?php echo $female ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)',
                'rgba(255, 159, 64, 0.6)',
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)'
            ]
            }]
        }
    });
    var barChart = new Chart(chartInOut, {
        type: 'bar',
        data: {
            labels: ["Inbound", "Outbound" ],
            datasets: [{
            label: 'Student',
            data: [<?php echo $inbound ?>, <?php echo $outbound ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)',
                'rgba(255, 159, 64, 0.6)',
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)'
            ]
            }]
        }
    });
    var barChart = new Chart(chartIFS, {
        type: 'bar',
        data: {
            labels: ["International Faculty Staff"],
            datasets: [{
            label: 'Staff',
            data: [<?php echo round(($visiting_inbound_parttime/($staff_dosen_full+$staff_dosen_part))*100) ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)',
                'rgba(255, 159, 64, 0.6)',
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)'
            ]
            }]
        },
        options: {
        tooltips: {
            callbacks: {
                label: function(tooltipItem, data) {
                    var label = data.datasets[tooltipItem.datasetIndex].label || '';

                    if (label) {
                        label += ' : ';
                    }
                    label += tooltipItem.yLabel + ' %';
                    return label;
                }
            }
        }
    }
    });
    // var barChart = new Chart(chartStudent, {
    //     type: 'bar',
    //     data: {
    //         labels: ["Student", "Overall International", "Male", "Female", "Inbound", "Outbound" ],
    //         datasets: [{
    //         label: 'People',
    //         data: [<?php echo $overall_students ?>, <?php echo $overall_international ?>, <?php echo $male ?>, <?php echo $male ?>, <?php echo $inbound ?>, <?php echo $outbound ?>],
    //         backgroundColor: [
    //             'rgba(255, 99, 132, 0.6)',
    //             'rgba(54, 162, 235, 0.6)',
    //             'rgba(255, 206, 86, 0.6)',
    //             'rgba(75, 192, 192, 0.6)',
    //             'rgba(153, 102, 255, 0.6)',
    //             'rgba(255, 159, 64, 0.6)',
    //             'rgba(255, 99, 132, 0.6)',
    //             'rgba(54, 162, 235, 0.6)',
    //             'rgba(255, 206, 86, 0.6)',
    //             'rgba(75, 192, 192, 0.6)',
    //             'rgba(153, 102, 255, 0.6)'
    //         ]
    //         }]
    //     }
    // });
    // var barChart = new Chart(chartStudent, {
    //     type: 'bar',
    //     data: {
    //         labels: ["Student", "Overall International", "Male", "Female", "Inbound", "Outbound" ],
    //         datasets: [{
    //         label: 'People',
    //         data: [<?php echo $overall_students ?>, <?php echo $overall_international ?>, <?php echo $male ?>, <?php echo $male ?>, <?php echo $inbound ?>, <?php echo $outbound ?>],
    //         backgroundColor: [
    //             'rgba(255, 99, 132, 0.6)',
    //             'rgba(54, 162, 235, 0.6)',
    //             'rgba(255, 206, 86, 0.6)',
    //             'rgba(75, 192, 192, 0.6)',
    //             'rgba(153, 102, 255, 0.6)',
    //             'rgba(255, 159, 64, 0.6)',
    //             'rgba(255, 99, 132, 0.6)',
    //             'rgba(54, 162, 235, 0.6)',
    //             'rgba(255, 206, 86, 0.6)',
    //             'rgba(75, 192, 192, 0.6)',
    //             'rgba(153, 102, 255, 0.6)'
    //         ]
    //         }]
    //     }
    // });
</script>