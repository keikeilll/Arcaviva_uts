<?php
session_start();
require '../config/functions.php';

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($password === $row["password"]) {
            $_SESSION["login"] = true;
            header("Location: dashboard.php");
            exit;
        }
    }
    $error = true;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container" style="max-width: 400px; margin: auto; margin-top: 100px;">
        <div class="card">
            <div style="text-align: center; margin-bottom: 10px;">
                <img src="../assets/images/logofix(lagi).png" alt="Logo Arcaviva" style="width: 80px; height: 80px; object-fit: contain;">
            </div>
            <?php if(isset($error)) { echo "<p style='color: red;'>Username atau Password salah</p>"; } ?>
            <form action="" method="post">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login" class="btn" style="width: 100%;">Masuk</button>
            </form>
        </div>
    </div>
</body>
</html>