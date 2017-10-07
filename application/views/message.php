<link href="<?php echo base_url() ?>assets/css/multiple-select.css" rel="stylesheet">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style>
	.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active, a.ui-button:active, .ui-button:active, .ui-button.ui-state-active:hover {
		background: #38b8e9 !important;
		border: 1px solid #32a5d1;
		color: #ffffff;
		font-weight: normal;
	}

</style>
<section id="welcome" class="welcome_classic">
	<div class="container">
		<br/><br/><br/><br/><br/>
	</div> 
</section>

<section class="favorites site_wrapper">
	<div class="container message_page">

		<div class="col-sm-4 col-xs-12 message_left mmms">
			<div class="msgleft_header col-sm-12 ui-widget">
				<h3 class="msg_head">Inbox </h3>
				<input class="form-control" id="people" name="people" placeholder="Search"/>
				<i class="fa fa-search pull-right"></i>
				<span class="help-block" style="position:absolute"></span>
			</div>
			
			
			<div class="col-xs-12 col-xs-12 left_msgs cutom_scroll">
				<?php if(!empty($messageUsers)) { ?>
				<?php foreach($messageUsers as $key=>$msg) { ?>
				<div class="user-list msgleft_convo_tags col-sm-12 <?php echo ($key==0)?'active':'' ?>" data-from-id="<?php echo $msg->user_id; ?>">
					<div class="media">
						<div class="media-left">
							<a href="<?php echo base_url('home/profile/'.$msg->user_id) ?>">
								<?php if (isset($msg->profile_pic) && !empty($msg->profile_pic)): ?>
									<img class="media-object" src="<?php echo base_url("uploads/user-pic/" . $msg->profile_pic); ?>">
								<?php else: ?>
									<img class="media-object" src="<?php echo base_url("assets/images/default_avatar.png"); ?>">
								<?php endif; ?> 
							</a>
						</div>
						<div class="media-body media-middle">
							<h4 class="media-heading">
								<?php if($msg->first_name && $msg->last_name){
									echo ucwords($msg->first_name." ".$msg->last_name);
								}else{
									echo ucwords($msg->username);
								}
								?>
								<small class="pull-right"><?php echo humanTime(strtotime($msg->created_date),1)." ago" ?></small></h4>
								<small><?php echo $msg->message ?></small>																								<span class="new_msg-noti">2</span>								
							</div>
						</div>
					</div>
					<?php } ?>
					<?php } ?>
				</div>
			</div>
			<?php //prx($messageUsers); ?>
			<div class="col-sm-8 col-xs-12 message_right">
				<div class="col-sm-12 col-xs-12 message_right-header">
					<div class="col-sm-7">
					<?php if(!empty($messageUsers)){ ?>
						<div class="media">
							<div class="media-left">

								<a href="<?php echo base_url('home/profile/'.$messageUsers[0]->user_id) ?>">
									<?php if (isset($messageUsers[0]->profile_pic) && !empty($messageUsers[0]->profile_pic)): ?>
										<img class="media-object" src="<?php echo base_url("uploads/user-pic/" . $messageUsers[0]->profile_pic); ?>">
									<?php else: ?>
										<img class="media-object" src="<?php echo base_url("assets/images/default_avatar.png"); ?>">
									<?php endif; ?> 
								</a>
							</div>
							
							<div class="media-body media-middle">
								<h4 class="media-heading">
									<?php if($messageUsers[0]->first_name && $messageUsers[0]->last_name){
										echo ucwords($messageUsers[0]->first_name." ".$messageUsers[0]->last_name);
									}else{
										echo ucwords($messageUsers[0]->username);
									}
									?>
								</h4>
								<small><i class="fa fa-map-marker"></i> <?php echo $messageUsers[0]->user_location; ?> </small>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>


				<div class="col-sm-12 message_right-coversation cutom_scroll">
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
						</div>


						<div class="col-lg-12 send_messgae">
							<form method="POST" action="<?php echo base_url('home/send_message'); ?>" id="message-form" data-ref-id="<?php echo isset($messageUsers[0]->user_id)?$messageUsers[0]->user_id:$this->session->userdata("user_id"); ?>" enctype="multipart/form-data">
								<div class="form-group" style="margin-bottom: -7px;">
									<textarea class="form-control" name="message" id="message" placeholder="Write here..." rows="3"></textarea>
									<span class="help-block"></span>
								</div>
								<div class="col-sm-6 row">																<div class="col-sm-4 msg-attachment">
								<span class="btn msg-btn-file btn-link files">
									<i  class="fa fa-paperclip"></i> Add Files
									<input name="msg_files" id="msg_files" type="file">
								</span>
								<img width="50" height="50" class="files img-responsive">							</div>																						<div class="col-sm-6 msg-attachment">
								<span class="btn msg-btn-file btn-link photos">
									<i  class="fa fa-camera"></i> Add Photos
									<input name="msg_photos" id="msg_photos" type="file">
								</span>
								<img width="60" height="60" class="photos img-responsive">								</div>								
							</div>
								<button class="btn btn-primary pull-right mes-btn">Send</button>
							</form>
						</div>
					</div>
				</div>
			</section>

			<script type="text/javascript">
				$(function() {
					$( "#people" ).autocomplete({
						source: function( request, response ) { 
							$.ajax({
								url: "<?php echo base_url('home/get_contect_list');?>",
								dataType: "json",
								data: {
									q: request.term
								},
								success: function( data ) {
									response( $.map( data, function( item ) {
										return {
											key: item.user_id,
											value: item.name
										}
									})); 
								}
							});
						},
						select: function(event, ui) {
							resetContactList(ui.item.key);
						},
					});
				});
				$(document).ready(function(){
					$(document).on("click", ".user-list",function(){
						var elem = $(this);
						$("#people").val("");
						var from = elem.attr("data-from-id");
						$.ajax({
							type: "POST",
							url: "<?php echo base_url("home/message_conversion") ?>",
							data: { from: from},
							dataType: "json",
							beforeSend: function(){
								var loader = '<div class="loader text-center"><img src="<?php echo base_url('assets/images/ajax-loader_msg.gif') ?>" width="80" /></div>'
								$(".message_right").find(".message_right-coversation").addClass("hide");
								$(".message_right").find(".message_right-header").after(loader);

							},
							success: function(data){
								if(!data.error){
									$(".user-list").removeClass("active");
									$( 'div[ data-from-id=' + from + ']' ).addClass( 'active' );
									$(".message_right").find(".loader").remove();
									$(".message_right").find(".message_right-coversation").removeClass("hide");
									$(".message_right").find(".message_right-header").empty();
									$(".message_right").find(".message_right-header").append(data.profileContent);
									$(".message_right").find(".message_right-coversation").html(data.msgContent);
									$(".message_right").find("#message-form").attr("data-ref-id",data.profile_id);
								}else{
									var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Errors!</p>'+data.message+'</div>';
									$("#alert-modal").find(".modal-body").prepend(msg);
									setTimeout(function(){
										$("#alert-modal").find(".alert-danger").remove();
									}, 4000);
								}
							},
							error: function(jqXHR, textStatus, errorMessage) {
								var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Errors!</p>'+errorMessage+'</div>';
								$("#alert-modal").find(".modal-body").prepend(msg);
								setTimeout(function(){
									$("#alert-modal").find(".alert-danger").remove();
								}, 4000);
							}
						});
					});

					$(document).on('change', "#msg_photos, #msg_files", function () {
						var elem = $(this);
						var _id = $(this).attr("id");
						if(elem.attr("id") == "msg_photos" ){
							var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
						}else{
							var fileExtension = ['txt','php','pdf', 'ppt', 'doc', 'ext', 'docx', 'xml', 'zip']; 
						}

						if ($.inArray(elem.val().split('.').pop().toLowerCase(), fileExtension) == -1) {
							var error = "Only "+fileExtension.join(', ')+" formats are allowed.";
							elem.val("").clone(true);
							var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+error+'</div>';
							elem.closest("form").prepend(msg);
							setTimeout(function(){
								elem.closest("form").find(".alert-danger").remove();
							}, 4000);

						}else{
							elem.closest("form").find(".alert-danger").remove();
							readURL(_id,this);
						}
					});

					$(document).on('click', ".mes-btn", function (ev) {
						ev.preventDefault();
						var elem = $(this);
						$("#people").val("");
						var message  = $.trim($("#message").val());
						var to  = elem.closest("form").attr("data-ref-id");
						var url = elem.closest("form").attr("action");
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
      formData.append('isConversion', 1);
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
      			elem.closest("form").prepend(msg);
      			if(data.msgContent){
      				$(".message_right").find(".message_right-coversation").html(data.msgContent);
      			}
      			setTimeout(function(){
      				elem.closest("form").find(".alert-success").remove();

      			}, 4000);
      		}else{
      			var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Errors!</p>'+data.message+'</div>';
      			elem.closest("form").prepend(msg);
      			setTimeout(function(){
      				elem.closest("form").find(".alert-danger").remove();
      			}, 4000);
      		} 
      	},
      	error: function(jqXHR, textStatus, errorMessage) {
      		var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Errors!</p>'+errorMessage+'</div>';
      		elem.closest("form").prepend(msg);
      		setTimeout(function(){
      			elem.closest("form").find(".alert-danger").remove();
      		}, 4000);
      	}
      });
  });
				});

