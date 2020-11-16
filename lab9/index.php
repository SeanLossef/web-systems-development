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
                    
                    <label class="field" for="rscid">RCSID:</label>
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
