<?php
error_reporting(0);
define('IN_SITE',true);
$rootpath = '';
require_once('lib/core.php');
$article = Article::getRow($id,1);
if(!$article){
    redirect(homeurl());
}
require_once('lib/header.php');
?>
   <section class="news-title">
        <div class="container">
            <ul class="clearfix">
                <li><a href="<?php echo homeurl();?>">Home</a>  » </li>
                <li><span> <?php echo $article['article_name'];?></span></li>
            </ul>
        </div>
    </section>
    <div class="body-content">
        <div class="container">
            <div class="news-thumbnail">
                <img src="<?php echo homeurl().$article['thumbnail'];?>" alt="">
            </div>
            <br>
            <div class="news-time-create">
               <span> <?php echo $article['created_at'];?></span>
                <span> Xem : <?php echo $article['view'];?></span>
            </div>
            <div class="news-content">
                <div class="news-header">
                    <h1><?php echo $article['article_name'];?></h1>
                </div>
                <div class="news-body">
                   <?php echo html_entity_decode($article['description']);?>
                </div>
            </div>
        </div>
    </div>
<?php
require_once('lib/footer.php');
?>