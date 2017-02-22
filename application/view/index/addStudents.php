<div class="container">
    <?php $this->renderFeedbackMessages(); ?>
    <div class="col-lg-3">
        <div class="panel panel-primary">
            <?php require Config::get('PATH_VIEW') . 'index/menu.php' ?>
        </div>
    </div>
    <div class="col-lg-9">
        <a href="<?= Config::get("URL") ?>index/addStudentsBulk" class="btn btn-success pull-right">Import Excel</a>
        <br/>
        <form class="form-horizontal" method="POST" action="<?= Config::get("URL") ?>index/addStudent_action">
            <fieldset>

                <!-- Form Name -->

                <legend>Add Student</legend>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="name">Full name</label>  
                    <div class="col-md-4">
                        <input id="name" name="name" type="text" placeholder="full name here" class="form-control input-md" required="">
                        <span class="help-block">Student's full name</span>  
                    </div>
                </div>

                <!-- Select Basic -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="current_year">Current Year</label>
                    <div class="col-md-4">
                        <select id="current_year" name="current_year" class="form-control">
                            <option value="F.E">F.E</option>
                            <option value="S.E">S.E</option>
                            <option value="T.E">T.E</option>
                            <option value="B.E">B.E</option>
                        </select>
                    </div>
                </div>

                <!-- Select Basic -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="branch">Branch</label>
                    <div class="col-md-4">
                        <select id="branch" name="branch" class="form-control">
                            <option value="Computer Engineering">Computer Engineering</option>
                            <option value="IT Engineering">IT Engineering</option>
                            <option value="Mechanical Engineering">Mechanical Engineering</option>
                            <option value="Electrical Engineering">Electrical Engineering</option>
                            <option value="Electronics Engineering">Electronics Engineering</option>
                            <option value="Civil Engineering">Civil Engineering</option>
                        </select>
                    </div>
                </div>

                <!-- Prepended text-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="mobile_number">Mobile number</label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon">+91</span>
                            <input id="mobile_number" name="mobile_number" class="form-control" placeholder="9900001122" type="text" maxlength="10" required="">
                        </div>
                        <p class="help-block">Student's mobile number</p>
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="email">Email </label>  
                    <div class="col-md-4">
                        <input id="email" name="email" type="email" placeholder="abc@gmail.com" class="form-control input-md" required="">
                        <span class="help-block">Student's email address</span>  
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="password">Default Password</label>  
                    <div class="col-md-4">
                        <input id="password" name="password" type="text" placeholder="password" class="form-control input-md" required="">
                        <span class="help-block">Default password for student login</span>  
                    </div>
                </div>

                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="submit"></label>
                    <div class="col-md-4">
                        <input type="submit" value="Submit" id="submit" name="submit" class="btn btn-success"/>
                    </div>
                </div>

            </fieldset>        </form>
    </div>
</div>
