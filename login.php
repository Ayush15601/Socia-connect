<?php
include("classes/autoload.php");





$query = "select * from user";

$db = new database;
$result = $db->read($query);

foreach ($result as $row) {                                                 
    $id = $row['id'];

    if (strlen($row['password']) != 40) {                            

        $password = hash("sha1", $row['password']);
        $query = "update user set password = '$password' where id  = '$id' ";
        $db->save($query);
    }
}






$email = "";
if (isset($_POST['email'])) {

    $email = $_POST['email'];
}




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $loginn = new login();
    $result = $loginn->evaluate($_POST);

    if ($result != "") {
        echo "<div style = 'text-align:center; background-color:grey;'>";
        echo "<br>the fallowing errors occured: <br><br>";
        echo $result;
        echo "</div>";

    } else {

        
        header("Location: profile.php");
        die;
    }
}
?>








<!------------------------------------------------------------------------------------------------------HTML-------------------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MYBOOk | login page</title>
</head>


<body style="font-family: tahoma; background-color: #d9dfeb;">

    <div class="one">
        &nbsp <div class="one-one"> myBook</div> &nbsp
        <a href="signup.php" style="text-decoration: none;">
            <div class="one-two"> sign up</div>
        </a>
    </div>

    <form method="post">

        <div class="white-box"> Login to my book<br><br>

            <input value="<?php echo $email ?>" name="email" value="<?php $email ?>" id="text" type="text"
                placeholder="email or phone number"><br><br>
            <input name="password" value="<?php $password ?>" id="text" type="password" placeholder="password"><br><br>
            <input id="button" type="submit" value="LOG IN"><br><br>

            <div class="fa">

                <a href="" style="text-decoration: none; color: #3c5a99;"> Forgotton account? </a> &nbsp &nbsp
                <a href="signup.php" style="text-decoration: none; color: #3c5a99;"> Sign up for myBook </a>
            </div>
    </form>
    </div>

</body>

</html>








<!-------------------------------------------------------------------------------------------------------CSS-------------------------------------------------------------------------------------------------->
<style>
    .one {
        height: 100px;
        background-color: #3c5a99;
    }

    .one-one {
        color: white;
        font-size: 55px;
        display: inline;
    }

    .one-two {
        background-color: #42b72a;
        color: white;
        display: inline;
        width: 60px;
        padding: 2px;
        border-radius: 4px;
    }

    .white-box {
        background-color: white;
        width: 800px;
        height: 250px;
        padding: 10px;
        padding-top: 40px;
        margin: auto;
        margin-top: 20px;
        text-align: center;
    }

    .fa {
        color: #3c5a99;
        font-size: small;
    }

    #text {
        height: 40px;
        width: 300px;
        border: solid 1px #ccc;
        border-radius: 2px;
    }

    #button {
        background-color: #3c5a99;
        color: white;
        width: 300px;
        height: 40px;
        font-weight: bold;
        border: none;
    }
</style>