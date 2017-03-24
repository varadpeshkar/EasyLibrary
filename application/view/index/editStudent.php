<div class="container">
    <?php $this->renderFeedbackMessages(); ?>
    <div class="col-lg-2">
        <div class="panel panel-primary">
            <?php require Config::get('PATH_VIEW') . 'index/menu.php' ?>
        </div>
    </div>
    <div class="col-lg-10">
        <div class="panel panel-info">
            <div class="panel-heading">Edit Student Details</div>
            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="<?= Config::get("URL") ?>index/editStudent_action/<?php echo $this->student->id; ?>">
                    <fieldset>


                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="name">Full name</label>  
                            <div class="col-md-4">
                                <input id="name" value="<?php echo $this->student->name; ?>" name="name" type="text" placeholder="full name here" class="form-control input-md" required="">
                                <span class="help-block">Student's full name</span>  
                            </div>
                        </div>

                        <!-- Select Basic -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="current_year">Current Year</label>
                            <div class="col-md-4">
                                <select id="current_year" name="current_year" class="form-control">
                                    <option value="F.E" <?php if ($this->student->current_year == 'F.E') { ?> selected="true" <?php } ?>>F.E</option>
                                    <option value="S.E" <?php if ($this->student->current_year == 'S.E') { ?> selected="true" <?php } ?>>S.E</option>
                                    <option value="T.E" <?php if ($this->student->current_year == 'T.E') { ?> selected="true" <?php } ?>>T.E</option>
                                    <option value="B.E" <?php if ($this->student->current_year == 'B.E') { ?> selected="true" <?php } ?>>B.E</option>
                                </select>
                            </div>
                        </div>

                        <!-- Select Basic -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="branch">Branch</label>
                            <div class="col-md-4">
                                <select id="branch" name="branch" class="form-control">
                                    <option value="Computer Engineering" <?php if ($this->student->branch == 'Computer Engineering') { ?> selected="true" <?php } ?>>Computer Engineering</option>
                                    <option value="IT Engineering" <?php if ($this->student->branch == 'IT Engineering') { ?> selected="true" <?php } ?>>IT Engineering</option>
                                    <option value="Mechanical Engineering" <?php if ($this->student->branch == 'Mechanical Engineering') { ?> selected="true" <?php } ?>>Mechanical Engineering</option>
                                    <option value="Electrical Engineering" <?php if ($this->student->branch == 'Electrical Engineering') { ?> selected="true" <?php } ?>>Electrical Engineering</option>
                                    <option value="Electronics Engineering"<?php if ($this->student->branch == 'Electronics Engineering') { ?> selected="true" <?php } ?>>Electronics Engineering</option>
                                    <option value="Civil Engineering" <?php if ($this->student->branch == 'Civil Engineering') { ?> selected="true" <?php } ?>>Civil Engineering</option>
                                </select>
                            </div>
                        </div>

                        <!-- Prepended text-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="mobile_number">Mobile number</label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon">+91</span>
                                    <input id="mobile_number" value="<?php echo $this->student->mobile_number; ?>" name="mobile_number" class="form-control" placeholder="9900001122" type="text" maxlength="10" required="">
                                </div>
                                <p class="help-block">Student's mobile number</p>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="email">Email </label>  
                            <div class="col-md-4">
                                <input id="email" name="email" value="<?php echo $this->student->email; ?>" type="email" placeholder="abc@gmail.com" class="form-control input-md" required="" disabled>
                                <span class="help-block">Student's email address</span>  
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="password">Default Password</label>  
                            <div class="col-md-4">
                                <input id="password" name="password" value="<?php echo $this->student->password; ?>" type="text" placeholder="password" class="form-control input-md" required="" disabled>
                                <span class="help-block">Default password for student login</span>  
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="submit"></label>
                            <div class="col-md-4">
                                <input type="submit" value="Update" id="submit" name="submit" class="btn btn-success"/>
                            </div>
                        </div>

                    </fieldset>        </form>
            </div>
        </div>
        </di></div>
