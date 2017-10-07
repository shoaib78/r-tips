<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <meta property="og:url" content="http://tipsandgo.com"/>

    <meta property="og:type" content="website"/>

    <meta property="og:title" content="Tips and GO"/>

    <meta property="og:description" content="Trevalling"/>

    <meta property="og:image" content="<?php echo base_url(); ?>/assets/images/logo.png>"/>

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Tipsandgo</title>



    <!-- Bootstrap -->
    <link rel="shortcut icon" href="<?php echo base_url("assets/images/favicon.png"); ?>">

    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/responsive.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/bootstrap-datepicker.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/simple-line-icons.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,500,600,700,800,900" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script src="<?php echo base_url('assets/js/jquery.validate.min.js') ?>"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

</head>

<body>

<header>

    <!--==MOBILE_VIEW START==-->

         <div class="functional-bar mobile hidden-lg hidden-md <?php echo ($this->session->userdata('user_id')) ? 'menu-after' : 'menu-before'; ?>">

                    <?php if ($this->session->userdata('user_id')) { ?>

                        <a href="<?php echo base_url("home/message") ?>" title="Message Inbox">

                            <div id="message-count-pin" class="message-count icon-status ">

                                <span class="value"> <?php echo $message_count ?></span>

                                <span class="value_icon"> <i class="fa fa-comment"> </i></span>

                            </div>

                        </a>



                        <div id="alert-count-pin" class="notify icon-status alert-count">

                            <span class="value"> 0<?php //echo $notifications_count ?></span>

                            <span class="value_icon"> <i class="fa fa-bell"> </i></span>

                        </div>

                        <!-- show notifications -->



                        <div class="notify-popover popover bottom" id="noti-pop" data-toggle="popover">

                            <div class="arrow"></div>

                            <h3 class="popover-title">Notifications</h3>

                            <div class="popover-content">
                                <div class="nano scrollable has-scrollbar">
                                    <div class="nano-content">
                                        <ul class="head-list notifications_content">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- end show notifications -->

                        <a href="<?php echo base_url("trip/listings/wishlist") ?>" title="My Wishlist">

                            <div id="favtips-count-pin" class="icon-status favtips-count ">

                                <span class="value"><?php echo (isset($wishlist_count) && $wishlist_count > 0) ? $wishlist_count : 0; ?></span>

                                <span class="value_icon"> <i class="fa fa-star"> </i></span>

                            </div>

                        </a>



                        <a href="<?php echo base_url("home/user_wishtips/") ?>" title="My Live Tips">

                            <div id="favtipsloc-count-pin" class="icon-status avtipsloc-count">

                                <span class="value"><?php echo (isset($wishtip_count) && $wishtip_count > 0) ? $wishtip_count : 0; ?></span>

                                <span class="value_icon"> <i class="fa fa-map-marker"> </i></span>

                            </div>

                        </a>



                        <a href="<?php echo base_url("home/bookmark_wishtips/") ?>" title="My Saved Tips">

                            <div id="bookmark-count-pin" class="icon-status bookmark-count">

                                <span class="value"><?php echo (isset($bookmark_count) && $bookmark_count > 0) ? $bookmark_count : 0; ?></span>

                                <span class="value_icon"> <i class="fa fa-bookmark"> </i></span>

                            </div>

                        </a>



                        <div class="icon-status profile-link " id="user-menu-pin1">

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

                                <span><?php echo isset($user_detail->username) ? ucwords($user_detail->username) : ""; ?>

                                    &nbsp;<i class="fa fa-angle-down"></i></span>

                            </div>

                            <div class="usr_profile_modal" id="usr_drop">

                                <ul class="dropdown-menu">

                                    <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"aria-hidden="true"></i> Home</a></li>

                                    <li><a href="<?php echo base_url("home/profile/" . $this->session->userdata('user_id')); ?>">

                                    <i class="fa fa-user" aria-hidden="true"></i> My Profile</a></li>

                                    <li><a href="<?php echo base_url("home/edit_profile/"); ?>"><i

                                                    class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit

                                            Profile</a></li>

                                    <?php if (isset($message_count) && $message_count > 0) { ?>

                                        <li><a href="<?php echo base_url("home/message/"); ?>"><i class="fa fa-envelope"

                                                                                                  aria-hidden="true"></i>

                                                Message Inbox</a></li>

                                    <?php } ?>

                                    <li><a href="<?php echo base_url("home/advertisement/"); ?>"><i class="fa fa-bullhorn"

                                                                                              aria-hidden="true"></i>

                                            Advertisement</a></li>

                                    <li><a href="<?php echo base_url("home/reset_password"); ?>"><i class="fa fa-lock"

                                                                                                    aria-hidden="true"></i>

                                            Reset Password</a></li>

                                    <li><a href="<?php echo base_url("home/logout"); ?>"><i class="fa fa-sign-out"

                                                                                            aria-hidden="true"></i>

                                            Logout</a></li>

                                </ul>

                            </div>

                        </div>

                    <?php } else { ?>

                        <div class="login_signup_bar col-xs-12">

                            <a href="<?php echo base_url('login'); ?>"><i class="fa fa-sign-in"></i> Sign in</a><a

                                    href="<?php echo base_url('signup'); ?>"><i class="fa fa-user"></i> Sign up</a>

                        </div>

                        <div class="clear"></div>

                    <?php } ?>

                    <div class="lanuages"><a href="#" class="active"><img src="<?php echo site_url(); ?>assets/images/en.png"/></a> <a href="#"><img src="<?php echo site_url(); ?>assets/images/it.png"/></a>

                    </div>

         </div>  

    <!--==MOBILE _VIEW END==-->



    <nav class="navbar navbar-default navbar-static-top">

        <div class="container">

            <div class="navbar-header">

                <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse"

                        class="navbar-toggle collapsed" type="button">

                    <span class="sr-only">Toggle navigation</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                </button>

                <a href="<?php echo base_url(); ?>" class="navbar-brand">

                    <?php if (isset($SETTINGS['logo']) && $SETTINGS['logo'] != ''): ?>

                        <img class="img-responsive" src="<?php echo base_url('uploads/logo/' . $SETTINGS['logo']); ?>"

                             alt="logo">

                    <?php elseif (isset($SETTINGS['site_name']) && $SETTINGS['site_name'] != ''): ?>

                        <?php echo $SETTINGS['site_name'] ?>

                    <?php else: ?>

                        <img src="<?php echo base_url(); ?>/assets/images/logo.png">

                    <?php endif ?>

                </a>

            </div>

            <div class="navbar-collapse collapse" id="navbar">

                <ul class="nav navbar-nav under-line">

                    <li class="<?php echo (isset($page) && $page == "discoverall") ? 'active' : '' ?>"><a

                                href="<?php echo base_url("trip/listings/discoverall"); ?>">discover <strong>

                                tipsandgo </strong></a></li>

                    <li class="<?php echo (isset($page) && $page == "listing") ? 'active' : '' ?>"><a

                                href="<?php echo base_url('trip/listings'); ?>">find a <strong>trip</strong> </a></li>

                    <li class="<?php echo (isset($page) && $page == "trip") ? 'active' : '' ?>"><a

                                href="<?php echo base_url('trip'); ?>">list <strong> your adventure </strong> </a></li>

                </ul>

                

                <div class="functional-bar hidden-xs hidden-sm <?php echo ($this->session->userdata('user_id')) ? 'menu-after' : 'menu-before'; ?>">

                    <?php if ($this->session->userdata('user_id')) { ?>

                        <a href="<?php echo base_url("home/message") ?>" title="Message Inbox">

                            <div id="message-count-pin" class="message-count icon-status ">

                                <span class="value"> <?php echo $message_count ?></span>

                                <span class="value_icon"> <i class="fa fa-comment"> </i></span>

                            </div>

                        </a>



                        <div id="alert-count-pin" class="notify icon-status alert-count">

                            <span class="value"> 0<?php //echo $notifications_count ?></span>

                            <span class="value_icon"> <i class="fa fa-bell"> </i></span>

                        </div>

                        <!-- show notifications -->



                        <div class="notify-popover popover bottom" id="noti-pop" data-toggle="popover">

                            <div class="arrow"></div>

                            <h3 class="popover-title">Notifications</h3>

                            <div class="popover-content">

                                <div class="nano scrollable has-scrollbar">

                                    <div class="nano-content">

                                        <ul class="head-list notifications_content">



                                        </ul>

                                    </div>

                                </div>

                            </div>

                        </div>



                        <!-- end show notifications -->

                        <a href="<?php echo base_url("trip/listings/wishlist") ?>" title="My Wishlist">

                            <div id="favtips-count-pin" class="icon-status favtips-count ">

                                <span class="value"><?php echo (isset($wishlist_count) && $wishlist_count > 0) ? $wishlist_count : 0; ?></span>

                                <span class="value_icon"> <i class="fa fa-star"> </i></span>

                            </div>

                        </a>



                        <a href="<?php echo base_url("home/user_wishtips/") ?>" title="My Wishtips">

                            <div id="favtipsloc-count-pin" class="icon-status avtipsloc-count">

                                <span class="value"><?php echo (isset($wishtip_count) && $wishtip_count > 0) ? $wishtip_count : 0; ?></span>

                                <span class="value_icon"> <i class="fa fa-map-marker"> </i></span>

                            </div>

                        </a>



                        <a href="<?php echo base_url("home/bookmark_wishtips/") ?>" title="My Saved Tips">

                            <div id="bookmark-count-pin" class="icon-status bookmark-count">

                                <span class="value"><?php echo (isset($bookmark_count) && $bookmark_count > 0) ? $bookmark_count : 0; ?></span>

                                <span class="value_icon"> <i class="fa fa-bookmark"> </i></span>

                            </div>

                        </a>



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

                                <span>
                                <?php 
                                        if(isset($user_detail->username) && !empty($user_detail->username)):
                                        echo (strlen($user_detail->username) > 10) ? substr(ucwords(strtolower($user_detail->username)),0,10).'...' : ucwords(strtolower($user_detail->username));
                                        endif;
                                ?>

                                    &nbsp;<i class="fa fa-angle-down"></i></span>

                            </div>

                            <div class="usr_profile_modal" id="usr_drop">

                                <ul class="dropdown-menu">

                                    <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>

                                    <li>

                                        <a href="<?php echo base_url("home/profile/" . $this->session->userdata('user_id')); ?>">

                                            <i class="fa fa-user" aria-hidden="true"></i> My Profile</a></li>

                                    <li><a href="<?php echo base_url("home/edit_profile/"); ?>"><i

                                                    class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit

                                            Profile</a></li>

                                    <?php if (isset($message_count) && $message_count > 0) { ?>

                                        <li><a href="<?php echo base_url("home/message/"); ?>"><i class="fa fa-envelope"

                                                                                                  aria-hidden="true"></i>

                                                Message Inbox</a></li>

                                    <?php } ?>

                                    <li><a href="<?php echo base_url("home/advertisement/"); ?>"><i class="fa fa-bullhorn"

                                                                                              aria-hidden="true"></i>

                                            Advertisement</a></li>

                                    <li><a href="<?php echo base_url("home/reset_password"); ?>"><i class="fa fa-lock"

                                                                                                    aria-hidden="true"></i>

                                            Reset Password</a></li>

                                    <li><a href="<?php echo base_url("home/logout"); ?>"><i class="fa fa-sign-out"

                                                                                            aria-hidden="true"></i>

                                            Logout</a></li>

                                </ul>

                            </div>

                        </div>

                    <?php } else { ?>

                        <div class="login_signup_bar">

                            <a href="<?php echo base_url('login'); ?>"><i class="fa fa-sign-in"></i> Sign in</a><a

                                    href="<?php echo base_url('signup'); ?>"><i class="fa fa-user"></i> Sign up</a>

                        </div>

                        <div class="clear"></div>

                    <?php } ?>

                    <div class="lanuages"><a href="#" class="active"><img

                                    src="<?php echo site_url(); ?>assets/images/en.png"/></a> <a href="#"><img

                                    src="<?php echo site_url(); ?>assets/images/it.png"/></a></div>

                </div>

            </div><!--/.nav-collapse -->

        </div>

    </nav>



