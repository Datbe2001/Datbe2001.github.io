<?php
    include 'config.php';
    if( isset($_POST['submit']))
    {
        $username = $_POST['username'];
        $username = trim(preg_replace('/\s+/',' ', $username));
        $email = $_POST['email'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];
        $level = 0;

        if($password!=$repassword){
            echo "<script language='javascript'>alert('Sai password xác nhận');";
            echo " location.href='giaodien.php';</script>";
            die();
        }

        $sql = "select * from user where username='$username' ";
        $old = mysqli_query($conn, $sql);
        $password = md5($password);

        if(mysqli_num_rows($old) > 0){
            echo "<script language='javascript'>alert('Tên người dùng đã tồn tại!');";
            echo " location.href='giaodien.php';</script>";
            die();
        }

        $sql = "insert into user (username, email, password, level) values('$username', '$email', '$password','$level')";
        mysqli_query($conn, $sql);

        $username = preg_replace('/\s+/', '', $username);
        $table = "create table $username (
            id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            Tenhienthi varchar(255),
            Ngaysinh date,
            Gioitinh varchar(255),
            Nghenghiep varchar(255),
            Kynangchuyenmon varchar(255),
            Anhdaidien varchar(255),
            Vetoi varchar(255),
            Sodienthoai varchar(255),
            Diachi varchar(255),
            Website varchar(255),
            Facebook varchar(255),
            Email varchar(255)
        )";
        mysqli_query($conn, $table);

        echo "<script language='javascript'>alert('Đã đăng ký thành công!');";
        echo " location.href='giaodien.php';</script>";
    }

    // if(isset($_POST['btnDangNhap'])){
    //     echo "<script language='javascript'>alert('Đăng ký không thành công!');";
    //     echo "alert('Bạn đã bấm nhầm vào Đăng Nhập');";
    //     echo " location.href='giaodien.php';</script>";
    // }

?>