<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8" >
        <title>Profile Registration</title>
    </head>
    <body >
        <h1 style="font-family: Verdana; text-align: center; color: #660066">User Profile</h1>
        <div>
            <p style="text-align:center;"> Please Enter the following details Correctly </p>
        </div>

        <div style="background-color: #ffffff">

            <form action="register.php" method="post" enctype="multipart/form-data" >
                <table>
                    <tr>
                        <td>Last Name:</td>
                        <td><input type="text" name="last_name" /></td>
                    </tr>
                    <tr>
                        <td>First Name:</td>
                        <td><input type="text" name="first_name"/></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="password"/></td>
                    </tr>
                    <tr>
                        <td>Age:</td>
                        <td><input type="text" name="age" /></td>
                    </tr>
                    <tr>
                        <td>Company Name:</td>
                        <td><input type="text" name="company_name"/></td>
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
                        <td><input type="text" name="position"</td>
                    </tr>
                    <tr>
                        <td><label for="passport">Passport</label></td>
                        <td><input type="file" name="passport" id="User_passport"/></td>

                        <?php
                        $passport_status = process_image();
                        ?>

                    </tr>
                    <tr>
                        <td>About Yourself:</td>
                        <td><textarea rows="5" cols="20" name="profile_information"></textarea></td>
                    </tr>
                    <tr>
                        <td><input type="Submit"</td>
                    </tr>
                </table>
            </form>

            <div>
                <p style="font-family: arial; font-style: italic; font-size: 11px;">Already have a profile?
                    <a href="logout.php"><button>Login</button></a>
                </p>
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
                if (isset($_FILES["passport"])) {
                    if ($_FILES["passport"]["error"] > 0) {
                        echo "Error: " . $_FILES["passport"]["error"] . "<br />";
                    } elseif ($_FILES["passport"]["error"] <= 0) {
                        move_uploaded_file($_FILES["passport"]["tmp_name"], "upload/" . $genUsername . $_FILES["passport"]["name"]); // variable needs to be initialized
                        return "Passport has been succesfully uploaded";
                    } else {
                        return false;
                    }
                }
            }
            ?>
            <div>
                <?php
                if (process_image()) {
                    echo "Your Profile Registration is complete.<br/>"
                    . " Pleasenote and use the generated Username in subsequent logins";
                    ?>
                    <a href="Profile.php" >Continue</a>
                    <?php
                }
                ?>
            </div>
            <?php
            $con = mysqli_connect("localhost", "root", "", "vickprofile");
            if (!$con) {
                die('Could not connect: ' . mysqli_error($con));
            }

            $insert_details = "INSERT INTO user_profile (LastName, FirstName, Username, Password, Age, CompanyName, Gender, Position, AboutYourself)"
                    . "VALUES ('$ln', '$fn', '$genUsername', '$password', '$ag', '$cn', '$gdr', '$ptn', '$about')";
            if (!mysqli_query($con, $insert_details)) {
                echo mysqli_error($con);
            }
            mysqli_close($con);
            ?>

            <p><?php
                echo "Your generated Username is: " . $genUsername;
                ?>
            </p>
        </div>
    </body>
</html>