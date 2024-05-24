<?php
include 'header.php';
// redirect the file and not open normal user
if ($_SESSION['user_role'] == '0') {

  header("Location:Post.php ");
}
?>


<!--Pagination code  -->
<?php
include 'database.php';
$limit = 4;


if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 1;
}
$offset  = ($page - 1) * $limit;


$sql = "SELECT * FROM add_user ORDER BY user_id DESC  LIMIT {$offset}, {$limit}";
$result = mysqli_query($conn, $sql) or die("Query Failed");
$count = mysqli_num_rows($result);
if ($count > 0) {




?>
          <!-- Table Content Start Here -->
          <div class="table_container">
        <div class="table_content">
            <p>User Page</p>
           <?php if(isset($_GET['msg'])){
       $msg = $_GET['msg'];
        echo "<p style='color:green;font-weight:bold;font-size:20px; align-text:center'>$msg</p>";
            }?>
            <div>
            <button class="add_new"><a class="add_new"href=UserAdd.php>+ ADD</a></button>
            </div>
        </div>
     <div class="table_data">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Phone-Number</th>
            <th>Address</th>
            <th>Role</th>
            <th> Reg-Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $serial_number =    $offset + 1;
          while ($row = mysqli_fetch_assoc($result)) {
          ?>
            <tr>
              <td class="id"><?php echo $serial_number ?></td>
              <td><?php echo $row['username'] ?></td>
              <td><?php echo $row['user_email'] ?></td>
              <td><?php echo $row['user_phone'] ?></td>
              <td><?php echo $row['user_address'] ?></td>
              <td><?php
                  if ($row['role'] == 1) {
                    echo "Admin";
                  } else {
                    echo "Normal User";
                  }
                  ?></td>
              <td><?php echo $row['date'] ?></td>
              <td>
                <button><a href="UserEdit.php?id=<?php echo $row["user_id"] ;?>" class="btn"><i class="fa-solid fa-pen-to-square"></i></a></button> 
                <button><a href="UserDelete.php?id=<?php echo $row['user_id'] ?>"clas="btn"><i class="fa-solid fa-trash"></i></a></button> 
              </td>
              <?php
              $serial_number++;
              ?>
            </tr>
          <?php } ?>
        </tbody>
      <?php
    } ?>
      </table>
    </div>
    <!-- End Table COntent Code Here -->

<!-- pagination caode here -->
<div class="pagination_container">
    <?php
    // pagination code heres
    $sql1 = "SELECT *FROM add_user";
    $result1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result1) > 0) {
      $total = mysqli_num_rows($result1);

      $total_page = ceil($total / $limit);
     


      if ($page > 1) {
        echo'<li><a href="User.php?page=' . ($page - 1) . '"><i class="fa-solid fa-angles-left"></i></a></li>';
        
      }
      for ($i = 1; $i <= $total_page; $i++) {
        if ($i == $page) {
          $active = "active";
        } else {
          $active = "";
        }
        echo '  <li class= ' . $active . '><a href="User.php?page=' . $i . '">' . $i . '</a></li>';
      }
      if ($total_page > $page) {
      echo' <li><a href="User.php?page=' . ($page + 1) . '"><i class="fa-solid fa-angles-right"></i></a></li>';
    }?>
  </div>
  <?php }?>
  

  <?php
    include 'footer.php';
    ?>
    <!-- Pagination ENd Here -->
