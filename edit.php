<?php
include("classes/autoload.php");





$loginn = new login;
$user_data = $loginn->check_login($_SESSION['sid']);





$error = "";
if(isset($_GET['id'])){

    $post = new post;
    $one_posts_row = $post-> get_one_post($_GET['id']);

    if(!$one_posts_row){

        $error = "no such post was found";
    }else{

        if($one_posts_row['user_id'] != $_SESSION['sid']){

            $error = "you can't edit this post >:(";
        }
    }
}





$corner_image = "imgs/user_male.jpg";

if ($user_data['gender'] == "Female") {
    $corner_image = "imgs/user_female.jpg";
}

if (file_exists($user_data['profile_image'])) {                                                                    

    $image_class = new image;
    $corner_image = $image_class->get_thumb_profile($user_data['profile_image']);
}




if (isset($_SERVER["HTTP_REFERER"])    &&    !strstr($_SERVER["HTTP_REFERER"] , "edit.php")){            

    $_SESSION['return_to'] = $_SERVER["HTTP_REFERER"];
}





if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $post = new post;
    $post-> edit_post($_POST , $_GET['id'], $_FILES);

    header("Location: " . $_SESSION['return_to']);
    die;
}
?>








<!------------------------------------------------------------------------------------------------------HTML-------------------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete page</title>
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
                    
                <form method="POST"  enctype="multipart/form-data">
                     
                    <?php  

                        if($error != ""){

                            echo $error;
                        }else{
                            
                            echo "<h2> Delete Post </h2>";

                            echo "<hr>";
                            
                            echo "Are you sure you want to edit this post ??<br><br>";

                            
                            echo ' <textarea name="post" >' . $one_posts_row['post'] . '</textarea>
                                    <input type="file" name="file">';
                        
                            echo "<hr>";
                            echo "<br>";

                            echo "<input type = 'hidden' name = 'post_id' value = '$one_posts_row[user_id]'>";
                            echo "<input id='post_button' type='submit' value='Save'>";

                           
                            if (file_exists($one_posts_row['image'])) {

                                $image_class = new image;

                                $post_image = $image_class-> get_thumb_cover($one_posts_row['image']);
                                echo " <img src = '$post_image' style = 'width: 80%;'/>";
                            }
                        }
                    ?> <br>
                </form>
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