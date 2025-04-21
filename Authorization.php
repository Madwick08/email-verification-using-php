<?php
$email = isset($_POST['email']) ? $_POST['email'] : '';
$otpEntered = isset($_POST['otp']) ? $_POST['otp'] : '';
$verified = isset($_POST['verify']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $verified ? 'Email Verified' : 'Enter OTP'; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-image: url('haha.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(8px);
        }

        .box {
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(20px);
            padding: 50px 35px;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            color: #ffffff;
            width: 90%;
            max-width: 420px;
            text-align: center;
            animation: fadeIn 0.5s ease-out;
        }

        h2 {
            font-size: 26px;
            font-weight: 600;
            margin-bottom: 25px;
        }

        p {
            font-size: 16px;
            margin-bottom: 20px;
            color: #d0f0ff;
        }

        input[type="text"] {
            padding: 14px;
            width: 100%;
            margin-bottom: 25px;
            border-radius: 12px;
            border: none;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
            outline: none;
        }

        input::placeholder {
            color: #ccc;
        }

        .submit-btn,
        a.button-link {
            padding: 14px 28px;
            background: linear-gradient(135deg, #00c6ff, #0072ff);
            color: #fff;
            font-weight: 600;
            border-radius: 14px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }

        .submit-btn:hover,
        a.button-link:hover {
            background: linear-gradient(135deg, #0072ff, #00c6ff);
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.25);
        }

        .checkmark {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            border: 5px solid #00e676;
            position: relative;
            margin: 0 auto 25px;
        }

        .checkmark::after {
            content: '';
            position: absolute;
            left: 25px;
            top: 20px;
            width: 20px;
            height: 40px;
            border-right: 5px solid #00e676;
            border-bottom: 5px solid #00e676;
            transform: rotate(45deg);
            animation: checkmark 0.4s ease-out forwards;
        }

        @keyframes checkmark {
            0% { width: 0; height: 0; opacity: 0; }
            100% { width: 20px; height: 40px; opacity: 1; }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 480px) {
            .box {
                padding: 35px 25px;
            }
        }
    </style>
</head>
<body>

<?php if (!$verified): ?>
    <div class="box">
        <h2>Verify Your Email</h2>
        <form action="Authorization.php" method="post">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <input type="text" name="otp" maxlength="6" placeholder="Enter 6-digit code" required>
            <button type="submit" name="verify" class="submit-btn">Verify</button>
        </form>
    </div>
<?php else: ?>
    <div class="box">
        <div class="checkmark"></div>
        <h2 style="color:#00e676;">Email Verified</h2>
        <p>The email <strong><?php echo htmlspecialchars($email); ?></strong> has been verified successfully!</p>
        <a href="index.html" class="button-link">Return Home</a>
    </div>
<?php endif; ?>

</body>
</html>
