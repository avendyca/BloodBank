<?php
session_start();
include 'config/connection.php';
global $connection;
onlyForGuest();

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $connection->prepare("SELECT id, email, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['login-admin'] = true;
            $_SESSION['login-user'] = false;
            header("Location: dashboarddev.php");
            exit();
        } else {
            $error = "Email atau password salah";
        }
    } else {
        $error = "Email atau password salah";
    }

    $stmt->close();
    $connection->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/loginadmin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>
    <div class="bg"></div>
    <div class="bg bg2"></div>
    <div class="bg bg3"></div>
    <div class="content">
        <div class="wrapper">
            <header>Login Form</header>
            <?php if (!empty($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
            <form action="dashboarddev.php" method="POST">
                <div class="field email">
                    <div class="input-area">
                        <input type="text" name="email" placeholder="Email Address" required>
                        <i class="icon fas fa-envelope"></i>
                        <i class="error error-icon fas fa-exclamation-circle"></i>
                    </div>
                    <div class="error error-txt">Email can't be blank</div>
                </div>
                <div class="field password">
                    <div class="input-area">
                        <input type="password" name="password" placeholder="Password" required>
                        <i class="icon fas fa-lock"></i>
                        <i class="error error-icon fas fa-exclamation-circle"></i>
                    </div>
                    <div class="error error-txt">Password can't be blank</div>
                </div>
                <input type="submit" value="Login" style="margin-bottom: 10px;">
                <button type="button" onclick="history.back()" style="background-color: #FF9191; color: white; padding: 10px 20px; border: none; border-radius: 6px; text-align: center; font-size: 16px; cursor: pointer; width: 100%;">Back</button>
            </form>
        </div>
    </div>
    <script src="assets/js/loginadmin.js"></script>
</body>
</html>
