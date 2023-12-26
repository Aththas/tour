<section class="footer">

    <div class="box-container">

        <div class="box" data-aos="fade-up" data-aos-delay="150">
            <a href="#" class="logo"> <i class="fas fa-paper-plane"></i>lanka tours </a>
            <p>“Leave nothing but footprints, take nothing but photos, kill nothing but time.”</p>
            <br>
            <br>
            <p>Follow us on social medias</p>
            <div class="share">
                <a href="#" class="fab fa-facebook-f"></a>
                <a href="#" class="fab fa-twitter"></a>
                <a href="#" class="fab fa-instagram"></a>
                <a href="#" class="fab fa-linkedin"></a>
            </div>
        </div>

        <div class="box" data-aos="fade-up" data-aos-delay="300">
            <h3>quick links</h3>
            <?php 
        		$rs_fmenu = mysqli_query($link,"select * from menu order by menu_order");
        		while($row_fmenu = mysqli_fetch_array($rs_fmenu))
        		{
            		$type = $row_fmenu["type"];
            		if($type == "shop")
            		{
                		?>
                		<a href="<?php echo $row_fmenu["link"]; ?>?id=none" class="links"> <i class="fas fa-arrow-right"></i> <?php echo $row_fmenu["name"]; ?> </a>
                		<?php
            		}
            		else
            		{
                		?>
                			<a href="<?php echo $row_fmenu["link"]; ?>" class="links"> <i class="fas fa-arrow-right"></i> <?php echo $row_fmenu["name"]; ?> </a>
                		<?php
            		}
        		}
        	?>

        </div>

        <div class="box" data-aos="fade-up" data-aos-delay="450">
            <h3>contact info</h3>
            <?php 
            $rs_admin_details = mysqli_query($link,"select * from admin where id = 'A0001'");
            while($row_admin_details = mysqli_fetch_array($rs_admin_details))
            {
            	?>
            		<p> <i class="fas fa-map"></i> <?php echo $row_admin_details["location"]; ?></p>
            		<p> <i class="fas fa-phone"></i> <?php echo $row_admin_details["contact_no"]; ?></p>
            		<p> <i class="fas fa-envelope"></i> <?php echo $row_admin_details["email"]; ?></p>
            		<p> <i class="fas fa-clock"></i> <?php echo $row_admin_details["available_time"]; ?></p>
            	<?php
            }
            ?>
            
        </div>

        <div class="box" data-aos="fade-up" data-aos-delay="600">
            <h3>newsletter</h3>
            <p>subscribe for latest updates</p>
            <form action="" method="POST">
                <input type="email" name="sub_email" placeholder="enter your email" class="email" id="">
                <input type="submit" value="subscribe" class="btn" name="subscribe">
            </form>
        </div>

    </div>

</section>
<div class="credit"><span>2022 Travel</span> | all rights reserved!</div>

<?php
	if(isset($_POST["subscribe"]))
	{
		if($_POST["sub_email"] == "")
		{
			?>
                <script type="text/javascript">
                    swal({
                        title: "Subscription",
                        text: "Email Must Be Fill !!!",
                        icon: "error"
                    }).then(function() {
                        window.location = "<?php echo $home_link; ?>";
                    });
                </script>
            <?php
		}
		else
		{
            $rs_sub = mysqli_query($link, "select count(*) from subscribe where email = '$_POST[sub_email]'");
            $row_sub = mysqli_fetch_row($rs_sub);
            $sub = $row_sub[0];
                if($sub == 0)
                {
			     mysqli_query($link, "insert into subscribe values('','$_POST[sub_email]')");
			     ?>
                    <script type="text/javascript">
                    swal({
                        title: "Subscription",
                        text: "Subscription Added Successfully !!!",
                        icon: "success"
                    }).then(function() {
                        window.location = "<?php echo $home_link; ?>";
                    });
                    </script>
                 <?php
                }
                else
                {
                   ?>
                    <script type="text/javascript">
                    swal({
                        title: "Subscription",
                        text: "You Have Already Subscribed !!!",
                        icon: "info"
                    }).then(function() {
                        window.location = "<?php echo $home_link; ?>";
                    });
                    </script>
                 <?php 
                }
		}
	}
?>