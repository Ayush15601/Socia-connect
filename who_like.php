<?php
include("classes/autoload.php");





$loginn = new login;
$user_data = $loginn->check_login($_SESSION['sid']);





$likes = false;

if (isset($_GET['id']) && isset($_GET['type'])) {

    $posts = new post;
    $likes = $posts->get_likes($_GET['id'], $_GET['type']);

} else {

    $likes = "No information";
}





$corner_image = "imgs/user_male.jpg";

if ($user_data['gender'] == "Female") {
    $corner_image = "imgs/user_female.jpg";
}

if (file_exists($user_data['profile_image'])) {                                                                      //  checks whether a file or directory exists.

    $image_class = new image;
    $corner_image = $image_class->get_thumb_profile($user_data['profile_image']);
}
?>








<!------------------------------------------------------------------------------------------------------HTML-------------------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Who like your post</title>
</head>


<body style="font-family: tahoma; background-color: #d0d8e4;">
    <br>

    
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


           
            <div style="min-height: 400px; flex: 2.1; padding: 20px; padding-right: 0px;">

                <div style="border: solid thin #aaa; padding: 10px; background-color: white;">


                    <?php
                    $user = new user_error;
                    $image_classs = new image;

                    if (is_array($likes)) {

                        foreach ($likes as $row) {

                            $friends_row = $user->get_user($row['user_id']);
                            include("friends_display.php");
                        }
                    }
                    ?>

                    <br style="clear: both;">

                </div>
            </div>
        <div>
    </div>   
         
</body>

</html>








<style>
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

    #friends_img {
        width: 75px;
        float: left;
        margin: 8px;

    }

    textarea {
        width: 100%;
        border: none;
        font-family: tahoma;
        font-size: 14px;
        height: 60px;
    }
</style>