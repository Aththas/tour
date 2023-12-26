<?php
    $link=mysqli_connect("localhost","root","");
    mysqli_select_db($link,"tourism");

    $per_page_record = 6;       
    if (isset($_GET["page"])) {    
      $page  = $_GET["page"];    
    }    
     else {    
       $page=1;    
    }    
     
    $start_from = ($page-1) * $per_page_record; 
  
    $rs_blog = mysqli_query ($link, "select * from blog limit $start_from, $per_page_record");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>

    <?php include("head.php"); ?>
<style type="text/css">
.pagination {   
    display: inline-block;   
}   
.pagination a {   
    font-weight:bold;   
    font-size:18px;   
    color: #29d9d5;   
    float: left;   
    padding: 8px 16px;   
    text-decoration: none;       
}   
.pagination a.active {   
        background-color: #29d9d5; 
        color: white;  
}   
.pagination a:hover:not(.active) {   
    background-color: #29d9d5;
    opacity: 0.7;
    color: white;   
}

    </style>
</head>
<body>
    
<!-- header section starts  -->

<?php include("header.php"); ?>

<!-- header section ends -->

<!-- page heading starts  -->

<br><br><br><br><br>
<div class="credit" style="background-color: black; height: 200px; margin:auto; margin-top: 40px;">
    <span style="font-size: 5rem; font-weight: bolder;">blogs & posts</span>
    <h3 style="font-size: 4rem; font-weight: bolder; color: white;">our untold stories</h3>
</div>

<!-- page heading ends  -->

<!-- blogs section starts  -->

<section class="blogs" id="blogs">

    <div class="box-container">

        <?php
            while($row_blog = mysqli_fetch_array($rs_blog))
            {
                ?>
                <div class="box" data-aos="fade-up" data-aos-delay="150">
                    <div class="image">
                        <img src="images/<?php echo $row_blog["image"]; ?>" alt="">
                    </div>
                    <div class="content">
                        <a href="single_blog.php?id=<?php echo $row_blog["id"]; ?>" class="link"><?php echo $row_blog["name"]; ?></a>
                        <p><?php echo $row_blog["caption"]; ?></p>
                        <div class="icon">
                            <a href="#"><i class="fas fa-clock"></i><?php echo $row_blog["date"]; ?></a>
                            <a href="#"><i class="fas fa-user"></i> by admin</a>
                        </div>
                    </div>
                </div>
                <?php
            }
        ?>

    </div>

                        <div class="pagination">    
                            <?php  
                            $query = "SELECT COUNT(*) FROM blog";     
                            $rs_result = mysqli_query($link, $query);     
                            $row = mysqli_fetch_row($rs_result);     
                            $total_records = $row[0];     
          
                            echo "</br>";     
                            // Number of pages required.   
                            $total_pages = ceil($total_records / $per_page_record);     
                            $pagLink = "";       
      
                            if($page>=2){   
                                echo "<a href='".$blog_link."?page=".($page-1)."'>  Prev </a>";   
                            }       
                   
                            for ($i=1; $i<=$total_pages; $i++) {   
                                if ($i == $page) {   
                                    $pagLink .= "<a class = 'active' href='".$blog_link."?page=".$i."'>".$i." </a>";   
                                 }               
                                else  {   
                                    $pagLink .= "<a href='".$blog_link."?page=".$i."'>".$i." </a>";     
                                }   
                            };     
                            echo $pagLink;   
  
                            if($page<$total_pages){   
                                echo "<a href='".$blog_link."?page=".($page+1)."'>  Next </a>";   
                            }   
  
                            ?>    
                        </div> 

</section>

<!-- blogs section ends -->

<!-- banner section starts  -->

<div class="banner">

    <div class="content" data-aos="zoom-in-up" data-aos-delay="300">
        <span>start your adventures</span>
        <h3>Let's Explore This World</h3>
        <p>“I want to explore the world properly, to be able to write about and take pictures of all kinds of different cultures. Just be an explorer or adventurer.” - Cara Delevingne. </p>
        <a href="<?php echo $shop_link; ?>?id=none" class="btn">explore now</a>
    </div>

</div>

<!-- banner section ends -->


<!-- footer section starts  -->

<?php include("footer.php"); ?>

<!-- footer section ends -->



<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

<script>

    AOS.init({
        duration: 800,
        offset:150,
    });

</script>

</body>
</html>