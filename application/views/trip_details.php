<link href="<?php echo base_url(); ?>assets/css/jquery.bsPhotoGallery.css" rel="stylesheet">

<script src="<?php echo base_url(); ?>assets/js/jquery.bsPhotoGallery.js"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>

<script src="<?php echo base_url(); ?>assets/js/star-rating.js" type="text/javascript"></script>

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyB1a2NAsRAQICTnCaOZa6wFPgNBRz4rOXM&sensor=false&amp;libraries=places"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.js"></script>



<style>
    header {background-image: url('<?php echo base_url() ?>assets/images/nabbg.png');background-size: 100% 105%;z-index: 1;}
    .item img {width: 100%;height: 500px;max-height: 500px;}
    #examples a {text-decoration: underline;}
    #geocomplete {width: 200px}
    #map_canvas {width: 100%;height: 300px;margin: 10px 20px 10px 0;}
    #multiple li {cursor: pointer;text-decoration: underline;}
    .times {font-size: 15px;}
</style>



<section id="welcome">

	<!--<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">



	  <div class="carousel-inner" role="listbox">

                <?php if(!empty($trip->photos)): ?>

                    <?php foreach($trip->photos as $k=>$photo){ ?>

                        <?php if($k == 0){ ?>

                            <div class="item active">

                                <img src="<?php echo base_url("uploads/".$photo['file_name']) ?>" alt="<?php echo $photo['file_name'] ?>">

                            </div>

                        <?php }else{ ?>

                            <div class="item">

                                <img src="<?php echo base_url("uploads/".$photo['file_name']) ?>" alt="<?php echo $photo['file_name'] ?>">

                            </div>

                        <?php } ?>

                    <?php } ?>

                <?php else: ?>

                    <div class="item active">

                     <img src="<?php echo base_url() ?>assets/images/place_banner.jpg" alt="slide 1">

                    </div>



                    <div class="item">

                      <img src="<?php echo base_url() ?>assets/images/place_banner.jpg" alt="slide 1">

                    </div>

                <?php endif; ?>    

		

	  </div>



	 

	  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">

		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>

		<span class="sr-only">Previous</span>

	  </a>

	  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">

		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>

		<span class="sr-only">Next</span>

	  </a>

	</div>-->





	<img src="<?php echo base_url() ?>assets/images/place_banner22.jpg" width="100%" alt="slide 1">



</section>





<section class="places_page">

   <div class="container">

		<div class="col-sm-8 places_left">

			<article>

                <h2 class="article_heading">

                    <span class="text-primary">

                        <?php echo $trip->title ?>

                    </span>

                    <div class="times pull-right">

                        <?php echo humanTime(strtotime( $trip->creation_date),1)." ago"; ?>

                        <i class="fa fa-clock-o"></i>

                    </div>

                </h2>

                <h5 class="article_sub_heading">

                    <?php if(in_array($this->session->userdata('user_id'),$trip->faverites)): ?>

                        <a onclick="make_favorite_unfavorite_trip(this)" href="javascript:void(0);" data-href="<?php echo base_url("activity/unfavorite") ?>" class="active pull-right" id="unwish-<?php echo $trip->trip_id ?>" objtype="trip" objectId="<?php echo $trip->trip_id ?>" ownerId="<?php echo $trip->user_id ?>" title="Un-favorite this trip"> <i class="fa fa-star"> </i> </a>

                    <?php else: ?>

                        <a onclick="make_favorite_unfavorite_trip(this)" href="javascript:void(0);" data-href="<?php echo base_url("activity/favorite") ?>" class="pull-right" id="wish-<?php echo $trip->trip_id ?>" objtype="trip" objectId="<?php echo $trip->trip_id ?>" ownerId="<?php echo $trip->user_id ?>" title="Favorite this trip"> <i class="fa fa-star-o"> </i> </a>

                    <?php endif; ?>



                    <!--<i class="fa fa-star"></i>



