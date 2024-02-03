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
    <link rel="stylesheet" href="/admin/css/style.css">

    <!-- Font -awesome link  -->
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@300;400;500;600;700;800;900;&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', serif;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-image: url("https://th.bing.com/th/id/OIG.g3Ln180ZEYO3LeNo_9e7?pid=ImgGn");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;

    }

    .container {
        width: 420px;
        background: transparent;
        border: 2px solid rgba(255, 255, 255, .2);
        backdrop-filter: blur(20px);
        box-shadow: 0 0 10px rbga(0, 0, 0, .2);
        color: #fff;
        border: 10px;
        padding: 30px 40px;
    }

    .container h1 {
        font-size: 36px;
        text-align: center;

    }

    .container .input-box {
        position: relative;
        width: 100%;
        height: 50px;

        margin: 30px 0;
    }

    .input-box input {
        width: 100%;
        height: 100%;
        background: transparent;
        border: none;
        outline: none;
        border: 2px solid rgba(255, 255, 255, .2);
        border-radius: 40px;

        color: #fff;
        font-size: 16px;
        padding: 20px 45px 20px 20px;
    }

    .input-box input::placeholder {
        color: #fff;

    }


    .container .btn {
        width: 100%;
        height: 40px;
        background: black;
        border: none;
        outline: none;
        border-radius: 40px;
        box-shadow: 0 0 10px rgba();
        cursor: pointer;
        font-size: 1em;
        color: #fff;
        font-weight: 600;
    }
</style>

<body>

    <!--Html Code Start Here  -->
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
            <h1>Login Login Page </h1>
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

</body>

</html>
      <!--End Html Code Here  -->