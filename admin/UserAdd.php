<?php
include "header.php";
if ($_SESSION['user_role'] == '0') {// reporter 
    header("Location:Post.php");// 
}
include ("../database/database.php");
if (isset($_POST['save'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = mysqli_real_escape_string($conn, $_POST['user_role']);

// Query 
    $sql = "SELECT * FROM `add_user`  WHERE username='$username' OR user_email='$email'";
    $result = mysqli_query($conn, $sql) or die("Query Failed");

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('UserName already exists')</script>";
        
    } else {
    
        $sql1 = "INSERT INTO `add_user` (username,user_email,user_phone,user_address,user_password,role) VALUES('$username','$email','$phone','$address','$password','$role')";
        if (mysqli_query($conn, $sql1)) {
            header("location:User.php?msg= New User Added Successfully");
       
           
          
        }
    }
}
?>
    <!-- Form Content Html Code Start Here -->   
                 <div class="add_container">
            <h1 class="head">Add New User</h1>

            <!-- Start Form code -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="form"method="POST" autocomplete="off" name="userdata" onsubmit="return validationForm()"> 
            <!--User filed  -->
            <div class="input-box">
            <label>User Name<span style="color:red">*</span></label>
                <input type="text" name="username" id="username" placeholder="Enter Your Username ">
                <small>Error Message</small>
            </div> 
                 <!-- Eamil filed -->
                 <div class="input-box">
                    <label>Email <span style="color:red">*</span></label>
                    <input type="email" name="email" id="email" placeholder="Enter Your Email">
                    <small>Error Message</small>
                </div>
                     <!-- Phone filed -->
                <div class="input-box">
                    <label>Phone <span style="color:red">*</span></label>
                    <input type="number" name="phone" id="phone" placeholder="Enter Your Number">
                    <small>Error Message</small>
                </div>
                    <!-- Adress filed -->
                <div class="input-box">
                    <label>Address <span style="color:red">*</span></label>
                    <input type="text" name="address" id="address" placeholder="Enter Your Address">
                    <small>Error Message</small>
                </div> 
                  <!-- User Role filed -->
                <div class="input-box">
                    <label>User Role <span style="color:red">*</span></label>
                    <select name="role" id="role">
                        <option disabled selected>Select</option>
                        <option value="0">Reporter</option>
                        <option value="1">Admin</option>
                        
                    </select>
                    <small>Error Message</small>
                </div>
                   <!-- password filed -->
                <div class="input-box">
                    <label>Password <span style="color:red">*</span></label>
                    <input type="password" name="password" id="password" placeholder="Enter Your Password">
                    <small>Error Message</small>
                </div>
                <input type="submit" name="save" value="Save" class="btn">
            </form>
                 </div>
                
                
                
                
