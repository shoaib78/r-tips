<section class="welcome_classic" style="background-image: url(<?php echo base_url('assets/images/howitwork.jpg') ?>);background-position: left center, center center;">
    <div class="container">
        <div class="classic_inner"> 
             <h1> HOW IT WORK</h1>
            <div class="search_holiday_wrap"> 
              
            </div>

        </div> 
    </div> 
</section>
<section class="how_it_work">
	<div class="container">
		<div class="tabbable" id="tabs-3">
			<div class="col-sm-4">
				<ul class="side-tabs nav nav-tabs ">
					<li class="active">
						<a href="#tab1" data-toggle="tab">1) Create an Account</a>
					</li>
					<li>
						<a href="#tab2" data-toggle="tab">2)  Become a Premium</a>
					</li>
					<li>
						<a href="#tab3" data-toggle="tab">3) Submitting your adventure</a>
					</li>
					<li>
						<a href="#tab4" data-toggle="tab">4) Live tips in real time</a>
					</li>
				</ul>
			</div><!-- col-sm-4 -->
			<div class="main-content col-sm-8 tab-content">
				<div class="tab-pane active" id="tab1">
					<p>Creating a Free Account or Premium Account with Tipsandgo is simple.  With the social login feature, users can login easily or just use the general registration form.
Members can upload ratings, tips, favourite listings and travel experiences in no time! </p>
				</div><!-- tab-pane  -->
				<div class="tab-pane" id="tab2">
					<p>Become a Premium Traveller  and start collecting credit whilst listing your travel adventures and tips.</p>
				</div><!-- tab-pane  -->
				<div class="tab-pane" id="tab3">
					<p>Submitting a place, tips and travel experience using Tipsandgo is super simple.  We’ve made entering the address of your place easy, by using our Google Places API plugin, it will auto complete the listing address. It easily creates a cover image, gallery, accurate description and tips of your travel experience while helping other travellers around the world to find the best of where they are..</p>
				</div><!-- tab-pane  -->
				<div class="tab-pane" id="tab4">
					<p>Share Live Tips in real time easily selecting categories and help other travellers find great spots or any others fab suggestions 
					<br><br>
					That's it.. Love Travel life!</p>
				</div><!-- tab-pane  -->
			</div>
		</div><!-- tabbable -->
	</div><!-- container -->
</section>
<script>
$(window).scroll(function(){
	var _div_height = $(".main-content").height();
      if ($(this).scrollTop() > 480 && $(this).scrollTop() < (parseInt(_div_height)+parseInt(100))) {
          $('.side-tabs').addClass('fixed');
      } else   {
          $('.side-tabs').removeClass('fixed');
      }
  });


</script>