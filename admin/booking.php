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
  
    $rs_bk = mysqli_query($link, "select * from booking where email_verification = 'verified' order by booking_id desc limit $start_from, $per_page_record");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>

    <?php include("admin_head.php"); ?>
<style type="text/css">
.show:hover{
color: #29d9d5;
}
td a{
    color: white;
}
td i{
    padding-left: 5px;
    padding-right: 5px;
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
        <h3 class="review_title">Booking Details</h3>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Country</th> 
                        <th>Mobile No</th>
                        <th>Date</th>
                        <th>Travellers</th>
                        <th>Tour</th>
                        <th>Status</th>
                        <th>Confirm</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($row_bk = mysqli_fetch_array($rs_bk))
                    {
                    ?>
                       <tr>
                            <td data-label = "#"><a href="#"><?php echo $row_bk["booking_id"] ?></a></td>
                            <td data-label = "Customer"><a href="#"><?php echo $row_bk["cus_name"] ?></a></td>
                            <td data-label = "Email"><a href="#" style="text-transform: none;"><?php echo $row_bk["email"] ?></a></td>
                            <td data-label = "Country"><a href="#"><?php echo $row_bk["country"] ?></a></td>
                            <td data-label = "Contact No"><a href="#"><?php echo $row_bk["contact"] ?></a></td>
                            <td data-label = "Date"><a href="#"><?php echo $row_bk["date"] ?></a></td>
                            <td data-label = "Travellers"><a href="#"><?php echo $row_bk["count"] ?></a></td>
                            <td data-label = "Tour"><a href="#"><?php echo $row_bk["des_id"] ?></a></td>
                            <td data-label = "Status"><a href="#"><?php echo $row_bk["status"] ?></a></td>
                            <td data-label = "Confirm">
                            <?php 
                            if($row_bk["status"] == "Processing")
                            {
                                ?>
                                <a href="confirm.php?id=<?php echo $row_bk["booking_id"]; ?>"> <i class="far fa-edit show"></i> </a>
                                <?php
                            }
                            else
                            {
                                ?>
                                <a href="#"> <i class="far fa-edit"></i> </a>
                                <?php
                            }
                            ?>
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
                            $query = "SELECT COUNT(*) FROM booking";     
                            $rs_result = mysqli_query($link, $query);     
                            $row = mysqli_fetch_row($rs_result);     
                            $total_records = $row[0];     
          
                            echo "</br>";     
                            // Number of pages required.   
                            $total_pages = ceil($total_records / $per_page_record);     
                            $pagLink = "";       
      
                            if($page>=2){   
                                echo "<a href='booking.php?page=".($page-1)."'>  Prev </a>";   
                            }       
                   
                            for ($i=1; $i<=$total_pages; $i++) {   
                                if ($i == $page) {   
                                    $pagLink .= "<a class = 'active' href='booking.php?page=".$i."'>".$i." </a>";   
                                 }               
                                else  {   
                                    $pagLink .= "<a href='booking.php?page=".$i."'>".$i." </a>";     
                                }   
                            };     
                            echo $pagLink;   
  
                            if($page<$total_pages){   
                                echo "<a href='booking.php?page=".($page+1)."'>  Next </a>";   
                            }   
  
                            ?>    
                        </div> 
        </div>
    </div>

</section>

<!-- destination section ends -->

<!-- footer section starts  -->

<div class="credit" style="margin-top: 260px;"><span>2022 Travel</span> | all rights reserved!</div>

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