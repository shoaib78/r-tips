<link href="<?php echo base_url(); ?>assets/css/multiple-select.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/dropzone.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/typeahead.tagging.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dropzone.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.10.4/typeahead.bundle.min.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyB1a2NAsRAQICTnCaOZa6wFPgNBRz4rOXM&sensor=false&amp;libraries=places"></script>
<script src="<?php echo base_url(); ?>assets/js/typeahead.tagging.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.js"></script>
<style type="text/css" media="screen">
#examples a {
  text-decoration: underline;
}

#geocomplete { width: 200px}

#map_canvas { 
  width: 100%; 
  height: 400px; 
  margin: 10px 20px 10px 0;
}

#multiple li { 
  cursor: pointer; 
  text-decoration: underline; 
}
</style>
<section id="welcome" class="welcome_classic">
<div class="container"> <br/>
  <br/>
  <br/>
  <br/>
  <br/>
  <br/>
  <br/>
  <br/>
  <br/>
  <br/>
  <br/>
</div>
</section>
<section class="favorites site_wrapper">
  <div class="container">
    <div class="col-sm-8 places_form_main">
      <?php /*if(isset($form_errors) && !empty($form_errors)): ?>
      <div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <p>Errors!</p>
        <?php echo $form_errors; ?> </div>
      <?php endif; */?>
      <?php if(isset($form_success)  && !empty($form_success)): ?>
      <div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <p>Success!</p>
        <p><?php echo $form_success; ?></p>
      </div>
      <?php endif; ?>
      <form method="post" id="trip-form" action="<?php echo current_url() ?>">
        <div class="form-group <?php echo (form_error('title'))?'has-error':''; ?> required">
          <label class="control-label" for="title">Your Adventure or Place Title</label>
          <input name="title" type="text" class="form-control <?php echo (form_error('title'))?'error':'' ;?>" id="" placeholder="" value="<?php echo (!$reset) ? "" : set_value('title'); ?>">
          <span class="help-block"></span>
          <?php echo form_error('title'); ?>
        </div>
        <div class="form-group <?php echo (form_error('description'))?'has-error':''; ?> required">
          <label class="control-label" for="description">Describe your Adventure or Place</label>
          <textarea name="description" class="form-control <?php echo (form_error('description'))?'error':'' ;?>" id="" rows="5"><?php echo (!$reset) ? "" : set_value('description'); ?></textarea>
          <span class="help-block"></span>
          <?php echo form_error('description'); ?>
        </div>
        <div class="form-group <?php echo (form_error('tags'))?'has-error':''; ?> required">
          <label class="control-label" for="tags">Insert Tags</label>
          <input name="tags" type="text" class="form-control <?php echo (form_error('tags'))?'error':'' ;?>" id="tags" placeholder="" value="<?php echo (!$reset) ? "" : set_value('tags'); ?>">
          <span class="help-block"></span>
          <?php echo form_error('tags'); ?>
        </div>
        <div class="form-group <?php echo (form_error('tips'))?'has-error':''; ?> required">
          <label class="control-label" for="tips">Tips to suggest for other travellers</label>
          <textarea name="tips" class="form-control <?php echo (form_error('tips'))?'error':'' ;?>" id="" rows="5"><?php echo (!$reset) ? "" : set_value('tips'); ?></textarea>
          <span class="help-block"></span>
          <?php echo form_error('tips'); ?>
        </div>
          
        <div class="form-group <?php echo (form_error('category'))?'has-error':''; ?> required">
          <label class="control-label" for="category">Categories</label>
           <select class="form-control <?php echo (form_error('category'))?'error':'' ;?>" id="category" name="category">
               <option value="">Select Category</option>
            <?php if(!empty($categories)){ 
                foreach ($categories as $cat){
            ?>
              <option value="<?php echo $cat['category_id'] ?>"><?php echo ucwords($cat['category']) ?></option>
            <?php } } ?>
              </select>
            <span class="help-block"></span>
            <?php echo form_error('category'); ?>
        </div>
        <div class="form-group <?php echo (form_error('go_there'))?'has-error':''; ?> required">
          <label class="control-label" for="go_there_select">How to get there <small>(CLICK AND CHOSSE THE ICON)</small></label>
          <input type="hidden" name="go_there" id="go_there" />
          <select id="go_there_select" class="form-control <?php echo (form_error('go_there'))?'error':'' ;?>"  multiple="multiple">
      			<option value="1">Airplane</option>
      			<option value="2">Car</option>
      			<option value="3">Walking</option>
      			<option value="4">Bus</option>
      			<option value="5">Boat</option>
      			<option value="6">Train </option>
      			<option value="7">Bicycle </option>
          </select>
          <span class="help-block"></span>
          <?php echo form_error('go_there'); ?>
        </div>
        <div class="form-group <?php echo (form_error('suggestion_for'))?'has-error':''; ?> required">
          <label class="control-label" for="suggestion_for_select">Suggested for <small>(CLICK AND CHOSSE THE ICON)</small></label>
          <input type="hidden" name="suggestion_for" id="suggestion_for" />
          <select id="suggestion_for_select" class="form-control <?php echo (form_error('suggestion_for'))?'error':'' ;?>"  multiple="multiple">
              <option value="1">Airplane</option>
              <option value="2">Car</option>
              <option value="3">Walking</option>
              <option value="4">Bus</option>
              <option value="5">Boat</option>
              <option value="6">Train </option>
              <option value="7">Bicycle </option>
            </select>
            <span class="help-block"></span>
            <?php echo form_error('suggestion_for'); ?>
        </div>
        <div class="form-group <?php echo (form_error('nearby_attractions'))?'has-error':''; ?> required">
          <label class="control-label" for="nearby_attractions">Nearby Attractions</label>
          <input name="nearby_attractions" type="text" class="form-control <?php echo (form_error('nearby_attractions'))?'error':'' ;?>" id="nearby_attractions" placeholder="" value="<?php echo (!$reset) ? "" : set_value('nearby_attractions'); ?>">
          <span class="help-block"></span>
          <?php echo form_error('nearby_attractions'); ?>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <div class="form-group datpicker <?php echo (form_error('budget'))?'has-error':''; ?> required">
              <label class="control-label" for="budget">Budget used</label>
              <input name="budget" type="text" class="form-control <?php echo (form_error('budget'))?'error':'' ;?>" id="budget" placeholder="" value="<?php echo (!$reset) ? "" : set_value('budget'); ?>">
			  <div class="input-group-addon"> <i class="fa  fa-dollar"></i> </div>
              <span class="help-block"></span>
              <?php echo form_error('budget'); ?>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="row">
              <div class="form-group datpicker required">
                
                <div class="col-lg-6">
                <label class="control-label" for="budget_min" class="col-lg-12" >Min Budget</label>
                  <input name="budget_min" type="text" class="form-control <?php echo (form_error('budget_min'))?'error':'' ;?>" id="budget_min" placeholder="Min" value="<?php echo (!$reset) ? "" : set_value('budget_min'); ?>">
				   <div class="input-group-addon"> <i class="fa  fa-dollar"></i> </div>
                  <span class="help-block"></span>
                  <?php echo form_error('budget_min'); ?>
                </div>
                <div class="col-lg-6">
                <label class="control-label" for="budget_min" class="col-lg-12">Min Budget</label>
                  <input name="budget_max" type="text" class="form-control <?php echo (form_error('budget_max'))?'error':'' ;?>" id="budget_max" placeholder="Max" value="<?php echo (!$reset) ? "" : set_value('budget_max'); ?>">
				   <div class="input-group-addon"> <i class="fa  fa-dollar"></i> </div>
                  <span class="help-block"></span>
                  <?php echo form_error('budget_max'); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row form-group">
          <div class="form-group datpicker required">
            <div class="col-lg-6  ">
              <label class="control-label"  for="check_in_date"  class="col-lg-12">Check In</label>
              <input type="text"  name="check_in_date" data-provide="datepicker" placeholder="Check In" class="form-control date <?php echo (form_error('check_in_date'))?'error':'' ;?>" id="" value="<?php echo (!$reset) ? "" : set_value('check_in_date'); ?>">
              
              <?php echo form_error('check_in_date'); ?>
              <div class="input-group-addon"> <i class="fa  fa-calendar"></i> </div>
			         <span class="help-block"></span>
            </div>
            <div class="col-lg-6">
             <label class="control-label"  for="check_in_date"  class="col-lg-12">Check Out</label>
              <input type="text"  name="check_out_date" data-provide="datepicker" placeholder="Check Out" class="form-control date <?php echo (form_error('check_out_date'))?'error':'' ;?>" id="" value="<?php echo (!$reset) ? "" : set_value('check_out_date'); ?>">
              
              <?php echo form_error('check_out_date'); ?>
              <div class="input-group-addon"> <i class="fa  fa-calendar"></i> </div>
			       <span class="help-block"></span>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label"  class="control-label"  for="location">Set the location on Map <br/>
		  <input name="location" type="text" class="form-control <?php echo (form_error('location'))?'error':'' ;?>" id="location" placeholder="" value="<?php echo ($reset) ? "Indore, Madhya Pradesh, India" : set_value('location'); ?>">
                  <span class="help-block"></span>
                  <?php echo form_error('location'); ?>
		  <input type="hidden" name="location_lat" id="location_lat" value=""/>
		    <input type="hidden" name="location_long" id="location_long"  value=""/>
          <small>(Click �Set the location on the Map� and then you can drag pinpoints to locate the corrent address)</small>
		   <div id="map_canvas"></div>
		  </label>
          
        </div>
        <div class="form-group <?php echo (form_error('neighbourhood'))?'has-error':''; ?> required">
          <label class="control-label"  for="neighbourhood">Neighbourhood</label>
          <input name="neighbourhood" type="text" class="form-control" id="neighbourhood" placeholder="Please Enter neighbourhood" value="<?php echo (!$reset) ? "" : set_value('neighbourhood'); ?>">
        </div>
        
		<div class="form-group">
        <div class="image_upload_div">
          <div action="<?php echo base_url("upload") ?>" class="dropzone" style="border: none; padding: 0;">
          </div>
        </div>
      </div>
        <div class="form-group <?php echo (form_error('term_condition'))?'has-error':''; ?> required">
          <label class="control-label checkbox-inline">
              <input type="checkbox" id="term_condition" class=" <?php echo (form_error('term_condition'))?'error':'' ;?>" name="term_condition" value="option1">
          Please Accept our Trems and Conditions & Credits Policies </label>
           <span class="help-block"></span>
           <?php echo form_error('term_condition'); ?>
        </div>
        <div class="form-group text-center">
          <button type="submit" onclick="$('#trip-form').submit();" class="places-submit btn btn-primary"> &nbsp; &nbsp;  SUBMIT &nbsp; &nbsp; </button>
        </div>
      </form>
      
    </div>
  </div>
