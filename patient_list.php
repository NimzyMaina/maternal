<?php require_once(dirname(__FILE__).'./vendor/autoload.php');//autoload packages
$db = new Database();
$user = new User($db->conn);
//echo sha1('123456');
$stmt = $user->readAll();
$num = $stmt->rowCount();

require 'templates/header.php';
?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    List Patients
                    <small>Manage Patients</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-users"></i> List Patients
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">

<?php
if($num>0){
    echo "<div class='col-md-12'><table id='example1' class='table table-hover table-responsive table-bordered display nowrap'>";
    echo "<thead><tr>";
    echo "<th>First Name</th>";
    echo "<th>Last Name</th>";
    echo "<th>Email</th>";
    echo "<th>Phone</th>";
    echo "<th>Role</th>";
    echo "<th>Status</th>";
    echo "<th>Actions</th>";
    echo "</tr></thead>";
    echo "<tfoot><tr>";
    echo "<th>First Name</th>";
    echo "<th>Last Name</th>";
    echo "<th>Email</th>";
    echo "<th>Phone</th>";
    echo "<th>Role</th>";
    echo "<th>Status</th>";
    echo "<th>Actions</th>";
    echo "</tr></tfoot><tbody>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        echo "<tr>";
        echo "<td id='first_name:$id' contenteditable=\"true\">{$first_name}</td>";
        echo "<td id='last_name:$id' contenteditable=\"true\">{$last_name}</td>";
        echo "<td id='email:$id' contenteditable=\"true\">{$email}</td>";
        echo "<td id='phone:$id' contenteditable=\"true\">{$phone}</td>";
        echo "<td>{$role}</td>";
        if($status == 1){
            $temp = '<span class="toog label label-success" data-status="'.$status.'" data-id="'.$id.'" data-type="toog_user">Active</span>';
        }else{
            $temp = '<span class="toog label label-danger" data-status="'.$status.'" data-id="'.$id.'" data-type="toog_user">Inactive</span>';
        }
        echo '<td>'.$temp.'</td>';
        echo "<td>";
        // delete button is here
        echo "<a delete-id='{$id}' delete-type='delete_user' class='btn btn-danger delete-object'>Delete <i class='glyphicon glyphicon-floppy-remove'></i> </a>";
        echo "</td>";

        echo "</tr>";

    }


    echo "</tbody></table></div>";
}
?>

</div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<?php
require 'templates/footer.php';
?>
