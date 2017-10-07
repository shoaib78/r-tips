<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyB1a2NAsRAQICTnCaOZa6wFPgNBRz4rOXM&sensor=false&amp;libraries=places"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.js"></script>
<section id="welcome" class="welcome_classic">
    <div class="container">
        <div class="classic_inner"> 
             <h1> SEARCH FOR YOUR PLACES AND TIPS!</h1>
            <div class="search_holiday_wrap"> 
              
            </div>

        </div> 
    </div> 
</section>

    <section class="favorites site_wrapper">
        <div class="container">

            <div class="col-sm-3 filter_bar">
                <div class="heading"> 
                    <h2> <span class="text-primary"> Filters </span> </h2>
                </div> 


                <article> 
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">

                                        Location <i class="fa fa-angle-double-right pull-right"></i>

                                    </h4>
                                </div>
                            </a>
                            <div id="collapseOne" class="panel-collapse collapse <?php echo (!empty($category) && empty($location))?'':'in' ?>" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <?php
                                        if(!empty($location)){
                                            $res = explode(",", $location);
                                            $location = trim(end($res));
                                        }
                                    ?>
                                    <input name="location" type="text" class="form-control" id="location" placeholder="Location" value="<?php echo !empty($location) ? $location : ''; ?>" onkeyup="getFilterData('location',this.value);">
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">

                                        Category <i class="fa fa-angle-double-right pull-right"></i>

                                    </h4>
                                </div>
                            </a>
                            <div id="collapseTwo" class="panel-collapse collapse  <?php echo !empty($category)?'in':'' ?>" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <select class="form-control" onchange="getFilterData('category',this.value);" name="category" id="category">
                                        <option value="">Select Category</option>
                                        <?php if (!empty($trip_category)): ?>
                                            <?php foreach ($trip_category as $cat): ?>
                                                <option value="<?php echo $cat['category_id'] ?>" <?php if(isset($category) && $category == $cat['category_id']) { ?>selected="selected" <?php } ?>><?php echo ucwords($cat['category']) ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseOne">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">

                                        Tags <i class="fa fa-angle-double-right pull-right"></i>

                                    </h4>
                                </div>
                            </a>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <input name="tags" id="tags" class="form-control" placeholder="Start typing Tags" onkeyup="getFilterData('tag',this.value);"/>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="false" aria-controls="collapseTwo">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">

                                        Transportation Facilities <i class="fa fa-angle-double-right pull-right"></i>

                                    </h4>
                                </div>
                            </a>
                            <div id="collapse1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" class="transportation" name="transportation[]" id="inlineCheckbox2" value="Airplane"> Airplane
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" class="transportation" name="transportation[]" id="inlineCheckbox6" value="Car"> Car
                                    </label>
                                    <label class="checkbox-inline"  style="    margin: 5px 0;">
                                        <input type="checkbox" class="transportation" name="transportation[]" id="inlineCheckbox3" value="Walking"> Walking
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" class="transportation" name="transportation[]" id="inlineCheckbox4" value="Bus"> Bus
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" class="transportation" name="transportation[]" id="inlineCheckbox5" value="Boat"> Boat
                                    </label>

                                    <label class="checkbox-inline" style="    margin:0;">
                                        <input type="checkbox" class="transportation" name="transportation" id="inlineCheckbox7" value="Bicycle"> Bicycle
                                    </label>


                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">

                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="true" aria-controls="collapseThree">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <h4 class="panel-title">

                                        Nearby Attractions <i class="fa fa-angle-double-right pull-right"></i>

                                    </h4>
                                </div>
                            </a>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <input name="nearby_attraction" id="nearby_attraction" class="form-control" placeholder="Start typing" onkeyup="getFilterData('nearby_attraction',this.value);"/>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapsefour">
                                <div class="panel-heading" role="tab" id="headingfour">
                                    <h4 class="panel-title">

                                        Budget <i class="fa fa-angle-double-right pull-right"></i>

                                    </h4>
                                </div>
                            </a>
                            <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input name="min_budget" id="min_budget" class="form-control" placeholder="Min"/>
                                        </div>
                                        <div class="col-sm-6">
                                            <input name="max_budget" id="max_budget" class="form-control" placeholder="Max"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
                                <div class="panel-heading" role="tab" id="headingfive">
                                    <h4 class="panel-title">

                                        Date of Trip 
										<i class="fa fa-angle-double-right pull-right"></i>
                                    </h4>
                                </div>
                            </a>
                            <div id="collapsefive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <div class="row datpicker">
                                        <div class="col-sm-6">
                                            <input data-provide="datepicker" placeholder="Check In" name="check_in" id="check_in" class="form-control date" placeholder="Check In"/>
                                            <div class="input-group-addon">
                                                <i class="fa  fa-calendar"></i>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <input data-provide="datepicker" placeholder="Check In" name="check_out" id="check_out" class="form-control date" placeholder="Check Out"/>
                                            <div class="input-group-addon">
                                                <i class="fa  fa-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div><!--filter_bar-->

            <div class="col-sm-9 result_right trip_listing">
                <div class="heading"> 
                    <h2>
						My  <span class="text-primary"> Wishlist </span> 
                        <a class="btn btn-primary pull-right" href="<?php echo base_url("trip"); ?>">Create New</a>
                    </h2>
                </div> 
                <div class="row"> 
                    <?php if (!empty($trips)): ?>
                        <?php
                        foreach ($trips as $key => $trip) {
                            if ($key <= 10) {
                                ?>
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
                                        <div class="fav_icon_box"> 
                                            <a href="#"> <i class="fa fa-heart-o"> </i> </a> 
                                        </div>
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
            <?php }else { ?>
                                <div class="col-lg-12 text-right" style="padding:0">
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination">
                                            <li>
                                                <a href="#" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            <li class="active"><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">4</a></li>
                                            <li><a href="#">5</a></li>
                                            <li>
                                                <a href="#" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            <?php } ?>
                        <?php } ?>        
                    <?php else: ?>
                        <div class="col-sm-6">
                            <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <b>Sorry, No trips are found.</b></div>
                        </div>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    </section>

    <div class="clearfix"></div>
