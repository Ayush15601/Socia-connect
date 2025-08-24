<?php
include("classes/autoload.php");





$first_name = "";
$last_name = "";
$gender = "";
$email = "";

if(isset($_POST['first_name']) || isset($_POST['last_name']) || isset($_POST['gender']) || isset($_POST['email'])){                 

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
}
 




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $signup = new signup();
    $result = $signup->evaluate($_POST);

    if ($result != "") {
        echo "<div style = 'text-align:center; background-color:grey;' >";
        echo "<br>the fallowing errors occured: <br><br>";
        echo $result;
        echo "</div>";

    } else {

        
        header("Location: login.php");
        die;
    }
}
?>








<!------------------------------------------------------------------------------------------------------HTML-------------------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="en">


<head>                                                                                          
    <meta charset="UTF-8">                                                                      
    <title>MYBOOk | Signup-page page</title>
</head>


<body style = "font-family: tahoma; background-color: #d9dfeb;">

    <div class="one">
        &nbsp <div class="one-one"> mybook</div> &nbsp
        <div class="one-two"> <a href="login.php" style="text-decoration: none; color: white;"> Log in </a> </div>
    </div>

    <div class="white-box"> Login to my book<br><br>


        <form method='post' action = "<?php echo $_SERVER['PHP_SELF'] ?>" >                       

            <input name="first_name" value="<?php echo $first_name ?>" id="text" type="text"
                placeholder="first name" autocomplete = "off"><br><br>

            <input name="last_name" value="<?php echo $last_name ?>" id="text" type="text"
                placeholder="last name" autocomplete = "off"> <br><br>

            <span style="font-weight: normal;">GENDER:</span><br>
            <select name="gender" id="text">

                <option> <?php echo $gender ?> </option>
                <option> Male </option>
                <option> Female </option>

            </select><br><br>
            <input value="<?php echo $email ?>" name="email" id="text" type="text" placeholder="email"><br><br>
            <input name="password" id="text" type="password" placeholder="password"><br><br>
            <input name="password2" id="text" type="password" placeholder="retype-password"><br><br>
            <input id="button" type="submit" value="SIGN IN"><br><br><br>
            <div style="font-size: small">

                <a href="" style="text-decoration: none; color: #3c5a99;"> Forgotton account? </a> &nbsp; &nbsp; 
                <a href="login.php" style="text-decoration: none; color: black;"> Sign up for  myBook </a>

            </div><br><br>

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
        width: 60px;
        background-color: #42b72a;
        padding: 4px;
        text-align: center;
        border-radius: 4px;
        display: inline;
    }

    .white-box {
        background-color: white;
        width: 800px;
        height: 471px;
        padding: 10px;
        padding-top: 20px;
        margin: auto;
        margin-top: 20px;
        text-align: center;
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