-->



                    Travelled on <?php echo date("d M Y", strtotime($trip->check_in_date)) ?>

                    to <?php echo date("d M Y", strtotime($trip->check_out_date)) ?>

                </h5>

                <p><?php echo ucfirst($trip->description) ?></p>

            </article>



			<article>

				<h3 class="article_heading"> <span class="text-primary"> Place Category </span></h3>

				<p><?php echo ucwords($trip->category_name) ?></p>

			</article>



			<article>

				<h3 class="article_heading"> <span class="text-primary"> Neighborhood </span></h3>

				<p><?php echo $trip->neighbourhood ?></p>

			</article>



			<article>

				<h3 class="article_heading"> <span class="text-primary"> Tips </span></h3>

                                <p><?php echo ucfirst($trip->neighbourhood) ?></p>

			</article>



			<article>

				<h3 class="article_heading"> <span class="text-primary"> How to get there </span></h3>

				<table class="table">

					<tr>

                                            <?php

                                                $results = explode(",", $trip->go_there);

                                                foreach($results as $key=> $val):

                                                    switch (trim($val)) {

                                                        case "Bus":

                                                            echo '<td><img src="'.base_url().'assets/images/ic1.png"/> <h4>Bus</h4></td>';

                                                            break;

                                                        case "Walking":

                                                            echo '<td><img src="'.base_url().'assets/images/ic5.png"/> <h4>Walking</h4></td>';

                                                            break;

                                                        case "Airplane":

                                                            echo '<td><img src="'.base_url().'assets/images/ic2.png"/> <h4>Airplane</h4></td>';

                                                            break;

                                                        case "Bicycle":

                                                            echo '<td><img src="'.base_url().'assets/images/ic4.png"/> <h4>Bicycle</h4></td>';

                                                            break;

                                                        case "Boat":

                                                            echo '<td><img src="'.base_url().'assets/images/ic7.png"/> <h4>Boat</h4></td>';

                                                            break;

                                                        case "Train":

                                                            echo '<td><img src="'.base_url().'assets/images/ic6.png"/> <h4>Train</h4></td>';

                                                            break;

                                                        case "Car":

                                                            echo '<td><img src="'.base_url().'assets/images/ic3.png"/> <h4>Car</h4></td>';

                                                            break;

                                                         case "Subway":

                                                            echo '<td><img src="'.base_url().'assets/images/ic5.png"/> <h4>Subway</h4></td>';

                                                            break;

                                                        /*default:

                                                            echo "Your favorite color is neither red, blue, nor green!";*/

                                                    }

                                                endforeach;

                                            ?>

					</tr>

				</table>

			</article>



			<article>

				<h3 class="article_heading"> <span class="text-primary"> Suggested for </span></h3>

				<p><?php echo ucwords($trip->suggestion_for) ?></p>

			</article>



			<article>

				<div class="row">

					<div class="col-lg-6 col-xs-6 budget">

						<h3 class="article_heading"> <span class="text-primary"> Budget used</span></h3>

						<h4><?php echo $trip->budget_min ?> &#36; - <?php echo $trip->budget_max ?> &#36;</h4>

					</div>

					<div class="col-lg-6 col-xs-6 text-right live_exchnage">

						<h3 class="article_heading"> <span class="text-primary"> Live Exchange </span></h3>

						<div class="dropdown filter">

						 <a href="#" data-toggle="dropdown" class="dropdown-toggle" aria-expanded="false">

						 Filter tips by <i class="fa fa-angle-down"> </i> </a>

							 <ul class="dropdown-menu">

							    <li>

									<table class="table lexncge" style=" margin-top: 0;">

										<thead>

											<tr>

												<td>&nbsp;</td>



												<td><img src="<?php echo base_url() ?>assets/images/us.png"/><h6>USA</h6></td>

												<td><img src="<?php echo base_url() ?>assets/images/eur.png"/><h6>EUR</h6></td>

												<td><img src="<?php echo base_url() ?>assets/images/gbp.png"/><h6>GBP</h6></td>

												<td><img src="<?php echo base_url() ?>assets/images/ind.png"/><h6>IND</h6></td>

												<td><img src="<?php echo base_url() ?>assets/images/aud.png"/><h6>AUD</h6></td>

											</tr>

										</thead>



										<tbody>

                                        <tr>

                                            <td><img src="<?php echo base_url()  ?>assets/images/us.png"/>

                                            </td>

                                            <?php if($currency){ ?>

                                                <?php foreach($currency as $rate){ ?>

                                                    <?php if ($rate['from'] == 'USD') { ?>

                                                        <td class="<?php echo ($rate['from'] == $rate['to'])?'active':''; ?>"><?php echo number_format((float)$rate['rates'], 4, '.', ''); ?></td>

                                            <?php } } }?>

                                        </tr>



                                        <tr>

                                            <td><img src="<?php echo base_url()  ?>assets/images/eur.png"/>

                                            </td>

                                            <?php if($currency){ ?>

                                            <?php foreach($currency as $rate){ ?>

                                            <?php if ($rate['from'] == 'EUR') { ?>

                                                        <td class="<?php echo ($rate['from'] == $rate['to'])?'active':''; ?>"><?php echo number_format((float)$rate['rates'], 4, '.', ''); ?></td>

                                            <?php } } }?>

                                        </tr>



                                        <tr>

                                            <td><img src="<?php echo base_url()  ?>assets/images/gbp.png"/>

                                            </td>

                                            <?php if($currency){ ?>

                                                <?php foreach($currency as $rate){ ?>

                                                    <?php if ($rate['from'] == 'GBP') { ?>

                                                        <td class="<?php echo ($rate['from'] == $rate['to'])?'active':''; ?>"><?php echo number_format((float)$rate['rates'], 4, '.', ''); ?></td>

                                                    <?php } } }?>

                                        </tr>



                                        <tr>

                                            <td><img src="<?php echo base_url()  ?>assets/images/ind.png"/>

                                            </td>

                                            <?php if($currency){ ?>

                                                <?php foreach($currency as $rate){ ?>

                                                    <?php if ($rate['from'] == 'INR') { ?>

                                                        <td class="<?php echo ($rate['from'] == $rate['to'])?'active':''; ?>"><?php echo number_format((float)$rate['rates'], 4, '.', ''); ?></td>

                                                    <?php } } }?>

                                        </tr>



                                        <tr>

                                            <td><img src="<?php echo base_url()  ?>assets/images/aud.png"/>

                                            </td>

                                            <?php if($currency){ ?>

                                                <?php foreach($currency as $rate){ ?>

                                                    <?php if ($rate['from'] == 'AUD') { ?>

                                                        <td class="<?php echo ($rate['from'] == $rate['to'])?'active':''; ?>"><?php echo number_format((float)$rate['rates'], 4, '.', ''); ?></td>

                                                    <?php } } }?>

                                        </tr>



                                        <!--

											<tr>

                                            <td><img src="<?php /*echo base_url() */?>assets/images/us.png"/></td>

                                            <td class="active"><?php /*echo number_format((float)1, 4, '.', ''); */?></td>

                                            <td><?php /*echo convertCurrency(number_format((float)1, 4, '.', ''), "USD", "EUR");

 */?></td>

                                            <td><?php /*echo convertCurrency(number_format((float)1, 4, '.', ''), "USD", "GBP");

 */?></td>

                                            <td><?php /*echo convertCurrency(number_format((float)1, 4, '.', ''), "USD", "INR");

 */?></td>

                                            <td><?php /*echo convertCurrency(number_format((float)1, 4, '.', ''), "USD", "AUD");

 */?></td>

                                        </tr>

                                        <tr>

                                            <td><img src="<?php /*echo base_url() */?>assets/images/eur.png"/></td>

                                            <td><?php /*echo convertCurrency(number_format((float)1, 4, '.', ''), "EUR", "USD");

 */?></td>

                                            <td class="active"><?php /*echo number_format((float)1, 4, '.', ''); */?></td>

                                            <td><?php /*echo convertCurrency(number_format((float)1, 4, '.', ''), "EUR", "GBP");

 */?></td>

                                            <td><?php /*echo convertCurrency(number_format((float)1, 4, '.', ''), "EUR", "INR");

 */?></td>

                                            <td><?php /*echo convertCurrency(number_format((float)1, 4, '.', ''), "EUR", "AUD");

 */?></td>

                                        </tr>

                                        <tr>

                                            <td><img src="<?php /*echo base_url() */?>assets/images/gbp.png"/></td>

                                            <td><?php /*echo convertCurrency(number_format((float)1, 4, '.', ''), "GBP", "USD");

 */?></td>

                                            <td><?php /*echo convertCurrency(number_format((float)1, 4, '.', ''), "GBP", "EUR");

 */?></td>

                                            <td class="active"><?php /*echo number_format((float)1, 4, '.', ''); */?></td>

                                            <td><?php /*echo convertCurrency(number_format((float)1, 4, '.', ''), "GBP", "INR");

 */?></td>

                                            <td><?php /*echo convertCurrency(number_format((float)1, 4, '.', ''), "GBP", "AUD");

 */?></td>

                                        </tr>

                                        <tr>

                                            <td><img src="<?php /*echo base_url() */?>assets/images/ind.png"/></td>



                                            <td><?php /*echo convertCurrency(number_format((float)1, 4, '.', ''), "INR", "USD");

 */?></td>

                                            <td><?php /*echo convertCurrency(number_format((float)1, 4, '.', ''), "INR", "EUR");

 */?></td>

                                            <td><?php /*echo convertCurrency(number_format((float)1, 4, '.', ''), "INR", "GBP");

 */?></td>

                                            <td class="active"><?php /*echo number_format((float)1, 4, '.', ''); */?></td>

                                            <td><?php /*echo convertCurrency(number_format((float)1, 4, '.', ''), "INR", "AUD");

 */?></td>

                                        </tr>

                                        <tr>

                                            <td><img src="<?php /*echo base_url() */?>assets/images/aud.png"/></td>

                                            <td><?php /*echo convertCurrency(number_format((float)1, 4, '.', ''), "AUD", "USD");

 */?></td>

                                            <td><?php /*echo convertCurrency(number_format((float)1, 4, '.', ''), "AUD", "EUR");

 */?></td>

                                            <td><?php /*echo convertCurrency(number_format((float)1, 4, '.', ''), "AUD", "GBP");

 */?></td>

                                            <td><?php /*echo convertCurrency(number_format((float)1, 4, '.', ''), "AUD", "INR");

 */?></td>

                                            <td class="active"><?php /*echo number_format((float)1, 4, '.', ''); */?></td>

                                        </tr>

										--></tbody>

									</table>



								</li>

							</ul>

						</div><!-- /dropdown -->

					</div>

				</div>

				<div class="clearfix"></div>

			</article>



			<?php if(($this->session->userdata('user_id')) && $this->session->userdata('user_id') != $trip->user_id): ?>

			<article>

				<h3 class="article_heading"> <span class="text-primary"> Write your Review </span></h3>

				<div class="suggest_trip_block" style="margin-top:15px; border:0; padding:0">

                    <div class="avatar-thumb">

                         <?php if(!empty($trip->profile_pic)): ?>

						  <img src="<?php echo base_url("uploads/user-pic/".$trip->profile_pic) ?>">

                                                  <?php else: ?>

                                                   <img src="<?php echo base_url("assets/images/default_avatar.png"); ?>">

                                                    <?php endif; ?>

                    </div>

					<form id="write_review" method="post">

						<div class="trip-content">

							<h4>Your Ratings</h4>

							<h4>

								<input id="rating-input" name="rating-input" type="hidden" value="0" type="number" class="rating" data-size="xs" >

							</h4>

							<textarea class="form-control" cols="5"  id="review_description" name="review_description" placeholder="Suggest a live travel trips now!!"> </textarea>

						  <span class="help-block"></span>

						</div>

						<button class="btn btn-primary pull-right submit-review" style="margin-top:8px;">&nbsp; &nbsp; Publish Review &nbsp; &nbsp; </button>

					</form>

                 </div>

				<div class="clearfix"></div>

			</article>

			<?php endif; ?>



			<?php if(!empty($trip_reviews)){ ?>

				<article>

				<h3 class="article_heading"> <span class="text-primary"> Reviews </span></h3>

				<div class="col-lg-12 reviewss">

					<?php

						foreach($trip_reviews as $i=>$review):

						if($i <=4){

					?>

						<div class="media">

						  <div class="media-left media-top">

							<a href="<?php echo base_url('home/profile/'.$review['user_id']) ?>">

								<?php if (isset($review['profile_pic']) && !empty($review['profile_pic'])): ?>

									<img class="media-object img-circle" src="<?php echo base_url("uploads/user-pic/" . $review['profile_pic']); ?>">

								<?php else: ?>

									<img class="media-object img-circle" src="<?php echo base_url() ?>assets/images/default_avatar.png" alt="...">

								<?php endif; ?>

							</a>

						  </div>

						  <div class="media-body">

							<a href="<?php echo base_url('home/profile/'.$review['user_id']) ?>">

								<h4 class="media-heading">

									<?php if($review['first_name'] && $review['last_name']){

												echo ucwords($review['first_name']." ".$review['last_name']);

										   }else{

												echo ucwords($review['username']);

										   }

									?>

								</h4>

							</a>

							<h4 class="media-sub-heading">

							<?php echo humanTime(strtotime($review['created_date']),1)." ago"; ?>

							<input value="<?php echo $review['rating']; ?>" type="number" class="review-rating" data-size="xs" >

							</h4>

							<p><?php echo $review['description'];?></p>

						  </div>

						</div>

					<?php } ?>

					<?php endforeach; ?>

				</div><!-- /reviews -->

				<div class="clearfix"></div>

			</article>

			<?php } ?>

		</div><!-- places_left section end -->









		<div class="col-sm-4 places_left">

			<article class="porfilee">

					<div class="media">

					  <div class="media-left media-middle">

						<a href="<?php echo base_url('home/profile/'.$trip->user_id) ?>">

                                                    <?php if(!empty($trip->profile_pic)): ?>

						  <img class="media-object img-circle" src="<?php echo base_url("uploads/user-pic/".$trip->profile_pic) ?>" alt="...">

                                                  <?php else: ?>

                                                  <img class="media-object img-circle" src="<?php echo base_url("assets/images/default_avatar.png"); ?>" alt="...">

                                                    <?php endif; ?>

						</a>

					  </div>

					  <div class="media-body">

                                              <h2 class="media-heading ">

                                                  <a href="<?php echo base_url('home/profile/'.$trip->user_id) ?>">

                                                    <?php if($trip->first_name && $trip->last_name){

                                                                  $name = ucwords($trip->first_name." ".$trip->last_name);

                                                             }else{

                                                                  $name = ucwords($trip->username);

                                                             }

                                                             echo $name;

                                                      ?>

                                                  </a>

                                              </h2>

						<h4><i class="fa fa-map-marker"></i>

                                                    <?php $res = explode(",", $trip->location);

                                                            $location = trim(end($res));

                                                            echo $location;

                                                    ?>

                                                </h4>

						<img class="badgee" src="<?php echo base_url() ?>assets/images/batch.png">

					  </div>

					</div>

			</article>



			<article>

				<div id="map_canvas"></div>

			</article>



			<article>

				<h3 class="article_heading"> <span class="text-primary"> Address </span></h3>

				<p><?php $res = explode(",", $trip->location);

                                        foreach($res as $v):

                                            echo $v."<br>";

                                        endforeach;

                                        ?>

                                </p>

			</article>



			<article>

				<h3 class="article_heading"> <span class="text-primary"> Gallery </span></h3>

					<ul class="list-inline" id="gallery_img" style="margin-top:15px">

						<?php if(!empty($trip->photos)): ?>

							<?php foreach($trip->photos as $k=>$photo){ ?>

								<li  class="col-sm-4">  <img class="img-responsive img-rounded" src="<?php echo base_url("uploads/".$photo['file_name']) ?>"> </li>

							<?php } ?>

						<?php endif; ?>

					</ul>

				<div class="clearfix"></div>

			</article>



			<article>

				<h3 class="article_heading" style="margin-bottom:15px;"> <span class="text-primary"> Tags </span></h3>

                                <?php $res = explode(",", $trip->tags);

                                    foreach($res as $v):

                                        echo '<span class="label label-success">'.(ucwords(strtolower(trim($v)))).'</span>';

                                    endforeach;

                                ?>

			</article>



			<article>

				<h3 class="article_heading" style="margin-bottom:15px;"> <span class="text-primary"> This Place has been visited by </span></h3>

				<ul class="list-inline" style="margin-top:15px">

                                    <?php

                                        foreach($user_trips as $v):

                                            if(isset($user_detail->profile_pic) && !empty($user_detail->profile_pic)){

                                                $img = base_url('uploads/user-pic/'.$user_detail->profile_pic);

                                             }else{

                                                $img = "<?php echo base_url(); ?>/assets/images/small_profile_thumb.jpg";

                                             }

                                        ?>

                                            <li  class="col-sm-4 col-xs-6 text-center">

                                                <a href="<?php echo base_url("trip/trip_details/" . $v['trip_id']) ?>">

                                                    <?php if (isset($v['picture']) && !empty($v['picture'])): ?>

                                                        <img class="img-responsive img-circle" src="<?php echo base_url("uploads/" . $v['picture'][0]['file_name']); ?>">

                                                    <?php else: ?>

                                                        <img class="img-responsive img-circle" src="<?php echo base_url() ?>assets/images/adv-1.jpg">

                                                    <?php endif; ?>

                                                </a>

                                                    <h5><?php echo $name; ?></h5>

                                            </li>

                                        <?php endforeach; ?>

                                </ul>

			<div class="clearfix"></div>

			</article>







		</div><!-- places_right section end -->



   </div>

