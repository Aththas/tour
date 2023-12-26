<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="js/sweetalert.min.js"></script>
</head>
<body>

<?php

$id = $_GET["id"];

?>
<script type="text/javascript">
 swal({
  title: "Are you sure?",
  text: "Once confirmed, you will not be able to change this data again!!!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) 
  {
    window.location = "confirmMail.php?id=<?php echo $id ?>";
  } else 
  {
    window.location = "booking.php";
  }
});
</script>

</body>
</html>