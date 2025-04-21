<?php
include('smtp/PHPMailerAutoload.php');

$result = ""; 
$receiverEmail = ""; // default value

if (isset($_POST['email'])) {
    $receiverEmail = $_POST['email'];
    
    $conn = new mysqli("localhost", "root", "", "infosec_db");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_POST['email']; 
    $otp = rand(100000, 999999); 

    $stmt = $conn->prepare("INSERT INTO users (email) VALUES (?)");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    $subject = "Email Verification";
    $emailbody = "Your Verification Code: ";

    $result = smtp_mailer($receiverEmail, $subject, $emailbody . $otp);
} else {
    $result = "No email received.";
}

function smtp_mailer($to, $subject, $msg){
    $mail = new PHPMailer(); 
    $mail->IsSMTP(); 
    $mail->SMTPAuth = true; 
    $mail->SMTPSecure = 'tls'; 
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587; 
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';

    $mail->Username = "markangelodumaguin13@gmail.com"; 
    $mail->Password = "ckhx ibxi uvfy hbnp"; 
    $mail->SetFrom("markangelodumaguin13@gmail.com"); 
    $mail->Subject = $subject;
    $mail->Body = $msg;
    $mail->AddAddress($to);
    $mail->SMTPOptions = array('ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => false
    ));
    if(!$mail->Send()){
        return $mail->ErrorInfo;
    } else {
        return "Email verification sent to: " . $to;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Email Verification Code Sent</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('haha.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(4px);
        }

        .message-box {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(15px);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            color: #fff;
            width: 90%;
            max-width: 420px;
            text-align: center;
        }

        .checkmark-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .checkmark {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 5px solid #00e676;
            position: relative;
        }

        .checkmark::after {
            content: '';
            position: absolute;
            left: 22px;
            top: 18px;
            width: 20px;
            height: 40px;
            border-right: 5px solid #00e676;
            border-bottom: 5px solid #00e676;
            transform: rotate(45deg);
            animation: checkmark 0.4s ease-out forwards;
        }

        @keyframes checkmark {
            0% {
                width: 0;
                height: 0;
                opacity: 0;
            }
            100% {
                width: 20px;
                height: 40px;
                opacity: 1;
            }
        }

        .message-box h2 {
            font-size: 32px;
            margin-bottom: 15px;
            color: #00e676;
        }

        .message-box p {
            font-size: 18px;
            margin-bottom: 20px;
            color: #e0f7fa;
        }

        a, .verify-btn {
            padding: 12px 25px;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
            display: inline-block;
            margin-top: 10px;
        }

        a:hover, .verify-btn:hover {
            background: linear-gradient(135deg, #2575fc 0%, #6a11cb 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .verify-btn {
            border: none;
            cursor: pointer;
        }

        @media screen and (max-width: 500px) {
            .message-box {
                padding: 30px 20px;
            }

            .message-box h2 {
                font-size: 24px;
            }

            .message-box p {
                font-size: 16px;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="message-box">
        <div class="checkmark-wrapper">
            <div class="checkmark"></div>
        </div>
        <h2>Success!</h2>
        <p><?php echo $result; ?></p>

        <form action="Authorization.php" method="post">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($receiverEmail); ?>">
            <button type="submit" class="verify-btn">Verify Email</button>
        </form>

        <a href="index.html">Go Back</a>
    </div>
</body>
</html>
