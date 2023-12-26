<?php
    $link=mysqli_connect("localhost","root","");
    mysqli_select_db($link,"tourism");
    $id = $_GET["id"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Blog #<?php echo $id ?></title>

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
<div class="credit" style="background-color: black; height: 200px; margin:auto;">
    <span style="font-size: 5rem; font-weight: bolder;">Blog posts</span>
    <h3 style="font-size: 4rem; font-weight: bolder; color: white;">articles about tourism</h3>
</div>

<!-- page heading ends  -->

<!-- destination section starts  -->

<section class="destination" id="destination">

<div class="row">
    <!-- category section starts  -->
    <div class="col-xs-12 col-md-3 sidebar">
        <br>
        <!-- category(more blog) section starts  -->
        <div class="cat_box" data-aos="fade-up" data-aos-delay="300">
            <h3>More blog posts</h3>
            <?php 
                $rs_blog = mysqli_query($link,"select * from blog where id != $id order by id limit 20");
                while($row_blog = mysqli_fetch_array($rs_blog))
                {
                    ?>
                        <a href="single_blog.php?id=<?php echo $row_blog["id"]; ?>" class="links"> <i class="fas fa-arrow-right"></i> <?php echo $row_blog["name"]; ?> </a>
                    <?php
                }
            ?>
        </div>
        <!-- category(more blog) section ends  -->
    </div>
    <!-- category section ends  -->

    <!-- tours section starts  -->
    <div class="box-container col-xs-12 col-md-9">

        <?php
        $rs_blogs = mysqli_query($link, "select * from blog where id = $id");
            while($row_blogs = mysqli_fetch_array($rs_blogs))
            {
                ?>

                <div class="box" style="width: 100%; min-height: 1100px;">
                    <div class="image" style="height: 550px;">
                        <img src="images/<?php echo $row_blogs["image"]; ?>" alt="">
                    </div>
                    <div class="content">
                        <h3 style="color: #29d9d5;"><?php echo $row_blogs["name"]; ?></h3>
                        <p><?php echo $row_blogs["date"]; ?></p>
                        <p style="margin-top: -15px;">written by admin</p>
                        <br>
                        <p style="margin-top: -15px; text-align: center; color: white;"><?php echo $row_blogs["caption"]; ?></p>
                        <br>
                        <p style="margin-top: -15px; text-align: justify;"><?php echo $row_blogs["description"]; ?></p>
                    </div>
                </div>
                <?php
            }
        ?>
    </div>
    <!-- tours section starts  -->
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