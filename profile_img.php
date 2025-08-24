<?php
include("classes/autoload.php");





$loginn = new login;
$user_data = $loginn->check_login($_SESSION['sid']);




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





if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_FILES['file']['tmp_name']) && $_FILES['file']['tmp_name'] != "") {

        // check correct image uploaded
        // if ($_FILES['file']['type'] != "image/jpeg") {

        //     $allowed_size = (1024 * 1024) * 7;
        //     if ($_FILES['file']['size'] < $allowed_size) {


        
        $folder = "uploads/" . $user_data['user_id'] . "/";

        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);                                  
        }

        $img = new image;
        $filename = $folder . $img->generate_filename(15) . ".jpg";
        move_uploaded_file($_FILES['file']['tmp_name'], $filename);
        
        
        if(file_exists($filename)){

            isset($_GET['change']);

            if($_GET['change'] == "cover"){
                
                if(file_exists($user_data['cover_data'])){

                    unlink($user_data['cover_data']);                                          
                }

            }else{
                
                
                if(file_exists($user_data['profile_data'])){

                    unlink($user_data['profile_data']);
                }
            }
            
            if($_GET['change'] == "cover"){
                
                $img->resize_img($filename, $filename, 1500, 1500);
            }else{
                
                $img->resize_img($filename, $filename, 1500, 800);
            }
        }
            
            
            if (file_exists($filename)) {
                
                
                $ud = $user_data['user_id'];
                
                if($_GET['change'] == "cover"){
                    
                    $query = "update user set cover_image = '$filename' where user_id = '$ud' limit 1";
                    $_POST['is_cover_image'] = 1;
                }else{  
                    
                    $query = "update user set profile_image = '$filename' where user_id = '$ud' limit 1"; 
                    $_POST['is_profile_image'] = 1;  
                }
            
            $db = new database;
            $db->save($query);
            
            
            
            $post = new post;
            $post->create_post($ud, $_POST, $filename);

            header("Location: profile.php");
            die;
        }
        //     } else {
            //         echo "<div style = 'text-align:center; background-color:grey;'>";
            //         echo "<br>the fallowing errors occured: <br><br>";
            //         echo "max size 7 mb ";
        //         echo "</div>";
        //     }
        // } else {
            //     echo "<div style = 'text-align:center; background-color:grey;'>";
            //     echo "<br>the fallowing errors occured: <br><br>";
            //     echo "please add a valid image";
            //     echo "</div>";
            //     echo "<br>";
            
            //     echo "<pre>";
            //     print_r($_FILES);
            //     echo "</pre>";
        // }
    } else {
        echo "<div style = 'text-align:center; background-color:grey;'>";
        echo "<br>the fallowing errors occured: <br><br>";
        echo "please add a image";
        echo "</div>";
    }
}


// during viva check
// echo printr($_FILES);
// die;
?>








<!------------------------------------------------------------------------------------------------------HTML-------------------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change image </title>
</head>


<body style="font-family: tahoma; background-color: #d0d8e4;">
    <br>
    
    <div id="blue_bar">

        
        <div style="margin: auto; width: 800px; font_size: 30px; color: white;">
            MYBOOK &nbsp
            <input type="text" id="serch_box" placeholder="serch for people">

            <img src = "<?php echo $corner_image ?> " style="width: 50px; float: right;">                     

            
            <a href="profile.php">
                <div style="float: right; color: white; padding: 4px;"> back</div>
            </a>
            
        </div>
    </div><br>
    
    
    
    
    
    <div style="max-width: 800px; margin: auto; min-height: 60px; background-color: white; padding: 10px;">
        
      
        <form method="post" enctype = "multipart/form-data">                     
            
            <input id="post_button" type="submit" value="Post">
            <input id="browse_button" type="file" name = "file">
            <br>
            
        </form><br><br>

        
        
        <?php

            if(isset($_GET['change']))
                
            if($_GET['change'] == "cover"){ 
                
                echo " <img src = '$user_data[cover_image]' style = 'width: 800px; height: auto;'> ";
            }else{

                echo " <img src = '$user_data[profile_image]' style = 'width: 800px; height: auto;'> ";
            }
            ?>
        <div>

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

    #post_button {
        float: right;
        background-color: #405d9b;
        border: none;
        color: white;
        padding: 4px;
        font-size: 14px;
        border-radius: 2px;
        width: 70px;
    }
</style>