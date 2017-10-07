<?php if(!empty($profile)){ ?>
	<div class="col-sm-12 message_right-header">
		<div class="col-sm-7">
				<div class="media">
				  <div class="media-left">
					<a href="<?php echo base_url('home/profile/'.$profile->user_id) ?>">
						<?php if (isset($profile->profile_pic) && !empty($profile->profile_pic)): ?>
	                        <img class="media-object" src="<?php echo base_url("uploads/user-pic/" . $profile->profile_pic); ?>">
	                    <?php else: ?>
	                        <img class="media-object" src="<?php echo base_url("assets/images/default_avatar.png"); ?>">
	                    <?php endif; ?> 
					</a>
				  </div>
				  <div class="media-body media-middle">
					<h4 class="media-heading">
						<?php if($profile->first_name && $profile->last_name){
		                            echo ucwords($profile->first_name." ".$profile->last_name);
		                       }else{
		                           echo ucwords($profile->username);
		                       }
		                ?>
					</h4>
					<small><i class="fa fa-map-marker"></i> <?php echo $profile->location; ?> </small>
				  </div>
				</div>
		</div>
	</div>
<?php }else{ ?>
	<div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <b>Sorry, user detail not found.</b>
    </div>
<?php } ?>