</section>
<?php //echo "<pre>"; print_r(json_encode($tags));exit; ?>
<script>
var geocoder;
var map;
var markersArray = [];
var mapOptions = {
    center: new google.maps.LatLng(12.971599, 77.594563),
    zoom: 14,
    mapTypeId: google.maps.MapTypeId.ROADMAP
}
var marker;

function createMarker(latLng) {
    if ( !! marker && !! marker.setMap) {
        // marker.setMap(null);
        marker.setPosition(latLng);
    } else { // if marker doesn't exist, create it
        marker = new google.maps.Marker({
            map: map,
            position: latLng,
            draggable: true
        });
    }
	
	var input = document.getElementById('location');
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

             createMarker(place.geometry.location);
             $('.location_lat').val(place.geometry.location.lat());
             $('.location_long').val(place.geometry.location.lng());
         });
    
    document.getElementById('location_lat').value = marker.getPosition().lat().toFixed(6);
    document.getElementById('location_long').value = marker.getPosition().lng().toFixed(6);

    google.maps.event.addListener(marker, "dragend", function () {
        geocodePosition(marker.getPosition());
        document.getElementById('location_lat').value = marker.getPosition().lat().toFixed(6);
        document.getElementById('location_long').value = marker.getPosition().lng().toFixed(6);
    });
}

