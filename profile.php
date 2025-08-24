<?php
include("classes/autoload.php");





$loginn = new login;
$user_data = $loginn->check_login($_SESSION['sid']);





$User_data = $user_data;





if (isset($_GET['id'])) 
{
    $profile = new profile;
    $profile_data = $profile->get_profile($_GET['id']);
    
    if (is_array($profile_data)) {                                              
        
        $user_data = $profile_data[0];
    }
}





$post = new post();
$id = $user_data['user_id'];
$posts = $post->get_post($id);





$user = new user_error();
$friends = $user->get_friends($id);





$image_class = new image;
$image = " imgs/user_male.jpg";

if ($user_data['gender'] == "Female") {
    $image = "imgs/user_female.jpg";
}

if (file_exists($user_data['profile_image'])) {                        
    $image = $user_data['profile_image'];
}





$image1 = "imgs/cover_img.jpg";

if (file_exists($user_data['cover_image'])) {
    $image1 = $image_class->get_thumb_cover($user_data['cover_image']);
}





$corner_image = "imgs/user_male.jpg";

if ($User_data['gender'] == "Female") {

    $corner_image = "imgs/user_female.jpg";
}

if (file_exists($User_data['profile_image'])) {                                           

    $corner_image = $image_class->get_thumb_profile($User_data['profile_image']);
}





$mylikes = '(' . $user_data['likes'] . ')';





if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post = new post;
    $id = $_SESSION['sid'];

  
    $result = $post->create_post($id, $_POST, $_FILES);



    
    if ($result == "") {
        header("Location: profile.php");
        die;
    } else {
        echo "<div style = 'text-align:center; background-color:grey;'>";
        echo "<br>the fallowing errors occured: <br><br>";
        echo $result;
        echo "</div>";
    }
}
?>








<!------------------------------------------------------------------------------------------------------HTML-------------------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile page</title>
</head>


<body style="font-family: tahoma; background-color: #d0d8e4;">

    <br>
    <div>
        
        <div id="blue_bar">

            
            <div style="margin: auto; width: 800px; font_size: 30px; color: white;">

                <a href="timeline.php" style="color: white; text-decoration: none;"> MYBOOK &nbsp </a>

                <input type="text" id="serch_box" placeholder="serch for people">
                <img src="<?php echo $corner_image ?>" style="width: 50px; float: right;">                                 

                <a href="logout.php">
                    <div style="float: right; color: white; padding: 4px;"> logout</div>
                </a>

            </div>
        </div>
    </div>    
    <br>




        
        <div id="" style="width: 800px; margin: auto; min-height: 400px;">
            
            <div style="background-color: white; text-color: #405d9b; text-align: center;">
                
                
                <img src="<?php echo $image1 ?>" style="width: 100%;">   
                                                              
                <img class="profile_pic" src="<?php echo $image ?>">                                                          
                <br>
                
                <a href="profile_img.php?change=cover" style="text-decoration: none;"> change cover </a> &nbsp &nbsp
                &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                <a href="profile_img.php?change=profile" style="text-decoration: none;"> change profile </a>
                
                <div style="font-size: 20px; color: #405d9b;"><br>
                <?php echo $user_data['first_name'] . ' ' . $user_data['last_name'] ?>
            </div>
            <br><br>
            
            
            <div id="menu_buttons"> <a href="index.php" style="text-decoration: none;"> Timeline </a> </div>
            <div id="menu_buttons"> About </div>
            <div id="menu_buttons"> Friends </div>
            <div id="menu_buttons"> Photo </div>
            <div id="menu_buttons"> Setting </div>
            
            <a href = "like.php?type=user&id=<?php echo $user_data['user_id']?>"> <input id = "like_button" type = "button" value = "Followers<?php echo $mylikes ?>" > </a>

            </div>




            
            <div style="display: flex;">




                
                <div style="min-height: 400px; flex: 1;">

                    <div id="friends_bar">

                        Friends

                        <div id="friends">

                            <?php
                            if ($friends) {
                                foreach ($friends as $friends_row) {                                      
                            
                                    include("friends_display.php");
                                    echo "<br>";
                                    echo "<br>";
                                }
                            }
                            ?>

                        </div>

                    </div>

                </div>




                
                <div style="min-height: 400px; flex: 2.5; padding: 20px; padding-right: 0px;">

                    <div style="border: solid thin #aaa; padding: 10px; background-color: white;">

                        <form method="post" enctype="multipart/form-data">
                            <textarea name="post" placeholder="what's on your mind"></textarea>
                            <input type="file" name="file">
                            <input id="post_button" type="submit" value="Post">
                            <br>
                        </form>

                    </div>




                   
                    <div id="post_bar">

                        <div id="post">
                            <?php
                            if ($posts) {
                                foreach ($posts as $posts_row) {
                                    $user = new user_error;
                                    $user_row = $user->get_data($posts_row['user_id']);

                                    include("post_display.php");
                                    echo "<br>";
                                    echo "<br>";
                                    echo "<br>";
                                    echo "<br>";
                                    echo "<br>";
                                    echo "<br>";
                                    echo "<br>";
                                    echo "<br>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div>
                </div>

</body>

</html>








<style>
    .profile_pic {
        width: 150px;
        margin-top: -200px;
        border-radius: 50%;

    }

    #blue_bar {
        height: 50px;
        background-color: #405d9b;
        color: #d9dfeb;
    }

    #serch_box {
        width: 400px;
        height: 20px;
        border-radius: 5px;
        border: none;
        padding: 4px;
        font-size: 14px;
        background-image: url('search.png');
        background-repeat: no-repeat;
        background-position: right;
    }

    #menu_buttons {
        width: 100px;
        display: inline-block;
        margin: 2px;
        color: #405d9b;
    }

    #friends_img {
        width: 75px;
        float: left;
        margin: 8px;
        border-radius: 50%;
    }

    #friends_bar {
        background-color: white;
        min-height: 400px;
        margin-top: 20px;
        color: #aaa;
        padding: 16px;
        display: flex;
        flex-direction: column;
        align-items: start;

    }

    #friends {
        display: block;
        font-size: 12px;
        font-weight: bold;
        color: #405d9b;
    }

    textarea {

        width: 100%;
        border: none;
        font-family: tahoma;
        font-size: 14px;
        height: 60px;
    }

    #post_button {
        float: right;
        background-color: #405d9b;
        border: none;
        color: white;
        padding: 4px;
        font-size: 14px;
        border-radius: 2px;
        width: 50px;
    }

    #like_button {
        float: right;
        background-color: #9b409a;
        border: none;
        color: white;
        padding: 3px;
        border-radius: 2px;
        width: 80px;
    }

    #post_bar {
        margin-top: 20px;
        background-color: white;
        padding: 10px;
        min-width: 300px;
        display: flex;
    }

    #post {
        padding: 4px;
        font-size: 13px;
    }
</style>




<!-- // check if user is logged in

$loginn = new login;
$user_data = $loginn->check_login($_SESSION['session_id']); -->




<!-- // check if user is logged in

if (isset($_SESSION['session_id']) && is_numeric($_SESSION['session_id'])) {
    $id = $_SESSION['session_id'];
    $loginn = new login;
    $result = $loginn->check_login($id);

    if ($result) {
        $user = new user_error();
        $user_data = $user->get_data($id);

        if (!$user_data) {
            header("Location: login.php");
            die;
        }
    } else {
        header("Location: login.php");
        die;
    }
} else {
    header("Location: login.php");
    die;
} -->




<!-- Watch pt 72, 73 all are theory videos -->




<!-- The magis of index.php pt 75 -->