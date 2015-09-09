<?php
$vari = filter_input(INPUT_COOKIE, "login");
echo $vari;
if (filter_input(INPUT_COOKIE, "login")) {//is this line really working
    header("location: Profile.php");
} else {
    echo "YOU HAVEN'T LOGGED IN YET";
}

$username = filter_input(INPUT_POST, "username");

$password = filter_input(INPUT_POST, "password");
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


    if (($dusername === $username) && ($dpassword === $password)) {// how does the code get back here
        setcookie("user", $fullname, $expiretime); // I thought this part of the script is past when it is needed
        setcookie("username", $username, $expiretime);
        $expirelitime = time() * 60 * 60 * 24 * 30;
        setcookie("login", "loggedIn", $expirelitime);
        header("location: Profile.php"); // how does this header function work again
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login Index</title>
    </head>
    <body>
        <h1 style="font-family: verdana; text-align: center; color: #660066; ">Welcome to the Login Page</h1>
        <p style="font-family: verdana; text-align: center; size: 14px; color: #660033">Please Login with your correct details:</p>
        <form action="index.php" method="post" >
            <table>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username"  /></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password"/></td>
                </tr>
                <tr><td><input type="submit"</td></tr>
            </table>
        </form>
        <div>
            <p style="font-family: arial; font-style: italic; font-size: 11px">Don't have a Profile?
                <a href="register.php"><button>Register</button></a>
            </p>

        </div>
    </body>
</html>
