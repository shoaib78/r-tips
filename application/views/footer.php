<!-- For alert popup -->

<div class="modal fade" id="alert-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <!--Modal header-->

            <div class="modal-header">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title">Alert</h4>

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



<!--Start popup-->

<div class="modal" id="loader-modal" data-backdrop="static" data-keyboard="false">

    <div class="center">

    </div>

</div>

<!-- end popup-->



<?php if($this->session->userdata('user_id')) : ?>

<!-- For alert popup -->

<div class="modal fade" id="share-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <!--Modal header-->

            <div class="modal-header">

                <h4 class="modal-title">Social Share</h4>

            </div>

            <!--Modal body-->

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12">

                          <!-- Go to www.addthis.com/dashboard to customize your tools --> <div class="addthis_inline_share_toolbox" data-url="" data-title="" data-media=""></div>

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

<?php endif; ?>

<footer>

  <div class="container">

    <div class="footer_inner">

      <div class="row">

        <div class="col-sm-3">

          <div class="list-style">

            <h3> About Us </h3>

            <ul class="list-unstyled">

              <li> <a href="<?php echo base_url('home/about_us') ?>"> About us </a> </li>

              <li> <a href="<?php echo base_url('home/contact_us') ?>"> Contact us </a> </li>

            </ul>

          </div>

        </div>

		

        <div class="col-sm-3">

          <div class="list-style">

            <h3> Support </h3>

            <ul class="list-unstyled">	

				<?php if($this->session->userdata('user_id')): ?>

					<li> <a href="<?php echo base_url("home/profile/".$this->session->userdata('user_id')); ?>"> My account </a> </li>	

					<li> <a href="<?php echo base_url("trip/listings/wishlist") ?>"> My Wishlist </a> </li>

          <li> <a href="<?php echo base_url("home/user_wishtips/") ?>"> My Wishtips </a> </li>

				<?php endif; ?>

              <li> <a href="<?php echo base_url('home/how_it_work') ?>">How it Work</a> </li>

              <li> <a href="<?php echo base_url('home/support') ?>">Support</a> </li>

            </ul>

          </div>

        </div>

        <div class="col-sm-3">

          <div class="list-style">

            <h3> Policies </h3>

            <ul class="list-unstyled">

                <li> <a href="<?php echo base_url('home/privacy') ?>">Privacy Policy</a> </li>

                <li><a href="<?php echo base_url("home/advertisement/"); ?>">Advertisement</a></li>

            </ul>

          </div>

        </div>

        <div class="col-sm-3">

          <div class="list-style">

            <h3> get newsletters</h3>

            <form id="subscriber-form" action="<?php echo base_url("home/user_subscribed") ?>">

              <div class="input-group">

                <input type="text" class="form-control" name="subscriber" id="subscriber"

                       placeholder="Email address">

                  <span class="help-block"></span>

                <span class="input-group-btn">

                <button class=" btn btn-email" type="submit">Subscribe </button>

                </span>

              </div>

            </form>

          </div>

          <div class="list-style social-block">

            <h3> Follow Us </h3>

            <ul class="list-inline">

               <?php if (isset($SETTINGS['fb_url']) && $SETTINGS['fb_url'] != ''): ?>

                  <li><a href="<?php echo prep_url($SETTINGS['fb_url']) ?>"><i class="fa fa-facebook"></i></a></li>

              <?php else: ?>

                <li> <a href="#"> <i class="fa fa-facebook"></i> </a> </li>

              <?php endif ?>



              <?php if (isset($SETTINGS['twitter_url']) && $SETTINGS['twitter_url'] != ''): ?>

                  <li><a href="<?php echo prep_url($SETTINGS['twitter_url']) ?>"><i class="fa fa-twitter"></i></a></li>

              <?php else: ?>

                <li> <a href="#"> <i class="fa fa-twitter"></i> </a> </li>

              <?php endif ?>



              <?php if (isset($SETTINGS['gplus_url']) && $SETTINGS['gplus_url'] != ''): ?>

                  <li><a href="<?php echo prep_url($SETTINGS['gplus_url']) ?>"><i class="fa fa-google-plus"></i></a></li>

              <?php else: ?>

                <li> <a href="#"> <i class="fa fa-google-plus"></i> </a> </li>

              <?php endif ?>



              <?php if (isset($SETTINGS['linkedin_url']) && $SETTINGS['linkedin_url'] != ''): ?>

                  <li><a href="<?php echo prep_url($SETTINGS['linkedin_url']) ?>"><i class="fa fa-linkedin"></i></a></li>

              <?php else: ?>

                <li> <a href="#"> <i class="fa fa-linkedin"></i> </a> </li>

              <?php endif ?>

            </ul>

          </div>

            <!--<div class="lang_picker">

                <div class="dropup">

                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        Dropup

                        <span class="caret"></span>

                    </button>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">

                        <li><a href="#">Action</a></li>

                        <li><a href="#">Another action</a></li>

                        <li><a href="#">Something else here</a></li>

                        <li role="separator" class="divider"></li>

                        <li><a href="#">Separated link</a></li>

                    </ul>

                </div>

            </div>-->

        </div>

      </div>

      <div class="row cc-row">

        <div class="col-sm-4">

          <div class="contact_content"> <span class="sp1"> <i class="fa fa-mobile"> </i> </span> <span> 00 11 22 33 44  |  22 33 44 55 66</span> </div>

        </div>

        <div class="col-sm-4">

          <div class="contact_content"> <span class="sp1"> <i class="fa fa-map-marker"> </i> </span> <span> Lorem ipsum dolor sit amet, consectetur adipiscing elit, India</span> </div>

        </div>

        <div class="col-sm-4">

          <div class="contact_content"> <span class="sp1"> <i class="fa fa-envelope"> </i> </span> <span> <a href="#">

           

           <?php  echo (isset($SETTINGS['site_email']) && $SETTINGS['site_email'] != '') ? $SETTINGS['site_email'] : 'Yourdominname@yourmail.com'; ?>

           <?php ?>

           </a></span> </div>

        </div>

      </div>

    </div>

  </div>

  <div class="foot_bottom text-center">

    <div class="container">

      <?php  echo (isset($SETTINGS['copyright']) && $SETTINGS['copyright'] != '') ? $SETTINGS['copyright'] : 'Copyright © 2016 by <a href="#">tipsandgo</a> All rights reserved.'; ?>

      <!--   <div class="btn-group dropup pull-right">
          <button type="button" class="btn btn-default"><img src="<?php echo base_url("assets/images/english-us.png"); ?>"> devashish</button>
           <span class="caret"></span>
          <span class="sr-only">Toggle Dropdown</span>
           <ul class="dropdown-menu">
              <li><a href="javascript:void(0);"><img src="<?php echo base_url("assets/images/english-us.png"); ?>"> devashish</a></li>
              <li><a href="javascript:void(0);"><img src="<?php echo base_url("assets/images/english-us.png"); ?>"> devashish</a></li>
            </ul>

        </div> -->


        <div class="btn-group dropup pull-right droppy">
          <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span> &nbsp;&nbsp;<img src="<?php echo base_url("assets/images/english-us.png"); ?>"> English</button>
           <ul class="dropdown-menu">
            <li><a href="javascript:void(0);"><img src="<?php echo base_url("assets/images/english-us.png"); ?>"> English</a></li>
            <li><a href="javascript:void(0);"><img src="<?php echo base_url("assets/images/french-ca.png"); ?>"> Francia</a></li>
          </ul>
        </div>





    </div>

  </div>

