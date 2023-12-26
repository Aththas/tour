
<html>
  <head>
    <title>Verify</title>
    <script src="js/sweetalert.min.js"></script>
  </head>
  <body>

<?php

$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"tourism");

$id = $_GET["id"];
$code = $_GET["code"];
$value = $_GET["value"];

if($code == $value)
{
			?>
                <script type="text/javascript">
                    window.location = "pwd_reset.php?id=<?php echo $id ?>";
                </script>
            <?php
}
else
{

			?>
                <script type="text/javascript">
                    swal({
                        title: "Error",
                        text: "Verification Failed. Try Again!!!",
                        icon: "error"
                    }).then(function() {
                        window.location = "admin_login.php";
                    });
                </script>
            <?php
}

?>

  </body>
</html>