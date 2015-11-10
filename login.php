<?php
$vari = filter_input(INPUT_COOKIE, "login");
echo $vari; // this variable isn't used
if (isset($vari)) {//if the user hasn't logged out
    setcookie("index", "in", time() + 60 * 60 * 24 * 30);
    header("location: myProfileEdit.php");
} else {
    $LoginMessage = "YOU HAVEN'T LOGGED IN YET"; // not used
}
$username = filter_input(INPUT_POST, "username");
$password = filter_input(INPUT_POST, "password");

//login trial report
$trial = "";

if (($username) || ($password)) {
    $con = mysqli_connect("localhost", "root", "", "vickprofile");
    if (!$con) {
        die('Could not connect: ' . mysqli_error($con));
    }

    $selected_details = "SELECT * FROM user_profile WHERE Username = '$username'";
    $result = mysqli_query($con, $selected_details);
    if (!$result) {
        echo mysqli_error($con);
    }
    $details = mysqli_fetch_array($result);

    $dusername = $details['Username'];
    $dpassword = $details['Password'];
    $fullname = $details['LastName'] . " " . $details['FirstName'];

    mysqli_close($con);

    if (($dusername === $username) && ($dpassword === $password)) {
        setcookie("user", $fullname, $expiretime);
        setcookie("username", $username, $expiretime);
        $expirelitime = time() + 60 * 60 * 2;
        setcookie("login", "loggedIn", $expirelitime);
        header("location: myProfileEdit.php");
    } else {
        $trial = "Your Username or Password is Incorrect!!";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login Index</title>
        <link rel="stylesheet" type="text/css" href="cssFiles/index.css" />
        <script type="text/javascript" src="jsFiles/index.js" ></script>
    </head>
    <body >
        <div class="container" id="outer" onmouseover="displaydiv()" onmouseout="hidediv()">
            <h1 style="font-family: verdana; text-align: center; color: #ffffff;">Welcome to mi Perfil Persona</h1>
            <div class="inner" id ="inner" >
<!--                <p><?= $LoginMessage ?></p>-->

                <form class="formdata" action="login.php" method="post" >
                    <p style="color: red"><?= $trial ?></p>
                    <p>Please Login with your correct details:</p>
                    <table style="padding: 1px;">
                        <tr>
                            <td>Username:</td>
                            <td><input type="text" name="username"  /></td>
                        </tr>
                        <tr>
                            <td>Password:</td>
                            <td><input type="password" name="password"/></td>
                        </tr>
                        <tr><td></td><td><input onclick="test()" style="color: black" type="submit" value="Login" />
                                <a><span style="font-family: arial;font-style: italic;font-size: 16px; color: red">Forgot Password</span></a>
                            </td></tr>
                        <tr><td colspan="2">
                                <p style="font-family: arial; font-style: italic; font-size: 16px;">Don't have a Profile?
                                    <a style="color: greenyellow" href="MyRegister.php">Register</a>
                                </p>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>
