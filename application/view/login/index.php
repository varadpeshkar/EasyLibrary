<div class="container">

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div class="login-page-box">
        <div class="table-wrapper">

            <form class="form-horizontal" action="<?php echo Config::get('URL'); ?>login/login" method="post">
                <fieldset>

                    <!-- Form Name -->
                    <center><legend>Login</legend></center>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="user_name">Username</label>  
                        <div class="col-md-4">
                            <input id="user_name" name="user_name" type="text" placeholder="" class="form-control input-md" required="">

                        </div>
                    </div>

                    <!-- Password input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="user_password">Password</label>
                        <div class="col-md-4">
                            <input id="user_password" name="user_password" type="password" placeholder="" class="form-control input-md" required="">

                        </div>
                    </div>
                    
                    
                    <!-- when a user navigates to a page that's only accessible for logged a logged-in user, then
                         the user is sent to this page here, also having the page he/she came from in the URL parameter
                         (have a look). This "where did you came from" value is put into this form to sent the user back
                         there after being logged in successfully.
                         Simple but powerful feature, big thanks to @tysonlist. -->
                    <?php if (!empty($this->redirect)) { ?>
                        <input type="hidden" name="redirect" value="<?php echo $this->encodeHTML($this->redirect); ?>" />
                    <?php } ?>
                    <!--
                            set CSRF token in login form, although sending fake login requests mightn't be interesting gap here.
                            If you want to get deeper, check these answers:
                                    1. natevw's http://stackoverflow.com/questions/6412813/do-login-forms-need-tokens-against-csrf-attacks?rq=1
                                    2. http://stackoverflow.com/questions/15602473/is-csrf-protection-necessary-on-a-sign-up-form?lq=1
                                    3. http://stackoverflow.com/questions/13667437/how-to-add-csrf-token-to-login-form?lq=1
                    -->
                    <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>" />

                    <!-- Button -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for=""></label>
                        <div class="col-md-4">
                            <input  type="submit" value="Login" name="submit" class="btn btn-success"/>
                        </div>
                    </div>

                </fieldset>
            </form>

        </div>
    </div>
</div>
