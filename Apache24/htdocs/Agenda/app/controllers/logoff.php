<?php
session_name("Agenda");
session_start();

unset($_SESSION["login"]);
session_destroy();


{
   echo '<script>            
     window.location.href="index.html";
    </script>'; 
}

?>