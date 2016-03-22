<?php require_once(dirname(__FILE__).'./vendor/autoload.php');//autoload packages

use \McKay\Flash;
chk_lgn();
date_default_timezone_set('Africa/Nairobi');
$db = new Database();
$user = new User($db->conn);

$stmt = $user->readAll();

$users = array();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    $temp = array('id' => $id,'name' => $first_name.' '.$last_name );
    array_push($users,$temp);
}
//echo '<pre>';
//$users =  print_r($users);
//exit();
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
<?php

$drop = "\"<div class='form-group'><label>Patient Name</label><select class='form-control' id='input-field'>";
$i = 0;
foreach($users as $id => $name){
    $drop .= "<option value='".$name['id']."'>".$name['name']."</option>";
    $i++;
}
$drop .= "</select></div>";

$drop .= "<div class='form-group'><label>Date</label><input class='form-control' placeholder='yyyy-mm-dd' type='text' id='date'></div>";

$drop .= "<div class='form-group'><label>Time</label><input class='form-control' placeholder='hh:mm' type='text' id='time'></div>\"";

?>
<script>
        var users = <?=$drop?>;
</script>
<?php include 'templates/footer.php' ?>