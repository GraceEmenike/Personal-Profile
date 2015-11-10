<?php
if (filter_input(INPUT_COOKIE, "login")) {
    $usercookie = filter_input(INPUT_COOKIE, "user"); // when does this cookie expire
} else {
    header("location: login.php");
}
$expirelitime = time() * 60 * 60 * 24 * 30;
setcookie("login", "loggedIn", $expirelitime);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Register Profile</title>
        <link href="cssFiles/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="container">
            <div id="header_panel">
                <div id="site_title">
                    <strong>EMENIKE GRACE C.</strong>
                </div>
            </div>

            <div id="menu">
                <ul>
                    <li><a href="logout.php">Home</a></li>
                    <li><a href="logout.php">Skills</a></li>
                    <li><a href="logout.php">Personal Profile</a></li>
                    <li><a href="logout.php">About</a></li>
                    <li><a href="logout.php">Contact</a></li>
                </ul>
            </div>
            <!-- end of menu -->

            <div id="top_panel">
                <div class="project_section_title">
                    <p>Skills</p>
                </div>
                <div class="top_panel_section">

                    <div class="project_title"><a ><span>Languages: </span> PHP, SQL, HTML, CSS, JavaScript, Java</a></div><br/><br/>
                    <div class="project_title"><a ><span>Software: </span> Netbeans, Eclipse, Notepad++, Dreamweaver</a></div>
                </div>
                <div class="top_panel_section">

                    <div class="project_title"><a><span>Frameworks: </span> BootStrap</a></div><br/><br/><br/>
                    <div class="project_title"><a><span>Operating Systems: </span> Windows, Linux</a></div>
                </div>
                <div class="top_panel_section">

                    <div class="project_title"><a><span>Others: </span> Presentation, Listening, Demonstration</a></div><br/><br/>
                    <div class="project_title"><a><span>Research: </span> Systems Analysis and Design, Operations Research</a></div>
                </div>
                <div class="cleaner_h20">&nbsp;</div>
                <div class="btn_01" style="margin-right:35px;"><pre><a href="logout.php">Logout</a></pre></div>
                <!-- For this view all button, add a page that will tell the user that page will be available soon and to contact instead -->
            </div> <!-- end of top panel -->

            <div id="bottom_panel">

                <div id="bottom_panel_section_myProfile_left">
                    <?php
                    include 'register.php';
                    ?>
                </div>

                <div class="bottom_panel_section">
                    <div class="image_box">
                        <div class="image_box_02">
                            <img src="<?= $dPassport ?>" alt="New User" />
                        </div>
                    </div>
                    <pre style="color: #ffffff" ><strong>

    Software Developer</strong></pre>

                    <div class="cleaner_h10">&nbsp;</div>
                    <a></a>
                    <a></a>

                    <div class="cleaner">&nbsp;</div>
                </div>

                <div class="cleaner_h20">&nbsp;</div>
            </div> <!-- end of bottom panel -->

            <div id="footer">
                Copyright © 2015   <a href="#"><strong>Emenike Grace C.</strong></a>
            </div> <!-- end of footer -->
        </div> <!-- end of container -->
    </body>
</html>