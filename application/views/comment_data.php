<div class="col-md-12 col-sm-12 well wall_comments">
    <ul class="review_list">
<?php if(!empty($comments)): ?>
	<?php foreach($comments as $k=>$comment){  ?>
		<li class="col-xs-12"> 
			<div class="row">
				<div class=" wel1 col-xs-12">
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
												echo ucwords($comment->username);
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
		<?php if(count($comments) < $commentCount) { ?>
                <div class="clearfix"></div> 
                <center>
                    <a actType="comment_tip" objType="tip" objectId="<?php echo $obj_id ?>" obj_parent_id="<?php echo $obj_parent_id ?>" data-loading-text="Loading..." class="more btn btn-link btn-block" data-offset="5" id="loadmore">Show More...</a>
                </center>
            <?php  } ?>
<?php else: ?>
	<li>
		<div class="alert alert-danger">
			<b>Sorry, No comments are found of this tips.</b>
		</div>
	</li>
<?php endif; ?>
</ul>
</div>