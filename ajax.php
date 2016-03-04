<?php require 'vendor/autoload.php';

$db = new Database();
$user = new User($db->conn);
$appointments = new Appointments($db->conn);

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

    case 'new_appointment':
        $appointments->startdate = $_POST['startdate'].'+'.$_POST['zone'];
        $appointments->title = $_POST['title'];
        $lastid = $appointments->add();
        if($lastid){
            echo json_encode(array('status'=>'success','eventid'=>$lastid));
            exit;
        }
        break;

    case 'changetitle':
        $appointments->id = $_POST['eventid'];
        $appointments->title = $_POST['title'];
        $appointments->user_id = $_POST['user_id'];
        $user->id = $_POST['user_id'];
        date_default_timezone_set('Africa/Nairobi');
        $appointments->startdate = date('c',strtotime($_POST['startdate']));
        if( $appointments->edit()) {
            $data = $user->readOne();
            while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
                $e = array();
                extract($row);
                $p = $phone;
                $u = $first_name.' '.$last_name;
            }
            $p = explode('0',$p,2);
            sms("+254".$p[1] ,"Dear $u, Your next appointment will be on ".date('d M, Y h:i A',strtotime($appointments->startdate)));
            echo json_encode(array('status' => 'success'));
        }
        else{
            echo json_encode(array('status'=>'failed'));
        }
        exit;
        break;

    case 'fetch':
        $stmt = $appointments->readAll();
        $app = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $e = array();
            extract($row);
            $e['id'] = $id;
            $e['title'] = $title;
            $e['user_id'] = $user_id;
            $e['start'] = $startdate;
            $e['end'] = $enddate;
            $allday = ($allDay == "true") ? true : false;
            $e['allDay'] = $allday;
            array_push($app, $e);

        }

        //header('Content-Type: application/json');
        echo json_encode($app);
        exit();
        break;
}

echo json_encode(array(
    'valid' => $isAvailable,
));