</header>

<script type="text/javascript">

    var track_page = 1; //track user scroll as page number, right now page number is 1

    <?php if($this->session->userdata('user_id')): ?>

    $(window).load(function () { //start after HTML, images have loaded



        var InfiniteRotator =

            {

                init: function () {

                    //initial fade-in time (in milliseconds)

                    var initialFadeIn = 1000;



                    //interval between items (in milliseconds)

                    var itemInterval = 5000;



                    //cross-fade time (in milliseconds)

                    var fadeTime = 2500;



                    //count number of items

                    var numberOfItems = $('.rotating-item').length;



                    //set current item

                    var currentItem = 0;



                    //show first item

                    $('.rotating-item').eq(currentItem).fadeIn(initialFadeIn);



                    //loop through the items

                    var infiniteLoop = setInterval(function () {

                        $('.rotating-item').eq(currentItem).fadeOut(fadeTime);



                        if (currentItem == numberOfItems - 1) {

                            currentItem = 0;

                        } else {

                            currentItem++;

                        }

                        $('.rotating-item').eq(currentItem).fadeIn(fadeTime);



                    }, itemInterval);

                }

            };



        InfiniteRotator.init();



    });

    <?php endif; ?>

    $(document).ready(function () {

        $('.notify').click(function() {

            $(this).next('div.notify-popover').fadeToggle("fast");

        });



        $("#user-menu-pin").hover(

            function () {

                $('.dropdown-menu', this).stop(true, true).fadeIn("fast");

                $(this).toggleClass('open');

            },

            function () {

                $('.dropdown-menu', this).stop(true, true).fadeOut("slow");

                $(this).toggleClass('open');

            });



        $("#user-menu-pin1").hover(

            function () {

                $('.dropdown-menu', this).stop(true, true).fadeIn("fast");

                $(this).toggleClass('open');

            },

            function () {

                $('.dropdown-menu', this).stop(true, true).fadeOut("slow");

                $(this).toggleClass('open');

            });



        $(document).on("click", "#loadmore", function (e) {

            e.preventDefault();

            var elem = $(this);

            var offset = elem.attr('data-offset');

            var objectId = elem.attr('objectId'), objType = elem.attr('objType'), acttype = elem.attr('acttype'), obj_parent_id = elem.attr('obj_parent_id');

            $.ajax({

                type: "POST",

                dataType: "json",

                data: {objectId: objectId, objType: objType, acttype: acttype, obj_parent_id: obj_parent_id},

                url: "<?php echo base_url("activity/getMoreCommentByID/") ?>" + offset,

                beforeSend: function () {

                    var loader = '<div class="text-center" id="loader" style="clear: both"><img src="<?php echo base_url('assets/images/filter-loader.gif') ?>" style="width:32px"></div>';

                    elem.before(loader);

                    elem.button('loading');

                },

                success: function (result) {

                    $('#loader').remove();

                    elem.button('reset');

                    if (parseInt(result.count) > 0) {

                        elem.closest("ul.review_list").find('.clearfix').before(result.content);

                        if (parseInt(result.count) < 5) {

                            elem.remove();

                        } else {

                            elem.attr('data-offset', parseInt(offset) + parseInt(result.count));

                        }

                    } else {

                        elem.text('No More Comment To Load');



                        setTimeout(function () {

                            elem.remove();

                        }, 1000);

                    }



                }

            });

        });



        $(document).on("click", "#loadmoreTip", function (e) {

            e.preventDefault();

            var elem = $(this);

            var location = elem.attr("data-location");

            var cat = elem.attr("data-cat");

            var user_id = elem.attr("data-id");

            var set = elem.attr("data-set");

            var bookmark = elem.attr("data-bookmark");

            if (set) {

                track_page = 1;

            }

            $.ajax({

                type: "POST",

                dataType: "json",

                data: {user_id: user_id, location: location, category: cat, bookmark: bookmark},

                url: "<?php echo base_url("home/more_wishtips/") ?>" + track_page,

                beforeSend: function () {

                    var loader = '<div class="text-center" id="loader" style="clear: both"><img src="<?php echo base_url('assets/images/filter-loader.gif') ?>" style="width:32px"></div>';

                    elem.before(loader);

                    elem.button('loading');

                },

                success: function (result) {

                    $('#loader').remove();

                    elem.button('reset');

                    if (parseInt(result.count) > 0) {

                        elem.parent('div.show-more').remove();

                        $(".carousel").carousel();

                        $("ul.wish-list").append(result.content);

                        track_page++; //page number increment
                        $('.comment-comment').tooltip('hide');
                    } else {

                        $("#loadmoreTip").text('No More Wishtips To Load');

                        setTimeout(function () {

                            elem.parent('div.show-more').remove();

                        }, 1500);

                    }



                }

            });

        });



        $(document).on("click", "#moreNotification", function (e) {

            e.preventDefault();

            var elem = $(this);

            $.ajax({

                type: "POST",

                dataType: "json",

                data: {},

                url: "<?php echo base_url("home/get_all_notification/") ?>" + track_page,

                beforeSend: function () {

                    var loader = '<div class="text-center" id="loader" style="clear: both"><img src="<?php echo base_url('assets/images/filter-loader.gif') ?>" style="width:32px"></div>';

                    elem.before(loader);

                    elem.button('loading');

                },

                success: function (result) {

                    $('#loader').remove();

                    elem.button('reset');

                    if (parseInt(result.count) > 0) {

                        elem.parent('#more_user_notifications').remove();

                        $("ul.notifications_content").append(result.content);

                        track_page++; //page number increment

                    } else {

                        elem.text('No More Wishtips To Load');



                        setTimeout(function () {

                            elem.remove();

                        }, 1000);

                    }



                }

            });

        });



        $(document).on("click", ".hide_tips", function (e) {

            e.preventDefault();

            var _this = $(this);

            var objectId = _this.attr('objectId'),objType = _this.attr('objType'),acttype = _this.attr('acttype'),obj_parent_id = _this.attr('obj_parent_id');

            $.post('<?php echo base_url("activity/hide_tip") ?>', { objectId: objectId, objType: objType,acttype:acttype,obj_parent_id:obj_parent_id }, function (data) {

                if (!data.error) {

                    _this.closest("article").parent("li").remove();

                }else{

                    var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Errors!</p>' + data.message + '</div>';

                    $("#alert-modal").find(".modal-body").append(msg);

                    $("#alert-modal").modal("show");

                    setTimeout(function () {

                        $("#alert-modal").find(".alert-danger").remove();

                        $("#alert-modal").modal("hide");

                    }, 2500);

                }

            }, "json");



        });



        /* For Notification Data*/

        load_notifications();

        /* End Notification Data*/



        $(document).click(function (e) {

            if (!$('.popover').is(e.target) && $('.popover').has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {

                $('#noti-pop').popover('hide');

            }

        });



        $('.modal').on('shown.bs.modal', function (e) {

            $('[data-toggle="dropdown"]').parent().removeClass('open');

            $("#category-popover").hide();

        });

        $(document).click(function(e) {
            var elem = $(this);
            if (!($(e.target).attr('id') === 'alert-count-pin' || $(e.target).attr('id') === 'moreNotification') && (typeof $(e.target).data('original-title') == 'undefined' && !$(e.target).closest('div.popover').hasClass('notify-popover'))) {
                $(".notify-popover").hide();
                console.log($(e.target).parents());
            }
        });

    });

    /* For Notification Content*/

    var load_notifications = function () {

        $.post('<?php echo base_url("home/get_all_notification") ?>', {}, function (data) {

            if (!data.error) {

                $(".notifications_content").html(data.content);

            }

        }, "json");

    }

    /* End Notification Content*/

</script>