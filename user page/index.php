
<?php
include 'header.php';

    ?>
   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../Css/font.css">
    <link rel="stylesheet" href="../Css/style.css">
</head>

<body>

    <section class="post-container" id ="post-container">
        <div class="post">
        <?php
        include ("../database/database.php"); // DAtabase Configuration link

        // pagination code Calculate offset code
        $limit1 = 7;


        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $offset  = ($page - 1) * $limit1;
        /* Select query  code  */
        $sql = "SELECT news_post.post_id, news_post.post_title, news_post.post_description, news_post.category,news_post.author, news_post.date, post_category.category_name, add_user.username, news_post.category ,news_post.post_Uploadimg FROM news_post 
    LEFT JOIN post_category ON news_post.category =post_category.category_id
    LEFT JOIN add_user ON news_post.author = add_user.user_id
    WHERE post_category.status =0 
     ORDER BY news_post.post_id DESC LIMIT {$offset},{$limit1}";
     //  WHERE post_category.status =0  new code

        $result = mysqli_query($conn, $sql) or die("Query Failed"); // query check

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                

        ?>
            <div class="post-content">
            <a href="../pages/single.php?id=<?php echo $row['post_id']; ?>"> <img src="../admin/Post UploadImg/<?php echo $row['post_Uploadimg']; ?>" alt="">
                        </a>
                        <div class="date">
                        <span>
                            <i class="fa-solid fa-tag"></i><a href='Category.php?category_id=<?php echo $row['category']; ?>'><?php echo $row['category_name']; ?></a>
                        </span>
                        
                        <span>
                            <i class="fa-solid fa-user"></i><a href='author.php?aid=<?php echo $row['author']; ?>'><?php echo $row['username']; ?></a>
                        </span>
                 
                        <span>
                            <i class="fa-solid fa-calendar-days"></i><a href="#time"><?php echo $row['date']; ?></a>
                        </span>
                    
                        </div>
                        <h3><a href="single.php?id=<?php echo $row['post_id'] ?>" class="post-title"><?php echo $row['post_title'] ?></a></h3>
                        <p class="description"><?php echo substr($row['post_description'], 0, 300) . "..."; ?></p>
                        <a href='single.php?id=<?php echo $row['post_id']; ?>' class="red">Read More >></a>
                    </div>
         
            <?php } //<-- While loop end -->
        } //<-- if condition end -->
    
        ?>
          
        </div>
      
<!-- Recent post code -->
<?php include 'sidebar.php';?>
           
    </section>
    <div class="pagination_container">
        <?php

        // pagination code heres
        include "../database/database.php";
        $sql1 = "SELECT *FROM  news_post";
        $result1 = mysqli_query($conn, $sql1);
        if (mysqli_num_rows($result1)) {
            $total = mysqli_num_rows($result1);

            $total_page = ceil($total / $limit1);

            // echo '<ul class="pagination" id="pagination">';

            if ($page > 1) {
                echo '<li><a href="index.php?page=' . ($page - 1) . '"><<</a></li>';
            }
            for ($i = 1; $i <= $total_page; $i++) {
                if ($i == $page) {
                    $active = "active";
                } else {
                    $active = "";
                }
                echo '<li class="' . $active . '"><a href="index.php?page=' . $i . '">' . $i . '</a></li>';
            }
            if ($total_page > $page) {
                echo '<li><a href="index.php?page=' . ($page + 1) . '">>></a></li>';
            }


            echo '</ul>';
        }
        ?>
        <!-- End pagination Code -->

    </div>
<?php
include "footer.php";

?>
</body>
</html>

