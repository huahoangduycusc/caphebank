<?php
error_reporting(0);
define('IN_SITE',true);
$rootpath = '';
require_once('lib/core.php');
require_once('lib/header.php');
?>
<style>
/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.prev{
    left: 0;
    border-radius: 3px 0 0 3px;
}
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 12px;
  width: 12px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .prev, .next,.text {font-size: 11px}
}
</style>
    <div class="body-content">
        <div class="slogan">
            <h1>Vay tiền nhanh chóng với lãi suất cực hấp dẫn</h1>
            <p>Thủ tục vay tiền đơn giản, nhanh chóng chỉ bằng 1 cú nhấp chuột.</p>
            <div class="banner">
            <div class="slideshow-container">
                <?php
                $slides = Slide::getList(1);
                foreach($slides as $slide)
                {
                    ?>
                    <div class="mySlides fade">
                        <img src="<?php echo homeurl().$slide['slide_name'];?>" style="width:100%">
                    </div>
                    <?php
                }
                ?>
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
                </div>
                <br>
                <div style="text-align:center">
                <?php
                $i = 1;
                foreach($slides as $slide)
                {
                    ?>
                    <span class="dot" onclick="currentSlide(<?php echo $i; ?>)"></span> 
                    <?php
                    $i++;
                }

                ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="slogan1">
                <h1 class="center">Đăng ký cộng tác viên để trở thành 1 phần của chúng tôi</h1>
                <div class="process-inner">
                    <div class="row">
                        <div class="col-sm-6 col-m-4">
                            <div class="process-item">
                                <div class="image-holder">
                                    <img src="./public/process-image-5.png" alt="">
                                </div>
                                <div class="content-holder">
                                    <h3>Tạo link</h3>
                                    <p>Sau khi đăng ký thành công, mỗi tài khoản sẽ được cung cấp 1 liên kết riêng biệt</p>
                                </div>
                            </div>
                        </div>
                        <!-- col -->
                        <div class="col-sm-6 col-m-4">
                            <div class="process-item">
                                <div class="image-holder">
                                    <img src="./public/process-image-6.png" alt="">
                                </div>
                                <div class="content-holder">
                                    <h3>Quảng bá link</h3>
                                    <p>Chia sẻ link (liên kết) thông qua website, blog, mạng xã hội, digital marketing</p>
                                </div>
                            </div>
                        </div>
                        <!-- col -->
                        <div class="col-sm-6 col-m-4">
                            <div class="process-item">
                                <div class="image-holder">
                                    <img src="./public/process-image-8.png" alt="">
                                </div>
                                <div class="content-holder">
                                    <h3>Nhận hoa hồng</h3>
                                    <p>Nhận hoa hồng từ mỗi form đăng ký vay tiền, mỗi form được duyệt bạn sẽ nhận được từ 10% hoa hồng.</p>
                                </div>
                            </div>
                        </div>
                        <!-- col -->
                    </div>
                </div>
                <div class="row center">
                    <a href="" class="more">Tìm hiểu thêm</a>
                </div>
            </div>
        </div>
    </div>
    <div class="slogan2">
        <h1 class="title center">TẠI SAO NÊN CHỌN CHÚNG TÔI ?</h1>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col col-m-6 col-4">
                    <div class="why-choose">
                        <span class="icon-bg">
                            <i class="fas fa-dollar-sign"></i>
                        </span>
                        <span class="icon-text">
                            <h3>Lãi suất hấp dẫn</h3>
                        </span>
                    </div>
                </div>
                <!-- col -->
                <div class="col-sm-6 col col-m-6 col-4">
                    <div class="why-choose">
                        <span class="icon-bg">
                            <i class="fas fa-clock"></i>
                        </span>
                        <span class="icon-text">
                            <h3>Giải ngân nhanh</h3>
                        </span>
                    </div>
                </div>
                <!-- col -->
                <div class="col-sm-6 col col-m-6 col-4">
                    <div class="why-choose">
                        <span class="icon-bg">
                            <i class="fas fa-book-open"></i>
                        </span>
                        <span class="icon-text">
                            <h3>Thủ tục đơn giản</h3>
                        </span>
                    </div>
                </div>
                <!-- col -->
            </div>
            <div class="row">
            <div class="center">
                    <a href="vay-tien" class="more line">Vay tiền ngay</a>
                </div>
            </div>
        </div>
    </div>
    <div class="news">
        <h3 class="section-title">Tin tức</h3>
        <div class="container">
            <div class="row">
                <?php
                $listNews = Article::getList(1);
                foreach($listNews as $new){
                    $overUrl = Article::rewriteUrl($new['article_id']);
                    ?>
                    <div class="col-sm-4 col-m-4">
                        <div class="news-item">
                            <a href="<?php echo $overUrl;?>">
                                <img src="<?php echo homeurl().$new['thumbnail'];?>" alt="">
                            </a>
                            <span class="news-date"><?php echo $new['created_at'];?></span>
                            <h2 class="news-title"><a href="<?php echo $overUrl;?>"><?php echo $new['article_name'];?></a></h2>
                            <div class="news-description">
                                
                            </div>
                        </div>
                        <!-- news item -->
                    </div>
                    <!-- col 4 -->
                    <?php
                }
                ?>
            </div>
            <div class="row center" style="margin-top: 20px;">
                <a href="<?php echo homeurl();?>news.html" class="more">Xem thêm</a>
            </div>
        </div>
    </div>
    <script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>
<?php
require_once('lib/footer.php');
?>