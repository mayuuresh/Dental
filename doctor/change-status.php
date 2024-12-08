<!-- Write the change status code here -->
<?php
 session_start();

 if(isset($_SESSION["user"])){
     if(($_SESSION["user"])=="" or $_SESSION['usertype']!='d'){
         header("location: ../login.php");
     }

 }else{
     header("location: ../login.php");
 }


   if($_GET){
        //import database
        include("../connection.php");
         $id = $_GET['id'];
         $sql= $database->query("Update appointment set status='Done' where appoid='$id';");
         header("location: appointment.php");
    $conn->close();
}
?>