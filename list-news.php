<?php
error_reporting(0);
define('IN_SITE',true);
$rootpath = '';
require_once('lib/core.php');
require_once('lib/header.php');
?>
<section class="news-title">
    <div class="container">
        <ul class="clearfix">
            <li><a href="<?php echo homeurl();?>">Home</a> » </li>
            <li><span>Tin tức</span></li>
        </ul>
    </div>
</section>
<div class="body-content">
    <div class="container">
        <div class="row">
            <?php
                $listNews = Article::getList();
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
                </div>
                <!-- news item -->
            </div>
            <!-- col 4 -->
            <?php
            }
            ?>
        </div>
    </div>
</div>
<?php
require_once('lib/footer.php');
?>