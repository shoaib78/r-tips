<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyB1a2NAsRAQICTnCaOZa6wFPgNBRz4rOXM&sensor=false&amp;libraries=places"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.js"></script>
<?php if(isset($user_detail->cover_image)){
            $cover_image = base_url("uploads/user-pic/".$user_detail->cover_image);
       }else{
            $cover_image = base_url("assets/images/login_bg.jpg");
       }
?>
<div class="user_profile_cover" style="background:url(<?php echo $cover_image ?>)">
    <div class="container">
        <div class="profile_head_inner">
            <div class="user_info">
                <?php if($user_detail->first_name && $user_detail->last_name){
                            $name = ucwords($user_detail->first_name." ".$user_detail->last_name);
                       }else{
                            $name = ucwords($user_detail->username);
                       }
                ?>
                <h1><?php echo $name ?></h1>
                <span>  <?php echo ($user_detail->profession)?$user_detail->profession." •":"" ?> 
                        <?php if($user_detail->gender == 1){
                                    $gender = "Male";
                               }elseif($user_detail->gender == 2){
                                    $gender = "Female";
                               }else{
                                   $gender = "Other";
                               }
                        ?> <?php echo $gender ?>  
                        <?php
                            if(isset($user_detail->dob)){
                               # object oriented
                                $from = new DateTime(date("Y-m-d", strtotime($user_detail->dob)));
                                $to   = new DateTime('today');
                                echo "• ".$from->diff($to)->y." years old"; 
                            }
                        ?>
                </span>
                <div class="change-cover">
                    <form action="<?php echo base_url("home/change_cover_image") ?>" enctype="multipart/form-data" method="POST" >
                        <span class="btn btn-default btn-file"><i class="fa fa-camera"> </i> Change cover <input name="cover_image" id="cover_image" type="file"> 
                            <input type="hidden" name="redirect" value="<?php echo current_url() ?>" /></span>
                    </form>
                </div>
            </div>
            <div class="user-media-block"> 
                <div class="media-outer">
                    <div class="check">
                      <?php if($user_detail->approve): ?>
                        <i class="fa fa-check-circle"> </i>
                      <?php endif; ?>
                    </div>
                    <div class="media-thumb">
                            <form action="<?php echo base_url("home/change_profile_pic") ?>" enctype="multipart/form-data" method="POST" >
                                <div class="cp_upload">
                                    <label for="profile_pic" class="btn"><i class="fa fa-camera"></i></label>
                                    <input id="profile_pic" name="profile_pic" style="visibility:hidden;" type="file">
                                    <input type="hidden" name="redirect" value="<?php echo current_url() ?>" />
                                </div>
                            </form>

                        <?php if (isset($user_detail->profile_pic) && !empty($user_detail->profile_pic)): ?>
                                            <img class="img-responsive img-circle" src="<?php echo base_url("uploads/user-pic/" . $user_detail->profile_pic); ?>">
                        <?php else: ?>
                            <img class="img-responsive img-circle" src="<?php echo base_url("assets/images/default_avatar.png"); ?>">
                        <?php endif; ?>
                    </div>
                </div>
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
			   <?php if(!empty($user_detail->travel_with)): ?>
               <li>
					<i class="fa fa-briefcase"> </i> I Like Travel
					<?php if($user_detail->travel_with == 1) {
						echo "Alone";
					}elseif($user_detail->travel_with == 2){
						echo "With Family";
					}elseif($user_detail->travel_with == 3){
						echo "With Friends";
					}elseif($user_detail->travel_with == 4){
						echo "With Office Members";
					}elseif($user_detail->travel_with == 5){
						echo "With Colleague";
					}
					?>
               </li>
               <?php else: ?>
                   <li>
                       <i class="fa fa-briefcase"> </i> I Like Travel ALone
                   </li>
               <?php endif; ?>
			    <?php if(!empty($user_detail->travelling)): ?>
               <li>
                  <i class="fa fa-plane"> </i> I Like Travel
				  <?php if($user_detail->travelling == 1) {
						echo "Alone";
					}elseif($user_detail->travelling == 2){
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


</section>
<section class="favorites site_wrapper">
    <div class="container">
        <h1>Edit Profile</h1>
        <hr>
        <div class="col-sm-8 places_form_main">
            <h3>Personal info</h3>
            <hr>
            <?php
                $file_error = $this->session->flashdata('file_error');
		$success = $this->session->flashdata('success');
            ?>
	
            <?php if(!empty($success)) { echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><b>'.$success.'</b></div>'; } ?>
            <form method="post" id="edit_profile" enctype="multipart/form-data" action="<?php echo current_url() ?>">
                <div class="form-group profile-pic-edit">
                    <?php
                        if(isset($user_detail->profile_pic) && !empty($user_detail->profile_pic)){
                           $img = base_url('uploads/user-pic/'.$user_detail->profile_pic); 
                           $filename = $user_detail->profile_pic;
                        }else{
                           $img = "//placehold.it/100";
                           $filename = "";
                        }
                    ?>
                    <label for="">Select Profile Photo</label><br/>
                    <img src="<?php echo $img; ?>" class="" alt="avatar">
                    <input class="<?php echo (form_error('userfile'))?'error':'' ;?>" name="userfile" id="userfile" type="file">
                    <input type="hidden" value="<?php echo isset($user_detail->profile_pic) ? $user_detail->profile_pic : ''; ?>" name="profile_pic" id="profile_pic" />
                        <span class="help-block <?php echo ($file_error)?'error':'' ;?>"><?php if($file_error): echo $file_error; endif; ?></span>
                        <?php echo form_error('userfile'); ?>
                 </div>
                
                <div class="form-group">
                    <label for="">Date of birth</label>
                    <input data-provide="datepicker" placeholder="Date of birth" class="date form-control <?php echo (form_error('dob'))?'error':'' ;?>" name="dob" id="profession" value="<?php echo set_value('dob') ? set_value('dob') : (isset($user_detail->dob) ? date("d/m/Y",strtotime($user_detail->dob)) : ''); ?>" type="text">
                    <?php echo form_error('dob'); ?>
                </div>
                
                <div class="form-group">
                    <label for="">First name</label>
                    <input class="form-control <?php echo (form_error('first_name'))?'error':'' ;?>" name="first_name" id="first_name" value="<?php echo set_value('first_name') ? set_value('first_name') : (isset($user_detail->first_name) ? $user_detail->first_name : ''); ?>" type="text">
                    <?php echo form_error('first_name'); ?>
                </div>

                <div class="form-group">
                    <label for="">Last name</label>
                    <input class="form-control <?php echo (form_error('last_name'))?'error':'' ;?>" name="last_name" id="last_name" value="<?php echo set_value('last_name') ? set_value('last_name') : (isset($user_detail->last_name) ? $user_detail->last_name : ''); ?>" type="text">
                    <?php echo form_error('last_name'); ?>
                </div>

                <div class="form-group">
                    <label for="">Email</label>
                    <input class="form-control <?php echo (form_error('email'))?'error':'' ;?>" name="email" id="email" value="<?php echo set_value('email') ? set_value('email') : (isset($user_detail->email) ? $user_detail->email : ''); ?>" type="text">
                    <?php echo form_error('email'); ?>
                </div>

                <div class="form-group">
                    <label for="">Username</label>
                    <input class="form-control <?php echo (form_error('username'))?'error':'' ;?>" name="username" id="username" value="<?php echo set_value('username') ? set_value('username') : (isset($user_detail->username) ? $user_detail->username : ''); ?>" type="text" readonly>
                    <?php echo form_error('username'); ?>
                </div>
                
                <div class="form-group">
                    <label for="">Gender</label>
                    <select class="form-control <?php echo (form_error('gender'))?'error':'' ;?>" name="gender" id="gender" class="form-control">
                        <option value="1" <?php if(isset($user_detail->gender) && $user_detail->gender == 1) { ?>selected="selected" <?php } ?>>Male</option>
                        <option value="2" <?php if(isset($user_detail->gender) && $user_detail->gender == 2) { ?>selected="selected" <?php } ?>>Female</option>
                        <option value="3" <?php if(isset($user_detail->gender) && $user_detail->gender == 3) { ?>selected="selected" <?php } ?>>Other</option>
                    </select>
                    <?php echo form_error('gender'); ?>
				</div>
                
                <div class="form-group">
                    <label for="">About Me</label>
                    <textarea name="tips" class="form-control <?php echo (form_error('about_me'))?'error':'' ;?>" id="about_me" name="about_me" rows="5"><?php echo set_value('about_me') ? set_value('about_me') : (isset($user_detail->about_me) ? $user_detail->about_me  : ''); ?></textarea>
                    <span class="help-block"></span>
                    <?php echo form_error('about_me'); ?>
                </div>
                
                <div class="form-group">
                    <label for="">Language</label>
                    <input class="form-control <?php echo (form_error('language'))?'error':'' ;?>" name="language" id="profession" value="<?php echo set_value('language') ? set_value('language') : (isset($user_detail->profession) ? $user_detail->language  : ''); ?>" placeholder="Please enter your language" type="text">
                    <?php echo form_error('language'); ?>
                </div>
                
                
                <div class="form-group">
                    <label for="">Profession</label>
                    <input class="form-control <?php echo (form_error('profession'))?'error':'' ;?>" name="profession" id="profession" value="<?php echo set_value('profession') ? set_value('profession') : (isset($user_detail->profession) ? $user_detail->profession : ''); ?>" placeholder="Please enter your profession" type="text">
                    <?php echo form_error('profession'); ?>
                </div>
                
                <div class="form-group">
                    <label for="">Location</label>
                    <input class="form-control <?php echo (form_error('location'))?'error':'' ;?>" name="location" id="location" value="<?php echo set_value('location') ? set_value('location') : (isset($user_detail->location) ? $user_detail->location : ''); ?>" placeholder="Please enter your location" type="text">
                    <input type="hidden" name="lat" id="lat" value="" />
                    <input type="hidden" name="long" id="long" value="" />
                    <?php echo form_error('location'); ?>
                </div>
				
				<div class="form-group">
                    <label for="">Travel With</label>
                    <select class="form-control <?php echo (form_error('travel_with'))?'error':'' ;?>" name="travel_with" id="travel_with" class="form-control">
                        <option value="1" <?php if(isset($user_detail->travel_with) && $user_detail->travel_with == 1) { ?>selected="selected" <?php } ?>>Alone</option>
                        <option value="2" <?php if(isset($user_detail->travel_with) && $user_detail->travel_with == 2) { ?>selected="selected" <?php } ?>>Family</option>
                        <option value="3" <?php if(isset($user_detail->travel_with) && $user_detail->travel_with == 3) { ?>selected="selected" <?php } ?>>Friends</option>
						<option value="4" <?php if(isset($user_detail->travel_with) && $user_detail->travel_with == 4) { ?>selected="selected" <?php } ?>>Office Members</option>
                        <option value="5" <?php if(isset($user_detail->travel_with) && $user_detail->travel_with == 5) { ?>selected="selected" <?php } ?>>Colleague</option>
                    </select>
                    <?php echo form_error('travel_with'); ?>
				</div>
				
				<div class="form-group">
                    <label for="">I have travel</label>
                    <select class="form-control <?php echo (form_error('travelling'))?'error':'' ;?>" name="travelling" id="travelling" class="form-control">
                        <option value="1" <?php if(isset($user_detail->travelling) && $user_detail->travelling == 1) { ?>selected="selected" <?php } ?>>Alone</option>
                        <option value="2" <?php if(isset($user_detail->travelling) && $user_detail->travelling == 2) { ?>selected="selected" <?php } ?>>Together</option>
                    </select>
                    <?php echo form_error('travelling'); ?>
				</div>
                
                <div class="form-group text-center">
                    <button type="submit" class="edit-profile btn btn-primary"> &nbsp; &nbsp;  Save Changes &nbsp; &nbsp; </button>
                </div>
            </form>

        </div>
    </div>
</section>
<!-- For alert popup -->
<div class="modal fade" id="alert-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <h4 class="modal-title">Error</h4>
            </div>
            <!--Modal body-->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">

                        </div>
                    </div>
                </div>

                <!--Modal footer-->
                <!--Modal footer-->
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                </div>
        </div>
    </div>
</div>
<!-- end Popup -->
<script>
    $(document).ready(function() {
    
    $("#location")
        .geocomplete()
        .bind("geocode:result", function (event, result) {						
        $("#lat").val(result.geometry.location.lat());
        $("#long").val(result.geometry.location.lng());
        //console.log(result);
    });
    
    $( ".edit-profile" ).click(function(e) {	 
	e.preventDefault();
        $(this).closest("form").submit();
    });
    
    $("#cover_image").on('change', function () {
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            var error = "Only "+fileExtension.join(', ')+"formats are allowed.";
            $(this).val("").clone(true);
            var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Errors!</p>'+error+'</div>';
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
    
    $("#userfile").on('change', function () {
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            var error = "Only "+fileExtension.join(', ')+"formats are allowed.";
            $(this).closest("div.text-center").find("span.help-block").text(error);
        }else{
            readURL(this);
            $(this).closest("div.text-center").find("span.help-block").text("");
        }
    });
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#userfile").closest("div.text-center").find("span.filename").text("");
                $("#userfile").closest("div.text-center").find("img").attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>