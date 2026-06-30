<?php
session_name("painel");
session_start();

unset($_SESSION["login"]);
session_destroy();


{
   echo '<script>            
     window.location.href="http://localhost/painel";
    </script>'; 
}

?>