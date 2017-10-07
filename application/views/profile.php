<?php if(isset($profile_detail->cover_image)){
            $cover_image = base_url("uploads/user-pic/".$profile_detail->cover_image);
       }else{
            $cover_image = base_url("assets/images/login_bg.jpg");
       }
?>
<div class="user_profile_cover" style="background:url(<?php echo $cover_image ?>)">
      <div class="container">
          <div class="profile_head_inner">
             <div class="user_info">
                <?php if($profile_detail->first_name && $profile_detail->last_name){
                            $name = ucwords($profile_detail->first_name." ".$profile_detail->last_name);
                       }else{
                            $name = ucwords($profile_detail->username);
                       }
                ?>
                <h1><?php echo $name ?></h1>
                <span>  <?php echo ($profile_detail->profession)?$profile_detail->profession." •":"" ?> 
                        <?php if($profile_detail->gender == 1){
                                    $gender = "Male";
                               }elseif($profile_detail->gender == 2){
                                    $gender = "Female";
                               }else{
                                   $gender = "Other";
                               }
                        ?> <?php echo $gender ?>  
                        <?php
                            if(isset($profile_detail->dob)){
                               # object oriented
                                $from = new DateTime(date("Y-m-d", strtotime($profile_detail->dob)));
                                $to   = new DateTime('today');
                                echo "• ".$from->diff($to)->y." years old"; 
                            }
                        ?>
                </span>
                <?php if(isset($user_detail->user_id) && ($profile_detail->user_id == $user_detail->user_id)): ?>
                 <div class="change-cover" style="top: 210px;right: 0px;">
                    <form action="<?php echo base_url("home/change_cover_image") ?>" enctype="multipart/form-data" method="POST" >
                        <span class="btn btn-default btn-file"><i class="fa fa-camera"> </i> Change cover <input name="cover_image" id="cover_image" type="file"> 
                            <input type="hidden" name="redirect" value="<?php echo current_url() ?>" /></span>
                    </form>
                </div>
				        <?php endif; ?>

                 <?php if(isset($user_detail->user_id) && ($profile_detail->user_id != $user_detail->user_id)): ?>
					<?php if($is_following){ ?>
					<a class="change-cover" id="chat" onclick="chat();" style="top: 210px;">
						<span class="btn btn-default btn-file"><i class="fa fa-weixin"></i> Chat</span> 
					</a>
				    <?php } ?>
					
					<?php if($is_following){ ?>
						<a class="change-cover" id="unfollow" objtype="user" objectId="<?php echo $profile_detail->user_id ?>" style="top: 210px;right: 130px;">
							<span class="btn btn-default btn-file"><i class="fa fa-minus"></i>  Unfollow Me</span> 
						</a>
					<?php }else{ ?>
						<a class="change-cover" id="follow" objtype="user" objectId="<?php echo $profile_detail->user_id ?>" style="top: 210px;right: 130px;">
							<span class="btn btn-default btn-file"><i class="fa fa-user-plus"></i> Follow me</span> 
						</a>
					<?php } ?>
				<?php endif; ?>
             </div>
             <div class="user-media-block"> 
                 <div class="media-outer">
                    <div class="check">
                      <?php if($profile_detail->approve): ?>
                        <i class="fa fa-check-circle"> </i>
                      <?php endif; ?>
                    </div> 
                     <div class="media-thumb up_img_cus">
                         <?php if(isset($user_detail->user_id) && ($profile_detail->user_id == $user_detail->user_id)): ?>
                         <form action="<?php echo base_url("home/change_profile_pic") ?>" enctype="multipart/form-data" method="POST" >
                             <div class="cp_upload">
                                 <label for="profile_pic" class="btn"><i class="fa fa-camera"></i></label>
                                 <input id="profile_pic" name="profile_pic" style="visibility:hidden;" type="file">
                                 <input type="hidden" name="redirect" value="<?php echo current_url() ?>" />
                             </div>
                         </form>
                         <?php endif; ?>
                         <?php if (isset($profile_detail->profile_pic) && !empty($profile_detail->profile_pic)): ?>
                            <img class="img-responsive img-circle" src="<?php echo base_url("uploads/user-pic/" . $profile_detail->profile_pic); ?>">
                        <?php else: ?>
                            <img class="img-responsive img-circle" src="<?php echo base_url("assets/images/default_avatar.png"); ?>">
                        <?php endif; ?>
                    </div>
                 </div>
                 <?php if(isset($user_detail->user_id) && ($profile_detail->user_id == $user_detail->user_id)): ?>
                 <div class="claim-outer"> 
                    <div class="claim-box"> 
                        <span> Credit </span>
                        <?php if(!empty($credit_points)): ?>
                          <?php foreach($credit_points as $k=>$point): ?>
                            <?php
                                if($k == 0){
                                    $pnt = $total_pic_count / $point->total_picture;
                                    $pnt = round($pnt)*$point->credit_point;
                                }else{
                                  $pnt = 0;
                                }
                            ?>
                          <?php endforeach; ?>
                        <?php else: ?>
                          <?php $pnt = 0; ?>
                        <?php endif; ?>
                        
                        <h2> <?php echo $pnt; ?></h2>
                        <?php if($pnt>0): ?><em> Claim Now </em><?php endif; ?>
                    </div>
                 </div>
                 <?php endif; ?>
             </div>  
          </div> 
      </div>
  </div>
  <section class="other_info">
      <div class="container"> 
            <ul class="list-inline"> 
               <li>
                  <i class="fa fa-pencil"> </i> <?php echo count($followers); ?> Followers
               </li>
               <li>
                  <i class="fa fa-globe"> </i> <?php echo $visited_country; ?> Country visited
               </li>
               <li>
                &nbsp;  
               </li>
			   <?php if(!empty($profile_detail->travel_with)): ?>
               <li>
					<i class="fa fa-briefcase"> </i> I Like Travel
					<?php if($profile_detail->travel_with == 1) {
						echo "Alone";
					}elseif($profile_detail->travel_with == 2){
						echo "With Family";
					}elseif($profile_detail->travel_with == 3){
						echo "With Friends";
					}elseif($profile_detail->travel_with == 4){
						echo "With Office Members";
					}elseif($profile_detail->travel_with == 5){
						echo "With Colleague";
					}
					?>
               </li>
			   <?php else: ?>
                <li>
                    <i class="fa fa-briefcase"> </i> I Like Travel ALone
                </li>
                <?php endif; ?>
			    <?php if(!empty($profile_detail->travelling)): ?>
               <li>
                  <i class="fa fa-plane"> </i> I Like Travel
				  <?php if($profile_detail->travelling == 1) {
						echo "Alone";
					}elseif($profile_detail->travelling == 2){
						echo "Together";
					}
					?>
               </li>
                <?php else: ?>
                    <li>
                        <i class="fa fa-plane"> </i> I Like Travel ALone
                    </li>
                <?php endif; ?>
            </ul>
      </div> 
  </section>
  <section class="language_holiday">
      <div class="container">
         <div class="language_know text-center">
            <ul class="language_list">
                <li> <i class="fa fa-language"> </i> <?php echo $profile_detail->language; ?> </li>
            </ul> 
         </div>
         <div class="holiday-box text-center">
            <ul class="holiday_list">
                <?php if(!empty($profile_detail->user_location)){ ?> <li> <i class="fa fa-globe"> </i> <?php echo $profile_detail->user_location ?> </li><?php  } ?>
				
                <?php if(!empty($trip_count)){ ?>
                <li> <i class="fa fa-rocket"> </i> <?php echo $trip_count; ?> holidays </li>
				<?php  } ?>
            </ul> 
         </div>
       </div> 
  </section>

  <?php if (!empty($user_trips)): ?>
  <section class="latest_holiay_project">
     <div class="container"> 
         <div class="title"> My latest <span> holiday projects </span> </div>
         <div class="row"> 
                <?php foreach ($user_trips as $trip) { ?>
                    <div class="col-sm-4"> 
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
						  <?php if(isset($user_detail->user_id) && ($profile_detail->user_id != $user_detail->user_id)): ?>
							<div class="fav_icon_box">
								<?php if(in_array($user_detail->user_id,$trip['faverites'])): ?>
									<a onclick="make_favorite_unfavorite_trip(this)" href="javascript:void(0);" data-href="<?php echo base_url("activity/unfavorite") ?>" class="active" id="unwish-<?php echo $trip['trip_id'] ?>" objtype="trip" objectId="<?php echo $trip['trip_id'] ?>" ownerId="<?php echo $profile_detail->user_id ?>"> <i class="fa fa-heart"> </i> </a>
								<?php else: ?>
									<a onclick="make_favorite_unfavorite_trip(this)" href="javascript:void(0);" data-href="<?php echo base_url("activity/favorite") ?>" class="" id="wish-<?php echo $trip['trip_id'] ?>" objtype="trip" objectId="<?php echo $trip['trip_id'] ?>" ownerId="<?php echo $profile_detail->user_id ?>"> <i class="fa fa-heart-o"> </i> </a>
								<?php endif; ?>
							</div>
						  <?php endif; ?>
                           <div class="img_container"> 
                                <a href="<?php echo base_url("trip/trip_details/" . $trip['trip_id']) ?>">
                                    <?php if (isset($trip['picture']) && !empty($trip['picture'])): ?>
                                        <img src="<?php echo base_url("uploads/" . $trip['picture'][0]['file_name']); ?>">
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
         </div>
     </div> 
  </section>
<?php endif; ?> 
 
  <section class="peoples_corner"> 
     <div class="container">
		<?php if(!empty($trip_reviews)){ ?>
        <div class="title"> <span> What </span> people with whom I said about me </div>
		 <div class="reviews">
            <ul class="review_list">
				<?php 
					foreach($trip_reviews as $i=>$review):
					if($i <=4){
				?>
				<li> 
					<div class="row">
						<div class="col-xs-12 col-sm-7 col-lg-6">
							<div class="avatar">
								<a href="<?php echo base_url('home/profile/'.$review['user_id']) ?>">
									<?php if (isset($review['profile_pic']) && !empty($review['profile_pic'])): ?>
										<img src="<?php echo base_url("uploads/user-pic/" . $review['profile_pic']); ?>"> 
									<?php else: ?>
										<img src="<?php echo base_url(); ?>/assets/images/default_avatar.png">
									<?php endif; ?>
								</a>
							</div>
					  
						<div class="content">
						<div class="meta">
							<a href="<?php echo base_url('home/profile/'.$review['user_id']) ?>">
								<strong class="name">
									<?php if($review['first_name'] && $review['last_name']){
												echo ucwords($review['first_name']." ".$review['last_name']);
										   }else{
												echo ucwords($review['username']);
										   }
									?>
								</strong>
							</a>
							  <p>review about <a target="_blank" href="<?php echo base_url("trip/trip_details/".$review['trip_id']); ?>"><?php echo $review['title'];?></a>
							   - <strong><?php echo date("F Y", strtotime($review['created_date'])); ?></strong></p>
						</div>
						   <p class="ui__p"><?php echo $review['description'];?></p>
					</div>
					  </div>
					</div>
				</li>
				<?php } ?>
				<?php endforeach; ?>
            </ul> 
         </div>
		 <?php } ?>
         <?php if(!empty($followings)){ ?>
		 <div class="follow_wrap">
             <div class="row"> 
                <div class="col-xs-12 col-sm-7 col-lg-6">
				
                    <h1> I'm<strong> followed</strong> by:</h1>
                    <div class="followers_list">
                        <ul class="list-inline">
                            <?php foreach($followings as $k=>$following){ ?>
								<?php if ($k <=9){ ?>
									<li> 
									  <a href="<?php echo base_url('home/profile/'.$following['user_id']) ?>"> 
										<div class="foll_media_thumb"> 
											<?php if(!empty($following['profile_pic'])): ?>
												<img class="img-responsive" src="<?php echo base_url("uploads/user-pic/".$following['profile_pic']) ?>" alt="...">
											<?php else: ?>
												<img class="img-responsive" src="<?php echo base_url("assets/images/default_avatar.png"); ?>" alt="...">
											<?php endif; ?>
										</div>
									  </a>
									</li>
								<?php }else{ ?>
									<li> 
									  <a href="#"> 
										<div class="foll_media_thumb other_link"> 
										 <strong>Other</strong> <?php echo count($followings)-10 ?>
									   </div>
									  </a>
									</li> 
								<?php } ?>
							<?php } ?>
                        </ul> 
                    </div>
                </div>
             </div> 
         </div>
		 <?php } ?>
		 <?php if(!empty($followers)){ ?>
         <div class="follow_wrap">
             <div class="row"> 
                <div class="col-xs-12 col-sm-7 col-lg-6">
                    <h1> <strong>I follow</strong> </h1>
                    <div class="followers_list">
                        <ul class="list-inline">
							<?php foreach($followers as $k=>$follower){ ?>
								<?php if ($k <=9){ ?>
									<li> 
									  <a href="<?php echo base_url('home/profile/'.$follower['user_id']) ?>"> 
										<div class="foll_media_thumb"> 
											<?php if(!empty($follower['profile_pic'])): ?>
												<img class="img-responsive" src="<?php echo base_url("uploads/user-pic/".$follower['profile_pic']) ?>" alt="...">
											<?php else: ?>
												<img class="img-responsive" src="<?php echo base_url("assets/images/default_avatar.png"); ?>" alt="...">
											<?php endif; ?>
										</div>
									  </a>
									</li>
								<?php }else{ ?>
									<li> 
									  <a href="#"> 
										<div class="foll_media_thumb other_link"> 
										 <strong>Other</strong> <?php echo count($followers)-10 ?>
									   </div>
									  </a>
									</li> 
								<?php } ?>
							<?php } ?>
                        </ul> 
                    </div>
                </div>
             </div> 
         </div>
		 <?php } ?>
     </div>
  </section>
<!-- For message popup -->
<div class="modal fade" id="message-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Message</h4>
      </div>
      <form method="POST" action="<?php echo base_url('home/send_message'); ?>" id="message-form" data-ref-id="<?php echo $profile_detail->user_id ?>" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="col-lg-12 send_messgae">
            
            <div class="form-group">
              <label for=""></label>
              <textarea class="form-control" name="message" id="message" placeholder="Write here..." rows="3"></textarea>
              <span class="help-block"></span>
            </div>

            <div class="clearfix"></div>

            <div class="form-group pull-left uplodee">
              <span class="btn btn-success msg-btn-file">
                  <i class="fa fa-paperclip"> </i> Add Files  <input name="msg_files" id="msg_files" type="file">
              </span>
              <div class="clearfix"></div>
               <img width="40" height="40" class="files img-responsive">
            </div>
            
            <div class="form-group pull-left uplodee">
              <span class="btn btn-success msg-btn-file">
                 <i class="fa fa-camera"> </i> Add Photos <input name="msg_photos" id="msg_photos" type="file"> 
              </span>
              <div class="clearfix"></div>
              <img width="40" height="40" class="photos img-responsive">
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary mes-btn">Send</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- end Popup -->
<script>
    $(document).ready(function() {
      $("#cover_image,#profile_pic").on('change', function () {
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            var error = "Only "+fileExtension.join(', ')+"formats are allowed.";
            $(this).val("").clone(true);
            var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+error+'</div>';
            $("#alert-modal").find(".modal-body").html(msg);
            $("#alert-modal").modal("show");
            setTimeout(function(){
                $("#alert-modal").find(".modal-body").empty();
                $("#alert-modal").modal("hide");
          }, 2000);

        }else{
            $(this).closest("form").submit();
        }
      });

        $(document).on('click', "#follow", function (ev) {
		    ev.preventDefault();
          <?php if(!$this->session->userdata("user_id")): ?>
              window.location.href = "<?php echo base_url("login") ?>";
          <?php else: ?>
              var objectId = $(this).attr('objectId'),objType = $(this).attr('objType');
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('activity/follow') ?>",
                    data: { objectId: objectId, objType: objType },
                    dataType: "json",
                    beforeSend: function(){
                       
                    },
                    success: function(data){
                        if(!data.error){
            							var html = '<a class="change-cover" id="unfollow" objType="'+objType+'" objectId="'+objectId+'" style="top: 210px;right: 130px;"><span class="btn btn-default btn-file"><i class="fa fa-minus"></i> Unfollow Me</span> </a>';
                          var beforeContent = '<a class="change-cover" id="chat" onclick="chat();" style="top: 210px;"><span class="btn btn-default btn-file"><i class="fa fa-weixin"></i> Chat</span></a>';
            							$("#follow").replaceWith(html);	
                          $("#unfollow").before(beforeContent);
                          console.log(beforeContent);
                        }else{
            							var error = '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>'+data.message+'</p></div>';
            							$("#alert-modal").find(".col-md-12").html(error);
            							setTimeout(function(){
            								$("#alert-modal").find(".alert-danger").remove();
            								$("#alert-modal").modal("hide");
            							},2000);
                        }
                    }
              });
          <?php endif; ?>
        });
		
		$(document).on('click', "#unfollow", function (ev) {
			ev.preventDefault();
          <?php if(!$this->session->userdata("user_id")): ?>
              window.location.href = "<?php echo base_url("login") ?>";
          <?php else: ?>
              var objectId = $(this).attr('objectId'),objType = $(this).attr('objType');
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('activity/unfollow') ?>",
                    data: { objectId: objectId, objType: objType },
                    dataType: "json",
                    beforeSend: function(){
                       
                    },
                    success: function(data){
                        if(!data.error){
            							var html = '<a class="change-cover" id="follow" objType="'+objType+'" objectId="'+objectId+'" style="top: 210px;right: 130px;"><span class="btn btn-default btn-file"><i class="fa fa-user-plus"></i> Follow Me</span> </a>';
            							$("#unfollow").replaceWith(html);
                          $("#follow").prev("#chat").remove(); 
                        }else{
            							var error = '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>'+data.message+'</p></div>';
            							$("#alert-modal").find(".col-md-12").html(error);
            							setTimeout(function(){
            								$("#alert-modal").find(".alert-danger").remove();
            								$("#alert-modal").modal("hide");
            							},2000);
                        }
                    }
              });
          <?php endif; ?>
        });
    $(document).on('change', "#msg_photos, #msg_files", function () {
        var _id = $(this).attr("id");
        if($(this).attr("id") == "msg_photos" || $(this).attr("id") == "profile_pic"){
          var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
        }else{
          var fileExtension = ['txt','php','pdf', 'ppt', 'doc', 'ext', 'docx', 'xml', 'zip']; 
        }
        
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            var error = "Only "+fileExtension.join(', ')+" formats are allowed.";
            $(this).val("").clone(true);
            var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+error+'</div>';
            $("#message-modal").find(".modal-body").prepend(msg);
            setTimeout(function(){
                $("#message-modal").find(".alert-danger").remove();
          }, 4000);

        }else{
             $("#message-modal").find(".alert-danger").remove();
              readURL(_id,this);
        }
    });

    $(document).on('click', ".mes-btn", function (ev) {
      ev.preventDefault();
      var message  = $.trim($("#message").val());
      var to  = $(this).closest("form").attr("data-ref-id");
      var url = $(this).closest("form").attr("action");
      if(!message){
        msg = "Message description is required";
        $('#message').next(".help-block").text(msg);
        $('#message').removeClass("error").addClass("error");
        return false;
      }else{
        $('#message').next(".help-block").text("");
        $('#message').removeClass("error");
      }

      var form = $('form')[0]; // You need to use standart javascript object here
      var formData = new FormData(form);
      formData.append('to', to);
       $.ajax({
        url: url,
        type: "POST",
        data: formData,
        dataType: "json",
        processData: false,
        contentType: false,
        success: function(data) {
          if (!data.error) {
            $("message-form").find("input[type='files']").val("").clone(true);
              form.reset();
              $("#message-form").find("img.img-responsive").attr("src", "");
            var msg = '<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Success!</p>'+data.message+'</div>';
            $("#message-modal").find(".modal-body").prepend(msg);
            setTimeout(function(){
              $("#message-modal").find(".alert-success").remove();
              
            }, 4000);
          }else{
            var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+data.message+'</div>';
            $("#message-modal").find(".modal-body").prepend(msg);
            setTimeout(function(){
              $("#message-modal").find(".alert-danger").remove();
            }, 4000);
          } 
        },
        error: function(jqXHR, textStatus, errorMessage) {
          var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+errorMessage+'</div>';
            $("#message-modal").find(".modal-body").prepend(msg);
            setTimeout(function(){
              $("#message-modal").find(".alert-danger").remove();
            }, 4000);
        }
      });
    
    });
  });

    var make_favorite_unfavorite_trip = function (elem) {
        <?php if(!$this->session->userdata("user_id")): ?>
        window.location.href = "<?php echo base_url() ?>";
        <?php else: ?>
        var _ids = elem.id;
        var objectId = $("#" + _ids).attr('objectId'), objType = $("#" + _ids).attr('objType'), ownerId = $("#" + _ids).attr('ownerId');
        var url = $("#" + _ids).attr('data-href');

        $.ajax({
            type: "POST",
            url: url,
            data: {objectId: objectId, objType: objType, ownerId: ownerId},
            dataType: "json",
            success: function (data) {
                if (!data.error) {
                    ($("#" + _ids).hasClass("active")) ? $("#" + _ids).removeClass("active") : $("#" + _ids).addClass("active");
                    ($("#" + _ids).find("i").hasClass("fa-heart-o")) ? $("#" + _ids).find("i").removeClass("fa-heart-o").addClass("fa-heart") : $("#" + _ids).find("i").removeClass("fa-heart").addClass("fa-heart-o");
                    $("#" + _ids).attr("data-href", data.href);
                    $("#" + _ids).attr("id", data.id);
                } else {
                    var error = '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>' + data.message + '</p></div>';
                    $("#alert-modal").find(".col-md-12").html(error);
                    setTimeout(function () {
                        $("#alert-modal").find(".alert-danger").remove();
                        $("#alert-modal").modal("hide");
                    }, 2000);
                }
            }
        });
        <?php endif; ?>
    }

    function readURL(id, input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                if (id == "msg_photos") {
                    $("#" + id).closest("div").find("img").attr('src', e.target.result);
                } else {
                    $("#" + id).closest("div").find("img").attr('src', "<?php echo base_url('assets/images/file-icon.png') ?>");
                }
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    var chat = function () {
        $("#message-modal").find(".alert-danger").remove();
        $("#message-modal").find(".alert-success").remove();
        $("#message-modal").modal("show");
    }
</script>