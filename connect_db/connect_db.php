<?php

    $hostname="localhost";
    $username="root";
    $password="";
    $dbname="admission_database";


    $con_db = mysqli_connect($hostname,$username,$password,$dbname);

    // if($con_db)
    // {
    //     echo "connection established";
    // }else
    // {
    //     echo "connection error".mysqli_error($con_db);
    // }


?>