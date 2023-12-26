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
  
    $rs_staffs = mysqli_query($link, "select * from staffs order by id desc limit $start_from, $per_page_record");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Details</title>

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
}
@media (max-width: 768px) {
textarea{
    width: 405px;
    height: 200px;
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
            <a data-aos="zoom-in-left" data-aos-delay="1100" href="#review" class="btn" style="margin-bottom: 20px;"> +Add New Staff</a>
        </div>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Profession</th>
                        <th>Message</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($row_staffs = mysqli_fetch_array($rs_staffs))
                    {
                    ?>
                       <tr>
                            <td data-label = "#"><a href="editStaff.php?id=<?php echo $row_staffs["id"]; ?>"><?php echo $row_staffs["id"] ?></a></td>
                            <td data-label = "Name"><a href="editStaff.php?id=<?php echo $row_staffs["id"]; ?>"><?php echo $row_staffs["name"] ?></a></td>
                            <td data-label = "Profession" style="text-transform: none;"><a href="editStaff.php?id=<?php echo $row_staffs["id"]; ?>"><?php echo $row_staffs["profession"] ?> days</a></td>
                            <td data-label = "Message"><a href="editStaff.php?id=<?php echo $row_staffs["id"]; ?>"><?php echo $row_staffs["msg"] ?></a></td>
                            <td data-label = "Delete">
                                <a href="delete.php?id=<?php echo $row_staffs["id"]; ?>&name=staff"> <i class="far fa-trash-alt"></i> </a>
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
                            $query = "SELECT COUNT(*) FROM staffs";     
                            $rs_result = mysqli_query($link, $query);     
                            $row = mysqli_fetch_row($rs_result);     
                            $total_records = $row[0];     
          
                            echo "</br>";     
                            // Number of pages required.   
                            $total_pages = ceil($total_records / $per_page_record);     
                            $pagLink = "";       
      
                            if($page>=2){   
                                echo "<a href='staff.php?page=".($page-1)."'>  Prev </a>";   
                            }       
                   
                            for ($i=1; $i<=$total_pages; $i++) {   
                                if ($i == $page) {   
                                    $pagLink .= "<a class = 'active' href='staff.php?page=".$i."'>".$i." </a>";   
                                 }               
                                else  {   
                                    $pagLink .= "<a href='staff.php?page=".$i."'>".$i." </a>";     
                                }   
                            };     
                            echo $pagLink;   
  
                            if($page<$total_pages){   
                                echo "<a href='staff.php?page=".($page+1)."'>  Next </a>";   
                            }   
  
                            ?>    
                        </div> 
        </div>
    </div>

</section>

<!-- destination section ends -->

<!-- write review section starts  -->

<section class="book-form" id="review" style="margin-top: 50px;">
<h3 class="review_title">add staffs</h3>
    <form action="" method="POST">
        <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
            <span>Name?</span>
            <input type="text" placeholder="staff name" name="name">
        </div>
        <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
            <span>Profession?</span>
            <input type="text" placeholder="staff profession" name="profession">
        </div>
        <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
            <span>image?</span>
            <input type="file" name="image" style="border: none; cursor: pointer;">
        </div>
        
        <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
            <span>message?</span>
            <textarea placeholder="message" name="msg"></textarea>
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
        if($_POST["name"] == "" || $_POST["profession"] == "" || $_POST["image"] == "" || $_POST["msg"] == "")
        {
                ?>
                    <script type="text/javascript">
                        swal({
                            title: "Add Staff",
                            text: "Fields Must Be Fill !!!",
                            icon: "error"
                        }).then(function() {
                            window.location = "staff.php";
                        });
                    </script>
                <?php
        }
        else
        {
            mysqli_query($link,"insert into staffs values('','$_POST[name]','$_POST[profession]','$_POST[image]','$_POST[msg]')");
                ?>
                    <script type="text/javascript">
                        swal({
                            title: "Add Staff",
                            text: "Staff Added Successfully !!!",
                            icon: "success"
                        }).then(function() {
                            window.location = "staff.php";
                        });
                    </script>
                <?php

        }
    }
?>
</body>
</html>