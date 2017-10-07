<div class="boxed">

    <!--CONTENT CONTAINER-->
    <!--===================================================-->
    <div id="content-container">

        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">

            <!-- Basic Data Tables -->
            <!--===================================================-->
            <div class="panel">
                <div class="panel-heading">
                    <div class="pull-left col-md-6">
                        <h3 class="panel-title">Edit Profile</h3>
                    </div>
                    <div class="pull-right col-md-6" style="text-align: right; margin-top: 10px;">
                    </div>
                </div>
                <div class="panel-body">
                     <?php
                        $file_error = $this->session->flashdata('file_error');
                        $success = $this->session->flashdata('success');
                        $error = $this->session->flashdata('error');
                    ?>
                    <?php if(!empty($file_error) || !empty($error)) { echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><b>'.$file_error.'</b></div>'; } ?>
                    <?php if(!empty($success)) { echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><b>'.$success.'</b></div>'; } ?>

                        <form method="post" id="edit_profile" enctype="multipart/form-data" action="<?php echo current_url() ?>">
                            <div class="form-group profile-pic-edit <?php echo (form_error('userfile'))?'has-error':'' ;?>">
                                <?php
                                    if(isset($user_detail->profile_pic) && !empty($user_detail->profile_pic)){
                                       $img = base_url('uploads/user-pic/'.$user_detail->profile_pic); 
                                       $filename = $user_detail->profile_pic;
                                    }else{
                                       $img = "//placehold.it/100";
                                       $filename = "";
                                    }
                                ?>
                                <label for="">Select Profile Photo</label><br/>
                                <img src="<?php echo $img; ?>" class="" alt="avatar">
                                <input class="" name="userfile" id="userfile" type="file">
                                <input type="hidden" value="<?php echo isset($user_detail->profile_pic) ? $user_detail->profile_pic : ''; ?>" name="profile_pic" id="profile_pic" />
                                    <span class="help-block <?php echo ($file_error)?'has-error':'' ;?>"><?php if($file_error): echo $file_error; endif; ?></span>
                                    <?php echo form_error('userfile'); ?>
                             </div>
                            
                            <div class="form-group <?php echo (form_error('dob'))?'has-error':'' ;?>">
                                <label for="">Date of birth</label>
                                <input  placeholder="Date of birth" class="date form-control" name="dob" id="dob" value="<?php echo set_value('dob') ? set_value('dob') : (isset($user_detail->dob) ? date("d/m/Y",strtotime($user_detail->dob)) : ''); ?>" type="text">
                                <?php echo form_error('dob'); ?>
                            </div>
                            
                            <div class="form-group <?php echo (form_error('first_name'))?'has-error':'' ;?>">
                                <label for="">First name</label>
                                <input class="form-control" name="first_name" id="first_name" value="<?php echo set_value('first_name') ? set_value('first_name') : (isset($user_detail->first_name) ? $user_detail->first_name : ''); ?>" type="text">
                                <?php echo form_error('first_name'); ?>
                            </div>

                            <div class="form-group <?php echo (form_error('last_name'))?'has-error':'' ;?>">
                                <label for="">Last name</label>
                                <input class="form-control" name="last_name" id="last_name" value="<?php echo set_value('last_name') ? set_value('last_name') : (isset($user_detail->last_name) ? $user_detail->last_name : ''); ?>" type="text">
                                <?php echo form_error('last_name'); ?>
                            </div>

                            <div class="form-group <?php echo (form_error('email'))?'has-error':'' ;?>">
                                <label for="">Email</label>
                                <input class="form-control" name="email" id="email" value="<?php echo set_value('email') ? set_value('email') : (isset($user_detail->email) ? $user_detail->email : ''); ?>" type="text">
                                <?php echo form_error('email'); ?>
                            </div>

                            <div class="form-group <?php echo (form_error('username'))?'has-error':'' ;?>">
                                <label for="">Username</label>
                                <input class="form-control" name="username" id="username" value="<?php echo set_value('username') ? set_value('username') : (isset($user_detail->username) ? $user_detail->username : ''); ?>" type="text" readonly>
                                <?php echo form_error('username'); ?>
                            </div>
                            
                            <div class="form-group <?php echo (form_error('gender'))?'has-error':'' ;?>">
                                <label for="">Gender</label>
                                <select class="form-control" name="gender" id="gender" class="form-control">
                                    <option value="1" <?php if(isset($user_detail->gender) && $user_detail->gender == 1) { ?>selected="selected" <?php } ?>>Male</option>
                                    <option value="2" <?php if(isset($user_detail->gender) && $user_detail->gender == 2) { ?>selected="selected" <?php } ?>>Female</option>
                                    <option value="3" <?php if(isset($user_detail->gender) && $user_detail->gender == 3) { ?>selected="selected" <?php } ?>>Other</option>
                                </select>
                                <?php echo form_error('gender'); ?>
                            </div>
                            
                            <div class="form-group <?php echo (form_error('about_me'))?'has-error':'' ;?>">
                                <label for="">About Me</label>
                                <textarea name="tips" class="form-control" id="about_me" name="about_me" rows="5"><?php echo set_value('about_me') ? set_value('about_me') : (isset($user_detail->about_me) ? $user_detail->about_me  : ''); ?></textarea>
                                <span class="help-block"></span>
                                <?php echo form_error('about_me'); ?>
                            </div>
                            
                            <div class="form-group <?php echo (form_error('language'))?'has-error':'' ;?>">
                                <label for="">Language</label>
                                <input class="form-control" name="language" id="profession" value="<?php echo set_value('language') ? set_value('language') : (isset($user_detail->profession) ? $user_detail->language  : ''); ?>" placeholder="Please enter your language" type="text">
                                <?php echo form_error('language'); ?>
                            </div>
                            
                            
                            <div class="form-group <?php echo (form_error('profession'))?'has-error':'' ;?>">
                                <label for="">Profession</label>
                                <input class="form-control" name="profession" id="profession" value="<?php echo set_value('profession') ? set_value('profession') : (isset($user_detail->profession) ? $user_detail->profession : ''); ?>" placeholder="Please enter your profession" type="text">
                                <?php echo form_error('profession'); ?>
                            </div>
                            
                            <div class="form-group <?php echo (form_error('location'))?'has-error':'' ;?>">
                                <label for="">Location</label>
                                <input class="form-control" name="location" id="location" value="<?php echo set_value('location') ? set_value('location') : (isset($user_detail->location) ? $user_detail->location : ''); ?>" placeholder="Please enter your location" type="text">
                                <input type="hidden" name="lat" id="lat" value="<?php echo set_value('lat') ? set_value('lat') : (isset($user_detail->lat) ? $user_detail->lat : ''); ?>" />
                                <input type="hidden" name="long" id="long" value="<?php echo set_value('long') ? set_value('long') : (isset($user_detail->long) ? $user_detail->long : ''); ?>" />
                                <?php echo form_error('location'); ?>
                            </div>
                            
                            <div class="form-group <?php echo (form_error('travel_with'))?'has-error':'' ;?>">
                                <label for="">Travel With</label>
                                <select class="form-control" name="travel_with" id="travel_with" class="form-control">
                                    <option value="1" <?php if(isset($user_detail->travel_with) && $user_detail->travel_with == 1) { ?>selected="selected" <?php } ?>>Alone</option>
                                    <option value="2" <?php if(isset($user_detail->travel_with) && $user_detail->travel_with == 2) { ?>selected="selected" <?php } ?>>Family</option>
                                    <option value="3" <?php if(isset($user_detail->travel_with) && $user_detail->travel_with == 3) { ?>selected="selected" <?php } ?>>Friends</option>
                                    <option value="4" <?php if(isset($user_detail->travel_with) && $user_detail->travel_with == 4) { ?>selected="selected" <?php } ?>>Office Members</option>
                                    <option value="5" <?php if(isset($user_detail->travel_with) && $user_detail->travel_with == 5) { ?>selected="selected" <?php } ?>>Colleague</option>
                                </select>
                                <?php echo form_error('travel_with'); ?>
                            </div>
                            
                            <div class="form-group <?php echo (form_error('travelling'))?'has-error':'' ;?>">
                                <label for="">I have travel</label>
                                <select class="form-control" name="travelling" id="travelling" class="form-control">
                                    <option value="1" <?php if(isset($user_detail->travelling) && $user_detail->travelling == 1) { ?>selected="selected" <?php } ?>>Alone</option>
                                    <option value="2" <?php if(isset($user_detail->travelling) && $user_detail->travelling == 2) { ?>selected="selected" <?php } ?>>Together</option>
                                </select>
                                <?php echo form_error('travelling'); ?>
                            </div>
                            
                            <div class="form-group text-center">
                                <button type="submit" class="edit-profile btn btn-primary"> &nbsp; &nbsp;  Save Changes &nbsp; &nbsp; </button>
                            </div>
                        </form>
                </div>
            </div>
            <!--===================================================-->
            <!-- End Striped Table -->

        </div>
        <!--===================================================-->
        <!--End page content-->


    </div>
    <!--===================================================-->
    <!--END CONTENT CONTAINER-->



    <!--END CONTENT CONTAINER-->
    <?php
    $sidebar_data = array("trip_count" => $today_count);
    $sidebar_data["dashboard"] = $dashboard;
    $this->load->view('admin/sidebar', $sidebar_data);
    ?>


</div>



<!-- FOOTER -->
<!--===================================================-->
<footer id="footer">

    <!-- Visible when footer positions are fixed -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="show-fixed pull-right">
        <ul class="footer-list list-inline">
            <li>
                <p class="text-sm">SEO Proggres</p>
                <div class="progress progress-sm progress-light-base">
                    <div style="width: 80%" class="progress-bar progress-bar-danger"></div>
                </div>
            </li>

            <li>
                <p class="text-sm">Online Tutorial</p>
                <div class="progress progress-sm progress-light-base">
                    <div style="width: 80%" class="progress-bar progress-bar-primary"></div>
                </div>
            </li>
            <li>
                <button class="btn btn-sm btn-dark btn-active-success">Checkout</button>
            </li>
        </ul>
    </div>



    <!-- Visible when footer positions are static -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="hide-fixed pull-right pad-rgt">Currently v2.3</div>



    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- Remove the class name "show-fixed" and "hide-fixed" to make the content always appears. -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

    <p class="pad-lft">&#0169; 2015 Your Company</p>
</footer>
<!--===================================================-->
<!-- END FOOTER -->
<!--===================================================-->
<!-- END OF CONTAINER -->

<!-- SETTINGS - DEMO PURPOSE ONLY -->
<!--===================================================-->
<div id="demo-set" class="demo-set">
    <div class="demo-set-body bg-dark">
        <div id="demo-set-alert"></div>
        <div class="demo-set-content clearfix">
            <div class="col-xs-6 col-md-4">
                <h4 class="text-lg mar-btm">Animations</h4>
                <div id="demo-anim" class="mar-btm">
                    <label class="form-checkbox form-icon active">
                        <input type="checkbox" checked=""> Enable Animations
                    </label>
                </div>
                <p>Transition effects</p>
                <select id="demo-ease">
                    <option value="effect" selected>ease (Default)</option>
                    <option value="easeInQuart">easeInQuart</option>
                    <option value="easeOutQuart">easeOutQuart</option>
                    <option value="easeInBack">easeInBack</option>
                    <option value="easeOutBack">easeOutBack</option>
                    <option value="easeInOutBack">easeInOutBack</option>
                    <option value="steps">Steps</option>
                    <option value="jumping">Jumping</option>
                    <option value="rubber">Rubber</option>
                </select>
                <hr class="bord-no">
                <br>
                <h4 class="text-lg mar-btm">Navigation</h4>
                <div class="mar-btm">
                    <label id="demo-nav-fixed" class="form-checkbox form-icon">
                        <input type="checkbox"> Fixed
                    </label>
                </div>
                <label id="demo-nav-coll" class="form-checkbox form-icon">
                    <input type="checkbox"> Collapsed
                </label>
                <hr class="bord-no">
                <br>
                <h4 class="text-lg mar-btm">Off Canvas Navigation</h4>
                <select id="demo-nav-offcanvas">
                    <option value="none" selected disabled="disabled">-- Select Mode --</option>
                    <option value="push">Push</option>
                    <option value="slide">Slide in on top</option>
                    <option value="reveal">Reveal</option>
                </select>
            </div>
            <div class="col-xs-6 col-md-3">
                <h4 class="text-lg mar-btm">Aside</h4>
                <div class="form-block">
                    <label id="demo-asd-vis" class="form-checkbox form-icon">
                        <input type="checkbox"> Visible
                    </label>
                    <label id="demo-asd-fixed" class="form-checkbox form-icon">
                        <input type="checkbox"> Fixed
                    </label>
                    <label id="demo-asd-align" class="form-checkbox form-icon">
                        <input type="checkbox"> Aside on the left side
                    </label>
                    <label id="demo-asd-themes" class="form-checkbox form-icon">
                        <input type="checkbox"> Bright Theme
                    </label>
                </div>
                <hr class="bord-no">
                <br>
                <h4 class="text-lg mar-btm">Header / Navbar</h4>
                <label id="demo-navbar-fixed" class="form-checkbox form-icon">
                    <input type="checkbox"> Fixed
                </label>
                <hr class="bord-no">
                <br>
                <h4 class="text-lg mar-btm">Footer</h4>
                <label id="demo-footer-fixed" class="form-checkbox form-icon">
                    <input type="checkbox"> Fixed
                </label>
            </div>
            <div class="col-xs-12 col-md-5">
                <div id="demo-theme">
                    <h4 class="text-lg mar-btm">Color Themes</h4>
                    <div class="demo-theme-btn">
                        <a href="#" class="demo-theme demo-a-light add-tooltip" data-theme="theme-light" data-type="a" data-title="(A). Light">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-a-navy add-tooltip" data-theme="theme-navy" data-type="a" data-title="(A). Navy Blue">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-a-ocean add-tooltip" data-theme="theme-ocean" data-type="a" data-title="(A). Ocean">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-a-lime add-tooltip" data-theme="theme-lime" data-type="a" data-title="(A). Lime">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-a-purple add-tooltip" data-theme="theme-purple" data-type="a" data-title="(A). Purple">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-a-dust add-tooltip" data-theme="theme-dust" data-type="a" data-title="(A). Dust">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-a-mint add-tooltip" data-theme="theme-mint" data-type="a" data-title="(A). Mint">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-a-yellow add-tooltip" data-theme="theme-yellow" data-type="a" data-title="(A). Yellow">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-a-well-red add-tooltip" data-theme="theme-well-red" data-type="a" data-title="(A). Well Red">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-a-coffee add-tooltip" data-theme="theme-coffee" data-type="a" data-title="(A). Coffee">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-a-prickly-pear add-tooltip" data-theme="theme-prickly-pear" data-type="a" data-title="(A). Prickly pear">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-a-dark add-tooltip" data-theme="theme-dark" data-type="a" data-title="(A). Dark">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                    </div>
                    <div class="demo-theme-btn">
                        <a href="#" class="demo-theme demo-b-light add-tooltip" data-theme="theme-light" data-type="b" data-title="(B). Light">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-b-navy add-tooltip" data-theme="theme-navy" data-type="b" data-title="(B). Navy Blue">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-b-ocean add-tooltip" data-theme="theme-ocean" data-type="b" data-title="(B). Ocean">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-b-lime add-tooltip" data-theme="theme-lime" data-type="b" data-title="(B). Lime">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-b-purple add-tooltip" data-theme="theme-purple" data-type="b" data-title="(B). Purple">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-b-dust add-tooltip" data-theme="theme-dust" data-type="b" data-title="(B). Dust">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-b-mint add-tooltip" data-theme="theme-mint" data-type="b" data-title="(B). Mint">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-b-yellow add-tooltip" data-theme="theme-yellow" data-type="b" data-title="(B). Yellow">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-b-well-red add-tooltip" data-theme="theme-well-red" data-type="b" data-title="(B). Well red">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-b-coffee add-tooltip" data-theme="theme-coffee" data-type="b" data-title="(B). Coofee">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-b-prickly-pear add-tooltip" data-theme="theme-prickly-pear" data-type="b" data-title="(B). Prickly pear">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-b-dark add-tooltip" data-theme="theme-dark" data-type="b" data-title="(B). Dark">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                    </div>
                    <div class="demo-theme-btn">
                        <a href="#" class="demo-theme demo-c-light add-tooltip" data-theme="theme-light" data-type="c" data-title="(C). Light">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-c-navy add-tooltip" data-theme="theme-navy" data-type="c" data-title="(C). Navy Blue">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-c-ocean add-tooltip" data-theme="theme-ocean" data-type="c" data-title="(C). Ocean">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-c-lime add-tooltip" data-theme="theme-lime" data-type="c" data-title="(C). Lime">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-c-purple add-tooltip" data-theme="theme-purple" data-type="c" data-title="(C). Purple">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-c-dust add-tooltip" data-theme="theme-dust" data-type="c" data-title="(C). Dust">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-c-mint add-tooltip" data-theme="theme-mint" data-type="c" data-title="(C). Mint">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-c-yellow add-tooltip" data-theme="theme-yellow" data-type="c" data-title="(C). Yellow">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-c-well-red add-tooltip" data-theme="theme-well-red" data-type="c" data-title="(C). Well Red">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-c-coffee add-tooltip" data-theme="theme-coffee" data-type="c" data-title="(C). Coffee">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-c-prickly-pear add-tooltip" data-theme="theme-prickly-pear" data-type="c" data-title="(C). Prickly pear">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                        <a href="#" class="demo-theme demo-c-dark add-tooltip" data-theme="theme-dark" data-type="c" data-title="(C). Dark">
                            <div class="demo-theme-brand"></div>
                            <div class="demo-theme-head"></div>
                            <div class="demo-theme-nav"></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="pad-all text-left">
            <hr class="hr-sm">
            <p class="demo-set-save-text">* All settings will be saved automatically.</p>
            <button id="demo-reset-settings" class="btn btn-primary btn-labeled fa fa-refresh mar-btm">Restore Default Settings</button>
        </div>
    </div>
    <button id="demo-set-btn" class="btn btn-sm"><i class="fa fa-cog fa-2x"></i></button>
</div>
<!--===================================================-->
<!-- END SETTINGS -->


<!--JAVASCRIPT-->
<!--=================================================-->

<!--jQuery [ REQUIRED ]-->
<script src="<?php echo base_url(); ?>assets/admin/js/jquery-2.1.1.min.js"></script>


<!--BootstrapJS [ RECOMMENDED ]-->
<script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>


<!--Fast Click [ OPTIONAL ]-->
<script src="<?php echo base_url(); ?>assets/admin/plugins/fast-click/fastclick.min.js"></script>


<!--Nifty Admin [ RECOMMENDED ]-->
<script src="<?php echo base_url(); ?>assets/admin/js/nifty.min.js"></script>


<!--Switchery [ OPTIONAL ]-->
<script src="<?php echo base_url(); ?>assets/admin/plugins/switchery/switchery.min.js"></script>


<!--Bootstrap Select [ OPTIONAL ]-->
<script src="<?php echo base_url(); ?>assets/admin/plugins/bootstrap-select/bootstrap-select.min.js"></script>


<!--DataTables [ OPTIONAL ]-->
<script src="<?php echo base_url(); ?>assets/admin/plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>


<!--Demo script [ DEMONSTRATION ]-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyB1a2NAsRAQICTnCaOZa6wFPgNBRz4rOXM&sensor=false&amp;libraries=places"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/demo/nifty-demo.min.js"></script>
<script>
    $(document).ready(function() {
    $("#dob").datepicker({
        dateFormat: 'dd/mm/yy',
    });
    $("#location")
        .geocomplete()
        .bind("geocode:result", function (event, result) {                      
        $("#lat").val(result.geometry.location.lat());
        $("#long").val(result.geometry.location.lng());
        //console.log(result);
    });
    
    $("#userfile").on('change', function () {
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            var error = "Only "+fileExtension.join(', ')+"formats are allowed.";
            $(this).closest("div.text-center").find("span.help-block").text(error);
        }else{
            readURL(this);
            $(this).closest("div.text-center").find("span.help-block").text("");
        }
    });
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#userfile").closest("div.text-center").find("span.filename").text("");
                $("#userfile").closest("div.text-center").find("img").attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
</body>

<!-- Mirrored from www.themeon.net/nifty/v2.3/tables-datatable.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 12 Apr 2016 05:38:49 GMT -->
</html>