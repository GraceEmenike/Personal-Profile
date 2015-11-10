<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Register Profile</title>
        <link rel="stylesheet" type="text/css" href="cssFiles/myProfile.css" />
    </head>
    <body>
        <?php
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
        $dFullname = $dLastname . " " . $dFirstName;
        $dUsername = $details['Username'];
        $dPassword = $details['Password'];
        $dPwrdrcvryqtn = $details['PwrdRcvryQtn'];
        $dAns = $details['RcvryAns'];
        $dAge = $details['Age'];
        $dCompanyName = $details['CompanyName'];
        $dGender = $details['Gender'];
        $dEmail = $details['Email'];
        $dAddress = $details['Address'];
        $dPhone = $details['Phone'];
        $dPassport = $details['Passport'];
        $dPosition = $details['Position'];
        $dAboutYourself = $details['AboutYourself'];
        ?>
        <?php

        function getImageExtension($imagetype) {
            if (empty($imagetype)) {
                return false;
            }
            switch ($imagetype) {
                case 'image/bmp': return ".bmp";
                case 'image/gif': return ".bmp";
                case 'image/jpeg': return ".jpeg";
                case 'image/png': return ".png";
                case 'image/jpg': return ".jpg";
                default : return false;
            }
        }

        $clickFlag = "";
        $NoFileError = "";

        function process_image() {
            global $target_path;
            global $clickFlag;
            global $con;
            global $dUsername;
            global $dFullname;
            $clickFlag = "You did not upload any file";
            if (isset($_FILES["passport"]["name"])) {
                $file_name = $_FILES["passport"]["name"];
                if ($_FILES["passport"]["error"] > 0) {
                    echo "Error in the following file " . $file_name . ":" . $_FILES["passport"]["error"] . "<br />";
                } elseif ($_FILES["passport"]["error"] <= 0) {
                    $temp_name = $_FILES["passport"]["tmp_name"];
                    $imgtype = $_FILES["passport"]["type"];
                    $ext = getImageExtension($imgtype);
                    $imgname = $dFullname . $ext;
                    $target_path = "upload/" . $imgname;
                    $insert_picture = "UPDATE user_profile SET Passport = '" . mysqli_escape_string($con, $target_path) . "' WHERE Username = '$dUsername'";
                    if (!mysqli_query($con, $insert_picture)) {
                        echo mysqli_error($con);
                    }
                    if (move_uploaded_file($temp_name, $target_path)) {
                        return true;
                    }
                } else {
                    return false;
                }
            } else {
                global $NoFileError;
                $NoFileError = "You did not upload any file";
            }
        }
        ?>
        <?php
        $ln = filter_input(INPUT_POST, "last_name");
        $fn = filter_input(INPUT_POST, "first_name");
        $genUsername = filter_input(INPUT_POST, "username"); //check that it's also small letters in the form
        $password = filter_input(INPUT_POST, "password");
        $pwrdrcvryqtn = filter_input(INPUT_POST, "pRecoveryQuestion");
        $ans = filter_input(INPUT_POST, "ans");
        $ag = filter_input(INPUT_POST, "age");
        $cn = filter_input(INPUT_POST, "company_name");
        $gdr = filter_input(INPUT_POST, "gender");
        $ptn = filter_input(INPUT_POST, "position");
        $email = filter_input(INPUT_POST, "email");
        $address = filter_input(INPUT_POST, "address");
        $employed = filter_input(INPUT_POST, "employed");
        $phone = filter_input(INPUT_POST, "phone");
        $about = filter_input(INPUT_POST, "profile_information");
        $date = date("y-m-d");

        $emp = "selected = 'No'";
        ?>
        <!--<h2 style="color: red"><?= $ln ?></h2>-->
        <?php
        $update = "";
        if ($ln || $ag || ($genUsername && $password) || $fn || $cn || $ptn || $gdr || $about) {
            if ($_FILES["passport"]["name"]) {
                if (process_image()) {
                    $update = "Your Profile Registration is complete.<br/>";
                    $insert_details = "UPDATE user_profile SET LastName = '$ln', FirstName = '$fn', Username = '$genUsername', Password = '$password', PwrdRcvryQtn = '$pwrdrcvryqtn', RcvryAns = '$ans', Age = '$ag', CompanyName = '$cn', Gender = '$gdr', Position = '$ptn', Email = '$email', Address = '$address', Employed = '$employed', Phone = '$phone', AboutYourself = '" . mysqli_escape_string($con, $about) . "', Date = '$date' "
                            . "WHERE Username = '$username'";
                    if (!mysqli_query($con, $insert_details)) {
                        echo mysqli_error($con);
                        $update = "Details didn't successfully upload to Database";
                    }
                    mysqli_close($con);
                } else {
                    $update = "Sorry, something went wrong with update, please try again";
                }
            } else {
                $NoFileError = "You did not upload any file";
            }
        } else {
            $NoFileError = "Please input your username and password";
        }
        ?>
        <div class="container">
            <div class="inner">
                <h1 style="margin-left: auto; margin-right: auto; width: 50%; color: #FC0;">Edit Profile</h1>
                <p><?= $update ?></p>
                <p style="margin-left: auto; margin-right: auto; width: 60%; color: #fa8787; size: 14px"><?= $NoFileError ?></p>
                <div class="left">
                    <form action="myProfileEdit.php" method="post" enctype="multipart/form-data">
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
                                <td>Username:</td>
                                <td><input type="text" name="username" value="<?= $dUsername ?>"/></td>
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
                                <td>Gender:</td>
                                <td>
                                    <table>
                                        <tr><td><input type="radio" name="gender" value="Male"/>Male</td></tr>
                                        <tr><td><input type="radio" name="gender" value="Female"/>Female</td></tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>Address:</td>
                                <td><textarea name="address"><?= $dAddress ?></textarea></td>
                            </tr>
                            <tr>
                                <td>Employed?</td>
                                <td>
                                    <select name="employed">
                                        <option value="Yes" >Yes</option>
                                        <option value="No" <?php echo $emp ?> >No</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Company Name:</td>
                                <td><input type="text" name="company_name" value="<?= $dCompanyName ?>" /></td>
                            </tr>
                            <tr><td>Position:</td>
                                <td><input type="text" name="position" value="<?= $dPosition ?>"</td>
                            </tr>
                            <tr><td>Email:</td>
                                <td><input type="text" name="email" value="<?= $dEmail ?>"</td>
                            </tr>
                            <tr>
                                <td><label for="passport">Change Passport</label></td>
                                <td><input type="file" name="passport"/></td>
                            </tr>
                            <tr>
                                <td>Password Recovery Question:</td>
                                <td>
                                    <select name="pRecoveryQuestion">
                                        <option value="1"/>What is your favorite food</option>
                                        <option value="2"/>What is your Mother's maiden name</option>
                                        <option value="3"/>What is your favorite color</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Answer:</td>
                                <td>
                                    <input name="ans" type="text" value="<?= $dAns ?>" />
                                </td>
                            </tr>
                            <tr><td>Phone:</td>
                                <td><input type="text" name="phone" value="<?= $dPhone ?>"</td>
                            </tr>
                            <tr>
                                <td>Professional Summary:</td>
                                <td><textarea rows="5" cols="20" name="profile_information" ><?= $dAboutYourself ?></textarea></td>
                            </tr>
                            <tr>
                                <td><input type="Submit" value="Save Changes" /></td>
                            </tr>
                        </table>
                    </form>
                    <div>
                        <p><?= $update ?></p>
                    </div>
                </div>
                <!--                <div class="right">
                                    <img src="<?= $dPassport ?>" width="200" height="200" />
                                </div>-->
            </div>
        </div>
    </body>
</html>
