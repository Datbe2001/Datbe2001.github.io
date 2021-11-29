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
                    <a href="#">LỊCH SỬ</a>
                </li>
                <li id="daluu">
                    <i class="icon-clok far fa-bookmark"></i>
                    <a href="#">ĐÃ LƯU</a>
                </li>

                <div class="list-page">
                    <h1>PAGES</h1>
                </div>

                <li id="khoahoc">
                    <i class="icon-clok fas fa-book-open"></i>
                    <a href="#">KHÓA HỌC</a>
                </li>
                <li id="hoidap">
                    <i class="icon-clok far fa-question-circle"></i>
                    <a href="#">HỎI ĐÁP</a>
                </li>
                <li id="baiviet">
                    <i class="icon-clok far fa-file"></i>
                    <a href="#">BÀI VIẾT</a>
                </li>
                <li id="kter">
                    <i class="icon-clok fas fa-users"></i>
                    <a href="#">KTER</a>
                </li>
                <li id="kteam">
                    <i class="icon-clok fas fa-info-circle"></i>
                    <a href="#">VỀ KTEAM</a>
                </li>
                <li id="taitro">
                    <i class="icon-clok fas fa-mug-hot"></i>
                    <a href="#">TÀI TRỢ</a>
                </li>
                <li id="phanhoi">
                    <i class="icon-clok far fa-clipboard"></i>
                    <a href="#">PHẢN HỒI</a>
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
                        <img width="30px" class="img-user" onclick="function_menu()" src="<?php  if(   mysqli_num_rows($resultt) > 0 ) {  echo './images/' . $roww['Anhdaidien'] ;} else{ echo "https://code.itptit.com/assets/images/avatar-none.jpeg";}?>" alt="ảnh user">
                                    <div class="icon_noidung_menu_user" id="icon_noidung_menu_user">
                                                <a href="#" id="js-Thongtincanhan" > <i class="far fa-user" ></i> Thông tin cá nhân</a>
                                                <form class="logout__container"  action="logout_out.php" action="" method="POST">
                                                 <button name="submit_logout" class="submit_logout"> <i class="fas fa-sign-out-alt"></i> Đăng xuất</button>
                                                </form>
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End header container -->
            
            <div class="body__container">
                <div class="top__container">
                    <h1>Tất cả khóa học</h1>
                    <p>Hàng trăm khóa học miễn phí được xây dựng bởi Kteam và cộng đồng !</p>
                </div>

                <div class="mid__container">

                    <!-- Start mid container navbar -->
                    <div class="mid__container--navbar">

                        <div class="homepage">
                            <a href=""><i class=" fas fa-home"></i></a>
                            <i class=" icon__chevron-right fas fa-chevron-right"></i>
                            <span class="">Khóa học</span>
                        </div>
                        <div class="input-group">
                            <input class="input" type="text" placeholder="Tìm khóa học...">
                            <div class="input-search">
                                <span   onclick="showErrorToast();">
                                    <i class="icon-search fas fa-search"></i>
                                </span>
                            </div>
                        </div>

                        <div class="content">
                            <div class="content__course">
                                <i class="icon-book fas fa-book-open"></i>
                                <span>Khóa học</span>
                            </div>
                            <div class="content__button">
                                <button class="btn-course">
                                    Chủ đề
                                    <strong class="btn__number">8</strong>
                                    <i class="fas fa-angle-down"></i>
                                </button>
                                <button class="btn-course">
                                    Danh mục
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
                                        Giới thiệu
                                    </div>
                                    <button class="options__img-link js-btn-learn">
                                        <div class="options__img-introduce options__img-introduce--icon-play">
                                            <i class="far fa-play-circle"></i>
                                            Học ngay
                                        </div>
                                    </button>
                                </div>

                            </div>
                            <div class="block-content">
                                <h4 title="Cấu trúc dữ liệu và giải thuật">
                                    <a href="">Cấu trúc dữ liệu và giải thuật</a>
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
                                    bài học
                                </div>
                                <div class="view">
                                    <i class="far fa-eye"></i>
                                    <strong>12.032</strong>
                                    lượt xem
                                </div>
                            </div>
                            <div class="author">
                                <span>Tác giả/Dịch giả:</span>
                                <img class=" img-user img-user__author" src="font/img/datbe.jpg" alt="ảnh user">
                            </div>
                        </div>
                        <div class="item-course">
                            <div class="options">
                                <img src="https://o.rada.vn/data/image/2019/12/23/khoa-hoc-Python.jpg" alt="">
                                <div class="options__img">
                                    <div class="options__img-introduce options__img-introduce--icon-video">
                                        <i class="fas fa-video"></i>
                                        Giới thiệu
                                    </div>
                                    <button class="options__img-link js-btn-learn">
                                        <div class="options__img-introduce options__img-introduce--icon-play">
                                            <i class="far fa-play-circle"></i>
                                            Học ngay
                                        </div>
                                    </button>
                                </div>

                            </div>
                            <div class="block-content">
                                <h4 title="Bài tập Python tự luyện">
                                    <a href="">Bài tập Python tự luyện</a>
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
                                    bài học
                                </div>
                                <div class="view">
                                    <i class="far fa-eye"></i>
                                    <strong>1.236.032</strong>
                                    lượt xem
                                </div>
                            </div>
                            <div class="author">
                                <span>Tác giả/Dịch giả:</span>
                                <img class=" img-user img-user__author" src="font/img/datbe.jpg" alt="ảnh user">
                            </div>
                        </div>
                        <div class="item-course">
                            <div class="options">
                                <img src="https://codebugaz.files.wordpress.com/2019/12/learning-web-development-1024x582-1.jpg"
                                    alt="">
                                <div class="options__img">
                                    <div class="options__img-introduce options__img-introduce--icon-video">
                                        <i class="fas fa-video"></i>
                                        Giới thiệu
                                    </div>
                                    <button class="options__img-link js-btn-learn">
                                        <div class="options__img-introduce options__img-introduce--icon-play">
                                            <i class="far fa-play-circle"></i>
                                            Học ngay
                                        </div>
                                    </button>
                                </div>

                            </div>
                            <div class="block-content">
                                <h4 title="Lập trình Front End cơ bản với website Landing Page">
                                    <a href="">Lập trình Front End cơ bản với website Landing Page</a>
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
                                    bài học
                                </div>
                                <div class="view">
                                    <i class="far fa-eye"></i>
                                    <strong>236.032</strong>
                                    lượt xem
                                </div>
                            </div>
                            <div class="author">
                                <span>Tác giả/Dịch giả:</span>
                                <img class=" img-user img-user__author" src="font/img/datbe.jpg" alt="ảnh user">
                            </div>
                        </div>
                        <div class="item-course">
                            <div class="options">
                                <img src="https://saigonlab.edu.vn/upload/default/images/KHO%C3%81%20H%E1%BB%8CC%20CEH%20QR.jpg"
                                    alt="">
                                <div class="options__img">
                                    <div class="options__img-introduce options__img-introduce--icon-video">
                                        <i class="fas fa-video"></i>
                                        Giới thiệu
                                    </div>
                                    <button class="options__img-link js-btn-learn">
                                        <div class="options__img-introduce options__img-introduce--icon-play">
                                            <i class="far fa-play-circle"></i>
                                            Học ngay
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
                                    bài học
                                </div>
                                <div class="view">
                                    <i class="far fa-eye"></i>
                                    <strong>26.520</strong>
                                    lượt xem
                                </div>
                            </div>
                            <div class="author">
                                <span>Tác giả/Dịch giả:</span>
                                <img class=" img-user img-user__author" src="font/img/datbe.jpg" alt="ảnh user">
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
                                        Giới thiệu
                                    </div>
                                    <button class="options__img-link js-btn-learn">
                                        <div class="options__img-introduce options__img-introduce--icon-play">
                                            <i class="far fa-play-circle"></i>
                                            Học ngay
                                        </div>
                                    </button>
                                </div>

                            </div>
                            <div class="block-content">
                                <h4 title="Khóa học lập trình C++ căn bản">
                                    <a href="">Khóa học lập trình C++ căn bản</a>
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
                                    bài học
                                </div>
                                <div class="view">
                                    <i class="far fa-eye"></i>
                                    <strong>1.652.032</strong>
                                    lượt xem
                                </div>
                            </div>
                            <div class="author">
                                <span>Tác giả/Dịch giả:</span>
                                <img class=" img-user img-user__author" src="font/img/datbe.jpg" alt="ảnh user">
                            </div>
                        </div>
                        <div class="item-course">
                            <div class="options">
                                <img src="https://cafedev.vn/wp-content/uploads/2020/11/cafedev_front_end_back_end_blog.png"
                                    alt="">
                                <div class="options__img">
                                    <div class="options__img-introduce options__img-introduce--icon-video">
                                        <i class="fas fa-video"></i>
                                        Giới thiệu
                                    </div>
                                    <button class="options__img-link js-btn-learn">
                                        <div class="options__img-introduce options__img-introduce--icon-play">
                                            <i class="far fa-play-circle"></i>
                                            Học ngay
                                        </div>
                                    </button>
                                </div>

                            </div>
                            <div class="block-content">
                                <h4 title="Lập trình Back End cơ bản với website Landing Page">
                                    <a href="">Lập trình Back End cơ bản với website Landing Page</a>
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
                                    bài học
                                </div>
                                <div class="view">
                                    <i class="far fa-eye"></i>
                                    <strong>236.032</strong>
                                    lượt xem
                                </div>
                            </div>
                            <div class="author">
                                <span>Tác giả/Dịch giả:</span>
                                <img class=" img-user img-user__author" src="font/img/datbe.jpg" alt="ảnh user">
                            </div>
                        </div>
                        <div class="item-course">
                            <div class="options">
                                <img src="https://nguyenvanhieu.vn/wp-content/uploads/2020/01/lap-trinh-java-1.jpg"
                                    alt="">
                                <div class="options__img">
                                    <div class="options__img-introduce options__img-introduce--icon-video">
                                        <i class="fas fa-video"></i>
                                        Giới thiệu
                                    </div>
                                    <button class="options__img-link js-btn-learn">
                                        <div class="options__img-introduce options__img-introduce--icon-play">
                                            <i class="far fa-play-circle"></i>
                                            Học ngay
                                        </div>
                                    </button>
                                </div>

                            </div>
                            <div class="block-content">
                                <h4 title="Lập trình Java cơ bản đến hướng đối tượng">
                                    <a href="">Lập trình Java cơ bản đến hướng đối tượng</a>
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
                                    bài học
                                </div>
                                <div class="view">
                                    <i class="far fa-eye"></i>
                                    <strong>2.630.032</strong>
                                    lượt xem
                                </div>
                            </div>
                            <div class="author">
                                <span>Tác giả/Dịch giả:</span>
                                <img class=" img-user img-user__author" src="font/img/datbe.jpg" alt="ảnh user">
                            </div>
                        </div>
                        <div class="item-course">
                            <div class="options">
                                <img src="https://antrandigital.com/wp-content/uploads/2020/07/share-khoa-hoc-javascript-antrandigital.jpg"
                                    alt="">
                                <div class="options__img">
                                    <div class="options__img-introduce options__img-introduce--icon-video">
                                        <i class="fas fa-video"></i>
                                        Giới thiệu
                                    </div>
                                    <button class="options__img-link js-btn-learn">
                                        <div class="options__img-introduce options__img-introduce--icon-play">
                                            <i class="far fa-play-circle"></i>
                                            Học ngay
                                        </div>
                                    </button>
                                </div>

                            </div>
                            <div class="block-content">
                                <h4 title="Sổ tay Javascrips">
                                    <a href="">Sổ tay Javascrips</a>
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
                                    bài học
                                </div>
                                <div class="view">
                                    <i class="far fa-eye"></i>
                                    <strong>60.032</strong>
                                    lượt xem
                                </div>
                            </div>
                            <div class="author">
                                <span>Tác giả/Dịch giả:</span>
                                <img class=" img-user img-user__author" src="font/img/datbe.jpg" alt="ảnh user">
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
                                Viết bài</a>
                        </div>
                    </div>
                    <div class="container_main">
                        <!-- menu-lichsu -->
                        <div class="t1">
                            <ul>
                                <li><a href="">Giới thiệu</a></li>
                                <li><a href="">Khóa học</a></li>
                                <li><a href="">Bài học</a></li>
                                <li><a href="">Series</a></li>
                                <li><a href="">Bài viết</a></li>
                                <li><a href="">Câu hỏi</a></li>
                                <li class="t1--lichsu"><a href="">Lịch sử</a></li>
                                <li><a href="">Đã lưu</a></li>
                                <li><a href="">Thông báo</a></li>
                                <li><a href="">Cài đặt</a></li>
                            </ul>
                        </div>
                        <div style="clear: both;"></div>
                        <!-- radio-lichsu -->
                        <div class="container_main_mid-LS">
                            <div class="container_main_mid_left-LS">
                                <form>
                                    <p><i class="fa fa-filter" aria-hidden="true"></i> LỌC THEO</p>
                                    <ul>
                                        <li><a href=""><input type="radio" name=""> Tất cả</a></li>
                                        <li><a href=""><input type="radio" name=""> Khóa học</a></li>
                                        <li><a href=""><input type="radio" name=""> Bài học</a></li>
                                        <li><a href=""><input type="radio" name=""> Bài viết</a></li>
                                        <li><a href=""><input type="radio" name=""> Câu hỏi</a></li>
                                        <li><a href=""><input type="radio" name=""> Series</a></li>
        
                                        <div>
                                            <li class="xoalichsu"><a class="a-xoals" href=""><i class="fa fa-trash"
                                                        aria-hidden="true"></i> Xóa lịch sử</a></li>
                                        </div>
                                    </ul>
                                </form>
                            </div>
        
                            <div class="container_main_mid_right-LS">
                                <p>LỊCH SỬ XEM</p> <br>
                                <h5>Không có lịch sử gần đây.</h5>
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
                                Viết bài</a>
                        </div>
                    </div>
                    <div class="container_main">
                        <!-- menu-lichsu -->
                        <div class="t1">
                            <ul>
                                <li><a href="">Giới thiệu</a></li>
                                <li><a href="">Khóa học</a></li>
                                <li><a href="">Bài học</a></li>
                                <li><a href="">Series</a></li>
                                <li><a href="">Bài viết</a></li>
                                <li><a href="">Câu hỏi</a></li>
                                <li><a href="">Lịch sử</a></li>
                                <li class="t1--daluu"><a href="">Đã lưu</a></li>
                                <li><a href="">Thông báo</a></li>
                                <li><a href="">Cài đặt</a></li>
                            </ul>
                        </div>
                        <div style="clear: both;"></div>
                        <!-- radio-lichsu -->
                        <div class="container_main_mid-LS">
                            <div class="container_main_mid_left-LS">
                                <form>
                                    <p><i class="fa fa-filter" aria-hidden="true"></i> LỌC THEO</p>
                                    <ul>
                                        <li><a href=""><input type="radio" name=""> Tất cả</a></li>
                                        <li><a href=""><input type="radio" name=""> Khóa học</a></li>
                                        <li><a href=""><input type="radio" name=""> Bài học</a></li>
                                        <li><a href=""><input type="radio" name=""> Bài viết</a></li>
                                        <li><a href=""><input type="radio" name=""> Câu hỏi</a></li>
                                        <li><a href=""><input type="radio" name=""> Series</a></li>
        
                                        <div>
                                            <li class="xoalichsu"><a class="a-xoals" href=""><i class="fa fa-trash"
                                                        aria-hidden="true"></i> Xóa lịch sử</a></li>
                                        </div>
                                    </ul>
                                </form>
                            </div>
        
                            <div class="container_main_mid_right-LS">
                                <p>MỤC ĐÃ LƯU</p> <br>
                                <h5>Không có mục đã lưu</h5>
                            </div>
                        </div>
        
                    </div>
                </div>
            </div>

            

            <div class="main__hoidap">
                    <div class="hoidap">
                            <div class="hoidap_top__container">
                                <div class="heal1">
                                    <h1> Hỏi đáp</h1>
                                <p>Chia sẻ kiến thức, cùng nhau phát triển</p>
                                </div>
                                <div >
                                    <a href="#" class="btn "> <i class="fas fa-plus-circle" style="background-image: linear-gradient(to right,rgb(82, 85, 238),rgb(142, 169, 243));"></i>  Viết bài</a>
                                </div>
                            </div>

           
                            <div class="hoidap_container_main">
                                <div class="hoidap_t1">
                                    <i class="fas fa-home" style="color: rgb(17, 0, 253);"> </i>
                                    <span class="breadcrumb-item active"> >  Hỏi đáp</span>
                                </div>

                                
                                <div class="hoidap_mid__container">
                                    <div class="hoidap_mid_container_mid">
                                        <div class="hoidap_mid__container_menu">
                                            <div class="hoidap_menu123">
                                                <ul>
                                                    <li class="js-tab"><a href="">Tất cả</a></li>
                                                    <li class="js-tab"><a href="">Quan tâm</a></li>
                                                    <li class="js-tab"><a href="">Câu hỏi của tôi</a></li>
                                                    <li>
                                                        <div class="hoidap_dropdown">
                                                            <button class="hoidap_nut_dropdown"><a href="" style="color: rgb(255, 30, 0);"><span style="color: black;">Sắp xếp: </span> Mới nhất</a></button>
                                                            <div class="hoidap_noidung_dropdown">
                                                                <a href="#">Mới nhất</a>
                                                            <a href="#">Hoạt động</a>
                                                            <a href="#">Lượt xem</a>
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
                                                                    <span class="text-secondary font-w600"  >Tạo câu hỏi của bạn</span>
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
                                                    <span>trả lời</span>
                                                </div>
                                                <div class="hoidap_view" style="color: #ef5350;">
                                                    <div class="mini-counts">
                                                        <span>20</span>
                                                    </div>
                                                    <span>lượt xem</span>
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
                                                            <p style="color: #707070;">đã hiệu chỉnh<span style="font-style: italic; font-weight: bold;"> khoảng 3 giờ trước</span></p>
                                                            
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
                                                    <span>trả lời</span>
                                                </div>
                                                <div class="hoidap_view" style="color: #ef5350;">
                                                    <div class="mini-counts">
                                                        <span>40</span>
                                                    </div>
                                                    <span>lượt xem</span>
                                                </div>
                                                <div class="summary">
                                                    <a href="#">
                                                        <h4 class="summary-title">
                                                            <span class="mark-lookup">Làm sao để open command window here trên win 11 vậy mn ?</span>
                                                        </h4>
                                                    </a>
                                                    <div class="summary-tag">
                                                        <a href="#" class="hoidap_post-tag">c#</a>
                                                    </div>
                                                    <div class="summary-text">
                                                        <span>
                                                            <a href="#" class="summary-user">
                                                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                                                                <span style="color: #2e69ff;">Lê Hà Gia Khôi</span>
                                                            </a>
                                                            <p style="color: #707070;">đã hiệu chỉnh<span style="font-style: italic; font-weight: bold;"> khoảng 5 giờ trước</span></p>
                                                            
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
                                                    <span>trả lời</span>
                                                </div>
                                                <div class="hoidap_view" style="color: #ef5350;">
                                                    <div class="mini-counts">
                                                        <span>67</span>
                                                    </div>
                                                    <span>lượt xem</span>
                                                </div>
                                                <div class="summary">
                                                    <a href="#">
                                                        <h4 class="summary-title">
                                                            <span class="mark-lookup">cài đặt SQL Prompt (SQL Toolbelt)</span>
                                                        </h4>
                                                    </a>
                                                    <div class="summary-tag">
                                                        <a href="#" class="hoidap_post-tag">sql-sever</a>
                    
                                                    </div>
                                                    <div class="summary-text">
                                                        <span>
                                                            <a href="#" class="summary-user">
                                                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                                                                <span style="color: #2e69ff;">Nguyễn Thanh Tiến</span>
                                                            </a>
                                                            <p style="color: #707070;">đã hiệu chỉnh<span style="font-style: italic; font-weight: bold;"> khoảng 12 giờ trước</span></p>
                                                            
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
                                                    <span>trả lời</span>
                                                </div>
                                                <div class="hoidap_view" style="color: #ef5350;">
                                                    <div class="mini-counts">
                                                        <span>56</span>
                                                    </div>
                                                    <span>lượt xem</span>
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
                                                                <span style="color: #2e69ff;">Trần Văn Đạt</span>
                                                            </a>
                                                            <p style="color: #707070;">đã hiệu chỉnh<span style="font-style: italic; font-weight: bold;"> khoảng 22 giờ trước</span></p>
                                                            
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
                                                    <span>trả lời</span>
                                                </div>
                                                <div class="hoidap_view" style="color: #ef5350;">
                                                    <div class="mini-counts">
                                                        <span>152</span>
                                                    </div>
                                                    <span>lượt xem</span>
                                                </div>
                                                <div class="summary">
                                                    <a href="#">
                                                        <h4 class="summary-title">
                                                            <span class="mark-lookup">Lên học gì để thuận tiện và giảm thiểu thời gian</span>
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
                                                                <span style="color: #2e69ff;">Đỗ Vạn Lâm</span>
                                                            </a>
                                                            <p style="color: #707070;">đã hiệu chỉnh<span style="font-style: italic; font-weight: bold;"> khoảng 1 ngày trước</span></p>
                                                            
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
                                                    <span>trả lời</span>
                                                </div>
                                                <div class="hoidap_view" style="color: #ef5350;">
                                                    <div class="mini-counts">
                                                        <span>30</span>
                                                    </div>
                                                    <span>lượt xem</span>
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
                                                                <span style="color: #2e69ff;">Cá hồi hoang</span>
                                                            </a>
                                                            <p style="color: #707070;">đã hiệu chỉnh<span style="font-style: italic; font-weight: bold;"> khoảng 1 ngày trước</span></p>
                                                            
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    

                                
                                    
                                    <div class="hoidap_mid_container_right">
                                        <div class="hoidap_tag">TAG PHỔ BIẾN</div>
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
                                                    <a href="#" style="color: rgb(201, 32, 32) ; text-decoration: none; " > xem thêm...</a>
                                                </div>
                                            </ul>   
                                            <div class="hoidap_mid_container_right2">
                                                <div class="hoidap_tag2">Câu hỏi mới nhất</div>
                                                <ul class="hoidap_question">

                                                        <li>
                                                            <a href="#">Hỏi về cách lấy tuần hiện tại trong php</a>
                                                            <div class="mb-5 hoidap_text-muted font-size-xs">
                                                                <span class="mr-10" title="Bình chọn lên">
                                                                    <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="Bình chọn xuống">
                                                                    <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="Câu trả lời">
                                                                    <i class="fas fa-fw fa-reply fa-fw"></i>
                                                                    <span>1</span>
                                                                </span>
                                                                <span class="mr-10" title="Lượt xem">
                                                                    <i class="far fa-fw fa-eye fa-fw"></i>
                                                                    <span>25</span>
                                                                </span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <a href="#">Chọn hàng trong DataGridview</a>
                                                            <div class="mb-5 hoidap_text-muted font-size-xs">
                                                                <span class="mr-10" title="Bình chọn lên">
                                                                    <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="Bình chọn xuống">
                                                                    <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="Câu trả lời">
                                                                    <i class="fas fa-fw fa-reply fa-fw"></i>
                                                                    <span>1</span>
                                                                </span>
                                                                <span class="mr-10" title="Lượt xem">
                                                                    <i class="far fa-fw fa-eye fa-fw"></i>
                                                                    <span>25</span>
                                                                </span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <a href="#">Truyền tham số qua các lớp viewmodel</a>
                                                            <div class="mb-5 hoidap_text-muted font-size-xs">
                                                                <span class="mr-10" title="Bình chọn lên">
                                                                    <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="Bình chọn xuống">
                                                                    <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="Câu trả lời">
                                                                    <i class="fas fa-fw fa-reply fa-fw"></i>
                                                                    <span>1</span>
                                                                </span>
                                                                <span class="mr-10" title="Lượt xem">
                                                                    <i class="far fa-fw fa-eye fa-fw"></i>
                                                                    <span>25</span>
                                                                </span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <a href="#">game caro</a>
                                                            <div class="mb-5 hoidap_text-muted font-size-xs">
                                                                <span class="mr-10" title="Bình chọn lên">
                                                                    <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="Bình chọn xuống">
                                                                    <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="Câu trả lời">
                                                                    <i class="fas fa-fw fa-reply fa-fw"></i>
                                                                    <span>1</span>
                                                                </span>
                                                                <span class="mr-10" title="Lượt xem">
                                                                    <i class="far fa-fw fa-eye fa-fw"></i>
                                                                    <span>25</span>
                                                                </span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <a href="#">Undo</a>
                                                            <div class="mb-5 hoidap_text-muted font-size-xs">
                                                                <span class="mr-10" title="Bình chọn lên">
                                                                    <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="Bình chọn xuống">
                                                                    <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="Câu trả lời">
                                                                    <i class="fas fa-fw fa-reply fa-fw"></i>
                                                                    <span>1</span>
                                                                </span>
                                                                <span class="mr-10" title="Lượt xem">
                                                                    <i class="far fa-fw fa-eye fa-fw"></i>
                                                                    <span>25</span>
                                                                </span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <a href="#">Gặp vấn đề trong quá trình add Lib</a>
                                                            <div class="mb-5 hoidap_text-muted font-size-xs">
                                                                <span class="mr-10" title="Bình chọn lên">
                                                                    <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="Bình chọn xuống">
                                                                    <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="Câu trả lời">
                                                                    <i class="fas fa-fw fa-reply fa-fw"></i>
                                                                    <span>1</span>
                                                                </span>
                                                                <span class="mr-10" title="Lượt xem">
                                                                    <i class="far fa-fw fa-eye fa-fw"></i>
                                                                    <span>25</span>
                                                                </span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <a href="#">Hướng dẫn cài visual studio code</a>
                                                            <div class="mb-5 hoidap_text-muted font-size-xs">
                                                                <span class="mr-10" title="Bình chọn lên">
                                                                    <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="Bình chọn xuống">
                                                                    <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="Câu trả lời">
                                                                    <i class="fas fa-fw fa-reply fa-fw"></i>
                                                                    <span>1</span>
                                                                </span>
                                                                <span class="mr-10" title="Lượt xem">
                                                                    <i class="far fa-fw fa-eye fa-fw"></i>
                                                                    <span>25</span>
                                                                </span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <a href="#">Các thẻ cơ bản trong HTML</a>
                                                            <div class="mb-5 hoidap_text-muted font-size-xs">
                                                                <span class="mr-10" title="Bình chọn lên">
                                                                    <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="Bình chọn xuống">
                                                                    <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="Câu trả lời">
                                                                    <i class="fas fa-fw fa-reply fa-fw"></i>
                                                                    <span>1</span>
                                                                </span>
                                                                <span class="mr-10" title="Lượt xem">
                                                                    <i class="far fa-fw fa-eye fa-fw"></i>
                                                                    <span>25</span>
                                                                </span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <a href="#">1. Viết chương trình nhập vào dãy n phần tử và in ra các phần tử theo thứ tự ngược lại quá trình nhập. Số nhập đầu tiên sẽ in ra sau cùng.</a>
                                                            <div class="mb-5 hoidap_text-muted font-size-xs">
                                                                <span class="mr-10" title="Bình chọn lên">
                                                                    <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="Bình chọn xuống">
                                                                    <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                                    <span>0</span>
                                                                </span>
                                                                <span class="mr-10" title="Câu trả lời">
                                                                    <i class="fas fa-fw fa-reply fa-fw"></i>
                                                                    <span>1</span>
                                                                </span>
                                                                <span class="mr-10" title="Lượt xem">
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
                            <h1> Bài viết</h1>
                           <p>Kho tài liệu và bài viết được chia sẻ, đánh giá bởi cộng đồng</p>
                        </div>
                        <div >
                            <a href="#" class="btn "> <i class="fas fa-plus-circle" style="background-image: linear-gradient(to right,rgb(82, 85, 238),rgb(142, 169, 243));"></i>  Viết bài</a>
                        </div>
                    </div>
                    <div class="baiviet_container_main">
                        <div class="baiviet_t1">
                            <i class="fas fa-home" style="color: rgb(17, 0, 253);"> </i>
                            <span class="breadcrumb-item active"> >  Bài viết</span>
                        </div>
        
                        
                        <div class="baiviet_mid__container">
                            <div class="baiviet_mid_container_mid">
                                <div class="baiviet_mid__container_menu">
                                    <div class="baiviet_menu123">
                                        <ul>
                                            <li class="js-tab"><a href="">Bài viết</a></li>
                                            <li class="js-tab"><a href="">Series</a></li>
                                            <li class="js-tab"><a href="">Bài viết của tôi</a></li>
                                            <li><a href="">Bản nháp</a></li>
                                            <li>
                                                <div class="dropdown">
                                                    <button class="baiviet_nut_dropdown"><a href="" style="color: rgb(255, 30, 0);"><span style="color: black;">Sắp xếp: </span> Mới nhất</a></button>
                                                    <div class="baiviet_noidung_dropdown">
                                                        <a href="#">Mới nhất</a>
                                                      <a href="#">Hoạt động</a>
                                                      <a href="#">Lượt xem</a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- <div class="select">
                                            <form action="">
                                                  Sắp xếp:   <select name="sapxep" id="">
                                                                <option value="Mới nhất">Mới nhất</option>
                                                                <option value="Hoạt động">Hoạt động</option>
                                                                <option value="Lượt xem">Lượt xem</option> </select>
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
                                                            <span  class="text-secondary font-w600">Chia sẻ bài viết, tài liệu, ...</span>
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
                                                                    ĐẶT TÊN CHO "EM"</span> 
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
                                                                    Giới thiệu Tên xuất hiện ở tất cả mọi nơi trong 1 chương trình. Chúng ta đặt tên cho Biến, Hàm, Đối số, Class, Packages… vân vân và mây mây, do đó chúng ta nên đặt tên theo những nguyên tắc sau đây...
                                                                .</p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-5 text-muted font-size-xs">
                                                        <span class="mr-10" title="Bình chọn lên">
                                                            <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="Bình chọn xuống">
                                                            <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="Câu trả lời">
                                                            <i class="fas fa-fw fa-reply fa-fw"></i>
                                                            <span>1</span>
                                                        </span>
                                                        <span class="mr-10" title="Lượt xem">
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
                                                    <div class="font-size  "> <span style="color: blue;" >Đạt bê</span>
                                                        <a href="#" >
                                                            <h4 class="h5  mr-5 d-inline-block">
                                                                <span class="mark-lookup">
                                                                    Kỹ thuật sử dụng Dependency Injection trong Winform project - Winform never die</span> 
                                                            </h4>
                                                        </a>  
                                                        <a  href="#">C#</a> 
                                                    </div>
                                                    
                                                    <div class=" border "">
                                                        <div class="b">
                                                            <a href="#">
                                                                <p >  
                                                                    DẪN NHẬP Trước khi đi vào code mẫu của DI trong Winform mình cùng tìm hiểu xem DI là gì và vì sao các lập trình viên lại đam mê đến thế.  Định nghĩa có thể sẽ gây khó hiểu, vì thực sự cũng chưa biết...
                                                                </p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-5 text-muted font-size-xs">
                                                        <span class="mr-10" title="Bình chọn lên">
                                                            <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="Bình chọn xuống">
                                                            <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="Câu trả lời">
                                                            <i class="fas fa-fw fa-reply fa-fw"></i>
                                                            <span>1</span>
                                                        </span>
                                                        <span class="mr-10" title="Lượt xem">
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
                                                    <div class="font-size  "> <span style="color: blue;" > Vạn Lâm</span>
                                                        <a href="#" >
                                                            <h4 class="h5  mr-5 d-inline-block">
                                                                <span class="mark-lookup">
                                                                    Laravel 9 có gì mới ?</span> 
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
                                                                    Laravel v9 sẽ là phiên bản LTS tiếp theo của Laravel, và nó sẽ ra mắt vào đầu năm 2022. Trong bài đăng này, chúng tôi muốn phác thảo tất cả các tính năng và thay đổi mới được công bố cho đến nay. ...
                                                                </p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-5 text-muted font-size-xs">
                                                        <span class="mr-10" title="Bình chọn lên">
                                                            <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="Bình chọn xuống">
                                                            <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="Câu trả lời">
                                                            <i class="fas fa-fw fa-reply fa-fw"></i>
                                                            <span>1</span>
                                                        </span>
                                                        <span class="mr-10" title="Lượt xem">
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
                                                    <div class="font-size  "> <span style="color: blue;" >trần cường</span>
                                                        <a href="#" >
                                                            <h4 class="h5  mr-5 d-inline-block">
                                                                <span class="mark-lookup">
                                                                    TẠO PROJECT DJANGO</span> 
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
                                                        <span class="mr-10" title="Bình chọn lên">
                                                            <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="Bình chọn xuống">
                                                            <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="Câu trả lời">
                                                            <i class="fas fa-fw fa-reply fa-fw"></i>
                                                            <span>1</span>
                                                        </span>
                                                        <span class="mr-10" title="Lượt xem">
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
                                                    <div class="font-size  "> <span style="color: blue;" > Thanh vĩ</span>
                                                        <a href="#" >
                                                            <h4 class="h5  mr-5 d-inline-block">
                                                                <span class="mark-lookup">
                                                                    Kỹ thuật sử dụng Dependency Injection trong Winform project - Winform never die</span> 
                                                            </h4>
                                                        </a>  
                                                        <a  href="#">C#</a> 
                                                    </div>
                                                    
                                                    <div class=" border "">
                                                        <div class="b">
                                                            <a href="#"> <p> Giới thiệu tên xuất hiện ở tất cả mọi nơi trong 1 chương trình. Chúng ta đặt tên cho Biến, Hàm, Đối số, Class, Packages… vân vân và mây mây, do đó chúng ta nên đặt tên theo những nguyên tắc sau đây..  </p></a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-5 text-muted font-size-xs">
                                                        <span class="mr-10" title="Bình chọn lên">
                                                            <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="Bình chọn xuống">
                                                            <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="Câu trả lời">
                                                            <i class="fas fa-fw fa-reply fa-fw"></i>
                                                            <span>1</span>
                                                        </span>
                                                        <span class="mr-10" title="Lượt xem">
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
                                                                <span class="mark-lookup">Giao tiếp với các Windows trong WPF</span> 
                                                            </h4>
                                                        </a>  
                                                        <a  href="#">C#</a> 
                                                        <a  href="#">wpf</a>
                                                    </div>
                                                    
                                                    <div class=" border "">
                                                        <div class="b">
                                                            <a href="#">
                                                                <p >  Dẫn Nhập Giao tiếp giữa các Windows trong  WPF  Nội Dung Để đọc hiểu bài này tốt nhất các bạn nên có kiến thức cơ bản về các phần: WPF cơ bản Event với Delegate trong C Event chuẩn .Net...</p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-5 text-muted font-size-xs">
                                                        <span class="mr-10" title="Bình chọn lên">
                                                            <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="Bình chọn xuống">
                                                            <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="Câu trả lời">
                                                            <i class="fas fa-fw fa-reply fa-fw"></i>
                                                            <span>1</span>
                                                        </span>
                                                        <span class="mr-10" title="Lượt xem">
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
                                <div class="tag">TAG PHỔ BIẾN</div>
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
                                            <a href="#" style="color: rgb(201, 32, 32) ; text-decoration: none; " > xem thêm...</a>
                                        </div>
                                    </ul>   
                                    <div class="mid_container_right2">
                                        <div class="tag2">Câu hỏi mới nhất</div>
                                         <ul class="question">
        
                                                <li>
                                                    <a href="#">Hỏi về cách lấy tuần hiện tại trong php</a>
                                                    <div class="mb-5 text-muted font-size-xs">
                                                        <span class="mr-10" title="Bình chọn lên">
                                                            <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="Bình chọn xuống">
                                                            <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="Câu trả lời">
                                                            <i class="fas fa-fw fa-reply fa-fw"></i>
                                                            <span>1</span>
                                                        </span>
                                                        <span class="mr-10" title="Lượt xem">
                                                            <i class="far fa-fw fa-eye fa-fw"></i>
                                                            <span>25</span>
                                                        </span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a href="#">Chọn hàng trong DataGridview</a>
                                                    <div class="mb-5 text-muted font-size-xs">
                                                        <span class="mr-10" title="Bình chọn lên">
                                                            <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="Bình chọn xuống">
                                                            <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="Câu trả lời">
                                                            <i class="fas fa-fw fa-reply fa-fw"></i>
                                                            <span>1</span>
                                                        </span>
                                                        <span class="mr-10" title="Lượt xem">
                                                            <i class="far fa-fw fa-eye fa-fw"></i>
                                                            <span>25</span>
                                                        </span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a href="#">Truyền tham số qua các lớp viewmodel</a>
                                                    <div class="mb-5 text-muted font-size-xs">
                                                        <span class="mr-10" title="Bình chọn lên">
                                                            <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="Bình chọn xuống">
                                                            <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="Câu trả lời">
                                                            <i class="fas fa-fw fa-reply fa-fw"></i>
                                                            <span>1</span>
                                                        </span>
                                                        <span class="mr-10" title="Lượt xem">
                                                            <i class="far fa-fw fa-eye fa-fw"></i>
                                                            <span>25</span>
                                                        </span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a href="#">game caro</a>
                                                    <div class="mb-5 text-muted font-size-xs">
                                                        <span class="mr-10" title="Bình chọn lên">
                                                            <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="Bình chọn xuống">
                                                            <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="Câu trả lời">
                                                            <i class="fas fa-fw fa-reply fa-fw"></i>
                                                            <span>1</span>
                                                        </span>
                                                        <span class="mr-10" title="Lượt xem">
                                                            <i class="far fa-fw fa-eye fa-fw"></i>
                                                            <span>25</span>
                                                        </span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a href="#">Undo</a>
                                                    <div class="mb-5 text-muted font-size-xs">
                                                        <span class="mr-10" title="Bình chọn lên">
                                                            <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="Bình chọn xuống">
                                                            <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="Câu trả lời">
                                                            <i class="fas fa-fw fa-reply fa-fw"></i>
                                                            <span>1</span>
                                                        </span>
                                                        <span class="mr-10" title="Lượt xem">
                                                            <i class="far fa-fw fa-eye fa-fw"></i>
                                                            <span>25</span>
                                                        </span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a href="#">Gặp vấn đề trong quá trình add Lib</a>
                                                    <div class="mb-5 text-muted font-size-xs">
                                                        <span class="mr-10" title="Bình chọn lên">
                                                            <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="Bình chọn xuống">
                                                            <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="Câu trả lời">
                                                            <i class="fas fa-fw fa-reply fa-fw"></i>
                                                            <span>1</span>
                                                        </span>
                                                        <span class="mr-10" title="Lượt xem">
                                                            <i class="far fa-fw fa-eye fa-fw"></i>
                                                            <span>25</span>
                                                        </span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a href="#">Hướng dẫn cài visual studio code</a>
                                                    <div class="mb-5 text-muted font-size-xs">
                                                        <span class="mr-10" title="Bình chọn lên">
                                                            <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="Bình chọn xuống">
                                                            <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="Câu trả lời">
                                                            <i class="fas fa-fw fa-reply fa-fw"></i>
                                                            <span>1</span>
                                                        </span>
                                                        <span class="mr-10" title="Lượt xem">
                                                            <i class="far fa-fw fa-eye fa-fw"></i>
                                                            <span>25</span>
                                                        </span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a href="#">Các thẻ cơ bản trong HTML</a>
                                                    <div class="mb-5 text-muted font-size-xs">
                                                        <span class="mr-10" title="Bình chọn lên">
                                                            <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="Bình chọn xuống">
                                                            <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="Câu trả lời">
                                                            <i class="fas fa-fw fa-reply fa-fw"></i>
                                                            <span>1</span>
                                                        </span>
                                                        <span class="mr-10" title="Lượt xem">
                                                            <i class="far fa-fw fa-eye fa-fw"></i>
                                                            <span>25</span>
                                                        </span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a href="#">1. Viết chương trình nhập vào dãy n phần tử và in ra các phần tử theo thứ tự ngược lại quá trình nhập. Số nhập đầu tiên sẽ in ra sau cùng.</a>
                                                    <div class="mb-5 text-muted font-size-xs">
                                                        <span class="mr-10" title="Bình chọn lên">
                                                            <i class="fas fa-fw fa-caret-up fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="Bình chọn xuống">
                                                            <i class="fas fa-fw fa-caret-down fa-fw"></i>
                                                            <span>0</span>
                                                        </span>
                                                        <span class="mr-10" title="Câu trả lời">
                                                            <i class="fas fa-fw fa-reply fa-fw"></i>
                                                            <span>1</span>
                                                        </span>
                                                        <span class="mr-10" title="Lượt xem">
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
                            <h1>Thành viên</h1>
                        <p>Tham gia cùng chúng tôi</p>
                        </div>
                        <div >
                            <a href="#" class="btn "> <i class="fas fa-plus-circle" style="background-image: linear-gradient(to right,rgb(82, 85, 238),rgb(142, 169, 243));"></i>  Viết bài</a>
                        </div>
                </div>
                <div class="kter_container_main">
                    <div class="t1--kter">
                        <i class="fas fa-home" style="color: rgb(17, 0, 253);"> </i>
                        <span class="breadcrumb-item active"> >  Thành viên</span>
                    </div>
                    <div class="thanhvien--kter">
                        <div class="input-group input-group--kter">
                            <input class="input" type="text" placeholder="Tìm khóa học...">
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
                                    <li><a href="#">Tất cả</a></li>
                                    <li><a href="#">Quản trị viên </a></li>
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
                                        <p class="small text-muted"><strong>0</strong> điểm</p>
                                        <p class="small text-muted">tham gia <span class="format-time font-w600" title="2021-10-29 19:23:52">23 phút trước</span></p>
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
                                        <p class="small text-muted"><strong>0</strong> điểm</p>
                                        <p class="small text-muted">tham gia <span class="format-time font-w600" title="2021-10-29 19:23:52">23 phút trước</span></p>
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
                                        <p class="small text-muted"><strong>0</strong> điểm</p>
                                        <p class="small text-muted">tham gia <span class="format-time font-w600" title="2021-10-29 19:23:52">23 phút trước</span></p>
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
                                        <p class="small text-muted"><strong>0</strong> điểm</p>
                                        <p class="small text-muted">tham gia <span class="format-time font-w600" title="2021-10-29 19:23:52">23 phút trước</span></p>
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
                                        <p class="small text-muted"><strong>0</strong> điểm</p>
                                        <p class="small text-muted">tham gia <span class="format-time font-w600" title="2021-10-29 19:23:52">23 phút trước</span></p>
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
                                        <p class="small text-muted"><strong>0</strong> điểm</p>
                                        <p class="small text-muted">tham gia <span class="format-time font-w600" title="2021-10-29 19:23:52">23 phút trước</span></p>
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
                                        <p class="small text-muted"><strong>0</strong> điểm</p>
                                        <p class="small text-muted">tham gia <span class="format-time font-w600" title="2021-10-29 19:23:52">23 phút trước</span></p>
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
                                        <p class="small text-muted"><strong>0</strong> điểm</p>
                                        <p class="small text-muted">tham gia <span class="format-time font-w600" title="2021-10-29 19:23:52">23 phút trước</span></p>
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
                                        <p class="small text-muted"><strong>0</strong> điểm</p>
                                        <p class="small text-muted">tham gia <span class="format-time font-w600" title="2021-10-29 19:23:52">23 phút trước</span></p>
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
                                        <p class="small text-muted"><strong>0</strong> điểm</p>
                                        <p class="small text-muted">tham gia <span class="format-time font-w600" title="2021-10-29 19:23:52">23 phút trước</span></p>
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
                                        <p class="small text-muted"><strong>0</strong> điểm</p>
                                        <p class="small text-muted">tham gia <span class="format-time font-w600" title="2021-10-29 19:23:52">23 phút trước</span></p>
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
                                        <p class="small text-muted"><strong>0</strong> điểm</p>
                                        <p class="small text-muted">tham gia <span class="format-time font-w600" title="2021-10-29 19:23:52">23 phút trước</span></p>
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
                                        <p class="small text-muted"><strong>0</strong> điểm</p>
                                        <p class="small text-muted">tham gia <span class="format-time font-w600" title="2021-10-29 19:23:52">23 phút trước</span></p>
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
                                        <p class="small text-muted"><strong>0</strong> điểm</p>
                                        <p class="small text-muted">tham gia <span class="format-time font-w600" title="2021-10-29 19:23:52">23 phút trước</span></p>
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
                                        <p class="small text-muted"><strong>0</strong> điểm</p>
                                        <p class="small text-muted">tham gia <span class="format-time font-w600" title="2021-10-29 19:23:52">23 phút trước</span></p>
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
                                        <p class="small text-muted"><strong>0</strong> điểm</p>
                                        <p class="small text-muted">tham gia <span class="format-time font-w600" title="2021-10-29 19:23:52">23 phút trước</span></p>
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
                        <h1> Về Kteam</h1>
                       <p>Vì một nền giáo dục miễn phí cho bất kỳ ai, ở bất cứ nơi nào</p>
                    </div>
                    <div     >
                        <a  href="#" class="btn "> <i class="fas fa-plus-circle" style="background-image: linear-gradient(to right,rgb(82, 85, 238),rgb(142, 169, 243));"></i>  Viết bài</a>
                    </div>
                </div>
                <div class="VeKteam_container_main">
                        <div class="Vekteam_container_heal">
                                <ul>
                                    <li><a href="#">Về Kteam</a></li>
                                    <li><a href="#">Người ủng hộ</a></li>
                                    <li><a href="#">Liên hệ - Góp ý</a></li>
                                    <li><a href="#">Tài trợ</a></li>
                                </ul>
                        </div>
                        <div class="VeKteam_container_mid">
                                <div class="VeKteam_container_mid_vekteam">
                                    <h5 class="h1--vekteam">Tầm nhìn</h5>
                                    <p class="font-size-h5 mb-10">
                                        Với mong muốn mang đến kiến thức chất lượng, miễn phí cho mọi người, với
                                        tâm huyết phá bỏ rào cản kiến thức từ việc giáo dục thu phí. Chúng tôi - Kteam
                                        đã lập nên trang website này để thế giới phẳng hơn.
                                    </p>
                                    <p class="font-size-h5 mb-10">
                                        Bất cứ ai có mong muốn khai phá thế giới. Phá bỏ mọi thứ ngăn cản sự phát
                                        triển tất yếu bền vững của xã hội đều là Kter (Thành viên của Kteam).
                                    </p>
                                    <h5 class="h2">GIÁO DỤC LÀ MIỄN PHÍ!</h5>
                                </div>
                                <div class="VeKteam_container_mid_ngsanglap">
                                    <h5 class="h1--vekteam ">Người sáng lập</h5>
                                    <div class="Vekteam_cac_user">
                                        <div class="Vekteam_user">
                                            <div class="Vekteam_user_img">
                                                <img class="img-avatar" src="https://lh3.googleusercontent.com/gu8rtRBOuihUcDxhm2zgZk9fyXZwqUdxHm39rF9Gt7twlv51kQ218sdM41BMbd1BsTFTlvVUgDZZuzHf=s275-rw" alt="">
                                            </div>
                                            <div class="Vekteam_user_p">
                                                <div class="font-w600 h4 mb-5">Nguyễn Thanh Tiến</div>
                                                <div class="font-size-sm text-muted">Kỹ thuật nội dung</div>
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
                                                <div class="font-w600 h4 mb-5">Trần Văn Đạt</div>
                                                <div class="font-size-sm text-muted">Thiết kế website</div>
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
                                                <div class="font-w600 h4 mb-5">Lê Hà Gia Khôi</div>
                                                <div class="font-size-sm text-muted">Đồ họa -Founder</div>
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
                                        <h5 class="h1--vekteam">Dịch vụ</h5>
                                        <p>
                                            Chúng tôi cung cấp các dịch vụ về phân tích, thiết kế, xây dựng.
                                        </p>
                                        <div class="VeKteam_container_mid_dichvu_top">
                                                <div class="VeKteam_container_mid_dichvu_colum">    
                                                        <div class="VeKteam_container_mid_dichvu_colum_top">
                                                            <h3 class="block-title font-w600 text-white"><i class="far fa-sticky-note"></i> TƯ VẤN XÂY DỰNG HỆ THỐNG QUẢN LÝ</h3>
                                                        </div>
                                                        <div class="VeKteam_container_mid_dichvu_colum_bot">
                                                            <ul class="pl-15">
                                                                <li>Hỗ trợ tự vấn giải pháp quản lý miễn phí.</li>
                                                                <li>Hỗ trợ xây dựng hệ thống quản lý nhân sự, bán hàng, kho bãi.</li>
                                                            </ul>
                                                        </div>
                                                </div>
                                                <div class="VeKteam_container_mid_dichvu_colum">    
                                                    <div  style="background-color: #26c6da" class="VeKteam_container_mid_dichvu_colum_top">
                                                        <h3 class="block-title font-w600 text-white"><i class="fas fa-globe"></i> WEBSITE - QUẢN TRỊ WEBSITE, FANPAGE</h3>
                                                    </div>
                                                    <div class="VeKteam_container_mid_dichvu_colum_bot">
                                                        <ul class="pl-15">
                                                            <li>Hỗ trợ tạo Website bán hàng, Giới thiệu công ty nhanh chóng.</li>
                                                            <li>Hỗ trợ thực hiện WebApplication quản lý mọi nơi.Hỗ trợ thực hiện WebApplication quản lý mọi nơi.</li>
                                                            <li>Kết hợp 3 nền tảng trong 1 hệ thống Website, Ứng dụng di động và Ứng dụng PC.</li>
                                                        </ul>
                                                    </div>
                                                 </div>
                                                 <div class="VeKteam_container_mid_dichvu_colum">    
                                                    <div  style="background-color: #829294" class="VeKteam_container_mid_dichvu_colum_top">
                                                        <h3 class="block-title font-w600 text-white"><i class="fas fa-globe"></i> ỨNG DỤNG DI ĐỘNG</h3>
                                                    </div>
                                                    <div class="VeKteam_container_mid_dichvu_colum_bot">
                                                        <ul class="pl-15" style="height: 80%;">
                                                            <li>Hỗ trợ tạo Website bán hàng, Giới thiệu công ty nhanh chóng.</li>
                                                            <li>Hỗ trợ thực hiện WebApplication quản lý mọi nơi.Hỗ trợ thực hiện WebApplication quản lý mọi nơi.</li>
                                                            <li>Kết hợp 3 nền tảng trong 1 hệ thống Website, Ứng dụng di động và Ứng dụng PC.</li>
                                                        </ul>
                                                    </div>
                                                 </div>
                                        </div>
                                        <div class="VeKteam_container_mid_dichvu_bot" >
                                            <div class="VeKteam_container_mid_dichvu_colum">    
                                                <div style="background-color: #ef5350;"  class="VeKteam_container_mid_dichvu_colum_top">
                                                    <h3 class="block-title font-w600 text-white"><i class="fas fa-wrench"></i> TOOL AUTO - TỰ ĐỘNG HÓA ỨNG DỤNG</h3>
                                                </div>
                                                <div class="VeKteam_container_mid_dichvu_colum_bot">
                                                    <ul class="pl-15">
                                                        <li>Thực hiện những công việc lặp đi lặp lại chỉ với 1 click chuột.</li>
                                                        <li>Nhanh chóng, tiện lợi và chi phí phải chăng.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="VeKteam_container_mid_dichvu_colum">    
                                                <div style="background-color: #9ccc65;" class="VeKteam_container_mid_dichvu_colum_top">
                                                    <h3 class="block-title font-w600 text-white"><i class="fas fa-ribbon"></i> ĐÀO TẠO NHÂN SỰ - CÔNG NGHỆ THÔNG TIN</h3>
                                                </div>
                                                <div class="VeKteam_container_mid_dichvu_colum_bot">
                                                    <ul class="pl-15">
                                                        <li>Hỗ trợ đào tạo nhân sự CNTT ngay để có thể bắt kịp công nghệ mới, xu hướng mới.</li>
                                                        <li>Thời gian nhanh chóng, chi phí phải chăng.</li>
                                                        <li>Chất lượng cao, đầu ra đảm bảo.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="VeKteam_container_mid_dichvu_colum">    
                                                <div style="background-color: #d262e3;" class="VeKteam_container_mid_dichvu_colum_top">
                                                    <h3 class="block-title font-w600 text-white"><i class="fas fa-users"></i> KẾT NỐI NHÂN SỰ</h3>
                                                </div>
                                                <div class="VeKteam_container_mid_dichvu_colum_bot">
                                                    <ul class="pl-15" style="height: 80%;">
                                                        <li>Không còn phải đau đầu về việc không tìm ra nhân lực cho doanh nghiệp của mình. Kteam sẽ là cầu nối của bạn và nguồn nhân lực cho chính Kteam đào tạo.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div >
                                </div>
                                <div class="Vekteam_container_mid_taitro">
                                            <div>
                                                <h5 class="h1--vekteam">Tài trợ</h5>
                                                    <p class="p">Hỗ trợ chúng tôi để cùng xây dựng một nền  <strong>GIÁO DỤC MIỄN PHÍ</strong>  cho bất cứ ai, ở bất cứ nơi nào. 
                                                <br> Hoặc tham gia vào đội ngủ giảng viên, công tác viên, tình nguyện viên của chúng tôi.</p>
                                                <a  href="#">Tài trợ</a>
                                            </div>                                     
                                </div>
                                
                                <div  class="Vekteam_container_mid_lienhegopy">
                                    <h5 class="h1--vekteam">Liên hệ - Góp ý</h5>
                                    <p class="p">Góp ý hoặc liên hệ cho Kteam nếu bạn có nhu cầu về dịch vụ, quảng cáo hoặc những thắc mắc khác.</p>
                                    <a href="#">Liên hệ</a>
                                </div>
                        </div>
                </div>
            </div>
            <div class="main__taitro">
                <div class="taitro_top__container">
                    <div class="heal1">
                        <h1> Tài trợ</h1>
                       <p>Hỗ trợ để Kteam có thể xây dựng nhiều khóa học hơn.</p>
                    </div>
                    <div >
                        <a href="#" class="btn "> <i class="fas fa-plus-circle" style="background-image: linear-gradient(to right,rgb(82, 85, 238),rgb(142, 169, 243));"></i>  Viết bài</a>
                    </div>
                </div>
                <div class="taitro_container_main">
                    <div class="taitro_container_heal Vekteam_container_heal">
                        <ul>
                            <li><a href="#">Về Kteam</a></li>
                            <li><a href="#">Người ủng hộ</a></li>
                            <li><a href="#">Liên hệ - Góp ý</a></li>
                            <li><a href="#">Tài trợ</a></li>
                        </ul>
                     </div>
                     <div class="taitro_container_mid">
                                <div class="taitro_container_mid_theatm">
                                        <div  class="taitro_container_mid_theatm_heal">
                                            <h3 class="block-title font-w600"><i class="far fa-credit-card fa-fw"></i>  ỦNG HỘ ONLINE SỬ DỤNG THẺ ATM HOẶC VISA/MASTER</h3>
                                        </div>
                                        <div class="taitro_container_mid_theatm_mid">
                                            <div id="faq1_q1" class="collapse show" role="tabpanel" aria-labelledby="faq1_h1">
                                                <div class="block-content pb-20">
                                                    <p>Ủng hộ online sử dụng thẻ ATM hoặc VISA/MASTER.</p>
                                                    <p style="  margin-bottom: 3%;"><strong>Lưu ý:</strong> Thẻ cần có chức năng Internet Banking.</p>
                                                    <a class="btn_buttton" href="#"><i class="fas fa-arrow-right"></i> Tiếp tục</a>
                                                </div>
                                            </div>
                                        </div>
                                </div>  
                                <div class="taitro_container_mid_unghotructiep">
                                    <div  class="taitro_container_mid_unghotructiep_heal">
                                        <h3 class="block-title font-w600"><i class="fas fa-university fa-fw"></i>  ỦNG HỘ ONLINE SỬ DỤNG THẺ ATM HOẶC VISA/MASTER</h3>
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
                        <h1> Liên hệ - Góp ý</h1>
                       <p>Góp ý hoặc liên hệ cho Kteam nếu bạn có nhu cầu về dịch vụ, quảng cáo hoặc những thắc mắc khác.</p>
                    </div>
                    <div >
                        <a href="#" class="btn "> <i class="fas fa-plus-circle" style="background-image: linear-gradient(to right,rgb(82, 85, 238),rgb(142, 169, 243));"></i>  Viết bài</a>
                    </div>
                </div>
    
                <div class="phanhoi_container_main">
                    <div class="phanhoi_container_heal Vekteam_container_heal">
                        <ul>
                            <li><a href="#">Về Kteam</a></li>
                            <li><a href="#">Người ủng hộ</a></li>
                            <li><a href="#">Liên hệ - Góp ý</a></li>
                            <li><a href="#">Tài trợ</a></li>
                        </ul>
                     </div>
                     <div class="phanhoi_container_mid">
                                <div class="phanhoi_container_mid_left">
                                        <div class="phanhoi_container_mid_left_heal">
                                            <h3 class="block-title font-w600"><i class="fas fa-paper-plane"></i> GỬI THÔNG TIN LIÊN HỆ - GÓP Ý</h3>
                                        </div>
                                        <div class="phanhoi_container_mid_left_form">
                                                <p>Góp ý hoặc liên hệ cho Kteam nếu bạn có nhu cầu về dịch vụ, quảng cáo hoặc những thắc mắc khác.</p>
                                                <form action="POST">
                                                    <div class="phanhoi_container_mid_left_form_hoten" style="padding-top: 5%;">
                                                        <label for="name">Họ tên</label> 
                                                        <br> <input class="form_left" type="text" name="name" id="name" placeholder="Tên của bạn "> 
                                                    </div>
                                                    <div class="phanhoi_container_mid_left_form_email_dthoai">
                                                                <div class="phanhoi_container_mid_left_form_email">
                                                                    <label for="email">Email</label>
                                                                    <br><input  class="form_left" data-val="true" data-val-email="Email không hợp lệ" data-val-required="Vui lòng nhập Email" id="email" name="email" placeholder="Email" type="text">
                                                                </div>
                                                                <div class="phanhoi_container_mid_left_form_dthoai">
                                                                    <label for="email">Điện thoại</label>
                                                                    <br><input  class="form_left"  data-val="true" data-val-dthoai="Số điện thoại không hợp lệ " data-val-required="Vui lòng nhập số điện thoại" id="dthoai" name="dthoai" placeholder="Số điện thoại" type="text">
                                                                </div>
                                                    </div>
                                                    <div class="phanhoi_container_mid_left_form_tieude">
                                                        <label for="email">Tiêu đề</label>
                                                        <br><input  class="form_left" data-val="true" data-val-tieude="Tiêu đề không hợp lệ" data-val-required="Vui lòng nhập Tiêu đề" id="tieude" name="tieude" placeholder="Tiêu đề" type="text">
                                                    </div>
                                                    <div class="phanhoi_container_mid_left_form_noidung">
                                                        <label for="email">Nội dung</label>
                                                        <br><textarea   class="form_left" data-val="true"  data-val-required="Vui lòng nhập nội dung" id="noidung" name="noidung" placeholder="Nội dung" type="text"></textarea>
                                                    </div>
                                                    <div class="phanhoi_container_mid_left_form_button">
                                                            <button class="btn_buttton" type="submit" name="submit" > <i class="fas fa-paper-plane fa-fw"></i> Gửi</button>
                                                    </div>
                                                </form>
                                            </div>
                                </div>
                                <div class="phanhoi_container_mid_right">
                                    <div class="phanhoi_container_mid_right_heal">
                                        <h3 class="block-title font-w600"><i class="fa fa-info-circle fa-fw"></i> THÔNG TIN LIÊN HỆ KHÁC</h3>
                                    </div>
                                    <div class="phanhoi_container_mid_right_form">
                                        <p>Mọi thông tin đóng góp ý kiến hoặc hỗ trợ, người dùng có thể liên hệ trực tiếp qua các kênh sau:</p>
                                        <div class="phanhoi_container_mid_right_form_dienthoai">
                                            <i class="fas fa-phone-square fa-fw fa-3x mr-10"></i>
                                            <div class="media-body">
                                                <p >Điện thoại</p>
                                                <a href="#">(+84)  865 264 533  (Mr.Tiến)</a><br>
                                                <a href="#">(+84)  ___ ___ ___  (Mr.Khôi)</a><br>
                                                <a href="#">(+84)   ___ ___ ___  (Mr.Đạt)</a>
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
                                <h1> Thông tin cá nhân</h1>
                            </div>
                            <div >
                                <a href="#" class="btn "> <i class="fas fa-plus-circle" style="background-image: linear-gradient(to right,rgb(82, 85, 238),rgb(142, 169, 243));"></i>  Viết bài</a>
                            </div>
                        </div>
            
            
                    <div class="thongtincanhan_container_main">
                        <!-- menu-lichsu -->
                        <div class="thongtincanhan_t1">
                            <ul>
                                <li><a href="">Giới thiệu</a></li>
                                <li><a href="">Khóa học</a></li>
                                <li><a href="">Bài học</a></li>
                                <li><a href="">Series</a></li>
                                <li><a href="">Bài viết</a></li>
                                <li><a href="">Câu hỏi</a></li>
                                <li><a href="">Lịch sử</a></li>
                                <li><a href="">Đã lưu</a></li>
                                <li ><a href="">Thông báo</a></li>
                                <li class="t1--caidat"><a href=""><a href="">Cài đặt</a></li>
                            </ul>
                        </div>
                        <div style="clear: both;"></div>
                        <!-- radio-lichsu -->
                        <div class="thongtincanhan_container_main_mid-LS">
                            <div class="thongtincanhan_container_main_mid_left-LS">
                                <form>
                                    <p><i class="fas fa-cog"></i> CÀI ĐẶT</p>
                                    <ul>
                                        <li><a href=""><i class="fas fa-address-card"></i>  Hồ sơ</a></li>
                                        <li><a href=""><input type="radio" name=""> Ảnh đại điện</a></li>
                                        <li><a href=""><input type="radio" name=""> Mật khẩu</a></li>
                                        <li><a href=""><input type="radio" name=""> Email</a></li>
                                    
                                        
                                    </ul>
                                </form>
                            </div>
                            
                            <div class="thongtincanhan_container_main_mid_right-LS">
                                <p>CHỈNH SỬA HỒ SƠ CỦA BẠN</p> <br> 
                                <form action="update_data.php" method="post" enctype="multipart/form-data">
                                    <div class="thongtincanhan_container_right_mid">
                                        <h3 style="font-size: 25px; font-weight: 500; margin-bottom: 1%;" > Thông tin cơ bản </h3>
                                            <hr>
                                        <div class="thongtincanhan_container_right_mid_top">
                                            <div class="thongtincanhan_container_right_mid_top_left">
                                                <h5>Giới thiệu để mọi người hiểu thêm về bạn. Một số thông tin sẽ được hiển thị công khai.</h5>
                                            </div>
                                            <div class="thongtincanhan_container_right_mid_top_right">
                                                <div class="thongtincanhan_container_right_mid_top_tenhienthi">
                                                    <label for="" class="thongtincanhan_container_right_mid_top_right_chu" > Tên hiển thị</label>
                                                    <br><input type="text" name="txtTenhienthi" class="frames" placeholder="Tên hiển thị" value="<?php   if(   mysqli_num_rows($resultt) > 0 ) {       echo $roww["Tenhienthi"];}    ?>">
                                                </div>
                                                <div class="thongtincanhan_container_right_mid_top_ngaysinh">
                                                        <label for="" class="thongtincanhan_container_right_mid_top_right_chu">Ngày sinh</label>
                                                        <br><input type="date"class="frames" name="txtNgaysinh" id="" placeholder="<?php   if(   mysqli_num_rows($resultt) > 0 ) {       echo $roww["Ngaysinh"];}    ?>">
                                                </div>
                                                <div class="thongtincanhan_container_right_mid_top_gioitinh">
                                                    <label for=""class="thongtincanhan_container_right_mid_top_right_chu"> Giới tính</label>
                                                    <br> <select name="Gender" id=""class="frames"  value="">
                                                            <option ><?php   if(   mysqli_num_rows($resultt) > 0 ) {       echo $roww["Gioitinh"];} else{ echo "Giới tính";}     ?></option>
                                                            <option   value="Khong xac dinh"> Không xác định </option>
                                                            <option value="Nam">Nam</option>
                                                            <option value="Nữ">Nữ</option>
                                                            <option value="Khác">Khác</option>
                                                    </select>
                                                </div>
                                                <div class="thongtincanhan_container_right_mid_top_nghenghiep">
                                                        <label for="" class="thongtincanhan_container_right_mid_top_right_chu">Nghề nghiệp</label>
                                                        <br><textarea  class="frames" name="txtNghenghiep" id="" cols="30" rows="10" placeholder="Nghề nghiệp"> <?php   if(   mysqli_num_rows($resultt) > 0 ) {       echo $roww["Nghenghiep"];} else{ echo "....";} ?></textarea>
                                                </div>
                                                <div class="thongtincanhan_container_right_mid_top_chuyenmon">
                                                    <label for=""class="thongtincanhan_container_right_mid_top_right_chu">Kỹ năng chuyên môn</label>
                                                    <br><textarea  class="frames" name="txtChuyenmon" id="" cols="30" rows="10"  placeholder="Kỹ năng chuyên môn"><?php   if(   mysqli_num_rows($resultt) > 0 ) {       echo $roww["Kynangchuyenmon"];} else{ echo "....";}     ?></textarea>
                                            </div>
                                            <div class="thongtincanhan_container_right_mid_top_anhdaidien">
                                                <div id="direct_upload" class="min-height-150 d-flex border border-2x border-black-op mb-20">
                                                    <label for="" class="thongtincanhan_container_right_mid_top_right_chu">Ảnh đại diện</label>
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
                                                <label for="" class="thongtincanhan_container_right_mid_top_right_chu" style="margin-top: 2%;">Về tôi</label>
                                                <br><textarea  name="editor" class="ckeditor" id="editor" placeholder="Về tôi"><?php   if(   mysqli_num_rows($resultt) > 0 ) {       echo $roww["Vetoi"];} else{ echo "....";}     ?></textarea>
                                                    <script>
                                                        CKEditor.replace('editor');
                                                    </script>
                                            </div>
                                            </div>
                                        </div>
                                        <h3 style="font-size: 25px; font-weight: 500; margin-bottom: 1%; margin-top: 2%;" > Thông tin liên hệ </h3>
                                        <hr>
                                        <div  class=" thongtincanhan_container_right_mid_bot">
                                        
                                                    <div  class=" thongtincanhan_container_right_mid_bot_left">
                                                            <h5>Thông tin để mọi người có thể liên lạc với bạn khi cần.</h5>
                                                    </div>
                                                    <div class=" thongtincanhan_container_right_mid_bot_right">
                                                            <div  class=" thongtincanhan_container_right_mid_bot_right_sodienthoai">
                                                                    <label for=""  class="thongtincanhan_container_right_mid_bot_right_chu">Số điện thoại</label>
                                                                    <br><input type="text" class="frames"  name="txtSodienthoai" id=""placeholder="Số điện thoại" value=" <?php   if(   mysqli_num_rows($resultt) > 0 ) {       echo $roww["Sodienthoai"];} else{ echo "Số điện thoại";}     ?>">
                                                            </div>
                                                            <div  class=" thongtincanhan_container_right_mid_bot_right_diachi">
                                                                <label for="" class="thongtincanhan_container_right_mid_bot_right_chu" >Địa chỉ</label>
                                                                <br><input type="text"  class="frames" name="txtDiachi" id=""  placeholder="Địa chỉ" value=" <?php   if(   mysqli_num_rows($resultt) > 0 ) {       echo $roww["Diachi"];} else{ echo "Địa chỉ";}     ?>">
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
                                        <i class="fas fa-save"></i>  Lưu thay dổi
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
                        <p>Thông tin Kteam</p>
                        <ul>
                            <li><a href="#">Về Kteam</a></li>
                            <li><a href="#">Dịch vụ</a></li>
                            <li><a href="#">Liên hệ</a></li>
                        </ul>
                        <p>Đóng góp từ cộng đồng</p>
                        <ul>
                            <li><a href="#">Tài trợ</a></li>
                            <li><a href="#">Người ủng hộ</a></li>
                        </ul>
                    </div>
                    <div class="colum2">
                        <p>Lĩnh vực</p>
                        <ul>
                            <li><a href="#">Lập trình</a></li>
                            <li><a href="#">Microsoft Office 2016</a></li>
                            <li><a href="#">IT & Phần mềm</a></li>
                            <li><a href="#">Đồ họa hình ảnh </a></li>
                            <li><a href="#">Kinh tế</a></li>
                            <li><a href="#">Ngoại ngữ</a></li>
                            <li><a href="#">Kỹ Năng mềm </a></li>
                            <li><a href="#">Tin tức</a></li>
                        </ul>
                    </div>
                    <div class="colum3">
                        <p>Khóa học</p>
                        <ul>
                            <li><a href="#"> Microsoft Word 2016</a></li>
                            <li><a href="#">Microsoft Excel 2016</a></li>
                            <li><a href="#">Microsoft PowerPoint 2016</a></li>
                            <li><a href="#">Khóa học lập trình Android cơ bản </a></li>
                            <li><a href="#">Góc lập trình viên</a></li>
                            <li><a href="#">Dành cho người mới</a></li>
                            <li><a href="#">Hướng dẫn cài đặt </a></li>
                            <li><a href="#">Thủ thuật máy tính</a></li>
                            <li><a href="#">Xem thêm...</a></li>
                        </ul>
                    </div>
                    <div class="colum4">
                        <p>Cộng đồng</p>
                        <ul>
                            <li><a href="#"> Hỏi đáp</a></li>
                            <li><a href="#">Tài liệu </a></li>
                            <li><a href="#">Chiến dịch</a></li>
                        </ul>
                        <p>Liên kết</p>
                        <ul>
                            <li><a href="#"> Vted - Học toán online chất lượng cao</a></li>
                            <li><a href="#"> Lập trình VB.NET</a></li>
                            <li><a href="#"> Linux Team Việt Nam</a></li>
                        </ul>
                    </div>
                    <div class="colum5">
                        <p>Kết nối Kteam</p>
                        <p>Kết nối với Kteam qua mạng xã hội</p>
                        <div class="icon">
                            <a href="https://www.facebook.com/datbe.us">
                                <i class="icon-facebook fab fa-facebook-square"></i>
                            </a>
                            <a href="#">
                                <i class="icon-youtube fab fa-youtube-square"></i>
                            </a>
                        </div>
                        <p>Chứng nhận</p>
                        <img src="https://images.dmca.com/Badges/dmca-badge-w150-5x1-01.png?ID=69d56ff4-063f-4275-811c-3338b7e3d82e"
                            alt="">
                    </div>
                </div>
                <hr>
                <div class="mb-10">
                    <span>Howkteam © 2021</span>
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
                    Nội dung
                </a>
                <button class="icon-close js-close">
                    <i class="close-icon fas fa-times"></i>
                </button>
            </div>
            <div class="container__learn">
                <div class="list_learn">
                    <div class="title">
                        <i class="fas fa-fw fa-list"></i>
                        <p>Danh sách bài giảng </p>
                    </div>
                    <div class="lesson">
                        <div class="search">
                            <input type="text" placeholder="Tìm bài học...">
                            <button class="btn_search">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        <p>
                            <i class="fas fa-fw fa-list"></i>
                            Nhập xuất cơ bản
                        </p>
                        <ul class="nav">
                            <li>
                                <span>01. Tính và hiển thị ra màn hình tổng hai số nguyên bất kỳ</span>
                            </li>
                            <li>
                                <span>02. Tính tổng hai số nguyên bất kỳ (Có xử lý ngoai lệ đầu vào).</span>
                            </li>
                            <li>
                                <span>03. Hiển thị từ cách nhau bởi ký tự "--" ra màn hình </span>
                            </li>
                            <li>
                                <span>04. Nhập số bât kỳ ở hệ thập phân và hiển thị ra hệ bát phân.</span>
                            </li>
                            <li>
                                <span>05. Nhập số bât kỳ ở hệ thập phân và hiển thị ra hệ bát phân.(Có xử lý ngoại lệ
                                    đầu vào) </span>
                            </li>
                            <li>
                                <span>06. Làm tròn chữ số thập phân A đến B sau dấu phẩy </span>
                            </li>
                            <li>
                                <span>07. Làm tròn chữ số thập phân A đến B sau dấu phẩy.(Có xử lý ngoại lệ đầu vào)
                                </span>
                            </li>
                            <li>
                                <span>08. Nhập và tính tổng dãy số nguyên bất kỳ cách nhau bởi khoảng trắng (Có xử lý
                                    ngoại lệ đầu vào) </span>
                            </li>
                            <li>
                                <span>09.Nhập từ file input {tên}, {tuổi hiện tại} và xuất ra file output theo mẫu
                                </span>
                            </li>
                            <li>
                                <span>10.Nhập từ file input {tên}, {tuổi hiện tại} và xuất ra file output theo mẫu (Có
                                    xử lý định dạng đầu vào)</span>
                            </li>
                            <li>
                                <span>11. Tính và hiển thị ra màn hình tổng hai sô nguyên bất kỳ </span>
                            </li>
                            <li>
                                <span>12. Xuất file output trên 1 dòng từ chuỗi input bất kỳ nhập vào từ nhiều dòng (Có
                                    xử lý ngoại lệ đầu vào) </span>
                            </li>
                            <li>
                                <span>13. Nhập tên, chiều cao và so sánh chiều cao (cm) của hai bạn </span>
                            </li>
                            <li>
                                <span>14. Nhập tên, chiều cao và so sánh chiều cao của hai bạn (Có xử lý ngoại lệ đầu
                                    vào) </span>
                            </li>
                            <li>
                                <span>15. Nhập và kiểm tra ba số a, b, c có là cạnh của một tam giác không? </span>
                            </li>
                            <li>
                                <span>16. Nhập và kiểm tra ba số a, b, c có là cạnh của một tam giác không? (Có xử lý
                                    ngoại lệ đầu vào) </span>
                            </li>
                            <li>
                                <span>17. Tính và xuất kết quả máy tính đơn giản với hai số </span>
                            </li>
                            <li>
                                <span>18. Giải phương trình bậc hai</span>
                            </li>
                            <li>
                                <span>19. Giải phương trình bậc hai (Có xử lý ngoại lệ đầu vào) </span>
                            </li>
                            <li>
                                <span>20. Nhập file input và xác định loại tam giác </span>
                            </li>
                            <li>
                                <span>21. Tính tổng các số nguyên trong khoảng a đến b. (Vòng lặp while) </span>
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
                title: "Thất bại!",
                message: "Hệ thống đang nâng cấp , hẹn gặp bạn vào dịp khác",
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