</footer>

<!-- Include all compiled plugins (below), or include individual files as needed -->

<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

<!--<script src="js/custome_select.js"> </script>-->

<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.min.js"> </script>

 <script src="<?php echo base_url(); ?>assets/js/bootbox.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/multiple-select.js"> </script>

<script src="<?php echo base_url(); ?>assets/js/script.js"> </script>

<!-- Go to www.addthis.com/dashboard to customize your tools -->

<script src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5849469b1f755d88" #async=1" type="text/javascript"></script>

<script type="text/javascript">

<?php if($this->session->userdata("user_id")): ?>

$(document).ready(function () {

    $(document).on("click",".remove-comment", function(event) {

        event.preventDefault();

        elem = $(this);

        var act_id = elem.attr("act_id");

        bootbox.confirm("Do you sure want to remove this comment?", function(result){

            if(result){

                $.post( '<?php echo base_url("activity/remove_comment") ?>',{act_id:act_id}, function(data)

                {

                    if(!data.error)

                    {

                        elem.closest("li").remove();

                        if(data.commentCount){

                            $("#comment-comment_"+data.obj_id).next("span.tip_comment_count").text(data.commentCount);

                        }

                        $( ".comment-comment" ).trigger( "click" );

                        var msg = '<div class="alert alert-success">' + data.message + '</div>';

                        $("#alert-modal").find(".col-md-12").append(msg);

                        $("#alert-modal").modal("show");

                        setTimeout(function () {

                            $("#alert-modal").find(".col-md-12").empty();

                            $("#alert-modal").modal("hide");

                        }, 2500);

                    }else{

                        var msg = '<div class="alert alert-danger"> ' + data.message + '</div>';

                        $("#alert-modal").find(".col-md-12").append(msg);

                        $("#alert-modal").modal("show");

                        setTimeout(function () {

                            $("#alert-modal").find(".col-md-12").empty();

                            $("#alert-modal").modal("hide");

                        }, 2500);

                    }

                }, "json");

            }

        });

    });

});

