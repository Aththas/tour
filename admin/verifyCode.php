<html>
  <head>
    <title>Verify</title>
    <script src="js/sweetalert.min.js"></script>
  </head>
  <body style="background-color: black;">
    

<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"tourism");

$id = $_GET["id"];

$rs = mysqli_query($link, "select email from admin where username = '$id'");
$row = mysqli_fetch_row($rs);
$email = $row[0];

$v1=rand(1111,9999);
$v2=rand(1111,9999);
$v3=($v1.$v2)/100;
$code=intval($v3);

require 'Mailer/PHPMailer-master/src/Exception.php'; 
require 'Mailer/PHPMailer-master/src/PHPMailer.php'; 
require 'Mailer/PHPMailer-master/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
//ast_123_
try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'aststore39@gmail.com';                     //SMTP username
    $mail->Password   = 'ivtjilpnzcgehuxz';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('aststore39@gmail.com');
    $mail->addAddress($email);     //Add a recipient             //Name is optional


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Verification Code';
    $mail->Body    = $code;

    $mail->send();
    ?>
        <script type="text/javascript">
            swal("Verification Code has been sended to <?php echo $email; ?>. Enter the Verification code :", {
                content: "input",
            })
            .then((value) => {
                window.location = "check.php?id=<?php echo $id; ?>&code=<?php echo $code; ?>&value="+ value;
            });
    </script>
    <?php

} catch (Exception $e) {

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

	