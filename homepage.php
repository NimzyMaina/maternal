<?php require_once(dirname(__FILE__).'./vendor/autoload.php');//autoload packages
chk_lgn();

$db = new Database();
$user = new User($db->conn);
$appointment = new Appointments($db->conn);

$unum = $user->countAllPatients();
$dnum = $user->countAllDocss();
$anum = $appointment->countAll();
require 'templates/header.php';
?>


<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Dashboard
                    <!-- <small>Add doctor</small> -->
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                    </li>
                </ol>
            </div>
        </div>

        <?php if($_SESSION['role'] == 'patient'){ ?>
        <div class="row">
            <>
        </div>

        <?php }else{ ?>


            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?=$unum?></div>
                                    <div>Patients</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?=asset('/patient_list.php')?>">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <?php if($_SESSION['role'] == 'admin') { ?>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-stethoscope fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?=$dnum?></div>
                                    <div>Doctors</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?=asset('/doctor_list.php')?>">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <?php }?>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-calendar fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?=$anum?></div>
                                    <div>Appointments</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?=asset('/appointments.php')?>">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
<!--                <div class="col-lg-3 col-md-6">-->
<!--                    <div class="panel panel-red">-->
<!--                        <div class="panel-heading">-->
<!--                            <div class="row">-->
<!--                                <div class="col-xs-3">-->
<!--                                    <i class="fa fa-support fa-5x"></i>-->
<!--                                </div>-->
<!--                                <div class="col-xs-9 text-right">-->
<!--                                    <div class="huge">13</div>-->
<!--                                    <div>Support Tickets!</div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <a href="#">-->
<!--                            <div class="panel-footer">-->
<!--                                <span class="pull-left">View Details</span>-->
<!--                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>-->
<!--                                <div class="clearfix"></div>-->
<!--                            </div>-->
<!--                        </a>-->
<!--                    </div>-->
<!--                </div>-->
            </div>
            <!-- /.row -->


        <?php } ?>
        </div>
    </div>

<?php
require 'templates/footer.php';
?>
