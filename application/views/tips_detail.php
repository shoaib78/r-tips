<style type="text/css">
.hr {color: #131313;font-weight: 600;border: none;border-radius: 0;}
.hr:hover {background-color: #38b8e9;color: #fff;border-radius: 0;transition: all 350ms linear 0s;-webkit-transition: all 350ms linear 0s;-moz-transition: all 350ms linear 0s;-ms-transition: all 350ms linear 0s;}
.tipss_detaills {background-color: #f2f2f2;    padding: 1em 0;}
</style>

<section id="welcome" class="welcome_classic">

    <div class="container">

        <div class="classic_inner"> 

            <h1>Tips Detail</h1>

            <div class="search_holiday_wrap"> 



            </div>

        </div> 

    </div> 

</section>


<div class="tipss_detaills">
    <div class="container tip-detail-page">

        <div class="row">

            <div class="col-sm-8 posts-wrap ">

                <ul class="list-unstyled">

                    <?php if(!empty($wishtip)): ?>

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

                                        <span> <?php echo $wishtip->description ?></span>

    								</a>

    								<div class="country">

    									<i class="fa fa-map-marker"> </i> 

    									<?php

                                            if(!empty($wishtip->location)){

                                                echo trim($wishtip->location);

                                            }

    									?>

                                        <span class="time-post pull-right">

                                            <?php echo humanTime(strtotime($wishtip->created_date),1)." ago"; ?>

                                            <i class="fa fa-clock-o"> </i>

                                        </span>

    								</div>

                                    <div class="<?php echo ($wishtip->is_bookmark)?'bookmarked':'bookmark' ?>">

                                        <a id="bookmark_<?php echo $wishtip->wishtips_id ?>" onclick="<?php echo ($wishtip->is_bookmark)?'unbookmark_tip(this);':'bookmark_tip(this);' ?>" class="<?php echo ($wishtip->is_bookmark)?'unbookmarkTip':'bookmarkTip' ?>" actType="bookmark_tip" objType="<?php echo 'tip'?>" objectId="<?php echo $wishtip->wishtips_id ?>" obj_parent_id="<?php echo $wishtip->owner_id ?>" title="<?php echo ($wishtip->is_bookmark)?'Remove bookmark':'Bookmark this tip' ?>" href="javascript:void(0)">

                                            <?php if($wishtip->is_bookmark): ?>

                                                <i class="fa fa-bookmark"> </i>

                                            <?php else: ?>

                                                <i class="fa fa-bookmark-o"> </i>

                                            <?php endif; ?>

                                        </a>

                                    </div>

    							</div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="artical-image">

                            <?php $string = randomString(6) ?>

                                <?php if(!empty($wishtip->images)) { ?>

                                    <div id="carousel-example-generic-<?php echo $string ?>" class="carousel slide" data-ride="carousel">

                                        <!-- Wrapper for slides -->

                                        <div class="carousel-inner" role="listbox">



                                            <?php $images = explode(",", $wishtip->images);

                                            foreach ($images as $key=>$image){

                                                $img = base_url("uploads/tips-images/") .$image;

                                                ?>

                                                <div class="item <?php echo ($key==0)?'active':''; ?>">



                                                    <img class="img-responsive img-rounded" src="<?php echo $img ?>">



                                                </div>

                                            <?php } ?>

                                        </div>

                                        <!-- Controls -->



                                         <?php if(count($images)>1): ?>

                                            <a class="left carousel-control" href="#carousel-example-generic-<?php echo $string ?>" role="button" data-slide="prev">

                                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>

                                                <span class="sr-only">Previous</span>

                                            </a>



                                            <a class="right carousel-control" href="#carousel-example-generic-<?php echo $string ?>" role="button" data-slide="next">

                                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>

                                                <span class="sr-only">Next</span>

                                            </a>

                                        <?php endif ?>

                                    </div>

                                    <?php

                                }else{

                                    $img = '';

                                    ?>

                                    <img class="img-responsive img-rounded" src="<?php echo $img ?>">

                                <?php } ?>



                            </div>

                            <div class="artic-tools"> 

    							<ul class="list-inline">

                                    <li> 

                                        <a id="tipLike_<?php echo $wishtip->wishtips_id ?>" onclick="<?php echo ($wishtip->is_like)?'unlike_tip(this);':'like_tip(this);' ?>" class="<?php echo ($wishtip->is_like)?'unlikeTip':'likeTip' ?> heart" actType="like_tip" objType="<?php echo 'tip'?>" objectId="<?php echo $wishtip->wishtips_id ?>" obj_parent_id="<?php echo $wishtip->owner_id ?>" title="Like this Tip" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Like this Tip">

                                           <i class="fa fa-heart<?php echo ($wishtip->is_like)?'':'-o' ?>"> </i>

                                        </a> <?php echo ($wishtip->like_count>0)?$wishtip->like_count:'' ?>

                                    </li>



                                    <li> 

                                        <a id="tipPlaneLike_<?php echo $wishtip->wishtips_id ?>" onclick="<?php echo ($wishtip->is_like_plane)?'unlike_tip(this);':'like_tip(this);' ?>" class="<?php echo ($wishtip->is_like_plane)?'unlikeTipPlane':'likeTipPlane' ?> plane" actType="like_tip_in_plane" objType="<?php echo 'tip'?>" objectId="<?php echo $wishtip->wishtips_id ?>" obj_parent_id="<?php echo $wishtip->owner_id ?>" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="I want to go">

                                            <i class="fa fa-plane"> </i>

                                        </a> <?php echo ($wishtip->like_plane_count>0)?$wishtip->like_plane_count:'' ?>

                                    </li>



                                    <li> 

                                        <a id="tipPlaneInLike_<?php echo $wishtip->wishtips_id ?>" onclick="<?php echo ($wishtip->is_like_plane_in)?'unlike_tip(this);':'like_tip(this);' ?>" class="<?php echo ($wishtip->is_like_plane_in)?'unlikeTipPlaneInside':'likeTipPlaneInside' ?> p-plane" actType="like_tip_in_location" objType="<?php echo 'tip'?>" objectId="<?php echo $wishtip->wishtips_id ?>" obj_parent_id="<?php echo $wishtip->owner_id ?>"  href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Important Tip">

                                            <i class="fa fa fa-lightbulb-o"> </i>

                                        </a> <?php echo ($wishtip->like_plane_in_count>0)?$wishtip->like_plane_in_count:'' ?>

                                    </li>



                                    <li> 

                                        <a class="comment <?php echo ($wishtip->comment_count>0)?'comment-comment':'' ?>" id="comment-comment_<?php echo $wishtip->wishtips_id ?>" actType="comment_tip" objType="tip" objectId="<?php echo $wishtip->wishtips_id ?>" obj_parent_id="<?php echo $wishtip->owner_id ?>" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="<?php echo ($wishtip->comment_count>0)?'Comment':'No Comment' ?>">

                                            <i class="fa fa-comment"> </i>

                                        </a>

                                        <span class="tip_comment_count">

                                        <?php echo ($wishtip->comment_count>0)?$wishtip->comment_count:'' ?>

                                        </span>

                                    </li>



                                    <li>

                                        <div class="btn-group">

                                            <a type="button" class="share dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="share-tip_<?php echo $wishtip->wishtips_id ?>" href="javascript:void(0)" actType="share_tip" objType="<?php echo 'tip'?>" objectId="<?php echo $wishtip->wishtips_id ?>" obj_parent_id="<?php echo $wishtip->owner_id ?>" title="Share" data-toggle1="tooltip" data-placement="top" style="padding: 0;">

                                                <i class="fa fa-share-alt"></i>

                                            </a>

                                            <span class="tip_share_count">&nbsp;&nbsp;

                                            <?php //echo ($wishtip->share_count>0)?$wishtip->share_count:'' ?>

                                            </span> 

                                           <ul class="dropdown-menu">

                                                <li>

                                                   <!-- Go to www.addthis.com/dashboard to customize your tools -->

                                                    <div class="addthis_inline_share_toolbox" data-url="<?php echo base_url("home/tips_detail/".$wishtip->wishtips_id); ?>" data-title="<?php echo $wishtip->description ?>" data-media="<?php echo $img ?>">

                                                        

                                                    </div>

                                                </li>

                                            </ul>

                                        </div>

                                    </li>



                                    <li class="pull-right"> 

                                        <?php /*<a class="report" href="javascript:void(0)"> Report Abuse</a>&nbsp;/&nbsp;<a class="report" href="javascript:void(0)"> Hide</a> */?>

                                    </li>

                                </ul> 

                            </div>

                            <div class="commet-box clearfix"> 

                                <div class="col-md-1 comment-avatar">

                                     <?php if (isset($wishtip->profile_pic) && !empty($wishtip->profile_pic)): ?>

                                        <img src="<?php echo base_url("uploads/user-pic/" . $wishtip->profile_pic); ?>">

                                    <?php else: ?>

                                        <img src="<?php echo base_url() ?>assets/images/dis_adv_03.jpg">

                                    <?php endif; ?>

                                </div>

                                <div class="col-md-11 comment-area">

                                    <form id="comment-form_<?php echo $wishtip->wishtips_id ?>" class="form-commen" action="<?php echo base_url('activity/post_comment') ?>" method="POST" actType="comment_tip" objType="tip" objectId="<?php echo $wishtip->wishtips_id ?>" obj_parent_id="<?php echo $wishtip->owner_id ?>">

                                        <div class="col-md-12 form-group">

                                            <textarea class="form-control" name="comment" id="comment" placeholder="Add Comment" cols="2"> </textarea>

                                            <span class="help-block"></span>

                                        </div>

                                        <div class="form-group pull-right tt">

                                            <button type="submit" class="btn btn-info hr"> &nbsp; &nbsp; Post Comment &nbsp; &nbsp; </button>

                                        </div>    

                                    </form>

                                </div>


                                <div class="clearfix"></div>
                            </div>

                        </article>

                    </li>

                    <?php else: ?>

                        <li>

                            <div class="alert alert-danger">

                                <p>

                                    Sorry, no live tip details are found.

                                </p>

                            </div>

                        </li>

                    <?php endif; ?>

                </ul>

                <div class="reviews">

                    <ul class="review_list">

    				<div class="form-group">

    					<a type="submit" class="btn btn-primary" href="<?php echo base_url() ?>" style="    background-color: transparent;color: #000;border: none;font-size: 1.2em;"><i class="fa fa-angle-double-left"></i> Back</a>

    				</div>

    				<?php if(!empty($comments)): ?>

    				<?php foreach($comments as $k=>$comment){  ?>

                        <li class="col-xs-12"> 

                            <div class="row">

                                <div class="col-xs-12">

                                    <div class="avatar">

                                        <a href="<?php echo base_url("home/profile/".$comment->user_id); ?>"> 

    										<?php if (isset($comment->profile_pic) && !empty($comment->profile_pic)): ?>

    											<img src="<?php echo base_url("uploads/user-pic/" . $comment->profile_pic); ?>">

    										<?php else: ?>

    											<img src="<?php echo base_url() ?>assets/images/dis_adv_03.jpg">

    										<?php endif; ?>

    									</a> 

                                    </div>



                                    <div class="content">

                                        <div class="meta">

    										<a href="<?php echo base_url("home/profile/".$comment->user_id); ?>"> 

    											<strong class="name">

    													<?php if($comment->first_name && $comment->last_name){

    																echo ucwords($comment->first_name." ".$comment->last_name);

    														   }else{

    																echo  ucwords($comment->username);

    														   }

    													?>

    											</strong>

    										</a>

                                            <?php if($this->session->userdata("user_id") == $comment->user_id): ?>

                                                <a act_id="<?php echo $comment->act_id ?>" href="javascript:void(0)" class="remove-comment pull-right" title="Remove this comment">

                                                    <i class="fa fa-trash"></i>

                                                </a>

                                            <?php endif; ?>

                                            <p><strong><?php echo humanTime(strtotime($comment->created_date),2)." ago" ?></strong></p>

                                        </div>

                                        <p class="ui__p"><?php echo $comment->data ?></p>

                                    </div>

                                </div>

                            </div>

                        </li>



    					<?php  } ?>

                        <?php if(count($comments) == 5) { ?>

                            <div class="clearfix"></div> 

                            <center>

                             <a actType="comment_tip" objType="tip" objectId="<?php echo $wishtip->wishtips_id ?>" obj_parent_id="<?php echo $wishtip->owner_id ?>" data-loading-text="Loading..." class="more btn btn-link btn-block" data-offset="5" id="loadmore">Show More...</a>

                             </center>

                        <?php  } ?>

                        <?php endif; ?> 

                    </ul> 

                </div>

            </div>


<div class="col-sm-4 wall_center">
            <?php if(!empty($recent_trips)): ?>
                <div class="well1_right">
                    <div class="well1_right_title">
                        <h4>Recent Trips</h4>
                    </div>

                    <?php foreach($recent_trips as $key => $row){ ?>
                    <?php if($key == 0): ?>
                    <div class="well1_right_1">
                        <div class="clearfix">
                            <div class="col-md-8 w1_r">
                                <div class="row">
                                    <a href="<?php echo base_url('trip/trip_details/').$row['trip_id'] ?>" target="_blank">
                                        <h4><?php echo !empty($row['title'])?$row['title']:'Austria Mountains'; ?></h4>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <a target="_blank" href="<?php echo base_url('home/profile/').$row['user_id'] ?>">
                                        <?php if(!empty($row['profile_pic'])): ?>
                                            <img src="<?php echo base_url("uploads/user-pic/".$row['profile_pic']) ?>" width="25%" class="img-responsive pull-right">
                                        <?php else: ?>
                                            <img src="assets/images/dis_adv_02.jpg" width="25%" class="img-responsive pull-right">
                                        <?php endif; ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="well1_right_1_img">
                            <a href="<?php echo base_url('trip/trip_details/').$row['trip_id'] ?>" target="_blank">
                                <?php if (isset($row['photos']) && !empty($row['photos'])): ?>
                                    <img class="img-responsive" src="<?php echo base_url("uploads/" . $row['photos']); ?>"> 
                                <?php else: ?>
                                    <img class="img-responsive" src="<?php echo base_url(); ?>/assets/images/dis_adv_01.jpg"> 
                                <?php endif; ?>
                            </a>

                            <p><?php echo ucfirst($row['description']) ?></p>
                        </div>
                    </div>
                    <?php endif ?>
                    <?php } ?> 
                </div>
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
<div class="clearfix"></div>



<script>

$(function () {

  $('[data-toggle="tooltip"]').tooltip()

})


$(function () {

  $('[data-toggle1="tooltip"]').tooltip()

})


$(document).ready(function () {

    $(document).on("submit",".form-comment", function(e){

        e.preventDefault();

        <?php if(!$this->session->userdata("user_id")): ?>

            window.location.href = "<?php echo base_url("login") ?>";

        <?php else: ?>

            elem = $(this);

            var url = elem.attr("action");

             var _id = elem.attr("id");

            var comment = $.trim(elem.find("#comment").val());

            var objectId = elem.attr('objectId'),objType = elem.attr('objType'),acttype = elem.attr('acttype'),obj_parent_id = elem.attr('obj_parent_id'); 

            if (!comment) {

                msg = "Comment field is required";

                $('#comment').next(".help-block").text(msg);

                $('#comment').removeClass("error").addClass("error");

                return false;

            } else {

                $('#comment').next(".help-block").text("");

                $('#comment').removeClass("error");

            }

            $.ajax({

                url: url,

                type: "POST",

                data: { comment: comment, objectId: objectId, objType: objType,acttype:acttype,obj_parent_id:obj_parent_id },

                dataType: "json",

                success: function (data) {

                    if (!data.error) {

                        $("#"+_id)[0].reset();

                        elem.closest("div.commet-box").prev("div.artic-tools").find("span.tip_comment_count").text(data.likeCount); 

                        elem.closest("div.commet-box").find('div.well').remove();

                        if(data.commentsContent !='')

                        elem.closest("div.commet-box").append(data.commentsContent);

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

});



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

                    var html = '<a id="tipPlaneInLike'+objectId+'" onclick="unlike_tip(this);" obj_parent_id="'+obj_parent_id+'" objType="'+objType+'" acttype="'+acttype+'" objectId="'+objectId+'"  class="unlikeTipPlaneInside p-plane" href="javascript:void(0);" title="Important Tip"><i class="fa fa-lightbulb-o"> </i></a>'+like_count;

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

                    var html = '<a id="tipLike'+objectId+'" onclick="like_tip(this);" obj_parent_id="'+obj_parent_id+'" objType="'+objType+'" acttype="'+acttype+'" objectId="'+objectId+'"  class="likeTip heart" href="javascript:void(0);" title="Like this tip"><i class="fa fa-heart-o"> </i></a>'+like_count;

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