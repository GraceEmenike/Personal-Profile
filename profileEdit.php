<?php
$expirelitime = time() * 60 * 60 * 24 * 30;
setcookie("login", "loggedIn", $expirelitime);
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Profile</title>
    </head>
    <body>
        <?php
        $usercookie = filter_input(INPUT_COOKIE, "user");

        echo "<h1>WELCOME " . $usercookie . "</h1>";

        $username = filter_input(INPUT_COOKIE, "username");

        $con = mysqli_connect("localhost", "root", "", "vickprofile");
        if (!$con) {
            die('Could not Connect:' . mysqli_error($con));
        }
        $selected_details = "SELECT * FROM user_profile WHERE Username = '$username'";
        $result = mysqli_query($con, $selected_details);

        if (!$result) {
            echo mysqli_error($con);
        }
        $details = mysqli_fetch_array($result);

        $dLastname = $details['LastName'];
        $dFirstName = $details['FirstName'];
        $dfullname = $dLastname . " " . $dFirstName;
        $dPassword = $details['Password'];
        $dAge = $details['Age'];
        $dCompanyName = $details['CompanyName'];
        $dGender = $details['Gender'];
        $dposition = $details['Position'];
        $dAboutYourself = $details['AboutYourself'];
        ?>

        <div>
            <table>
                <tr>
                    <td>
                        <img src="upload/edited.jpg" width="100" height="100" />
                    </td>
                </tr>
            </table>
        </div>
        <div>
            <form action="ProfileEdit.php" method="post" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>Last Name:</td>
                        <td><input type="text" name="last_name" value="<?= $dLastname ?>" /></td>
                    </tr>
                    <tr>
                        <td>First Name:</td>
                        <td><input type="text" name="first_name" value="<?= $dFirstName ?>"/></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="password" value="<?= $dPassword ?>"/></td>
                    </tr>
                    <tr>
                        <td>Age:</td>
                        <td><input type="text" name="age" value="<?= $dAge ?>" /></td>
                    </tr>
                    <tr>
                        <td>Company Name:</td>
                        <td><input type="text" name="company_name" value="<?= $dCompanyName ?>" /></td>
                    </tr>
                    <tr>
                        <td>Gender:</td>
                        <td>
                            <table>
                                <tr><td><input type="radio" name="gender" value="Male"/>Male</td></tr>
                                <tr><td><input type="radio" name="gender" value="Female"/>Female</td></tr>
                            </table>
                        </td>
                    </tr>
                    <tr><td>Position:</td>
                        <td><input type="text" name="position" value="<?= $dposition ?>"</td>
                    </tr>
                    <tr>
                        <td><label for="passport">Change Passport</label></td>
                        <td><input type="file" name="passport"/></td>

                        <?php
                        $passport_status = process_image();
                        ?>

                    </tr>
                    <tr>
                        <td>About Yourself:</td>
                        <td><textarea rows="5" cols="20" name="profile_information" ><?= $dAboutYourself ?></textarea></td>
                    </tr>
                    <tr>
                        <td><input type="Submit" value="Save Changes" /></td>
                    </tr>
                </table>
            </form>
        </div>

        <?php
        $ln = filter_input(INPUT_POST, "last_name");
        $ag = filter_input(INPUT_POST, "age");
        $genUsername = $ln . $ag;
        $password = filter_input(INPUT_POST, "password");
        $fn = filter_input(INPUT_POST, "first_name");

        $cn = filter_input(INPUT_POST, "company_name");
        $ptn = filter_input(INPUT_POST, "position");
        $gdr = filter_input(INPUT_POST, "gender");
        $about = filter_input(INPUT_POST, "profile_information");
        ?>
        <?php

        function process_image() {// call this function when the user clicks the submit button
            global $genUsername;
            echo $genUsername;
            if (isset($_FILES["passport"])) {
                if ($_FILES["passport"]["error"] > 0) {
                    echo "Error: " . $_FILES["passport"]["error"] . "<br />";
                } elseif ($_FILES["passport"]["error"] <= 0) {
                    $_FILES["passport"]["name"] = $genUsername;
                    move_uploaded_file($_FILES["passport"]["tmp_name"], "upload/" . $_FILES["passport"]["name"]); // variable needs to be initialized
                    return "Passport has been succesfully uploaded"; // The file change of name doesn't work
                } else {
                    return false;
                }
            }
        }
        ?>
        <div>
            <?php
            if (process_image()) {
                echo "Your Profile Update is complete.<br/>"// this means html can be in an echo tag
                . " Please note and use the generated Username in subsequent logins";
            }
            ?>
        </div>
        <?php
        $insert_details = "INSERT INTO user_profile (LastName, FirstName, Username, Password, Age, CompanyName, Gender, Position, AboutYourself)"
                . "VALUES ('$ln', '$fn', '$genUsername', '$password', '$ag', '$cn', '$gdr', '$ptn', '" . mysqli_escape_string($con, $about) . "')";
        if (!mysqli_query($con, $insert_details)) {
            echo mysqli_error($con);
        }
        mysqli_close($con);
        ?>

        <p><?php
            echo "Your generated Username is: " . $genUsername;
            ?>
        </p>

        <div>
            <a href="logout.php"><button>Logout</button></a>
        </div>


    </body>
</html>
