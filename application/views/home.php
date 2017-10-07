<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyB1a2NAsRAQICTnCaOZa6wFPgNBRz4rOXM&sensor=false&amp;libraries=places"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.js"></script>
<section id="welcome" class="welcome_classic">
    <div class="container">
        <div class="classic_inner">

                <?php
                /*$user_ip = getenv('REMOTE_ADDR');
                $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
                $country = $geo["geoplugin_countryName"];
                $city = $geo["geoplugin_city"];
                prt($geo);*/
                ?>

            <h1> SHARE YOUR PLACES AND TIPS!</h1>
            <span> Help thousands of <strong>travellers</strong> to find amazing places around the <strong>world 
                </strong> with your tips and your experiences!</span>

            <div class="search_holiday_wrap"> 
                <form id="search_form" class="form-horizontal" method="POST" action="<?php echo base_url("trip/listings/") ?>">
                    <span class="help-block"></span>

                    <div class="col-input input-group iput3"> 
                        <input name="location" type="text" class="form-control" id="location" placeholder="Where" value="">
                        <div class="select-styled"></div>
                         
                    </div>
                    <div class="col-input input-group iput1"> 
                        <select name="category" id="category">
                            <option value="" >Select Category</option>
                            <?php if (!empty($trip_category)): ?>
                                <?php foreach ($trip_category as $cat): ?>
                                    <option value="<?php echo $cat['category_id'] ?>"><?php echo ucwords($cat['category']) ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div> 
                    <div class="col-input btn-div ">
                        <button class="search-btn"> <i class="fa fa-search"> </i> GO </a>
                    </div> 
                </form>
            </div>

        </div> 
    </div> 
