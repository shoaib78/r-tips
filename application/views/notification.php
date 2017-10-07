<li>

	<?php 
//prt($notification);
		if((isset($notification->objectDetail->first_name) && isset($notification->objectDetail->last_name)) || (isset($notification->objectDetail->username) && !empty($notification->objectDetail->username))){

			$object = ($notification->objectDetail->first_name!='' && $notification->objectDetail->last_name!='')?ucwords($notification->objectDetail->first_name." ".$notification->objectDetail->last_name):ucwords($notification->objectDetail->username);

		}else{

				$object = "";

		}



        if((isset($notification->subjectDetail->first_name) && isset($notification->subjectDetail->last_name)) || (isset($notification->subjectDetail->username) && !empty($notification->subjectDetail->username))){

			$subject = ($notification->subjectDetail->first_name!='' && $notification->subjectDetail->last_name!='')?ucwords($notification->subjectDetail->first_name." ".$notification->subjectDetail->last_name):ucwords($notification->subjectDetail->username);

		}else{

				$subject = "";

		}

	switch($notification->type){

		case 'user_following':

	?>

    <a href="<?php echo base_url('home/profile/'.$notification->objectDetail->user_id) ?>" data-notification_id="<?php echo $notification->notification_id?>" class="media">

        <div class="media-left">

            <span class="icon-wrap icon-circle bg-danger">

            	<?php if(!empty($notification->subjectDetail->profile_pic)): ?>

                    <img class="" src="<?php echo base_url("uploads/user-pic/".$notification->subjectDetail->profile_pic) ?>" alt="...">

                <?php else: ?>

                    <img class="" src="<?php echo base_url("assets/images/default_avatar.png"); ?>" alt="...">

                <?php endif; ?>

            </span>

        </div>

        <div class="media-body">

            <div class="text-nowrap"><?php echo sprintf($notification->body , $subject,$object);  ?></div>

            <small class="text-muted"><i class="fa fa-clock-o"></i>&nbsp;<?php if($notification->created_date !=''){ echo humanTime(strtotime($notification->created_date), 2)." ago"; } ?></small>

        </div>

    </a>

    <?php
		break;

		

		case 'following_you':

	?>

	<a href="<?php echo base_url('home/profile/'.$notification->objectDetail->user_id) ?>" data-notification_id="<?php echo $notification->notification_id?>" class="media">

        <div class="media-left">

            <span class="icon-wrap icon-circle bg-danger">

            	<?php if(!empty($notification->subjectDetail->profile_pic)): ?>

                    <img class="" src="<?php echo base_url("uploads/user-pic/".$notification->subjectDetail->profile_pic) ?>" alt="...">

                <?php else: ?>

                    <img class="" src="<?php echo base_url("assets/images/default_avatar.png"); ?>" alt="...">

                <?php endif; ?>

            </span>

        </div>

        <div class="media-body">

            <div class="text-nowrap"><?php echo sprintf($notification->body , $subject,$object);  ?></div>

            <small class="text-muted"><i class="fa fa-clock-o"></i>&nbsp;<?php if($notification->created_date !=''){ echo humanTime(strtotime($notification->created_date), 2)." ago"; } ?></small>

        </div>

    </a>

    <?php

		break;

		case 'comment_tip':

        if(isset($notification->objectDetail[0]->title) && !empty($notification->objectDetail[0]->title)){

            $object = ucfirst($notification->objectDetail[0]->title);

        }else{

                $object = "";
                continue;
        }

	?>

	<a href="<?php echo base_url('home/tips_detail/'.$notification->objectDetail[0]->wishtips_id) ?>" data-notification_id="<?php echo $notification->notification_id?>" class="media">

        <div class="media-left">

            <span class="icon-wrap icon-circle bg-danger">

            	<?php if(!empty($notification->subjectDetail->profile_pic)): ?>

                    <img class="" src="<?php echo base_url("uploads/user-pic/".$notification->subjectDetail->profile_pic) ?>" alt="...">

                <?php else: ?>

                    <img class="" src="<?php echo base_url("assets/images/default_avatar.png"); ?>" alt="...">

                <?php endif; ?>

            </span>

        </div>

        <div class="media-body">

            <div class="text-nowrap"><?php echo sprintf($notification->body , $subject,$object);  ?></div>

            <small class="text-muted"><i class="fa fa-clock-o"></i>&nbsp;<?php if($notification->created_date !=''){ echo humanTime(strtotime($notification->created_date), 2)." ago"; } ?></small>

        </div>

    </a>

    <?php

		break;

		case 'user_review_on_trip':

	?>

	<a href="<?php echo base_url('trip/trip_details/'.$notification->objectDetail->trip_id) ?>" data-notification_id="<?php echo $notification->notification_id?>" class="media">

        <div class="media-left">

            <span class="icon-wrap icon-circle bg-danger">

            	<?php if(!empty($notification->subjectDetail->profile_pic)): ?>

                    <img class="" src="<?php echo base_url("uploads/user-pic/".$notification->subjectDetail->profile_pic) ?>" alt="...">

                <?php else: ?>

                    <img class="" src="<?php echo base_url("assets/images/default_avatar.png"); ?>" alt="...">

                <?php endif; ?>

            </span>

        </div>

        <div class="media-body">

            <div class="text-nowrap"><?php echo sprintf($notification->body , $subject,$object);  ?></div>

            <small class="text-muted"><i class="fa fa-clock-o"></i>&nbsp;<?php if($notification->created_date !=''){ echo humanTime(strtotime($notification->created_date), 2)." ago"; } ?></small>

        </div>

    </a>

    <?php

		break;

		case 'review_your_trip':

	?>

	<a href="<?php echo base_url('trip/trip_details/'.$notification->objectDetail->trip_id) ?>" data-notification_id="<?php echo $notification->notification_id?>" class="media">

        <div class="media-left">

            <span class="icon-wrap icon-circle bg-danger">

            	<?php if(!empty($notification->subjectDetail->profile_pic)): ?>

                    <img class="" src="<?php echo base_url("uploads/user-pic/".$notification->subjectDetail->profile_pic) ?>" alt="...">

                <?php else: ?>

                    <img class="" src="<?php echo base_url("assets/images/default_avatar.png"); ?>" alt="...">

                <?php endif; ?>

            </span>

        </div>

        <div class="media-body">

            <div class="text-nowrap"><?php echo sprintf($notification->body , $subject,$object);  ?></div>

            <small class="text-muted"><i class="fa fa-clock-o"></i>&nbsp;<?php if($notification->created_date !=''){ echo humanTime(strtotime($notification->created_date), 2)." ago"; } ?></small>

        </div>

    </a>

    <?php

		break;

		case 'post_tip':

        if(isset($notification->objectDetail[0]->title) && !empty($notification->objectDetail[0]->title)){

            $object = ucfirst($notification->objectDetail[0]->title);

        }else{

                $object = "";
                continue;

        }

	?>

	<a href="<?php echo base_url('home/tips_detail/'.$notification->objectDetail[0]->wishtips_id) ?>" data-notification_id="<?php echo $notification->notification_id?>" class="media">

        <div class="media-left">

            <span class="icon-wrap icon-circle bg-danger">

            	<?php if(!empty($notification->subjectDetail->profile_pic)): ?>

                    <img class="" src="<?php echo base_url("uploads/user-pic/".$notification->subjectDetail->profile_pic) ?>" alt="...">

                <?php else: ?>

                    <img class="" src="<?php echo base_url("assets/images/default_avatar.png"); ?>" alt="...">

                <?php endif; ?>

            </span>

        </div>

        <div class="media-body">

            <div class="text-nowrap"><?php echo sprintf($notification->body , $subject,$object);  ?></div>

            <small class="text-muted"><i class="fa fa-clock-o"></i>&nbsp;<?php if($notification->created_date !=''){ echo humanTime(strtotime($notification->created_date), 2)." ago"; } ?></small>

        </div>

    </a>

    <?php

		break;

		case 'like_tip':

        if(isset($notification->objectDetail[0]->title) && !empty($notification->objectDetail[0]->title)){

            $object = ucfirst($notification->objectDetail[0]->title);

        }else{

                $object = "";
                continue;
        }

	?>

	<a href="<?php echo base_url('home/tips_detail/'.$notification->objectDetail[0]->wishtips_id) ?>" data-notification_id="<?php echo $notification->notification_id?>" class="media">

        <div class="media-left">

            <span class="icon-wrap icon-circle bg-danger">

            	<?php if(!empty($notification->subjectDetail->profile_pic)): ?>

                    <img class="" src="<?php echo base_url("uploads/user-pic/".$notification->subjectDetail->profile_pic) ?>" alt="...">

                <?php else: ?>

                    <img class="" src="<?php echo base_url("assets/images/default_avatar.png"); ?>" alt="...">

                <?php endif; ?>

            </span>

        </div>

        <div class="media-body">

            <div class="text-nowrap" style=""><?php echo sprintf($notification->body , $subject,$object);  ?></div>

            <small class="text-muted"><i class="fa fa-clock-o"></i>&nbsp;<?php if($notification->created_date !=''){ echo humanTime(strtotime($notification->created_date), 2)." ago"; } ?></small>

        </div>

    </a>

    <?php

		break;

		case 'like_tip_in_plane':

        if(isset($notification->objectDetail[0]->title) && !empty($notification->objectDetail[0]->title)){

            $object = ucfirst($notification->objectDetail[0]->title);

        }else{

                $object = "";
                continue;

        }

	?>

	<a href="<?php echo base_url('home/tips_detail/'.$notification->objectDetail[0]->wishtips_id) ?>" data-notification_id="<?php echo $notification->notification_id?>" class="media">

        <div class="media-left">

            <span class="icon-wrap icon-circle bg-danger">

            	<?php if(!empty($notification->subjectDetail->profile_pic)): ?>

                    <img class="" src="<?php echo base_url("uploads/user-pic/".$notification->subjectDetail->profile_pic) ?>" alt="...">

                <?php else: ?>

                    <img class="" src="<?php echo base_url("assets/images/default_avatar.png"); ?>" alt="...">

                <?php endif; ?>

            </span>

        </div>

        <div class="media-body">

            <div class="text-nowrap"><?php echo sprintf($notification->body , $subject,$object);  ?></div>

            <small class="text-muted"><i class="fa fa-clock-o"></i>&nbsp;<?php if($notification->created_date !=''){ echo humanTime(strtotime($notification->created_date), 2)." ago"; } ?></small>

        </div>

    </a>

    <?php

		break;

		case 'like_tip_in_location':

        if(isset($notification->objectDetail[0]->title) && !empty($notification->objectDetail[0]->title)){

            $object = ucfirst($notification->objectDetail[0]->title);

        }else{

                $object = "";
                continue;

        }

	?>

	<a href="<?php echo base_url('home/tips_detail/'.$notification->objectDetail[0]->wishtips_id) ?>" data-notification_id="<?php echo $notification->notification_id?>" class="media">

        <div class="media-left">

            <span class="icon-wrap icon-circle bg-danger">

            	<?php if(!empty($notification->subjectDetail->profile_pic)): ?>

                    <img class="" src="<?php echo base_url("uploads/user-pic/".$notification->subjectDetail->profile_pic) ?>" alt="...">

                <?php else: ?>

                    <img class="" src="<?php echo base_url("assets/images/default_avatar.png"); ?>" alt="...">

                <?php endif; ?>

            </span>

        </div>

        <div class="media-body">

            <div class="text-nowrap"><?php echo sprintf($notification->body , $subject,$object);  ?></div>

            <small class="text-muted"><i class="fa fa-clock-o"></i>&nbsp;<?php if($notification->created_date !=''){ echo humanTime(strtotime($notification->created_date), 2)." ago"; } ?></small>

        </div>

    </a>

    <?php

		break;

		case 'share_tip':

        if(isset($notification->objectDetail[0]->title) && !empty($notification->objectDetail[0]->title)){

           $object = ucfirst($notification->objectDetail[0]->title);

        }else{

                $object = "";
                continue;

        }

	?>

	<a href="<?php echo base_url('home/tips_detail/'.$notification->objectDetail[0]->wishtips_id) ?>" data-notification_id="<?php echo $notification->notification_id?>" class="media">

        <div class="media-left">

            <span class="icon-wrap icon-circle bg-danger">

            	<?php if(!empty($notification->subjectDetail->profile_pic)): ?>

                    <img class="" src="<?php echo base_url("uploads/user-pic/".$notification->subjectDetail->profile_pic) ?>" alt="...">

                <?php else: ?>

                    <img class="" src="<?php echo base_url("assets/images/default_avatar.png"); ?>" alt="...">

                <?php endif; ?>

            </span>

        </div>

        <div class="media-body">

            <div class="text-nowrap"><?php echo sprintf($notification->body , $subject,$object);  ?></div>

            <small class="text-muted"><i class="fa fa-clock-o"></i>&nbsp;<?php if($notification->created_date !=''){ echo humanTime(strtotime($notification->created_date), 2)." ago"; } ?></small>

        </div>

    </a>

    <?php

		break;

	}

	?>

</li>