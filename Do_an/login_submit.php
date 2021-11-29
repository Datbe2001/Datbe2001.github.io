<?php

    session_start();
    include 'config.php';

    if(isset($_POST['submit_login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $password = md5($password);

        $sql = "select * from user where username='$username' and password = '$password'";
        $user = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($user); // Kiểm tra có dữ liệu hay không

        // $sqll = "select id from user where username='$username' and password = '$password'";
        // $userr = mysqli_query($conn, $sqll);

        // if(mysqli_num_rows($userr) > 0){
        //     $roww = mysqli_fetch_assoc($userr);
        //     $_SESSION["id"] = $roww["id"];
        // }

        if(mysqli_num_rows($user) > 0){
            $_SESSION["username"] = $username;
            $_SESSION["level"] = $row["level"];
            $_SESSION["id"] = $roww["id"];
            echo "<script language='javascript'> alert('Đăng nhập thành công! Chúc bạn có trải nghiệm thật tốt');";
            echo " location.href='course.php';</script>";
            header("location:course.php");
            if($_SESSION["level"]==1){
                echo "<script language='javascript'>location.href='admin.php';";
                echo "</script>";
            }
            if($_SESSION["level"]==0){
                echo "<script language='javascript'>location.href='course.php';";
                echo "</script>";
            }
        }
        else{
            echo "<script language='javascript'>alert('Bạn đã nhập sai username or password');";
            echo " location.href='giaodien.php';</script>"; 
        }
    }


?>