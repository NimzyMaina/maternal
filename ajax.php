<?php require 'vendor/autoload.php';

$db = new Database();
$user = new User($db->conn);

$isAvailable = false;

if(!isset($_POST['type'])){
    echo json_encode(array(
        'valid' => $isAvailable,
    ));
    exit;
}

switch($_POST['type']){
    case 'email':
        if($user->check_email($_POST['email'])){
            $isAvailable = true;
        }
        break;

    case 'phone':
        if($user->check_phone($_POST['phone'])){
            $isAvailable = true;
        }
        break;

    case 'delete_user':
        if($user->delete($_POST['object_id'])){
            $isAvailable = true;
        }
        break;

    case 'toog_user';
        if($_POST['status'] == 1){
            $status = 0;
        }else{
            $status = 1;
        }
        if($user->toogle($_POST['object_id'],$status)){
            $isAvailable = true;
        }
        break;
}

echo json_encode(array(
    'valid' => $isAvailable,
));