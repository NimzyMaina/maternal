<?php require_once(dirname(__FILE__).'./vendor/autoload.php');//autoload packages

$db = new Database();

$user = new User($db->conn);
$users =  $user->readAll();
$num = $users->rowCount();

include "templates/header.php";
include "templates/menu.php";
// include "patients/patients.php";

?>
           

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Blank Page
                            <small>Subheading</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                <div class="col col-md-12">
                            <table class="table table-stripped table-bordered">
                            	<thead>
                            		<th>first Name</th>
                            		<th>last Name</th>
                            		<th>email</th>
                            		<th>Phone Number</th>
                            		<th data-orderable='false'>actions</th>
                            	</thead>
                            	<tbody>
                            	<?php 
                            	while ($row = $users->fetch(PDO::FETCH_ASSOC)){

                            		extract($row);
                            	?>
                            		<tr>
                            			<td><?=$first_name?></td>
                            			<td><?=$last_name?></td>
                            			<td><?=$email?></td>
                            			<td><?=$phone_number?></td>
                            			<td><a href="<?=asset("/edituser.php?id=$id")?>" class="btn btn-success">Edit <i class="fa fa-pencil-square-o"></i></a>
                            			&nbsp;
                            			<a href="#" class="btn btn-danger">Delete <i class="fa fa-trash"></i></a></td>
                            		</tr>
                            		<?php }?>
                            		
                            	</tbody>
                            </table>
                </div>
</div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php
include "templates/footer.php";

?>