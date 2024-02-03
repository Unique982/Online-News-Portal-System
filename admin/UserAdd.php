<?php

include "header.php";
if ($_SESSION['user_role'] == '0') {
    header("Location:Post.php");
}

include 'database.php';
if (isset($_POST['save'])) {
    $user = mysqli_real_escape_string($conn, $_POST['user']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);


    $sql = "SELECT * FROM `add_user`  WHERE username='$user' OR user_email='$email'";
    $result = mysqli_query($conn, $sql) or die("Query Failed");

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('UserName already exists');</script>";
    } else {
        $sql1 = "INSERT INTO `add_user` (username,user_email,user_phone,user_address,user_password,role) VALUES('$user','$email',$phone,'$address','$password','$role')";
        if (mysqli_query($conn, $sql1)) {
            header("location:User.php");
            echo "<script>alert('New User Add ');</script>";
        }
    }
}


?>

    <!-- Form Content Html Code Start Here -->
<div class="container">
    <div class="Form-content">
        <h2>Add User</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                <div class="input-box">
                    <label>User Name<span style="color:red">*</span></label>
                    <input type="text" name="user" placeholder="Enter Your username">
                </div>

                <div class="input-box">
                    <label>Email <span style="color:red">*</span></label>
                    <input type="email" name="email" placeholder="Enter Your full name">
                </div>

                <div class="input-box">
                    <label>Phone <span style="color:red">*</span></label>
                    <input type="number" name="phone" placeholder="Enter your phone">
                </div>

                <div class="input-box">
                    <label>Adress <span style="color:red">*</span></label>
                    <input type="text" name="address" placeholder="Enter your address">
                </div>

                <div class="input-box">
                    <label>Password <span style="color:red">*</span></label>
                    <input type="password" name="password" placeholder="Enter your password">
                </div>
                <div class="input-box">
                    <label>User Role <span style="color:red">*</span></label>
                    <select name="role">
                        <option disabled selected>Select</option>
                        <option value="0">Normal User</option>
                        <option value="1">Admin</option>
                    </select>
                </div>
                <input type="submit" name="save" value="Save" class="add-new">
            </form>
    </div>
</div>
                   <!--End From Contect Code Here  -->