
<html>
  <head>
    <title>Verify</title>
    <script src="js/sweetalert.min.js"></script>
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
  </head>
  <body>
    

<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"tourism");

$id = $_GET["id"];

$res1= mysqli_query($link,"select email from booking where booking_id = $id ");
$row1=mysqli_fetch_row($res1);  
$email= $row1[0];

$res3= mysqli_query($link,"select des_id from booking where booking_id = $id");
$row3=mysqli_fetch_row($res3);  
$des_id= $row3[0];

$rs_home_link = mysqli_query($link,"select link from menu where type = 'home'");
$row_home_link = mysqli_fetch_row($rs_home_link);
$home_link = $row_home_link[0];

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
    $mail->Subject = 'Regarding the booking';
    $mail->Body    = 'Your booking is under process. You will get a confirmation mail with in 24 hours. Your booking id is '.$id.'.';

    $mail->send();
    ?>
    <script type="text/javascript">
        window.location = "<?php echo $home_link ?>";
    </script>
    <?php

} catch (Exception $e) {
    mysqli_query($link,"delete from booking where booking_id = $id");

            ?>
                <script type="text/javascript">
                    swal({
                        title: "Booking Error",
                        text: "Booking Failed. Try Again!!!",
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