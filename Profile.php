<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Profile Page</title>
        <link rel="stylesheet" type="text/css" href="cssFiles/myProfile.css" />
    </head>
    <body>
        <?php
        $username = filter_input(INPUT_COOKIE, "username");

        $con = mysqli_connect("localhost", "root", "", "vickprofile");
        if (!$con) {
            die('Could not Connect:' . mysqli_error($con));
        }
        $selected_details = "SELECT * FROM user_profile WHERE Username = 'Grobbler'";
        $result = mysqli_query($con, $selected_details);

        if (!$result) {
            echo mysqli_error($con);
        }
        $details = mysqli_fetch_array($result);
        $dLastname = $details['LastName'];
        $dFirstName = $details['FirstName'];
        $dFullname = $dLastname . " " . $dFirstName;
        $dAge = $details['Age'];
        $dCompanyName = $details['CompanyName'];
        $dGender = $details['Gender'];
        $dEmail = $details['Email'];
        $dAddress = $details['Address'];
        $dPhone = $details['Phone'];
        $dPassport = $details['Passport'];
        $dPosition = $details['Position'];
        $dAboutYourself = $details['AboutYourself'];
        mysqli_close($con);
        ?>
        <div class="container">
            <div class="inner">
                <br/>
                <div class="left">
                    <span id="b"><?php echo $dFullname; ?></span><br />
                    <span id="c">Worked at <?php echo $dCompanyName; ?></span><br/>
                    <span class="d"><?php echo $dPosition; ?></span><br/>
                    <span class="e"><?php echo $dGender; ?></span><br/>
                    <span class="d"><?php echo $dAge; ?></span><br/>
                    <span class="e"><?php echo $dEmail; ?></span><br/>
                    <span class="d"><?php echo $dAddress; ?></span><br/>
                    <span class="e"><?php echo $dPhone; ?></span><br/>
                    <span id="e"><?php echo $dAboutYourself; ?></span><br/>
                </div>
            </div>
        </div>
    </body>
</html>
