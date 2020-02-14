<?php
 
// Importing DBConfig.php file.
include 'dbconfig.php';
 
// Creating connection.
$con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 
// Getting the received JSON into $json variable.
$json = file_get_contents('php://input');
 
// decoding the received JSON and store into $obj variable.
$obj = json_decode($json,true);
 
// Populate User email from JSON $obj array and store into $email.
$user_email = $obj['user_email'];
 
// Populate Password from JSON $obj array and store into $password.
$user_password = $obj['user_password'];
 
//Checking Email is already exist or not using SQL query.
$CheckSQL = "SELECT * FROM info WHERE user_email='$user_email' AND user_password='$user_password'";
 
// Executing SQL Query.
$check = mysqli_fetch_array(mysqli_query($con,$CheckSQL));
 
 
if(isset($check)){
 
 $SuccessMSG = 'Data matched!';
 
 // Converting the message into JSON format.
$SuccessJson = json_encode($SuccessMSG);
 
// Echo the message.
 echo $SuccessJson ; 
 
 }else{
 
    // If the record inserted successfully then show the message.
   $InvalidMSG = 'Invalid Username or Password Please Try Again' ;
    
   // Converting the message into JSON format.
   $InvalidMSGJSon = json_encode($InvalidMSG);
    
   // Echo the message.
    echo $InvalidMSGJSon ;
    
    }
 mysqli_close($con);
?>