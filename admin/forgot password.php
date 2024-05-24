<?php 
 include ("../database/database.php");
session_start();
if(isset($_POST['forgot'])){
 $user_email = $_POST['user_email'];
 $rand = rand(1000,9999);
 $sql = "SELECT  * FROM add_user";
 $result = mysqli_query($conn, $sql);
 $select_rows = mysqli_fetch_assoc($result);
 $select_email = $select_rows['user_email'];
 if($select_email == $user_email){
    $to = $user_email;
    $subject= "Verification code";
    $body ="Hello $username \n this is your validation code :$rand";
$header = "From:uniqueneupane153@gmail.com";
  if(mail($to, $subject, $body)){
    $_SESSION['otp'] = $rand;
    header("location:otp.php");

  }
else{
    echo "OPT Sending Fail";
}
 }
 
 else {
    echo "Please enter valid mail id";
}
// if($result){
//  if(mysqli_num_rows($result)==1){
//  $reset_token = bin2hex(random_bytes(16));
//  date_default_timezone_set('Asia/Kathamndu');
//  $date=date("Y-m-d H:i:s");
//  $sql ="update add_user Set 'resttoken='$reset_token','$resttokenexpire'='$date' where"
//  }
//  else{
//     echo "<script>alert('invalida enter email);
//     window.location.href='index.php';
//     </script>";
//  }
// }
// else{
//     echo "<script>alert('cannot run quert);
//     window.location.href='index.php';
//     </script>";
// }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    
</style>
<body>
<div class="login-container">
        <div class="login-content">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
            <h1 class="title">Unique Online Update </h1>
            <div class="input-box">
                <label>Email</label>
                <input type="email" name="user_email">
            </div>
            <input type="submit" name="forgot">
        </form>
        </div>
</div>
</body>
</html>