</section>

<script>

$(document).ready(function(){

	$('.review-rating').rating({

		hoverEnabled: false,

        hoverChangeCaption: false,

        hoverChangeStars: false,

        hoverOnClear: false

   });



	$(document).on("click", ".submit-review", function(ev){

		ev.preventDefault();

		if(!$.trim($("#review_description").val())){

			msg = "Review description is required";

			$('#review_description').next(".help-block").text(msg);

			$('#review_description').removeClass("error").addClass("error");

			return false;

		}else{

			$('#review_description').next(".help-block").text("");

			$('#review_description').removeClass("error");

		}

		var review  = $.trim($("#review_description").val());

		var rating  = $("#rating-input").val();

		$.post( '<?php echo base_url("activity/create_review")?>',{review:review,rating:rating, owner:"<?php echo $trip->user_id ?>", object_id:"<?php echo $trip->trip_id ?>"}, function( data ) {

			$('#write_review')[0].reset();

			if(!data.error){

				var msg = '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>'+data.message+'</p></div>';

				$("#write_review").find("span.help-block").after(msg);

				setTimeout(function(){

					$("#write_review").find("div.alert-success").remove();

				}, 4000);

			}else{

				var msg = '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>'+data.message+'</p></div>';

				$("#write_review").find("span.help-block").after(msg);

				setTimeout(function(){

						$("#write_review").find("div.alert-danger").remove();

				}, 4000);

			}

		}, "json");

	});

	$('ul#gallery_img').bsPhotoGallery({

	  "hasModal" : true,

	  // "fullHeight" : false

	});

  });

