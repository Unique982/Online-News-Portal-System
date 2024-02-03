    
    <?php
    include "header.php";
   if($_SESSION["user_role"] == '0'){
    header("Location:Post.php");
   }


   // Calculate The Pagaination Code here 
     include 'database.php';
     $limit = 5;
    
     // pagination code
          if(isset($_GET['page'])){
          $page = $_GET['page'];
     
          }else{
           $page = 1;
          }
          $offset  = ($page - 1) * $limit;
          // end of pagination code
     
     $sql = "SELECT * FROM post_category ORDER BY category_id DESC LIMIT {$offset}, {$limit}";
     $result =mysqli_query($conn,$sql) or die("Query Failed");
     if(mysqli_num_rows($result) > 0){

     

     
     ?>


           <!-- Table Content Start Here -->

<div class="table">
<div class="table-head">
  <p>Category Page</p>
  <a class="add-new" href="Category Add.php">+ Add Category</a>
</div>
     <!-- <h1 style="text-align: center;"> All Category</h1>
    <a class="add-new"href="Category Add.php">Add Category</a>
    </button> -->
    <div class="table_content">
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Category Name</th>
            <th>No.Of Post</th>
            <th>Action</th>   
        </tr>
        </thead>
        <tbody>
       <?php 
       $serial_number =    $offset +1;
       while($row= mysqli_fetch_assoc($result)){
       ?>
        <tr>
        <td class="id"><?php echo $serial_number ?></td>
        <td><?php echo $row['category_name']?></td>
        <td><?php echo $row['category_post']?></td>
        <td>
        <a href="Category Update.php?id=<?php echo $row["category_id"]; ?>" ><i class="fa-solid fa-pen-to-square" style="color: #2c6609;"></i></a>
        <a href="Category Delete.php?id=<?php echo $row['category_id']; ?>"><i class="fa-solid fa-trash" style="color: #ff0000;"></i></a>
            </td>

            <?php 
        $serial_number++;
        ?>
        </tr>
        <?php } ?>
      </tbody>
       
    </table>
    </div>
</div>




<!-- Table Content End HEre -->

<!-- Paginaton Start Code Start Here -->
<div class="pagination">

    <?php
$sql1 = "SELECT *FROM post_category";
$result1 = mysqli_query($conn, $sql1);
if(mysqli_num_rows($result1) >0){
    $total = mysqli_num_rows($result1);
    
    $total_page = ceil($total / $limit);
    echo'<ul class="pagination_content">';


 if($page > 1){
  echo '<li><a href="Category.php?page='.($page - 1).'">Prev</a></li>';
 }
    for($i = 1; $i <= $total_page; $i++){
      if($i == $page){
        $active = "active";
      }
else{
  $active= "";
}
echo'  <li class="" '.$active.'"><a href="Category.php?page='.$i.'">'.$i.'</a></li>';
    }
if($total_page > $page){
  echo '<li><a href="Category.php?page='.($page + 1).'">Next</a></li>';
 }
    

echo '</ul>';

}


     }
  // Pagination Code End Here
    
    
     ?>
   </div>
