<?php
if(!defined('IN_SITE')) die('Error: restricted access');
?>
    <footer>
        <div class="footer">
            <div class="footer-container">
             <div class="footer-col">
                 <h2 class="footer-title">Địa chỉ</h2>
                 <p><i class="fas fa-map-marker-alt"></i> <?php echo $sys['address'];?></p>
             </div>
             <!-- footer col -->
             <div class="footer-col">
                <h2 class="footer-title">Hỗ trợ</h2>
                <?php
                $contacts = Contact::getList();
                foreach($contacts as $contact)
                {
                    ?>
                    <p><i class="fas fa-signature"></i> <?php echo $contact['contact_name'];?> - <?php echo $contact['contact_phone'];?></p>
                    <?php
                }
                ?>
            </div>
            <!-- footer col -->
            <div class="footer-col">
                <h2 class="footer-title">HOTLINE</h2>
                <p>
                    <i class="fas fa-phone-volume"></i> <?php echo $sys['phone'];?>
                </p>
            </div>
            <!-- footer col -->
            <div class="footer-col">
                <h2 class="footer-title">EMAIL</h2>
                <p>
                    <i class="far fa-envelope"></i> <a href="mailto:<?php echo $sys['email'];?>"><?php echo $sys['email'];?></a>
                </p>
            </div>
            <!-- footer col -->
            </div>
            <div class="footer-full">
                <?php echo $sys['copyright'];?>
            </div>
            <!-- container -->
        </div>
        <!-- footer -->
    </footer>
    <script src="<?php echo homeurl();?>js/app.js"></script>
</body>
</html>