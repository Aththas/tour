<?php
    $link=mysqli_connect("localhost","root","");
    mysqli_select_db($link,"tourism");
    $id = $_GET["id"];
    $per_page_record = 9;       
    if (isset($_GET["page"])) {    
      $page  = $_GET["page"];    
    }    
     else {    
       $page=1;    
    }    
     
    $start_from = ($page-1) * $per_page_record; 
    if($id == "lowtohigh")
    {
        $rs_tours = mysqli_query($link, "select * from tour order by price asc limit $start_from, $per_page_record");
    }
    else if($id == "hightolow")
    {
        $rs_tours = mysqli_query($link, "select * from tour order by price desc limit $start_from, $per_page_record");
    }
    else if($id == "none")
    {
        $rs_tours = mysqli_query($link, "select * from tour order by id limit $start_from, $per_page_record");
    }
    else
    {
        $rs_tours = mysqli_query($link, "select * from tour where days = '$id' or name = '$id' order by id limit $start_from, $per_page_record");
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Destination</title>

    <?php include("head.php"); ?>
<style type="text/css">
    .cat_box{
        padding: 1rem 0;
    }
    .cat_box h3 {
        font-size: 2.2rem;
        color: #fff;
        padding: 1rem 0;
    }
    .cat_box .links {
        font-size: 1.4rem;
        color: #aaa;
        padding: 1rem 0;
        display: block;
    }
    .cat_box .links:hover {
        color: #29d9d5;
    }
    .cat_box .links:hover i {
        padding-right: 2rem;
    }
    .cat_box .links i {
        padding-right: .5rem;
        color: #29d9d5;
    }
    .pagination {   
        display: inline-block;  
        padding-left: 15px; 
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
    .sidebar{
        min-height: 1250px;
    }
  @media (max-width: 768px) {
  .sidebar{
        min-height: 800px;
    }
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
    <span style="font-size: 5rem; font-weight: bolder;">our destinations</span>
    <h3 style="font-size: 4rem; font-weight: bolder; color: white;">choose your destination</h3>
</div>

<!-- page heading ends  -->

<!-- destination section starts  -->

<section class="destination" id="destination">

<div class="row">
    <!-- category section starts  -->
    <div class="col-xs-12 col-md-3 sidebar">
        <br>
        <!-- category(days) section starts  -->
        <div class="cat_box" data-aos="fade-up" data-aos-delay="300">
            <h3>Based on days</h3>
            <?php 
                $rs_days = mysqli_query($link,"select distinct days from tour order by days");
                while($row_days = mysqli_fetch_array($rs_days))
                {
                    $days = $row_days["days"];
                    $rs_days_count = mysqli_query($link,"select count(*) from tour where days = $days");
                    $row_days_count = mysqli_fetch_row($rs_days_count);
                    $days_count = $row_days_count[0];
                    ?>
                        <a href="<?php echo $shop_link; ?>?id=<?php echo $row_days["days"]; ?>" class="links"> <i class="fas fa-arrow-right"></i> <?php echo $row_days["days"]." days package (".$days_count.")"; ?> </a>
                    <?php
                }
            ?>
        </div>
        <!-- category(days) section ends  -->
        <br><br>
        <!-- category(places) section starts  -->
        <div class="cat_box" data-aos="fade-up" data-aos-delay="300">
            <h3>Based on places</h3>
            <?php 
                $rs_places = mysqli_query($link,"select distinct name from tour order by name");
                while($row_places = mysqli_fetch_array($rs_places))
                {
                    $places = $row_places["name"];
                    $rs_places_count = mysqli_query($link,"select count(*) from tour where name = '$places'");
                    $row_places_count = mysqli_fetch_row($rs_places_count);
                    $places_count = $row_places_count[0];
                    ?>
                        <a href="<?php echo $shop_link; ?>?id=<?php echo $row_places["name"]; ?>" class="links"> <i class="fas fa-arrow-right"></i> <?php echo $row_places["name"]." (".$places_count.")"; ?> </a>
                    <?php
                }
            ?>
        </div>
        <!-- category(places) section ends  -->
        <br><br>
        <!-- category(price) section starts  -->
        <div class="cat_box" data-aos="fade-up" data-aos-delay="300">
            <h3>Based on prices</h3>
            <a href="<?php echo $shop_link; ?>?id=lowtohigh" class="links"> <i class="fas fa-arrow-right"></i> low to high </a>
            <a href="<?php echo $shop_link; ?>?id=hightolow" class="links"> <i class="fas fa-arrow-right"></i> high to low </a>
        </div>
        <!-- category(price) section ends  -->
    </div>
    <!-- category section ends  -->

    <!-- tours section starts  -->
    <div class="box-container col-xs-12 col-md-9">

        <?php
            while($row_tours = mysqli_fetch_array($rs_tours))
            {
                ?>
                <div class="box">
                    <div class="image">
                        <img src="images/<?php echo $row_tours["image"]; ?>" alt="">
                    </div>
                    <div class="content">
                        <h3><?php echo $row_tours["name"]; ?></h3>
                        <p><?php echo $row_tours["days"]; ?> days package</p>
                        <p style="margin-top: -15px;">Rs. <?php echo $row_tours["price"]; ?></p>
                        <a href="single_destination.php?id=<?php echo $row_tours["id"]; ?>">read more <i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
                <?php
            }
        ?>

    </div>
    <!-- tours section starts  -->
</div>

                        <div class="pagination">    
                            <?php  
                            $query = "SELECT COUNT(*) FROM tour";     
                            $rs_result = mysqli_query($link, $query);     
                            $row = mysqli_fetch_row($rs_result);     
                            $total_records = $row[0];     
          
                            echo "</br>";     
                            // Number of pages required.   
                            $total_pages = ceil($total_records / $per_page_record);     
                            $pagLink = "";       
      
                            if($page>=2){   
                                echo "<a href='".$shop_link."?id=$id&page=".($page-1)."'>  Prev </a>";   
                            }       
                   
                            for ($i=1; $i<=$total_pages; $i++) {   
                                if ($i == $page) {   
                                    $pagLink .= "<a class = 'active' href='".$shop_link."?id=$id&page=".$i."'>".$i." </a>";   
                                 }               
                                else  {   
                                    $pagLink .= "<a href='".$shop_link."?id=$id&page=".$i."'>".$i." </a>";     
                                }   
                            };     
                            echo $pagLink;   
  
                            if($page<$total_pages){   
                                echo "<a href='".$shop_link."?id=$id&page=".($page+1)."'>  Next </a>";   
                            }   
  
                            ?>    
                        </div> 
</section>

<!-- destination section ends -->


<!-- footer section starts  -->
<div class="row">
    <div class="col-xs-12 col-md-12">
        <?php include("footer.php"); ?>
    </div>
</div>
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