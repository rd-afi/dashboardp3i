<!DOCTYPE html>
<html lang="en">

<?php
$this->load->view('bar/head');
?>

        <div class="page-wrapper">
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
            <div class="container-fluid"> 
                <div class="alert alert-light alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <p>Data Jumlah Mahasiswa tiap Prodi di tiap Fakultas</p>
                    <hr>
                    <p><i>Data yang masuk pada 2018</i></p>
                </div>
                <!-- FEB FIF FIK FIT FKB FRI FTE -->
                <div class="row">
                    <!-- column FEB -->
                    <div class="col-lg-4">
                        <div class="card">
                            <h4 class="card-title">FEB</h4>
                            <div class="card-body browser">
                                <?php foreach($feb as $feb){ ?>
                                <hr>
                                <p class="f-w-600"><?php echo $feb->study_program ?> <span class="pull-right"><?php echo $feb->total; ?></span></p>
                                <?php }  ?>
                            </div>
                        </div>
                    </div>
                    <!-- column -->
                    <!-- column FIF -->
                    <div class="col-lg-4">
                        <div class="card">
                            <h4 class="card-title">FIF</h4>
                            <div class="card-body browser">
                                <?php foreach($fif as $fif){ ?>
                                <hr>
                                <p class="f-w-600"><?php echo $fif->study_program ?> <span class="pull-right"><?php echo $fif->total; ?></span></p>
                                <?php }  ?>
                            </div>
                        </div>
                    </div>
                    <!-- column -->
                    <!-- column FIK -->
                    <div class="col-lg-4">
                        <div class="card">
                            <h4 class="card-title">FIK</h4>
                            <div class="card-body browser">
                                <?php foreach($fik as $fik){ ?>
                                <hr>
                                <p class="f-w-600"><?php echo $fik->study_program ?> <span class="pull-right"><?php echo $fik->total; ?></span></p>
                                <?php }  ?>
                            </div>
                        </div>
                    </div>
                    <!-- column -->
                </div>

                <div class="row">
                    <!-- column FIT -->
                    <div class="col-lg-4">
                        <div class="card">
                            <h4 class="card-title">FIT</h4>
                            <div class="card-body browser">
                                <?php foreach($fit as $fit){ ?>
                                <hr>
                                <p class="f-w-600"><?php echo $fit->study_program ?> <span class="pull-right"><?php echo $fit->total; ?></span></p>
                                <?php }  ?>
                            </div>
                        </div>
                    </div>
                    <!-- column -->
                    <!-- column FKB -->
                    <div class="col-lg-4">
                        <div class="card">
                            <h4 class="card-title">FKB</h4>
                            <div class="card-body browser">
                                <?php foreach($fkb as $fkb){ ?>
                                <hr>
                                <p class="f-w-600"><?php echo $fkb->study_program ?> <span class="pull-right"><?php echo $fkb->total; ?></span></p>
                                <?php }  ?>
                            </div>
                        </div>
                    </div>
                    <!-- column -->
                    <!-- column FRI -->
                    <div class="col-lg-4">
                        <div class="card">
                            <h4 class="card-title">FRI</h4>
                            <div class="card-body browser">
                                <?php foreach($fri as $fri){?>
                                <hr>
                                <p class="f-w-600"><?php echo $fri->study_program ?> <span class="pull-right"><?php echo $fri->total; ?></span></p>
                                <?php }  ?>
                            </div>
                        </div>
                    </div>
                    <!-- column -->
                </div>

                <div class="row">
                    <!-- column FTE -->
                    <div class="col-lg-4">
                        <div class="card">
                            <h4 class="card-title">FTE</h4>
                            <div class="card-body browser">
                                <?php foreach($fte as $fte){
                                echo "<hr>";
                                $total = $fte->total;
                                $end = 0;
                                // foreach ($total_all as $t) { $all = $t->total_all; }
                                // echo $total ." - ". $all ."<br>";
                                // $persen = ($total/$all)*100;
                                
                                ?>
                                <p class="f-w-600"><?php echo $fte->study_program ?> <span class="pull-right"><?php echo $total; ?></span></p>
                                <!-- <div class="progress ">
                                    <?php 
                                    echo "<div role='progressbar' style='width:".$total."%; height:8px;'' class='progress-bar bg-danger wow animated progress-animated'> <span class='sr-only'>60% Complete</span> </div>";
                                     ?>
                                </div> -->
                                <?php }  ?>
                            </div>
                        </div>
                    </div>
                    <!-- column -->
                </div>
            </div>

            </div>
        </div>
        <div>
            
        <footer class="footer"> © 2018 All rights reserved.</footer>
        </div>

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