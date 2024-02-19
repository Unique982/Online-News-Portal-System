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
     
</div>
</div>

     <!-- User Update End Here -->
     <!-- Form Content Html Code Start Here -->   
     <div class="add_container">
            <h1 class="head">Update User</h1>
            <?php
        $id = $_GET['id'];
        $sql = "SELECT * FROM add_user  WHERE  user_id ='$id'";
        $result = mysqli_query($conn, $sql) or die("failed");

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {


        ?>

            <!-- Start Form code -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
           <div class="input-box">
           <input type="hidden" name='id' value="<?php echo $row["user_id"]; ?>">
           </div>
            <!--User filed  -->
            <div class="input-box">
            <label>User Name<span style="color:red">*</span></label>
            <input type="text" name="user" value="<?php echo $row['username']; ?>" placeholder="Enter Your username">
             <small>Error Message</small>
            </div> 
                 <!-- Eamil filed -->
                 <div class="input-box">
                    <label>Email <span style="color:red">*</span></label>
                    <input type="email" name="email" value="<?php echo $row['user_email']; ?>" placeholder="Enter Your Email">
                    <small>Error Message</small>
                </div>
                     <!-- Phone filed -->
                <div class="input-box">
                    <label>Phone <span style="color:red">*</span></label>
                    <input type="number" name="phone" value="<?php echo $row['user_phone']; ?>" placeholder="Enter your phone">
                    <small>Error Message</small>
                </div>
                    <!-- Address filed -->
                <div class="input-box">
                    <label>Address <span style="color:red">*</span></label>
                    <input type="text" name="address" value="<?php echo $row['user_address']; ?>" placeholder="Enter your address">
                    <small>Error Message</small>
                </div> 
                  <!-- User Role filed -->
                <div class="input-box">
                    <label>User Role <span style="color:red">*</span></label>
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
                        <small>Error Message</small>
                </div>
            
                <input type="submit" name="save" value="Save" class="btn">   
            </form>
                 </div>
                 <?php }
        } ?>