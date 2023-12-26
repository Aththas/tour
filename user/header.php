<header class="header">

    <?php
        $rs_shop_link = mysqli_query($link,"select link from menu where type = 'shop'");
        $row_shop_link = mysqli_fetch_row($rs_shop_link);
        $shop_link = $row_shop_link[0];

        $rs_about_link = mysqli_query($link,"select link from menu where type = 'about'");
        $row_about_link = mysqli_fetch_row($rs_about_link);
        $about_link = $row_about_link[0];

        $rs_gallery_link = mysqli_query($link,"select link from menu where type = 'gallery'");
        $row_gallery_link = mysqli_fetch_row($rs_gallery_link);
        $gallery_link = $row_gallery_link[0];

        $rs_blog_link = mysqli_query($link,"select link from menu where type = 'blog'");
        $row_blog_link = mysqli_fetch_row($rs_blog_link);
        $blog_link = $row_blog_link[0];

        $rs_home_link = mysqli_query($link,"select link from menu where type = 'home'");
        $row_home_link = mysqli_fetch_row($rs_home_link);
        $home_link = $row_home_link[0];
    ?>
    <div id="menu-btn" class="fas fa-bars"></div>

    <a data-aos="zoom-in-left" data-aos-delay="150" href="<?php echo $home_link; ?>" class="logo"> <i class="fas fa-paper-plane"></i>lanka tours </a>
    
    <nav class="navbar">

        <?php 
        $time = 150;
        $rs_menu = mysqli_query($link,"select * from menu order by menu_order");
        while($row_menu = mysqli_fetch_array($rs_menu))
        {
            $time = $time+150;
            $type = $row_menu["type"];
            if($type == "shop")
            {
                ?>
                <a data-aos="zoom-in-left" data-aos-delay="<?php echo $time; ?>" href="<?php echo $row_menu["link"]; ?>?id=none"><?php echo $row_menu["name"]; ?></a>
                <?php
            }
            else
            {
                ?>
                <a data-aos="zoom-in-left" data-aos-delay="<?php echo $time; ?>" href="<?php echo $row_menu["link"]; ?>"><?php echo $row_menu["name"]; ?></a>
                <?php
            }
                
        }
        ?>

    </nav>

    <a data-aos="zoom-in-left" data-aos-delay="<?php echo $time; ?>" href="../admin/admin_login.php" class="btn">admin login</a>

</header>

