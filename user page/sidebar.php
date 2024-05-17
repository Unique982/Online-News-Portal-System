<style>
    .recent-post{
        margin-top: 20px;
        background-color: #fefe;  
        width: 100%;
       
    }
    .recent-content{
        padding: 10px;
        
    }
    
    .recent  .tit {
        color: #333;
        text-decoration: none;
        display: block;
    }
    .recent_img {
    display: flex;
    
    align-items: center;
    padding: 10px;  
}
.recent_img img {
    margin-right: 10px;
    border: 4px solid;
}
 h5 a {
    text-decoration: none;
    color: #333;
    font-size: 18px;
   
}

</style>
<div class="recent">
        
        <h2 class="title">Search</h2>
<form action="search.php" method="GET" class="search-post">

<div class="input-box">
    <input type="text" name="search" placeholder="Search...">
    <button type="submit" class="btn">Search</button>
</div>
</form>

<div class="recent-post">
    
    <div class="recent-content">
        
<h2 class="title">Recent Post</h2>
<?php
    include "../database/database.php";
  $limit = 4;
    $sql2 = "SELECT news_post.post_id, news_post.post_title, news_post.category,news_post.date, post_category.category_name,news_post.category ,news_post.post_Uploadimg FROM news_post 
    LEFT JOIN post_category ON news_post.category =post_category.category_id
     ORDER BY news_post.post_id DESC LIMIT {$limit}";
    $result = mysqli_query($conn, $sql2) or die("Query Failed: Recenr Post");

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {


   
   
   ?>
   
 <div class="recent_img">
 <a href="single.php?id=<?php echo $row['post_id']; ?>"> 
<img src="../admin/Post UploadImg/<?php echo $row['post_Uploadimg']; ?>" alt="" width="100px" height="80px">
                </a>
  
   <h5><a href="single.php?id=<?php echo $row['post_id'] ?>" class="post-title"><?php echo $row['post_title'] ?></a></h5>
<hr>
</div>  

<?php
     }} else{
        echo "not Found";
     }

?>
</div></div>



</div>
    </div>
