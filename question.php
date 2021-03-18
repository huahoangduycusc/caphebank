<?php
error_reporting(0);
define('IN_SITE',true);
$rootpath = '';
require_once('lib/core.php');
require_once('lib/header.php');
?>
<section class="h3-title">
    <div class="container">
        <div class="center">
            <h3>FAQ</h3>
            <h3>Câu hỏi thường gặp</h3>
        </div>
    </div>
</section>
<div class="body-content">
    <div class="container">
        <p style="font-size:18px">Dưới đây là nhưng câu hỏi thường gặp, bạn có thể tìm thấy nội dung
            mà mong muốn trong những câu hỏi này</p>
    <div class="accordion">
        <?php
        $q = Question::getList();
        foreach($q as $item)
        {
            ?>
        <div class="accordion-item">
            <div class="item-header">
                <h1 class="title"><?php echo $item['question_name'];?></h1>
            </div>
            <p class="text"><?php echo html_entity_decode($item['question_answer']);?></p>
        </div>
        <?php
        }
        ?>
    </div>
</div>
</div>
<script>
$('.item-header').click(function() {
    $('.accordion-item').removeClass('active');
    $(this).parent().addClass('active');
    $('.icon').text('+');
    $(this).children('.icon').text('-');
});
</script>
<?php
require_once('lib/footer.php');
?>