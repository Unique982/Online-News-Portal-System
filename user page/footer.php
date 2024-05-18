
<div id="footer">
    <div class="footer-bottom">
    <?php
 include ("../database/database.php");
$sql= "select * from setting1";
$result= mysqli_query($conn, $sql) or die("Query failed");
if(mysqli_num_rows($result)>0){
    while ($row =mysqli_fetch_array($result)){

?>     
        <p><?php echo $row['footer'];?></p>
      
   <?php  }}?>
    </div>
</div>
</div>

</body>

</html>
