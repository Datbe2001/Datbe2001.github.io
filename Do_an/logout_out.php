<?php
        session_start();
        include 'config.php';
       if( isset($_POST['submit_logout'])){
            echo "<script language='javascript'>location.href='giaodien.php';";
            echo "</script>";
          }
          die();

?>