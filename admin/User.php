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
$limit = 3;


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
  <div class="table">
    <div class="table-head">
      <p>User Page</p>
      <a class="add-new" href="UserAdd.php">+ Add User</a>
    </div>
    <!-- <h1>
    <h1>All User page</h1>
    <a class="add-new"href="UserAdd.php">User Add</a>
    </button> -->
    <div class="table_content">
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
                <button> <a href="UserEdit.php?id=<?php echo $row["user_id"] ?>"><i class="fa-solid fa-pen-to-square" style=color:white;font-size:20px;></i></a></button>
                <button> <a href="UserDelete.php?id=<?php echo $row['user_id'] ?>" class="link-dark"><i class="fa-solid fa-trash" style=color:white;font-size:20px;></i></a></button>
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



  </div>
    <!-- End Table COntent Code Here -->


  <div class="pagination">

    <?php


    // pagination code heres
    $sql1 = "SELECT *FROM add_user";
    $result1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result1) > 0) {
      $total = mysqli_num_rows($result1);

      $total_page = ceil($total / $limit);
      echo '<ul class="pagination_content">';


      if ($page > 1) {
        echo '<li><a href="User.php?page=' . ($page - 1) . '">Prev</a></li>';
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
        echo '<li><a href="User.php?page=' . ($page + 1) . '">Next</a></li>';
      }


      echo '</ul>';
    }


    ?>

  </div>
    <!-- Pagination ENd Here -->