var timer = setInterval(reset_conversions ,30000);
function reset_conversions()
{
	var from = "";
	$(".user-list").each(function() {
		if($(this).hasClass("active")){
			from = $(this).attr("data-from-id");
		}
	});

	if(from && from !='')
	{
		$.post( '<?php echo base_url("home/message_conversion") ?>',{from: from}, function( data ) {
			if(!data.error){
				if(data.msgContent)
				{
					$(".message_right").find(".message_right-coversation").html(data.msgContent);
				}
			}
		}, "json");
	}
}

var resetContactList = function(from)
{
	if(from && from !='')
	{
		$.ajax({
			type: "POST",
			url: "<?php echo base_url("home/message_conversion") ?>",
			data: { from: from},
			dataType: "json",
			beforeSend: function(){
				var loader = '<div class="loader text-center"><img src="<?php echo base_url('assets/images/ajax-loader_msg.gif') ?>" width="80" /></div>'
				$(".message_right").find(".message_right-coversation").addClass("hide");
				$(".message_right").find(".message_right-header").after(loader);

			},
			success: function(data){
				if(!data.error){
					$(".user-list").removeClass("active");
					$( 'div[ data-from-id=' + from + ']' ).addClass( 'active' );
					$(".message_right").find(".loader").remove();
					$(".message_right").find(".message_right-coversation").removeClass("hide");
					$(".message_right").find(".message_right-header").empty();
					$(".message_right").find(".message_right-header").append(data.profileContent);
					$(".message_right").find(".message_right-coversation").html(data.msgContent);
					$(".message_right").find("#message-form").attr("data-ref-id",data.profile_id);
				}else{
					var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Errors!</p>'+data.message+'</div>';
					$("#alert-modal").find(".modal-body").prepend(msg);
					setTimeout(function(){
						$("#alert-modal").find(".alert-danger").remove();
					}, 4000);
				}
			},
			error: function(jqXHR, textStatus, errorMessage) {
				var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Errors!</p>'+errorMessage+'</div>';
				$("#alert-modal").find(".modal-body").prepend(msg);
				setTimeout(function(){
					$("#alert-modal").find(".alert-danger").remove();
				}, 4000);
			}
		});
	}
}

function readURL(id,input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			
			if(id == "msg_photos" ){
				$("#"+id).closest("span").next("img").attr('src', e.target.result);
			}else{
				$("#"+id).closest("span").next("img").attr('src', "<?php echo base_url('assets/images/file-icon.png') ?>"); 
			}
		}
		reader.readAsDataURL(input.files[0]);
	}
}
</script>

