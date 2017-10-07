<div class="boxed">
    <!--CONTENT CONTAINER-->
    <!--===================================================-->
    <div id="content-container">
        <!--Page content-->
        <!--===================================================-->
        <?php
            $success = $this->session->flashdata('msg_success');
            $error = $this->session->flashdata('msg_error');
        ?>
        <?php if(!empty($success)) { echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><b>'.$success.'</b></div>'; } ?>
        <?php if(!empty($error)) { echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><b>'.$error.'</b></div>'; } ?>
        <div id="page-content">
          <div class="col-lg-12">
            <div class="row">
              <div class="panel panel-success">
          
                <!--Panel heading-->
                <div class="panel-heading">
                  <div class="panel-control">
                    <ul class="nav nav-tabs">
                      <li class="active">
                        <a data-toggle="tab" href="#demo-tabs2-box-1" aria-expanded="true">
                         General  Settings
                        </a>
                      </li>
                      <li class="">
                        <a data-toggle="tab" href="#demo-tabs2-box-2" aria-expanded="false">
                          Social
                        </a>
                      </li>
                    </ul>
                  </div>
                  <h3 class="panel-title"><i class="fa fa-wrench fa-fw fa-lg"></i> Settings</h3>
                </div>
          
                <!--Panel Body-->
                <div class="panel-body">
                  <div class="tab-content">
                    <div id="demo-tabs2-box-1" class="tab-pane fade active in">
                      <form class="form-horizontal" action="<?php echo base_url('admin/save_general_settings'); ?>" method="post" enctype="multipart/form-data" >
                        <div class="form-group">
                            <label class="control-label"  for="username">Name</label>
                            <div class="controls">
                                <?php
                                $data = array(
                                    'name' => 'site_name',
                                    'id' => 'site_name',
                                    'value' => set_value('site_name') ? set_value('site_name') : (isset($SETTINGS['site_name']) ? $SETTINGS['site_name'] : ''),
                                    'placeholder' => 'Enter Name',
                                    'class' => 'form-control'
                                );

                                echo form_input($data);
                                ?>

                            </div>    
                        </div>

                        <div class="form-group <?php echo (form_error('site_email'))?'has-error':'' ;?>">
                            <label class="control-label"  for="username">Email</label>
                            <div class="controls">
                                <?php
                                $data = array(
                                    'name' => 'site_email',
                                    'id' => 'site_email',
                                    'value' => set_value('site_email') ? set_value('site_email') : (isset($SETTINGS['site_email']) ? $SETTINGS['site_email'] : ''),
                                    'placeholder' => 'Enter Email',
                                    'class' => 'form-control'
                                );

                                echo form_input($data);
                                ?>
                                <?php echo form_error('site_email'); ?>
                            </div>    
                        </div>

                        <div class="form-group">
                            <label class="control-label"  for="username">Phone</label>
                            <div class="controls">
                                <?php
                                $data = array(
                                    'name' => 'site_phone',
                                    'id' => 'site_phone',
                                    'value' => set_value('site_phone') ? set_value('site_phone') : (isset($SETTINGS['site_phone']) ? $SETTINGS['site_phone'] : ''),
                                    'placeholder' => 'Enter Phone Number',
                                    'class' => 'form-control'
                                );

                                echo form_input($data);
                                ?>

                            </div>    
                        </div>
                        <div class="form-group">
                            <label class="control-label"  for="username">Mobile</label>
                            <div class="controls">
                                <?php
                                $data = array(
                                    'name' => 'site_mobile',
                                    'id' => 'site_mobile',
                                    'value' => set_value('site_mobile') ? set_value('site_mobile') : (isset($SETTINGS['site_mobile']) ? $SETTINGS['site_mobile'] : ''),
                                    'placeholder' => 'Enter Mobile Number',
                                    'class' => 'form-control'
                                );

                                echo form_input($data);
                                ?>

                            </div>    
                        </div>
                        <div class="form-group">
                            <label class="control-label"  for="username">Fax</label>
                            <div class="controls">
                                <?php
                                $data = array(
                                    'name' => 'site_fax',
                                    'id' => 'site_fax',
                                    'value' => set_value('site_fax') ? set_value('site_fax') : (isset($SETTINGS['site_fax']) ? $SETTINGS['site_fax'] : ''),
                                    'placeholder' => 'Enter Fax Number',
                                    'class' => 'form-control'
                                );

                                echo form_input($data);
                                ?>

                            </div>    
                        </div>

                        <div class="form-group">
                            <label class="control-label"  for="username">Address</label>
                            <div class="controls">
                                <?php
                                $data = array(
                                    'name' => 'site_address',
                                    'id' => 'site_address',
                                    'value' => set_value('site_address') ? set_value('site_address') : (isset($SETTINGS['site_address']) ? $SETTINGS['site_address'] : ''),
                                    'placeholder' => 'Enter Address',
                                    'class' => 'form-control',
                                    'rows' => '4'
                                );

                                echo form_textarea($data);
                                ?>

                            </div>    
                        </div>
                        <div class="form-group">
                            <label class="control-label"  for="site_keywords">Meta Keywords</label>
                            <div class="controls">
                                <?php
                                $data = array(
                                    'name' => 'site_keywords',
                                    'id' => 'site_keywords',
                                    'value' => set_value('site_keywords') ? set_value('site_keywords') : (isset($SETTINGS['site_keywords']) ? $SETTINGS['site_keywords'] : ''),
                                    'placeholder' => 'Enter Site Keywords',
                                    'class' => 'form-control',
                                    'rows' => '4'
                                );

                                echo form_textarea($data);
                                ?>

                            </div>    
                        </div>
                        <div class="form-group">
                            <label class="control-label"  for="site_meta_desc">Meta Description</label>
                            <div class="controls">
                                <?php
                                $data = array(
                                    'name' => 'site_meta_desc',
                                    'id' => 'site_meta_desc',
                                    'value' => set_value('site_meta_desc') ? set_value('site_meta_desc') : (isset($SETTINGS['site_meta_desc']) ? $SETTINGS['site_meta_desc'] : ''),
                                    'placeholder' => 'Enter Meta Description',
                                    'class' => 'form-control',
                                    'rows' => '4'
                                );

                                echo form_textarea($data);
                                ?>

                            </div>    
                        </div>

                        <div class="form-group <?php echo (form_error('admin_email'))?'has-error':'' ;?>">
                            <label class="control-label"  for="username">Admin Email</label>
                            <div class="controls">
                                <?php
                                $data = array(
                                    'name' => 'admin_email',
                                    'id' => 'admin_email',
                                    'value' => set_value('admin_email') ? set_value('admin_email') : (isset($SETTINGS['admin_email']) ? $SETTINGS['admin_email'] : ''),
                                    'maxlength' => '100',
                                    'size' => '50',
                                    'placeholder' => 'Enter Admin Email',
                                    'class' => 'form-control'
                                );

                                echo form_input($data);
                                ?>
                              <?php echo form_error('admin_email'); ?>
                            </div>    
                        </div>

                        <div class="form-group"> 
                            <label class="control-label"  for="username">Welcome Text </label>
                            <div class="controls"> 
                                <?php
                                $data = array('name' => 'welcome_text',
                                    'id' => 'welcome_text',
                                    'value' => set_value('welcome_text') ? set_value('welcome_text') : (isset($SETTINGS['welcome_text']) ? $SETTINGS['welcome_text'] : ''),
                                    'class' => 'form-control ckeditor',
                                    'rows' => '4');
                                echo form_textarea($data);
                                ?>
                            </div> 
                        </div> 
                        <div class="form-group"> 
                            <label class="control-label"  for="aboutus_text">About Us Short Text </label>
                            <div class="controls"> 
                                <?php
                                $data = array('name' => 'aboutus_text',
                                    'id' => 'aboutus_text',
                                    'value' => set_value('aboutus_text') ? set_value('aboutus_text') : (isset($SETTINGS['aboutus_text']) ? $SETTINGS['aboutus_text'] : ''),
                                    'class' => 'form-control',
                                    'rows' => '4');
                                echo form_textarea($data);
                                ?>
                            </div> 
                        </div> 



                        <div class="form-group <?php echo (form_error('noreply_email'))?'has-error':'' ;?>">
                            <label class="control-label"  for="username">No Reply Email</label>
                            <div class="controls">
                                <?php
                                $data = array(
                                    'name' => 'noreply_email',
                                    'id' => 'noreply_email',
                                    'value' => set_value('noreply_email') ? set_value('noreply_email') : (isset($SETTINGS['noreply_email']) ? $SETTINGS['noreply_email'] : ''),
                                    'maxlength' => '100',
                                    'size' => '50',
                                    'placeholder' => 'Enter No-Reply Email',
                                    'class' => 'form-control'
                                );

                                echo form_input($data);
                                ?>
                              <?php echo form_error('noreply_email'); ?>
                            </div>    
                        </div>
                        <div class="form-group">
                            <label class="control-label"  for="username">Copy Right </label>
                            <div class="controls">
                                <?php
                                $data = array(
                                    'name' => 'copyright',
                                    'id' => 'copyright',
                                    'value' => set_value('copyright') ? set_value('copyright') : (isset($SETTINGS['copyright']) ? $SETTINGS['copyright'] : ''),
                                    'placeholder' => 'Enter Copyright',
                                    'class' => 'form-control'
                                );

                                echo form_input($data);
                                ?>

                            </div>    
                        </div>
                        <div class="form-group">
                            <label class="control-label"  for="username">Upload Logo</label>
                            <?php
                            if (isset($SETTINGS['logo']) && $SETTINGS['logo'] != ''):
                                ?>
                                <div class="row">
                                    <div class="span2 " style="margin-bottom:10px;">
                                        <img src="<?php echo base_url() . 'uploads/logo/' . $SETTINGS['logo'] ?>" class="img-thumbnail">
                                    </div>
                                </div>
                                <?php
                            endif;
                            ?>
                            <div class="controls">
                                <?php
                                $data = array(
                                    'name' => 'logo',
                                    'id' => 'logo',
                                    'value' => set_value('logo') ? set_value('logo') : (isset($SETTINGS['logo']) ? $SETTINGS['logo'] : ''),
                                    'class' => 'form-control'
                                );

                                echo form_upload($data);
                                ?>

                            </div>    
                        </div>
                        <div class="form-group">
                            <label class="control-label"  for="username">Upload Favicon</label>
                            <?php
                            if (isset($SETTINGS['favicon']) && $SETTINGS['favicon'] != ''):
                                ?>
                                <div class="row">
                                    <div class="span2 " style="margin-bottom:10px;">
                                        <img src="<?php echo base_url() . 'uploads/logo/' . $SETTINGS['favicon'] ?>" class="img-thumbnail">
                                    </div>
                                </div>
                                <?php
                            endif;
                            ?>
                            <div class="controls">
                                <?php
                                $data = array(
                                    'name' => 'favicon',
                                    'id' => 'favicon',
                                    'value' => set_value('favicon') ? set_value('favicon') : (isset($SETTINGS['favicon']) ? $SETTINGS['favicon'] : ''),
                                    'class' => 'form-control'
                                );

                                echo form_upload($data);
                                ?>

                            </div>    
                        </div>
                        
                        <div class="form-group text-center">
                            <button type="submit" class="edit-profile btn btn-primary"> &nbsp; &nbsp;  Save General Settings &nbsp; &nbsp; </button>
                        </div>
                    </form>
                    </div>
                    <div id="demo-tabs2-box-2" class="tab-pane fade">
                      <form class="form-horizontal" action="<?php echo base_url('admin/save_social_settings') ?>" method="post">
                          <div class="form-group">
                              <label class="control-label" for="username">Facebook Page Url </label>
                              <div class="controls">
                                  <?php
                                  $data = array(
                                      'name' => 'fb_url',
                                      'id' => 'fb_url',
                                      'value' => set_value('fb_url') ? set_value('fb_url') : (isset($SETTINGS['fb_url']) ? $SETTINGS['fb_url'] : ''),
                                      'placeholder' => 'Enter Facebook Page Url',
                                      'class' => 'form-control'
                                  );

                                echo form_input($data);
                                ?>
                              </div>    
                          </div>
                          <div class="form-group">
                              <label class="control-label" for="username">Twitter Page Url </label>
                              <div class="controls">
                                  <?php
                                    $data = array(
                                        'name' => 'twitter_url',
                                        'id' => 'twitter_url',
                                        'value' => set_value('twitter_url') ? set_value('twitter_url') : (isset($SETTINGS['twitter_url']) ? $SETTINGS['twitter_url'] : ''),
                                        'placeholder' => 'Enter Twitter Page Url',
                                        'class' => 'form-control'
                                    );

                                    echo form_input($data);
                                ?>
                              </div>    
                          </div>
                          <div class="form-group">
                              <label class="control-label" for="username">Linked In Page Url </label>
                              <div class="controls">
                                  <?php
                                    $data = array(
                                        'name' => 'linkedin_url',
                                        'id' => 'linkedin_url',
                                        'value' => set_value('linkedin_url') ? set_value('linkedin_url') : (isset($SETTINGS['linkedin_url']) ? $SETTINGS['linkedin_url'] : ''),
                                        'placeholder' => 'Enter Linked In Url',
                                        'class' => 'form-control'
                                    );

                                    echo form_input($data);
                                ?>
                              </div>    
                          </div>

                          <div class="form-group">
                              <label class="control-label" for="username">Google Plus Page Url </label>
                              <div class="controls">
                                  <?php
                                  $data = array(
                                      'name' => 'gplus_url',
                                      'id' => 'gplus_url',
                                      'value' => set_value('gplus_url') ? set_value('gplus_url') : (isset($SETTINGS['gplus_url']) ? $SETTINGS['gplus_url'] : ''),
                                      'placeholder' => 'Enter Google Plus Page Url',
                                      'class' => 'form-control'
                                  );
                                  echo form_input($data);
                                ?>
                              </div>    
                          </div>

                          <div class="form-group text-center">
                              <button type="submit" class="edit-profile btn btn-primary"> &nbsp; &nbsp;  Save Social Settings &nbsp; &nbsp; </button>
                          </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--===================================================-->
        <!--End page content-->


    </div>
    <!--===================================================-->
    <!--END CONTENT CONTAINER-->



    <!--END CONTENT CONTAINER-->
    <?php
    $sidebar_data = array("trip_count" => $today_count);
    $sidebar_data["settings"] = $settings;
    $this->load->view('admin/sidebar', $sidebar_data);
    ?>


</div>

<!--===================================================-->
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
<script src="<?php echo base_url(); ?>assets/admin/js/demo/nifty-demo.min.js"></script>
<!--Panel [ SAMPLE ]-->
    <script src="<?php echo base_url(); ?>assets/admin/js/demo/ui-panels.js"></script>
</body>

<!-- Mirrored from www.themeon.net/nifty/v2.3/tables-datatable.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 12 Apr 2016 05:38:49 GMT -->
</html>                                                                                                                                                                                                                                                                                                                          