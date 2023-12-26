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
  
    $rs_gallery = mysqli_query($link, "select * from gallery limit $start_from, $per_page_record");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>

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
    <span style="font-size: 5rem; font-weight: bolder;">our gallery</span>
    <h3 style="font-size: 4rem; font-weight: bolder; color: white;">we record memories</h3>
</div>

<!-- page heading ends  -->

<!-- gallery section starts  -->

<section class="gallery" id="gallery">
    
    <div class="box-container">

        <?php
            while($row_gallery = mysqli_fetch_array($rs_gallery))
            {
                ?>
                <div class="box" data-aos="zoom-in-up" data-aos-delay="150">
                    <img src="images/<?php echo $row_gallery["image"]; ?>" alt="">
                    <span><?php echo $row_gallery["place_type"]; ?></span>
                    <h3><?php echo $row_gallery["place_name"]; ?></h3>
                </div>
                <?php
            }
        ?>

    </div>

                        <div class="pagination">    
                            <?php  
                            $query = "SELECT COUNT(*) FROM gallery";     
                            $rs_result = mysqli_query($link, $query);     
                            $row = mysqli_fetch_row($rs_result);     
                            $total_records = $row[0];     
          
                            echo "</br>";     
                            // Number of pages required.   
                            $total_pages = ceil($total_records / $per_page_record);     
                            $pagLink = "";       
      
                            if($page>=2){   
                                echo "<a href='".$gallery_link."?page=".($page-1)."'>  Prev </a>";   
                            }       
                   
                            for ($i=1; $i<=$total_pages; $i++) {   
                                if ($i == $page) {   
                                    $pagLink .= "<a class = 'active' href='".$gallery_link."?page=".$i."'>".$i." </a>";   
                                 }               
                                else  {   
                                    $pagLink .= "<a href='".$gallery_link."?page=".$i."'>".$i." </a>";     
                                }   
                            };     
                            echo $pagLink;   
  
                            if($page<$total_pages){   
                                echo "<a href='".$gallery_link."?page=".($page+1)."'>  Next </a>";   
                            }   
  
                            ?>    
                        </div> 

</section>

<!-- gallery section ends -->


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