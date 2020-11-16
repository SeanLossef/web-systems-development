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

            try {
                $dbconn = new PDO($dsn, $user, $password);
                $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $dbOk = true;
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }

            // STUDENT
            $havePost = isset($_POST["saveStudent"]);
            // validation
            $errors = '';
            if ($havePost) {
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
                
                $focusId = ''; // trap the first field that needs updating, better would be to save errors in an array
                
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
            
                if ($errors != '') {
                    echo '<div class="messages"><h4>Please correct the following errors:</h4><ul>';
                    echo $errors;
                    echo '</ul></div>';
                    echo '<script type="text/javascript">';
                    echo '  $(document).ready(function() {';
                    echo '    $("' . $focusId . '").focus();';
                    echo '  });';
                    echo '</script>';
                } else { 
                if ($dbOk) {
                    // trim output
                    $fNameDb = trim($_POST["fName"]);  
                    $lNameDb = trim($_POST["lName"]);
                    $aliasDb = trim($_POST["alias"]);
                    $rinDb = trim($_POST["rin"]);
                    $rcsidDb = trim($_POST["rcsid"]);
                    $phoneDb = trim($_POST["phone"]);
                    $streetDb = trim($_POST["street"]);
                    $cityDb = trim($_POST["city"]);
                    $stateDb = trim($_POST["state"]);
                    $zipDb = trim($_POST["zip"]);

                    // prepare & execute query statement
                    $query = "insert into students (`RIN`,`RCSID`,`fname`,`lname`,`alias`,`phone`,`street`,`city`,`state`,`zip`) values(:rin,:rcsid,:fName,:lName,:alias,:phone,:street,:city,:state,:zip)";
                    $statement = $dbconn->prepare($query);
                    $statement->bindParam(":rin", $rinDb, PDO::PARAM_INT);
                    $statement->bindParam(":rcsid", $rcsidDb, PDO::PARAM_STR);
                    $statement->bindParam(":fName", $fNameDb, PDO::PARAM_STR);
                    $statement->bindParam(":lName", $lNameDb, PDO::PARAM_STR);
                    $statement->bindParam(":alias", $aliasDb, PDO::PARAM_STR);
                    $statement->bindParam(":phone", $phoneDb, PDO::PARAM_INT);
                    $statement->bindParam(":street", $streetDb, PDO::PARAM_STR);
                    $statement->bindParam(":city", $cityDb, PDO::PARAM_STR);
                    $statement->bindParam(":state", $stateDb, PDO::PARAM_STR);
                    $statement->bindParam(":zip", $zipDb, PDO::PARAM_INT);
                    $statement->execute();
                    
                    // give the user some feedback
                    echo '<div class="messages"><h4>Success: ' . $statement->rowCount() . ' student added to database.</h4>';
                    echo $fName . ' ' . $lName . '</div>';
                    
                    // close statement
                    $dbconn = null;
                }
                } 
            }
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
