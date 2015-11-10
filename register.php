
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
        <link rel="stylesheet" type="text/css" href="cssFiles/myProfile.css" />
    </head>
    <body>
        <?php
        $con = mysqli_connect("localhost", "root", "", "vickprofile");
        if (!$con) {
            die('Could not Connect:' . mysqli_error($con));
        }
        $dPassport;
        $dFullname;
        $dUsername;
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

        $insert_picture = "";
        $NoFileError = "";

        function process_image() {
            global $target_path;
            global $con;
            //global $dUsername;
            global $fn;
            global $ln;
            global $insert_picture;
            global $dPassport;
            if (isset($_FILES["passport"]["name"])) {
                $file_name = $_FILES["passport"]["name"];
                if ($_FILES["passport"]["error"] > 0) {
                    echo "Error in the following file " . $file_name . ":" . $_FILES["passport"]["error"] . "<br />";
                } elseif ($_FILES["passport"]["error"] <= 0) {
                    $temp_name = $_FILES["passport"]["tmp_name"];
                    $imgtype = $_FILES["passport"]["type"];
                    $ext = getImageExtension($imgtype);
                    $imgname = $ln . $fn . $ext;
                    $target_path = "upload/" . $imgname . "";
                    $insert_picture = "INSERT INTO user_profile (Passport)"
                            . " VALUES ('" . mysqli_real_escape_string($con, $target_path) . "')";
                    $dPassport = $target_path;
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
        $update = "";
        if ($ln || $ag || ($genUsername && $password) || $fn || $cn || $ptn || $gdr || $about) {
            if ($_FILES["passport"]["name"]) {
                if (process_image()) {// change this to an alert of something else
                    $update = "Your Profile Registration is complete.<br/><a href ='profile.php'>Continue</ a>";
//                    showPassport();
//                    $insert_details = "INSERT INTO user_profile (LastName, FirstName, Username, Password, PwrdRcvryQtn, RcvryAns, Age, CompanyName, Gender, Position, Email, Address, Employed, Phone, AboutYourself, Date )"
//                            . "VALUES ('$ln', '$fn', '$genUsername', '$password', '$pwrdrcvryqtn' '$ans', '$ag', '$cn', '$gdr', '$ptn', '$email', '$address', '$employed', '$phone', '" . mysqli_escape_string($con, $about) . "','$date')"
//                            . "WHERE Passport = ''";
                    $insert_details = "UPDATE user_profile SET LastName = '$ln', FirstName = '$fn', Username = '$genUsername', Password = '$password', PwrdRcvryQtn = '$pwrdrcvryqtn', RcvryAns = '$ans', Age = '$ag', CompanyName = '$cn', Gender = '$gdr', Position = '$ptn', Email = '$email', Address = '$address', Employed = '$employed', Phone = '$phone', AboutYourself = '" . mysqli_escape_string($con, $about) . "', Date = '$date' "
                            . "WHERE Passport = '" . mysqli_real_escape_string($con, $target_path) . "'";
                    if (!mysqli_query($con, $insert_details)) {
                        echo mysqli_error($con);
                        echo "Something went wrong with of upload";
                    }
                } else {
                    $update = "Sorry, something went wrong with registration, please try again";
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
                <h1 style="margin-left: auto; margin-right: auto; width: 60%">Registration Form</h1>
                <p style="margin-left: auto; margin-right: auto; width: 60%; color: #fa8787; size: 14px"><?= $NoFileError ?></p>
                <div class="left">
                    <form action="MyRegister.php" method="post" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td>Last Name:</td>
                                <td><input type="text" name="last_name"  /></td>
                            </tr>
                            <tr>
                                <td>First Name:</td>
                                <td><input type="text" name="first_name" /></td>
                            </tr>
                            <tr>
                                <td>Username:</td>
                                <td><input type="text" name="username" /></td>
                            </tr>
                            <tr>
                                <td>Password:</td>
                                <td><input type="password" name="password" /></td>
                            </tr>
                            <tr>
                                <td>Age:</td>
                                <td><input type="text" name="age"  /></td>
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
                                <td><textarea name="address"></textarea></td>
                            </tr>
                            <tr>
                                <td>Employed?</td>
                                <td>
                                    <select name="employed">
                                        <option value="Yes" >Yes</option>
                                        <option value="No" >No</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Company Name:</td>
                                <td><input type="text" name="company_name" /></td>
                            </tr>
                            <tr><td>Position:</td>
                                <td><input type="text" name="position"/> </td>
                            </tr>
                            <tr><td>Email:</td>
                                <td><input type="text" name="email"/> </td>
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
                                    <input name="ans" type="text" />
                                </td>
                            </tr>
                            <tr><td>Phone:</td>
                                <td><input type="text" name="phone"</td>
                            </tr>
                            <tr>
                                <td>Professional Summary:</td>
                                <td><textarea rows="5" cols="20" name="profile_information" ></textarea></td>
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
                <?php
//                process_image();
//                mysqli_close($con);
                ?>
                <!--                <div class="right">
                                    <img src="<?= $dPassport ?>" width="200" height="200" />
                                </div>-->
            </div>
        </div>
    </body>
</html>
