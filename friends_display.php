<?php

$image = " imgs/user_male.jpg";

if ($friends_row['gender'] == "Female") {
    $image = "imgs/user_female.jpg";
}

if (file_exists($friends_row['profile_image'])) {
    $image = $friends_row['profile_image'];
}
?>




<a href = "profile.php?id=<?php  echo $friends_row['user_id']?>" > <img id = "friends_img" src="<?php echo $image ?>" style = "margin-top: 21px;">
<br>

<div style = "padding-left: 15px;">
<?php echo $friends_row['first_name'] . " " . $friends_row['last_name'] ?>
</div>

</a>