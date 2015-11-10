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
$dPassport = $details['Passport'];
mysqli_close($con);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="cssFiles/HeaderFooter.css" />
        <script type="text/javascript" src="jsFiles/index.js" ></script>
    </head>
    <body>
        <div id="header">
            <div class="logo"><p>Perfil Persona</p></div>
            <div class="menucontainer">
                <div class="logout"><a href="logout.php"><strong>Log Out</strong></a></div>
<!--                <img id="pic" src="<?= $dPassport ?>" width="100" height="100" />-->
                <p class="logotext"><strong>Perfil Persona</strong></p>
                <div class="menubar">
                    <strong><a href="Profile.php"><div class="menu" id="first" onmouseout="menu_hover('1', 'first')" onmouseover="menu_hover('0', 'first')" onclick="menu_hover('2', 'first')">View Profile</div></a>
                        <a href="EditCurriculum.php"><div class="menu" id="second" onmouseout="menu_hover('1', 'second')" onmouseover="menu_hover('0', 'second')"onclick="menu_hover('2', 'second')">View CV</div></a>
                        <a href="profileEdit.php"><div class="menu" id="third" onmouseout="menu_hover('1', 'third')" onmouseover="menu_hover('0', 'third')"onclick="menu_hover('2', 'third')">Edit Profile</div></a>
                        <a href="register.php"><div class="menu" id="fourth" onmouseout="menu_hover('1', 'fourth')" onmouseover="menu_hover('0', 'fourth')"onclick="menu_hover('2', 'fourth')">Add User</div></a></strong>
                </div>
            </div>
        </div>
        <div id="sidebar">
            <textarea class="sticky" name="stickynote" placeholder="Insert Your Goals Here"></textarea>
            <br/>
            <textarea class="sticky" name="stickynote" placeholder="Insert your Achievements here"></textarea>

        </div>
        <div id="footer">
            This is the footer
        </div>
        <?php
        ?>
    </body>
</html>
