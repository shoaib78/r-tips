<?php if (!empty($trips)): ?>
    <?php   foreach ($trips as $key => $trip) { ?>
        <div class="col-sm-6"> 
			<div class="favorites_item_container"> 
                                        <div class="profile_small_thumb">
											<a href="<?php echo base_url('home/profile/'.$trip['user_id']) ?>">
												<?php if(!empty($trip['profile_pic'])): ?>
													<img class="img-responsive" src="<?php echo base_url("uploads/user-pic/".$trip['profile_pic']) ?>" alt="...">
												<?php else: ?>
													<img class="img-responsive" src="<?php echo base_url("assets/images/default_avatar.png"); ?>" alt="...">
												<?php endif; ?>
											</a>
                                        </div>
                                        <?php if(isset($user_detail)): ?>
                                            <div class="fav_icon_box"> 
                                                <?php if(in_array($user_detail->user_id,$trip['faverites'])): ?>
    												<a onclick="make_favorite_unfavorite_trip(this)" href="javascript:void(0);" data-href="<?php echo base_url("activity/unfavorite") ?>" class="active" id="unwish-<?php echo $trip['trip_id'] ?>" objtype="trip" objectId="<?php echo $trip['trip_id'] ?>" ownerId="<?php echo $trip['user_id'] ?>"> <i class="fa fa-heart-o"> </i> </a>
    											<?php else: ?>
    												<a onclick="make_favorite_unfavorite_trip(this)" href="javascript:void(0);" data-href="<?php echo base_url("activity/favorite") ?>" class="" id="wish-<?php echo $trip['trip_id'] ?>" objtype="trip" objectId="<?php echo $trip['trip_id'] ?>" ownerId="<?php echo $trip['user_id'] ?>"> <i class="fa fa-heart-o"> </i> </a>
    											<?php endif; ?> 
                                            </div>
                                        <?php endif; ?>
                                        <div class="img_container"> 
                                            <a href="<?php echo base_url("trip/trip_details/".$trip['trip_id']); ?>">
                                                <?php if (isset($trip['photos']) && !empty($trip['photos'])): ?>
                                                    <img src="<?php echo base_url("uploads/" . $trip['photos'][0]['file_name']); ?>">
                                                <?php else: ?>
                                                    <img src="<?php echo base_url("assets/images/map.jpg"); ?>">
                <?php endif; ?>
                                                <div class="short_info">
                                                    <small>from <?php echo date("d", strtotime($trip['check_in_date'])); ?> to <?php echo date("d F", strtotime($trip['check_out_date'])); ?></small>
                                                    <h3><?php echo $trip['title']; ?></h3>
                                                    <em><?php echo $trip['location']; ?></em>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
        </div>
    <?php } ?>    
<?php else: ?>
    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <b>Sorry, No trips are found.</b>
    </div>
<?php endif; ?>


