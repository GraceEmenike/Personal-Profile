<?php
include 'HeaderFooter.php';
$con = mysqli_connect("localhost", "root", "", "vickprofile");
if (!$con) {
    die('Could not Connect:' . mysqli_error($con));
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Curriculum</title>
        <link rel="stylesheet" type="text/css" href="cssFiles/design.css" />
        <script type="text/javascript" src="jsFiles/index.js" ></script>
    </head>
    <body style="background-color: aliceblue">

        <?php
        // This part reads the add Skill post
        if (filter_input(INPUT_POST, "Summaryo")) {
            $SubmitSummary = filter_input(INPUT_POST, "Summaryo");
            $selected_details = "INSERT INTO summary (Description) VALUES ('$SubmitSummary')";
            $result = mysqli_query($con, $selected_details);
            if (!$result) {
                echo 'Oops! Something went wrong with update. Please try again for Skill';
            }
        }

        // This part reads the add Skill post
        if (filter_input(INPUT_POST, "Skillo")) {
            $SubmitSkill = filter_input(INPUT_POST, "Skillo");
            $selected_details = "INSERT INTO skills (Skill) VALUES ('$SubmitSkill')";
            $result = mysqli_query($con, $selected_details);
            if (!$result) {
                echo 'Oops! Something went wrong with update. Please try again for Skill';
            }
        }
        // This next part reads the add Experience post
        if ((filter_input(INPUT_POST, "Description")) && (filter_input(INPUT_POST, "Start")) && (filter_input(INPUT_POST, "Finish")) && (filter_input(INPUT_POST, "Company")) && (filter_input(INPUT_POST, "Title"))) {//
            $SubmitCompany = filter_input(INPUT_POST, "Company");
            $SubmitTitle = filter_input(INPUT_POST, "Title");
            $SubmitDescription = filter_input(INPUT_POST, "Description");
            $SubmitStart = filter_input(INPUT_POST, "Start");
            $SubmitFinish = filter_input(INPUT_POST, "Finish");
            $selected_details = "INSERT INTO experiences (Company, Title, Description, Start, Finish) VALUES ('$SubmitCompany','$SubmitTitle', '$SubmitDescription', '$SubmitStart', '$SubmitFinish')";
            $result = mysqli_query($con, $selected_details);
            if (!$result) {
                echo 'Oops! Something went wrong with update. Please try again for SubmitExpe..';
            }
        }

        // This next part reads the add Education post
        if ((filter_input(INPUT_POST, "Institution")) && (filter_input(INPUT_POST, "Start")) && (filter_input(INPUT_POST, "Finish")) && (filter_input(INPUT_POST, "Degree"))) {//
            $SubmitInstitution = filter_input(INPUT_POST, "Institution");
            $SubmitDegree = filter_input(INPUT_POST, "Degree");
            $SubmitStart = filter_input(INPUT_POST, "Start");
            $SubmitFinish = filter_input(INPUT_POST, "Finish");
            $selected_details = "INSERT INTO education (Institution, Degree, Start, Finish) VALUES ('$SubmitInstitution','$SubmitDegree', '$SubmitStart', '$SubmitFinish')";
            $result = mysqli_query($con, $selected_details);
            if (!$result) {
                echo 'Oops! Something went wrong with update. Please try again for SubmitEducat..';
            }
        }

        // This next part reads the add Certification post
        if ((filter_input(INPUT_POST, "Certificate")) && (filter_input(INPUT_POST, "Summary")) && (filter_input(INPUT_POST, "Date"))) {//
            $SubmitCertificate = filter_input(INPUT_POST, "Certificate");
            $SubmitSummary = filter_input(INPUT_POST, "Summary");
            $SubmitDate = filter_input(INPUT_POST, "Date");
            $selected_details = "INSERT INTO certification (Certificate, Summary, Date) VALUES ('$SubmitCertificate','$SubmitSummary', '$SubmitDate')";
            $result = mysqli_query($con, $selected_details);
            if (!$result) {
                echo 'Oops! Something went wrong with update. Please try again for SubmitCert..';
            }
        }

        // This part reads the add Language post
        if (filter_input(INPUT_POST, "Languageo")) {
            $SubmitLanguage = filter_input(INPUT_POST, "Languageo");
            $selected_details = "INSERT INTO languages (Language) VALUES ('$SubmitLanguage')";
            $result = mysqli_query($con, $selected_details);
            if (!$result) {
                echo 'Oops! Something went wrong with update. Please try again for Skill';
            }
        }

        //This part read the remove Skill post
        if (isset(filter_input_array(INPUT_POST)["Summary"])) {
            $RemoveSummar = filter_input_array(INPUT_POST)["Summary"];
            $n = count($RemoveSummar);
            for ($p = 0; $p < $n; $p++) {
                $selected_details = "DELETE FROM summary WHERE ID = '{$RemoveSummar[$p]}'"; // insert ID number!!!!!!
                mysqli_query($con, $selected_details);
            }
        }

        //This part read the remove Skill post
        if (isset(filter_input_array(INPUT_POST)["Skill"])) {
            $RemoveSkil = filter_input_array(INPUT_POST)["Skill"];
            $n = count($RemoveSkil);
            //if ($RemoveSkil) {
            for ($p = 0; $p < $n; $p++) {
                $selected_details = "DELETE FROM skills WHERE ID = '{$RemoveSkil[$p]}'"; // insert ID number!!!!!!
                mysqli_query($con, $selected_details);
            }
        }
        //This part reads the remove Experience post
        if (isset(filter_input_array(INPUT_POST)["Experience"])) {
            $RemoveExperienc = filter_input_array(INPUT_POST)["Experience"];
            $n = count($RemoveExperienc);
            // if ($RemoveSkil) {
            for ($p = 0; $p < $n; $p++) {
                $selected_details = "DELETE FROM experiences WHERE ID = '{$RemoveExperienc[$p]}'"; // insert ID number!!!!!!
                mysqli_query($con, $selected_details);
            }
        }

        //This part reads the remove Education post
        if (isset(filter_input_array(INPUT_POST)["Education"])) {
            $RemoveEducation = filter_input_array(INPUT_POST)["Education"];
            $n = count($RemoveEducation);
            for ($p = 0; $p < $n; $p++) {
                $selected_details = "DELETE FROM education WHERE Degree = '{$RemoveEducation[$p]}'"; // insert ID number!!!!!!
                mysqli_query($con, $selected_details);
            }
        }

        //This part reads the remove Certification post
        if (isset(filter_input_array(INPUT_POST)["Certification"])) {
            $RemoveCertication = filter_input_array(INPUT_POST)["Certification"];
            $n = count($RemoveCertication);
            for ($p = 0; $p < $n; $p++) {
                $selected_details = "DELETE FROM certification WHERE Certificate = '{$RemoveCertication[$p]}'"; // insert ID number!!!!!!
                mysqli_query($con, $selected_details);
            }
        }
        //This part read the remove Language post
        if (isset(filter_input_array(INPUT_POST)["Language"])) {
            $RemoveLanguag = filter_input_array(INPUT_POST)["Language"];
            $n = count($RemoveLanguag);
            for ($p = 0; $p < $n; $p++) {
                $selected_details = "DELETE FROM languages WHERE ID = '{$RemoveLanguag[$p]}'"; // insert ID number!!!!!!
                mysqli_query($con, $selected_details);
            }
        }
        //hideEdit();
        ?>
        <div  onmousemove="hideEdit()" class="container">
            <!--Start of Summary Section-->
            <div style="width: 100%; clear: both" >
                <div class="out"><p class="title"><em><strong>Summary</strong></em><br /></p></div>
                <?php
                $selected_details = "SELECT * FROM summary";
                $result = mysqli_query($con, $selected_details);

                if (!$result) {
                    echo mysqli_error($con);
                }
                ?>

                <div class="both">
                    <?php
                    $i = 0;
                    while ($row = mysqli_fetch_array($result)) {
                        $dDescription[$i] = $row['Description'];
                        $dDescriptionId[$i] = $row['ID']; // i needed this for the SQL to remove skill form
                        ?>

                        <?php
                        echo "<p class='title'>" . $dDescription[$i] . "</p>";
                        $i++;
                    }
                    ?>
                </div>
            </div>
            <div class="edits">
                <form action="EditCurriculum.php" method="post">
                    <input type="submit" value="Add Skill" name="AddSummary" />
                    <input type="Submit" value="Remove" name="RemoveSummary" />
                </form>
            </div>
            <br/>
            <?php
            if (filter_input(INPUT_POST, "AddSummary")) {
                $AddSummary = filter_input(INPUT_POST, "AddSummary");
                ?>
                <form action="EditCurriculum.php" method="post">
                    <input type="text" name="Summaryo" />
                    <input type="Submit" value="Add" />
                </form>
                <?php
            }
            if (filter_input(INPUT_POST, "RemoveSummary")) {
                $RemoveSummary = filter_input(INPUT_POST, "RemoveSummary");
                ?>
                <form action="EditCurriculum.php" method="post">
                    <?php
                    for ($k = 0; $k <= $i - 1; $k++) {
                        ?>
                        <input type="checkbox" name="Summary[]" value="<?= $dDescriptionId[$k] ?>" /> <?= $dDescription[$k] ?><br />
                        <?php
                    }
                    ?>
                    <input type="Submit" value="Remove Choices" />
                </form>
                <?php
            }
            ?>

            <!--End of Summary Section-->

            <!--Start of Skill Section-->
            <div style="width: 100%; clear: both">
                <div class="out"><p class="title"><em><strong>Skills</strong></em></p></div>
                <?php
                $selected_details = "SELECT * FROM skills";
                $result = mysqli_query($con, $selected_details);

                if (!$result) {
                    echo mysqli_error($con);
                }
                $i = 0;
                ?>
                <div class="both">
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        $dSkill[$i] = $row['Skill'];
                        $dSkillId[$i] = $row['ID']; // i needed this for the SQL to remove skill form
                        //echo $dSkill[$i] . ", ";//This aint needed anymore
                        ?>
                        <ul>
                            <li><?= $dSkill[$i] ?></li>
                        </ul>
                        <?php
                        $i++;
                    }
                    ?>
                </div>
                <div class="edits">
                    <form action="EditCurriculum.php" method="post">
                        <input type="submit" value="Add Skill" name="AddSkill" />
                        <input type="Submit" value="Remove" name="RemoveSkill" />
                    </form>
                    <br/>
                </div>
                <div class="both">
                    <?php
                    if (filter_input(INPUT_POST, "AddSkill")) {
                        $AddSkill = filter_input(INPUT_POST, "AddSkill");
                        ?>
                        <form action="EditCurriculum.php" method="post">
                            <input type="text" name="Skillo" />
                            <input type="Submit" value="Add" />
                        </form>
                    </div>
                    <div class="both">
                        <?php
                    }
                    if (filter_input(INPUT_POST, "RemoveSkill")) {
                        $RemoveSkill = filter_input(INPUT_POST, "RemoveSkill");
                        ?>
                        <form action="EditCurriculum.php" method="post">
                            <?php
                            for ($k = 0; $k <= $i - 1; $k++) {
                                ?>
                                <input type="checkbox" name="Skill[]" value="<?= $dSkillId[$k] ?>" /> <?= $dSkill[$k] ?><br />
                                <?php
                            }
                            ?>
                            <input type="Submit" value="Remove Choices" />
                        </form>
                    </div>
                    <?php
                }
                ?>
            </div>
            <!--End of Skill Section-->
            <!--Start of Experience Section-->
            <div style="clear: both">
                <div class="out"><p class="topic"><em><strong>Experience</strong></em></p></div>
                <?php
                $selected_details = "SELECT * FROM experiences";
                $result = mysqli_query($con, $selected_details);

                if (!$result) {
                    echo mysqli_error($con);
                }
                ?>

                <?php
                $i = 0;
                while ($row = mysqli_fetch_array($result)) {
                    $dExperienceId[$i] = $row['ID']; // try working on the id of the database
                    $dCompany[$i] = $row['Company'];
                    $dTitle[$i] = $row['Title'];
                    $dDescription[$i] = $row['Description'];
                    $dStart[$i] = $row['Start'];
                    $dFinish[$i] = $row['Finish'];
                    $i++;
                }
                ?>

                <?php
                for ($s = 0; $s < $i; $s++) {
                    ?>
                    <div class="both">
                        <div class="left">
                            <?php
                            echo "<p class='company'><strong>" . $dCompany[$s] . "</strong></p>";
                            echo "<p class='title'>" . $dTitle[$s] . "</p>";
                            echo "<p class = 'title'>" . $dDescription[$s] . "</p>";
                            ?>
                        </div>

                        <div class="right">
                            <?php
                            echo "<p class='company'><strong>" . $dStart[$s] . "  -  " . $dFinish[$s] . "</strong>"
                            . "<span>  <img id ='testimage'  onmouseover='opaque(2)' style='width: 15px; height: 15px' src='images/edit.ico' onclick='displayEdit(2)' /></span></p>";
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="edits">
                    <form action="EditCurriculum.php" method="post">
                        <input type="submit" value="Add Experience" name="AddExperience" />
                        <input type="Submit" value="Remove" name="RemoveExperience" /><br/>
                    </form>
                    <br/>
                </div>
                <div class="both">
                    <?php
                    if (filter_input(INPUT_POST, "AddExperience")) {
//                $AddExperience = filter_input(INPUT_POST, "AddExperience");
                        ?>
                        <form action="EditCurriculum.php" method="post">
                            <table>
                                <tr>
                                    <td><p>Company:</td> <td><input type="text" name="Company" /></p></td>
                                </tr>
                                <tr>
                                    <td><p>Title:</td> <td><input type="text" name="Title" /></p></td>
                                </tr>
                                <!--                       Change the input type to a text area-->
                                <tr>
                                    <td><p>Description:</td> <td><input type="text" name="Description" /></p></td>
                                </tr>
                                <tr>
                                    <td><p>Duration(Start):</td> <td> <input type="text" name="Start" /></p></td>
                                </tr>
                                <tr>
                                    <td><p>Duration(Stop):</td> <td><input type="text" name="Finish" /></p></td>
                                </tr>
                                <tr><td><input type="Submit" value="Add" /></td></tr><br/>
                            </table>
                        </form>
                    </div>
                    <div class="both">
                        <?php
                    }
                    if (filter_input(INPUT_POST, "RemoveExperience")) {
                        $RemoveExperience = filter_input(INPUT_POST, "RemoveExperience");
                        ?>
                        <form action="EditCurriculum.php" method="post" enctype="multipart/form-data">
                            <?php
                            for ($k = 0; $k <= $i - 1; $k++) {
                                ?>
                                <input type="checkbox" name="Experience[]" value="<?= $dExperienceId[$k] ?>" /> <?= $dTitle[$k] ?><br />
                                <?php
                            }
                            ?>
                            <input type="Submit" value="Remove Choices" />
                        </form>
                    </div>
                    <?php
                }
                ?>
            </div>
            <!--End of Experience Section-->

            <!--Start of Education Section-->
            <br/>
            <div style="clear: both">
                <div class="out"><p class="topic"><em><strong>Education</strong></em></p><br /></div>
                <?php
                $selected_details = "SELECT * FROM education";
                $result = mysqli_query($con, $selected_details);

                if (!$result) {
                    echo mysqli_error($con);
                }
                ?>
                <?php
                $i = 0;
                while ($row = mysqli_fetch_array($result)) {
                    $dEducationId[$i] = $row['ID']; // try working on the id of the database
                    $dInstitution[$i] = $row['Institution'];
                    $dDegree[$i] = $row['Degree'];
                    $dStart[$i] = $row['Start'];
                    $dFinish[$i] = $row['Finish'];
                    $i++;
                }

                for ($s = 0; $s < $i; $s++) {
                    ?>
                    <div class="both">
                        <div class="left" >
                            <?php
                            echo "<p class='company'><strong>" . $dInstitution[$s] . "</strong></p>";
                            echo "<p class='title'>" . $dDegree[$s] . "</p>";
                            ?>
                        </div>
                        <div class="right" >
                            <?php
                            echo "<p class='company'><strong>" . $dStart[$s] . "  -  " . $dFinish[$s] . "</strong>"
                            . "<span>  <img style='width: 15px; height: 15px' src='images/edit.ico' onclick='displayEdit(2)' /></span></p>";
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <br/>
                <div class="edits">
                    <form action="EditCurriculum.php" method="post">
                        <input type="submit" value="Add Education" name="AddEducation" />
                        <input type="Submit" value="Remove" name="RemoveEducation" /><br/>
                    </form>
                    <br/>
                </div>
                <div class="both">
                    <?php
                    if (filter_input(INPUT_POST, "AddEducation")) {
                        ?>
                        <form action="EditCurriculum.php" method="post">
                            <table>
                                <tr>
                                    <td><p>Institution:</td> <td><input type="text" name="Institution" /></p></td>
                                </tr>
                                <tr>
                                    <td><p>Degree:</td> <td><input type="text" name="Degree" /></p></td>
                                </tr>
                                <tr>
                                    <td><p>Duration(Start):</td> <td> <input type="text" name="Start" /></p></td>
                                </tr>
                                <tr>
                                    <td><p>Duration(Stop):</td> <td><input type="text" name="Finish" /></p></td>
                                </tr>
                                <tr><td><input type="Submit" value="Add" /></td></tr><br/>
                            </table>
                        </form>
                    </div>
                    <div class="both">
                        <?php
                    }
                    if (filter_input(INPUT_POST, "RemoveEducation")) {
                        $RemoveEducation = filter_input(INPUT_POST, "RemoveEducation");
                        ?>
                        <form action="EditCurriculum.php" method="post" enctype="multipart/form-data">
                            <?php
                            for ($k = 0; $k <= $i - 1; $k++) {
                                ?>
                                <input type="checkbox" name="Education[]" value="<?= $dDegree[$k] ?>" /> <?= $dDegree[$k] ?><br />
                                <?php
                            }
                            ?>
                            <input type="Submit" value="Remove Choices" />
                        </form>
                    </div>
                    <?php
                }
                ?>
            </div>
            <!--End of Education Section-->

            <!--Start of Certification Section-->
            <br/>
            <div style="clear: both">
                <div class="out"><p class="topic"><em><strong>Certification</strong></em><br /></p></div>
                <?php
                $selected_details = "SELECT * FROM Certification";
                $result = mysqli_query($con, $selected_details);

                if (!$result) {
                    echo mysqli_error($con);
                }
                ?>

                <?php
                $i = 0;
                while ($row = mysqli_fetch_array($result)) {
                    $dCertificateId[$i] = $row['ID']; // try working on the id of the database
                    $dCertificate[$i] = $row['Certificate'];
                    $dSummary[$i] = $row['Summary'];
                    $dDate[$i] = $row['Date'];
                    $i++;
                }

                for ($s = 0; $s < $i; $s++) {
                    ?>
                    <div class="both">
                        <div class="left">
                            <?php
                            echo "<p class='company'><strong>" . $dCertificate[$s] . "</strong></p>";
                            echo "<p class='title'>" . $dSummary[$s] . "</p>";
                            ?>
                        </div>
                        <div class="right" onclick="displayEdit(5)">
                            <?php
                            echo "<p class='company'><strong>" . $dDate[$s] . "</strong>"
                            . "<span onfocus ='displayEdit(5)'>  <img style='width: 15px; height: 15px' src='images/edit.ico'/></span></p>";
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="edits">
                    <form action="EditCurriculum.php" method="post">
                        <input type="submit" value="Add Certification" name="AddCertification" />
                        <input type="Submit" value="Remove" name="RemoveCertification" /><br/>
                    </form>
                    <br/>
                </div>
                <div class="both">
                    <?php
                    if (filter_input(INPUT_POST, "AddCertification")) {
//                $AddExperience = filter_input(INPUT_POST, "AddEducation");
                        ?>
                        <form action="EditCurriculum.php" method="post">
                            <table>
                                <tr>
                                    <td><p>Certificate:</td> <td><input type="text" name="Certificate" /></p></td>
                                </tr>
                                <tr>
                                    <td><p>Summary:</td> <td><input type="text" name="Summary" /></p></td>
                                </tr>
                                <tr>
                                    <td><p>Date:</td> <td> <input type="text" name="Date" /></p></td>
                                </tr>
                                <tr><td><input type="Submit" value="Add" /></td></tr>
                            </table>
                        </form>
                    </div>
                    <div class="both">
                        <?php
                    }
                    if (filter_input(INPUT_POST, "RemoveCertificate")) {
                        $RemoveCertificate = filter_input(INPUT_POST, "RemoveCertificate");
                        ?>
                        <form action="EditCurriculum.php" method="post">
                            <?php
                            for ($k = 0; $k <= $i - 1; $k++) {
                                ?>
                                <input type="checkbox" name="Certificate[]" value="<?= $dCertificate[$k] ?>" /> <?= $dCertificate[$k] ?><br />
                                <?php
                            }
                            ?>
                            <input type="Submit" value="Remove Choices" />
                        </form>
                    </div>
                    <?php
                }
                ?>
            </div>
            <!--End of Education Section-->
            <!--Start of Languages Section-->
            <div style="clear: both">
                <div class="out"><p class="topic"><em><strong>Languages</strong></em></p></div>
                <?php
                $selected_details = "SELECT * FROM Languages";
                $result = mysqli_query($con, $selected_details);

                if (!$result) {
                    echo mysqli_error($con);
                }
                $i = 0;
                ?>
                <div class="both">
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        $dLanguage[$i] = $row['Language'];
                        $dLanguageId[$i] = $row['ID']; // i needed this for the SQL to remove skill form
//
                        ?>
                        <ul>
                            <li><?= $dLanguage[$i] ?></li>
                        </ul>
                        <?php
                        $i++;
                    }
                    ?>
                </div>

                <div class="edits">
                    <form action="EditCurriculum.php" method="post">
                        <input type="submit" value="Add Language" name="AddLanguage" />
                        <input type="Submit" value="Remove" name="RemoveLanguage" />
                    </form>
                    <br/>
                </div>
                <div class="both">
                    <?php
                    if (filter_input(INPUT_POST, "AddLanguage")) {
                        $AddLanguage = filter_input(INPUT_POST, "AddLanguage");
                        ?>
                        <form action="EditCurriculum.php" method="post">
                            <input type="text" name="Languageo" />
                            <input type="Submit" value="Add" />
                        </form>
                    </div>
                    <div class="both">
                        <?php
                    }
                    if (filter_input(INPUT_POST, "RemoveLanguage")) {
                        $RemoveLanguage = filter_input(INPUT_POST, "RemoveLanguage");
                        ?>
                        <form action="EditCurriculum.php" method="post">
                            <?php
                            for ($k = 0; $k <= $i - 1; $k++) {
                                ?>
                                <input type="checkbox" name="Language[]" value="<?= $dLanguageId[$k] ?>" /> <?= $dLanguage[$k] ?><br />
                                <?php
                            }
                            ?>
                            <input type="Submit" value="Remove Choices" />
                        </form>
                    </div>
                    <?php
                }
                mysqli_close($con);
                ?>
            </div>
            <!--End of Languages Section-->

        </div>

    </body>
</html>
