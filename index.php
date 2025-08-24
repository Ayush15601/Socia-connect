<?php
include("classes/autoload.php");





$loginn = new login;
$user_data = $loginn->check_login($_SESSION['sid']);





$post = new post();
$id = $_SESSION['sid'];
$posts = $post->get_post($id);





$image = " imgs/user_male.jpg";

if ($user_data['gender'] == "Female") {
    $image = "imgs/user_female.jpg";
}

if (file_exists($user_data['profile_image'])) {                            
    $image = $user_data['profile_image'];
}





$corner_image = "imgs/user_male.jpg";

if ($user_data['gender'] == "Female") {
    $corner_image = "imgs/user_female.jpg";
}

if (file_exists($user_data['profile_image'])) {                     

    $image_class = new image;
    $corner_image = $image_class-> get_thumb_profile($user_data['profile_image']);
}
?>








<!------------------------------------------------------------------------------------------------------HTML-------------------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index page</title>
</head>


<body style="font-family: tahoma; background-color: #d0d8e4;">
    <br>
    <
    <div id="blue_bar">

        
        <div style="margin: auto; width: 800px; font_size: 30px; color: white;">
            MYBOOK &nbsp
            <input type="text" id="serch_box" placeholder="serch for people">
            <img src="<?php echo $corner_image ?>" style="width: 50px; float: right;">

            <a href="profile.php">
                <div style="float: right; color: white; padding: 4px;"> back</div>
            </a>

        </div>
    </div><br>


    <div id="" style="width: 800px; margin: auto; min-height: 400px;">

        
        <div style="display: flex;">




            
            <div style="min-height: 400px; flex: 1.4;">

                <div id="friends_bar">

                    <img class="profile_pic" src="<?php echo $image ?>"><br>
                    <?php echo $user_data['first_name'] . ' ' . $user_data['last_name'] ?>
                </div>

            </div>




           
            <div style="min-height: 400px; flex: 2.1; padding: 20px; padding-right: 0px;">

                <div style="border: solid thin #aaa; padding: 10px; background-color: white;">

                    <form method="post">
                        <textarea name="post" placeholder="what's on your mind"></textarea>
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
</body>

</html>








<style>
    .profile_pic {

        width: 150px;
        border-radius: 50%;

    }

    #blue_bar {
        height: 50px;
        background-color: #405d9b;
        color: d9dfeb;
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
    }

    #friends_img {
        width: 75px;
        float: left;
        margin: 8px;

    }

    #friends_bar {
        min-height: 400px;
        margin-top: 20px;
        color: #405d9b;
        padding: 8px;
        text-align: center;
        font-size: 20px;
    }

    #friends {
        clear: both;
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

    #post_bar {
        margin-top: 20px;
        background-color: white;
        padding: 10px;
        min-width: 300px;
    }

    #post {
        padding: 4px;
        font-size: 13px;
        margin-bottom: 20px;
    }
</style>