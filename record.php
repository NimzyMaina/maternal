<?php require_once(dirname(__FILE__).'./vendor/autoload.php');//autoload packages
use \McKay\Flash;
chk_lgn();
$db = new Database();
$user = new User($db->conn);
$record = new Record($db->conn);

if($_POST){
    $id = $_POST['id'];
    $update = $_POST['record'];
    if($record->update($id,$update)){
        Flash::success('Record Successfully Updated!!');
        unset($_POST);
    }else{
        Flash::error('Record Could Not Be Updated!!');
    }
}

if(isset($_GET['id'])){
   $user_id = $_GET['id'];
}else{
    $user_id = $_SESSION['user_id'];
    }
$data = $record->read($user_id);


require 'templates/header.php';
?>

<div id="page-wrapper">

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Patient Record
                <small>View Records</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-users"></i> Patient Record
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
    <div class="col-md-6">
        <?php foreach(Flash::all() as $flash) { ?>
            <div class="alert alert-<?= $flash['type'] == 'error' ? 'danger' : $flash['type'] ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $flash['message'] ?>
            </div>
        <?php } Flash::clear(); ?>
        <form action="<?=asset('/record.php?id=').$user_id?>" method="post">
            <?php while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
            extract($row);?>
        <div class="form-group">
            <label>Patient</label>
            <input type="text" class="form-control" value="<?=$first_name.' '.$last_name?>" disabled>
            <input type="hidden" name="id" value="<?=$id?>">
        </div>
        <div class="form-group">
            <label>Record</label>
            <textarea name="record" class="form-control" <?php if($_SESSION['role'] == 'patient'){echo 'disabled';}?> ><?=$record?></textarea>
        </div>
                <?php if($_SESSION['role'] != 'patient'){ ?>
                <button type="submit" class="btn btn-success pull-right">Submit <i class="fa fa-floppy-o"></i></button>
            <?php } }?>
        </form>
    </div>
</div>
    </div>
    </div>

<?php
require 'templates/footer.php';
?>
