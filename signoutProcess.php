<?php

session_start();

if(isset($_SESSION["u"])){ //u kiyla session ekk innawda balnwa
    $_SESSION["u"] = null; //innawa in eka null karnwa
    session_destroy(); //e session eka ain karnwa

    echo ("success");
}
?>