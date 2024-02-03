<?php
include "header.php";

?>

<style>
    #single-container{
padding: 1vw 2vw;
    }
    #single-container .Posts{
width: 100%;
margin-top: 30px;
    }
    #single-container .Posts  p{
text-align: justify;
padding-bottom: 60px !important;
    }
    #single-container  .single-img img{
width: 100%;

object-fit: cover;


    }
    .add-new {
    color: #fff;
   
    border-radius: 10px;
    text-decoration: none;
   padding: 10px 20px;
   color: rgb(238, 229, 229); 
   background-color: rgb(0, 49, 244);
 }
    @media (max-width:475px) {
     
        #single-container .Posts{
width: 100%;
margin-top: 10px;
    }
    #single-container .Posts  p{
text-align: justify;
padding-bottom: 60px !important;
    }
    #single-container  .single-img img{
width: 100%;
height: 50vh;
object-fit: cover;


    }
}
</style>
<body>

    <div class="single-container" id="single-container">
    <?php 
     include "database.php";
    $post_id = $_GET['id'];
          $sql = "SELECT news_post.post_id, news_post.post_title, news_post.post_description, news_post.category,news_post.author, news_post.date, post_category.category_name, add_user.username, news_post.category ,news_post.post_Uploadimg FROM news_post 
    LEFT JOIN post_category ON news_post.category =post_category.category_id
    LEFT JOIN add_user ON news_post.author = add_user.user_id 
    WHERE news_post.post_id = {$post_id}";

     $result =mysqli_query($conn,$sql) or die("Query Failed");
     if(mysqli_num_rows($result)>0){
        while($row= mysqli_fetch_assoc($result)){
        
    ?>
        <div class="Posts">
            <div class="single-img">
            <img src="../admin/Post UploadImg/<?php  echo $row['post_Uploadimg'];?>" alt="">
 <h3>
 <?php  echo $row['post_title']?>
 </h3>
 <p>
 <?php  echo $row['post_description'];?>
 </p>
 <a href="#" class="add-new">Read Next</a>
            </div>

        </div>
       
 <?php } }
 else{
    echo "<h2>No Record Found. </h2>";
 } ?>
    </div>
    


    
    <?php
   
    include 'footer.php';
    
    ?>
