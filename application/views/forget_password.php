

<section id="welcome" class="welcome_classic">

    <div class="container"> <br/>

        <br/>

        <br/>

        <br/>

        <br/>

        <br/>

        <br/>

        <br/>

        <br/>

        <br/>

        <br/>

    </div>

</section>

<section class="favorites site_wrapper">

    <div class="container">

        <h1>Forgot your password?</h1>

        <hr>

        <div class="col-sm-8 places_form_main">

            <?php if(isset($error) && !empty($error)): ?>

            <div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

              <p>Errors!</p>

              <?php echo $error; ?> </div>

            <?php endif; ?>

            <?php if (!empty($success)) {

                echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><b>' . $success . '</b></div>';

            } ?>

            <form method="post" id="reset_password" action="<?php echo current_url() ?>">
                <div class="form-group ">
                    <label class="control-label requiredField" for="forgot_password_email">Enter Your Email
                        <span class="asteriskField">*</span>
                    </label>

                    <input class="form-control <?php echo (form_error('forgot_password_email'))?'error':'' ;?>" id="forgot_password_email" name="forgot_password_email" placeholder="Enter Your Email" type="text"/>
                    <?php echo form_error('forgot_password_email'); ?>
                    <span>(We will send reset password instructions to the email address associated with your account.)</span>
                </div>
                <span class="help-block"></span>

                <div class="form-group">
                    <div>
                        <button class="btn btn-primary " name="submit" type="submit">Send instructions</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>