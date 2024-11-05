<?php 
    if(isset($_COOKIE['cookie']) ){
        setcookie('cookie','',time()-3600);
        header("Location: index.php");
    }
?>

