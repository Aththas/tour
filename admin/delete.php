<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="js/sweetalert.min.js"></script>
</head>
<body>

<?php

$id = $_GET["id"];
$name = $_GET["name"];

?>
<script type="text/javascript">
 swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this data!!!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) 
  {
    window.location = "confirmDelete.php?id=<?php echo $id ?>&name=<?php echo $name ?>";
  } else 
  {<?php
    if($name == "tour")
    {?>
        window.location = "tour.php";
        <?php
    }
    else if($name == "blog")
    {?>
        window.location = "blog.php";
        <?php
    }
    else if($name == "staff")
    {?>
        window.location = "staff.php";
        <?php
    }
    else if($name == "menu")
    {?>
        window.location = "settings.php";
        <?php
    }
    ?>
  }
});
</script>

</body>
</html>