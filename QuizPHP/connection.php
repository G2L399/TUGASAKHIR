<?php
    $conn=mysqli_connect('localhost','root','','quiz');
    // check if error cant connect in database
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
?>