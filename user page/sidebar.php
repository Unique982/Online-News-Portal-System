

    <style>
        .serach-container{
            display: flex;
            background-color: #fefefe;
            flex-wrap: flex;
            justify-content: flex-end;
            align-items: center; 
            height: 50vh;
      
        }
        .serach-box{
            padding: 10px;
            background-color: #eee;
            border-radius: 5px;
           
            width: 300px;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
            box-sizing: border-box;
        }
        .serach-box input[type="text"]{
            width: 100%;
            padding: 10px;
            border-radius: 2px;
            box-sizing: border-box;
            margin-bottom: 7px;
            
        }
        .serach-box input[type="submit"]{
            width: 100%;
            padding: 10px;
            background-color: #0fffff;
            color: #000;
            border: none;
            border-radius: 4px;
            cursor: pointer;

        }
        
    </style>

<div class="sidebar">
<div class="serach-box">
    <h4>Search</h4>
    <form action="search.php" method="GET">
        <input type="text" name="search_term" placeholder="Serach">
        <input type="submit" value = "Search" name="Search">
    </form>
</div>
<div class="recent-post-container">
    <h4>Recent Post</h4>
    <?php
    
     include "database.php";
     $limit =4;
     $sql = "SELECT news_post.post_id, news_post.post_title, news_post.category,news_post.date, post_category.category_name,news_post.category ,news_post.post_Uploadimg FROM news_post 
     LEFT JOIN post_category ON news_post.category =post_category.category_id
      ORDER BY news_post.post_id DESC LIMIT {$limit}";
     $result = mysqli_query($conn, $sql) or die("Query Failed: Recenr Post");
 
     if (mysqli_num_rows($result) > 0) {
         while ($row = mysqli_fetch_assoc($result)) {
 
 
    
    
    ?>
    <div class="recent-post">
    <a href="single.php?id=<?php echo $row['post_id']; ?>"> 
    <img src="../admin/Post UploadImg/<?php echo $row['post_Uploadimg']; ?>" alt="" width="100px" height="100px">
                    </a>
        <div class="post-content">
            <h5>
        <a href="single.php?id=<?php echo $row['post_id'] ?>" class="post-title"><?php echo $row['post_title'] ?></a></h5>
            <span>
                        <i class="fa-solid fa-tag"></i><a href='Category.php?category_id=<?php echo $row['category']; ?>'><?php echo $row['category_name']; ?></a>
                    </span>
                   
                        <i class="fa-solid fa-calendar-days"></i><a href="#time"><?php echo $row['date']; ?></a>
                    </span>
                 <div>
                    <a href='single.php?id=<?php echo $row['post_id']; ?>'>Read More</a>
                    </div>
                  
        </div>
    </div>
</div>
<?php
         }} else{
            echo "not Found";
         }

?>
</div>