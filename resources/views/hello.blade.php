<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>大数据系统基础（项目25）</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" />

    <!-- font
    <link  rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,500,500i,600,700,800,900|Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dosis:300,400,500,600,700,800">
-->
    <!-- Plugins -->
    <link rel="stylesheet" type="text/css" href="css/plugins-css.css" />

    <!-- revoluation -->
    {{--<link rel="stylesheet" type="text/css" href="revolution/css/settings.css" media="screen" />--}}

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
                                        <a href="index-01.html"><img id="logo_img" src="images/logo.png" alt="logo"> </a>
                                    </li>
                                </ul>
                                <!-- menu links -->
                                {{--<div class="menu-bar">--}}
                                    {{--<ul class="menu-links">--}}
                                        {{--<li class="active"><a href="javascript:void(0)" >Home</a></li>--}}
                                        {{--<li><a href="#process">Process</a></li>--}}
                                        {{--<!--            <li><a href="#result">Result</a></li>-->--}}
                                    {{--</ul>--}}
                                {{--</div>--}}
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
    <section class="slider-parallax jobs-banner bg-overlay-black-70 parallax" data-jarallax='{"speed": 0.7}' style="background-image: url('images/bg.png');">
        <div class="slider-content-middle">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="slider-content text-center">
                            <h2 class="text-white mb-20">基于 <strong class="theme-color"> 风格一致性的 </strong> 时尚服饰检索 </h2>
                            {{--<h2 class="text-white mb-20"> Upload a Photo! </h2>--}}
                            {{--<span class="text-white">基于 <strong class="theme-color"> 风格一致性的 </strong> 时尚服饰检索 </span>--}}
                            <div class="row justify-content-center form pb-20 xs-mt-20">
                                <div class="col-md-4 mt-20">
                                    <div class="newsletter fancy mb-10">
                                        <form method="get" action="/upload" id="upload_url" enctype="multipart/form-data">
                                            <input type="search" name="upload_img" class="white-bg form-control" placeholder="輸入圖片連結" onkeydown="enterIn(event)">
                                            <div class="clear">
                                                <button type="submit" name="submitbtn" class="button form-button1"><i class="fa fa-search"></i></button>
                                            </div>
                                        </form>
                                    </div>
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
                            <h6 class="text-white ft-1">（上傳圖片格式為jpg,png 且小於10MB）</h6>
                            <!--
                                        <b class="text-white d-block mt-20">just to bring it into focus <a href="#">Join us to day</a> </b>
                                        <div class="mt-40">
                                          <a class="button" href="#">Post a job</a>
                                          <a class="button white button-border" href="#">Job list</a>
                                        </div>
                            -->
                            {{--<h2 class="text-white mt-20 mb-10"> or choose a style </h2>--}}
                            <div class="row justify-content-center">
                                {{--<div class="owl-carousel" data-nav-dots="false" data-nav-arrow="false" data-items="6" data-md-items="5" data-sm-items="4" data-xs-items="3" data-xx-items="1" data-space="10" data-nav-dots="false" data-nav-arrow="false" >--}}
                                <div class="mt-50 col-md-8 owl-carousel" data-items="5" data-md-items="5" data-sm-items="4" data-xs-items="3" data-xx-items="2" data-space="10" data-nav-dots="false" data-nav-arrow="false" >
                                    @foreach($url as $item)
                                        <a href="{{$site . "upload?upload_img=" . $site . $item}}">
                                            <div class="item">
                                                <img class="img-fluid full-width" src="{{$item}}" alt="">
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
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

    <section id="goal" class="blockquote-section testimonial-title page-section-ptb">
        <div class="container">
            <div class="row no-gutter">
                <div class="col-sm-12 text-center">
                    <blockquote class="blockquote quote mb-0">
                        我們希望利用图片识别分析穿搭照片中的<span class="title-effect underline"> 潜在风格 </span>，帮助用户找到想要的服装搭配。

                    </blockquote>
                </div>
            </div>
        </div>
    </section>

    <section id="members" class="page-section-ptb gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title  text-center">
                        <h6 class="subtitle">大数据系统基础（项目25）</h6>
                        <h2 class="title"> Team <span class="theme-bg"> Members  </span> </h2>
                    </div>
                </div>
            </div>

            <div class="row mt-30">
                <div class="col-lg-12 col-md-12">
                    <div class="owl-carousel" data-nav-dots="true" data-nav-arrow="true" data-items="4" data-md-items="3" data-sm-items="3" data-xs-items="2" data-xx-items="1" data-space="20">
                        <div class="item">
                            <div class="team team-border">
                                <!--
                                                      <div class="team-photo">
                                                        <img class="img-fluid mx-auto" src="images/team/01.png" alt="">
                                                      </div>
                                -->
                                <div class="team-description">
                                    <div class="team-info">
                                        <h5><a href="#">刘芳</a></h5>
                                        <span>数据组</span>
                                    </div>
                                    <div class="team-contact">
                                        <span class="call"> +(704) 279-1249</span>
                                        <span class="email"> <i class="fa fa-envelope-o"></i>janaliu89@163.com</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="team team-border">
                                <!--
                                                      <div class="team-photo">
                                                        <img class="img-fluid mx-auto" src="images/team/01.png" alt="">
                                                      </div>
                                -->
                                <div class="team-description">
                                    <div class="team-info">
                                        <h5><a href="#">张玍</a></h5>
                                        <span>数据组</span>
                                    </div>
                                    <div class="team-contact">
                                        <span class="call"> +(704) 279-1249</span>
                                        <span class="email"> <i class="fa fa-envelope-o"></i>1131691462@qq.com</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="team team-border">
                                <!--
                                                      <div class="team-photo">
                                                        <img class="img-fluid mx-auto" src="images/team/01.png" alt="">
                                                      </div>
                                -->
                                <div class="team-description">
                                    <div class="team-info">
                                        <h5><a href="#">陈威铭</a></h5>
                                        <span>市場組</span>
                                    </div>
                                    <div class="team-contact">
                                        <span class="call"> +(704) 279-1249</span>
                                        <span class="email"> <i class="fa fa-envelope-o"></i>929626018@qq.com</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="team team-border">
                                <!--
                                                      <div class="team-photo">
                                                        <img class="img-fluid mx-auto" src="images/team/01.png" alt="">
                                                      </div>
                                -->
                                <div class="team-description">
                                    <div class="team-info">
                                        <h5><a href="#">黄凯欣</a></h5>
                                        <span>市場組</span>
                                    </div>
                                    <div class="team-contact">
                                        <span class="call">2018270109</span>
                                        <span class="email"> <i class="fa fa-envelope-o"></i>hoiyan28@hotmail.com</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="team team-border">
                                <!--
                                                      <div class="team-photo">
                                                        <img class="img-fluid mx-auto" src="images/team/01.png" alt="">
                                                      </div>
                                -->
                                <div class="team-description">
                                    <div class="team-info">
                                        <h5><a href="#">刘志成</a></h5>
                                        <span>模型组</span>
                                    </div>
                                    <div class="team-contact">
                                        <span class="call"> +(704) 279-1249</span>
                                        <span class="email"> <i class="fa fa-envelope-o"></i>lzc18@mails.tsinghua.edu.cn</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="team team-border">
                                <!--
                                                      <div class="team-photo">
                                                        <img class="img-fluid mx-auto" src="images/team/01.png" alt="">
                                                      </div>
                                -->
                                <div class="team-description">
                                    <div class="team-info">
                                        <h5><a href="#">卢光宏</a></h5>
                                        <span>組長</span>
                                    </div>
                                    <div class="team-contact">
                                        <span class="call">。。</span>
                                        <span class="email"> <i class="fa fa-envelope-o"></i>845579063@qq.com</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="team team-border">
                                <!--
                                                      <div class="team-photo">
                                                        <img class="img-fluid mx-auto" src="images/team/01.png" alt="">
                                                      </div>
                                -->
                                <div class="team-description">
                                    <div class="team-info">
                                        <h5><a href="#">陈之威</a></h5>
                                        <span>模型组</span>
                                    </div>
                                    <div class="team-contact">
                                        <span class="call"> 。。。</span>
                                        <span class="email"> <i class="fa fa-envelope-o"></i>czw18@mails.tsinghua.edu.cn</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="team team-border">
                                <!--
                                                      <div class="team-photo">
                                                        <img class="img-fluid mx-auto" src="images/team/01.png" alt="">
                                                      </div>
                                -->
                                <div class="team-description">
                                    <div class="team-info">
                                        <h5><a href="#">潘海楠</a></h5>
                                        <span>数据组</span>
                                    </div>
                                    <div class="team-contact">
                                        <span class="call"> +(704) 279-1249</span>
                                        <span class="email"> <i class="fa fa-envelope-o"></i>402945786@qq.com</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="process" class="process-list white-bg page-section-pt">
        <div class="container">
            <div class="row ">
                <div class="col-sm-12">
                    <div class="process left">
                        <div class="process-step">
                            <strong>01</strong>
                        </div>
                        <div class="process-content">
                            <div class="process-icon">
                                <span class="flaticon-line"></span>
                            </div>
                            <div class="process-info1">
                                <h5 class="mb-20"> 爬取图片</h5>
                                <p>5000張連衣裙</p>

                                <div class="owl-carousel" data-nav-dots="false" data-nav-arrow="false" data-items="6" data-md-items="5" data-sm-items="4" data-xs-items="3" data-xx-items="1" data-space="10" data-nav-dots="false" data-nav-arrow="false" >
                                    <div class="item">
                                        <img class="img-fluid full-width" src="images/dress/01.jpg" alt="">
                                    </div>
                                    <!--
                                                     <div class="item">
                                                      <img class="img-fluid full-width" src="images/dress/02.jpg" alt="">
                                                    </div>
                                    -->
                                    <div class="item">
                                        <img class="img-fluid full-width" src="images/dress/03.jpg" alt="">
                                    </div>
                                    <div class="item">
                                        <img class="img-fluid full-width" src="images/dress/04.jpg" alt="">
                                    </div>
                                    <div class="item">
                                        <img class="img-fluid full-width" src="images/dress/05.jpg" alt="">
                                    </div>
                                    <div class="item">
                                        <img class="img-fluid full-width" src="images/dress/06.jpg" alt="">
                                    </div>
                                    <div class="item">
                                        <img class="img-fluid full-width" src="images/dress/07.jpg" alt="">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="border-area left-bottom"></div>
                    </div>
                    <div class="process right">
                        <div class="process-step">
                            <strong>02</strong>
                        </div>
                        <div class="process-content text-right">
                            <div class="process-icon">
                                <span class="flaticon-technology-1"></span>
                            </div>
                            <div class="process-info">
                                <h5 class="mb-20"> 数据清理</h5>
                                <p>透過.....</p>
                                <span class="round-chart" data-percent="77" data-width="4" data-color="#ed5001"> <span class="percent" style="color:#ed5001; "></span> </span>
                            </div>
                        </div>
                        <div class="border-area right-top"></div>
                        <div class="border-area right-bottom"></div>
                    </div>
                    <div class="process left">
                        <div class="process-step">
                            <strong>03</strong>
                        </div>
                        <div class="process-content">
                            <div class="process-icon">
                                <span class="flaticon-computer"></span>
                            </div>
                            <div class="process-info">
                                <h5 class="mb-20"> 数据标注</h5>
                                束腰、袖長、裙長、顏色、裙型、花紋
                            </div>
                        </div>
                        <div class="border-area left-bottom"></div>
                        <div class="border-area left-top"></div>
                    </div>

                    <div class="process right">
                        <div class="process-step">
                            <strong>04</strong>
                        </div>
                        <div class="process-content text-right">
                            <div class="process-icon">
                                <span class="flaticon-stopwatch-tool-to-control-test-time"></span>
                            </div>
                            <div class="process-info">
                                <h5 class="mb-20"> 区域识别</h5>
                                <p>The end product is put through multiple rounds of rigorous testing to ensure it is bug-free with all functionalities operating as expected. Several rounds of unit testing and system integration testing assess the work done through the above <strong> web development phases </strong> and changes are made wherever a discrepancy is witnessed. Only after getting a sign-off on the UAT the testing phase is brought to an end.</p>

                            </div>
                        </div>
                        <div class="border-area right-top"></div>
                        <div class="border-area right-bottom"></div>
                    </div>

                    <div class="process left">
                        <div class="process-step">
                            <strong>05</strong>
                        </div>
                        <div class="process-content">
                            <div class="process-icon">
                                <span class="flaticon-rocket-launch"></span>
                            </div>
                            <div class="process-info">
                                <h5 class="mb-20"> 属性生成</h5>
                                <p>After all the quality checks and a green signal from the business the website is launched. After initial support on day-to-day activities the reins are handed over to the business. However, our post deployment maintenance services render necessary assistance and troubleshooting services.</p>
                            </div>
                        </div>
                        <div class="border-area left-bottom"></div>
                        <div class="border-area left-top"></div>
                    </div>

                    <div class="process right">
                        <div class="process-step">
                            <strong>06</strong>
                        </div>
                        <div class="process-content text-right">
                            <div class="process-icon">
                                <span class="flaticon-stopwatch-tool-to-control-test-time"></span>
                            </div>
                            <div class="process-info">
                                <h5 class="mb-20"> 风格匹配</h5>
                                <p>The end product is put through multiple rounds of rigorous testing to ensure it is bug-free with all functionalities operating as expected. Several rounds of unit testing and system integration testing assess the work done through the above <strong> web development phases </strong> and changes are made wherever a discrepancy is witnessed. Only after getting a sign-off on the UAT the testing phase is brought to an end.</p>
                            </div>
                        </div>
                        <div class="border-area right-top"></div>
                        <!--           <div class="border-area right-bottom"></div>-->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--
    <section class=" page-section-ptb bg-overlay-theme-90 parallax" data-jarallax='{"speed": 0.6}' style="background-image: url(images/bg/02.jpg);">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="text-white fw-6">Make a difference with your online CV!</h2>
            <p class="text-white mt-20">我們希望利用图片识别分析穿搭照片中的潜在风格，帮助用户找到想要的服装搭配。</p>
            <div class="mt-30">
              <a class="button icon white button-border xs-mt-10" target="_blank" href="#">
                Create an account
                <i class="fa fa-hand-o-right"></i>
             </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    -->
    <section class="theme-bg pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 text-center text-white">
                    <h3 class="mb-20 text-white">離期末答辯還剩！</h3>
                    <div class="countdown small">
                        <span class="days">00</span>
                        <p class="days_ref text-white">days</p>
                    </div>
                    <div class="countdown small">
                        <span class="hours">00</span>
                        <p class="hours_ref text-white">hours</p>
                    </div>
                    <div class="countdown small">
                        <span class="minutes">00</span>
                        <p class="minutes_ref text-white">minutes</p>
                    </div>
                    <div class="countdown small">
                        <span class="seconds">00</span>
                        <p class="seconds_ref text-white">seconds</p>
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
{{--<script src="revolution/js/jquery.themepunch.tools.min.js"></script>--}}
{{--<script src="revolution/js/jquery.themepunch.revolution.min.js"></script>--}}

{{--<!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->--}}
{{--<script src="revolution/js/extensions/revolution.extension.actions.min.js"></script>--}}
{{--<script src="revolution/js/extensions/revolution.extension.carousel.min.js"></script>--}}
{{--<script src="revolution/js/extensions/revolution.extension.kenburn.min.js"></script>--}}
{{--<script src="revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>--}}
{{--<script src="revolution/js/extensions/revolution.extension.migration.min.js"></script>--}}
{{--<script src="revolution/js/extensions/revolution.extension.navigation.min.js"></script>--}}
{{--<script src="revolution/js/extensions/revolution.extension.parallax.min.js"></script>--}}
{{--<script src="revolution/js/extensions/revolution.extension.slideanims.min.js"></script>--}}
{{--<script src="revolution/js/extensions/revolution.extension.video.min.js"></script>--}}
{{--<!-- revolution custom -->--}}
{{--<script src="revolution/js/revolution-custom.js"></script>--}}

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
