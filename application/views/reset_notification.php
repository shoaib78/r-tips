<?php if ($this->session->userdata('is_login')): ?>
        <?php if (isset($message_count) && $message_count > 0) { ?>
            <a href="<?php echo base_url("home/message") ?>" >
                <div id="message-count-pin" class="message-count icon-status  hidden-xs">
                    <span class="value"><?php echo $message_count ?></span>
                    <span class="value_icon"> <i class="fa fa-comment"> </i></span>   
                </div>
            </a>
        <?php } else { ?>
            <div id="message-count-pin" class="message-count icon-status  hidden-xs">
                <span class="value"> 0</span>
                <span class="value_icon"> <i class="fa fa-comment"> </i></span>   
            </div>
        <?php } ?>

        <div id="alert-count-pin" class="icon-status alert-count  hidden-xs">
            <span class="value"> 0</span>
            <span class="value_icon"> <i class="fa fa-bell"> </i></span>  
        </div>
        <!-- show notifications -->
        <div id="show_notification" class="dropdown-menu dropdown-menu-md">
            <div class="pad-all bord-btm">
                <p class="text-lg text-muted text-semibold mar-no">You have 9 notifications.</p>
            </div>
            <div class="nano scrollable has-scrollbar">
                <div class="nano-content">
                    <ul class="head-list">
                        <li>
                            <a href="#" class="media">
                                <div class="media-left">
                                    <span class="icon-wrap icon-circle bg-danger">
                                        <i class="fa fa-hdd-o fa-lg"></i>
                                    </span>
                                </div>
                                <div class="media-body">
                                    <div class="text-nowrap">Lorem Ipsum</div>
                                    <small class="text-muted">50 minutes ago</small>
                                </div>
                            </a>
                        </li>

                        <!-- Dropdown list-->
                        <li>
                            <a href="#" class="media">
                                <div class="media-left">
                                    <span class="icon-wrap bg-info">
                                        <i class="fa fa-file-word-o fa-lg"></i>
                                    </span>
                                </div>
                                <div class="media-body">
                                    <div class="text-nowrap">Lorem Ipsum is dummy text</div>
                                    <small class="text-muted">Last Update 8 hours ago</small>
                                </div>
                            </a>
                        </li>

                        <!-- Dropdown list-->
                        <li>
                            <a href="#" class="media">
                                <div class="media-left">
                                    <span class="icon-wrap bg-purple">
                                        <i class="fa fa-comment fa-lg"></i>
                                    </span>
                                </div>
                                <div class="media-body">
                                    <div class="text-nowrap">Lorem Ipsum is dummy text</div>
                                    <small class="text-muted">Last Update 8 hours ago</small>
                                </div>
                            </a>
                        </li>

                        <!-- Dropdown list-->
                        <li>
                            <a href="#" class="media">
                                <div class="media-left">
                                    <span class="icon-wrap bg-success">
                                        <i class="fa fa-user fa-lg"></i>
                                    </span>
                                </div>
                                <div class="media-body">
                                    <div class="text-nowrap">Lorem Ipsum is dummy text</div>
                                    <small class="text-muted">4 minutes ago</small>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <!--Dropdown footer-->
            </div>
        </div>
        <!-- end show notifications -->
        <?php if (isset($wishlist_count) && $wishlist_count > 0) { ?>
            <div id="favtips-count-pin" class="icon-status favtips-count  hidden-xs">
                <a href="<?php echo base_url("trip/listings/wishlist") ?>" ><span class="value"><?php echo (isset($wishlist_count) && $wishlist_count > 0) ? $wishlist_count : 0; ?></span></a>
                <span class="value_icon"> <i class="fa fa-lightbulb-o"> </i></span>
            </div>
        <?php } else { ?>
            <div id="favtips-count-pin" class="icon-status favtips-count  hidden-xs">
                <span class="value">0</span>
                <span class="value_icon"> <i class="fa fa-lightbulb-o"> </i></span>
            </div>
        <?php } ?>


        <div id="favtipsloc-count-pin" class="icon-status avtipsloc-count  hidden-xs">
            <span class="value"> 0</span>
            <span class="value_icon"> <i class="fa fa-map-marker"> </i></span>   
        </div>

        <div class="icon-status profile-link " id="user-menu-pin">
            <figure class="user-picture">
                <span>
                    <?php if (isset($user_detail->profile_pic) && !empty($user_detail->profile_pic)): ?>
                        <img src="<?php echo base_url("uploads/user-pic/" . $user_detail->profile_pic); ?>">
                    <?php else: ?>
                        <img src="<?php echo base_url("assets/images/default_avatar.png"); ?>">
                    <?php endif; ?>
                </span>
            </figure>
            <div class="name usr_drop" style="overflow:visible">
                <span><?php echo isset($user_detail->username) ? ucwords($user_detail->username) : ""; ?>&nbsp;<i class="fa fa-angle-down"></i></span>

            </div>
            <div class="usr_profile_modal" id="usr_drop">
                <ul class="dropdown-menu">
                    <li ><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li ><a href="<?php echo base_url("home/profile/" . $this->session->userdata('user_id')); ?>">My Profile</a></li>
                    <li ><a href="<?php echo base_url("home/edit_profile/"); ?>">Edit Profile</a></li>
                    <li><a href="<?php echo base_url("home/reset_password"); ?>">Reset Password</a></li>
                    <li><a href="<?php echo base_url("home/logout"); ?>">Logout</a></li>
                </ul>
            </div>
        </div>
        <div class="lanuages"><a href="#" class="active"><img src="<?php echo site_url(); ?>assets/images/en.png" /></a>  <a href="#"><img src="<?php echo site_url(); ?>assets/images/it.png" /></a></div>
<?php endif; ?>