<?php
if (filter_input(INPUT_COOKIE, "login")) {//is this line really working
    $usercookie = filter_input(INPUT_COOKIE, "user");
    echo "<h1>WELCOME " . $usercookie . "</h1>";
} else {
    header("location: index.php");
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Profile Page</title>
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
                    <td>
                        <table>
                            <tr>
                                <?php echo $dfullname;
                                ?><br/>
                </tr>
                <tr>
                    <?php echo $dAge;
                    ?><br/>
                </tr>
                <tr>
                    <?php echo $dCompanyName;
                    ?><br/>
                </tr>
                <tr>
                    <?php echo $dGender;
                    ?><br/>
                </tr>
                <tr>
                    <?php echo $dposition;
                    ?><br/>
                </tr>
                <tr>
                    <?php echo $dAboutYourself;
                    ?><br/>
                </tr>
            </table>
        </td>
    </tr>
</table>

</div>

<div>
    <a href="profileEdit.php"><button>Edit Profile</button></a><br/>
    <a href="logout.php"><button>Logout</button></a>
</div>


</body>
</html>
