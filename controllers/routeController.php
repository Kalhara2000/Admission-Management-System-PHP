<?php

if(isset($_GET['a']))
{
    if(file_exists(('page/'.$_GET['a'].".php")))
    {
        include('page/'.$_GET['a'].".php");
    }
    else
    {
        echo '<script>alert("Warning ! You are trying to violating our system.")</script>'; 
        var_dump($_SERVER);
    }
}
else
{
    include('page/home.php');
}


?>