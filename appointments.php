<?php require_once(dirname(__FILE__).'./vendor/autoload.php');//autoload packages

use \McKay\Flash;

$db = new Database();
include 'templates/header.php';
?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Appointments
                        <!-- <small>Add doctor</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-calendar"></i> Appointments
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col col-lg-2"
                <div id='external-events'>
                    <h4>Draggable Appointments</h4>
                    <div class='fc-event'>New Appointment</div>
                    <br>
                    <p>
                        <img src="<?=asset('/images/trashcan.png')?>" id="trash" alt="">
                    </p>
                </div>
            <div class="col col-lg-10">
                <div id='calendar'></div>
            </div>
            </div>

            </div>
        </div>
<?php include 'templates/footer.php' ?>