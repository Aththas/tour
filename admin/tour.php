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
  
    $rs_tours = mysqli_query($link, "select * from tour order by id desc limit $start_from, $per_page_record");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour</title>

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
    width: 650px;
    height: 200px;
}
@media (max-width: 768px) {
textarea{
    width: 405px;
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
            <a data-aos="zoom-in-left" data-aos-delay="1100" href="#review" class="btn" style="margin-bottom: 20px;"> +Add New Tour</a>
        </div>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Days</th>
                        <th>Price</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($row_tours = mysqli_fetch_array($rs_tours))
                    {
                    ?>
                       <tr>
                            <td data-label = "#"><a href="editTour.php?id=<?php echo $row_tours["id"]; ?>"><?php echo $row_tours["id"] ?></a></td>
                            <td data-label = "Name"><a href="editTour.php?id=<?php echo $row_tours["id"]; ?>"><?php echo $row_tours["name"] ?></a></td>
                            <td data-label = "Days" style="text-transform: none;"><a href="editTour.php?id=<?php echo $row_tours["id"]; ?>"><?php echo $row_tours["days"] ?> days</a></td>
                            <td data-label = "Price"><a href="editTour.php?id=<?php echo $row_tours["id"]; ?>"><?php echo $row_tours["price"] ?></a></td>
                            <td data-label = "Delete">
                                <a href="delete.php?id=<?php echo $row_tours["id"]; ?>&name=tour"> <i class="far fa-trash-alt"></i> </a>
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
                            $query = "SELECT COUNT(*) FROM tour";     
                            $rs_result = mysqli_query($link, $query);     
                            $row = mysqli_fetch_row($rs_result);     
                            $total_records = $row[0];     
          
                            echo "</br>";     
                            // Number of pages required.   
                            $total_pages = ceil($total_records / $per_page_record);     
                            $pagLink = "";       
      
                            if($page>=2){   
                                echo "<a href='tour.php?page=".($page-1)."'>  Prev </a>";   
                            }       
                   
                            for ($i=1; $i<=$total_pages; $i++) {   
                                if ($i == $page) {   
                                    $pagLink .= "<a class = 'active' href='tour.php?page=".$i."'>".$i." </a>";   
                                 }               
                                else  {   
                                    $pagLink .= "<a href='tour.php?page=".$i."'>".$i." </a>";     
                                }   
                            };     
                            echo $pagLink;   
  
                            if($page<$total_pages){   
                                echo "<a href='tour.php?page=".($page+1)."'>  Next </a>";   
                            }   
  
                            ?>    
                        </div> 
        </div>
    </div>

</section>

<!-- destination section ends -->

<!-- write review section starts  -->

<section class="book-form" id="review" style="margin-top: 50px;">
<h3 class="review_title">add tours here</h3>
    <form action="" method="POST">
        <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
            <span>Name?</span>
            <input type="text" placeholder="tour name" name="name">
        </div>
        <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
            <span>Days?</span>
            <input type="text" placeholder="days" name="days" onkeypress="return validation(event)">
        </div>
        <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
            <span>image?</span>
            <input type="file" name="image" style="border: none; cursor: pointer;">
        </div>
        <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
            <span>Price?</span>
            <input type="text" placeholder="price" name="price" onkeypress="return validation(event)">
        </div>
        
        <div data-aos="zoom-in" data-aos-delay="300" class="inputBox">
            <span>description?</span>
            <textarea placeholder="description" name="description"></textarea>
        </div>
        <div data-aos="zoom-in" data-aos-delay="300" class="inputBox">
            <span>places?</span>
            <textarea placeholder="places to visit" name="places"></textarea>
        </div>

        <div data-aos="zoom-in" data-aos-delay="300" class="inputBox">
            <span>hotels?</span>
            <textarea placeholder="hotels" name="hotels"></textarea>
        </div>
        <div data-aos="zoom-in" data-aos-delay="300" class="inputBox">
            <span>meals?</span>
            <textarea name="meals">Daily Breakfast and Dinner</textarea>
        </div>

        <div data-aos="zoom-in" data-aos-delay="300" class="inputBox">
            <span>travelling?</span>
            <input type="text" value="Train, bus, van or car" name="travel">
        </div>

        <input type="submit" name="add_btn" value="submit" class="btn" style="background-color:  #29d9d5; color: #111">
    </form>
    <script type="text/javascript">
    function validation(evt) {
          
        var ASCII = (evt.which) ? evt.which : evt.keyCode
        if (ASCII > 31 && (ASCII < 48 || ASCII > 57) )
            return false;
        return true;
    }
</script>
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
        if($_POST["name"] == "" || $_POST["days"] == "" || $_POST["image"] == "" || $_POST["price"] == "" || $_POST["description"] == "" || $_POST["places"] == "" || $_POST["hotels"] == "" || $_POST["meals"] == "" || $_POST["travel"] == ""){
                ?>
                    <script type="text/javascript">
                        swal({
                            title: "Add Tour",
                            text: "Fields Must Be Fill !!!",
                            icon: "error"
                        }).then(function() {
                            window.location = "tour.php";
                        });
                    </script>
                <?php
        }
        else
        {
            mysqli_query($link,"insert into tour values('','$_POST[name]','$_POST[days]','$_POST[image]','$_POST[price]','$_POST[description]','$_POST[hotels]','$_POST[meals]','$_POST[travel]','$_POST[places]')");
                ?>
                    <script type="text/javascript">
                        swal({
                            title: "Add Tour",
                            text: "Tour Added Successfully !!!",
                            icon: "success"
                        }).then(function() {
                            window.location = "tour.php";
                        });
                    </script>
                <?php

        }
    }
?>
</body>
</html>