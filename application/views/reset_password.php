

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

        <h1>Reset Password</h1>

        <hr>

        <div class="col-sm-8 places_form_main">

            <?php

                $error = $this->session->flashdata('error');

                $success = $this->session->flashdata('success');

            ?>

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

                    <label class="control-label requiredField" for="old_password">Old Password

                        <span class="asteriskField">*</span>

                    </label>

                    <input class="form-control <?php echo (form_error('old_password'))?'error':'' ;?>" id="old_password" name="old_password" placeholder="Old Password" type="password"/>

                    <?php echo form_error('old_password'); ?>

                </div>

                <span class="help-block"></span>

                <div class="form-group ">

                    <label class="control-label requiredField" for="new_password">New Password

                        <span class="asteriskField">*</span>

                    </label>

                    <input class="form-control <?php echo (form_error('new_password'))?'error':'' ;?>" id="new_password" name="new_password" placeholder="New Password" type="password"/>

                    <?php echo form_error('new_password'); ?>

                </div>

                <span class="help-block"></span>

                <div class="form-group ">

                    <label class="control-label requiredField" for="cpassword">Confirm Password

                        <span class="asteriskField">*</span>

                    </label>

                    <input class="form-control <?php echo (form_error('cpassword'))?'error':'' ;?>" id="cpassword" name="cpassword" placeholder="Confirm Password" type="password"/>

                    <?php echo form_error('cpassword'); ?>

                </div>

                <span class="help-block"></span>

                <div class="form-group">

                    <div>

                        <button class="btn btn-primary " name="submit" type="submit">Change Password</button>

                    </div>

                </div>

            </form>



        </div>

    </div>

</section>