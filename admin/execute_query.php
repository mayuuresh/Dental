<?php
include("../connection.php");
if($_POST){
    if(isset($_POST["fileupload"])){
    $fileTmpPath = $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];
    $appnum=$_POST["appnum"];
    $folder = "../uploads/" . $fileName;

    

    $sql = "UPDATE appointment SET x_ray = '$fileName' WHERE appoid = $appnum";
    move_uploaded_file($fileTmpPath, $folder);
    $result=$database->query($sql);
    
    echo'<script>alert("File uploaded successfully")
    window.location.href = "http://localhost/DentalConnect/admin/appointment.php";
    </script>';
   
   
   
} else {
    echo'<script>alert("File is Not Uploaded successfully")
    window.location.href = "http://localhost/DentalConnect/admin/appointment.php";
    </script>';
}
}
?>