function bookmark_tip(element){

<?php if(!$this->session->userdata("user_id")): ?>

  window.location.href = "<?php echo base_url("login") ?>";

<?php else: ?>

    elem = $("#"+element.id);

    var objectId = elem.attr('objectId'),objType = elem.attr('objType'),acttype = elem.attr('acttype'),obj_parent_id = elem.attr('obj_parent_id');    

    

    $.post( '<?php echo base_url("activity/bookmarkTip") ?>',{ objectId: objectId, objType: objType,acttype:acttype,obj_parent_id:obj_parent_id }, function( data ) {

    

        if(!data.error){

            var noti_count = $("#bookmark-count-pin").find("span.value").text();

            noti_count = parseInt(noti_count)+1;

            $(".bookmark-count").find(".value").text(noti_count);

            if(elem.hasClass('bookmarkTip')){
                var html = '<a id="bookmark_'+objectId+'" onclick="unbookmark_tip(this);" obj_parent_id="'+obj_parent_id+'" objType="'+objType+'" acttype="'+acttype+'" objectId="'+objectId+'"  class="unbookmarkTip" href="javascript:void(0);" title="Remove Bookmark"><i class="fa fa-bookmark"> </i></a>';

                elem.closest("div").removeClass('bookmark').addClass('bookmarked');

                elem.closest("div").html(html);  

            }

        }else{

               var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Errors!</p>' + data.message + '</div>';

                $("#alert-modal").find(".col-md-12").append(msg);

                $("#alert-modal").modal("show");

                setTimeout(function () {

                    $("#alert-modal").find(".col-md-12").empty();

                    $("#alert-modal").modal("hide");

                }, 4000); 

            } 

    

    }, "json");

<?php endif; ?>

}



function unbookmark_tip(element){

    <?php if(!$this->session->userdata("user_id")): ?>

      window.location.href = "<?php echo base_url("login") ?>";

    <?php else: ?>

        elem = $("#"+element.id);

        var objectId = elem.attr('objectId'),objType = elem.attr('objType'),acttype = elem.attr('acttype'),obj_parent_id = elem.attr('obj_parent_id');



        $.post( '<?php echo base_url("activity/unbookmarkTip") ?>',{ objectId: objectId, objType: objType,acttype:acttype,obj_parent_id:obj_parent_id }, function( data ) {

        

            if(!data.error){

                var noti_count = $("#bookmark-count-pin").find("span.value").text();

              noti_count = parseInt(noti_count)-1;

              $(".bookmark-count").find(".value").text(noti_count);

                if(elem.hasClass('unbookmarkTip')){

                    <?php if($this->uri->segment(2) == "bookmark_wishtips"): ?>

                      elem.closest("article").parent("li").remove();

                    <?php else: ?>
                      var html = '<a id="bookmark_'+objectId+'" onclick="bookmark_tip(this);" obj_parent_id="'+obj_parent_id+'" objType="'+objType+'" acttype="'+acttype+'" objectId="'+objectId+'"  class="bookmarkTip" href="javascript:void(0);" title="Bookmark this tip"><i class="fa fa-bookmark-o"> </i></a>';

                      elem.closest("div").removeClass('bookmarked').addClass('bookmark');

                      elem.closest("div").html(html); 

                    <?php endif; ?> 

                }

            }else{

                 var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Errors!</p>' + data.message + '</div>';

                  $("#alert-modal").find(".col-md-12").append(msg);

                  $("#alert-modal").modal("show");

                  setTimeout(function () {

                      $("#alert-modal").find(".col-md-12").empty();

                      $("#alert-modal").modal("hide");

                  }, 4000); 

            } 

        

        }, "json");

    <?php endif; ?>

}

<?php endif; ?>

</script>