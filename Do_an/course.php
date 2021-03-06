<?php 
    session_start();
   
    require("config.php");
    $sql = "select * from user";
    $result=mysqli_query($conn , $sql);
    $row = mysqli_fetch_assoc($result);
    if(!isset($_SESSION["username"])){
        header("location: giaodien.php");
    }
    if($_SESSION["level"]!=0){
        header("location: admin.php");
    }

    $username = $_SESSION["username"];
    $username = preg_replace('/\s+/', '', $username);
    $sqll = "select * from $username";
    $resultt=mysqli_query($conn , $sqll);
    $roww = mysqli_fetch_assoc($resultt);
    $users = mysqli_fetch_all($resultt, MYSQLI_ASSOC);
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="./ckeditor/ckeditor.js"></script>
    <meta charset="UTF-8">
    <script src="notification.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <script src="script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./css/coursr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">

</head>
<style>

</style>

<body>
        <div id="toast"></div>
    <div class="main">

        <!-- Start Header -->
        <div class="header scroll">
            <div class="header__img-logo">
                <img class="img-logo" src="https://www.howkteam.vn/Content/images/logo/kteam_w_70x32.png" alt="">
            </div>

            <div class="header__img-user" >          
                  <img width="30%"  class="img-user"  src="<?php  if(   mysqli_num_rows($resultt) > 0 ) {  echo './images/' . $roww['Anhdaidien'] ;} else{ echo "https://code.itptit.com/assets/images/avatar-none.jpeg";}?>">
                <p><?php   if(   mysqli_num_rows($resultt) > 0 ) {       echo $roww["Tenhienthi"];} else{   echo $_SESSION["username"];}     ?></p>
            </div>
            <ul id="nav">
                <li class="datngu" id="lichsu">
                    <i class="icon-clok far fa-clock"></i>
                    <a href="#">L???CH S???</a>
                </li>
                <li id="daluu">
                    <i class="icon-clok far fa-bookmark"></i>
                    <a href="#">???? L??U</a>
                </li>

                <div class="list-page">
                    <h1>PAGES</h1>
                </div>

                <li id="khoahoc">
                    <i class="icon-clok fas fa-book-open"></i>
                    <a href="#">KH??A H???C</a>
                </li>
                <li id="hoidap">
                    <i class="icon-clok far fa-question-circle"></i>
                    <a href="#">H???I ????P</a>
                </li>
                <li id="baiviet">
                    <i class="icon-clok far fa-file"></i>
                    <a href="#">B??I VI???T</a>
                </li>
                <li id="kter">
                    <i class="icon-clok fas fa-users"></i>
                    <a href="#">KTER</a>
                </li>
                <li id="kteam">
                    <i class="icon-clok fas fa-info-circle"></i>
                    <a href="#">V??? KTEAM</a>
                </li>
                <li id="taitro">
                    <i class="icon-clok fas fa-mug-hot"></i>
                    <a href="#">T??I TR???</a>
                </li>
                <li id="phanhoi">
                    <i class="icon-clok far fa-clipboard"></i>
                    <a href="#">PH???N H???I</a>
                </li>


            </ul>

        </div>
        <!-- Start Header -->

        <div class="container">
            <!-- Start header container -->
            <div class="header__container">
                <div class="header__container-icon">

                    <div class="icon-bars"><i class="icon fas fa-bars"></i></div>
                    <div class="list-icon">
                        <i class=" icon fas fa-search"></i>
                        <i class=" icon fas fa-pencil-alt"></i>
                        <i class=" icon far fa-bell"></i>
                        <div class="list-icon-user-menu">
                        <img width="30px" class="img-user" onclick="function_menu()" src="<?php  if(   mysqli_num_rows($resultt) > 0 ) {  echo './images/' . $roww['Anhdaidien'] ;} else{ echo "https://code.itptit.com/assets/images/avatar-none.jpeg";}?>" alt="???nh user">
                                    <div class="icon_noidung_menu_user" id="icon_noidung_menu_user">
                                                <a href="#" id="js-Thongtincanhan" > <i class="far fa-user" ></i> Th??ng tin c?? nh??n</a>
                                                <form class="logout__container"  action="logout_out.php" action="" method="POST">
                                                 <button name="submit_logout" class="submit_logout"> <i class="fas fa-sign-out-alt"></i> ????ng xu???t</button>
                                                </form>
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End header container -->
            
            <div class="body__container">
                <div class="top__container">
                    <h1>T???t c??? kh??a h???c</h1>
                    <p>H??ng tr??m kh??a h???c mi???n ph?? ???????c x??y d???ng b???i Kteam v?? c???ng ?????ng !</p>
                </div>

                <div class="mid__container">

                    <!-- Start mid container navbar -->
                    <div class="mid__container--navbar">

                        <div class="homepage">
                            <a href=""><i class=" fas fa-home"></i></a>
                            <i class=" icon__chevron-right fas fa-chevron-right"></i>
                            <span class="">Kh??a h???c</span>
                        </div>
                        <div class="input-group">
                            <input class="input" type="text" placeholder="T??m kh??a h???c...">
                            <div class="input-search">
                                <span   onclick="showErrorToast();">
                                    <i class="icon-search fas fa-search"></i>
                                </span>
                            </div>
                        </div>

                        <div class="content">
                            <div class="content__course">
                                <i class="icon-book fas fa-book-open"></i>
                                <span>Kh??a h???c</span>
                            </div>
                            <div class="content__button">
                                <button class="btn-course">
                                    Ch??? ?????
                                    <strong class="btn__number">8</strong>
                                    <i class="fas fa-angle-down"></i>
                                </button>
                                <button class="btn-course">
                                    Danh m???c
                                    <strong class="btn__number">0</strong>
                                    <i class="fas fa-angle-down"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- End mid container navbar -->

                    <!-- Start mid-container -->
                    <div class="mid__container--list-course">

                        <div class="item-course">
                            <div class="options">
                                <img src="https://f.howkteam.vn/Upload/cke/images/1_LOGO%20SHOW%20WEB/8_CTDL%26GT/Intro.jpg"
                                    alt="">
                                <div class="options__img">
                                    <div class="options__img-introduce options__img-introduce--icon-video">
                                        <i class="fas fa-video"></i>
                                        Gi???i thi???u
                                    </div>
                                    <button class="options__img-link js-btn-learn">
                                        <div class="options__img-introduce options__img-introduce--icon-play">
                                            <i class="far fa-play-circle"></i>
                                            H???c ngay
                                        </div>
                                    </button>
                                </div>

                            </div>
                            <div class="block-content">
                                <h4 title="C???u tr??c d??? li???u v?? gi???i thu???t">
                                    <a href="">C???u tr??c d??? li???u v?? gi???i thu???t</a>
                                </h4>
                                <div class="text-warning">
                                    <i class="icon-warning fas fa-star"></i>
                                    <i class="icon-warning fas fa-star"></i>
                                    <i class="icon-warning fas fa-star"></i>
                                    <i class="icon-warning fas fa-star"></i>
                                    <i class="icon-warning far fa-star"></i>
                                    <div class="text-muted">
                                        <p class="font">5.0</p>
                                        <p>(6)</p>
                                        <i class="icon-book far fa-bookmark"></i>
                                    </div>
                                </div>
                                <div class="badge">
                                    <span class="badge-pill">From Kteam</span>
                                </div>
                            </div>
                            <div class="block-content__view">
                                <div class="view">
                                    <i class="fas fa-book"></i>
                                    <strong>3</strong>
                                    b??i h???c
                                </div>
                                <div class="view">
                                    <i class="far fa-eye"></i>
                                    <strong>12.032</strong>
                                    l?????t xem
                                </div>
                            </div>
                            <div class="author">
                                <span>T??c gi???/D???ch gi???:</span>
                                <img class=" img-user img-user__author" src="font/img/datbe.jpg" alt="???nh user">
                            </div>
                        </div>
                        <div class="item-course">
                            <div class="options">
                                <img src="https://o.rada.vn/data/image/2019/12/23/khoa-hoc-Python.jpg" alt="">
                                <div class="options__img">
                                    <div class="options__img-introduce options__img-introduce--icon-video">
                                        <i class="fas fa-video"></i>
                                        Gi???i thi???u
                                    </div>
                                    <button class="options__img-link js-btn-learn">
                                        <div class="options__img-introduce options__img-introduce--icon-play">
                                            <i class="far fa-play-circle"></i>
                                            H???c ngay
                                        </div>
                                    </button>
                                </div>

                            </div>
                            <div class="block-content">
                                <h4 title="B??i t???p Python t??? luy???n">
                                    <a href="">B??i t???p Python t??? luy???n</a>
                                </h4>
                                <div class="text-warning">
                                    <i class="icon-warning fas fa-star"></i>
                                    <i class="icon-warning fas fa-star"></i>
                                    <i class="icon-warning fas fa-star"></i>
                                    <i class="icon-warning fas fa-star"></i>
                                    <i class="icon-warning far fa-star"></i>
                                    <div class="text-muted">
                                        <p class="font">5.0</p>
                                        <p>(271)</p>
                                        <i class="icon-book far fa-bookmark"></i>
                                    </div>
                                </div>
                                <div class="badge">
                                    <span class="badge-pill">From Kteam</span>
                                </div>
                            </div>
                            <div class="block-content__view">
                                <div class="view">
                                    <i class="fas fa-book"></i>
                                    <strong>123</strong>
                                    b??i h???c
                                </div>
                                <div class="view">
                                    <i class="far fa-eye"></i>
                                    <strong>1.236.032</strong>
                                    l?????t xem
                                </div>
                            </div>
                            <div class="author">
                                <span>T??c gi???/D???ch gi???:</span>
                                <img class=" img-user img-user__author" src="font/img/datbe.jpg" alt="???nh user">
                            </div>
                        </div>
                        <div class="item-course">
                            <div class="options">
                                <img src="https://codebugaz.files.wordpress.com/2019/12/learning-web-development-1024x582-1.jpg"
                                    alt="">
                                <div class="options__img">
                                    <div class="options__img-introduce options__img-introduce--icon-video">
                                        <i class="fas fa-video"></i>
                                        Gi???i thi???u
                                    </div>
                                    <button class="options__img-link js-btn-learn">
                                        <div class="options__img-introduce options__img-introduce--icon-play">
                                            <i class="far fa-play-circle"></i>
                                            H???c ngay
                                        </div>
                                    </button>
                                </div>

                            </div>
                            <div class="block-content">
                                <h4 title="L???p tr??nh Front End c?? b???n v???i website Landing Page">
                                    <a href="">L???p tr??nh Front End c?? b???n v???i website Landing Page</a>
                                </h4>
                                <div class="text-warning">
                                    <i class="icon-warning fas fa-star"></i>
                                    <i class="icon-warning fas fa-star"></i>
                                    <i class="icon-warning fas fa-star"></i>
                                    <i class="icon-warning fas fa-star"></i>
                                    <i class="icon-warning fas fa-star"></i>
                                    <div class="text-muted">
                                        <p class="font">5.0</p>
                                        <p>(271)</p>
                                        <i class="icon-book far fa-bookmark"></i>
                                    </div>
                                </div>
                                <div class="badge">
                                    <span class="badge-pill">From Kteam</span>
                                </div>
                            </div>
                            <div class="block-content__view">
                                <div class="view">
                                    <i class="fas fa-book"></i>
                                    <strong>5</strong>
                                    b??i h???c
                                </div>
                                <div class="view">
                                    <i class="far fa-eye"></i>
                                    <strong>236.032</strong>
                                    l?????t xem
                                </div>
                            </div>
                            <div class="author">
                                <span>T??c gi???/D???ch gi???:</span>
                                <img class=" img-user img-user__author" src="font/img/datbe.jpg" alt="???nh user">
                            </div>
                        </div>
                        <div class="item-course">
                            <div class="options">
                                <img src="https://saigonlab.edu.vn/upload/default/images/KHO%C3%81%20H%E1%BB%8CC%20CEH%20QR.jpg"
                                    alt="">
                                <div class="options__img">
                                    <div class="options__img-introduce options__img-introduce--icon-video">
                                        <i class="fas fa-video"></i>
                                        Gi???i thi???u
                                    </div>
                                    <button class="options__img-link js-btn-learn">
                                        <div class="options__img-introduce options__img-introduce--icon-play">
                                            <i class="far fa-play-circle"></i>
                                            H???c ngay
                                        </div>
                                    </button>
                                </div>

                            </div>
                            <div class="block-content">
                                <h4 title="Certified Ethical Hacker v10 Vietnamese">
                                    <a href="">Certified Ethical Hacker v10 Vietnamese</a>
                                </h4>
                                <div class="text-warning">
                                    <i class="icon-warning fas fa-star"></i>
                                    <i class="icon-warning fas fa-star"></i>
                                    <i class="icon-warning fas fa-star"></i>
                                    <i class="icon-warning fas fa-star"></i>
                                    <i class="icon-warning far fa-star"></i>
                                    <div class="text-muted">
                                        <p class="font">5.0</p>
                                        <p>(6)</p>
                                        <i class="icon-book far fa-bookmark"></i>
                                    </div>
                                </div>
                                <div class="badge">
                                    <span class="badge-pill">From Kteam</span>
                                </div>
                            </div>
                            <div class="block-content__view">
                                <div class="view">
                                    <i class="fas fa-book"></i>
                                    <strong>13</strong>
                                    b??i h???c
                                </div>
                                <div class="view">
                                    <i class="far fa-eye"></i>
                                    <strong>26.520</strong>
                                    l?????t xem
                                </div>
                            </div>
                            <div class="author">
                                <span>T??c gi???/D???ch gi???:</span>
                                <img class=" img-user img-user__author" src="font/img/datbe.jpg" alt="???nh user">
                            </div>
                        </div>
                    </div>
                    <!-- End mid-container -->

                    <!-- Start mid-container -->
                    <div class="mid__container--list-course">

                        <div class="item-course">
                            <div class="options">
                                <img src="https://thuthuat.taimienphi.vn/cf/Images/tm/2019/1/21/hoc-c.jpg" alt="">
                                <div class="options__img">
                                    <div class="options__img-introduce options__img-introduce--icon-video">
                                        <i class="fas fa-video"></i>
                                        Gi???i thi???u
                                    </div>
                                    <button class="options__img-link js-btn-learn">
                                        <div class="options__img-introduce options__img-introduce--icon-play">
                                            <i class="far fa-play-circle"></i>
                                            H???c ngay
                                        </div>
                                    </button>
                                </div>

                            </div>
                            <div class="block-content">
                                <h4 title="Kh??a h???c l???p tr??nh C++ c??n b???n">
                                    <a href="">Kh??a h???c l???p tr??nh C++ c??n b???n</a>
                                </h4>
                                <div class="text-warning">
                                    <i class="icon-warning fas fa-star"></i>
                                    <i class="icon-warning fas fa-star"></i>
                                    <i class="icon-warning fas fa-star"></i>
                                    <i class="icon-warning fas fa-star"></i>
                                    <i class="icon-warning far fa-star"></i>
                                    <div class="text-muted">
                                        <p class="font">5.0</p>
                                        <p>(106)</p>
                                        <i class="icon-book far fa-bookmark"></i>
                                    </div>
                                </div>
                                <div class="badge">
                                    <span class="badge-pill">From Kteam</span>
                                </div>
                            </div>
                            <div class="block-content__view">
                                <div class="view">
                                    <i class="fas fa-book"></i>
                                    <strong>30</strong>
                                    b??i h???c
                                </div>
                                <div class="view">
                                    <i class="far fa-eye"></i>
                                    <strong>1.652.032</strong>
                                    l?????t xem
                                </div>
                            </div>
                            <div class="author">
                                <span>T??c gi???/D???ch gi???:</span>
                                <img class=" img-user img-user__author" src="font/img/datbe.jpg" alt="???nh user">
                            </div>
                        </div>
                        <div class="item-course">
                            <div class="options">
                                <img src="https://cafedev.vn/wp-content/uploads/2020/11/cafedev_front_end_back_end_blog.png"
                                    alt="">
                                <div class="options__img">
                                    <div class="options__img-introduce options__img-introduce--icon-video">
                                        <i class="fas fa-video"></i>
                                        Gi???i thi???u
                                    </div>
                                    <button class="options__img-link js-btn-learn">
                                        <div class="options__img-introduce options__img-introduce--icon-play">
                                            <i class="far fa-play-circle"></i>
                                            H???c ngay
                                        </div>
                                    </button>
                                </div>

                            </div>
                            <div class="block-content">
                                <h4 title="L???p tr??nh Back End c?? b???n v???i website Landing Page">
                                    <a href="">L???p tr??nh Back End c?? b???n v???i website Landing Page</a>
                                </h4>
                                <div class="text-warning">
                                    <i class="icon-warning fas fa-star"></i>
                                    <i class="icon-warning fas fa-star"></i>
                                    <i class="icon-warning fas fa-star"></i>
                                    <i class="icon-warning fas fa-star"></i>
                                    <i class="icon-warning fas fa-star"></i>
                                    <div class="text-muted">
                                        <p class="font">5.0</p>
                                        <p>(271)</p>
                                        <i class="icon-book far fa-bookmark"></i>
                                    </div>
                                </div>
                                <div class="badge">
                                    <span class="badge-pill">From Kteam</span>
                                </div>
                            </div>
                            <div class="block-content__view">
                                <div class="view">
                                    <i class="fas fa-book"></i>
                                    <strong>5</strong>
                                    b??i h???c
                                </div>
                                <div class="view">
                                    <i class="far fa-eye"></i>
                                    <strong>236.032</strong>
                                    l?????t xem
                                </div>
                            </div>
                            <div class="author">
                                <span>T??c gi???/D???ch gi???:</span>
                                <img class=" img-user img-user__author" src="font/img/datbe.jpg" alt="???nh user">
                            </div>
                        </div>
                        <div class="item-course">
                            <div class="options">
                                <img src="https://nguyenvanhieu.vn/wp-content/uploads/2020/01/lap-trinh-java-1.jpg"
                                    alt="">
                                <div class="options__img">
                                    <div class="options__img-introduce options__img-introduce--icon-video">
                                        <i class="fas fa-video"></i>
                                        Gi???i thi???u
                                    </div>
                                    <button class="options__img-link js-btn-learn">
                                        <div class="options__img-introduce options__img-introduce--icon-play">
                                            <i class="far fa-play-circle"></i>
                                            H???c ngay
                                        </div>
                                    </button>
                                </div>

                            </div>
                            <div class="block-content">
                                <h4 title="L???p tr??nh Java c?? b???n ?????n h?????ng ?????i t?????ng">
                                    <a href="">L???p tr??nh Java c?? b???n ?????n h?????ng ?????i t?????ng</a>
                                </h4>
                                <div class="text-warning">
                                    <i class="icon-warning fas fa-star"></i>
                                    <i class="icon-warning fas fa-star"></i>
                                    <i class="icon-warning fas fa-star"></i>
                                    <i class="icon-warning fas fa-star"></i>
                                    <i class="icon-warning fas fa-star"></i>
                                    <div class="text-muted">
                                        <p class="font">5.0</p>
                                        <p>(350)</p>
                                        <i class="icon-book far fa-bookmark"></i>
                                    </div>
                                </div>
                                <div class="badge">
                                    <span class="badge-pill">From Kteam</span>
                                </div>
                            </div>
                            <div class="block-content__view">
                                <div class="view">
                                    <i class="fas fa-book"></i>
                                    <strong>105</strong>
                                    b??i h???c
                                </div>
                                <div class="view">
                                    <i class="far fa-eye"></i>
                                    <strong>2.630.032</strong>
                                    l?????t xem
                                </div>
                            </div>
                            <div class="author">
                                <span>T??c gi???/D???ch gi???:</span>
                                <img class=" img-user img-user__author" src="font/img/datbe.jpg" alt="???nh user">
                            </div>
                        </div>
                        <div class="item-course">
                            <div class="options">
                                <img src="https://antrandigital.com/wp-content/uploads/2020/07/share-khoa-hoc-javascript-antrandigital.jpg"
                                    alt="">
                                <div class="options__img">
                                    <div class="options__img-introduce options__img-introduce--icon-video">
                                        <i class="fas fa-video"></i>
                                        Gi???i thi???u
                                    </div>
                                    <button class="options__img-link js-btn-learn">
                                        <div class="options__img-introduce options__img-introduce--icon-play">
                                            <i class="far fa-play-circle"></i>
                                            H???c ngay
                                        </div>
                                    </button>
                                </div>

                            </div>
                            <div class="block-content">
                                <h4 title="S??? tay Javascrips">
                                    <a href="">S??? tay Javascrips</a>
                                </h4>
                                <div class="text-warning">
                                    <i class="icon-warning fas fa-star"></i>
                                    <i class="icon-warning fas fa-star"></i>
                                    <i class="icon-warning fas fa-star"></i>
                                    <i class="icon-warning fas fa-star"></i>
                                    <i class="icon-warning fas fa-star"></i>
                                    <div class="text-muted">
                                        <p class="font">5.0</p>
                                        <p>(9)</p>
                                        <i class="icon-book far fa-bookmark"></i>
                                    </div>
                                </div>
                                <div class="badge">
                                    <span class="badge-pill">From Kteam</span>
                                </div>
                            </div>
                            <div class="block-content__view">
                                <div class="view">
                                    <i class="fas fa-book"></i>
                                    <strong>8</strong>
                                    b??i h???c
                                </div>
                                <div class="view">
                                    <i class="far fa-eye"></i>
                                    <strong>60.032</strong>
                                    l?????t xem
                                </div>
                            </div>
                            <div class="author">
                                <span>T??c gi???/D???ch gi???:</span>
                                <img class=" img-user img-user__author" src="font/img/datbe.jpg" alt="???nh user">
                            </div>
                        </div>
                    </div>
                    <!-- End mid-container -->


                </div>
          
            </div>
            
           


            <div class="main__lichsu">
                <div class="history">
                    <div class="top__container--history">
                        <div class="heal1">
                            <h1><i class="fa fa-user-circle" aria-hidden="true"></i><sup><?php   if(   mysqli_num_rows($resultt) > 0 ) {       echo $roww["Tenhienthi"];} else{   echo $_SESSION["username"];}     ?></sup></h1>
        
                        </div>
                        <div>
                            <a href="#" class="btn "> <i class="fas fa-plus-circle"></i>
                                Vi???t b??i</a>
                        </div>
                    </div>
                    <div class="container_main">
                        <!-- menu-lichsu -->
                        <div class="t1">
                            <ul>
                                <li><a href="">Gi???i thi???u</a></li>
                                <li><a href="">Kh??a h???c</a></li>
                                <li><a href="">B??i h???c</a></li>
                                <li><a href="">Series</a></li>
                                <li><a href="">B??i vi???t</a></li>
                                <li><a href="">C??u h???i</a></li>
                                <li class="t1--lichsu"><a href="">L???ch s???</a></li>
                                <li><a href="">???? l??u</a></li>
                                <li><a href="">Th??ng b??o</a></li>
                                <li><a href="">C??i ?????t</a></li>
                            </ul>
                        </div>
                        <div style="clear: both;"></div>
                        <!-- radio-lichsu -->
                        <div class="container_main_mid-LS">
                            <div class="container_main_mid_left-LS">
                                <form>
                                    <p><i class="fa fa-filter" aria-hidden="true"></i> L???C THEO</p>
                                    <ul>
                                        <li><a href=""><input type="radio" name=""> T???t c???</a></li>
                                        <li><a href=""><input type="radio" name=""> Kh??a h???c</a></li>
                                        <li><a href=""><input type="radio" name=""> B??i h???c</a></li>
                                        <li><a href=""><input type="radio" name=""> B??i vi???t</a></li>
                                        <li><a href=""><input type="radio" name=""> C??u h???i</a></li>
                                        <li><a href=""><input type="radio" name=""> Series</a></li>
        
                                        <div>
                                            <li class="xoalichsu"><a class="a-xoals" href=""><i class="fa fa-trash"
                                                        aria-hidden="true"></i> X??a l???ch s???</a></li>
                                        </div>
                                    </ul>
                                </form>
                            </div>
        
                            <div class="container_main_mid_right-LS">
                                <p>L???CH S??? XEM</p> <br>
                                <h5>Kh??ng c?? l???ch s??? g???n ????y.</h5>
                            </div>
                        </div>
        
                    </div>
                </div>
            </div>
            <div class="main__daluu">
                <div class="history">
                    <div class="top__container--history">
                        <div class="heal1">
                            <h1><i class="fa fa-user-circle" aria-hidden="true"></i><sup><?php   if(   mysqli_num_rows($resultt) > 0 ) {       echo $roww["Tenhienthi"];} else{   echo $_SESSION["username"];}     ?></sup></h1>
        
                        </div>
                        <div>
                            <a href="#" class="btn "> <i class="fas fa-plus-circle"></i>
                                Vi???t b??i</a>
                        </div>
                    </div>
                    <div class="container_main">
                        <!-- menu-lichsu -->
                        <div class="t1">
                            <ul>
                                <li><a href="">Gi???i thi???u</a></li>
                                <li><a href="">Kh??a h???c</a></li>
                                <li><a href="">B??i h???c</a></li>
                                <li><a href="">Series</a></li>
                                <li><a href="">B??i vi???t</a></li>
                                <li><a href="">C??u h???i</a></li>
                                <li><a href="">L???ch s???</a></li>
                                <li class="t1--daluu"><a href="">???? l??u</a></li>
                                <li><a href="">Th??ng b??o</a></li>
                                <li><a href="">C??i ?????t</a></li>
                            </ul>
                        </div>
                        <div style="clear: both;"></div>
                        <!-- radio-lichsu -->
                        <div class="container_main_mid-LS">
                            <div class="container_main_mid_left-LS">
                                <form>
                                    <p><i class="fa fa-filter" aria-hidden="true"></i> L???C THEO</p>
                                    <ul>
                                        <li><a href=""><input type="radio" name=""> T???t c???</a></li>
                                        <li><a href=""><input type="radio" name=""> Kh??a h???c</a></li>
                                        <li><a href=""><input type="radio" name=""> B??i h???c</a></li>
                                        <li><a href=""><input type="radio" name=""> B??i vi???t</a></li>
                                        <li><a href=""><input type="radio" name=""> C??u h???i</a></li>
                                        <li><a href=""><input type="radio" name=""> Series</a></li>
        
                                        <div>
                                            <li class="xoalichsu"><a class="a-xoals" href=""><i class="fa fa-trash"
                                                        aria-hidden="true"></i> X??a l???ch s???</a></li>
                                        </div>
                                    </ul>
                                </form>
                            </div>
        
                            <div class="container_main_mid_right-LS">
                                <p>M???C ???? L??U</p> <br>
                                <h5>Kh??ng c?? m???c ???? l??u</h5>
                            </div>
                        </div>
        
                    </div>
                </div>
            </div>

            

            <div class="main__hoidap">
                    <div class="hoidap">
                            <div class="hoidap_top__container">
                                <div class="heal1">
                                    <h1> H???i ????p</h1>
                                <p>Chia s??? ki???n th???c, c??ng nhau ph??t tri???n</p>
                                </div>
                                <div >
                                    <a href="#" class="btn "> <i class="fas fa-plus-circle" style="background-image: linear-gradient(to right,rgb(82, 85, 238),rgb(142, 169, 243));"></i>  Vi???t b??i</a>
                                </div>
                            </div>

           
                            <div class="hoidap_container_main">
                                <div class="hoidap_t1">
                                    <i class="fas fa-home" style="color: rgb(17, 0, 253);"> </i>
                                    <span class="breadcrumb-item active"> >  H???i ????p</span>
                                </div>

                                
                                <div class="hoidap_mid__container">
                                    <div class="hoidap_mid_container_mid">
                                        <div class="hoidap_mid__container_menu">
                                            <div class="hoidap_menu123">
                                                <ul>
                                                    <li class="js-tab"><a href="">T???t c???</a></li>
                                                    <li class="js-tab"><a href="">Quan t??m</a></li>
                                                    <li class="js-tab"><a href="">C??u h???i c???a t??i</a></li>
                                                    <li>
                                                        <div class="hoidap_dropdown">
                                                            <button class="hoidap_nut_dropdown"><a href="" style="color: rgb(255, 30, 0);"><span style="color: black;">S???p x???p: </span> M???i nh???t</a></button>
                                                            <div class="hoidap_noidung_dropdown">
                                                                <a href="#">M???i nh???t</a>
                                                            <a href="#">Ho???t ?????ng</a>
                                                            <a href="#">L?????t xem</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            
                                        
                                        </div>

                                        <div class="hoidap_block ">
                                            <div class="hoidap_block-content block-content-full ">
                                                <a href="#">
                                                    <div class="hoidap_media">
                                                        <div class="hoidap_media-left pr-20">
                                                            <img class="img-user " src="https://lh3.googleusercontent.com/gu8rtRBOuihUcDxhm2zgZk9fyXZwqUdxHm39rF9Gt7twlv51kQ218sdM41BMbd1BsTFTlvVUgDZZuzHf=s275-rw">
                                                        </div>
                                                        <div class="media-body">
                                                            <div class="font-size  " style="color: #6c757d; font-weight: 700; ">Thanh Tien</div>
                                                            <div class=" border ">
                                                                <div class="b1"  onclick="showErrorToast();">
                                                                    <span class="text-secondary font-w600"  >T???o c??u h???i c???a b???n</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        
                                        <div class="block " style="margin-top: 10px;">
                                            <div class="hoidap_block-content  block-content-full ">
                                                <div class="hoidap_votes">
                                                    <div class="votes-num">
                                                        <div class="mini-counts" style="color: #5eba7d;">
                                                            <span>7</span>
                                                            <i class="fas fa-caret-up fa-fw d-inline-block d-sm-none mr-5"></i>
                                                        </div>
                                                        <div class="mini-counts">
                                                            <span>0</span>
                                                            <i class="fas fa-caret-down fa-fw d-inline-block d-sm-none mr-5"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="hoidap_answer">
                                                    <div class="mini-counts">
                                                        <span>3</span>
                                                    </div>
                                                    <span>tr??? l???i</span>
                                                </div>
                                                <div class="hoidap_view" style="color: #ef5350;">
                                                    <div class="mini-counts">
                                                        <span>20</span>
                                                    </div>
                                                    <span>l?????t xem</span>
                                                </div>
                                                <div class="summary">
                                                    <a href="#">
                                                        <h4 class="summary-title">
                                                            <span class="mark-lookup">Convert Base</span>
                                                        </h4>
                                                    </a>
                                                    <div class="summary-tag">
                                                        <a href="#" class="hoidap_post-tag">java</a>
                                                        <a href="#" class="hoidap_post-tag">numberformatexception</a>
                                                        <a href="#" class="hoidap_post-tag">typeconverter</a>
                    
                                                    </div>
                                                    <div class="summary-text">
                                                        <span>
                                                            <a href="#" class="summary-user">
                                                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                                                                <span style="color: #2e69ff;">Supporter</span>
                                                            </a>
                                                            <p style="color: #707070;">???? hi???u ch???nh<span style="font-style: italic; font-weight: bold;"> kho???ng 3 gi??? tr?????c</span></p>
                                                            
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="block " style="margin-top: 10px;">
                                            <div class="hoidap_block-content  block-content-full ">
                                                <div class="hoidap_votes">
                                                    <div class="votes-num">
                                                        <div class="mini-counts" style="color: #5eba7d;">
                                                            <span>8</span>
                                                            <i class="fas fa-caret-up fa-fw d-inline-block d-sm-none mr-5"></i>
                                                        </div>
                                                        <div class="mini-counts">
                                                            <span>1</span>
                                                            <i class="fas fa-caret-down fa-fw d-inline-block d-sm-none mr-5"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="hoidap_answer">
                                                    <div class="mini-counts">
                                                        <span>23</span>
                                                    </div>
                                                    <span>tr??? l???i</span>
                                                </div>
                                                <div class="hoidap_view" style="color: #ef5350;">
                                                    <div class="mini-counts">
                                                        <span>40</span>
                                                    </div>
                                                    <span>l?????t xem</span>
                                                </div>
                                                <div class="summary">
                                                    <a href="#">
                                                        <h4 class="summary-title">
                                                            <span class="mark-lookup">L??m sao ????? open command window here tr??n win 11 v???y mn ?</span>
                                                        </h4>
                                                    </a>
                                                    <div class="summary-tag">
                                                        <a href="#" class="hoidap_post-tag">c#</a>
                                                    </div>
                                                    <div class="summary-text">
                                                        <span>
                                                            <a href="#" class="summary-user">
                                                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                                                                <span style="color: #2e69ff;">L?? H?? Gia Kh??i</span>
                                                            </a>
                                                            <p style="color: #707070;">???? hi???u ch???nh<span style="font-style: italic; font-weight: bold;"> kho???ng 5 gi??? tr?????c</span></p>
                                                            
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="block " style="margin-top: 10px;">
                                            <div class="hoidap_block-content  block-content-full ">
                                                <div class="hoidap_votes">
                                                    <div class="votes-num">
                                                        <div class="mini-counts" style="color: #5eba7d;">
                                                            <span>23</span>
                                                            <i class="fas fa-caret-up fa-fw d-inline-block d-sm-none mr-5"></i>
                                                        </div>
                                                        <div class="mini-counts">
                                                            <span>0</span>
                                                            <i class="fas fa-caret-down fa-fw d-inline-block d-sm-none mr-5"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="hoidap_answer">
                                                    <div class="mini-counts">
                                                        <span>46</span>
                                                    </div>
                                                    <span>tr??? l???i</span>
                                                </div>
                                                <div class="hoidap_view" style="color: #ef5350;">
                                                    <div class="mini-counts">
                                                        <span>67</span>
                                                    </div>
                                                    <span>l?????t xem</span>
                                                </div>
                                                <div class="summary">
                                                    <a href="#">
                                                        <h4 class="summary-title">
                                                            <span class="mark-lookup">c??i ?????t SQL Prompt (SQL Toolbelt)</span>
                                                        </h4>
                                                    </a>
                                                    <div class="summary-tag">
                                                        <a href="#" class="hoidap_post-tag">sql-sever</a>
                    
                                                    </div>
                                                    <div class="summary-text">
                                                        <span>
                                                            <a href="#" class="summary-user">
                                                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                                                                <span style="color: #2e69ff;">Nguy???n Thanh Ti???n</span>
                                                            </a>
                                                            <p style="color: #707070;">???? hi???u ch???nh<span style="font-style: italic; font-weight: bold;"> kho???ng 12 gi??? tr?????c</span></p>
                                                            
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <div class="block " style="margin-top: 10px;">
                                            <div class="hoidap_block-content block-content-full ">
                                                <div class="hoidap_votes">
                                                    <div class="votes-num">
                                                        <div class="mini-counts" style="color: #5eba7d;">
                                                            <span>14</span>
                                                            <i class="fas fa-caret-up fa-fw d-inline-block d-sm-none mr-5"></i>
                                                        </div>
                                                        <div class="mini-counts">
                                                            <span>5</span>
                                                            <i class="fas fa-caret-down fa-fw d-inline-block d-sm-none mr-5"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="hoidap_answer">
                                                    <div class="mini-counts">
                                                        <span>35</span>
                                                    </div>
                                                    <span>tr??? l???i</span>
                                                </div>
                                                <div class="hoidap_view" style="color: #ef5350;">
                                                    <div class="mini-counts">
                                                        <span>56</span>
                                                    </div>
                                                    <span>l?????t xem</span>
                                                </div>
                                                <div class="summary">
                                                    <a href="#">
                                                        <h4 class="summary-title">
                                                            <span class="mark-lookup">mod game java</span>
                                                        </h4>
                                                    </a>
                                                    <div class="summary-tag">
                                                        <a href="#" class="hoidap_post-tag">java</a>
                    
                                                    </div>
                                                    <div class="summary-text">
                                                        <span>
                                                            <a href="#" class="summary-user">
                                                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                                                                <span style="color: #2e69ff;">Tr???n V??n ?????t</span>
                                                            </a>
                                                            <p style="color: #707070;">???? hi???u ch???nh<span style="font-style: italic; font-weight: bold;"> kho???ng 22 gi??? tr?????c</span></p>
                                                            
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="block " style="margin-top: 10px;">
                                            <div class="hoidap_block-content block-content-full ">
                                                <div class="hoidap_votes">
                                                    <div class="votes-num">
                                                        <div class="mini-counts" style="color: #5eba7d;">
                                                            <span>47</span>
                                                            <i class="fas fa-caret-up fa-fw d-inline-block d-sm-none mr-5"></i>
                                                        </div>
                                                        <div class="mini-counts">
                                                            <span>2</span>
                                                            <i class="fas fa-caret-down fa-fw d-inline-block d-sm-none mr-5"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="hoidap_answer">
                                                    <div class="mini-counts">
                                                        <span>73</span>
                                                    </div>
                                                    <span>tr??? l???i</span>
                                                </div>
                                                <div class="hoidap_view" style="color: #ef5350;">
                                                    <div class="mini-counts">
                                                        <span>152</span>
                                                    </div>
                                                    <span>l?????t xem</span>
                                                </div>
                                                <div class="summary">
                                                    <a href="#">
                                                        <h4 class="summary-title">
                                                            <span class="mark-lookup">L??n h???c g?? ????? thu???n ti???n v?? gi???m thi???u th???i gian</span>
                                                        </h4>
                                                    </a>
                                                    <div class="summary-tag">
                                                        <a href="#" class="hoidap_post-tag">javascrips</a>
                                                        <a href="#" class="hoidap_post-tag">python</a>
                                                        <a href="#" class="hoidap_post-tag">c#</a>
                    
                                                    </div>
                                                    <div class="summary-text">
                                                        <span>
                                                            <a href="#" class="summary-user">
                                                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                                                                <span style="color: #2e69ff;">????? V???n L??m</span>
                                                            </a>
                                                            <p style="color: #707070;">???? hi???u ch???nh<span style="font-style: italic; font-weight: bold;"> kho???ng 1 ng??y tr?????c</span></p>
                                                            
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="block " style="margin-top: 10px;">
                                            <div class="hoidap_block-content block-content-full ">
                                                <div class="hoidap_votes">
                                                    <div class="votes-num">
                                                        <div class="mini-counts" style="color: #5eba7d;">
                                                            <span>5</span>
                                                            <i class="fas fa-caret-up fa-fw d-inline-block d-sm-none mr-5"></i>
                                                        </div>
                                                        <div class="mini-counts">
                                                            <span>0</span>
                                                            <i class="fas fa-caret-down fa-fw d-inline-block d-sm-none mr-5"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="hoidap_answer">
                                                    <div class="mini-counts">
                                                        <span>12</span>
                                                    </div>
                                                    <span>tr??? l???i</span>
                                                </div>
                                                <div class="hoidap_view" style="color: #ef5350;">
                                                    <div class="mini-counts">
                                                        <span>30</span>
                                                    </div>
                                                    <span>l?????t xem</span>
                                                </div>
                                                <div class="hoidap_summary">
                                                    <a href="#">
                                                        <h4 class="summary-title">
                                                            <span class="mark-lookup">Unable to find python module</span>
                                                        </h4>
                                                    </a>
                                                    <div class="summary-tag">
                                                        <a href="#" class="hoidap_post-tag">python</a>
                    
                                                    </div>
                                                    <div class="summary-text">
                                                        <span>
                                                            <a href="#" class="summary-user">
                                                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                                                                <span style="color: #2e69ff;">C?? h???i hoang</span>
                                                            </a>
                                                            <p style="color: #707070;">???? hi???u ch???nh<span style="font-style: italic; font-weight: bold;"> kho???ng 1 ng??y tr?????c</span></p>
                                                            
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    

                                
                                    
                                    <div class="hoidap_mid_container_right">
                                        <div class="hoidap_tag">TAG PH??? BI???N</div>
                                            <ul class="hoidap_menu3">
                                                <li><a href="#">C#</a>  x  <small>30</small></li>
                                                <li> <a href="#">Javascrips</a> x  <small>30</small> </li>
                                                <li> <a href="#"> java</a> x  <small>30</small></li>
                                                <li> <a href="#">HTML</a>  x  <small>30</small></li>
                                                <li>  <a href="#">Python</a> x  <small>30</small></li>
                                                <li><a href="#">adroid</a> x  <small>30</small></li>
                                                <li> <a href="#">non-english</a> x  <small>30</small> </li>
                                                <li> <a href="#">php</a> x  <small>30</small></li>
                                                <li>  <a href="#">css</a> x <small>30</small></li>
                                                <div>
                                                    <a href="#" style="color: rgb(201, 32, 32) ; text-decoration: none; " > xem th??m...</a>
                                                </div>
                                            </ul>   
                                            <div class="hoidap_mid_container_right2">
                                                <div class="hoidap_tag2">C??u h???i m???i nh???t</div>
                                                <ul class="hoidap_question">

                                                        <li>
                                                            <a href="#">H???i v??? c??ch l???y tu???n hi???n t???i trong php</a>
                                                            <div class="mb-5 hoidap_text-muted font-size-xs">
                                                                <span class="mr-10" title="B??nh ch???n l??n">
                                                                    <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="B??nh ch???n xu???ng">
                                                                    <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="C??u tr??? l???i">
                                                                    <i class="fas fa-fw fa-reply fa-fw"></i>
                                                                    <span>1</span>
                                                                </span>
                                                                <span class="mr-10" title="L?????t xem">
                                                                    <i class="far fa-fw fa-eye fa-fw"></i>
                                                                    <span>25</span>
                                                                </span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <a href="#">Ch???n h??ng trong DataGridview</a>
                                                            <div class="mb-5 hoidap_text-muted font-size-xs">
                                                                <span class="mr-10" title="B??nh ch???n l??n">
                                                                    <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="B??nh ch???n xu???ng">
                                                                    <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="C??u tr??? l???i">
                                                                    <i class="fas fa-fw fa-reply fa-fw"></i>
                                                                    <span>1</span>
                                                                </span>
                                                                <span class="mr-10" title="L?????t xem">
                                                                    <i class="far fa-fw fa-eye fa-fw"></i>
                                                                    <span>25</span>
                                                                </span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <a href="#">Truy???n tham s??? qua c??c l???p viewmodel</a>
                                                            <div class="mb-5 hoidap_text-muted font-size-xs">
                                                                <span class="mr-10" title="B??nh ch???n l??n">
                                                                    <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="B??nh ch???n xu???ng">
                                                                    <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="C??u tr??? l???i">
                                                                    <i class="fas fa-fw fa-reply fa-fw"></i>
                                                                    <span>1</span>
                                                                </span>
                                                                <span class="mr-10" title="L?????t xem">
                                                                    <i class="far fa-fw fa-eye fa-fw"></i>
                                                                    <span>25</span>
                                                                </span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <a href="#">game caro</a>
                                                            <div class="mb-5 hoidap_text-muted font-size-xs">
                                                                <span class="mr-10" title="B??nh ch???n l??n">
                                                                    <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="B??nh ch???n xu???ng">
                                                                    <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="C??u tr??? l???i">
                                                                    <i class="fas fa-fw fa-reply fa-fw"></i>
                                                                    <span>1</span>
                                                                </span>
                                                                <span class="mr-10" title="L?????t xem">
                                                                    <i class="far fa-fw fa-eye fa-fw"></i>
                                                                    <span>25</span>
                                                                </span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <a href="#">Undo</a>
                                                            <div class="mb-5 hoidap_text-muted font-size-xs">
                                                                <span class="mr-10" title="B??nh ch???n l??n">
                                                                    <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="B??nh ch???n xu???ng">
                                                                    <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="C??u tr??? l???i">
                                                                    <i class="fas fa-fw fa-reply fa-fw"></i>
                                                                    <span>1</span>
                                                                </span>
                                                                <span class="mr-10" title="L?????t xem">
                                                                    <i class="far fa-fw fa-eye fa-fw"></i>
                                                                    <span>25</span>
                                                                </span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <a href="#">G???p v???n ????? trong qu?? tr??nh add Lib</a>
                                                            <div class="mb-5 hoidap_text-muted font-size-xs">
                                                                <span class="mr-10" title="B??nh ch???n l??n">
                                                                    <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="B??nh ch???n xu???ng">
                                                                    <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="C??u tr??? l???i">
                                                                    <i class="fas fa-fw fa-reply fa-fw"></i>
                                                                    <span>1</span>
                                                                </span>
                                                                <span class="mr-10" title="L?????t xem">
                                                                    <i class="far fa-fw fa-eye fa-fw"></i>
                                                                    <span>25</span>
                                                                </span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <a href="#">H?????ng d???n c??i visual studio code</a>
                                                            <div class="mb-5 hoidap_text-muted font-size-xs">
                                                                <span class="mr-10" title="B??nh ch???n l??n">
                                                                    <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="B??nh ch???n xu???ng">
                                                                    <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="C??u tr??? l???i">
                                                                    <i class="fas fa-fw fa-reply fa-fw"></i>
                                                                    <span>1</span>
                                                                </span>
                                                                <span class="mr-10" title="L?????t xem">
                                                                    <i class="far fa-fw fa-eye fa-fw"></i>
                                                                    <span>25</span>
                                                                </span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <a href="#">C??c th??? c?? b???n trong HTML</a>
                                                            <div class="mb-5 hoidap_text-muted font-size-xs">
                                                                <span class="mr-10" title="B??nh ch???n l??n">
                                                                    <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="B??nh ch???n xu???ng">
                                                                    <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="C??u tr??? l???i">
                                                                    <i class="fas fa-fw fa-reply fa-fw"></i>
                                                                    <span>1</span>
                                                                </span>
                                                                <span class="mr-10" title="L?????t xem">
                                                                    <i class="far fa-fw fa-eye fa-fw"></i>
                                                                    <span>25</span>
                                                                </span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <a href="#">1. Vi???t ch????ng tr??nh nh???p v??o d??y n ph???n t??? v?? in ra c??c ph???n t??? theo th??? t??? ng?????c l???i qu?? tr??nh nh???p. S??? nh???p ?????u ti??n s??? in ra sau c??ng.</a>
                                                            <div class="mb-5 hoidap_text-muted font-size-xs">
                                                                <span class="mr-10" title="B??nh ch???n l??n">
                                                                    <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="B??nh ch???n xu???ng">
                                                                    <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="C??u tr??? l???i">
                                                                    <i class="fas fa-fw fa-reply fa-fw"></i>
                                                                    <span>1</span>
                                                                </span>
                                                                <span class="mr-10" title="L?????t xem">
                                                                    <i class="far fa-fw fa-eye fa-fw"></i>
                                                                    <span>25</span>
                                                                </span>
                                                            </div>
                                                        </li>
                                                </ul>
                                            </div>
                                            
                                    </div>
                                    
                                
                                </div>  
                                    
                            </div>
                    </div>
            </div>

            <div class="main__baiviet">
                <div class="baiviet">
                    <div class="baiviet_top__container">
                        <div class="heal1">
                            <h1> B??i vi???t</h1>
                           <p>Kho t??i li???u v?? b??i vi???t ???????c chia s???, ????nh gi?? b???i c???ng ?????ng</p>
                        </div>
                        <div >
                            <a href="#" class="btn "> <i class="fas fa-plus-circle" style="background-image: linear-gradient(to right,rgb(82, 85, 238),rgb(142, 169, 243));"></i>  Vi???t b??i</a>
                        </div>
                    </div>
                    <div class="baiviet_container_main">
                        <div class="baiviet_t1">
                            <i class="fas fa-home" style="color: rgb(17, 0, 253);"> </i>
                            <span class="breadcrumb-item active"> >  B??i vi???t</span>
                        </div>
        
                        
                        <div class="baiviet_mid__container">
                            <div class="baiviet_mid_container_mid">
                                <div class="baiviet_mid__container_menu">
                                    <div class="baiviet_menu123">
                                        <ul>
                                            <li class="js-tab"><a href="">B??i vi???t</a></li>
                                            <li class="js-tab"><a href="">Series</a></li>
                                            <li class="js-tab"><a href="">B??i vi???t c???a t??i</a></li>
                                            <li><a href="">B???n nh??p</a></li>
                                            <li>
                                                <div class="dropdown">
                                                    <button class="baiviet_nut_dropdown"><a href="" style="color: rgb(255, 30, 0);"><span style="color: black;">S???p x???p: </span> M???i nh???t</a></button>
                                                    <div class="baiviet_noidung_dropdown">
                                                        <a href="#">M???i nh???t</a>
                                                      <a href="#">Ho???t ?????ng</a>
                                                      <a href="#">L?????t xem</a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- <div class="select">
                                            <form action="">
                                                  S???p x???p:   <select name="sapxep" id="">
                                                                <option value="M???i nh???t">M???i nh???t</option>
                                                                <option value="Ho???t ?????ng">Ho???t ?????ng</option>
                                                                <option value="L?????t xem">L?????t xem</option> </select>
                                            </form>
                                    </div> -->
                                   
                                </div>
        
                                <div class="block ">
                                    <div class="block-content block-content-full ">
                                        <a href="#">
                                            <div class="media">
                                                <div class="media-left pr-20">
                                                    <img class="img-user " src="https://lh3.googleusercontent.com/gu8rtRBOuihUcDxhm2zgZk9fyXZwqUdxHm39rF9Gt7twlv51kQ218sdM41BMbd1BsTFTlvVUgDZZuzHf=s275-rw">
                                                </div>
                                                <div class="media-body">
                                                    <div class="font-size  ">Thanh Tien</div>
                                                    <div class=" border "">
                                                        <div class="b1"   onclick="showErrorToast();">
                                                            <span  class="text-secondary font-w600">Chia s??? b??i vi???t, t??i li???u, ...</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
        
                                <div class="block " style="margin-top: 10px;">
                                    <div class="block-content block-content-full ">
                                        <a href="#">
                                            <div class="media">
                                                <div class="media-left pr-20">
                                                    <img class="img-user " src="https://scontent.fsgn2-5.fna.fbcdn.net/v/t1.6435-9/45288287_330554540857063_7698190104497487872_n.jpg?_nc_cat=102&ccb=1-5&_nc_sid=09cbfe&_nc_ohc=SNktgMCklH4AX__u8Cl&tn=Yte4O01X9Gg_UDxS&_nc_ht=scontent.fsgn2-5.fna&oh=ecc5591f2e243d00e0e245248db9ff87&oe=61B9D1D7">
                                                </div>
                                                <div class="media-body">
                                                    <div class="font-size  "> <span style="color: blue;" >Gia Khoi</span>
                                                        <a href="#" >
                                                            <h4 class="h5  mr-5 d-inline-block">
                                                                <span class="mark-lookup">
                                                                    ?????T T??N CHO "EM"</span> 
                                                            </h4>
                                                        </a>  
                                                        <a  href="#">C#</a> 
                                                        <a  href="#">C++</a>
                                                        <a  href="#">python</a>
                                                    </div>
                                                    
                                                    <div class=" border "">
                                                        <div class="b">
                                                            <a href="#">
                                                                <p >  
                                                                    Gi???i thi???u T??n xu???t hi???n ??? t???t c??? m???i n??i trong 1 ch????ng tr??nh. Ch??ng ta ?????t t??n cho Bi???n, H??m, ?????i s???, Class, Packages??? v??n v??n v?? m??y m??y, do ???? ch??ng ta n??n ?????t t??n theo nh???ng nguy??n t???c sau ????y...
                                                                .</p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-5 text-muted font-size-xs">
                                                        <span class="mr-10" title="B??nh ch???n l??n">
                                                            <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="B??nh ch???n xu???ng">
                                                            <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="C??u tr??? l???i">
                                                            <i class="fas fa-fw fa-reply fa-fw"></i>
                                                            <span>1</span>
                                                        </span>
                                                        <span class="mr-10" title="L?????t xem">
                                                            <i class="far fa-fw fa-eye fa-fw"></i>
                                                            <span>25</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
        
                                <div class="block " style="margin-top: 10px;">
                                    <div class="block-content block-content-full ">
                                        <a href="#">
                                            <div class="media">
                                                <div class="media-left pr-20">
                                                    <img class="img-user " src="https://scontent.fsgn2-5.fna.fbcdn.net/v/t1.6435-9/68952602_209230070064432_1628113026924150784_n.jpg?_nc_cat=102&ccb=1-5&_nc_sid=174925&_nc_ohc=RfxBZC7kjP8AX9PYFJ_&_nc_ht=scontent.fsgn2-5.fna&oh=cb6eecb7f9bd5083cf22add03685e664&oe=61BB5B04">
                                                </div>
                                                <div class="media-body">
                                                    <div class="font-size  "> <span style="color: blue;" >?????t b??</span>
                                                        <a href="#" >
                                                            <h4 class="h5  mr-5 d-inline-block">
                                                                <span class="mark-lookup">
                                                                    K??? thu???t s??? d???ng Dependency Injection trong Winform project - Winform never die</span> 
                                                            </h4>
                                                        </a>  
                                                        <a  href="#">C#</a> 
                                                    </div>
                                                    
                                                    <div class=" border "">
                                                        <div class="b">
                                                            <a href="#">
                                                                <p >  
                                                                    D???N NH???P Tr?????c khi ??i v??o code m???u c???a DI trong Winform m??nh c??ng t??m hi???u xem DI l?? g?? v?? v?? sao c??c l???p tr??nh vi??n l???i ??am m?? ?????n th???.  ?????nh ngh??a c?? th??? s??? g??y kh?? hi???u, v?? th???c s??? c??ng ch??a bi???t...
                                                                </p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-5 text-muted font-size-xs">
                                                        <span class="mr-10" title="B??nh ch???n l??n">
                                                            <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="B??nh ch???n xu???ng">
                                                            <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="C??u tr??? l???i">
                                                            <i class="fas fa-fw fa-reply fa-fw"></i>
                                                            <span>1</span>
                                                        </span>
                                                        <span class="mr-10" title="L?????t xem">
                                                            <i class="far fa-fw fa-eye fa-fw"></i>
                                                            <span>25</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
        
                                <div class="block " style="margin-top: 10px;">
                                    <div class="block-content block-content-full ">
                                        <a href="#">
                                            <div class="media">
                                                <div class="media-left pr-20">
                                                    <img class="img-user " src="https://scontent.fsgn2-3.fna.fbcdn.net/v/t1.6435-9/53830229_421577151927784_8157428469010006016_n.jpg?_nc_cat=108&ccb=1-5&_nc_sid=174925&_nc_ohc=kLqm_msB_ecAX8_XGa1&_nc_ht=scontent.fsgn2-3.fna&oh=273e531a6cd8c3e184668794a4fa068b&oe=61BAFAC7">
                                                </div>
                                                <div class="media-body">
                                                    <div class="font-size  "> <span style="color: blue;" > V???n L??m</span>
                                                        <a href="#" >
                                                            <h4 class="h5  mr-5 d-inline-block">
                                                                <span class="mark-lookup">
                                                                    Laravel 9 c?? g?? m???i ?</span> 
                                                            </h4>
                                                        </a>  
                                                        <a  href="#">php-8</a> 
                                                        <a  href="#">Laravel</a>
                                                        <a  href="#">Laravel-9</a>
                                                    </div>
                                                    
                                                    <div class=" border "">
                                                        <div class="b">
                                                            <a href="#">
                                                                <p >  
                                                                    Laravel v9 s??? l?? phi??n b???n LTS ti???p theo c???a Laravel, v?? n?? s??? ra m???t v??o ?????u n??m 2022. Trong b??i ????ng n??y, ch??ng t??i mu???n ph??c th???o t???t c??? c??c t??nh n??ng v?? thay ?????i m???i ???????c c??ng b??? cho ?????n nay. ...
                                                                </p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-5 text-muted font-size-xs">
                                                        <span class="mr-10" title="B??nh ch???n l??n">
                                                            <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="B??nh ch???n xu???ng">
                                                            <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="C??u tr??? l???i">
                                                            <i class="fas fa-fw fa-reply fa-fw"></i>
                                                            <span>1</span>
                                                        </span>
                                                        <span class="mr-10" title="L?????t xem">
                                                            <i class="far fa-fw fa-eye fa-fw"></i>
                                                            <span>25</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
        
        
                                <div class="block " style="margin-top: 10px;">
                                    <div class="block-content block-content-full ">
                                        <a href="#">
                                            <div class="media">
                                                <div class="media-left pr-20">
                                                    <img class="img-user " src="https://scontent.fsgn2-4.fna.fbcdn.net/v/t1.6435-9/97098042_2556852457963018_7479191263967707136_n.jpg?_nc_cat=109&ccb=1-5&_nc_sid=174925&_nc_ohc=WVn6E6W7eg4AX8qlo5a&_nc_ht=scontent.fsgn2-4.fna&oh=bcef4e5d8e375956e4bf7877dc148f76&oe=61BB2484">
                                                </div>
                                                <div class="media-body">
                                                    <div class="font-size  "> <span style="color: blue;" >tr???n c?????ng</span>
                                                        <a href="#" >
                                                            <h4 class="h5  mr-5 d-inline-block">
                                                                <span class="mark-lookup">
                                                                    T???O PROJECT DJANGO</span> 
                                                            </h4>
                                                        </a>  
                                                        <a  href="#">python</a> 
                                                        <a  href="#">django</a>
                                                    </div>
                                                    
                                                    <div class=" border "">
                                                        <div class="b">
                                                            <a href="#">
                                                                <p > 
                                                                    Microsoft Windows [Version 6.1.7601] Copyright (c) 2009 Microsoft Corporation.  All rights reserved.C:\Users\SONY&gt;python --version Python 3.8.2 C:\Users\SONY&gt;pip --version pip 19.2.3...
                                                                </p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-5 text-muted font-size-xs">
                                                        <span class="mr-10" title="B??nh ch???n l??n">
                                                            <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="B??nh ch???n xu???ng">
                                                            <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="C??u tr??? l???i">
                                                            <i class="fas fa-fw fa-reply fa-fw"></i>
                                                            <span>1</span>
                                                        </span>
                                                        <span class="mr-10" title="L?????t xem">
                                                            <i class="far fa-fw fa-eye fa-fw"></i>
                                                            <span>25</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
        
                                <div class="block " style="margin-top: 10px;">
                                    <div class="block-content block-content-full ">
                                        <a href="#">
                                            <div class="media">
                                                <div class="media-left pr-20">
                                                    <img class="img-user " src="https://scontent.fsgn2-6.fna.fbcdn.net/v/t39.30808-6/241449928_1148415272563287_1661619029899612558_n.jpg?_nc_cat=110&ccb=1-5&_nc_sid=09cbfe&_nc_ohc=tNmWOsxvOH8AX9Q7hNX&_nc_ht=scontent.fsgn2-6.fna&oh=167bcdfe7397dad1ff99cb1572982be0&oe=619B7A89">
                                                </div>
                                                <div class="media-body">
                                                    <div class="font-size  "> <span style="color: blue;" > Thanh v??</span>
                                                        <a href="#" >
                                                            <h4 class="h5  mr-5 d-inline-block">
                                                                <span class="mark-lookup">
                                                                    K??? thu???t s??? d???ng Dependency Injection trong Winform project - Winform never die</span> 
                                                            </h4>
                                                        </a>  
                                                        <a  href="#">C#</a> 
                                                    </div>
                                                    
                                                    <div class=" border "">
                                                        <div class="b">
                                                            <a href="#"> <p> Gi???i thi???u t??n xu???t hi???n ??? t???t c??? m???i n??i trong 1 ch????ng tr??nh. Ch??ng ta ?????t t??n cho Bi???n, H??m, ?????i s???, Class, Packages??? v??n v??n v?? m??y m??y, do ???? ch??ng ta n??n ?????t t??n theo nh???ng nguy??n t???c sau ????y..  </p></a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-5 text-muted font-size-xs">
                                                        <span class="mr-10" title="B??nh ch???n l??n">
                                                            <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="B??nh ch???n xu???ng">
                                                            <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="C??u tr??? l???i">
                                                            <i class="fas fa-fw fa-reply fa-fw"></i>
                                                            <span>1</span>
                                                        </span>
                                                        <span class="mr-10" title="L?????t xem">
                                                            <i class="far fa-fw fa-eye fa-fw"></i>
                                                            <span>25</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
        
                                <div class="block " style="margin-top: 10px;">
                                    <div class="block-content block-content-full ">
                                        <a href="#">
                                            <div class="media">
                                                <div class="media-left pr-20">
                                                    <img class="img-user " src="https://lh3.googleusercontent.com/gu8rtRBOuihUcDxhm2zgZk9fyXZwqUdxHm39rF9Gt7twlv51kQ218sdM41BMbd1BsTFTlvVUgDZZuzHf=s275-rw">
                                                </div>
                                                <div class="media-body">
                                                    <div class="font-size  "> <span style="color: blue;" > Thanh Tien</span>
                                                        <a href="#" >
                                                            <h4 class="h5  mr-5 d-inline-block">
                                                                <span class="mark-lookup">Giao ti???p v???i c??c Windows trong WPF</span> 
                                                            </h4>
                                                        </a>  
                                                        <a  href="#">C#</a> 
                                                        <a  href="#">wpf</a>
                                                    </div>
                                                    
                                                    <div class=" border "">
                                                        <div class="b">
                                                            <a href="#">
                                                                <p >  D???n Nh???p Giao ti???p gi???a c??c Windows trong  WPF  N???i Dung ????? ?????c hi???u b??i n??y t???t nh???t c??c b???n n??n c?? ki???n th???c c?? b???n v??? c??c ph???n: WPF c?? b???n Event v???i Delegate trong C Event chu???n .Net...</p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-5 text-muted font-size-xs">
                                                        <span class="mr-10" title="B??nh ch???n l??n">
                                                            <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="B??nh ch???n xu???ng">
                                                            <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="C??u tr??? l???i">
                                                            <i class="fas fa-fw fa-reply fa-fw"></i>
                                                            <span>1</span>
                                                        </span>
                                                        <span class="mr-10" title="L?????t xem">
                                                            <i class="far fa-fw fa-eye fa-fw"></i>
                                                            <span>25</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                
                            </div>
                            
        
                         
                            
                            <div class="mid_container_right">
                                <div class="tag">TAG PH??? BI???N</div>
                                    <ul class="menu3">
                                        <li><a href="#">C#</a>  x  <small>30</small></li>
                                        <li> <a href="#">Javascrips</a> x  <small>30</small> </li>
                                        <li> <a href="#"> java</a> x  <small>30</small></li>
                                        <li> <a href="#">HTML</a>  x  <small>30</small></li>
                                        <li>  <a href="#">Python</a> x  <small>30</small></li>
                                        <li><a href="#">adroid</a> x  <small>30</small></li>
                                        <li> <a href="#">non-english</a> x  <small>30</small> </li>
                                        <li> <a href="#">php</a> x  <small>30</small></li>
                                        <li>  <a href="#">css</a> x <small>30</small></li>
                                        <div>
                                            <a href="#" style="color: rgb(201, 32, 32) ; text-decoration: none; " > xem th??m...</a>
                                        </div>
                                    </ul>   
                                    <div class="mid_container_right2">
                                        <div class="tag2">C??u h???i m???i nh???t</div>
                                         <ul class="question">
        
                                                <li>
                                                    <a href="#">H???i v??? c??ch l???y tu???n hi???n t???i trong php</a>
                                                    <div class="mb-5 text-muted font-size-xs">
                                                        <span class="mr-10" title="B??nh ch???n l??n">
                                                            <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="B??nh ch???n xu???ng">
                                                            <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="C??u tr??? l???i">
                                                            <i class="fas fa-fw fa-reply fa-fw"></i>
                                                            <span>1</span>
                                                        </span>
                                                        <span class="mr-10" title="L?????t xem">
                                                            <i class="far fa-fw fa-eye fa-fw"></i>
                                                            <span>25</span>
                                                        </span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a href="#">Ch???n h??ng trong DataGridview</a>
                                                    <div class="mb-5 text-muted font-size-xs">
                                                        <span class="mr-10" title="B??nh ch???n l??n">
                                                            <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="B??nh ch???n xu???ng">
                                                            <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="C??u tr??? l???i">
                                                            <i class="fas fa-fw fa-reply fa-fw"></i>
                                                            <span>1</span>
                                                        </span>
                                                        <span class="mr-10" title="L?????t xem">
                                                            <i class="far fa-fw fa-eye fa-fw"></i>
                                                            <span>25</span>
                                                        </span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a href="#">Truy???n tham s??? qua c??c l???p viewmodel</a>
                                                    <div class="mb-5 text-muted font-size-xs">
                                                        <span class="mr-10" title="B??nh ch???n l??n">
                                                            <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="B??nh ch???n xu???ng">
                                                            <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="C??u tr??? l???i">
                                                            <i class="fas fa-fw fa-reply fa-fw"></i>
                                                            <span>1</span>
                                                        </span>
                                                        <span class="mr-10" title="L?????t xem">
                                                            <i class="far fa-fw fa-eye fa-fw"></i>
                                                            <span>25</span>
                                                        </span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a href="#">game caro</a>
                                                    <div class="mb-5 text-muted font-size-xs">
                                                        <span class="mr-10" title="B??nh ch???n l??n">
                                                            <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="B??nh ch???n xu???ng">
                                                            <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="C??u tr??? l???i">
                                                            <i class="fas fa-fw fa-reply fa-fw"></i>
                                                            <span>1</span>
                                                        </span>
                                                        <span class="mr-10" title="L?????t xem">
                                                            <i class="far fa-fw fa-eye fa-fw"></i>
                                                            <span>25</span>
                                                        </span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a href="#">Undo</a>
                                                    <div class="mb-5 text-muted font-size-xs">
                                                        <span class="mr-10" title="B??nh ch???n l??n">
                                                            <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="B??nh ch???n xu???ng">
                                                            <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="C??u tr??? l???i">
                                                            <i class="fas fa-fw fa-reply fa-fw"></i>
                                                            <span>1</span>
                                                        </span>
                                                        <span class="mr-10" title="L?????t xem">
                                                            <i class="far fa-fw fa-eye fa-fw"></i>
                                                            <span>25</span>
                                                        </span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a href="#">G???p v???n ????? trong qu?? tr??nh add Lib</a>
                                                    <div class="mb-5 text-muted font-size-xs">
                                                        <span class="mr-10" title="B??nh ch???n l??n">
                                                            <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="B??nh ch???n xu???ng">
                                                            <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="C??u tr??? l???i">
                                                            <i class="fas fa-fw fa-reply fa-fw"></i>
                                                            <span>1</span>
                                                        </span>
                                                        <span class="mr-10" title="L?????t xem">
                                                            <i class="far fa-fw fa-eye fa-fw"></i>
                                                            <span>25</span>
                                                        </span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a href="#">H?????ng d???n c??i visual studio code</a>
                                                    <div class="mb-5 text-muted font-size-xs">
                                                        <span class="mr-10" title="B??nh ch???n l??n">
                                                            <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="B??nh ch???n xu???ng">
                                                            <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="C??u tr??? l???i">
                                                            <i class="fas fa-fw fa-reply fa-fw"></i>
                                                            <span>1</span>
                                                        </span>
                                                        <span class="mr-10" title="L?????t xem">
                                                            <i class="far fa-fw fa-eye fa-fw"></i>
                                                            <span>25</span>
                                                        </span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a href="#">C??c th??? c?? b???n trong HTML</a>
                                                    <div class="mb-5 text-muted font-size-xs">
                                                        <span class="mr-10" title="B??nh ch???n l??n">
                                                            <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="B??nh ch???n xu???ng">
                                                            <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="C??u tr??? l???i">
                                                            <i class="fas fa-fw fa-reply fa-fw"></i>
                                                            <span>1</span>
                                                        </span>
                                                        <span class="mr-10" title="L?????t xem">
                                                            <i class="far fa-fw fa-eye fa-fw"></i>
                                                            <span>25</span>
                                                        </span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a href="#">1. Vi???t ch????ng tr??nh nh???p v??o d??y n ph???n t??? v?? in ra c??c ph???n t??? theo th??? t??? ng?????c l???i qu?? tr??nh nh???p. S??? nh???p ?????u ti??n s??? in ra sau c??ng.</a>
                                                    <div class="mb-5 text-muted font-size-xs">
                                                        <span class="mr-10" title="B??nh ch???n l??n">
                                                            <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="B??nh ch???n xu???ng">
                                                            <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="C??u tr??? l???i">
                                                            <i class="fas fa-fw fa-reply fa-fw"></i>
                                                            <span>1</span>
                                                        </span>
                                                        <span class="mr-10" title="L?????t xem">
                                                            <i class="far fa-fw fa-eye fa-fw"></i>
                                                            <span>25</span>
                                                        </span>
                                                    </div>
                                                </li>
                                         </ul>
                                    </div>
                                    
                            </div>
                               
                           
                        </div>  
                             
                    </div>

                </div>
            </div>
           
            <div class="main__kter">
                <div class="kter">
                <div class="kter_top__container">
                        <div class="heal1">
                            <h1>Th??nh vi??n</h1>
                        <p>Tham gia c??ng ch??ng t??i</p>
                        </div>
                        <div >
                            <a href="#" class="btn "> <i class="fas fa-plus-circle" style="background-image: linear-gradient(to right,rgb(82, 85, 238),rgb(142, 169, 243));"></i>  Vi???t b??i</a>
                        </div>
                </div>
                <div class="kter_container_main">
                    <div class="t1--kter">
                        <i class="fas fa-home" style="color: rgb(17, 0, 253);"> </i>
                        <span class="breadcrumb-item active"> >  Th??nh vi??n</span>
                    </div>
                    <div class="thanhvien--kter">
                        <div class="input-group input-group--kter">
                            <input class="input" type="text" placeholder="T??m kh??a h???c...">
                            <div class="input-search">
                                <span   onclick="showErrorToast();">
                                    <i class="icon-search fas fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>
    
                </div>
                <div class="kter_container_mid">
                    <div class="kter_container_mid_user">
                            <div class="kter_heal_mid_user">
                                <ul>
                                    <li><a href="#">T???t c???</a></li>
                                    <li><a href="#">Qu???n tr??? vi??n </a></li>
                                </ul>
                            </div>
                    </div>
                    <div class="kter_mid_user">
                        <div class="kter_center_user">
                            <div class="user_1--kter">
                                <div class="media--kter">
                                    <div class="media-left ">
                                        <a href="/users/1e5d3cc5-7367-4db0-9ca5-c547dab0bf63">
                                            <img class="media-object avatar" src="https://lh3.googleusercontent.com/gu8rtRBOuihUcDxhm2zgZk9fyXZwqUdxHm39rF9Gt7twlv51kQ218sdM41BMbd1BsTFTlvVUgDZZuzHf=s275-rw">
                                        </a>
                                    </div>
                                    <div class="media-body--kter">
                                        <a href="#" class="media-heading font-w600 text-overflow-dot">hvyxxm</a>
                                        <p class="small text-muted"><strong>0</strong> ??i???m</p>
                                        <p class="small text-muted">tham gia <span class="format-time font-w600" title="2021-10-29 19:23:52">23 ph??t tr?????c</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="user_1--kter">
                                <div class="media--kter">
                                    <div class="media-left ">
                                        <a href="/users/1e5d3cc5-7367-4db0-9ca5-c547dab0bf63">
                                            <img class="media-object avatar" src="https://lh3.googleusercontent.com/gu8rtRBOuihUcDxhm2zgZk9fyXZwqUdxHm39rF9Gt7twlv51kQ218sdM41BMbd1BsTFTlvVUgDZZuzHf=s275-rw">
                                        </a>
                                    </div>
                                    <div class="media-body--kter">
                                        <a href="#" class="media-heading font-w600 text-overflow-dot">hvyxxm</a>
                                        <p class="small text-muted"><strong>0</strong> ??i???m</p>
                                        <p class="small text-muted">tham gia <span class="format-time font-w600" title="2021-10-29 19:23:52">23 ph??t tr?????c</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="user_1--kter">
                                <div class="media--kter">
                                    <div class="media-left ">
                                        <a href="/users/1e5d3cc5-7367-4db0-9ca5-c547dab0bf63">
                                            <img class="media-object avatar" src="https://lh3.googleusercontent.com/gu8rtRBOuihUcDxhm2zgZk9fyXZwqUdxHm39rF9Gt7twlv51kQ218sdM41BMbd1BsTFTlvVUgDZZuzHf=s275-rw">
                                        </a>
                                    </div>
                                    <div class="media-body--kter">
                                        <a href="#" class="media-heading font-w600 text-overflow-dot">hvyxxm</a>
                                        <p class="small text-muted"><strong>0</strong> ??i???m</p>
                                        <p class="small text-muted">tham gia <span class="format-time font-w600" title="2021-10-29 19:23:52">23 ph??t tr?????c</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="user_1--kter">
                                <div class="media--kter">
                                    <div class="media-left ">
                                        <a href="/users/1e5d3cc5-7367-4db0-9ca5-c547dab0bf63">
                                            <img class="media-object avatar" src="https://lh3.googleusercontent.com/gu8rtRBOuihUcDxhm2zgZk9fyXZwqUdxHm39rF9Gt7twlv51kQ218sdM41BMbd1BsTFTlvVUgDZZuzHf=s275-rw">
                                        </a>
                                    </div>
                                    <div class="media-body--kter">
                                        <a href="#" class="media-heading font-w600 text-overflow-dot">hvyxxm</a>
                                        <p class="small text-muted"><strong>0</strong> ??i???m</p>
                                        <p class="small text-muted">tham gia <span class="format-time font-w600" title="2021-10-29 19:23:52">23 ph??t tr?????c</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kter_center_user">
                            <div class="user_1--kter">
                                <div class="media--kter">
                                    <div class="media-left ">
                                        <a href="/users/1e5d3cc5-7367-4db0-9ca5-c547dab0bf63">
                                            <img class="media-object avatar" src="https://lh3.googleusercontent.com/gu8rtRBOuihUcDxhm2zgZk9fyXZwqUdxHm39rF9Gt7twlv51kQ218sdM41BMbd1BsTFTlvVUgDZZuzHf=s275-rw">
                                        </a>
                                    </div>
                                    <div class="media-body--kter">
                                        <a href="#" class="media-heading font-w600 text-overflow-dot">hvyxxm</a>
                                        <p class="small text-muted"><strong>0</strong> ??i???m</p>
                                        <p class="small text-muted">tham gia <span class="format-time font-w600" title="2021-10-29 19:23:52">23 ph??t tr?????c</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="user_1--kter">
                                <div class="media--kter">
                                    <div class="media-left ">
                                        <a href="/users/1e5d3cc5-7367-4db0-9ca5-c547dab0bf63">
                                            <img class="media-object avatar" src="https://lh3.googleusercontent.com/gu8rtRBOuihUcDxhm2zgZk9fyXZwqUdxHm39rF9Gt7twlv51kQ218sdM41BMbd1BsTFTlvVUgDZZuzHf=s275-rw">
                                        </a>
                                    </div>
                                    <div class="media-body--kter">
                                        <a href="#" class="media-heading font-w600 text-overflow-dot">hvyxxm</a>
                                        <p class="small text-muted"><strong>0</strong> ??i???m</p>
                                        <p class="small text-muted">tham gia <span class="format-time font-w600" title="2021-10-29 19:23:52">23 ph??t tr?????c</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="user_1--kter">
                                <div class="media--kter">
                                    <div class="media-left ">
                                        <a href="/users/1e5d3cc5-7367-4db0-9ca5-c547dab0bf63">
                                            <img class="media-object avatar" src="https://lh3.googleusercontent.com/gu8rtRBOuihUcDxhm2zgZk9fyXZwqUdxHm39rF9Gt7twlv51kQ218sdM41BMbd1BsTFTlvVUgDZZuzHf=s275-rw">
                                        </a>
                                    </div>
                                    <div class="media-body--kter">
                                        <a href="#" class="media-heading font-w600 text-overflow-dot">hvyxxm</a>
                                        <p class="small text-muted"><strong>0</strong> ??i???m</p>
                                        <p class="small text-muted">tham gia <span class="format-time font-w600" title="2021-10-29 19:23:52">23 ph??t tr?????c</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="user_1--kter">
                                <div class="media--kter">
                                    <div class="media-left ">
                                        <a href="/users/1e5d3cc5-7367-4db0-9ca5-c547dab0bf63">
                                            <img class="media-object avatar" src="https://lh3.googleusercontent.com/gu8rtRBOuihUcDxhm2zgZk9fyXZwqUdxHm39rF9Gt7twlv51kQ218sdM41BMbd1BsTFTlvVUgDZZuzHf=s275-rw">
                                        </a>
                                    </div>
                                    <div class="media-body--kter">
                                        <a href="#" class="media-heading font-w600 text-overflow-dot">hvyxxm</a>
                                        <p class="small text-muted"><strong>0</strong> ??i???m</p>
                                        <p class="small text-muted">tham gia <span class="format-time font-w600" title="2021-10-29 19:23:52">23 ph??t tr?????c</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kter_center_user">
                            <div class="user_1--kter">
                                <div class="media--kter">
                                    <div class="media-left ">
                                        <a href="/users/1e5d3cc5-7367-4db0-9ca5-c547dab0bf63">
                                            <img class="media-object avatar" src="https://lh3.googleusercontent.com/gu8rtRBOuihUcDxhm2zgZk9fyXZwqUdxHm39rF9Gt7twlv51kQ218sdM41BMbd1BsTFTlvVUgDZZuzHf=s275-rw">
                                        </a>
                                    </div>
                                    <div class="media-body--kter">
                                        <a href="#" class="media-heading font-w600 text-overflow-dot">hvyxxm</a>
                                        <p class="small text-muted"><strong>0</strong> ??i???m</p>
                                        <p class="small text-muted">tham gia <span class="format-time font-w600" title="2021-10-29 19:23:52">23 ph??t tr?????c</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="user_1--kter">
                                <div class="media--kter">
                                    <div class="media-left ">
                                        <a href="/users/1e5d3cc5-7367-4db0-9ca5-c547dab0bf63">
                                            <img class="media-object avatar" src="https://lh3.googleusercontent.com/gu8rtRBOuihUcDxhm2zgZk9fyXZwqUdxHm39rF9Gt7twlv51kQ218sdM41BMbd1BsTFTlvVUgDZZuzHf=s275-rw">
                                        </a>
                                    </div>
                                    <div class="media-body--kter">
                                        <a href="#" class="media-heading font-w600 text-overflow-dot">hvyxxm</a>
                                        <p class="small text-muted"><strong>0</strong> ??i???m</p>
                                        <p class="small text-muted">tham gia <span class="format-time font-w600" title="2021-10-29 19:23:52">23 ph??t tr?????c</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="user_1--kter">
                                <div class="media--kter">
                                    <div class="media-left ">
                                        <a href="/users/1e5d3cc5-7367-4db0-9ca5-c547dab0bf63">
                                            <img class="media-object avatar" src="https://lh3.googleusercontent.com/gu8rtRBOuihUcDxhm2zgZk9fyXZwqUdxHm39rF9Gt7twlv51kQ218sdM41BMbd1BsTFTlvVUgDZZuzHf=s275-rw">
                                        </a>
                                    </div>
                                    <div class="media-body--kter">
                                        <a href="#" class="media-heading font-w600 text-overflow-dot">hvyxxm</a>
                                        <p class="small text-muted"><strong>0</strong> ??i???m</p>
                                        <p class="small text-muted">tham gia <span class="format-time font-w600" title="2021-10-29 19:23:52">23 ph??t tr?????c</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="user_1--kter">
                                <div class="media--kter">
                                    <div class="media-left ">
                                        <a href="/users/1e5d3cc5-7367-4db0-9ca5-c547dab0bf63">
                                            <img class="media-object avatar" src="https://lh3.googleusercontent.com/gu8rtRBOuihUcDxhm2zgZk9fyXZwqUdxHm39rF9Gt7twlv51kQ218sdM41BMbd1BsTFTlvVUgDZZuzHf=s275-rw">
                                        </a>
                                    </div>
                                    <div class="media-body--kter">
                                        <a href="#" class="media-heading font-w600 text-overflow-dot">hvyxxm</a>
                                        <p class="small text-muted"><strong>0</strong> ??i???m</p>
                                        <p class="small text-muted">tham gia <span class="format-time font-w600" title="2021-10-29 19:23:52">23 ph??t tr?????c</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kter_center_user">
                            <div class="user_1--kter">
                                <div class="media--kter">
                                    <div class="media-left ">
                                        <a href="/users/1e5d3cc5-7367-4db0-9ca5-c547dab0bf63">
                                            <img class="media-object avatar" src="https://lh3.googleusercontent.com/gu8rtRBOuihUcDxhm2zgZk9fyXZwqUdxHm39rF9Gt7twlv51kQ218sdM41BMbd1BsTFTlvVUgDZZuzHf=s275-rw">
                                        </a>
                                    </div>
                                    <div class="media-body--kter">
                                        <a href="#" class="media-heading font-w600 text-overflow-dot">hvyxxm</a>
                                        <p class="small text-muted"><strong>0</strong> ??i???m</p>
                                        <p class="small text-muted">tham gia <span class="format-time font-w600" title="2021-10-29 19:23:52">23 ph??t tr?????c</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="user_1--kter">
                                <div class="media--kter">
                                    <div class="media-left ">
                                        <a href="/users/1e5d3cc5-7367-4db0-9ca5-c547dab0bf63">
                                            <img class="media-object avatar" src="https://lh3.googleusercontent.com/gu8rtRBOuihUcDxhm2zgZk9fyXZwqUdxHm39rF9Gt7twlv51kQ218sdM41BMbd1BsTFTlvVUgDZZuzHf=s275-rw">
                                        </a>
                                    </div>
                                    <div class="media-body--kter">
                                        <a href="#" class="media-heading font-w600 text-overflow-dot">hvyxxm</a>
                                        <p class="small text-muted"><strong>0</strong> ??i???m</p>
                                        <p class="small text-muted">tham gia <span class="format-time font-w600" title="2021-10-29 19:23:52">23 ph??t tr?????c</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="user_1--kter">
                                <div class="media--kter">
                                    <div class="media-left ">
                                        <a href="/users/1e5d3cc5-7367-4db0-9ca5-c547dab0bf63">
                                            <img class="media-object avatar" src="https://lh3.googleusercontent.com/gu8rtRBOuihUcDxhm2zgZk9fyXZwqUdxHm39rF9Gt7twlv51kQ218sdM41BMbd1BsTFTlvVUgDZZuzHf=s275-rw">
                                        </a>
                                    </div>
                                    <div class="media-body--kter">
                                        <a href="#" class="media-heading font-w600 text-overflow-dot">hvyxxm</a>
                                        <p class="small text-muted"><strong>0</strong> ??i???m</p>
                                        <p class="small text-muted">tham gia <span class="format-time font-w600" title="2021-10-29 19:23:52">23 ph??t tr?????c</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="user_1--kter">
                                <div class="media--kter">
                                    <div class="media-left ">
                                        <a href="/users/1e5d3cc5-7367-4db0-9ca5-c547dab0bf63">
                                            <img class="media-object avatar" src="https://lh3.googleusercontent.com/gu8rtRBOuihUcDxhm2zgZk9fyXZwqUdxHm39rF9Gt7twlv51kQ218sdM41BMbd1BsTFTlvVUgDZZuzHf=s275-rw">
                                        </a>
                                    </div>
                                    <div class="media-body--kter">
                                        <a href="#" class="media-heading font-w600 text-overflow-dot">hvyxxm</a>
                                        <p class="small text-muted"><strong>0</strong> ??i???m</p>
                                        <p class="small text-muted">tham gia <span class="format-time font-w600" title="2021-10-29 19:23:52">23 ph??t tr?????c</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                </div>
            </div>
            <div class="main__kteam">
                <div class="Vekteam_top__container">
                    <div class="Vekteam_heal1">
                        <h1> V??? Kteam</h1>
                       <p>V?? m???t n???n gi??o d???c mi???n ph?? cho b???t k??? ai, ??? b???t c??? n??i n??o</p>
                    </div>
                    <div     >
                        <a  href="#" class="btn "> <i class="fas fa-plus-circle" style="background-image: linear-gradient(to right,rgb(82, 85, 238),rgb(142, 169, 243));"></i>  Vi???t b??i</a>
                    </div>
                </div>
                <div class="VeKteam_container_main">
                        <div class="Vekteam_container_heal">
                                <ul>
                                    <li><a href="#">V??? Kteam</a></li>
                                    <li><a href="#">Ng?????i ???ng h???</a></li>
                                    <li><a href="#">Li??n h??? - G??p ??</a></li>
                                    <li><a href="#">T??i tr???</a></li>
                                </ul>
                        </div>
                        <div class="VeKteam_container_mid">
                                <div class="VeKteam_container_mid_vekteam">
                                    <h5 class="h1--vekteam">T???m nh??n</h5>
                                    <p class="font-size-h5 mb-10">
                                        V???i mong mu???n mang ?????n ki???n th???c ch???t l?????ng, mi???n ph?? cho m???i ng?????i, v???i
                                        t??m huy???t ph?? b??? r??o c???n ki???n th???c t??? vi???c gi??o d???c thu ph??. Ch??ng t??i - Kteam
                                        ???? l???p n??n trang website n??y ????? th??? gi???i ph???ng h??n.
                                    </p>
                                    <p class="font-size-h5 mb-10">
                                        B???t c??? ai c?? mong mu???n khai ph?? th??? gi???i. Ph?? b??? m???i th??? ng??n c???n s??? ph??t
                                        tri???n t???t y???u b???n v???ng c???a x?? h???i ?????u l?? Kter (Th??nh vi??n c???a Kteam).
                                    </p>
                                    <h5 class="h2">GI??O D???C L?? MI???N PH??!</h5>
                                </div>
                                <div class="VeKteam_container_mid_ngsanglap">
                                    <h5 class="h1--vekteam ">Ng?????i s??ng l???p</h5>
                                    <div class="Vekteam_cac_user">
                                        <div class="Vekteam_user">
                                            <div class="Vekteam_user_img">
                                                <img class="img-avatar" src="https://lh3.googleusercontent.com/gu8rtRBOuihUcDxhm2zgZk9fyXZwqUdxHm39rF9Gt7twlv51kQ218sdM41BMbd1BsTFTlvVUgDZZuzHf=s275-rw" alt="">
                                            </div>
                                            <div class="Vekteam_user_p">
                                                <div class="font-w600 h4 mb-5">Nguy???n Thanh Ti???n</div>
                                                <div class="font-size-sm text-muted">K??? thu???t n???i dung</div>
                                            </div>
                                            <div class="Vekteam_user_link">
                                                    <div class="Vekteam_user_link_bor">
                                                           <div class="Vekteam_user_link_left">
                                                                <div class="Vekteam_user_icon">
                                                                    <i class="fab fa-facebook-f"></i>
                                                                </div>
                                                                <div class="Vekteam_user_linkkkkk">
                                                                    <a href="https://www.facebook.com/profile.php?id=100041273850472">fb.com/thanhtien2001</a>
                                                                </div>
                                                           </div>
                                                           <div class="Vekteam_user_link_right">
                                                                <div class="Vekteam_user_icon">
                                                                    <i class="fas fa-phone-alt"></i>
                                                                </div>
                                                                <div class="Vekteam_user_linkkkkk">
                                                                    <a href="#">(+84) 865264533</a>
                                                                </div>
                                                           </div>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="Vekteam_user">
                                            <div class="Vekteam_user_img" style="background: linear-gradient(135deg,#7e20eb 0%,#3382e9 100%)!important;">
                                                <img class="img-avatar" src="https://scontent.fsgn2-1.fna.fbcdn.net/v/t1.6435-9/47042257_135221360798637_44909586796249088_n.jpg?_nc_cat=105&ccb=1-5&_nc_sid=e3f864&_nc_ohc=bvYH4TR1TycAX_kxDGp&tn=Yte4O01X9Gg_UDxS&_nc_ht=scontent.fsgn2-1.fna&oh=ce67235eb539197392e32787890c42d6&oe=61A48E0F" alt="">
                                            </div>
                                            <div class="Vekteam_user_p">
                                                <div class="font-w600 h4 mb-5">Tr???n V??n ?????t</div>
                                                <div class="font-size-sm text-muted">Thi???t k??? website</div>
                                            </div>
                                            <div class="Vekteam_user_link">
                                                    <div class="Vekteam_user_link_bor">
                                                           <div class="Vekteam_user_link_left">
                                                                <div class="Vekteam_user_icon">
                                                                    <i class="fab fa-facebook-f"></i>
                                                                </div>
                                                                <div class="Vekteam_user_linkkkkk">
                                                                    <a href="https://www.facebook.com/datbe.us">fb.com/Datbe2021</a>
                                                                </div>
                                                           </div>
                                                           <div class="Vekteam_user_link_right">
                                                                <div class="Vekteam_user_icon">
                                                                    <i class="fas fa-phone-alt"></i>
                                                                </div>
                                                                <div class="Vekteam_user_linkkkkk">
                                                                    <a href="#">(+84) _______________</a>
                                                                </div>
                                                           </div>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="Vekteam_user">
                                            <div class="Vekteam_user_img" style="background: linear-gradient(135deg,#1e6dc7 0%,#99e2a3 100%)!important;">
                                                <img class="img-avatar" src="https://scontent.fsgn2-5.fna.fbcdn.net/v/t1.6435-9/45288287_330554540857063_7698190104497487872_n.jpg?_nc_cat=102&ccb=1-5&_nc_sid=09cbfe&_nc_ohc=RUL3RO9QhjUAX-JpMZJ&tn=Yte4O01X9Gg_UDxS&_nc_ht=scontent.fsgn2-5.fna&oh=79c197f5ee301f7bcfc97cafd5443f46&oe=61A60B57" alt="">
                                            </div>
                                            <div class="Vekteam_user_p">
                                                <div class="font-w600 h4 mb-5">L?? H?? Gia Kh??i</div>
                                                <div class="font-size-sm text-muted">????? h???a -Founder</div>
                                            </div>
                                            <div class="Vekteam_user_link">
                                                    <div class="Vekteam_user_link_bor">
                                                           <div class="Vekteam_user_link_left">
                                                                <div class="Vekteam_user_icon">
                                                                    <i class="fab fa-facebook-f"></i>
                                                                </div>
                                                                <div class="Vekteam_user_linkkkkk">
                                                                    <a href="https://www.facebook.com/khoi.lee.9047">fb.com/Khoile2001</a>
                                                                </div>
                                                           </div>
                                                           <div class="Vekteam_user_link_right">
                                                                <div class="Vekteam_user_icon">
                                                                    <i class="fas fa-phone-alt"></i>
                                                                </div>
                                                                <div class="Vekteam_user_linkkkkk">
                                                                    <a href="#">(+84) _______________</a>
                                                                </div>
                                                           </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="VeKteam_container_mid_dichvu">
                                        <h5 class="h1--vekteam">D???ch v???</h5>
                                        <p>
                                            Ch??ng t??i cung c???p c??c d???ch v??? v??? ph??n t??ch, thi???t k???, x??y d???ng.
                                        </p>
                                        <div class="VeKteam_container_mid_dichvu_top">
                                                <div class="VeKteam_container_mid_dichvu_colum">    
                                                        <div class="VeKteam_container_mid_dichvu_colum_top">
                                                            <h3 class="block-title font-w600 text-white"><i class="far fa-sticky-note"></i> T?? V???N X??Y D???NG H??? TH???NG QU???N L??</h3>
                                                        </div>
                                                        <div class="VeKteam_container_mid_dichvu_colum_bot">
                                                            <ul class="pl-15">
                                                                <li>H??? tr??? t??? v???n gi???i ph??p qu???n l?? mi???n ph??.</li>
                                                                <li>H??? tr??? x??y d???ng h??? th???ng qu???n l?? nh??n s???, b??n h??ng, kho b??i.</li>
                                                            </ul>
                                                        </div>
                                                </div>
                                                <div class="VeKteam_container_mid_dichvu_colum">    
                                                    <div  style="background-color: #26c6da" class="VeKteam_container_mid_dichvu_colum_top">
                                                        <h3 class="block-title font-w600 text-white"><i class="fas fa-globe"></i> WEBSITE - QU???N TR??? WEBSITE, FANPAGE</h3>
                                                    </div>
                                                    <div class="VeKteam_container_mid_dichvu_colum_bot">
                                                        <ul class="pl-15">
                                                            <li>H??? tr??? t???o Website b??n h??ng, Gi???i thi???u c??ng ty nhanh ch??ng.</li>
                                                            <li>H??? tr??? th???c hi???n WebApplication qu???n l?? m???i n??i.H??? tr??? th???c hi???n WebApplication qu???n l?? m???i n??i.</li>
                                                            <li>K???t h???p 3 n???n t???ng trong 1 h??? th???ng Website, ???ng d???ng di ?????ng v?? ???ng d???ng PC.</li>
                                                        </ul>
                                                    </div>
                                                 </div>
                                                 <div class="VeKteam_container_mid_dichvu_colum">    
                                                    <div  style="background-color: #829294" class="VeKteam_container_mid_dichvu_colum_top">
                                                        <h3 class="block-title font-w600 text-white"><i class="fas fa-globe"></i> ???NG D???NG DI ?????NG</h3>
                                                    </div>
                                                    <div class="VeKteam_container_mid_dichvu_colum_bot">
                                                        <ul class="pl-15" style="height: 80%;">
                                                            <li>H??? tr??? t???o Website b??n h??ng, Gi???i thi???u c??ng ty nhanh ch??ng.</li>
                                                            <li>H??? tr??? th???c hi???n WebApplication qu???n l?? m???i n??i.H??? tr??? th???c hi???n WebApplication qu???n l?? m???i n??i.</li>
                                                            <li>K???t h???p 3 n???n t???ng trong 1 h??? th???ng Website, ???ng d???ng di ?????ng v?? ???ng d???ng PC.</li>
                                                        </ul>
                                                    </div>
                                                 </div>
                                        </div>
                                        <div class="VeKteam_container_mid_dichvu_bot" >
                                            <div class="VeKteam_container_mid_dichvu_colum">    
                                                <div style="background-color: #ef5350;"  class="VeKteam_container_mid_dichvu_colum_top">
                                                    <h3 class="block-title font-w600 text-white"><i class="fas fa-wrench"></i> TOOL AUTO - T??? ?????NG H??A ???NG D???NG</h3>
                                                </div>
                                                <div class="VeKteam_container_mid_dichvu_colum_bot">
                                                    <ul class="pl-15">
                                                        <li>Th???c hi???n nh???ng c??ng vi???c l???p ??i l???p l???i ch??? v???i 1 click chu???t.</li>
                                                        <li>Nhanh ch??ng, ti???n l???i v?? chi ph?? ph???i ch??ng.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="VeKteam_container_mid_dichvu_colum">    
                                                <div style="background-color: #9ccc65;" class="VeKteam_container_mid_dichvu_colum_top">
                                                    <h3 class="block-title font-w600 text-white"><i class="fas fa-ribbon"></i> ????O T???O NH??N S??? - C??NG NGH??? TH??NG TIN</h3>
                                                </div>
                                                <div class="VeKteam_container_mid_dichvu_colum_bot">
                                                    <ul class="pl-15">
                                                        <li>H??? tr??? ????o t???o nh??n s??? CNTT ngay ????? c?? th??? b???t k???p c??ng ngh??? m???i, xu h?????ng m???i.</li>
                                                        <li>Th???i gian nhanh ch??ng, chi ph?? ph???i ch??ng.</li>
                                                        <li>Ch???t l?????ng cao, ?????u ra ?????m b???o.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="VeKteam_container_mid_dichvu_colum">    
                                                <div style="background-color: #d262e3;" class="VeKteam_container_mid_dichvu_colum_top">
                                                    <h3 class="block-title font-w600 text-white"><i class="fas fa-users"></i> K???T N???I NH??N S???</h3>
                                                </div>
                                                <div class="VeKteam_container_mid_dichvu_colum_bot">
                                                    <ul class="pl-15" style="height: 80%;">
                                                        <li>Kh??ng c??n ph???i ??au ?????u v??? vi???c kh??ng t??m ra nh??n l???c cho doanh nghi???p c???a m??nh. Kteam s??? l?? c???u n???i c???a b???n v?? ngu???n nh??n l???c cho ch??nh Kteam ????o t???o.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div >
                                </div>
                                <div class="Vekteam_container_mid_taitro">
                                            <div>
                                                <h5 class="h1--vekteam">T??i tr???</h5>
                                                    <p class="p">H??? tr??? ch??ng t??i ????? c??ng x??y d???ng m???t n???n  <strong>GI??O D???C MI???N PH??</strong>  cho b???t c??? ai, ??? b???t c??? n??i n??o. 
                                                <br> Ho???c tham gia v??o ?????i ng??? gi???ng vi??n, c??ng t??c vi??n, t??nh nguy???n vi??n c???a ch??ng t??i.</p>
                                                <a  href="#">T??i tr???</a>
                                            </div>                                     
                                </div>
                                
                                <div  class="Vekteam_container_mid_lienhegopy">
                                    <h5 class="h1--vekteam">Li??n h??? - G??p ??</h5>
                                    <p class="p">G??p ?? ho???c li??n h??? cho Kteam n???u b???n c?? nhu c???u v??? d???ch v???, qu???ng c??o ho???c nh???ng th???c m???c kh??c.</p>
                                    <a href="#">Li??n h???</a>
                                </div>
                        </div>
                </div>
            </div>
            <div class="main__taitro">
                <div class="taitro_top__container">
                    <div class="heal1">
                        <h1> T??i tr???</h1>
                       <p>H??? tr??? ????? Kteam c?? th??? x??y d???ng nhi???u kh??a h???c h??n.</p>
                    </div>
                    <div >
                        <a href="#" class="btn "> <i class="fas fa-plus-circle" style="background-image: linear-gradient(to right,rgb(82, 85, 238),rgb(142, 169, 243));"></i>  Vi???t b??i</a>
                    </div>
                </div>
                <div class="taitro_container_main">
                    <div class="taitro_container_heal Vekteam_container_heal">
                        <ul>
                            <li><a href="#">V??? Kteam</a></li>
                            <li><a href="#">Ng?????i ???ng h???</a></li>
                            <li><a href="#">Li??n h??? - G??p ??</a></li>
                            <li><a href="#">T??i tr???</a></li>
                        </ul>
                     </div>
                     <div class="taitro_container_mid">
                                <div class="taitro_container_mid_theatm">
                                        <div  class="taitro_container_mid_theatm_heal">
                                            <h3 class="block-title font-w600"><i class="far fa-credit-card fa-fw"></i>  ???NG H??? ONLINE S??? D???NG TH??? ATM HO???C VISA/MASTER</h3>
                                        </div>
                                        <div class="taitro_container_mid_theatm_mid">
                                            <div id="faq1_q1" class="collapse show" role="tabpanel" aria-labelledby="faq1_h1">
                                                <div class="block-content pb-20">
                                                    <p>???ng h??? online s??? d???ng th??? ATM ho???c VISA/MASTER.</p>
                                                    <p style="  margin-bottom: 3%;"><strong>L??u ??:</strong> Th??? c???n c?? ch???c n??ng Internet Banking.</p>
                                                    <a class="btn_buttton" href="#"><i class="fas fa-arrow-right"></i> Ti???p t???c</a>
                                                </div>
                                            </div>
                                        </div>
                                </div>  
                                <div class="taitro_container_mid_unghotructiep">
                                    <div  class="taitro_container_mid_unghotructiep_heal">
                                        <h3 class="block-title font-w600"><i class="fas fa-university fa-fw"></i>  ???NG H??? ONLINE S??? D???NG TH??? ATM HO???C VISA/MASTER</h3>
                                    </div>
                                    <div class="taitro_container_mid_unghotructiep_mid_img">
                                                <img style="width:30%; margin-right: 5%;" src="https://www.agribank.com.vn/wcm/connect/2f8d74a7-32a6-4d8c-bcef-cb733b169e4e/bo-logo-va-chu-agribank-do.jpg?MOD=AJPERES&CONVERT_TO=url&CACHEID=ROOTWORKSPACE-2f8d74a7-32a6-4d8c-bcef-cb733b169e4e-mRcD3h9" alt="">
                                                <img style="width:30%;  margin-right: 5%" src="https://lh5.googleusercontent.com/_VXB7ZpDfnBDmDwqUm0dUcV7t9y-zB_ZMgmYwbduUMwcIPxPFTu_TLoYOCqb-dbsm6nhuLANDvgp0QpcTcmECfxNlkB1WphOKLvmdhmqtlXqC7Ye3GK_VaUqdWcL5Lcs1LbBJ602w8rC1pukBQ" alt="">
                                                <img style="width:30%" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRof1LhrFOTIe3UxIHr2YfTWItJIs5MXroUzo3WCM4H2HQPmwHQ4qGqprbROpwUxSctwl4&usqp=CAU" alt="">
                                    </div>
                                </div>
                     </div>
                </div>
            </div>
            <div class="main__phanhoi">
                <div class="phanhoi_top__container">
                    <div class="heal1">
                        <h1> Li??n h??? - G??p ??</h1>
                       <p>G??p ?? ho???c li??n h??? cho Kteam n???u b???n c?? nhu c???u v??? d???ch v???, qu???ng c??o ho???c nh???ng th???c m???c kh??c.</p>
                    </div>
                    <div >
                        <a href="#" class="btn "> <i class="fas fa-plus-circle" style="background-image: linear-gradient(to right,rgb(82, 85, 238),rgb(142, 169, 243));"></i>  Vi???t b??i</a>
                    </div>
                </div>
    
                <div class="phanhoi_container_main">
                    <div class="phanhoi_container_heal Vekteam_container_heal">
                        <ul>
                            <li><a href="#">V??? Kteam</a></li>
                            <li><a href="#">Ng?????i ???ng h???</a></li>
                            <li><a href="#">Li??n h??? - G??p ??</a></li>
                            <li><a href="#">T??i tr???</a></li>
                        </ul>
                     </div>
                     <div class="phanhoi_container_mid">
                                <div class="phanhoi_container_mid_left">
                                        <div class="phanhoi_container_mid_left_heal">
                                            <h3 class="block-title font-w600"><i class="fas fa-paper-plane"></i> G???I TH??NG TIN LI??N H??? - G??P ??</h3>
                                        </div>
                                        <div class="phanhoi_container_mid_left_form">
                                                <p>G??p ?? ho???c li??n h??? cho Kteam n???u b???n c?? nhu c???u v??? d???ch v???, qu???ng c??o ho???c nh???ng th???c m???c kh??c.</p>
                                                <form action="POST">
                                                    <div class="phanhoi_container_mid_left_form_hoten" style="padding-top: 5%;">
                                                        <label for="name">H??? t??n</label> 
                                                        <br> <input class="form_left" type="text" name="name" id="name" placeholder="T??n c???a b???n "> 
                                                    </div>
                                                    <div class="phanhoi_container_mid_left_form_email_dthoai">
                                                                <div class="phanhoi_container_mid_left_form_email">
                                                                    <label for="email">Email</label>
                                                                    <br><input  class="form_left" data-val="true" data-val-email="Email kh??ng h???p l???" data-val-required="Vui l??ng nh???p Email" id="email" name="email" placeholder="Email" type="text">
                                                                </div>
                                                                <div class="phanhoi_container_mid_left_form_dthoai">
                                                                    <label for="email">??i???n tho???i</label>
                                                                    <br><input  class="form_left"  data-val="true" data-val-dthoai="S??? ??i???n tho???i kh??ng h???p l??? " data-val-required="Vui l??ng nh???p s??? ??i???n tho???i" id="dthoai" name="dthoai" placeholder="S??? ??i???n tho???i" type="text">
                                                                </div>
                                                    </div>
                                                    <div class="phanhoi_container_mid_left_form_tieude">
                                                        <label for="email">Ti??u ?????</label>
                                                        <br><input  class="form_left" data-val="true" data-val-tieude="Ti??u ????? kh??ng h???p l???" data-val-required="Vui l??ng nh???p Ti??u ?????" id="tieude" name="tieude" placeholder="Ti??u ?????" type="text">
                                                    </div>
                                                    <div class="phanhoi_container_mid_left_form_noidung">
                                                        <label for="email">N???i dung</label>
                                                        <br><textarea   class="form_left" data-val="true"  data-val-required="Vui l??ng nh???p n???i dung" id="noidung" name="noidung" placeholder="N???i dung" type="text"></textarea>
                                                    </div>
                                                    <div class="phanhoi_container_mid_left_form_button">
                                                            <button class="btn_buttton" type="submit" name="submit" > <i class="fas fa-paper-plane fa-fw"></i> G???i</button>
                                                    </div>
                                                </form>
                                            </div>
                                </div>
                                <div class="phanhoi_container_mid_right">
                                    <div class="phanhoi_container_mid_right_heal">
                                        <h3 class="block-title font-w600"><i class="fa fa-info-circle fa-fw"></i> TH??NG TIN LI??N H??? KH??C</h3>
                                    </div>
                                    <div class="phanhoi_container_mid_right_form">
                                        <p>M???i th??ng tin ????ng g??p ?? ki???n ho???c h??? tr???, ng?????i d??ng c?? th??? li??n h??? tr???c ti???p qua c??c k??nh sau:</p>
                                        <div class="phanhoi_container_mid_right_form_dienthoai">
                                            <i class="fas fa-phone-square fa-fw fa-3x mr-10"></i>
                                            <div class="media-body">
                                                <p >??i???n tho???i</p>
                                                <a href="#">(+84)  865 264 533  (Mr.Ti???n)</a><br>
                                                <a href="#">(+84)  ___ ___ ___  (Mr.Kh??i)</a><br>
                                                <a href="#">(+84)   ___ ___ ___  (Mr.?????t)</a>
                                            </div>
                                        </div>
                                        <div class="phanhoi_container_mid_right_form_email">
                                            <i class="fas fa-envelope-square fa-fw fa-3x mr-10"></i>
                                            <div class="media-body">
                                                <p class="font-w600 m-0">Email</p>
                                                <a href="mailto:tien_1951220088@dau.edu.vn" target="_top">kteamts@gmail.com</a>
                                            </div>
                                        </div>
                                        <div class="phanhoi_container_mid_right_form_page">
                                            <i class="fab fa-facebook-square fa-fw fa-3x mr-10"></i>
                                            <div class="media-body">
                                                <p class="font-w600 m-0">Kteam Page</p>
                                                <a href="#" target="_top">https://www.fb.com/howkteam</a>
                                            </div>
                                        </div>
                                        <div class="phanhoi_container_mid_right_form_group">
                                            <i class="fab fa-facebook-square fa-fw fa-3x mr-10"></i>
                                            <div class="media-body">
                                                <p class="font-w600 m-0">Kteam Group</p>
                                                <a href="#" target="_top">https://www.fb.com/groups/howkteam</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                     </div>
                </div>
            </div>
            <div class="main__thongtin">
                <div class="Thongtincanhan_kteam">
                    <div class="thongtincanhan_top__container">
                            <div class="heal1">
                                <h1> Th??ng tin c?? nh??n</h1>
                            </div>
                            <div >
                                <a href="#" class="btn "> <i class="fas fa-plus-circle" style="background-image: linear-gradient(to right,rgb(82, 85, 238),rgb(142, 169, 243));"></i>  Vi???t b??i</a>
                            </div>
                        </div>
            
            
                    <div class="thongtincanhan_container_main">
                        <!-- menu-lichsu -->
                        <div class="thongtincanhan_t1">
                            <ul>
                                <li><a href="">Gi???i thi???u</a></li>
                                <li><a href="">Kh??a h???c</a></li>
                                <li><a href="">B??i h???c</a></li>
                                <li><a href="">Series</a></li>
                                <li><a href="">B??i vi???t</a></li>
                                <li><a href="">C??u h???i</a></li>
                                <li><a href="">L???ch s???</a></li>
                                <li><a href="">???? l??u</a></li>
                                <li ><a href="">Th??ng b??o</a></li>
                                <li class="t1--caidat"><a href=""><a href="">C??i ?????t</a></li>
                            </ul>
                        </div>
                        <div style="clear: both;"></div>
                        <!-- radio-lichsu -->
                        <div class="thongtincanhan_container_main_mid-LS">
                            <div class="thongtincanhan_container_main_mid_left-LS">
                                <form>
                                    <p><i class="fas fa-cog"></i> C??I ?????T</p>
                                    <ul>
                                        <li><a href=""><i class="fas fa-address-card"></i>  H??? s??</a></li>
                                        <li><a href=""><input type="radio" name=""> ???nh ?????i ??i???n</a></li>
                                        <li><a href=""><input type="radio" name=""> M???t kh???u</a></li>
                                        <li><a href=""><input type="radio" name=""> Email</a></li>
                                    
                                        
                                    </ul>
                                </form>
                            </div>
                            
                            <div class="thongtincanhan_container_main_mid_right-LS">
                                <p>CH???NH S???A H??? S?? C???A B???N</p> <br> 
                                <form action="update_data.php" method="post" enctype="multipart/form-data">
                                    <div class="thongtincanhan_container_right_mid">
                                        <h3 style="font-size: 25px; font-weight: 500; margin-bottom: 1%;" > Th??ng tin c?? b???n </h3>
                                            <hr>
                                        <div class="thongtincanhan_container_right_mid_top">
                                            <div class="thongtincanhan_container_right_mid_top_left">
                                                <h5>Gi???i thi???u ????? m???i ng?????i hi???u th??m v??? b???n. M???t s??? th??ng tin s??? ???????c hi???n th??? c??ng khai.</h5>
                                            </div>
                                            <div class="thongtincanhan_container_right_mid_top_right">
                                                <div class="thongtincanhan_container_right_mid_top_tenhienthi">
                                                    <label for="" class="thongtincanhan_container_right_mid_top_right_chu" > T??n hi???n th???</label>
                                                    <br><input type="text" name="txtTenhienthi" class="frames" placeholder="T??n hi???n th???" value="<?php   if(   mysqli_num_rows($resultt) > 0 ) {       echo $roww["Tenhienthi"];}    ?>">
                                                </div>
                                                <div class="thongtincanhan_container_right_mid_top_ngaysinh">
                                                        <label for="" class="thongtincanhan_container_right_mid_top_right_chu">Ng??y sinh</label>
                                                        <br><input type="date"class="frames" name="txtNgaysinh" id="" placeholder="<?php   if(   mysqli_num_rows($resultt) > 0 ) {       echo $roww["Ngaysinh"];}    ?>">
                                                </div>
                                                <div class="thongtincanhan_container_right_mid_top_gioitinh">
                                                    <label for=""class="thongtincanhan_container_right_mid_top_right_chu"> Gi???i t??nh</label>
                                                    <br> <select name="Gender" id=""class="frames"  value="">
                                                            <option ><?php   if(   mysqli_num_rows($resultt) > 0 ) {       echo $roww["Gioitinh"];} else{ echo "Gi???i t??nh";}     ?></option>
                                                            <option   value="Khong xac dinh"> Kh??ng x??c ?????nh </option>
                                                            <option value="Nam">Nam</option>
                                                            <option value="N???">N???</option>
                                                            <option value="Kh??c">Kh??c</option>
                                                    </select>
                                                </div>
                                                <div class="thongtincanhan_container_right_mid_top_nghenghiep">
                                                        <label for="" class="thongtincanhan_container_right_mid_top_right_chu">Ngh??? nghi???p</label>
                                                        <br><textarea  class="frames" name="txtNghenghiep" id="" cols="30" rows="10" placeholder="Ngh??? nghi???p"> <?php   if(   mysqli_num_rows($resultt) > 0 ) {       echo $roww["Nghenghiep"];} else{ echo "....";} ?></textarea>
                                                </div>
                                                <div class="thongtincanhan_container_right_mid_top_chuyenmon">
                                                    <label for=""class="thongtincanhan_container_right_mid_top_right_chu">K??? n??ng chuy??n m??n</label>
                                                    <br><textarea  class="frames" name="txtChuyenmon" id="" cols="30" rows="10"  placeholder="K??? n??ng chuy??n m??n"><?php   if(   mysqli_num_rows($resultt) > 0 ) {       echo $roww["Kynangchuyenmon"];} else{ echo "....";}     ?></textarea>
                                            </div>
                                            <div class="thongtincanhan_container_right_mid_top_anhdaidien">
                                                <div id="direct_upload" class="min-height-150 d-flex border border-2x border-black-op mb-20">
                                                    <label for="" class="thongtincanhan_container_right_mid_top_right_chu">???nh ?????i di???n</label>
                                                    <br>  
                                                    <span class="thongtincanhan_img-div">
                                                               
                                                                <div class="text-center img-placeholder"  onClick="triggerClick()">
                                                                   
                                                                </div>
                                                                
                                                                
                                                            <img  class="img-user" src="https://code.itptit.com/assets/images/avatar-none.jpeg" onClick="triggerClick()" id="profileDisplay">
                                                            </span>
                                                            <input type="file" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">
                                                        </div>
                                                    
                                                        
                                            </div>
                                            <div class="thongtincanhan_container_right_mid_top_anhdaidien">
                                                <label for="" class="thongtincanhan_container_right_mid_top_right_chu" style="margin-top: 2%;">V??? t??i</label>
                                                <br><textarea  name="editor" class="ckeditor" id="editor" placeholder="V??? t??i"><?php   if(   mysqli_num_rows($resultt) > 0 ) {       echo $roww["Vetoi"];} else{ echo "....";}     ?></textarea>
                                                    <script>
                                                        CKEditor.replace('editor');
                                                    </script>
                                            </div>
                                            </div>
                                        </div>
                                        <h3 style="font-size: 25px; font-weight: 500; margin-bottom: 1%; margin-top: 2%;" > Th??ng tin li??n h??? </h3>
                                        <hr>
                                        <div  class=" thongtincanhan_container_right_mid_bot">
                                        
                                                    <div  class=" thongtincanhan_container_right_mid_bot_left">
                                                            <h5>Th??ng tin ????? m???i ng?????i c?? th??? li??n l???c v???i b???n khi c???n.</h5>
                                                    </div>
                                                    <div class=" thongtincanhan_container_right_mid_bot_right">
                                                            <div  class=" thongtincanhan_container_right_mid_bot_right_sodienthoai">
                                                                    <label for=""  class="thongtincanhan_container_right_mid_bot_right_chu">S??? ??i???n tho???i</label>
                                                                    <br><input type="text" class="frames"  name="txtSodienthoai" id=""placeholder="S??? ??i???n tho???i" value=" <?php   if(   mysqli_num_rows($resultt) > 0 ) {       echo $roww["Sodienthoai"];} else{ echo "S??? ??i???n tho???i";}     ?>">
                                                            </div>
                                                            <div  class=" thongtincanhan_container_right_mid_bot_right_diachi">
                                                                <label for="" class="thongtincanhan_container_right_mid_bot_right_chu" >?????a ch???</label>
                                                                <br><input type="text"  class="frames" name="txtDiachi" id=""  placeholder="?????a ch???" value=" <?php   if(   mysqli_num_rows($resultt) > 0 ) {       echo $roww["Diachi"];} else{ echo "?????a ch???";}     ?>">
                                                        </div>
                                                        <div  class=" thongtincanhan_container_right_mid_bot_right_website">
                                                            <label for="" class="thongtincanhan_container_right_mid_bot_right_chu"  >Website</label>
                                                            <br>
                                                            <div class="Thongtincanhan_containner_right_mid_bot_iconnnn">
                                                                <span class="input-group-text">
                                                                    <i class="fas fa-link"></i>
                                                                    </span>
                                                                <input type="text"  class="frames" name="txtWebsite" id="" placeholder="Website" value="<?php   if(   mysqli_num_rows($resultt) > 0 ) {       echo $roww["Website"];} else{ echo "Website";}     ?>">
                                                            </div>
                                                        </div>
                                                    <div  class=" thongtincanhan_container_right_mid_bot_right_facebook" >
                                                        <label for="" class="thongtincanhan_container_right_mid_bot_right_chu"   >Facebook</label>
                                                        <br>
                                                            <div style="display: flex;">
                                                                <span class="input-group-text">
                                                                    <i class="fab fa-facebook-f"></i>
                                                                    </span>
                                                                <input type="text"  class="frames" name="txtFacebook" id=""  placeholder="Facebook" value="<?php   if(   mysqli_num_rows($resultt) > 0 ) {       echo $roww["Facebook"];} else{ echo "Facebook";}     ?>"> 
                                                            </div>
                                                    </div>
                                                    <div  class=" thongtincanhan_container_right_mid_bot_right_email">
                                                        <label for="" class="thongtincanhan_container_right_mid_bot_right_chu" >Email</label>
                                                        <br><div  style="display: flex;" >
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-envelope"></i>
                                                                        </span>
                                                                    <input type="text"  class="frames" name="txtEmail" id="" placeholder="Email" value="<?php   if(   mysqli_num_rows($resultt) > 0 ) {       echo $roww["Email"];} else{ echo "Email";}     ?>"> 
                                                        </div>
                                                </div>
                                                
                                        </div>
                                        

                                    </div>
                                    <button id="btn_savethongtin" name="submit_savethongtin" class="button">
                                        <i class="fas fa-save"></i>  L??u thay d???i
                                        </button>

                                </form>
                            </div>
                        </div>

                    

                    </div>     
                </div>
            </div>

        </div>



        <div class="footer">

            <div class="mid_container_foot">
                <div class="pagination-container wow zoomIn mar-b-1x" data-wow-duration="0.5s">
                    <ul class="pagination">
                        <li class="pagination-item--wide first"> <a class="pagination-link--wide first"
                                href="#">Previous</a> </li>
                        <li class="pagination-item first-number"> <a class="pagination-link" href="#">1</a> </li>
                        <li class="pagination-item"> <a class="pagination-link" href="#">2</a> </li>
                        <li class="pagination-item"> <a class="pagination-link" href="#">3</a> </li>
                        <li class="pagination-item"> <a class="pagination-link" href="#">4</a> </li>
                        <li class="pagination-item"> <a class="pagination-link" href="#">5</a> </li>
                        <li class="pagination-item--wide last"> <a class="pagination-link--wide last" href="#">Next</a>
                        </li>
                    </ul>

                </div>
            </div>

            <div class="container__footer">
                <div class="logo">
                    <img class="img-logo" src="https://www.howkteam.vn/Content/images/logo/kteam_purple_200x90.png"
                        alt="">
                </div>

                <div class="colum">
                    <div class="colum1">
                        <p>Th??ng tin Kteam</p>
                        <ul>
                            <li><a href="#">V??? Kteam</a></li>
                            <li><a href="#">D???ch v???</a></li>
                            <li><a href="#">Li??n h???</a></li>
                        </ul>
                        <p>????ng g??p t??? c???ng ?????ng</p>
                        <ul>
                            <li><a href="#">T??i tr???</a></li>
                            <li><a href="#">Ng?????i ???ng h???</a></li>
                        </ul>
                    </div>
                    <div class="colum2">
                        <p>L??nh v???c</p>
                        <ul>
                            <li><a href="#">L???p tr??nh</a></li>
                            <li><a href="#">Microsoft Office 2016</a></li>
                            <li><a href="#">IT & Ph???n m???m</a></li>
                            <li><a href="#">????? h???a h??nh ???nh </a></li>
                            <li><a href="#">Kinh t???</a></li>
                            <li><a href="#">Ngo???i ng???</a></li>
                            <li><a href="#">K??? N??ng m???m </a></li>
                            <li><a href="#">Tin t???c</a></li>
                        </ul>
                    </div>
                    <div class="colum3">
                        <p>Kh??a h???c</p>
                        <ul>
                            <li><a href="#"> Microsoft Word 2016</a></li>
                            <li><a href="#">Microsoft Excel 2016</a></li>
                            <li><a href="#">Microsoft PowerPoint 2016</a></li>
                            <li><a href="#">Kh??a h???c l???p tr??nh Android c?? b???n </a></li>
                            <li><a href="#">G??c l???p tr??nh vi??n</a></li>
                            <li><a href="#">D??nh cho ng?????i m???i</a></li>
                            <li><a href="#">H?????ng d???n c??i ?????t </a></li>
                            <li><a href="#">Th??? thu???t m??y t??nh</a></li>
                            <li><a href="#">Xem th??m...</a></li>
                        </ul>
                    </div>
                    <div class="colum4">
                        <p>C???ng ?????ng</p>
                        <ul>
                            <li><a href="#"> H???i ????p</a></li>
                            <li><a href="#">T??i li???u </a></li>
                            <li><a href="#">Chi???n d???ch</a></li>
                        </ul>
                        <p>Li??n k???t</p>
                        <ul>
                            <li><a href="#"> Vted - H???c to??n online ch???t l?????ng cao</a></li>
                            <li><a href="#"> L???p tr??nh VB.NET</a></li>
                            <li><a href="#"> Linux Team Vi???t Nam</a></li>
                        </ul>
                    </div>
                    <div class="colum5">
                        <p>K???t n???i Kteam</p>
                        <p>K???t n???i v???i Kteam qua m???ng x?? h???i</p>
                        <div class="icon">
                            <a href="https://www.facebook.com/datbe.us">
                                <i class="icon-facebook fab fa-facebook-square"></i>
                            </a>
                            <a href="#">
                                <i class="icon-youtube fab fa-youtube-square"></i>
                            </a>
                        </div>
                        <p>Ch???ng nh???n</p>
                        <img src="https://images.dmca.com/Badges/dmca-badge-w150-5x1-01.png?ID=69d56ff4-063f-4275-811c-3338b7e3d82e"
                            alt="">
                    </div>
                </div>
                <hr>
                <div class="mb-10">
                    <span>Howkteam ?? 2021</span>
                </div>

            </div>

        </div>

    </div>
    </div>
    
    <!-- Start Learn -->
    <div class="page">
        <div class="main__page">
            <div class="header_learn">
                <a href="#" class="content">
                    <i class="fas fa-book"></i>
                    N???i dung
                </a>
                <button class="icon-close js-close">
                    <i class="close-icon fas fa-times"></i>
                </button>
            </div>
            <div class="container__learn">
                <div class="list_learn">
                    <div class="title">
                        <i class="fas fa-fw fa-list"></i>
                        <p>Danh s??ch b??i gi???ng </p>
                    </div>
                    <div class="lesson">
                        <div class="search">
                            <input type="text" placeholder="T??m b??i h???c...">
                            <button class="btn_search">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        <p>
                            <i class="fas fa-fw fa-list"></i>
                            Nh???p xu???t c?? b???n
                        </p>
                        <ul class="nav">
                            <li>
                                <span>01. T??nh v?? hi???n th??? ra m??n h??nh t???ng hai s??? nguy??n b???t k???</span>
                            </li>
                            <li>
                                <span>02. T??nh t???ng hai s??? nguy??n b???t k??? (C?? x??? l?? ngoai l??? ?????u v??o).</span>
                            </li>
                            <li>
                                <span>03. Hi???n th??? t??? c??ch nhau b???i k?? t??? "--" ra m??n h??nh </span>
                            </li>
                            <li>
                                <span>04. Nh???p s??? b??t k??? ??? h??? th???p ph??n v?? hi???n th??? ra h??? b??t ph??n.</span>
                            </li>
                            <li>
                                <span>05. Nh???p s??? b??t k??? ??? h??? th???p ph??n v?? hi???n th??? ra h??? b??t ph??n.(C?? x??? l?? ngo???i l???
                                    ?????u v??o) </span>
                            </li>
                            <li>
                                <span>06. L??m tr??n ch??? s??? th???p ph??n A ?????n B sau d???u ph???y </span>
                            </li>
                            <li>
                                <span>07. L??m tr??n ch??? s??? th???p ph??n A ?????n B sau d???u ph???y.(C?? x??? l?? ngo???i l??? ?????u v??o)
                                </span>
                            </li>
                            <li>
                                <span>08. Nh???p v?? t??nh t???ng d??y s??? nguy??n b???t k??? c??ch nhau b???i kho???ng tr???ng (C?? x??? l??
                                    ngo???i l??? ?????u v??o) </span>
                            </li>
                            <li>
                                <span>09.Nh???p t??? file input {t??n}, {tu???i hi???n t???i} v?? xu???t ra file output theo m???u
                                </span>
                            </li>
                            <li>
                                <span>10.Nh???p t??? file input {t??n}, {tu???i hi???n t???i} v?? xu???t ra file output theo m???u (C??
                                    x??? l?? ?????nh d???ng ?????u v??o)</span>
                            </li>
                            <li>
                                <span>11. T??nh v?? hi???n th??? ra m??n h??nh t???ng hai s?? nguy??n b???t k??? </span>
                            </li>
                            <li>
                                <span>12. Xu???t file output tr??n 1 d??ng t??? chu???i input b???t k??? nh???p v??o t??? nhi???u d??ng (C??
                                    x??? l?? ngo???i l??? ?????u v??o) </span>
                            </li>
                            <li>
                                <span>13. Nh???p t??n, chi???u cao v?? so s??nh chi???u cao (cm) c???a hai b???n </span>
                            </li>
                            <li>
                                <span>14. Nh???p t??n, chi???u cao v?? so s??nh chi???u cao c???a hai b???n (C?? x??? l?? ngo???i l??? ?????u
                                    v??o) </span>
                            </li>
                            <li>
                                <span>15. Nh???p v?? ki???m tra ba s??? a, b, c c?? l?? c???nh c???a m???t tam gi??c kh??ng? </span>
                            </li>
                            <li>
                                <span>16. Nh???p v?? ki???m tra ba s??? a, b, c c?? l?? c???nh c???a m???t tam gi??c kh??ng? (C?? x??? l??
                                    ngo???i l??? ?????u v??o) </span>
                            </li>
                            <li>
                                <span>17. T??nh v?? xu???t k???t qu??? m??y t??nh ????n gi???n v???i hai s??? </span>
                            </li>
                            <li>
                                <span>18. Gi???i ph????ng tr??nh b???c hai</span>
                            </li>
                            <li>
                                <span>19. Gi???i ph????ng tr??nh b???c hai (C?? x??? l?? ngo???i l??? ?????u v??o) </span>
                            </li>
                            <li>
                                <span>20. Nh????p file input va?? xa??c ??i??nh loa??i tam gia??c </span>
                            </li>
                            <li>
                                <span>21. T??nh t???ng c??c s??? nguy??n trong kho???ng a ?????n b. (V??ng l???p while) </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="video_learn">
                    <div class="video_learn--link">
                        <iframe width="100%" height="100%"
                            src="https://www.youtube.com/embed/NZj6LI5a9vc?list=PL33lvabfss1xczCv2BA0SaNJHu_VXsFtg"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Learn -->
    

    
    <script>
        const Learns = document.querySelectorAll('.js-btn-learn');
        const Close_learn = document.querySelector('.js-close');
        const Page = document.querySelector('.page');
        const Main = document.querySelector('.main');

        function showLearn(){
            Main.style.display = 'none';
            Page.style.display = 'block';
        }
        
        for(const Learn of Learns){
            Learn.addEventListener('click', showLearn);
        }

        
        // Learns.onclick = function () {
        //     console.log("ghg");
        //     Page.style.display = 'block';
        //     Main.style.display = 'none';
        // }
        Close_learn.onclick = function () {
            Page.style.display = 'none';
            Main.style.display = 'block';
        }
    </script>

    <script>
         function showErrorToast() {
                toast({
                title: "Th???t b???i!",
                message: "H??? th???ng ??ang n??ng c???p , h???n g???p b???n v??o d???p kh??c",
                type: "error",
                duration: 5000
                });
             }
    </script>

    <script>
            const Lichsu = document.getElementById('lichsu');
            const Daluu = document.getElementById('daluu');
            const Khoahoc = document.getElementById('khoahoc');
            const Hoidap = document.getElementById('hoidap');
            const Baiviet = document.getElementById('baiviet');
            const Thongtin=document.getElementById('js-Thongtincanhan');

            const Kter = document.getElementById('kter');
            const Kteam = document.getElementById('kteam');
            const Taitro = document.getElementById('taitro');
            const Phanhoi = document.getElementById('phanhoi');
          



            const Main_Thongtincanhan = document.querySelector('.Thongtincanhan_kteam');
            const Main_Lichsu = document.querySelector('.main__lichsu');
            const Main_Daluu = document.querySelector('.main__daluu');
            const Body = document.querySelector('.body__container');
            const Main_Hoidap = document.querySelector('.main__hoidap');
            const Main_Baiviet = document.querySelector('.main__baiviet');
          const Main_Thongtin =document.querySelector('.main__thongtin')
            const Main_Kter = document.querySelector('.main__kter');
            const Main_Kteam = document.querySelector('.main__kteam');
            const Main_Taitro = document.querySelector('.main__taitro');
            const Main_Phanhoi = document.querySelector('.main__phanhoi');
            Lichsu.onclick = function () {
                None(Main_Daluu);
                None(Body);
                None(Main_Hoidap);
                None(Main_Baiviet);
                None(Main_Thongtin)
                None(Main_Kteam);
                None(Main_Kter);
                None(Main_Taitro);
                None(Main_Phanhoi);
                Block(Main_Lichsu);

                cssbgr(Lichsu);
                nocss(Daluu);
                nocss(Khoahoc);
                nocss(Baiviet);
                nocss(Thongtin)
                nocss(Hoidap)
                nocss(Kter)
                nocss(Kteam)
                nocss(Taitro)
                nocss(Phanhoi)
            }
            Thongtin.onclick = function () {
                None(Main_Lichsu);
                None(Main_Daluu);
                None(Body);
                None(Main_Hoidap)
                None(Main_Baiviet);
                None(Main_Kteam);
                None(Main_Kter);
                None(Main_Taitro);
                None(Main_Phanhoi);
                Block(Main_Thongtin);
                Block(Main_Thongtincanhan);
              
            }

            Daluu.onclick = function () {
                None(Body);
                None(Main_Lichsu);
                None(Main_Hoidap);
                None(Main_Thongtin)
                None(Main_Baiviet);
                None(Main_Kter);
                None(Main_Kteam);
                None(Main_Taitro);
                None(Main_Phanhoi);
                Block(Main_Daluu);

                cssbgr(Daluu);
                nocss(Lichsu);
                nocss(Khoahoc);
                nocss(Baiviet);
                nocss(Thongtin)
                nocss(Hoidap);
                nocss(Kteam);
                nocss(Kter);
                nocss(Taitro)
                nocss(Phanhoi)

            }

            Khoahoc.onclick = function () {
                None(Main_Lichsu);
                None(Main_Daluu);
                None(Main_Hoidap)
                None(Main_Thongtin)
                None(Main_Kteam);
                None(Main_Kter);
                None(Main_Baiviet);
                None(Main_Taitro);
                None(Main_Phanhoi);
                Block(Body);

                cssbgr(Khoahoc);
                nocss(Lichsu);
                nocss(Daluu);
                nocss(Baiviet);
                nocss(Thongtin)
                nocss(Hoidap);
                nocss(Kter);
                nocss(Kteam);
                nocss(Taitro)
                nocss(Phanhoi)

            }
            Hoidap.onclick = function () {
                None(Main_Lichsu);
                None(Main_Daluu);
                None(Body);
                None(Main_Thongtin)
                None(Main_Baiviet);
                None(Main_Kteam);
                None(Main_Kter);
                None(Main_Taitro);
                None(Main_Phanhoi);
                Block(Main_Hoidap);

                cssbgr(Hoidap);
                nocss(Lichsu);
                nocss(Daluu);
                nocss(Khoahoc);
                nocss(Thongtin)
                nocss(Baiviet);
                nocss(Kter);
                nocss(Kteam);
                nocss(Taitro)
                nocss(Phanhoi)
            }
            Baiviet.onclick = function () {
                None(Main_Lichsu);
                None(Main_Daluu);
                None(Body);
                None(Main_Thongtin)
                None(Main_Hoidap);
                None(Main_Kteam);
                None(Main_Kter);
                None(Main_Taitro);
                None(Main_Phanhoi);
                Block(Main_Baiviet);

                cssbgr(Baiviet);
                nocss(Lichsu);
                nocss(Daluu);
                nocss(Khoahoc);
                nocss(Hoidap);
                nocss(Thongtin)
                nocss(Kter);
                nocss(Kteam);
                nocss(Taitro)
                nocss(Phanhoi)
            }
            
            Kter.onclick = function () {
                None(Main_Lichsu);
                None(Main_Daluu);
                None(Body);
                None(Main_Hoidap)
                None(Main_Baiviet);
                None(Main_Thongtin)
                None(Main_Kteam);
                None(Main_Taitro);
                None(Main_Phanhoi);
                Block(Main_Kter);

                cssbgr(Kter);
                nocss(Kteam)
                nocss(Thongtin)
                nocss(Baiviet);
                nocss(Lichsu);
                nocss(Daluu);
                nocss(Khoahoc);
                nocss(Hoidap);
                nocss(Taitro)
                nocss(Phanhoi)
            }
            Kteam.onclick = function () {
                None(Main_Lichsu);
                None(Main_Daluu);
                None(Body);
                None(Main_Hoidap)
                None(Main_Baiviet);
                None(Main_Thongtin)
                None(Main_Kter)
                None(Main_Taitro);
                None(Main_Phanhoi);
                Block(Main_Kteam);

                cssbgr(Kteam);
                nocss(Thongtin)
                nocss(Kter);
                nocss(Baiviet);
                nocss(Lichsu);
                nocss(Daluu);
                nocss(Khoahoc);
                nocss(Hoidap);
                nocss(Taitro)
                nocss(Phanhoi)
            }
            Taitro.onclick = function(){
                None(Main_Lichsu);
                None(Main_Daluu);
                None(Body);
                None(Main_Hoidap)
                None(Main_Baiviet);
                None(Main_Thongtin)
                None(Main_Kter)
                None(Main_Kteam);
                None(Main_Phanhoi);
                Block(Main_Taitro);

                cssbgr(Taitro);
                nocss(Thongtin)
                nocss(Kter);
                nocss(Baiviet);
                nocss(Lichsu);
                nocss(Daluu);
                nocss(Khoahoc);
                nocss(Hoidap);
                nocss(Kteam)
                nocss(Phanhoi)
            }
            Phanhoi.onclick = function(){
                None(Main_Lichsu);
                None(Main_Daluu);
                None(Body);
                None(Main_Hoidap)
                None(Main_Baiviet);
                None(Main_Thongtin)
                None(Main_Kter)
                None(Main_Kteam);
                None(Main_Taitro);
                Block(Main_Phanhoi);

                cssbgr(Phanhoi);
                nocss(Thongtin)
                nocss(Baiviet);
                nocss(Lichsu);
                nocss(Daluu);
                nocss(Khoahoc);
                nocss(Hoidap);
                nocss(Kteam)
                nocss(Taitro)
            }
            function nocss(e) {
                e.style.backgroundColor = '#343a40';
                e.style.borderLeft = 'none';
                e.style.color = ' #959a9e';
            }

            function cssbgr(e) {
                e.style.backgroundColor = '#2d3238';
                e.style.borderLeft = '3px solid#4095da';
                e.style.color = '#4095da';
            }

            function Block(e) {
                e.style.display = 'block';
            }
            function None(e) {
                e.style.display = 'none';
            }
        </script>
</body>

</html>