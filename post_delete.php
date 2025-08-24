<?php


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

    <div style="font-weight: bold; color: #405d9b; float: right; width: 660px; margin-top: 10px;">
        <?php echo $one_user_row['first_name'] . " " . $one_user_row['last_name']; ?>
    </div>

</div>


<div style="width: 420px; margin-left: 105px;">
    <div>
        <?php echo htmlspecialchars($one_posts_row['post']) ?>         
    </div> <br>


    <div>
        <?php

        if (file_exists($one_posts_row['image'])) {

            $post_image = $one_posts_row['image'];
            echo " <img src = '$post_image' style = 'width: 80%;'/>";
        }
        ?>
    </div>