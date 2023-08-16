<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'carrental/admin/phpmailer/src/Exception.php';
    require 'carrental/admin/phpmailer/src/PHPMailer.php';
    require 'carrental/admin/phpmailer/src/SMTP.php';

    if(isset($_POST["send"])){
        $mail=new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host='smtp.gmail.com';
        $mail->SMTPAuth=true;
        $mail->Username='ajimiyaayoobkhan@gmail.com';
        $mail->Password='Ajimiya_Ayoob';
        $mail->SMTPSecure='ssl';

        $mail->Port=465;
        $mail->setFrom('ajimiyaayoobkhan@gmail.com');
        $mail->addAddress($_POST['EmailId']);

        $mail->isHTML(true);
        $mail->Subject=$_POST["name"];
        $mail->Body=$_POST["Bikechoosen"];
        $mail->Body=$_POST["PostingDate"];


        $mail->send();
        echo 
        
        "
            <script>
                alert('Sent Successfully');
                document.location.href='Bike-bookingdetails';
            </script>
        ";


    }
?>