var make_favorite_unfavorite_trip = function(elem)

{

    <?php if(!$this->session->userdata("user_id")): ?>

    window.location.href = "<?php echo base_url() ?>";

    <?php else: ?>

    var _ids = elem.id;

    var objectId = $("#"+_ids).attr('objectId'),objType = $("#"+_ids).attr('objType'), ownerId = $("#"+_ids).attr('ownerId');

    var url = $("#"+_ids).attr('data-href');



    $.ajax({

        type: "POST",

        url: url,

        data: {objectId: objectId, objType: objType, ownerId: ownerId},

        dataType: "json",

        success: function(data){

            if(!data.error){

                var noti_count = $("#favtips-count-pin").find("span.value").text();

                ($("#"+_ids).hasClass("active"))?$("#"+_ids).removeClass("active"):$("#"+_ids).addClass("active");

                if($("#"+_ids).find("i").hasClass("fa-star-o")){

                    $("#"+_ids).find("i").removeClass("fa-star-o").addClass("fa-star");

                    noti_count = parseInt(noti_count)+1;

                    $("#favtips-count-pin").find("span.value").text(noti_count);

                    $("#"+_ids).attr("title","Un-favorite this trip");

                }else{

                    <?php if($this->uri->segment(3) == "wishlist"): ?>

                    elem.closest('div.col-sm-6').remove();

                    <?php else: ?>

                    $("#"+_ids).find("i").removeClass("fa-star").addClass("fa-star-o");

                    <?php endif; ?>



                    noti_count = parseInt(noti_count)-1;

                    $("#favtips-count-pin").find("span.value").text(noti_count);

                    $("#"+_ids).attr("title","Favorite this trip");

                }



                $("#"+_ids).attr("data-href",data.href);

                $("#"+_ids).attr("id",data.id);

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

}



$(function () {

         var lat = <?php echo $trip->location_lat ?>,

             lng = <?php echo $trip->location_long ?>,

             latlng = new google.maps.LatLng(lat, lng),

             image = 'http://www.google.com/intl/en_us/mapfiles/ms/micons/blue-dot.png';



         //zoomControl: true,

         //zoomControlOptions: google.maps.ZoomControlStyle.LARGE,



         var mapOptions = {

             center: new google.maps.LatLng(lat, lng),

             zoom: 13,

             mapTypeId: google.maps.MapTypeId.ROADMAP,

             panControl: true,

             panControlOptions: {

                 position: google.maps.ControlPosition.TOP_RIGHT

             },

             zoomControl: true,

             zoomControlOptions: {

                 style: google.maps.ZoomControlStyle.LARGE,

                 position: google.maps.ControlPosition.TOP_left

             }

         },

         map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions),

             marker = new google.maps.Marker({

                 position: latlng,

                 map: map,

                 icon: image

             });



         var input = document.getElementById('searchTextField');

         var autocomplete = new google.maps.places.Autocomplete(input, {

             types: ["geocode"]

         });



         autocomplete.bindTo('bounds', map);

         var infowindow = new google.maps.InfoWindow();



         google.maps.event.addListener(autocomplete, 'place_changed', function (event) {

             infowindow.close();

             var place = autocomplete.getPlace();

             if (place.geometry.viewport) {

                 map.fitBounds(place.geometry.viewport);

             } else {

                 map.setCenter(place.geometry.location);

                 map.setZoom(17);

             }



             moveMarker(place.name, place.geometry.location);

             alert(place.name);

             $('.MapLat').val(place.geometry.location.lat());

             $('.MapLon').val(place.geometry.location.lng());

         });

         google.maps.event.addListener(map, 'click', function (event) {

             $('.MapLat').val(event.latLng.lat());

             $('.MapLon').val(event.latLng.lng());

             alert(event.latLng.place.name)

         });

         $("#searchTextField").focusin(function () {

             $(document).keypress(function (e) {

                 if (e.which == 13) {

                     return false;

                     infowindow.close();

                     var firstResult = $(".pac-container .pac-item:first").text();

                     var geocoder = new google.maps.Geocoder();

                     geocoder.geocode({

                         "address": firstResult

                     }, function (results, status) {

                         if (status == google.maps.GeocoderStatus.OK) {

                             var lat = results[0].geometry.location.lat(),

                                 lng = results[0].geometry.location.lng(),

                                 placeName = results[0].address_components[0].long_name,

                                 latlng = new google.maps.LatLng(lat, lng);



                             moveMarker(placeName, latlng);

                             $("input").val(firstResult);

                             alert(firstResult)

                         }

                     });

                 }

             });

         });



         function moveMarker(placeName, latlng) {

             marker.setIcon(image);

             marker.setPosition(latlng);

             infowindow.setContent(placeName);

             //infowindow.open(map, marker);

         }

     });

</script>