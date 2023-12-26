<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="js/sweetalert.min.js"></script>
</head>
<body>

<?php
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"tourism");
$id = $_GET["id"];
$name = $_GET["name"];
if($name == "tour")
{
	mysqli_query($link,"delete from tour where id= $id");
	?>
	<script type="text/javascript">
    swal({
        title: "Tour",
        text: "Tour #<?php echo $id; ?> deleted successfully!!!",
        icon: "success"
    }).then(function() {
        window.location = "tour.php";
    });
	</script>
	<?php
}
else if($name == "blog")
{
	mysqli_query($link,"delete from blog where id= $id");
	?>
	<script type="text/javascript">
    swal({
        title: "Blog",
        text: "Blog #<?php echo $id; ?> deleted successfully!!!",
        icon: "success"
    }).then(function() {
        window.location = "blog.php";
    });
	</script>
	<?php
}
else if($name == "staff")
{
	mysqli_query($link,"delete from staffs where id= $id");
	?>
	<script type="text/javascript">
    swal({
        title: "Staff Details",
        text: "Staff #<?php echo $id; ?> deleted successfully!!!",
        icon: "success"
    }).then(function() {
        window.location = "staff.php";
    });
	</script>
	<?php
}
else if($name == "menu")
{

    $rs = mysqli_query($link,"select menu_order from menu where id = $id");
    $row = mysqli_fetch_row($rs);
    $order = $row[0];    

    $resultset = mysqli_query($link,"select * from menu where menu_order >= '$order'");
            while($r = mysqli_fetch_array($resultset))
            {
                $m_id = $r["id"];
                mysqli_query($link,"update menu set menu_order = menu_order-1 where id = '$m_id' ");
            }
    mysqli_query($link,"delete from menu where id= $id");
    ?>
    <script type="text/javascript">
    swal({
        title: "Menu",
        text: "Menu #<?php echo $id; ?> deleted successfully!!!",
        icon: "success"
    }).then(function() {
        window.location = "settings.php";
    });
    </script>
    <?php
}

?>
</body>
</html>