</section>
<section class="favorites site_wrapper">
    <div class="container">
        <div class="heading"> 
            <h2> Our  <span class="text-primary"> favorites </span> </h2>
        </div> 
        <div class="row"> 
            <?php if (!empty($favorite_trips)): ?>
                <?php foreach ($favorite_trips as $trip) { ?>
                    <div class="col-sm-4"> 
                        <div class="favorites_item_container"> 
                            <div class="img_container"> 
                                <a href="<?php echo base_url("trip/listings/favorite/" . $trip['favorite_trip_id']) ?>">
                                    <?php if (isset($trip['picture']) && !empty($trip['picture'])): ?>
                                        <img src="<?php echo base_url("uploads/" . $trip['picture']); ?>"> Upload Photo
                                    <?php else: ?>
                                        <img src="<?php echo base_url("assets/images/map.jpg"); ?>"> CheckIn
                                    <?php endif; ?>

                                    <div class="short_info">
                                        <small>from <?php echo date("d", strtotime($trip['check_in'])); ?> to <?php echo date("d F", strtotime($trip['check_out'])); ?></small>
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
                    <p>Errors!</p>
                    <p> No trips are found.</p>
                </div>
            <?php endif; ?>
        </div>
    </div> 
</section>
<section class="adventure site_wrapper"> 
    <div class="container"> 
        <div class="adventure_inner"> 
            <h2>Discover your own Adventures </h2>
            <p> Near southern Sicily, the Scala has become an attraction thanks to its unusual white color. 
                Formed by a sedimentary rock with a distinct white color ...</p>
            <div class="btn-group"> 
                <a href="#"> Browse through all inspirations.</a>
            </div>
        </div>
    </div>
</section>
<section class="discover_adv site_wrapper"> 
    <div class="container"> 
        <div class="heading"> 
            <h2> Discover   <span class="text-primary"> adventure  </span> now! </h2>
        </div> 
        <div class="row"> 
            <?php if (!empty($discover_trip)): ?>
                <?php foreach ($discover_trip as $key => $discover) { ?>
                    <?php if($key !=3){ ?>
                        <div class="col-sm-4"> 
                            <div class="dis_adv_img_container"> 
                                <a href="<?php echo base_url("trip/listings/discover/" . $discover['discover_trip_id']) ?>"> 
                                    <?php if (isset($discover['picture']) && !empty($discover['picture'])): ?>
                                        <img class="img-responsive" src="<?php echo base_url("uploads/" . $discover['picture']); ?>"> 
                                    <?php else: ?>
                                        <img class="img-responsive" src="<?php echo base_url(); ?>/assets/images/dis_adv_01.jpg"> 
                                    <?php endif; ?>
                                        <?php $res = explode(",", $discover['location']);
                                                $location = trim(end($res));
                                        ?>
                                    <div class="tiel_text"><?php echo (strlen($location) > 20) ? substr(ucfirst($location),0,20).'...' : ucfirst($location); ?></div>
                                    <div class="caption"><?php echo $discover['similer_count'] ?> available adventures </div>
                                </a>
                            </div>
                        </div>
                    <?php }else{ ?>
                        <div class="col-sm-8"> 
                            <div class="dis_adv_img_container"> 
                                 <a href="<?php echo base_url("trip/discover_trip/" . $discover['discover_trip_id']) ?>"> 
                                    <?php if (isset($discover['picture']) && !empty($discover['picture'])): ?>
                                        <img class="img-responsive" src="<?php echo base_url("uploads/" . $discover['picture']); ?>"> 
                                    <?php else: ?>
                                        <img class="img-responsive" src="<?php echo base_url(); ?>/assets/images/dis_adv_01.jpg"> 
                                    <?php endif; ?>
                                        <?php $res = explode(",", $discover['location']);
                                                $location = trim(end($res));
                                        ?>
                                    <div class="tiel_text"><?php echo (strlen($location) > 20) ? substr(ucfirst($location),0,20).'...' : ucfirst($location); ?></div>
                                    <div class="caption"><?php echo $discover['similer_count'] ?> available adventures </div>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>  
                <?php else: ?> 
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <p>Errors!</p>
                        <p> No trips are found.</p>
                    </div>
            <?php endif; ?> 
        </div>
    </div>
</section>

<section class="top_destination site_wrapper"> 
    <div class="container"> 
        <div class="heading hi"> 
            <h2> Top   <span class="text-primary"> Destinations  </span> now! </h2>
        </div> 

        <div class="row"> 
            <?php if (!empty($visited_countries)): ?>
                <?php foreach ($visited_countries as $key => $trip) { ?>
                    <div class="col-sm-3"> 
                        <div class="destination_container">
                            <a href="#"> <h3> <?php echo $trip['country']; ?></h3>
                                <h4> <?php echo $trip['similer_country']; ?> adventures </h4> </a> 
                        </div>
                    </div>
                <?php } ?>        
            <?php else: ?>
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p>Errors!</p>
                    <p> No top countries are founds.</p>
                </div>
            <?php endif; ?> 
        </div>
    </div>
</section>
<section class="second_last_style stie_wrapper"> 
    <div class="container"> 
        <div class="row">
            <div class="col-sm-4"> 
                <div class="sls_inner"> 
                    <a href="#"> 
                        <img src="<?php echo base_url(); ?>/assets/images/style.png"> 
                        <h4> We are the first common ground between skippers and travelers.</h4> 
                        <p> Skippers create holidays based on their passions, the others are just busy enjoying their adventures. </p>
                    </a>
                </div>
            </div>
            <div class="col-sm-4"> 
                <div class="sls_inner"> 
                    <a href="#"> 
                        <img src="<?php echo base_url(); ?>/assets/images/style.png"> 
                        <h4> We are the first common ground between skippers and travelers.</h4> 
                        <p> Skippers create holidays based on their passions, the others are just busy enjoying their adventures. </p>
                    </a>
                </div>
            </div>
            <div class="col-sm-4"> 
                <div class="sls_inner"> 
                    <a href="#"> 
                        <img src="<?php echo base_url(); ?>/assets/images/style.png"> 
                        <h4> We are the first common ground between skippers and travelers.</h4> 
                        <p> Skippers create holidays based on their passions, the others are just busy enjoying their adventures. </p>
                    </a>
                </div>
            </div> 
        </div>  
    </div>
</section>
<script src="<?php echo base_url(); ?>/assets/js/custome_select.js"></script>
<script>
    $(document).ready(function () {
        $("#location").geocomplete();
        
        $( ".search-btn" ).click(function(e) {	 
                e.preventDefault();
                var error = false;
                var location = $("#location").val();
                var category = $("#category").val();
                if(location || category){
                    $("#search_form" ).submit();
                }else{
                    $("#search_form" ).find("span.help-block").text("You can not leave empty search field before submit.");
                    return false; 
                }
        });
    });
</script>
