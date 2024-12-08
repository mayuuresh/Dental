<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    use Twilio\Rest\Client;

    function sendsms($msg)
    {  
    require_once '../vendor/autoload.php';

    $sid    = "ACd7619e60b337bec70340130cc817bd3f";
    $token  = "a7ecc1e9edbeaeef40131dd895ba8c1d";
    $twilio = new Client($sid, $token);

    $message = $twilio->messages->create("+918767244196", array("from" => "+16502295899","body" => $msg));


    }
    
    if($_GET){
        //import database
        include("../connection.php");
        $id=$_GET["id"];
        //$result001= $database->query("select * from schedule where scheduleid=$id;");
        //$email=($result001->fetch_assoc())["docemail"];
        $sql= $database->query("delete from appointment where appoid='$id';");
        $msg="Your appointment has been Cancelled. Your appointment number was ".$apponum." and the date was ".$date." . Thank you for choosing us.";
        sendsms($msg);
        //$sql= $database->query("delete from doctor where docemail='$email';");
        //print_r($email);
        header("location: appointment.php");
    }


?>