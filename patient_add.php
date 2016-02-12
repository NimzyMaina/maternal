<?php require_once(dirname(__FILE__).'./vendor/autoload.php');//autoload packages

use \McKay\Flash;

$db = new Database();
$user = new User($db->conn);

if($_POST){
	$user->first_name = $_POST['first_name'];
	$user->last_name = $_POST['last_name'];
	$user->email = $_POST['email'];
	$user->phone = $_POST['phone'];
	$user->status = 1;
	$user->role = 'standard';
	$user->password = '123456';

	if($user->register()){
		Flash::success('Patient Successfully Added!!');
	}else{
		Flash::error('Patient Cound Not Be Added!!');
	}
}

include 'templates/header.php';
?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Add Patients
                    <small>Add Patients</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-users"></i> Add Patients
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
			<div class="col col-md-6">
			<?php foreach(Flash::all() as $flash) { ?>
			    <div class="alert alert-<?= $flash['type'] == 'error' ? 'danger' : $flash['type'] ?>">
			        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			        <?= $flash['message'] ?>
			    </div>
			<?php } Flash::clear(); ?>
				<form role="form" method="post" id="registerForm" action="patient_add.php">
					<div class="form-group">
						<label for="first_name">First Name</label>
						<input type="text" class="form-control" name="first_name">
					</div>

					<div class="form-group">
						<label for="last_name">Last Name</label>
						<input type="text" class="form-control" name="last_name">
					</div>

					<div class="form-group">
						<label for="emaik">E-mail</label>
						<input type="email" class="form-control" name="email">
					</div>

					<div class="form-group">
						<label for="phone">Phone</label>
						<input type="text" class="form-control" name="phone">
					</div>

					<div class="form-group pull-right">
						<button class="btn btn-primary" type="submit">SUBMIT <i class="glyphicon glyphicon-floppy-save"></i></button>
					</div>
				</form>
			</div>        	
        </div>
 </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<?php
require 'templates/footer.php';
?>