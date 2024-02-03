<?php

include "database.php";
include "header.php";
if ($_SESSION['user_role'] == '0') {
    header("Location:Post.php");
}
if (isset($_POST['save'])) {
    $id = $_POST['id'];
    $user = $_POST['user'];
    $email =  $_POST['email'];
    $phone =  $_POST['phone'];
    $address = $_POST['address'];
    $role = $_POST['role'];
    $sql1 = "UPDATE add_user SET `username`='$user',`user_email`='$email',`user_phone`=$phone,`user_address`='$address',`role`='$role' WHERE user_id=$id";
    // $result =mysqli_query($conn, $sql);
    if (mysqli_query($conn, $sql1)) {
        header("Location:User.php? msg=data Update Successfully");
        exit();
    } else {
        echo "Failed:" . mysqli_error($conn);
    }
}
?>


     <!-- User Update Form Code Start Here -->
<div class="container">
    <div class="Form-content">
        <h1>Edit User</h1>
        <?php
        $id = $_GET['id'];
        $sql = "SELECT * FROM add_user  WHERE  user_id ='$id'";
        $result = mysqli_query($conn, $sql) or die("failed");

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {


        ?>

                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">

                    <input type="hidden" name='id' value="<?php echo $row["user_id"]; ?>">
                    <div class="input-box">
                        <label>User Name <span style="color:red">*</span></label>
                        <input type="text" name="user" value="<?php echo $row['username']; ?>" placeholder="Enter Your username"> <br>
                    </div>
                    <div class="input-box">
                        <label>Email <span style="color:red">*</span></label>
                        <input type="email" name="email" value="<?php echo $row['user_email']; ?>" placeholder="Enter Your Email"> <br>
                    </div>
                    <div class="input-box">
                        <label>Phone <span style="color:red">*</span></label>
                        <input type="number" name="phone" value="<?php echo $row['user_phone']; ?>" placeholder="Enter your phone"> <br>
                    </div>
                    <div class="input-box">
                        <label>Adress <span style="color:red">*</span></label>
                        <input type="text" name="address" value="<?php echo $row['user_address']; ?>" placeholder="Enter your address"> <br>
                    </div>

                    <div class="input-box">
                        <label>User Role <span style="color:red;">*</span></label>
                        <select name="role" value="<?php echo $row['role']; ?>">
                            <?php
                            if ($row['role'] == 1) {
                                echo "<option value='0'>Normal User</option>
    <option value='1' selected >Admin</option>";
                            } else {
                                echo "<option value='0' selected>Normal User</option>
        <option value='1'>Admin</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <input type="submit" name="save" value="Save" class="add-new">
                    <input type="submit" name="cancel" value="Cancel" href="User.php">
                    

    </div>
    </form>
<?php }
        } ?>

</div>
</div>

     <!-- User Update End Here -->