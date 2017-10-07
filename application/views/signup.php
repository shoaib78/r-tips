<div id="login" class="logsign_wrapper">

    <div class="container"> 

        <div class="mainframe">

           <div class="col-sm-6 no-pad">

              <div class="mainframe-inner-left"> 

                 <div class="frame_left_image_container"> 

                   <img src="<?php echo base_url(); ?>/assets/images/sign_left_img.jpg">

                    <p> Plan your next dream trip.Select your destination and leave the rest to us.</p>
                 </div>   

              </div> 

           </div> 

            <div class="col-sm-6 no-pad">

             <div class="mainframe-inner-right">

                  <h2>Sign up</h2>

				  <?php if(isset($form_errors) && !empty($form_errors)): ?>

				  <div class="alert alert-danger">

				  	 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

				  	<p>Errors!</p>

					<?php echo $form_errors; ?>

				  </div>

				   <?php endif; ?>

				    <?php if(isset($form_success)  && !empty($form_success)): ?>

					  <div class="alert alert-success">

					  	 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

						<p>Success!</p>

						<p><?php echo $form_success; ?></p>

					  </div>

				   <?php endif; ?>

                  <form method="post" id="signup-form" action="<?php echo current_url() ?>">

                     <div class="form-group icon-addon"> 

                        <label>E-mail </label>

                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter E-mail address" value="<?php echo set_value('email'); ?>">

                        <span class="icon icon-envelope"> </span>

                     </div>
                     <?php echo form_error('email'); ?>
                      <div class="form-group icon-addon"> 

                        <label>Username</label>

                        <input type="username" name="username" id="username" class="form-control" placeholder="Enter Username" value="<?php echo set_value('username'); ?>">

                        <span class="icon icon-user"> </span>

                     </div>
                     <?php echo form_error('username'); ?>

                     <div class="form-group icon-addon"> 

                        <label>Password </label>

                        <input type="Password" name="password" id="password" class="form-control" placeholder="Enter your Password" >

                        <span class="icon icon-lock"> </span>

                     </div>
                     <?php echo form_error('password'); ?>

                     <div class="form-group icon-addon"> 

                        <label>Confirm Password </label>

                        <input type="Password" name="cpassword" id="cpassword" class="form-control" placeholder="Enter your Password">

                        <span class="icon icon-lock"> </span>

                     </div>
                     <?php echo form_error('cpassword'); ?>
                     

                     <div class="checkbox"> <label> <input type="checkbox"> 

                     By clicking on <a href="#">"Connect with Facebook"</a> or<a href="<?php echo base_url('signup') ?>"> "Create Account"</a> 

                     you confirm that you accept our Terms of Service </label> </div>

                     

                     <div class="send-button">

									<p><a href="<?php echo base_url('login') ?>">Already an account. Sign In!</a></p>

									

										<input type="submit" value="SIGN UP">

									

									<div class="clear"></div>

								</div>

                 </form>

                 

             </div>

            </div> 

        </div> 

    </div>  

 </div>