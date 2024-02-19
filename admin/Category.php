    
    <?php
    include "header.php";
   if($_SESSION["user_role"] == '0'){
    header("Location:Post.php");
   }


   // Calculate The Pagaination Code here 
     include 'database.php';
     $limit = 7;
    
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

   <!-- Table Content Start Here -->
   <div class="table_container">
        <div class="table_content">
            <p>Category Page</p>
            <div>
            <button class="add_new"><a class="add_new"href="Category Add.php">+ ADD</a></button>
            </div>
        </div>
     <!-- <h1 style="text-align: center;"> All Category</h1>
    <a class="add-new"href="Category Add.php">Add Category</a>
    </button> -->
    <div class="table_data">
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
        <button><a href="Category Update.php?id=<?php echo $row["category_id"]; ?>" class="btn"><i class="fa-solid fa-pen-to-square"></i></a></button> 
        <button><a href="Category Delete.php?id=<?php echo $row['category_id']; ?>"clas="btn"><i class="fa-solid fa-trash"></i></a></button>       
      </td>
            <?php 
        $serial_number++;
        ?>
        </tr>
        <?php } ?>
      </tbody>
       
    </table>
    </div>
<!-- Table Content End HEre -->

<!-- Paginaton Start Code Start Here -->
<div class="pagination_container">

    <?php
$sql1 = "SELECT *FROM post_category";
$result1 = mysqli_query($conn, $sql1);
if(mysqli_num_rows($result1) >0){
    $total = mysqli_num_rows($result1);
    
    $total_page = ceil($total / $limit);
   


 if($page > 1){
  echo '<li><a href="Category.php?page='.($page - 1).'"><i class="fa-solid fa-angles-left"></i></a></li>';
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
  echo '<li><a href="Category.php?page='.($page + 1).'"><i class="fa-solid fa-angles-right"></i></a></li>';
 } }  }
  // Pagination Code End Here
     ?>
   </div>
   <?php
   
   include 'footer.php';
   ?>
   