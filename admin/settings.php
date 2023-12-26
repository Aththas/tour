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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>

    <?php include("admin_head.php"); ?>
<style type="text/css">
.show:hover{
color: red;
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
        <div class="panel-heading" style="display: flex; align-items: center; justify-content: center;">
            <a data-aos="zoom-in-left" data-aos-delay="1100" href="#review" class="btn" style="margin-bottom: 20px;"> +Add New Menu</a>
        </div>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Menu Order</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Link</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $rs_menu = mysqli_query($link, "select * from menu order by menu_order");
                    while($row_menu = mysqli_fetch_array($rs_menu))
                    {
                    ?>
                       <tr>
                            <td data-label = "Menu Order"><a href="editMenu.php?id=<?php echo $row_menu["id"]; ?>"><?php echo $row_menu["menu_order"] ?></a></td>
                            <td data-label = "Name"><a href="editMenu.php?id=<?php echo $row_menu["id"]; ?>"><?php echo $row_menu["name"] ?></a></td>
                            <td data-label = "Type"><a href="editMenu.php?id=<?php echo $row_menu["id"]; ?>"><?php echo $row_menu["type"] ?></a></td>
                            <td data-label = "Link"><a href="editMenu.php?id=<?php echo $row_menu["id"]; ?>" style="text-transform: none;"><?php echo $row_menu["link"] ?></a></td>
                            <td data-label = "Delete">
                                <?php 
                            if($row_menu["type"] == "")
                            {
                                ?>
                                <a href="delete.php?id=<?php echo $row_menu["id"]; ?>&name=menu"> <i class="far fa-trash-alt show"></i> </a>
                                <?php
                            }
                            else
                            {
                                ?>
                                <a href="#"> <i class="far fa-trash-alt"></i> </a>
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
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</section>

<!-- destination section ends -->

<!-- write review section starts  -->

<section class="book-form" id="review" style="margin-top: 50px;">
<h3 class="review_title">add menu here</h3>
    <form action="" method="POST">
        <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
            <span>Menu Name?</span>
            <input type="text" placeholder="menu name" name="name">
        </div>
        <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
            <span>Menu Link?</span>
            <input type="text" placeholder="menu link" name="link">
        </div>
        <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
            <span>Menu Order?</span>
            <input type="text" placeholder="menu order" name="order" onkeypress="return validation(event)">
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
        $intOrder = intval($_POST["order"]);
   
        $r = mysqli_query($link, "select count(*) from menu");
        $ro = mysqli_fetch_row($r);
        $count = $ro[0] + 1;

        if($_POST["name"] == "" || $_POST["link"] == "" || $_POST["order"] == "")
        {
                ?>
                    <script type="text/javascript">
                        swal({
                            title: "Add Menu",
                            text: "Fields Must Be Fill !!!",
                            icon: "error"
                        }).then(function() {
                            window.location = "settings.php";
                        });
                    </script>
                <?php
        }
        else if($intOrder < 1 || $intOrder > $count)
        {
                ?>
                    <script type="text/javascript">
                        swal({
                            title: "Add Menu",
                            text: "Invalid Menu Order !!!",
                            icon: "error"
                        }).then(function() {
                            window.location = "settings.php";
                        });
                    </script>
                <?php
        }
        else
        {
            $resultset = mysqli_query($link,"select * from menu where menu_order >= '$_POST[order]'");
            while($r = mysqli_fetch_array($resultset))
            {
                $m_id = $r["id"];
                mysqli_query($link,"update menu set menu_order = menu_order+1 where id = '$m_id' ");
            }
            mysqli_query($link,"insert into menu values('','$_POST[order]','$_POST[name]','$_POST[link]','')");
                ?>
                    <script type="text/javascript">
                        swal({
                            title: "Add Menu",
                            text: "Menu Added Successfully !!!",
                            icon: "success"
                        }).then(function() {
                            window.location = "settings.php";
                        });
                    </script>
                <?php

        }
    }
?>
</body>
</html>