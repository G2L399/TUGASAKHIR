<?php 
    if($_GET['Name']){
        include "connection.php";
        $delete=mysqli_query($conn,"delete from images where Name='".$_GET['Name']."'");
        if($delete){
            echo "<script>alert('".$_GET['Name']." Deleted Successfully');location.href='play.php';</script>";
        } else {
            echo "<script>alert('Fail To Delete ".$_GET['Name']."');location.href='play.php';</script>";
        }
    }
?>