function initialize() {
    geocoder = new google.maps.Geocoder();
    map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
    codeAddress();

    google.maps.event.addListener(map, 'click', function (event) {
        map.panTo(event.latLng);
        map.setCenter(event.latLng);
        createMarker(event.latLng);
    });
}
google.maps.event.addDomListener(window, 'load', initialize);

function codeAddress() {
    var address = $("#location").val();
    geocoder.geocode({
        'address': address
    }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            createMarker(results[0].geometry.location);
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}

function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
        document.getElementById('location').value = responses[0].formatted_address;
    } else {
        document.getElementById('location').value = "";
    }
  });
  }
</script>
<script>
var tagsource = <?php echo json_encode($tags); ?>;
$(document).ready(function() {
	$('#tags').tagging(tagsource);
	//$('#neighbourhood').tagging();
	
	<?php if(isset($form_success)  && !empty($form_success)): ?>
	 		$('#places')[0].reset();
	<?php endif; ?>
	  
	$("#nearby_attractions").geocomplete();
	
	Dropzone.autoDiscover = false;
	var myDropzone = new Dropzone(".dropzone", { 
		  init: function() {
			this.on("success", function(file, response) {
			response = JSON.parse(response);
			  	file.serverId = response.file_id;
				var hidden_field = "<input type='hidden' name='trip_img[]' id='trip_"+response.file_id+"' value='"+response.file_id+"'/>";
				$('.dropzone').append(hidden_field);
			});
			this.on("removedfile", function(file) {
				$('.dropzone').find('#trip_'+file.serverId).remove();
			  if (!file.serverId) { return; } // The file hasn't been uploaded
			 	$.ajax({
					url: "<?php echo base_url("upload/delete") ?>",
					type: "post",
					data: { file_id: file.serverId },
					success: function (response) {
					  console.log(response);
					},
				});
			});
		  }
	});
});
</script>