<?php

$image_class = new image;
$image = " imgs/user_male.jpg";

if ($user_data['gender'] == "Female") {
    $image = "imgs/user_female.jpg";
}

if (file_exists($user_data['profile_image'])) {                        
    $image = $user_data['profile_image'];
}

?>




<div>
    <img src="<?php echo $image ?>" style="width: 75px; margin-right: 4px; border-radius:50%;">

    <div style="font-weight: bold; color: #405d9b; float: right; width: 420px; margin-top: 20px;">
        <?php echo $user_row['first_name'] . " " . $user_row['last_name'];

        if ($posts_row['is_profile_image']) {

            $pronoun = "his";
            if ($user_row['gender'] == "female") {
                $pronoun = "her";
            }
            echo "<span style = 'font-weight: normal; color: grey;'> updated $pronoun profile image </span";
        }

        if ($posts_row['is_cover_image']) {
            $pronoun = "his";
            if ($user_row['gender'] == "female") {
                $pronoun = "her";
            }
            echo "<span style = 'font-weight: normal; color: grey;'> updated $pronoun cover image</span>";
        }

        ?>

    </div>
    <br><br>

</div>


<div style="width: 420px; margin-left: 105px;">

    <div>
        <?php echo htmlspecialchars($posts_row['post']) ?>                               
    </div>

    <br>

    <div>


        
        <?php

        if (file_exists($posts_row['image'])) {

            $post_image = $image_class-> get_thumb_cover($posts_row['image']);
            echo " <img src = '$post_image' style = 'width: 80%;'/>";
        }


        
        $likes = " ";

        if ($posts_row['likes'] > 0) {

            $likes = "(" . $posts_row['likes'] . ")";
        } else {

            $likes = " ";
        }
        ?>
    </div><br>

    <div>

        <a href="like.php?type=post&id=<?php echo $posts_row['post_id'] ?>" style="text-decoration: none;">Like

            <?php echo $likes ?> </a> . <a href="" style="text-decoration: none;"> Comment<a> . <span style='color: #999;'> <?php echo $user_row['time'] ?> </span>


        
        <?php
        $post = new post();

        
        if ($post->i_own_post($posts_row['post_id'], $_SESSION['sid'])) {

            echo " <a href = 'edit.php?id=$posts_row[post_id]' style = 'float: right; text-decoration: none;' > &nbsp Edit </a> <a href = 'delete.php?id=$posts_row[post_id] ' style = 'float: right; text-decoration: none;'> Delete .<a>  ";
        }
        ?>


        
        <div style="color: grey;">

            <?php

            
            $i_liked = false;

            if (isset($_SESSION['sid'])) {

                $querry = "select likes from likes where type = 'post' && content_id = '$posts_row[post_id]' limit 1";
                $db = new database;
                $result = $db->read($querry);

                
                if (is_array($result)) {

                    $likes = json_decode($result[0]['likes'], true);                        
                                                                                                             

                    $user_ids = array_column($likes, 'user_id');

                    if (in_array($_SESSION['sid'], $user_ids)) {

                        $i_liked = true;
                    }
                }
            }

            
            if ($posts_row['likes'] > 0) {

                echo "<a href = 'who_like.php?type=post&id=$posts_row[post_id]' style = 'text-decoration: none; color: grey;' >";

                if ($posts_row['likes'] == 1) {

                    if ($i_liked) {

                        echo "You like this post";
                    } else {

                        echo "1 people like this post";
                    }

                } else {

                    if ($i_liked) {

                        $grammer = "others";
                        if($posts_row['likes'] - 1 == 1){             

                            $grammer = "other";
                            echo "You and " . $posts_row['likes'] - 1 . " " . $grammer . " like this post";

                        }else{

                            echo "You and " . $posts_row['likes'] - 1 . " " . $grammer . " like this post";
                        }

                    } else {

                        echo $posts_row['likes'] . "people like this post";
                    }
                }
            }
            ?>
        </div>

    </div>

</div>