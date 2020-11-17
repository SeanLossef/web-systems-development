<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <script src="script.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css"/>
        <!--For icons:-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    </head>
    <body>
        <?php
            $dbOk = false;
            $dsn = 'mysql:host=localhost;dbname=websyslab9';
            $user = 'root';
            $password = '';
            $errors = '';
            $focusId = ''; // trap the first field that needs updating

            try {
                $dbconn = new PDO($dsn, $user, $password);
                $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $dbOk = true;
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }

            // GRADE
            if (isset($_POST["saveGrade"])) {
                // clean input
                $crn = htmlspecialchars(trim($_POST["grade_crn"]));
                $rin = htmlspecialchars(trim($_POST["grade_rin"]));
                $grade = htmlspecialchars(trim($_POST["grade"]));

                // convert req. strings to ints
                $crnNum = intval($crn);
                $rinNum = intval($rin);
                $gradeNum = intval($grade);

                // check required fields
                if ($crn == '') {
                    $errors .= '<li>CRN may not be blank</li>';
                    if ($focusId == '') $focusId = '#grade_crn';
                }
                if ($rin == '') {
                    $errors .= '<li>RIN may not be blank</li>';
                    if ($focusId == '') $focusId = '#grade_rin';
                }
                if ($grade == '') {
                    $errors .= '<li>Grade may not be blank</li>';
                    if ($focusId == '') $focusId = '#grade';
                }

                // prepare & execute query statement
                if ($errors == '' && $dbOk) { 
                    $query = "insert into grades (`crn`,`RIN`,`grade`) values(:crn,:rin,:grade)";
                    $statement = $dbconn->prepare($query);
                    $statement->bindParam(":crn", $crnNum, PDO::PARAM_INT);
                    $statement->bindParam(":rin", $rinNum, PDO::PARAM_INT);
                    $statement->bindParam(":grade", $gradeNum, PDO::PARAM_INT);
                    $statement->execute();
                    
                    // give the user some feedback
                    echo '<div class="messages"><h4>Success: ' . $statement->rowCount() . ' grade added to database.</h4>';
                }
            }

            // COURSE
            if (isset($_POST["saveCourse"])) {
                // clean input
                $crn = htmlspecialchars(trim($_POST["crn"]));
                $prefix = htmlspecialchars(trim($_POST["prefix"]));
                $num = htmlspecialchars(trim($_POST["num"]));
                $title = htmlspecialchars(trim($_POST["title"]));
                $section = htmlspecialchars(trim($_POST["section"]));
                $year = htmlspecialchars(trim($_POST["year"]));

                // convert req. strings to ints
                $crnNum = intval($crn);
                $numNum = intval($num);
                $sectionNum = intval($section);
                $yearNum = intval($year);

                // check required fields
                if ($crn == '') {
                    $errors .= '<li>CRN may not be blank</li>';
                    if ($focusId == '') $focusId = '#crn';
                }
                if ($prefix == '') {
                    $errors .= '<li>Prefix may not be blank</li>';
                    if ($focusId == '') $focusId = '#prefix';
                }
                if ($num == '') {
                    $errors .= '<li>Number may not be blank</li>';
                    if ($focusId == '') $focusId = '#num';
                }
                if ($title == '') {
                    $errors .= '<li>Title may not be blank</li>';
                    if ($focusId == '') $focusId = '#title';
                }
                if ($section == '') {
                    $errors .= '<li>Section may not be blank</li>';
                    if ($focusId == '') $focusId = '#section';
                }
                if ($year == '') {
                    $errors .= '<li>Year may not be blank</li>';
                    if ($focusId == '') $focusId = '#year';
                }

                // prepare & execute query statement
                if ($errors == '' && $dbOk) { 
                    $query = "insert into courses (`crn`,`prefix`,`number`,`title`,`section`,`year`) values(:crn,:prefix,:number,:title,:section,:year)";
                    $statement = $dbconn->prepare($query);
                    $statement->bindParam(":crn", $crnNum, PDO::PARAM_INT);
                    $statement->bindParam(":prefix", $prefix, PDO::PARAM_STR);
                    $statement->bindParam(":number", $numNum, PDO::PARAM_INT);
                    $statement->bindParam(":title", $title, PDO::PARAM_STR);
                    $statement->bindParam(":section", $sectionNum, PDO::PARAM_INT);
                    $statement->bindParam(":year", $yearNum, PDO::PARAM_INT);
                    $statement->execute();
                    
                    // give the user some feedback
                    echo '<div class="messages"><h4>Success: ' . $statement->rowCount() . ' course added to database.</h4>';
                }
            }

            // STUDENT
            if (isset($_POST["saveStudent"])) {
                // clean input
                $fName = htmlspecialchars(trim($_POST["fName"]));  
                $lName = htmlspecialchars(trim($_POST["lName"]));
                $alias = htmlspecialchars(trim($_POST["alias"]));
                $rin = htmlspecialchars(trim($_POST["rin"]));
                $rcsid = htmlspecialchars(trim($_POST["rcsid"]));
                $phone = htmlspecialchars(trim($_POST["phone"]));
                $street = htmlspecialchars(trim($_POST["street"]));
                $city = htmlspecialchars(trim($_POST["city"]));
                $state = htmlspecialchars(trim($_POST["state"]));
                $zip = htmlspecialchars(trim($_POST["zip"]));
                
                // convert req. strings to ints
                $rinNum = intval($rin);
                $phoneNum = intval($phone);
                $zipNum = intval($zip);
                
                // check required fields
                if ($fName == '') {
                    $errors .= '<li>First name may not be blank</li>';
                    if ($focusId == '') $focusId = '#fName';
                }
                if ($lName == '') {
                    $errors .= '<li>Last name may not be blank</li>';
                    if ($focusId == '') $focusId = '#lName';
                }
                if ($alias == '') {
                    $errors .= '<li>Alias may not be blank</li>';
                    if ($focusId == '') $focusId = '#alias';
                }
                if ($rin == '') {
                    $errors .= '<li>RIN may not be blank</li>';
                    if ($focusId == '') $focusId = '#rin';
                }
                if ($rcsid == '') {
                    $errors .= '<li>RCSID may not be blank</li>';
                    if ($focusId == '') $focusId = '#rcsid';
                }
                if ($phone == '') {
                    $errors .= '<li>Phone may not be blank</li>';
                    if ($focusId == '') $focusId = '#phone';
                }
                if ($street == '') {
                    $errors .= '<li>Street may not be blank</li>';
                    if ($focusId == '') $focusId = '#street';
                }
                if ($city == '') {
                    $errors .= '<li>City may not be blank</li>';
                    if ($focusId == '') $focusId = '#city';
                }
                if ($state == '') {
                    $errors .= '<li>State may not be blank</li>';
                    if ($focusId == '') $focusId = '#state';
                }
                if ($zip == '') {
                    $errors .= '<li>Zip may not be blank</li>';
                    if ($focusId == '') $focusId = '#zip';
                }
            
                // prepare & execute query statement
                if ($errors == '' && $dbOk) { 
                    $query = "insert into students (`RIN`,`RCSID`,`fname`,`lname`,`alias`,`phone`,`street`,`city`,`state`,`zip`) values(:rin,:rcsid,:fName,:lName,:alias,:phone,:street,:city,:state,:zip)";
                    $statement = $dbconn->prepare($query);
                    $statement->bindParam(":rin", $rinNum, PDO::PARAM_INT);
                    $statement->bindParam(":rcsid", $rcsid, PDO::PARAM_STR);
                    $statement->bindParam(":fName", $fName, PDO::PARAM_STR);
                    $statement->bindParam(":lName", $lName, PDO::PARAM_STR);
                    $statement->bindParam(":alias", $alias, PDO::PARAM_STR);
                    $statement->bindParam(":phone", $phoneNum, PDO::PARAM_INT);
                    $statement->bindParam(":street", $street, PDO::PARAM_STR);
                    $statement->bindParam(":city", $city, PDO::PARAM_STR);
                    $statement->bindParam(":state", $state, PDO::PARAM_STR);
                    $statement->bindParam(":zip", $zipNum, PDO::PARAM_INT);
                    $statement->execute();
                    
                    // give the user some feedback
                    echo '<div class="messages"><h4>Success: ' . $statement->rowCount() . ' student added to database.</h4>';
                    echo $fName . ' ' . $lName . '</div>';
                } 
            }

            // show errors
            if ($errors != '') {
                echo '<div class="messages"><h4>Please correct the following errors:</h4><ul>';
                echo $errors;
                echo '</ul></div>';
                echo '<script type="text/javascript">';
                echo '  $(document).ready(function() {';
                echo '    $("' . $focusId . '").focus();';
                echo '  });';
                echo '</script>';
            }

            // close statement
            $dbconn = null;
        ?>
        <section id="students" class="formSection">
            <h2>Add Student</h2>
            <form id="addStudent" name="addStudent" action="index.php" method="post" onsubmit="return validate(this);">
            <fieldset> 
                <div class="formData">    
                    <label class="field" for="fName">First Name:</label>
                    <div class="value"><input type="text" size="60" name="fName" id="fName"/></div>
                    
                    <label class="field" for="lName">Last Name:</label>
                    <div class="value"><input type="text" size="60" name="lName" id="lName"/></div>
                    
                    <label class="field" for="alias">Alias:</label>
                    <div class="value"><input type="text" size="60" name="alias" id="alias"/></div>

                    <label class="field" for="rin">RIN:</label>
                    <div class="value"><input type="text" size="10" name="rin" id="rin"/></div>
                    
                    <label class="field" for="rcsid">RCSID:</label>
                    <div class="value"><input type="text" size="10" maxlength="7" name="rcsid" id="rcsid"/></div>

                    <label class="field" for="phone">Phone:</label>
                    <div class="value"><input type="text" size="10" maxlength="10" name="phone" id="phone"/></div>

                    <label class="field" for="street">Street:</label>
                    <div class="value"><input type="text" size="60" name="street" id="street"/></div>
                    
                    <label class="field" for="city">City:</label>
                    <div class="value"><input type="text" size="60" name="city" id="city"/></div>
                    
                    <label class="field" for="state">State:</label>
                    <div class="value"><input type="text" size="60" name="state" id="state"/></div>

                    <label class="field" for="zip">Zip:</label>
                    <div class="value"><input type="text" size="10" maxlength="5" name="zip" id="zip"/></div>

                    <input type="submit" value="save" id="saveStudent" name="saveStudent"/>
                </div>
            </fieldset>
            </form>
        </section>

        <section id="grades" class="formSection">
            <h2>Add Grade</h2>
            <form id="addGrade" name="addGrade" action="index.php" method="post" onsubmit="return validate(this);">
            <fieldset> 
                <div class="formData">   
                    <label class="field" for="grade_crn">CRN:</label>
                    <div class="value"><input type="text" size="10" maxlength="5" name="grade_crn" id="grade_crn"/></div> 
                    
                    <label class="field" for="grade_rin">RIN:</label>
                    <div class="value"><input type="text" size="10" maxlength="9" name="grade_rin" id="grade_rin"/></div>

                    <label class="field" for="grade">Grade:</label>
                    <div class="value"><input type="text" size="10" maxlength="3" name="grade" id="grade"/></div>

                    <input type="submit" value="save" id="saveGrade" name="saveGrade"/>
                </div>
            </fieldset>
            </form>
        </section>

        <section id="courses" class="formSection">
            <h2>Add Course</h2>
            <form id="addCourse" name="addCourse" action="index.php" method="post" onsubmit="return validate(this);">
            <fieldset> 
                <div class="formData">   
                    <label class="field" for="crn">CRN:</label>
                    <div class="value"><input type="text" size="10" maxlength="5" name="crn" id="crn"/></div> 

                    <label class="field" for="prefix">Prefix:</label>
                    <div class="value"><input type="text" size="10" maxlength="4" name="prefix" id="prefix"/></div>
                    
                    <label class="field" for="num">Number:</label>
                    <div class="value"><input type="text" size="10" maxlength="4" name="num" id="num"/></div>

                    <label class="field" for="title">Title:</label>
                    <div class="value"><input type="text" size="60" name="title" id="title"/></div>

                    <label class="field" for="section">Section:</label>
                    <div class="value"><input type="text" size="10" maxlength="1" name="section" id="section"/></div>

                    <label class="field" for="year">Year:</label>
                    <div class="value"><input type="text" size="10" maxlength="4" name="year" id="year"/></div>

                    <input type="submit" value="save" id="saveCourse" name="saveCourse"/>
                </div>
            </fieldset>
            </form>
        </section>
    </body>
</html>
