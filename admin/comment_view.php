<style>
  body{
    background: lightblue;
  }
  .table_content{
background: lightblue;
  }
  .errortitle{
    align-items: center;
  }
</style>
<?php
    include "header.php";
   

   // Calculate The Pagaination Code here 
   include ("../database/database.php");
     $limit = 10;
    
     // pagination code
          if(isset($_GET['page'])){
          $page = $_GET['page'];
     
          }else{
           $page = 1;
          }
          $offset  = ($page - 1) * $limit;
          // end of pagination code
         $sql = "SELECT post_comment.comment_id, post_comment.comment,post_comment.comment_date,post_comment.comment_reply,post_comment.status,visitor.username,visitor.email  FROM post_comment
          LEFT JOIN visitor ON post_comment.v_id = visitor.v_id
          ORDER BY comment_id DESC LIMIT {$offset}, {$limit}";
    
     $result =mysqli_query($conn,$sql) or die("Query Failed");
     if(mysqli_num_rows($result) > 0){
     ?>
<div class="table_container">
        <div class="table_content">
           <p>View ALl comment</p>
           <?php if(isset($_GET['msg'])){
       $msg = $_GET['msg'];
        echo "<p class='errortitle' style='color:green;font-weight:bold;font-size:20px;'>$msg</p>";
            }?>
            <div>
              
            </div>
        </div>
     <div class="table_data">
      <table>
        <thead>
        
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Comment</th>
            <th>Status</th>
            <th>Action</th>
            <th>Delete</th>
           
     
        </thead>
        <tbody><?php 
       $serial_number =    $offset +1;
       while($row= mysqli_fetch_assoc($result)){
       ?>
            <td class="id"><?php echo $serial_number ?></td>
        <td><?php echo $row['username']?></td>
        <td><?php echo $row['email']?></td>
        <td><?php echo $row['comment']?></td>
        <td><?php if ($row['status'] == 0) {
                    echo "Active";
                  } else {
                    echo "Deactive";
                  }
                  ?></td>
              <td>
                <form action="comment_approve.php" method="POST">
              <input type="hidden" name="cid" value="<?php echo $row['comment_id']; ?>">
              <!-- Status check if -->
              <?php if ($row['status'] == 0) {
                echo "<button type='submit' name='unapprove'class='btn' style='color:#fff;font-size:15px;background:green;'>UnApprove</a></button>";
                  
              } else {
                    echo "<button type='submit' name='approve'class='btn' style='color:#fff;font-size:15px;background:blue'>Approve</a></button>";
                  }
                  ?>
                </form>
                </td>
                <td><button class='btn' style='color:#fff;font-size:15px;background:red'><a href="delete_comment.php?cid=<?php echo $row['comment_id'] ?>">
                <i class="fa-solid fa-trash "style='color:#fff;'></i></a></button> </td>

              </td>
                
              <?php 
        $serial_number++;
        ?>
            </tr>
           
         <?php } }?>
        </tbody>
      </table>
    </div>
    <div class="pagination_container">

    <?php
$sql1 = "SELECT *FROM post_comment";
$result1 = mysqli_query($conn, $sql1);
if(mysqli_num_rows($result1) >0){
    $total = mysqli_num_rows($result1);
    
    $total_page = ceil($total / $limit);
   


 if($page > 1){
  echo '<li><a href="comment_view.php?page='.($page - 1).'"><i class="fa-solid fa-angles-left"></i></a></li>';
 }
    for($i = 1; $i <= $total_page; $i++){
      if($i == $page){
        $active = "active";
      }
else{
  $active= "";
}
echo'  <li class="" '.$active.'"><a href="comment_view.php?page='.$i.'">'.$i.'</a></li>';
    }
if($total_page > $page){
  echo '<li><a href="comment_view.php?page='.($page + 1).'"><i class="fa-solid fa-angles-right"></i></a></li>';
 } }  
  // Pagination Code End Here
     ?>
   </div>
   
   <?php
   
   include 'footer.php';
   ?>
</div></div>
