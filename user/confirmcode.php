
<html>
  <head>
    <title>Verify</title>
    <script src="js/sweetalert.min.js"></script>
  </head>
      <style type="text/css">
        .swal-modal {
  background-color: #222222;
  border: 3px solid #29d9d5;
}
.swal-title {
  color: #29d9d5;
}
.swal-text {
  color: white;
}
.swal-button {
  margin-top: 1rem;
  display: inline-block;
  padding: 1rem 3rem;
  font-size: 1.7rem;
  color: #29d9d5;
  border: 0.2rem solid #29d9d5;
  border-radius: 5rem;
  cursor: pointer;
  background: none;
}
.swal-button:hover {
  background: #29d9d5;
  color: #222222;
}
    </style>
  <body>

<?php

$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"tourism");

$id = $_GET["id"];
$value = $_GET["value"];

$res1= mysqli_query($link,"select des_id from booking where booking_id = $id");
$row1=mysqli_fetch_row($res1);  
$des_id= $row1[0];

$res2= mysqli_query($link,"select code from booking where booking_id = $id");
$row2=mysqli_fetch_row($res2); 
$code = $row2[0];

if($code == $value)
{
	mysqli_query($link,"update booking set email_verification = 'verified',code = 0 where booking_id = $id");
			?>
                <script type="text/javascript">
                    window.location = "sendmail.php?id=<?php echo $id ?>";
                </script>
            <?php
}
else
{
	mysqli_query($link,"delete from booking where booking_id = $id");

			?>
                <script type="text/javascript">
                    swal({
                        title: "Booking Error",
                        text: "Verification Failed. Try Again!!!",
                        icon: "error"
                    }).then(function() {
                        window.location = "booking.php?id=<?php echo $des_id ?>";
                    });
                </script>
            <?php
}

?>

  </body>
</html>