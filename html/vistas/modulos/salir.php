<?php

  $_SESSION = array();
  session_destroy();
  echo "<script> window.location = 'index.php?ruta=login'; </script>";
?>