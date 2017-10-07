<div id="login" class="logsign_wrapper">

    <div class="container">

        <div class="mainframe">

            <div class="col-sm-6 no-pad">

                <div class="mainframe-inner-left">

                    <div class="frame_left_image_container">

                        <img src="<?php echo base_url(); ?>/assets/images/login_left_img.jpg">

                        <p> Tell your travel story, tips and experience Earn Credit Then… money!!</p>

                    </div>

                </div>

            </div>

            <div class="col-sm-6 no-pad">

                <div class="mainframe-inner-right">

                    <h2>Sign in</h2>

                    <?php if (isset($form_errors) && !empty($form_errors)): ?>

                        <div class="alert alert-danger">

                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                            <p>Errors!</p>

                            <?php echo $form_errors; ?>

                        </div>

                    <?php endif; ?>

                    <form method="post" id="login-form" action="<?php echo current_url() ?>">

                        <div class="form-group icon-addon">

                            <label>E-mail </label>

                            <input type="signin_email" name="signin_email" id="signin_email" class="form-control" placeholder="Enter E-mail address">

                            <span class="icon icon-envelope"> </span>

                            

                        </div>

                        <?php echo form_error('signin_email'); ?>

                        <div class="form-group icon-addon">

                            <label>Password </label>

                            <input type="Password" name="signin_password" id="signin_password" class="form-control"

                                   placeholder="Enter your Password">

                            <span class="icon icon-lock"> </span>

                            

                        </div>

                        <?php echo form_error('signin_password'); ?>



                        <div class="send-button">

                            <p><a href="javascript:void(0);" onclick="forgot_password_popup();">Forgot Password?</a></p>



                            <input type="submit" value="SIGN IN">



                            <div class="clear"></div>

                        </div>

                    </form>



                    <p class="change_link">

                        Don't have an account? <a class="to_register" href="<?php echo base_url('signup'); ?>">Sign

                            Up!</a>

                    </p>

                    <div class="social-icons">

                        <p>OR USE YOUR SOCIAL ACCOUNTS</p>

                        <ul class="list-inline">

                            <li class="fb"><a href="javascript:void(0);" onclick="facebookLogin();"> <i

                                            class="fa fa-facebook"> </i> Login with facebook </a></li>

                            <!-- <li class="gp">  <a href="javascript:googleLogin('https://accounts.google.com/o/oauth2/auth?scope=https://www.google.com/m8/feeds&client_id=579918541513-v59tdtkcafciokrfr3ankf7bdn57apof.apps.googleusercontent.com&redirect_uri=<?php //echo base_url('connect_google') ?>&response_type=code');"> <i class="fa fa-google-plus"> </i> Login with google </a> </li> -->

                            <li class="gp"><a href="<?php echo $login_url ?>"> <i class="fa fa-google-plus"> </i> Login

                                    with google </a></li>

                        </ul>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



<div id="forgot_password_model" class="modal fade">

    <div class="modal-dialog">

        <div class="modal-content forgot_p">

            <div class="modal-header well1_right_title forgot">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title"> Forgot Password ? </h4>

            </div>

            <form style="border: 2px solid #1f2e42;border-top: 0;" id="forgot_password_form" class="serives-reply-form" method="post"

                  action="<?php echo base_url("forget_password") ?>">

                <div class="modal-body forgot2">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="form-group col-md-12">

                                <label class="control-label requiredField" for="forgot_password_email">Enter Your Email

                                    <span class="asteriskField">*</span>

                                </label>

                                <?php $data = array(

                                    'name' => 'forgot_password_email',

                                    'id' => 'forgot_password_email',

                                    'value' => set_value('forgot_password_email') ? set_value('forgot_password_email') : '',

                                    'placeholder' => 'Enter Your Email',

                                    'class' => 'form-control'

                                );

                                echo form_input($data); ?>

                                <?php echo form_error('forgot_password_email'); ?>

                                <span class="help-block"></span>

                                <span>(We will send reset password instructions to the email address associated with your account.)</span>

                            </div>

                        </div>

                    </div>
                    <hr />
                </div>



                <!--Modal footer-->

                <div class="modal-footer forgot3">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    <button class="btn btn-primary " name="submit" type="submit">Send</button>

                </div>

            </form>

        </div>

    </div>

</div>



<!-- ////Login With Facebook ///// -->

<script type="text/javascript">

    window.fbAsyncInit = function () {

        FB.init({

            appId: '708082066023246',

            cookie: true,

            xfbml: true,

            oauth: true

        });

    };

    (function (d) {

        var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];

        if (d.getElementById(id)) {

            return;

        }

        js = d.createElement('script');

        js.id = id;

        js.async = true;

        js.src = "//connect.facebook.net/en_US/all.js";

        ref.parentNode.insertBefore(js, ref);

    }(document));



    function facebookLogin() {

        FB.login(function (response) {

            if (response.authResponse) {

                window.location.href = "<?php echo base_url("connect_facebook") ?>";

            }

        }, {scope: 'public_profile,publish_actions,email'});

    }

    function googleLogin(url) {

        var newWindow = window.open(url, 'name', 'height=350,width=650');

        if (window.focus) {

            window.close();

            window.location.href = "<?php echo base_url("connect_google") ?>";

        }

    }



    function forgot_password_popup() {

        $("#forgot_password_form")[0].reset();

        $("#forgot_password_model").modal("show");

    }



    $(document).ready(function () {

        $("#forgot_password_form").validate({

            rules: {

                forgot_password_email: {

                    required: true,

                    email: true

                },

            },

            messages: {

                forgot_password_email: "Please enter a valid email.",

            },

            submitHandler: function (form) {

                <?php if($this->session->userdata("user_id")): ?>

                    window.location.href = "<?php echo base_url() ?>";

                <?php else: ?>

                var _form = $("#"+form.id);

                $.ajax({

                    url: form.action,

                    type: "POST",

                    data: _form.serialize(),

                    dataType: "json",

                    success: function (data) {

                        if (!data.error) {

                            var msg = '<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Success!</p>' + data.message + '</div>';

                            _form.prepend(msg);

                            _form[0].reset();

                            setTimeout(function () {

                                _form.find(".alert-success").remove();

                            }, 2500);

                        }else if(data.reload && data.error){

                            window.location.href = "<?php echo base_url() ?>";

                        } else {

                            var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Errors!</p>' + data.message + '</div>';

                            _form.prepend(msg);

                            setTimeout(function () {

                                _form.find(".alert-danger").remove();

                            }, 3000);

                        }

                    },

                    error: function (jqXHR, textStatus, errorMessage) {

                        var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Errors!</p>' + errorMessage + '</div>';

                        _form.prepend(msg);

                        setTimeout(function () {

                            _form.find(".alert-danger").remove();

                        }, 3000);

                    }

                });

                <?php endif; ?>

            }

        });

    });

</script>

<!-- ////End Login With Facebook ///// -->