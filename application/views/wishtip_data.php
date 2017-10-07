

<?php if(!empty($wishtips)): ?>

	<?php $i = 1; ?>

	<?php foreach($wishtips as $k=>$wishtip){  ?>

	<li> 

		<article>

			<div class="articale-header">

				<div class="col-md-1 artical-avatar">

					<a href="<?php echo base_url("'home/profile/'".$wishtip->user_id); ?>">

						<?php if (isset($wishtip->profile_pic) && !empty($wishtip->profile_pic)): ?>

							<img src="<?php echo base_url("uploads/user-pic/" . $wishtip->profile_pic); ?>">

						<?php else: ?>

							<img src="<?php echo base_url() ?>assets/images/dis_adv_03.jpg">

						<?php endif; ?>

					</a>

				</div> 

				<div class="col-md-11 artical-content">

					<?php if(isset($user_id)&& !empty($user_id) && $user_id == $this->session->userdata('user_id')): ?>

						<div class="tip-trash btn-group pull-right" role="group">

                            <button type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                <span class="caret"></span>

                            </button>

                            <ul class="dropdown-menu">

                                <li><a id="<?php echo $wishtip->wishtips_id ?>" class="delete-tip" title="Delete this Tip" href="javascript:void(0)">Delete Tip</a></li>

                            </ul>

                        </div>

					<?php endif; ?>

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

                            <?php echo humanTime(strtotime($wishtip->created_date), 1) . " ago"; ?>

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

	                    <a id="tipPlaneInLike_<?php echo $wishtip->wishtips_id ?>" onclick="<?php echo ($wishtip->is_like_plane_in)?'unlike_tip(this);':'like_tip(this);' ?>" class="<?php echo ($wishtip->is_like_plane_in)?'unlikeTipPlaneInside':'likeTipPlaneInside' ?> p-plane" actType="like_tip_in_location" objType="<?php echo 'tip'?>" objectId="<?php echo $wishtip->wishtips_id ?>" obj_parent_id="<?php echo $wishtip->owner_id ?>"  data-toggle="tooltip" data-placement="top" href="javascript:void(0)" title="Important Tip">

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

	                      <a type="button" class="share dropdown-toggle" style="padding: 0;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="share-tip_<?php echo $wishtip->wishtips_id ?>" href="javascript:void(0)" actType="share_tip" objType="<?php echo 'tip'?>" objectId="<?php echo $wishtip->wishtips_id ?>" obj_parent_id="<?php echo $wishtip->owner_id ?>" data-toggle1="tooltip" data-placement="top" title="Share">

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
                        <p>
                            <a class="report" href="javascript:void(0)" onclick="report('<?php echo $wishtip->wishtips_id ?>');"> Report Abuse</a>
                            &nbsp;<strong style="font-size: 7px;vertical-align: middle;">
                                    <i class="fa fa-circle"></i>
                                    </strong>
                            <a class="report hide_tips" id="tip_<?php echo $wishtip->wishtips_id ?>" href="javascript:void(0)"  actType="hide_tip" objType="<?php echo 'tip' ?>" objectId="<?php echo $wishtip->wishtips_id ?>" obj_parent_id="<?php echo $wishtip->owner_id ?>" title="Hide this tip">Hide</a>
                        </p>
                    </li>
	            </ul> 

			</div>

			<div class="commet-box clearfix"> 

				<div class="col-md-1 col-sm-1 col-xs-1 comment-avatar">

                    <?php if (isset($user_detail->profile_pic) && !empty($user_detail->profile_pic)): ?>

                        <img src="<?php echo base_url("uploads/user-pic/" . $user_detail->profile_pic); ?>">

                    <?php else: ?>

                        <img src="<?php echo base_url() ?>assets/images/default_avatar.png">

                    <?php endif; ?>

                </div>

				<div class="col-md-11 col-sm-10 col-xs-10 comment-area">

                    <form id="comment-form_<?php echo $wishtip->wishtips_id ?>" class="form-comment" action="<?php echo base_url('activity/post_comment') ?>" method="POST" actType="comment_tip" objType="tip" objectId="<?php echo $wishtip->wishtips_id ?>" obj_parent_id="<?php echo $wishtip->owner_id ?>">

                        <div class="col-md-12 form-group formmm">

                            <textarea class="form-control" name="comment" id="comment" placeholder="Add Comment" cols="2"> </textarea>

                            <span class="help-block"></span>

                        </div>

                        <div class="form-group pull-right tt">

                            <button type="submit" class="btn btn-default btn-sm hr"> &nbsp; &nbsp; Post Comment &nbsp; &nbsp; </button>

                        </div>

                    </form>

                </div>



			</div>

			<div class="clearfix"></div>

		</article>

	</li>

	

	<?php } ?>

	

	<?php if(count($wishtips) < $total_count): ?>

       <div class="show-more">

	        <a data-id="<?php echo (isset($user_id)&& !empty($user_id))?$user_id:'' ?>" data-location = "<?php echo (isset($location)&& !empty($location))?$location:'' ?>" data-cat="<?php echo (isset($cat)&& !empty($cat))?$cat:'' ?>" data-bookmark="" data-loading-text="Loading..." data-set="1" class="more btn btn-link btn-block" id="loadmoreTip">Show More...</a>

	    </div>

    <?php endif; ?>

<?php else: ?>

	<li>

		<div class="alert alert-danger">

			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

			<b>Sorry, no live tips are found.</b>

		</div>

	</li>

<?php endif; ?>

<script>

var script = 'http://s7.addthis.com/js/250/addthis_widget.js#domready=1';

if (window.addthis) {

    window.addthis = null;

}

$.getScript(script);







$(function () {

  $('[data-toggle="tooltip"]').tooltip()

})



$(function () {

  $('[data-toggle1="tooltip"]').tooltip()

})





</script>