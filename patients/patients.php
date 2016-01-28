<?php
$page_title = "Read Patients";
include "templates/header.php";
include "templates/menu.php";

echo "<div class='right-button-margin'>";
    echo "<a href='create_product.php' class='btn btn-default pull-right'>add patient</a>";
echo "</div>";


// page given in URL parameter, default page is one
// $page = isset($_GET['page']) ? $_GET['page'] : 1;
 
// // set number of records per page
// $records_per_page = 3;
 
// // calculate for the query LIMIT clause
// $from_record_num = ($records_per_page * $page) - $records_per_page;

// include database and object files
// include_once 'config/database.php';
// include_once 'objects/product.php';
// include_once 'objects/category.php';
 
// instantiate database and product object
if($_POST){
    $db = new Database();
    $user = new User($db->conn);

 
// query products
$stmt = $user->readAll($page, $from_record_num, $records_per_page);
$num = $stmt->rowCount();
 
// display the products if there are any
if($num>0){
 
    $user= new user($db);
 
    echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>first_name</th>";
            echo "<th>last_name</th>";
            echo "<th>email</th>";
            echo "<th>phone</th>";
            echo "<th>password</th>";
        echo "</tr>";
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr>";
                echo "<td>{$first_name}</td>";
                echo "<td>{$last_name}</td>";
                echo "<td>{$email}</td>";
                echo "<td>";
                    $user->id = $user_id;
                    $user->readName();
                    echo $user->name;
                echo "</td>";
 
                echo "<td>";
    // edit and delete button is here
    echo "<a href='update_product.php?id={$id}' class='btn btn-default left-margin'>Edit</a>";
    echo "<a delete-id='{$id}' class='btn btn-default delete-object'>Delete</a>";
echo "</td>";
 
            echo "</tr>";
 
        }
		
 
    echo "</table>";
 
    // paging buttons will be here
	// paging buttons here
include_once 'paging_product.php';
}
 
// tell the user there are no products
else{
    echo "<div>No products found.</div>";
}
?>

<script>
$(document).on('click', '.delete-object', function(){
 
    var id = $(this).attr('delete-id');
    var q = confirm("Are you sure?");
 
    if (q == true){
 
        $.post('delete_product.php', {
            object_id: id
        }, function(data){
            location.reload();
        }).fail(function() {
            alert('Unable to delete.');
        });
 
    }
 
    return false;
});
</script>

<?php
include "templates/footer.php";
?>