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
                            <div class="card-title">
                                <h4>Input Style</h4>

                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form>
                                        <div class="form-group">
                                            <table style="width:100%">
                                              <tr>
                                                <td>International Faculty Staff</td>
                                                <td>
                                                    <input type="text" class="form-control input-default col-sm-4">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control input-default col-sm-4">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control input-default col-sm-4">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control input-default col-sm-4">
                                                </td>
                                              </tr>
                                            </table>
                                            <p class="text-muted m-b-15 f-s-12">Use the input classes on an <code>input-default</code> for Default input.</p>
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
            <footer class="footer"> © 2018 All rights reserved. Template designed by <a href="https://colorlib.com">Colorlib</a></footer>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->


<?php
$this->load->view('bar/js');
?>