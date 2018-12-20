<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>大数据系统基础（项目25）</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" />

    <!-- font -->
<!--    <link  rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,500,500i,600,700,800,900|Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">-->
<!--    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dosis:300,400,500,600,700,800">-->

    <!-- Plugins -->
    <link rel="stylesheet" type="text/css" href="css/plugins-css.css" />

    <!-- revoluation -->
    <link rel="stylesheet" type="text/css" href="revolution/css/settings.css" media="screen" />

    <!-- Typography -->
    <link rel="stylesheet" type="text/css" href="css/typography.css" />

    <!-- Shortcodes -->
    <link rel="stylesheet" type="text/css" href="css/shortcodes/shortcodes.css" />

    <!-- Style -->
    <link rel="stylesheet" type="text/css" href="css/style.css" />

    <!-- Responsive -->
    <link rel="stylesheet" type="text/css" href="css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="css/skins/skin-orange.css" />
    <link rel="stylesheet" type="text/css" href="css/new.css" />

</head>

<body>

<div class="wrapper">

    <!--=================================
     preloader -->

    <div id="pre-loader">
        <img src="images/pre-loader/loader-23.gif" alt="">
    </div>

    <!--=================================
     preloader -->

    <!--=================================
     header -->

    <header id="header" class="header light">

        <!--=================================
         mega menu -->

        <div class="menu" id="onepagenav">
            <!-- menu start -->
            <nav id="menu" class="mega-menu">
                <!-- menu list items container -->
                <section class="menu-list-items">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <!-- menu logo -->
                                <ul class="menu-logo">
                                    <li>
                                        <a href="/"><img id="logo_img" src="images/logo.png" alt="logo"> </a>
                                    </li>
                                </ul>
                                <!-- menu links -->
                                <!--
                                        <div class="menu-bar">
                                         <ul class="menu-links">
                                           <li class="active"><a href="javascript:void(0)" >Home</a></li>
                                           <li><a href="#goal">Goal</a></li>
                                           <li><a href="#members">Members</a></li>
                                            <li><a href="#process">Process</a></li>
                                            <li><a href="#result">Result</a></li>
                                        </ul>
                                        </div>
                                -->
                            </div>
                        </div>
                    </div>
                </section>
            </nav>
            <!-- menu end -->
        </div>
    </header>

    <!--=================================
     header -->

    <!--=================================
     banner -->

    <section class="gray-bg pt-20">
        <div class="container">
            <!--     <div class="row">-->
            <div class="row justify-content-center form pb-20 xs-mt-20">
                <div class="col-md-2">
                    <img class="img-fluid full-width" src="{{$originUrl}}" alt="">
                </div>
                <div class="col-md-4 mt-20">
                    <div class="newsletter fancy mb-10">
                        <form method="get" action="/upload" id="upload_url" enctype="multipart/form-data">
                            <input type="search" name="upload_img" class="white-bg form-control" style="padding-right:20px;" placeholder="輸入圖片連結" onkeydown="enterIn(event)">
                            <div class="clear">
                                <button type="submit" name="submitbtn" class="button form-button1"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <span class="ft-1">（上傳圖片格式為jpg,png 且小於10MB）</span>
                </div>
                <div class="col-md-2 mt-20">
                    <a class="button btn-block" id="upload-btn" href="#">Upload
                        <i class="fa fa-upload"></i></a>
                </div>
                <div style="position:relative;width:120px;height:47px;top:50px;right:180px;cursor:pointer;">
                    <form method="post" action="/upload" id="upload_img" enctype="multipart/form-data">
                        <input type="file" name="upload" style="opacity: 0;width:165px;height:47px;" onchange="uploadFile()">
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!--=================================
     banner -->
    <section id="result" class="white-bg masonry-main page-section-ptb" style="display:@if(!empty($arrRes))block @else none @endif">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="isotope-filters">
                        <button data-filter="*" class="active">All</button>
                        @foreach($labels as $label)
                            <button data-filter=".{{md5($label)}}">{{$label}}</button>
                        @endforeach
                    </div>
                    <div class="masonry columns-4 popup-gallery">
                        <div class="grid-sizer"></div>
                        @foreach($arrRes as $arrItem)
                            <div class="masonry-item {{$arrItem['label_str']}}">
                                <div class="portfolio-item">
                                    <img src="{{$arrItem['url']}}" alt="">
                                    <a class="popup portfolio-img" href="{{$arrItem['url']}}"><i class="fa fa-arrows-alt"></i></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer black-bg">
        <div class="container">
            <div class="footer-widget">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p class="mt-15"> &copy;Copyright <span id="copyright"></span> <a href="#"> 大數據第12組 </a> All Rights Reserved </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!--=================================
     footer -->

</div>

<div id="back-to-top"><a class="top arrow" href="#top"><i class="fa fa-angle-up"></i> <span>TOP</span></a></div>

<!--=================================
 jquery -->

<!-- jquery -->
<script src="js/jquery-3.3.1.min.js"></script>

<!-- plugins-jquery -->
<script src="js/plugins-jquery.js"></script>

<!-- plugin_path -->
<script>var plugin_path = 'js/';</script>

<!-- REVOLUTION JS FILES -->
<!--<script src="revolution/js/jquery.themepunch.tools.min.js"></script>-->
<!--<script src="revolution/js/jquery.themepunch.revolution.min.js"></script>-->
<!---->
<!--<!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->-->
<!--<script src="revolution/js/extensions/revolution.extension.actions.min.js"></script>-->
<!--<script src="revolution/js/extensions/revolution.extension.carousel.min.js"></script>-->
<!--<script src="revolution/js/extensions/revolution.extension.kenburn.min.js"></script>-->
<!--<script src="revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>-->
<!--<script src="revolution/js/extensions/revolution.extension.migration.min.js"></script>-->
<!--<script src="revolution/js/extensions/revolution.extension.navigation.min.js"></script>-->
<!--<script src="revolution/js/extensions/revolution.extension.parallax.min.js"></script>-->
<!--<script src="revolution/js/extensions/revolution.extension.slideanims.min.js"></script>-->
<!--<script src="revolution/js/extensions/revolution.extension.video.min.js"></script>-->
<!--<!-- revolution custom -->-->
<!--<script src="revolution/js/revolution-custom.js"></script>-->

<!-- custom -->
<script src="js/custom.js"></script>
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $(document).ready(function(){

        // $("#result").hide();
        // $("#upload-btn").click(function(){
        //     $("#result").show();
        // });
    });

    function enterIn(evt) {
        var evt = evt ? evt : (window.event ? window.event : null);//兼容IE和FF
        if (evt.keyCode == 13) {
            var form = document.getElementById('upload_url');
            form.submit();
        }
    }

    function uploadFile() {
        var form = document.getElementById('upload_img');
        form.submit();
    }

</script>
</body>
</html>
