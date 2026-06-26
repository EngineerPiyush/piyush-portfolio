<?php 
header("Access-Control-Allow-Origin: *");
require_once('config.php');

if($_SERVER['REQUEST_METHOD']=='POST'){
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$company = $_POST['company'];
$message = $_POST['message'];

$check_stmt = $conn->prepare("SELECT email, phone FROM contact WHERE email = ? OR phone = ?");

$check_stmt->bind_param("ss", $email, $phone);
$check_stmt->execute();

$check_stmt->bind_result($fetched_email, $fetched_phone);

if($check_stmt->fetch()){
    if ($fetched_email === $email) {
        echo "You have already registered with the email: " . $fetched_email;
    } else if ($fetched_phone === $phone) {
        echo "You have already registered with the phone number: " . $fetched_phone;
    }
    
    $check_stmt->close();
    die();
}

$check_stmt->close();

$sql = "INSERT INTO contact (name,email,phone,company,message) VALUES (?,?,?,?,?)";

if($stmt = $conn->prepare($sql)){
  $stmt->bind_param("sssss" , $name,$email,$phone,$company,$message);
  if($stmt->execute()){
    echo("We have recieved your response. Thank You");
  }else{
    echo("Submission failed please contact via email or phone given on website");
  }
}
// if($conn->query($sql)){
//   echo("we have recieved your response. Thank You");
// }else{
//   echo("data could not be sent please contact via email");
// }
}

?>