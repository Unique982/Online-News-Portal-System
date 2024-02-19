<?php
include "database.php";
session_start();

if (isset($_SESSION["username"])) {
    header("Location:Post.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Css Link -->
     <link rel="stylesheet" href="../Css/style.css">
</head>
<body>

    <!--Html Code Start Here  -->
    <div class="login-container">
        <div class="login-content">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
            <h1 class="title">Unique Online Update </h1>
            <div class="input-box">
                <input type="text" name="username" placeholder="Enter you Username" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>
            <input type="submit" class="btn" name="login" value="Login" onclick="validate()">
            <div>
            </div>
        </form>
        <?php
        if (isset($_POST['login'])) {
            include "database.php";
            $username = $_POST['username'];
            $password = $_POST['password'];

            $sql = "SELECT user_id, username, role FROM add_user WHERE username='{$username}' AND user_password='{$password}'";
            $result = mysqli_query($conn, $sql) or die("Query Failed");

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    session_start();
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['user_role'] = $row['role'];
                    header("location:Post.php");
                }

            } else {
                echo  "<script>alert('Username and password are not Match')</script>";
            }
        }
        ?>
    </div>
    </div>
</body>

</html>
      <!--End Html Code Here  -->