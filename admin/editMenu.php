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
    $id = $_GET["id"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit menu #<?php echo $id; ?></title>

    <?php include("admin_head.php"); ?>
</head>

<body>
    
<!-- header section starts  -->

<?php include("admin_header.php"); ?>

<!-- header section ends -->

<!-- write review section starts  -->

<section class="book-form" id="review" style="margin-top: 250px;">
<h3 class="review_title">Edit menu #<?php echo $id; ?></h3>
    <form action="" method="POST">
        <?php
        $rs_edit = mysqli_query($link, "select * from menu where id = $id");
        while($row_edit = mysqli_fetch_array($rs_edit))
        {
            ?>
            <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
                <span>Menu Name?</span>
                <input type="text" name="name" value="<?php echo $row_edit["name"]; ?>">
            </div>
            <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
                <span>Menu Link?</span>
                <input type="text" name="link" value="<?php echo $row_edit["link"]; ?>">
            </div>
            <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
                <span>Menu Order?</span>
                <input type="text" name="order" onkeypress="return validation(event)" value="<?php echo $row_edit["menu_order"]; ?>">
            </div>
            <?php
        }
        ?>
        <input type="submit" name="add_btn" value="Update" class="btn" style="background-color:  #29d9d5; color: #111">
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

<div class="credit" style="margin-top: 310px;"><span>2022 Travel</span> | all rights reserved!</div>

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
        $count = $ro[0];

        $rrr= mysqli_query($link,"select menu_order from menu where id=$id");
        $rr = mysqli_fetch_row($rrr);
        $menu_order = $rr[0];

        if($_POST["name"] == "" || $_POST["link"] == "" || $_POST["order"] == "")
        {
                ?>
                    <script type="text/javascript">
                        swal({
                            title: "Update Menu",
                            text: "Fields Must Be Fill !!!",
                            icon: "error"
                        }).then(function() {
                            window.location = "editMenu.php?id=<?php echo $id; ?>";
                        });
                    </script>
                <?php
        }
        else if($intOrder < 1 || $intOrder > $count)
        {
                ?>
                    <script type="text/javascript">
                        swal({
                            title: "Update Menu",
                            text: "Invalid Menu Order !!!",
                            icon: "error"
                        }).then(function() {
                            window.location = "editMenu.php?id=<?php echo $id; ?>";
                        });
                    </script>
                <?php
        }
        else
        {
            $resultset1 = mysqli_query($link,"select * from menu where menu_order <= '$_POST[order]' and menu_order > '$menu_order'");
            while($r1 = mysqli_fetch_array($resultset1))
            {
                $m_id = $r1["id"];
                mysqli_query($link,"update menu set menu_order = menu_order-1 where id = $m_id ");
            }

            $resultset2 = mysqli_query($link,"select * from menu where menu_order <'$menu_order' and menu_order >= '$_POST[order]'");
            while($r2 = mysqli_fetch_array($resultset2))
            {
                $m_id = $r2["id"];
                mysqli_query($link,"update menu set menu_order = menu_order+1 where id = $m_id");
            }
            mysqli_query($link,"update menu set name = '$_POST[name]', link = '$_POST[link]', menu_order = '$_POST[order]' where id = $id");
                ?>
                    <script type="text/javascript">
                        swal({
                            title: "Update Menu",
                            text: "Menu Updated Successfully !!!",
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