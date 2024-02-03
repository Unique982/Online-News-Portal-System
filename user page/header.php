 <?php
// Dynamic Website Title Code Here.....//

?>  



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title><?php echo "Unique Online Update" ?></title>
    <link rel="stylesheet" href="style.css">
    <!-- <link rel="stylesheet" href="../admincss/style.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppines', "Helvetica Neue", Helvetica, ;

    }

    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: blue;
        color: #ffffff;

    }

    .logo {
        font-size: 24px;
        margin: 20px;
    }

    .menu ul {
        display: flex;
    }
    .menu ul li a.active{
        
    
 
    background:orange;
}
    .menu li {
        list-style: none;
    }

    .menu li a {
        text-decoration: none;
        color: white;
        padding: 16px;
        display: block;
        font-size: 24px;
    }

    .menu li:hover {
        background-color: orange;
    }

    .toogle {
        position: absolute;
        top: 16px;
        right: 16px;
        display: none;
        font-size: 25px;
        border: solid blue;
        border-radius: 20%;
    }

    @media (max-width:480px) {
        .toogle {
            display: block;

        }

        .menu {
            display: none;
            width: 100%;
        }

        .navbar {
            flex-direction: column;
            align-items: flex-start;
        }

        .menu ul {
            flex-direction: column;
            width: 100%;
            background-color: blue;
        }

        .menu ul li {
            align-items: center;

        }

        .menu ul li a {
            padding: 12px 16px;
        }

        .menu-active {
            display: flex;
        }
    }

    @media (max-width:768px) {
        .toogle {
            display: block;

        }

        .menu {
            display: none;
            width: 100%;
        }

        .navbar {
            flex-direction: column;
            align-items: flex-start;
        }

        .menu ul {
            flex-direction: column;
            width: 100%;
            background-color: blue;
        }

        .menu ul li {
            align-items: center;

        }

        .menu ul li a {
            padding: 12px 16px;
        }

        .menu-active {
            display: flex;
        }
    }
</style>

<body>
    <!-- Menu File -->
    <div class="navbar">
        <div class="logo">Unique Online Update</div>
        <i class="fa-solid fa-bars toogle"></i>
        <div class="menu">
            <?php
            include "database.php";
            if (isset($_GET['category_id'])) {
                $category_id = $_GET['category_id'];
            }
                   /* Select query  code  */
            $sql = "SELECT * FROM post_category WHERE category_post > 0";
            $result = mysqli_query($conn, $sql) or die("Query Failed.: Category");
            if (mysqli_num_rows($result) > 0) {
                $active = "";

            ?>
                <ul>

                    <li><a href="index.php">Home</a></li>
                    <?php while ($row = mysqli_fetch_array($result)) {
                        if (isset($_GET['category_id'])) {


                            if ($row['category_id'] == $category_id) {
                                $active = "active";
                            } else {
                                $active = "";
                            }
                        }
                        echo "<li><a class='{$active}' href='Category.php?category_id={$row['category_id']}'>{$row['category_name']}</a></li>";
                  
                    } ?>
             
                </ul>
            <?php } ?> <!--if condition close  -->
            
        </div>
    </div>
    </div>
    <!-- End menubar -->
    <!-- Script File -->
    <script>
        let toogle = document.querySelector(".toogle");
        let menu = document.querySelector(".menu");
        toogle.onclick = function() {
            menu.classList.toggle("active");
        }
    </script>
    <!-- End script file -->