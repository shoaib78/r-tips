<?php if(!empty($messages)){ ?>
		<?php if(!empty($messages)) { ?>
			<?php foreach($messages as $key=>$val) { 
				if($val->from == $user_detail->user_id ){
			?>
				<div class="col-sm-12 message_chat chat_left">
					<div class="media">
						  <div class="media-left">
							<a href="<?php echo base_url('home/profile/'.$val->user_id) ?>">
							  	<?php if (isset($val->profile_pic) && !empty($val->profile_pic)): ?>
		                            <img class="media-object" src="<?php echo base_url("uploads/user-pic/" . $val->profile_pic); ?>">
		                        <?php else: ?>
		                            <img class="media-object" src="<?php echo base_url("assets/images/default_avatar.png"); ?>">
		                        <?php endif; ?> 
							</a>
						  </div>
						  <div class="media-body">
							<?php echo $val->message ?>
							<small><?php echo humanTime(strtotime($val->created_date),1)." ago" ?></small>
						 </div>
					</div>
				</div>
				<?php }else{ ?>
				<div class="col-sm-12 message_chat chat_right">
					<div class="media">
						  
						  <div class="media-body">
							<?php echo $val->message ?>
							<small><?php echo humanTime(strtotime($val->created_date),1)." ago" ?></small>
						  </div>
						  <div class="media-left">
							<a href="<?php echo base_url('home/profile/'.$val->user_id) ?>">
							  	<?php if (isset($val->profile_pic) && !empty($val->profile_pic)): ?>
		                            <img class="media-object" src="<?php echo base_url("uploads/user-pic/" . $val->profile_pic); ?>">
		                        <?php else: ?>
		                            <img class="media-object" src="<?php echo base_url("assets/images/default_avatar.png"); ?>">
		                        <?php endif; ?> 
							</a>
						  </div>
					</div>
				</div>
				<?php } ?>
			<?php } ?>
		<?php } ?>
<?php }else{ ?>
	<div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <b>Sorry, No message conversions are available.</b>
    </div>
<?php } ?>
