<?php 
include 'header.php'
?>

      <!-- Start Html Code Here -->
      <?php
include 'database.php';
$sql= "select * from setting1";
$result= mysqli_query($conn, $sql) or die("Query failed");
if(mysqli_num_rows($result)>0){
    while ($row =mysqli_fetch_array($result)){

?>     
      <div class="add_container">
            <h1 class="head">Setting</h1>
     <!-- Start Form code -->
            <form action="setting.php" method="POST" enctype="multipart/form-data" id="form">
              <!--Title filed  -->
            <div class="input-box">
                <label>Logo Name<span style="color:red;">*</span></label>
                <input type="text" name="logo" id="logo" value="<?php echo $row['logo'];?>">
             <small>Error Message</small>
            </div>
            
                 <!-- Description filed -->
            
                 <div class="input-box">
                <label>Footer <span style="color:red;">*</span></label>
                <textarea name="footer" id="footer" cols="20" rows="10"><?php echo $row['footer'];?></textarea>
             <small>Error Message</small>
            </div>
            <input type="submit" name="save" value="Post" class="btn">
            </form>
        
        <?php 
                   
                }
            }?>
            </div>
       <!-- From save in php  -->
       <?php 
include 'database.php';
if(isset($_POST['save'])){
$logo =mysqli_real_escape_string($conn,$_POST['logo']);
$footer =mysqli_real_escape_string($conn,$_POST['footer']);

       $sql1= "Update setting1 set logo='{$_POST["logo"]}',footer='{$_POST["footer"]}'";
       $result1= mysqli_query($conn,$sql1);
       if($result1){
        header("Location:setting.php");
       }
       else{
        echo "Query Failed";
       }
    }
       ?>