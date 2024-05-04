<?php 
include ("../database/database.php");

if(isset($_POST['submit'])){
  if(isset($_POST['comment']) && isset($_SESSION['v_id'])){
    $v_id = $_SESSION['v_id'];

    $comment = mysqli_real_escape_string($conn,$_POST['comment']);
    $sql="INSERT INTO `post_comment`(`v_id`, `post_id`, `comment`, `comment_date`,  `status`) VALUES ('$v_id',$post_id,'$comment',NOW(),'1')";
    $result = mysqli_query($conn,$sql);
    if(!$result){
        die("Query Failed: " . mysqli_error($conn));
    } else {
        echo "<script>alert('Comment successfully')</script>";
    }
  }
}
// time function
function time_ago($timestamp){
    $time_ago =strtotime($timestamp);
    $current_time = time();
    $time_difference = $current_time - $time_ago;
    $seconds = $time_difference;
    $minutes = round($seconds / 60);
    $hours = round($seconds / 3600);
    $days = round($seconds / 86400);
    $weeks = round($seconds / 604800);
    $months = round($seconds / 2629440);
    $years = round($seconds / 31553280);
    if($seconds <=60){
        return 'just now';
    }
    else if($seconds<=60){
        if($minutes==1){
            return "1"." minutes_ago";
        }
        else{
            return "$minutes"." minutes_ago";
        }
    }
    else if($hours<=24){
        if($hours==1){
            return "1"." hour_ago";
        }
        else{
            return "$hours"." hours_ago";
        }
    }
    else if($days<=7){
        if($days==1){
            return "1"." day_ago";
        }
        else{
            return "$days"." days_ago";
        }
    }
    else if($weeks<=4.3){
        if($weeks==1){
            return "1"." week_ago";
        }
        else{
            return "$weeks"." weeks_ago";
        }
    }
    else if($months<=12){
        if($months==1){
            return "1"." month_ago";
        }
        else{
            return "$months"." months_ago";
        }
    }
    else{
        if($years==1){
            return "1"." year_ago";
        }
        else{
            return "$years"." years_ago";
        }
    }
}

?>
<style>
   
    .comment .post-comment .list{
        margin-top: 10px;
        background: #fff;
        border-radius: 6px;
        box-shadow: 0 2px 2px #000;
    }
    .comment-session{
        width: 650px;
        height: auto;
        margin: 0 auto;
    }
    .post-comment .list{
        width: 100%;
        margin-bottom: 5px;
        
    }
   .post-comment .list .user{
    display: flex;
    padding: 8px;
    overflow: hidden;
   }
   .post-comment .user-letter{
        height: 38px;
        width: 38px;
        margin-right: 10px;
        border-radius: 100%;
        padding: 10px;
        background-color: skyblue;
        text-transform: uppercase;
        color: white;
        font-size: 20px;
        align-items: center;

    }
    .comment-session .name{
        text-transform: uppercase;
        font-weight: 500;
    }
    .post-comment .list .day{
        font-size:12px ;
    }
    .post-comment .comment-post{
        padding: 0 0 15px 58px;
    }
    /* coment box */
    .comment-box{
        padding: 10px;
        overflow: hidden;
    }
    .comment-box .user{
        display: flex;
        
    }
    .comment-box .image img{
        width: 24px;
        height: 24px;
        margin-right: 10px;
        border-radius: 50%;
    }

   .add_container label{
     display: block;
     margin-bottom: 5px;
     text-transform: uppercase;
 }
   .add_container input[type="text"],input[type="email"],textarea{
     width: 100%;
     height: 10%;
     margin: 10px;
     padding: 10px;
     border-radius: 10px;
     box-sizing: border-box;
     border:1px solid;
     font-size: 15px;
 }
 textarea{
     height: 150px;
     resize: none;
 }
    .btn{
        float: right;
        padding: 6px 10px;
        border: none;
        background:rgb(4, 176, 234);
        color: #fff;
        border-radius: 3px;
    }
    @media screen and(max-width:465px){
        .comment-session{
            width: 50%;
        }
    }
</style>

<?php if (isset($_SESSION['v_id']) && $_SESSION['loggedin'] = true) { ?>
<div class="comment-session">
        <form action="" method="POST">
            <input type="hidden" name="post_id" value="<?php echo $row['$post_id'] ?>">
            <input type="hidden" name="v_id" value="<?php echo $row['$v_id'] ?>">
            <!-- <div class="input-box">
                <label>Username</label>
            <input type="text" name="username">  
</div> -->
            <!-- <div class="input-box ">
                <label for="">Email</label>
            <input type="email" name= "email">
            </div> -->
            <textarea name="comment" id="" cols="30" rows="10" placeholder="write comment......">
            </textarea>
            <input type="submit" name="submit" class="btn" value="Comment">
        </form>
        <!-- comment display part system -->
        <div class="post-comment">
           
    <?php 
    
    $sql = "SELECT post_comment.comment,post_comment.comment_date,post_comment.comment_reply,visitor.username  FROM post_comment
    LEFT JOIN visitor ON post_comment.v_id = visitor.v_id
     WHERE post_id = $post_id AND  status =0 ";
    $result = mysqli_query($conn, $sql) or die("Query Failed");

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $timestamp = $row['comment_date']; 
    ?>
    <div class="list">
        <div class="user">
            <div class="user-letter">
                <?php echo substr($row['username'], 0, 1);?>
            </div>
            <div class="user-meta">
                <div class="name">
                    <?php echo $row['username']; ?>
                </div>
                <div class="day">
                    <?php echo time_ago($timestamp); ?>
                </div>
            </div>
        </div>
        <div class="comment-post">
            <?php echo $row['comment']; ?>
        </div>
        
        <?php }}}else{
    echo"<button ><a href='Login.php'>Comment</a></button>";
} ?>
    </div>
 
</div>
