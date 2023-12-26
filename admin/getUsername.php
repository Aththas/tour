<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="js/sweetalert.min.js"></script>
</head>
<body>
<script type="text/javascript">
            swal("Enter your username :", {
                content: "input",
            })
            .then((value) => {
                window.location = "verifyCode.php?id="+ value;
            });
    </script>
</body>
</html>