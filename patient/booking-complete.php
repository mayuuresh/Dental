<?php

    //learn from w3schools.com

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
            header("location: ../login.php");
        }else{
            $useremail=$_SESSION["user"];
        }

    }else{
        header("location: ../login.php");
    }
    

    //import database
    include("../connection.php");
    $userrow = $database->query("select * from patient where pemail='$useremail'");
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["pid"];
    $username=$userfetch["pname"];
    use Twilio\Rest\Client;

    function sendsms($msg)
    {  
    require_once '../vendor/autoload.php';

    $sid    = "ACd7619e60b337bec70340130cc817bd3f";
    $token  = "a7ecc1e9edbeaeef40131dd895ba8c1d";
    $twilio = new Client($sid, $token);

    $message = $twilio->messages->create("+918767244196", array("from" => "+16502295899","body" => $msg));


    }

    if($_POST){
        if(isset($_POST["booknow"])){
            $apponum=$_POST["apponum"];
            $scheduleid=$_POST["scheduleid"];
            $date=$_POST["date"];
            $scheduleid=$_POST["scheduleid"];
            $filename = $_FILES["x_ray"]["name"];
            $tempname = $_FILES["x_ray"]["tmp_name"];
            $treatment=$_POST["treatment"];
            $emergency=$_POST["emergency"];
            $folder = "../uploads/" . $filename;

            $sql2="insert into appointment(pid,apponum,scheduleid,appodate,x_ray,treatment,emergency) values ($userid,$apponum,$scheduleid,'$date','$filename','$treatment','$emergency')";

            move_uploaded_file($tempname, $folder);
            $result= $database->query($sql2);
            $msg="Your appointment has been booked successfully. Your appointment number is ".$apponum." and the date is ".$date." . Thank you for choosing us.";
            sendsms($msg);
            echo'<script>console.log("Message sent successfully")</script>';
            //echo $apponom;
            header("location: appointment.php?action=booking-added&id=".$apponum."&titleget=none");

        }
    }
 ?>