<script>
    $(document).ready(function () {
    $("#location, #nearby_attraction").geocomplete().bind("geocode:result", function(event, result){
     getFilterData(this.name, result.formatted_address);
    });
    
    $(document).on("click",".panel", function(){
        $(".panel").find("input[type=text], textarea").val("");
        $(".panel").not(this).find("input[type=checkbox]").attr('checked', false);
        $(".panel").not(this).find("select").val($("select option:first").val());
    });
    
    $(document).on("click",".transportation",function(){
        var allVals = $("input:checkbox:checked").map(function(){
            return $(this).val();
        }).get(); // <----
        getFilterData("transportation", allVals);
    });
    
    $(document).on("keyup","#min_budget,#max_budget",function(){
        var error = false;
        var budget = {};
        var min_budget = $("#min_budget").val();
        var max_budget = $("#max_budget").val();
        if(!$.isNumeric(min_budget) && min_budget !=''){
             $("#min_budget").removeClass("error").addClass("error");
              $("#min_budget").next("span.help-block").remove();
             $("#min_budget").after("<span class='help-block'>Min budget field required only numeric value.</span>");
             error = true;
         }
        if(!$.isNumeric(max_budget) && max_budget !=''){
            $("#max_budget").removeClass("error").addClass("error");
            $("#max_budget").next("span.help-block").remove();
            $("#max_budget").after("<span class='help-block'>Max budget field required only numeric value.</span>");
            error = true;
        }else if(min_budget =='' || max_budget ==''){
            $("#max_budget").removeClass("error").addClass("error");
            $("#max_budget").next("span.help-block").remove();
            $("#max_budget").after("<span class='help-block'>Min and max value are required for filter trips.</span>");
            error = true;
        }/*else if(max_budget < min_budget){
            alert(min_budget);
            $("#max_budget").removeClass("error").addClass("error");
            $("#max_budget").next("span.help-block").remove();
            $("#max_budget").after("<span class='help-block'>Max budget field is always greater than min budget field.</span>");
            error = true;
        }*/

        if(!error){
            $("#min_budget").removeClass("error");
            $("#min_budget").next("span.help-block").remove();
            $("#max_budget").removeClass("error");
            $("#max_budget").next("span.help-block").remove();
            budget['min_budget'] = min_budget;
            budget['max_budget'] = max_budget;
            getFilterData("min_max_budget", budget);
        }
        
    });
    
    $(document).on("blur","#check_in,#check_out",function(){
        var error = false;
        var date = {};
        var check_in = $("#check_in").val();
        var check_out = $("#check_out").val();
        if(check_in =='' || check_out ==''){
            $("#check_out").closest("div.datpicker").find("span.help-block").remove();
            $("#check_out").closest("div.datpicker").append("<span class='help-block'>Check in and Check out both fields are required for filter trips.</span>");
            error = true;
        }

        if(!error){
            $("#check_out").closest("div.datpicker").find("span.help-block").remove();
            date['check_in'] = check_in;
            date['check_out'] = check_out;
            getFilterData("check_in_check_out", date);
        }
        
    });
});
    
var req = null;
function getFilterData(key, value)
{
    if($.trim(value) && $.trim(value) !=''){
        if (req != null) req.abort();
        req = $.ajax({
            type: "POST",
            url: "<?php echo base_url('trip/getFilterData') ?>",
            data: { key: key, value: value },
            dataType: "json",
            beforeSend: function(){
               var loader = '<div class="col-sm-12 text-center loader"><img src="<?php echo base_url('assets/images/ajax-loader.gif') ?>" /></div>';
               $(".trip_listing").find(".row").empty();
               $(".trip_listing").find(".row").append(loader);
            },
            success: function(res){
                setTimeout(function(){
                    $(".trip_listing").find(".row").remove(".loader");
                    if(res.error == 1){
                        var heading = '<h2>Trips  <span class="text-primary">  Filter by '+key+' </span><a class="btn btn-primary pull-right" href="http://localhost/tips_and_go/trip">Create New</a></h2>';
                       $(".trip_listing").find(".heading").find("h2").html(heading);
                       $(".trip_listing").find(".row").html(res.htmlContent); 
                    }else{
                            var error = '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Some error are exist. please try again!!</p></div>';
                            $(".trip_listing").find(".row").html(error); 
                    }
                }, 4000);
            }
        });
    }
}
</script>