<?php
session_start();
if($_SESSION["admin"]=="")
{
?>
<script type="text/javascript">
window.location="admin_login.php";
</script>
<?php
}
    $link=mysqli_connect("localhost","root","");
    mysqli_select_db($link,"tourism");

    $per_page_record = 5;       
    if (isset($_GET["page"])) {    
      $page  = $_GET["page"];    
    }    
     else {    
       $page=1;    
    }    
     
    $start_from = ($page-1) * $per_page_record; 
  
    $rs_blogs = mysqli_query($link, "select * from blog order by id desc limit $start_from, $per_page_record");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>

    <?php include("admin_head.php"); ?>
<style type="text/css">
.fa-trash-alt:hover{
color: red;
}
td a{
    color: white;
}
td i{
    padding-left: 5px;
    padding-right: 5px;
}
textarea{
    width: 1300px;
    height: 200px;
}
@media (max-width: 768px) {
textarea{
    width: 405px;
    height: 400px;
}
}
</style>
</head>

<body>
    
<!-- header section starts  -->

<?php include("admin_header.php"); ?>

<!-- header section ends -->

<!-- destination section starts  -->
<section class="destination" id="destination" style="margin-top: 60px;">

    
    <br>

    <div class="table-panel bg" >
        <div class="panel-heading" style="display: flex; align-items: center; justify-content: center;">
            <a data-aos="zoom-in-left" data-aos-delay="1100" href="#review" class="btn" style="margin-bottom: 20px;"> +Add New Blog</a>
        </div>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Caption</th>
                        <th>Date</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($row_blogs = mysqli_fetch_array($rs_blogs))
                    {
                    ?>
                       <tr>
                            <td data-label = "#"><a href="editBlog.php?id=<?php echo $row_blogs["id"]; ?>"><?php echo $row_blogs["id"] ?></a></td>
                            <td data-label = "Name"><a href="editBlog.php?id=<?php echo $row_blogs["id"]; ?>"><?php echo $row_blogs["name"] ?></a></td>
                            <td data-label = "Caption" style="text-transform: none;"><a href="editBlog.php?id=<?php echo $row_blogs["id"]; ?>"><?php echo $row_blogs["caption"] ?> days</a></td>
                            <td data-label = "Date"><a href="editBlog.php?id=<?php echo $row_blogs["id"]; ?>"><?php echo $row_blogs["date"] ?></a></td>
                            <td data-label = "Delete">
                                <a href="delete.php?id=<?php echo $row_blogs["id"]; ?>&name=blog"> <i class="far fa-trash-alt"></i> </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td  class="hide" style="background-color: #29d9d5;"></td>
                        <td  class="hide" style="background-color: #29d9d5;"></td>
                        <td  class="hide" style="background-color: #29d9d5;"></td>
                        <td  class="hide" style="background-color: #29d9d5;"></td>
                        <td  class="hide" style="background-color: #29d9d5;"></td>
                    </tr>
                </tbody>
            </table>
            <div class="pagination" style="padding-left: 0px;">    
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
                                echo "<a href='blog.php?page=".($page-1)."'>  Prev </a>";   
                            }       
                   
                            for ($i=1; $i<=$total_pages; $i++) {   
                                if ($i == $page) {   
                                    $pagLink .= "<a class = 'active' href='blog.php?page=".$i."'>".$i." </a>";   
                                 }               
                                else  {   
                                    $pagLink .= "<a href='blog.php?page=".$i."'>".$i." </a>";     
                                }   
                            };     
                            echo $pagLink;   
  
                            if($page<$total_pages){   
                                echo "<a href='blog.php?page=".($page+1)."'>  Next </a>";   
                            }   
  
                            ?>    
                        </div> 
        </div>
    </div>

</section>

<!-- destination section ends -->

<!-- write review section starts  -->

<section class="book-form" id="review" style="margin-top: 50px;">
<h3 class="review_title">add blogs here</h3>
    <form action="" method="POST">
        <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
            <span>Name?</span>
            <input type="text" placeholder="blog name" name="name">
        </div>
        <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
            <span>Caption?</span>
            <input type="text" placeholder="caption" name="caption">
        </div>
        <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
            <span>image?</span>
            <input type="file" name="image" style="border: none; cursor: pointer;">
        </div>
        
        <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
            <span>description?</span>
            <textarea placeholder="description" name="description"></textarea>
        </div>

        <input type="submit" name="add_btn" value="submit" class="btn" style="background-color:  #29d9d5; color: #111">
    </form>

</section>

<!-- write review section ends -->

<!-- footer section starts  -->

<div class="credit"><span>2022 Travel</span> | all rights reserved!</div>

<!-- footer section ends -->



<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

<script>

    AOS.init({
        duration: 800,
        offset:150,
    });

</script>
<?php
    if(isset($_POST["add_btn"]))
    {
        $tdy = date("Y-m-d");
        if($_POST["name"] == "" || $_POST["caption"] == "" || $_POST["image"] == "" || $_POST["description"] == "")
        {
                ?>
                    <script type="text/javascript">
                        swal({
                            title: "Add Blog",
                            text: "Fields Must Be Fill !!!",
                            icon: "error"
                        }).then(function() {
                            window.location = "blog.php";
                        });
                    </script>
                <?php
        }
        else
        {
            mysqli_query($link,"insert into blog values('','$_POST[name]','$_POST[caption]','$_POST[description]','$tdy','$_POST[image]')");
                ?>
                    <script type="text/javascript">
                        swal({
                            title: "Add Blog",
                            text: "Blog Added Successfully !!!",
                            icon: "success"
                        }).then(function() {
                            window.location = "blog.php";
                        });
                    </script>
                <?php

        }
    }
?>
</body>
</html>