<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
</script>
<script src="https://maps.googleapis.com/maps/api/js?v=3&sensor=false&amp;libraries=places"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.js"></script>
<link href="<?php echo base_url(); ?>assets/css/dropzone/dropzone.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/js/dropzone/dropzone.js"></script>
<link href="<?php echo base_url(); ?>assets/css/owl.carousel.css" rel="stylesheet">
<style>
    header {
        background-image: url('<?php echo base_url() ?>assets/images/nabbg.png');
        background-size: 100% 105%;
        z-index: 1;
    }
    #map {
        width: 100%;
        height: 500px;
    }
    .search_wall .iput3 input {
        background: #244b5b;    border-radius: 4px !important;
    }
    .search_wall {
        border-bottom: 0 !important;
    }
    .select-styled1:after {
        border-left: 1px solid #000;
        color: #127cb4;
        content: "";
        font-family: FontAwesome;
        font-size: 23px;
        padding: 8px 25px 9px 14px;
        position: absolute;
        right: 13px;
        top: 1px;
        width: 1px;
        z-index: 10;
    }
    .search_wall .input-group.iput3 {
        width: 100% !important;
    }
    .search_wall .col-input{width: 100% !important;}
    .search_wall .col-input.btn-div{width: 100% !important;}
    .search_wall .col-input button.search-btn {
        width: 100%;
        display: block;
        background: #127cb4;
        color: #fff;
        height: 50px;
        border: 0;
    }
    img.rotating-item.img-responsive {
        position: absolute;
    }
    .owl-controls {
        display:none;
    }
    .owl-carousel .owl-item {
        width: 30%!important;
    }
    .owl-carousel .owl-stage {
        width: 100%!important;
    }
    .gm-style-iw {
        height: 130px;
    }
    #popp-btn{
    /*    border-left: 1px solid #ccc;
    */}
    <style type="text/css">
    .dropzone.dz-started .dz-message {
        display: block;
    }
    .dropzone .dz-message,.btn-custom {
        box-shadow: none;
        clear: both;
        color: #38b8e9;
        display: inline-block;
        margin: 0;
    }
    .btn-custom { width:auto; }
    .dz-default.dz-message > span{
        border: none !important;
        margin-right: 0px !important;
        padding: 0px !important;
    }
    .dropzone {
        background: white none repeat scroll 0 0;
        border: none;
        min-height: auto;
        width: 100%;
        padding: 0px;
    }
    .dropzone .dz-preview .dz-image {
        border-radius: 3px;
        height: 100px;
        width: 100px;
    }
    .services-left .panel-default .panel-body span{
        border: none;
    }
    .iput3 input {background-image: none;}
    #support-tool-icons span {text-align: center;} 
    .dropzone {background-color: transparent;}
    .dropzone.dz-clickable {text-align: left;}
    #wishtips-form input#tips_title {border: none;border-radius: 0;height: 40px;} 
    #wishtips-form textarea#tips_description {border: none;border-radius: 0;    height: 80px;} 
    #wishtips-form input#wishtips_location {border: none;border-radius: 0;height: 40px;}
    #wishtips-form input#wishtips_other_category {border: none;border-radius: 0;height: 40px;}
    .popover.right {margin: 0;}
    .popover.right>.arrow:after {top: -8px !important;left: 1px !important;content: "" !important;border-bottom-color: #38b8e9 !important;border-top-width: 0 !important;}    
    .hr {color: #131313;font-weight: 600;border: none;border-radius: 0;}
    .hr:hover {background-color: #38b8e9;color: #fff;border-radius: 0;transition: all 350ms linear 0s;-webkit-transition: all 350ms linear 0s;-moz-transition: all 350ms linear 0s;-ms-transition: all 350ms linear 0s;}
</style>
</style>
<section class="wall_header">
    <div id="map">

    </div>
</section>
<section class="holiday_search_bar">
    <div class="search_holiday_wrap text-center">
        <div class="container">
            <div class="search_holiday_wrap search_wall">
                <form id="search_form" class="form-horizontal" method="POST" action="<?php echo base_url("trip/listings/") ?>">
                    <div class="col-sm-5">
                        <div class="col-input input-group iput3">
                            <input name="location" class="form-control" id="location" placeholder="Where" value="" autocomplete="off" type="text">
                            <div class="select-styled1"></div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="col-input input-group iput1">
                            <div class="select">
                                <select name="category" id="category" onchange="filterTrips(this.value);">
                                    <option value="">Select Category</option>
                                    <?php if (!empty($trip_category)): ?>
                                        <?php foreach ($trip_category as $cat): ?>
                                            <option value="<?php echo $cat['category_id'] ?>"><?php echo ucwords($cat['category']) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="col-input btn-div1">
                            <button class="search-btn"> <i class="fa fa-search"> </i> GO
                            </button>
                        </div>
                    </div>
                    <span class="help-block"></span>
                </form>
            </div>
        </div><!-- container -->
    </div>

</section>
<section class="wall_content">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="wall-left_block">
                    <div class="suggest_trip_block">
                        <div class="avatar-thumb">
                            <?php if (isset($user_detail->profile_pic) && !empty($user_detail->profile_pic)): ?>
                                <img src="<?php echo base_url("uploads/user-pic/" . $user_detail->profile_pic); ?>">
                            <?php else: ?>
                                <img src="<?php echo base_url("assets/images/default_avatar.png"); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="trip-content">
                            <form method="post" id="wishtips-form" action="<?php echo base_url("home/save_wishtips") ?>">
                                <div class="form-group">
                                    <input type="text" placeholder="Title" name="tips_title" id="tips_title" class="form-control">
                                    <span class="help-block"></span>
                                </div>
                                <textarea class="form-control hh" maxlength="400" name="tips_description" id="tips_description" cols="5" placeholder="Suggest a live travel tips now!!"></textarea>
                                <span class="help-block"></span>

                                <div class="form-group"><input class="form-control" name="wishtips_location" id="wishtips_location" placeholder="Enter your current location" autocomplete="off" type="text" style="display:none;"></div>

                                <div class="" id="other-category-input" style="display: none; padding: 0">
                                    <input type="text" class="form-control"  name="wishtips_other_category" id="wishtips_other_category" placeholder="Enter other category">
                                </div>


                                <div class="sugest_foot clearfix">
                                    <div class="support-tool-icons" style="padding: 0;">


                                        <span style="display: inline-block;">
                                            <div class="dropzone" id="tip_dropzone"></div>
                                        </span>

                                        <span style="position: relative;"> 
                                            <div class="btn btn-default btn-sm hr" href="javascript:void(0)" id="popp-btn">
                                                <i style="color: #2cb2be;" class="fa fa-sort-amount-desc"></i> Category
                                            </div>
                                            <div id="category-popover" class="popover right sort_pop">
                                               <!--  <div class="arrow"></div> -->
                                                <div class="popover-content">
                                                    <ul>
                                                        <?php if (!empty($wishtips_category)) : ?>
                                                            <?php foreach ($wishtips_category as $k => $cat): ?>
                                                                <li><a class="wishtips_cat" href="javascript:void(0)"><i class="fa fa-circle" aria-hidden="true"></i> <?php echo ucfirst($cat->category_name) ?></a></li>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </span>

                                        <span>
                                            <div class="btn btn-default btn-sm hr" id="map-location-input_icon" href="javascript:void(0)" style="border:0">
                                               <i style="color: #f42866;" class="fa fa-map-marker"></i> Location 
                                            </div>
                                          <!--   <div class="pull-right" id="other-category-input" style="display: none; padding: 0">
                                                <input type="text" class="form-control"  name="wishtips_other_category" id="wishtips_other_category" placeholder="Enter other category">
                                            </div> -->
                                        </span>



                                    </div>
                                    <div class="tips_btn_bar">
                                        <span> 400 Max words</span>
                                        <input type="hidden" name="wishtips_cat" id="wishtips_cat" value=""/>
                                        <input type="hidden" name="lat" id="lat" value=""/>
                                        <input type="hidden" name="long" id="long" value=""/>
                                        <button class="wish-btn">Tips now</button>
                                    </div>
                                </div>

                                <div class="col-sm-12 dropzone dz-clickable" id="preview-image">
                                    <!--<span>
                                        <img src="<?php echo base_url() ?>assets/images/dis_adv_02.jpg"/>
                                        <i class="fa fa-close"></i>
                                    </span>
            
                                     <span>
                                        <img src="<?php echo base_url() ?>assets/images/dis_adv_02.jpg"/>
                                        <i class="fa fa-close"></i>
                                    </span>
            
                                     <span>
                                        <img src="<?php echo base_url() ?>assets/images/dis_adv_02.jpg"/>
                                        <i class="fa fa-close"></i>
                                    </span>
            
                                     <span>
                                        <img src="<?php echo base_url() ?>assets/images/dis_adv_02.jpg"/>
                                        <i class="fa fa-close"></i>
                                    </span>-->

                                </div>

                            </form>
                        </div>
                    </div>

                </div>

                <div class="filter-block">
                    <div class=" dropdown filter pull-right">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                            Filter tips by <i class="fa fa-angle-down"> </i> </a>
                        <ul class="dropdown-menu">
                            <?php if (!empty($wishtips_category)) : ?>
                                <?php foreach ($wishtips_category as $k => $cat): ?>
                                    <li><a class="wishtips_category" href="javascript:void(0)"><?php echo ucfirst($cat->category_name) ?></a></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <input type="hidden" name="wishtips_category" id="wishtips_category" value=""/>
                        </ul>
                    </div>

                    <div class="col-sm-4 pull-right filter-search-in">
                        <input type="text" class="form-control" placeholder="Location"  name="filter_location" id="filter_location" onkeyup="getFilterData(this.value);" onblur="getFilterData(this.value);">
                    </div>
                    <span class="help-block"></span>
                    <div class="clearfix"></div>

                </div>
                <div class="clearfix"></div>
                <div id="post" class="posts-wrap">
                    <ul class="list-unstyled wish-list">
                        <?php if(!empty($wishtips)): ?>
                            <?php $i = 1; ?>
                            <?php foreach($wishtips as $k=>$wishtip){  ?>
                                <li>
                                    <article>
                                        <div class="articale-header">
                                            <div class="col-md-1 artical-avatar">
                                                <a href="<?php echo base_url("home/profile/".$wishtip->user_id); ?>">
                                                    <?php if (isset($wishtip->profile_pic) && !empty($wishtip->profile_pic)): ?>
                                                        <img src="<?php echo base_url("uploads/user-pic/" . $wishtip->profile_pic); ?>">
                                                    <?php else: ?>
                                                        <img src="<?php echo base_url() ?>assets/images/dis_adv_03.jpg">
                                                    <?php endif; ?>
                                                </a>
                                            </div>
                                            <div class="col-md-11 artical-content">
                                                <a href="<?php echo base_url("home/tips_detail/".$wishtip->wishtips_id); ?>">
                                                    <h4> <?php echo ucfirst($wishtip->title) ?></h4>
                                                </a>
                                                    <div class="ss">
                                                        <span> <?php echo $wishtip->description ?></span>
                                                    </div>
                                                <div class="country">
                                                    <i class="fa fa-map-marker"> </i>
                                                    <?php
                                                    if(!empty($wishtip->location)){
                                                        echo trim($wishtip->location);
                                                    }
                                                    ?>

                                                    <span class="time-post pull-right">
                                                        <i class="fa fa-clock-o"> </i>
                                                        <?php echo humanTime(strtotime($wishtip->created_date),1)." ago"; ?>
                                                    </span>
                                                </div>
                                                <div data-toggle="tooltip" data-placement="top" title="Bookmark" class="<?php echo ($wishtip->is_bookmark)?'bookmarked':'bookmark' ?>">
                                                    <a id="bookmark_<?php echo $wishtip->wishtips_id ?>" onclick="<?php echo ($wishtip->is_bookmark)?'unbookmark_tip(this);':'bookmark_tip(this);' ?>" class="<?php echo ($wishtip->is_bookmark)?'unbookmarkTip':'bookmarkTip' ?>" actType="bookmark_tip" objType="<?php echo 'tip'?>" objectId="<?php echo $wishtip->wishtips_id ?>" obj_parent_id="<?php echo $wishtip->owner_id ?>" title="<?php echo ($wishtip->is_bookmark)?'Unbookmark this tip':'Bookmark this tip' ?>" href="javascript:void(0)">
                                                        <?php if($wishtip->is_bookmark): ?>
                                                            <i class="fa fa-bookmark"> </i>
                                                        <?php else: ?>
                                                            <i class="fa fa-bookmark"> </i>
                                                        <?php endif; ?>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="artical-image">
                                            <?php if(!empty($wishtip->images)) { ?>
                                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                                <!-- Wrapper for slides -->
                                                <div class="carousel-inner" role="listbox">
                                                <?php $images = explode(",", $wishtip->images);
                                                    foreach ($images as $k=>$image){
                                                    $img = base_url("uploads/tips-images/") .$image;
                                                    ?>
                                                    <div class="item <?php echo ($k==0)?'active':''; ?>">

                                                        <img class="img-responsive img-rounded" src="<?php echo $img ?>">

                                                    </div>
                                                      <?php } ?>
                                                </div>
                                                <!-- Controls -->

                                                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>

                                                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </div>
                                            <?php
                                            }else{
                                                $img = '';
                                            ?>
                                         <?php } ?>

                                        </div>
                                        <div class="artic-tools">
                                            <ul class="list-inline">
                                                <li>
                                                    <a id="tipLike_<?php echo $wishtip->wishtips_id ?>" onclick="<?php echo ($wishtip->is_like)?'unlike_tip(this);':'like_tip(this);' ?>" class="<?php echo ($wishtip->is_like)?'unlikeTip':'likeTip' ?> heart" actType="like_tip" objType="<?php echo 'tip'?>" objectId="<?php echo $wishtip->wishtips_id ?>" obj_parent_id="<?php echo $wishtip->owner_id ?>" data-toggle="tooltip" data-placement="top" title="Like this Tip" href="javascript:void(0)">
                                                        <i class="fa fa-heart<?php echo ($wishtip->is_like)?'':'' ?>"> </i>
                                                    </a> <?php echo ($wishtip->like_count>0)?$wishtip->like_count:'' ?>
                                                </li>

                                                <li>
                                                    <a id="tipPlaneLike_<?php echo $wishtip->wishtips_id ?>" onclick="<?php echo ($wishtip->is_like_plane)?'unlike_tip(this);':'like_tip(this);' ?>" class="<?php echo ($wishtip->is_like_plane)?'unlikeTipPlane':'likeTipPlane' ?> plane" actType="like_tip_in_plane" objType="<?php echo 'tip'?>" objectId="<?php echo $wishtip->wishtips_id ?>" obj_parent_id="<?php echo $wishtip->owner_id ?>" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="I want to go">
                                                        <i class="fa fa-plane"> </i>
                                                    </a> <?php echo ($wishtip->like_plane_count>0)?$wishtip->like_plane_count:'' ?>
                                                </li>

                                                <li>
                                                    <a id="tipPlaneInLike_<?php echo $wishtip->wishtips_id ?>" onclick="<?php echo ($wishtip->is_like_plane_in)?'unlike_tip(this);':'like_tip(this);' ?>" class="<?php echo ($wishtip->is_like_plane_in)?'unlikeTipPlaneInside':'likeTipPlaneInside' ?> p-plane" actType="like_tip_in_location" objType="<?php echo 'tip'?>" objectId="<?php echo $wishtip->wishtips_id ?>" obj_parent_id="<?php echo $wishtip->owner_id ?>"  href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Important Tip">
                                                        <i class="fa fa-lightbulb-o"> </i>
                                                    </a> <?php echo ($wishtip->like_plane_in_count>0)?$wishtip->like_plane_in_count:'' ?>
                                                </li>

                                                <li>
                                                    <a class="comment comment-comment" id="comment-comment_<?php echo $wishtip->wishtips_id ?>" actType="comment_tip" objType="tip" objectId="<?php echo $wishtip->wishtips_id ?>" obj_parent_id="<?php echo $wishtip->owner_id ?>" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Comment">
                                                        <i class="fa fa-comment"> </i>
                                                    </a>
                                                    <span class="tip_comment_count">
                                                <?php echo ($wishtip->comment_count>0)?$wishtip->comment_count:'' ?>
                                                </span>
                                                </li>

                                                <li>
                                                    <div class="btn-group">
                                                        <a type="button" class="comment dropdown-toggle" style="color:#5cb85c; padding: 0;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="share-tip_<?php echo $wishtip->wishtips_id ?>" href="javascript:void(0)" actType="share_tip" objType="<?php echo 'tip'?>" objectId="<?php echo $wishtip->wishtips_id ?>" obj_parent_id="<?php echo $wishtip->owner_id ?>"  data-toggle1="tooltip" data-placement="top" title="Share">
                                                            <i class="fa fa-share-alt"></i>
                                                        </a>
                                                        <span class="tip_share_count">&nbsp;&nbsp;
                                                            <?php //echo ($wishtip->share_count>0)?$wishtip->share_count:'' ?>
                                                    </span>

                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                                                <div class="addthis_inline_share_toolbox addthis_toolbox" data-url="<?php echo base_url("home/tips_detail/".$wishtip->wishtips_id); ?>" data-title="<?php echo $wishtip->description ?>" data-media="<?php echo $img ?>">

                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>

                                                <li class="pull-right slash">
                                                  <!--   <a class="report" href="javascript:void(0)" onclick="report('<?php echo $wishtip->wishtips_id ?>');"> Report Abuse</a>&nbsp;/&nbsp;<a class="report hide_tips" id="tip_<?php echo $wishtip->wishtips_id ?>" href="javascript:void(0)"  actType="hide_tip" objType="<?php echo 'tip' ?>" objectId="<?php echo $wishtip->wishtips_id ?>" obj_parent_id="<?php echo $wishtip->owner_id ?>" title="Hide this tip"> Hide</a> -->

                                                  <p><a class="report" href="javascript:void(0)" onclick="report('<?php echo $wishtip->wishtips_id ?>');"> Report Abuse</a> <strong>/</strong> <a class="report hide_tips" id="tip_<?php echo $wishtip->wishtips_id ?>" href="javascript:void(0)"  actType="hide_tip" objType="<?php echo 'tip' ?>" objectId="<?php echo $wishtip->wishtips_id ?>" obj_parent_id="<?php echo $wishtip->owner_id ?>" title="Hide this tip"> Hide</a></p>

                                                </li>
                                            </ul>
                                        </div>
                                        <div class="commet-box">
                                            <div class="col-md-1 comment-avatar">
                                                <?php if (isset($wishtip->profile_pic) && !empty($wishtip->profile_pic)): ?>
                                                    <img src="<?php echo base_url("uploads/user-pic/" . $wishtip->profile_pic); ?>">
                                                <?php else: ?>
                                                    <img src="<?php echo base_url() ?>assets/images/dis_adv_03.jpg">
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-md-11 comment-area">
                                                <form id="comment-form_<?php echo $wishtip->wishtips_id ?>" class="form-comment" action="<?php echo base_url('activity/post_comment') ?>" method="POST" actType="comment_tip" objType="tip" objectId="<?php echo $wishtip->wishtips_id ?>" obj_parent_id="<?php echo $wishtip->owner_id ?>">
                                                    <div class="col-md-10 form-group">
                                                        <textarea class="form-control" name="comment" id="comment" placeholder="Add Comment" cols="2"> </textarea>
                                                        <span class="help-block"></span>
                                                    </div>
                                                    <div class="col-md-2 form-group pull-right tt">
                                                        <button type="submit" class="btn btn-default btn-sm hr"> &nbsp; &nbsp; Post Comment &nbsp; &nbsp; </button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                        <div class="clearfix"></div>
                                    </article>
                                </li>
                                <div class="clearfix"></div>
                                <?php $i++; } ?>
                            <div class="show-more">
                                <a data-id="" data-location = "" data-cat="" data-set="" data-bookmark="" data-loading-text="Loading..." class="more btn btn-link btn-block" id="loadmoreTip">Show More...</a>
                            </div>
                        <?php else: ?>
                            <li>
                                <div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <b>Sorry, No wishtips are found.</b>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>

            </div>
            <div class="col-sm-4 wall_center">
                <div class="wall-right_block ">
                    <?php if(!empty($recent_trips)): ?>
                        <div class="title">
                            Most Recent Trips
                        </div>
                        <div class="wall-right-inner online">
                            <ul class="list-inline">
                                <?php foreach($recent_trips as $row){ ?>
                                    <li>
                                        <a href="<?php echo base_url('trip/trip_details/').$row['trip_id'] ?>" target="_blank">
                                            <?php if (isset($row['photos']) && !empty($row['photos'])): ?>
                                                <img class="img-responsive" src="<?php echo base_url("uploads/" . $row['photos']); ?>"> 
                                            <?php else: ?>
                                                <img class="img-responsive" src="<?php echo base_url(); ?>/assets/images/dis_adv_01.jpg"> 
                                            <?php endif; ?>
                                        </a> 
                                    </li>
                                <?php } ?>   
                            </ul>
                        </div>
                    <?php endif ?>

                    <?php if(!empty($advertisments)): ?>
                        <div class="title">
                            Advertisment
                        </div>
                        <div class="wall-right-inner latest-adv ">
                            <div class="owl-carousel3 client-logo">
                                <?php foreach($advertisments as $add){ ?>
                                    <div class="item"> <a href="<?php echo $add->banner_link ?>"> <img src="<?php echo base_url("uploads/banners/".$add->banner_image) ?>"> </a> </div>
                                <?php } ?>      
                            </div>
                        </div>
                        <?php foreach($advertisments as $add){ ?>
                            <div class="title">
                            </div>
                            <div class="wall-right-inner Sponsorized">
                                <a href="<?php echo $add->banner_link ?>">
                                    <img class="img-responsive" src="<?php echo base_url("uploads/banners/".$add->banner_image) ?>">
                                </a>
                            </div>
                        <?php } ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
    </div>
</section>

<div id="report_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Report </h4>
            </div>
            <form id="report_form" class="serives-reply-form" method="post"
                  action="<?php echo base_url("home/report") ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" style="margin-bottom: 0px;">
                                <label class="custom-control custom-radio">
                                    <input id="reason1" name="reason" type="radio" class="custom-control-input" value="1">
                                    <span class="custom-control-description">It's annoying or not interesting</span>
                                </label>
                            </div>
                            <div class="form-group" style="margin-bottom: 0px;">
                                <label class="custom-control custom-radio">
                                    <input id="reason2" name="reason" type="radio" class="custom-control-input" value="2">
                                    <span class="custom-control-description">I think it shouldn't be on tipsandgo</span>
                                </label>
                            </div>
                            <div class="form-group errormsg" style="margin-bottom: 0px;">
                                <label class="custom-control custom-radio">
                                    <input id="reason3" name="reason" type="radio" class="custom-control-input" value="3">
                                    <span class="custom-control-description">It's spam</span>
                                </label>
                            </div>

                            <div class="form-group">
                                <label class="control-label requiredField" for="forgot_password_email">Please give reason about this.
                                    <span class="asteriskField">*</span>
                                </label>
                                <?php $data = array(
                                    'name' => 'tip_feedback',
                                    'id' => 'tip_feedback',
                                    'value' => set_value('tip_feedback') ? set_value('tip_feedback') : '',
                                    'rows' => 3,
                                    'class' => 'form-control'
                                );
                                echo form_textarea($data); ?>
                                <?php echo form_error('tip_feedback'); ?>
                                <span class="help-block"></span>
                            </div>
                            <input type="hidden" value="" name="wishtip_id" id="wishtip_id" />
                        </div>
                    </div>
                </div>

                <!--Modal footer-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary " name="submit" type="submit">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/js/custome_select.js"></script>
<script type="text/javascript" src="http://arrow.scrolltotop.com/arrow13.js"></script>
<script src="<?php echo base_url(); ?>assets/js/owl.carousel.js"></script>
<script>
    $(document).ready(function() {

        $('.owl-carousel3').owlCarousel({

            loop:true,

            margin:10,

            nav:true,

            responsive:{

                0:{

                    items:1

                },

                480:{

                    items:2

                },

                600:{

                    items:2

                },

                1000:{

                    items:6

                }

            }

        })
    });

</script>
<script type="text/javascript">


    var storedFiles = [];
    $(document).ready(function () {
        $('.share').tooltip();
        $("#popp-btn").click(
            function() {
                $('#category-popover', this).stop( true, true ).toggle("slow");
                $("#category-popover").toggle('slow');
            },
            function() {
                $('#category-popover', this).stop( true, true ).toggle("slow");
                $("#category-popover").toggle('slow');
            });

        $("#upload-photo_icon").click(function () {
            $("#upload-photo").click();
        });

        $("#map-location-input_icon").click(function () {
            $("#wishtips_location").toggle("slow");
        });

        $(".wishtips_cat").click(function (e) {
            var elem = $(this);
            var cat = elem.text();
            $(".wishtips_cat").parent("li").removeClass("active");
            elem.parent("li").addClass("active");
            $("#wishtips_cat").val($.trim(cat));
            $("#category-popover").toggle('slow');
            $("#popp-btn").html($(this).text()+' <i class="fa fa-angle-down"> </i>');
            
            if($.trim(cat) === "Others"){
                $("#other-category-input").show("slow");
            }else{
                $("#other-category-input").hide("slow");
            }
        });

        $(".wishtips_category").click(function (e) {
            var elem = $(this);
            $("#wishtips_category").val($(this).text());
            $(this).closest("ul.dropdown-menu").prev("a.dropdown-toggle").html($(this).text());
            if($(this).text() != "Others"){
                $(".filter-category-in").remove();
                getFilterData($(this).text());
            }else{
                var input = '<div class="col-sm-4 pull-right filter-category-in"><input class="form-control" placeholder="Filter Category" name="filter_category" id="filter_category" onkeyup="getFilterData(this.value);" type="text"></div>';
                if (!$('#filter_category').length)
                {
                    elem.closest("div.filter").after(input);
                }
            }

        });

        $('header').addClass('header_gradient');
        $("#location").geocomplete().bind("geocode:result", function(event, result){
            filterTrips(result.formatted_address);
        });
        $("#filter_location").geocomplete().bind("geocode:result", function(event, result){
            getFilterData(result.formatted_address);
        });

        $("ul.select-options li").on('click',function(){
            var cat_id=$(this).attr('rel');
            if(cat_id){
                filterTrips(cat_id);
            }
        });
        $("#wishtips_location")
            .geocomplete()
            .bind("geocode:result", function (event, result) {
                $("#lat").val(result.geometry.location.lat());
                $("#long").val(result.geometry.location.lng());
            });
        $(".search-btn").click(function (e) {
            e.preventDefault();
            var error = false;
            var location = $("#location").val();
            var category = $("#category").val();
            if (location || category) {
                $("#search_form").submit();
            } else {
                $("#search_form").find("span.help-block").text("You can not leave empty search field before submit.");
                return false;
            }
        });

        $('#tips_description').bind("keypress paste focus blur", function (e) {
            var tval = $(this).val(),
                tlength = tval.length,
                set = $(this).attr("maxlength");
            remain = parseInt(set - tlength);
            $('.tips_btn_bar').find('span').text(remain + " are remaining.");
            if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
                $('textarea').val((tval).substring(0, tlength - 1))
            }
        });

        $("#upload-photo").on('change', function (e) {
            var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
            var files = e.target.files,
                filesLength = files.length;
            var countFiles = $(this)[0].files.length;
            var error = "";
            var imgPath = $(this)[0].value;
            var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            var image_holder = $("#preview-image");
            image_holder.empty();

            if (countFiles <= 5) {
                if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg" || extn == "bmp") {
                    if (typeof (FileReader) != "undefined") {
                        for (var i = 0; i < countFiles; i++) {
                            var reader = new FileReader();
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var file = e.target;
                                $("<span>" +
                                    "<img src='" + e.target.result +"'  title='Image Preview' width='70' height='70'/>" +
                                    "</span>").insertAfter("#upload-photo").appendTo(image_holder);
                                //$(document).on("click", ".remove", removeFile);
                            }

                            image_holder.show();
                            storedFiles.push($(this)[0].files[i]);
                            reader.readAsDataURL($(this)[0].files[i]);
                        }
                    } else {
                        error = "This types of files not supporting.";
                    }
                } else {
                    error = "Only " + fileExtension.join(', ') + "formats are allowed.";
                }
            } else {
                error = "You can't upload more than 5 images";
            }

            if (error) {

                $(this).val("").clone(true);
                var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Errors!</p>' + error + '</div>';
                $("#alert-modal").find(".modal-body").html(msg);
                $("#alert-modal").modal("show");
                setTimeout(function () {
                    $("#alert-modal").find(".modal-body").empty();
                    $("#alert-modal").modal("hide");
                }, 4000);
            }
        });

        $(document).on("click", ".wish-btn", function (ev) {
            ev.preventDefault();
            var elem = $(this);
            var tips_description = $.trim($("#tips_description").val());
            var tips_title = $.trim($("#tips_title").val());
            var url = elem.closest("form").attr("action");
            var error = false;
            if (!tips_description) {
                msg = "Wish tips description is required";
                $('#tips_description').next(".help-block").text(msg);
                $('#tips_description').removeClass("error").addClass("error");
                error = true;
            } else {
                error = false;
                $('#tips_description').next(".help-block").text("");
                $('#tips_description').removeClass("error");
            }

            if (!tips_title) {
                msg = "Wish tips title is required";
                $('#tips_title').next(".help-block").text(msg);
                $('#tips_title').removeClass("error").addClass("error");
                error = true;
            } else {
                error = false;
                $('#tips_title').next(".help-block").text("");
                $('#tips_title').removeClass("error");
            }

            if(error){
                return false;
            }

            var form = $('#wishtips-form')[0]; // You need to use standart javascript object here
            //var form = $('form')[0]; // You need to use standart javascript object here
            var formData = new FormData(form);
            /*for(var i=0, len=storedFiles.length; i<len; i++) {
             console.log(storedFiles[i]);
             formData.append('files', storedFiles[i]);
             }*/

            formData.append('wishtips_location', $("#wishtips_location").val());
            formData.append('lat', $("#lat").val());
            formData.append('long', $("#long").val());
            formData.append('tips_description', tips_description);
            formData.append('wishtips_cat', $("#wishtips_cat").val());
            $.ajax({
                url: "<?php echo base_url("home/save_wishtips") ?>",
                type: "POST",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend: function(){
                    var loader = '<img width="50%" src="<?php echo base_url('assets/images/filter-loader.gif') ?>" />';
                    $("#loader-modal").find("div.center").html(loader);
                    $("#loader-modal").modal("show");
                },
                success: function (data) {
                    $("#loader-modal").find("div.center").empty();
                    $("#loader-modal").modal("hide");
                    if (!data.error) {
                        var msg = '<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Success!</p>' + data.message + '</div>';
                        $("#wishtips-form").prepend(msg);
                        $("#wishtips-form")[0].reset();
                        $("#map-location-input").toggle();
                        $(".wishtips_cat").parent("li").removeClass("active");
                        $("#upload-photo").val("").clone(true);
                        $("#preview-image").empty();
                        $("#wishtips_location").fadeOut("slow");
                        $("#other-category-input").hide();
                        $("#category-popover").find("li").removeClass("active");
                        $("#popp-btn").html('<i class="fa fa-sort-amount-desc"> </i>');
                        var noti_count = $("#favtipsloc-count-pin").find("span.value").text();
                        noti_count = parseInt(noti_count)+1;
                        $("#favtipsloc-count-pin").find("span.value").text(noti_count);
                        setTimeout(function () {
                            $("#wishtips-form").find(".alert-success").remove();
                            $(".wish-list").html(data.htmlContent);
                        }, 5000);
                    } else {
                        var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Errors!</p>' + data.message + '</div>';
                        $("#wishtips-form").prepend(msg);
                        setTimeout(function () {
                            $("#wishtips-form").find(".alert-danger").remove();
                        }, 5000);
                    }
                },
                error: function (jqXHR, textStatus, errorMessage) {
                    var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Errors!</p>' + errorMessage + '</div>';
                    $("#wishtips-form").prepend(msg);
                    setTimeout(function () {
                        $("#wishtips-form").find(".alert-danger").remove();
                    }, 5000);
                }
            });
        });

        $(document).on("submit",".form-comment", function(e){
            e.preventDefault();
            <?php if(!$this->session->userdata("user_id")): ?>
            window.location.href = "<?php echo base_url("login") ?>";
            <?php else: ?>
            elem = $(this);
            var _id = elem.attr("id");
            var url = elem.attr("action");
            var comment = $.trim(elem.find("#comment").val());
            var objectId = elem.attr('objectId'),objType = elem.attr('objType'),acttype = elem.attr('acttype'),obj_parent_id = elem.attr('obj_parent_id');
            if (!comment) {
                msg = "Comment field is required";
                elem.find('#comment').next(".help-block").text(msg);
                elem.find('#comment').removeClass("error").addClass("error");
                return false;
            } else {
                elem.find('#comment').next(".help-block").text("");
                elem.find('#comment').removeClass("error");
            }
            $.ajax({
                url: url,
                type: "POST",
                data: { comment: comment, objectId: objectId, objType: objType,acttype:acttype,obj_parent_id:obj_parent_id },
                dataType: "json",
                success: function (data) {
                    if (!data.error) {
                        var msg = '<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Success!</p>' + data.message + '</div>';
                        elem.prepend(msg);
                        $("#"+_id)[0].reset();
                        elem.closest("div.commet-box").prev("div.artic-tools").find("span.tip_comment_count").text(data.likeCount);
                        setTimeout(function () {
                            elem.find(".alert-success").remove();
                        }, 4000);
                    } else {
                        var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Errors!</p>' + data.message + '</div>';
                        elem.prepend(msg);
                        setTimeout(function () {
                            elem.find(".alert-danger").remove();
                        }, 4000);
                    }
                },
                error: function (jqXHR, textStatus, errorMessage) {
                    var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Errors!</p>' + errorMessage + '</div>';
                    elem.prepend(msg);
                    setTimeout(function () {
                        elem.find(".alert-danger").remove();
                    }, 4000);
                }
            });
            <?php endif; ?>
        });

        $(document).on("click", ".comment-comment", function(e){
            e.preventDefault();
            <?php if(!$this->session->userdata("user_id")): ?>
            window.location.href = "<?php echo base_url("login") ?>";
            <?php else: ?>
            var elem = $(this);
            var objectId = elem.attr('objectId'),objType = elem.attr('objType'),acttype = elem.attr('acttype'),obj_parent_id = elem.attr('obj_parent_id');
            $.ajax({
                url: '<?php echo base_url("activity/getCommentById") ?>',
                type: "POST",
                data: {objectId: objectId, objType: objType,acttype:acttype,obj_parent_id:obj_parent_id },
                dataType: "json",
                beforeSend: function(){
                    var html = '<li class="loader"><img src="<?php echo base_url('assets/images/gif-loader.gif') ?>" /></li>';
                    elem.closest("li").after(html);
                },
                success: function (data) {
                    $("li.loader").remove();
                    if (!data.error) {
                        elem.closest("div.artic-tools").next("div.commet-box").find('div.well').remove();
                        elem.closest("div.artic-tools").next("div.commet-box").append(data.htmlContent);
                    } else {
                        var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Errors!</p>' + data.message + '</div>';
                        elem.prepend(msg);
                        setTimeout(function () {
                            elem.find(".alert-danger").remove();
                        }, 4000);
                    }
                },
                error: function (jqXHR, textStatus, errorMessage) {
                    var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Errors!</p>' + errorMessage + '</div>';
                    elem.prepend(msg);
                    setTimeout(function () {
                        elem.find(".alert-danger").remove();
                    }, 4000);
                }
                <?php endif; ?>
            });
        });

        $("#report_form").validate({
            rules: {
                tip_feedback: {
                    required: true,
                },
                reason: {
                    required: true,
                },
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "reason")
                {
                    error.insertAfter("div.errormsg");
                }else{
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                <?php if(!$this->session->userdata("user_id")): ?>
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
                            var msg = '<div class="alert alert-success"> <p>Success!</p>' + data.message + '</div>';
                            _form.prepend(msg);
                            _form[0].reset();
                            setTimeout(function () {
                                _form.find(".alert-success").remove();
                                _form.closest(".modal").modal("hide");
                            }, 2500);
                        } else {
                            var msg = '<div class="alert alert-danger"> <p>Errors!</p>' + data.message + '</div>';
                            _form.prepend(msg);
                            setTimeout(function () {
                                _form.find(".alert-danger").remove();
                            }, 3000);
                        }
                    },
                    error: function (jqXHR, textStatus, errorMessage) {
                        var msg = '<div class="alert alert-danger"> <p>Errors!</p>' + errorMessage + '</div>';
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

    var req = null;
    function getFilterData(value)
    {
        if($.trim(value) && $.trim(value) !=''){
            var wishtips_category = $("#wishtips_category").val();
            if(wishtips_category == "Others"){
                wishtips_category = $("#filter_category").val();
            }
            var filter_location = $("#filter_location").val();
            if (req != null) req.abort();
            req = $.ajax({
                type: "POST",
                url: "<?php echo base_url('home/getWishtipFilterData') ?>",
                data: { wishtips_category: wishtips_category, filter_location: filter_location },
                dataType: "json",
                beforeSend: function(){
                    var loader = '<div class="loader" style="width:10%;margin:0 auto;"><img width="50%" src="<?php echo base_url('assets/images/filter-loader.gif') ?>" /></div>';
                    $(".loader").remove();
                    $(".filter-block").find("span.help-block").before(loader);
                },
                success: function(data){
                    setTimeout(function(){
                        $(".loader").remove();
                        if(!data.error){
                            $(".filter-block").find("span.help-block").empty();
                            $(".wish-list").html(data.htmlContent);
                        }else{
                            $(".filter-block").find("span.help-block").text(data.message);
                        }
                    }, 1500);
                }
            });
        }
    }

    function like_tip(element){
        <?php if(!$this->session->userdata("user_id")): ?>
        window.location.href = "<?php echo base_url("login") ?>";
        <?php else: ?>
        elem = $("#"+element.id);
        var objectId = elem.attr('objectId'),objType = elem.attr('objType'),acttype = elem.attr('acttype'),obj_parent_id = elem.attr('obj_parent_id');

        $.post( '<?php echo base_url("activity/likeTip") ?>',{ objectId: objectId, objType: objType,acttype:acttype,obj_parent_id:obj_parent_id }, function( data ) {

            if(!data.error){
                var like_count = (data.likeCount>0)?data.likeCount:'';
                if(elem.hasClass('likeTip')){
                    var html = '<a id="tipLike'+objectId+'" onclick="unlike_tip(this);" obj_parent_id="'+obj_parent_id+'" objType="'+objType+'" acttype="'+acttype+'" objectId="'+objectId+'"  class="unlikeTip heart" href="javascript:void(0);" title="Like this tip"><i class="fa fa-heart"> </i></a>'+like_count;
                }else if(elem.hasClass('likeTipPlane')){
                    var html = '<a id="tipPlaneLike'+objectId+'" onclick="unlike_tip(this);" obj_parent_id="'+obj_parent_id+'" objType="'+objType+'" acttype="'+acttype+'" objectId="'+objectId+'"  class="unlikeTipPlane plane" href="javascript:void(0);" title="I want to go"><i class="fa fa-plane"> </i></a>'+like_count;
                }else if(elem.hasClass('likeTipPlaneInside')){
                    var html = '<a id="tipPlaneInLike'+objectId+'" onclick="unlike_tip(this);" obj_parent_id="'+obj_parent_id+'" objType="'+objType+'" acttype="'+acttype+'" objectId="'+objectId+'"  class="unlikeTipPlaneInside p-plane" href="javascript:void(0);"  title="Important Tip"><i class="fa fa-lightbulb-o"> </i></a>'+like_count;
                }

                elem.closest("li").html(html);
            }

        }, "json");
        <?php endif; ?>
    }

    function unlike_tip(element){
        <?php if(!$this->session->userdata("user_id")): ?>
        window.location.href = "<?php echo base_url("login") ?>";
        <?php else: ?>
        elem = $("#"+element.id);
        var objectId = elem.attr('objectId'),objType = elem.attr('objType'),acttype = elem.attr('acttype'),obj_parent_id = elem.attr('obj_parent_id');

        $.post( '<?php echo base_url("activity/unlikeTip") ?>',{ objectId: objectId, objType: objType,acttype:acttype,obj_parent_id:obj_parent_id }, function( data ) {

            if(!data.error){
                var like_count = (data.likeCount>0)?data.likeCount:'';
                if(elem.hasClass('unlikeTip')){
                    var html = '<a id="tipLike'+objectId+'" onclick="like_tip(this);" obj_parent_id="'+obj_parent_id+'" objType="'+objType+'" acttype="'+acttype+'" objectId="'+objectId+'"  class="likeTip heart" href="javascript:void(0);" title="Like this tip"><i class="fa fa-heart"> </i></a>'+like_count;
                }else if(elem.hasClass('unlikeTipPlane')){
                    var html = '<a id="tipPlaneLike'+objectId+'" onclick="like_tip(this);" obj_parent_id="'+obj_parent_id+'" objType="'+objType+'" acttype="'+acttype+'" objectId="'+objectId+'"  class="likeTipPlane plane" href="javascript:void(0);" title="I want to go"><i class="fa fa-plane"> </i></a>'+like_count;
                }else if(elem.hasClass('unlikeTipPlaneInside')){
                    var html = '<a id="tipPlaneInLike'+objectId+'" onclick="like_tip(this);" obj_parent_id="'+obj_parent_id+'" objType="'+objType+'" acttype="'+acttype+'" objectId="'+objectId+'"  class="likeTipPlaneInside p-plane" href="javascript:void(0);" title="Important Tip"><i class="fa fa-lightbulb-o"> </i></a>'+like_count;
                }
                elem.closest("li").html(html);
            }

        }, "json");
        <?php endif; ?>
    }
</script>

<script>

    var trips = <?php echo json_encode($trips); ?>;
    var base_url = "<?php echo base_url() ?>";

    window.onload = function () {
        var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
        var icons = {
          parking: {
            icon: iconBase + 'parking_lot_maps.png'
          },
          library: {
            icon: iconBase + 'library_maps.png'
          },
          info: {
            icon: iconBase + 'info-i_maps.png'
          }
        };

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 3,
            center: {lat: <?php echo $trips[0]['location_lat'] ?>, lng: <?php echo $trips[0]['location_long'] ?>},
            mapTypeControl: true,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.BOTTOM_LEFT
            },
        });

        // Create an array of alphabetical characters used to label the markers.
        var labels = '';//'ABCDEFGHIJKLMNOPQRSTUVWXYZ';



        // Add some markers to the map.
        // Note: The code uses the JavaScript Array.prototype.map() method to
        // create an array of markers based on a given "locations" array.
        // The map() method here has nothing to do with the Google Maps API.
        var markers = trips.map(function (trip, i) {
            var latlng = new google.maps.LatLng(trip.location_lat, trip.location_long);

            var contentString = '<div class="col-sm-12 col-sm-12 text-center">'+
                '<div class="favorites_item_container">'+
                '<div class="profile_small_thumb">'+
                '<a target="_blank" href="'+base_url+'home/profile/'+trip.user_id+'">'+
                ((trip.profile_pic)?'<img class="img-responsive" src="<?php echo base_url('uploads/user-pic/') ?>'+trip.profile_pic+'" alt="...">':'<img class="img-responsive" src="<?php echo base_url('assets/images/default_avatar.png') ?>" alt="...">')
                +'</a>'+
                '</div>'+
                '<div class="img_container" style="height:130px;">'+
                '<a target="_blank" href="'+base_url+'trip/trip_details/'+trip.trip_id+'">'+
                ((trip.photos)?'<img class="img-responsive" src="'+base_url+'uploads/'+trip.photos+'" alt="...">':'<img class="img-responsive" src="'+base_url+'assets/images/map.jpg'+'" alt="...">')
                +'<div class="short_info">'+
                '<small></small>'+
                '<h3>'+trip.title+'</h3>'+
                '<em>'+trip.location+'</em>'+
                '</div>'+
                ' </a>'+
                '</div>'+
                '</div>'+
                '</div>';


            var infowindow = new google.maps.InfoWindow({
                content: contentString,
                maxWidth: 200
            });

            var marker = new google.maps.Marker({
                position: latlng,
                label: labels[i % labels.length],
                title: trip.title,
                map: map,
                url: "<?php echo base_url("trip/trip_details/"); ?>" + trip.trip_id,
                icon: '<?php echo base_url() ?>assets/images/marker.png',
            });

            google.maps.event.addListener(marker, 'click', function () {
                window.open(this.url, '_blank');
            });

            google.maps.event.addListener(marker, 'mouseover', function() {
                infowindow.open(map, this);
            });

            // assuming you also want to hide the infowindow when user mouses-out
            /* google.maps.event.addListener(marker, 'mouseout', function() {
             infowindow.close();
             });*/

            return marker;
        });


        // Add a marker clusterer to manage the markers.
        var markerCluster = new MarkerClusterer(map, markers,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
    }

    function filterTrips(value)
    {
        if($.trim(value) && $.trim(value) !=''){
            var category = $("#category").val();
            var location = $("#location").val();
            if (req != null) req.abort();
            req = $.ajax({
                type: "POST",
                url: "<?php echo base_url('trip/getTripsByParams') ?>",
                data: { category: category, location: location },
                dataType: "json",
                success: function(data){
                    //setTimeout(function(){}, 1500);

                    if(!data.error)
                    {
                        if(data.trips.length>0)
                        {
                            trips = data.trips;
                            var map = new google.maps.Map(document.getElementById('map'), {
                                zoom: 3,
                                center: {lat: <?php echo $trips[0]['location_lat'] ?>, lng: <?php echo $trips[0]['location_long'] ?>},
                                mapTypeControl: true,
                                mapTypeControlOptions: {
                                    style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                                    position: google.maps.ControlPosition.BOTTOM_LEFT
                                },
                            });

                            // Create an array of alphabetical characters used to label the markers.
                            var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';



                            // Add some markers to the map.
                            // Note: The code uses the JavaScript Array.prototype.map() method to
                            // create an array of markers based on a given "locations" array.
                            // The map() method here has nothing to do with the Google Maps API.
                            var markers = trips.map(function (trip, i) {
                                var latlng = new google.maps.LatLng(trip.location_lat, trip.location_long);

                                var contentString = '<div class="col-sm-12 col-sm-12 text-center">'+
                                    '<div class="favorites_item_container">'+
                                    '<div class="profile_small_thumb">'+
                                    '<a target="_blank" href="'+base_url+'home/profile/'+trip.user_id+'">'+
                                    ((trip.profile_pic)?'<img class="img-responsive" src="<?php echo base_url('uploads/user-pic/') ?>'+trip.profile_pic+'" alt="...">':'<img class="img-responsive" src="<?php echo base_url('assets/images/default_avatar.png') ?>" alt="...">')
                                    +'</a>'+
                                    '</div>'+
                                    '<div class="img_container" style="height:130px;">'+
                                    '<a target="_blank" href="'+base_url+'trip/trip_details/'+trip.trip_id+'">'+
                                    ((trip.photos)?'<img class="img-responsive" src="'+base_url+'uploads/'+trip.photos+'" alt="...">':'<img class="img-responsive" src="'+base_url+'assets/images/map.jpg'+'" alt="...">')
                                    +'<div class="short_info">'+
                                    '<small></small>'+
                                    '<h3>'+trip.title+'</h3>'+
                                    '<em>'+trip.location+'</em>'+
                                    '</div>'+
                                    ' </a>'+
                                    '</div>'+
                                    '</div>'+
                                    '</div>';


                                var infowindow = new google.maps.InfoWindow({
                                    content: contentString,
                                    maxWidth: 200
                                });

                                var marker = new google.maps.Marker({
                                    position: latlng,
                                    label: labels[i % labels.length],
                                    title: trip.title,
                                    map: map,
                                    url: "<?php echo base_url("trip/trip_details/"); ?>" + trip.trip_id,
                                });

                                google.maps.event.addListener(marker, 'click', function () {
                                    window.open(this.url, '_blank');
                                });

                                google.maps.event.addListener(marker, 'mouseover', function() {
                                    infowindow.open(map, this);
                                });

                                // assuming you also want to hide the infowindow when user mouses-out
                                /*google.maps.event.addListener(marker, 'mouseout', function() {
                                 infowindow.close();
                                 });*/

                                return marker;
                            });

                            // Add a marker clusterer to manage the markers.
                            var markerCluster = new MarkerClusterer(map, markers,
                                {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
                        }else{
                            var map = new google.maps.Map(document.getElementById('map'), {
                                zoom: 3,
                                center: {lat: <?php echo $trips[0]['location_lat'] ?>, lng: <?php echo $trips[0]['location_long'] ?>},
                                mapTypeControl: true,
                                mapTypeControlOptions: {
                                    style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                                    position: google.maps.ControlPosition.BOTTOM_LEFT
                                },
                            });
                            var marker = new google.maps.Marker({
                                map: map
                            });
                        }

                    }else{
                        var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Errors!</p>' + data.message + '</div>';
                        $("#alert-modal").find(".col-md-12").append(msg);
                        $("#alert-modal").modal("show");
                        setTimeout(function () {
                            $("#alert-modal").find(".col-md-12").empty();
                            $("#alert-modal").modal("hide");
                        }, 4000);
                    }
                }
            });
        }
    }

    var report = function(wishtip_id)
    {
        $("#report_model").find("#wishtip_id").val(wishtip_id);
        $("#report_model").modal("show");
    }

/*----- For Dropzone Script ------ */
    var base_url = "<?php echo base_url(); ?>";
    Dropzone.autoDiscover = false;
    if ($('#tip_dropzone').length) {
    var myDropzone = new Dropzone("#tip_dropzone", {
    url: base_url+"ajax/uploads",
    maxFiles: 5, //change limit as per your requirements
    dictRemoveFile: 'Remove',
    dictDefaultMessage: '<div class="btn btn-default btn-sm hr"><i style="color:green;" id="upload-photo_icon btn-custom" class="fa fa-camera"> </i> Upload Photo</div>',
    addRemoveLinks: true,
    previewsContainer: '#preview-image',
    init: function() {
    this.on("success", function(file, response){
        response = JSON.parse(response);
    if(!response.error){
        file.serverId = response.file_id;
        file.filename  = response.file_name;
        $(file.previewElement).find('[data-dz-name]').html(response.file_name);
        var hidden_field = "<input type='hidden' name='storage_files[]' id='files_"+response.file_id+"' value='"+response.file_name+"'/>";
        $(file.previewElement).closest('div.dropzone').append(hidden_field);
    }else if(!data.is_login){
        window.location.href = base_url;
    }
    });
    this.on("removedfile", function(file) {
    if (!file.serverId) { return; } // The file hasn't been uploaded
    $.ajax({
    url: base_url+"ajax/delete_files",
    type: "post",
    data: { file_id: file.serverId },
    success: function (response) {
        response = JSON.parse(response);
        $('.dropzone').find('#files_'+file.serverId).remove();
    },
    });
    });
    }
    });
    }

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$(function () {
  $('[data-toggle1="tooltip"]').tooltip()
})

</script>
