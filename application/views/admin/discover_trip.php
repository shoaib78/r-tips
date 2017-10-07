            <div class="boxed">
            <?php
                $form_error = $this->session->flashdata('form_error');
		$success = $this->session->flashdata('success');
                $file_error = $this->session->flashdata('file_error');
                if(!empty($form_error) || !empty($file_error) || !empty($success) || isset($trip->discover_trip_id)){
                    $error= TRUE;
                }else{
                    $error= FALSE;
                }
            ?>
			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div id="content-container">

				<!--Page content-->
				<!--===================================================-->
				<div id="page-content">
                                    <div class="tab-base">

                                        <!--Nav Tabs-->
                                        <ul class="nav nav-tabs">
                                            <li class="<?php echo ($error)?'':'active'; ?>">
                                                <a data-toggle="tab" href="#demo-lft-tab-1" aria-expanded="false">Discover Trip Listings</a>
                                            </li>
                                            <li class="<?php echo ($error)?'active':''; ?>">
                                                <a class="reset_form" data-toggle="tab" href="#demo-lft-tab-2" aria-expanded="false">Add Discover Trip</a>
                                            </li>
                                        </ul>

                                        <!--Tabs Content-->
                                        <div class="tab-content">
                                            <div id="demo-lft-tab-1" class="tab-pane fade <?php echo ($error)?'':'active'; ?> in">
                                                <!-- Basic Data Tables -->
					<!--===================================================-->
					<div class="panel">
						<div class="panel-heading">
                                                        <div class="pull-left col-md-6">
                                                            <h3 class="panel-title">Discover Trip Listings</h3>
                                                        </div>
                                                        <div class="pull-right col-md-6" style="text-align: right; margin-top: 10px;">
                                                            
                                                        </div>
						</div>
						<div class="panel-body">
                                                    <table id="discover-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
                                                                            <th class="min-desktop">Trips Picture</th>
                                                                            <th class="min-desktop">Location</th>
                                                                            <th class="min-desktop">Order</th>
                                                                            <th class="min-desktop">Action</th>
									</tr>
								</thead>
								<tbody id = "sortable">
								    <?php if(!empty($trips)): 
                                                                        $i=1;
                                                                        foreach($trips as $val)
                                                                        {
                                                                    ?>  
                                                                    <tr id="<?php echo $val['discover_trip_id']; ?>##<?php echo $i; ?>">
                                                                        <td><img src="<?php echo base_url("uploads/".$val['picture']); ?>" width="100" /></td>
                                                                        <td><?php echo $val['location']; ?></td>
                                                                        <td><?php echo $val['order']; ?></td>
                                                                        <td><a class="btn btn-info" href='<?php echo base_url("admin/edit_discover_trip/".$val["discover_trip_id"]); ?>' title="Edit Trip" >Edit</a>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger delete_discover_trip" href='<?php echo base_url("admin/delete_discover_trip"); ?>' data-id="<?php echo $val['discover_trip_id']; ?>" title="Delete">Delete</a></td>
                                                                    </tr>             
                                                                        <?php $i++; } ?>
                                                                    <?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
					<!--===================================================-->
					<!-- End Striped Table -->
                                            </div>
                                            <div id="demo-lft-tab-2" class="tab-pane fade <?php echo ($error)?'active':''; ?> in">
                                                <?php if(isset($limit_error)  && !empty($limit_error)): ?>
                                                    <div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                      <p>Error!</p>
                                                      <p><?php echo $limit_error; ?></p>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if(isset($success)  && !empty($success)): ?>
                                                    <div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                      <p>Success!</p>
                                                      <p><?php echo $success; ?></p>
                                                    </div>
                                                <?php endif; ?>
                                                <form action="<?php echo base_url("admin/discover_trips") ?>" method = "post" id="discover_trip" class="form-horizontal" enctype="multipart/form-data">
                                                    <div class="row">
                                                        
                                                        <div class="col-md-12">
                                                            <div class="form-group <?php echo (form_error('location'))?'has_error':'' ;?>">
                                                              <label class="col-md-4 control-label" for="location">Location</label>
                                                              <div class="col-md-6">
                                                                <input id="location" name="location" placeholder="Location" class="form-control input-md" type="text" value="<?php echo set_value('location') ? set_value('location') : (isset($trip->location) ? $trip->location : ''); ?>" required>
                                                                <?php echo form_error('last_name'); ?>
                                                                <span class="help-block"></span> </div>
                                                            </div>
                                                        </div>
                                                        
                                                         <div class="col-md-12">
                                                            <div class="form-group <?php echo (form_error('userfile'))?'error':'' ;?>">
                                                              <label class="col-md-4 control-label" for="name">Select Trip Picture</label>
                                                              <div class="col-md-6 ">       
                                                                    <img src="<?php echo isset($trip->picture) ? base_url("uploads/").$trip->picture : ''; ?>" width="200">
                                                                    <input id="userfile" name="userfile" type="file">
                                                                <span class="help-block"><?php if($file_error): echo $file_error; endif; ?></span> </div>
                                                                <?php echo form_error('last_name'); ?>
                                                            </div>
                                                        </div>
                                                        
                                                        <?php if(!empty($trip)): ?>
                                                        <input type="hidden" name="discover_trip_id" id="discover_trip_id" value="<?php echo isset($trip->discover_trip_id) ? $trip->discover_trip_id : ''; ?>"/>
                                                        <input type="hidden" name="picture" id="picture" value="<?php echo isset($trip->picture) ? $trip->picture : ''; ?>"/>
                                                        <?php endif; ?>
                                                        
                                                        <div class="form-group text-center">
                                                            <button type="submit" class="btn btn-primary"> &nbsp; &nbsp;  Save Discover Trip &nbsp; &nbsp; </button>
                                                            <button type="submit" class="btn btn-default" onClick="this.form.reset()"> &nbsp; &nbsp;  Cancel &nbsp; &nbsp; </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
				</div>
				<!--===================================================-->
				<!--End page content-->


			</div>
			<!--===================================================-->
			<!--END CONTENT CONTAINER-->


			
           <!--END CONTENT CONTAINER-->
			<?php $sidebar_data = array("trip_count" => $today_count);
                              $sidebar_data["discover_trips"] = $discover_trip;
			 $this->load->view('admin/sidebar',$sidebar_data); ?>
			

		</div>

		

        <!-- FOOTER -->
        <!--===================================================-->
        <footer id="footer">

            <!-- Visible when footer positions are fixed -->
            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
            <div class="show-fixed pull-right">
                <ul class="footer-list list-inline">
                    <li>
                        <p class="text-sm">SEO Proggres</p>
                        <div class="progress progress-sm progress-light-base">
                            <div style="width: 80%" class="progress-bar progress-bar-danger"></div>
                        </div>
                    </li>

                    <li>
                        <p class="text-sm">Online Tutorial</p>
                        <div class="progress progress-sm progress-light-base">
                            <div style="width: 80%" class="progress-bar progress-bar-primary"></div>
                        </div>
                    </li>
                    <li>
                        <button class="btn btn-sm btn-dark btn-active-success">Checkout</button>
                    </li>
                </ul>
            </div>



            <!-- Visible when footer positions are static -->
            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
            <div class="hide-fixed pull-right pad-rgt">Currently v2.3</div>



            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
            <!-- Remove the class name "show-fixed" and "hide-fixed" to make the content always appears. -->
            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

            <p class="pad-lft">&#0169; 2015 Your Company</p>



        </footer>
        <!--===================================================-->
        <!-- END FOOTER -->
	
	<!-- SETTINGS - DEMO PURPOSE ONLY -->
	<!--===================================================-->
	<div id="demo-set" class="demo-set">
		<div class="demo-set-body bg-dark">
			<div id="demo-set-alert"></div>
			<div class="demo-set-content clearfix">
				<div class="col-xs-6 col-md-4">
					<h4 class="text-lg mar-btm">Animations</h4>
					<div id="demo-anim" class="mar-btm">
						<label class="form-checkbox form-icon active">
							<input type="checkbox" checked=""> Enable Animations
						</label>
					</div>
					<p>Transition effects</p>
					<select id="demo-ease">
						<option value="effect" selected>ease (Default)</option>
						<option value="easeInQuart">easeInQuart</option>
						<option value="easeOutQuart">easeOutQuart</option>
						<option value="easeInBack">easeInBack</option>
						<option value="easeOutBack">easeOutBack</option>
						<option value="easeInOutBack">easeInOutBack</option>
						<option value="steps">Steps</option>
						<option value="jumping">Jumping</option>
						<option value="rubber">Rubber</option>
					</select>
					<hr class="bord-no">
					<br>
					<h4 class="text-lg mar-btm">Navigation</h4>
					<div class="mar-btm">
						<label id="demo-nav-fixed" class="form-checkbox form-icon">
							<input type="checkbox"> Fixed
						</label>
					</div>
					<label id="demo-nav-coll" class="form-checkbox form-icon">
						<input type="checkbox"> Collapsed
					</label>
					<hr class="bord-no">
					<br>
					<h4 class="text-lg mar-btm">Off Canvas Navigation</h4>
					<select id="demo-nav-offcanvas">
						<option value="none" selected disabled="disabled">-- Select Mode --</option>
						<option value="push">Push</option>
						<option value="slide">Slide in on top</option>
						<option value="reveal">Reveal</option>
					</select>
				</div>
				<div class="col-xs-6 col-md-3">
					<h4 class="text-lg mar-btm">Aside</h4>
					<div class="form-block">
						<label id="demo-asd-vis" class="form-checkbox form-icon">
							<input type="checkbox"> Visible
						</label>
						<label id="demo-asd-fixed" class="form-checkbox form-icon">
							<input type="checkbox"> Fixed
						</label>
						<label id="demo-asd-align" class="form-checkbox form-icon">
							<input type="checkbox"> Aside on the left side
						</label>
						<label id="demo-asd-themes" class="form-checkbox form-icon">
							<input type="checkbox"> Bright Theme
						</label>
					</div>
					<hr class="bord-no">
					<br>
					<h4 class="text-lg mar-btm">Header / Navbar</h4>
					<label id="demo-navbar-fixed" class="form-checkbox form-icon">
						<input type="checkbox"> Fixed
					</label>
					<hr class="bord-no">
					<br>
					<h4 class="text-lg mar-btm">Footer</h4>
					<label id="demo-footer-fixed" class="form-checkbox form-icon">
						<input type="checkbox"> Fixed
					</label>
				</div>
				<div class="col-xs-12 col-md-5">
					<div id="demo-theme">
						<h4 class="text-lg mar-btm">Color Themes</h4>
						<div class="demo-theme-btn">
							<a href="#" class="demo-theme demo-a-light add-tooltip" data-theme="theme-light" data-type="a" data-title="(A). Light">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-a-navy add-tooltip" data-theme="theme-navy" data-type="a" data-title="(A). Navy Blue">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-a-ocean add-tooltip" data-theme="theme-ocean" data-type="a" data-title="(A). Ocean">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-a-lime add-tooltip" data-theme="theme-lime" data-type="a" data-title="(A). Lime">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-a-purple add-tooltip" data-theme="theme-purple" data-type="a" data-title="(A). Purple">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-a-dust add-tooltip" data-theme="theme-dust" data-type="a" data-title="(A). Dust">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-a-mint add-tooltip" data-theme="theme-mint" data-type="a" data-title="(A). Mint">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-a-yellow add-tooltip" data-theme="theme-yellow" data-type="a" data-title="(A). Yellow">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-a-well-red add-tooltip" data-theme="theme-well-red" data-type="a" data-title="(A). Well Red">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-a-coffee add-tooltip" data-theme="theme-coffee" data-type="a" data-title="(A). Coffee">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-a-prickly-pear add-tooltip" data-theme="theme-prickly-pear" data-type="a" data-title="(A). Prickly pear">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-a-dark add-tooltip" data-theme="theme-dark" data-type="a" data-title="(A). Dark">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
						</div>
						<div class="demo-theme-btn">
							<a href="#" class="demo-theme demo-b-light add-tooltip" data-theme="theme-light" data-type="b" data-title="(B). Light">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-b-navy add-tooltip" data-theme="theme-navy" data-type="b" data-title="(B). Navy Blue">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-b-ocean add-tooltip" data-theme="theme-ocean" data-type="b" data-title="(B). Ocean">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-b-lime add-tooltip" data-theme="theme-lime" data-type="b" data-title="(B). Lime">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-b-purple add-tooltip" data-theme="theme-purple" data-type="b" data-title="(B). Purple">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-b-dust add-tooltip" data-theme="theme-dust" data-type="b" data-title="(B). Dust">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-b-mint add-tooltip" data-theme="theme-mint" data-type="b" data-title="(B). Mint">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-b-yellow add-tooltip" data-theme="theme-yellow" data-type="b" data-title="(B). Yellow">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-b-well-red add-tooltip" data-theme="theme-well-red" data-type="b" data-title="(B). Well red">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-b-coffee add-tooltip" data-theme="theme-coffee" data-type="b" data-title="(B). Coofee">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-b-prickly-pear add-tooltip" data-theme="theme-prickly-pear" data-type="b" data-title="(B). Prickly pear">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-b-dark add-tooltip" data-theme="theme-dark" data-type="b" data-title="(B). Dark">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
						</div>
						<div class="demo-theme-btn">
							<a href="#" class="demo-theme demo-c-light add-tooltip" data-theme="theme-light" data-type="c" data-title="(C). Light">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-c-navy add-tooltip" data-theme="theme-navy" data-type="c" data-title="(C). Navy Blue">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-c-ocean add-tooltip" data-theme="theme-ocean" data-type="c" data-title="(C). Ocean">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-c-lime add-tooltip" data-theme="theme-lime" data-type="c" data-title="(C). Lime">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-c-purple add-tooltip" data-theme="theme-purple" data-type="c" data-title="(C). Purple">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-c-dust add-tooltip" data-theme="theme-dust" data-type="c" data-title="(C). Dust">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-c-mint add-tooltip" data-theme="theme-mint" data-type="c" data-title="(C). Mint">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-c-yellow add-tooltip" data-theme="theme-yellow" data-type="c" data-title="(C). Yellow">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-c-well-red add-tooltip" data-theme="theme-well-red" data-type="c" data-title="(C). Well Red">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-c-coffee add-tooltip" data-theme="theme-coffee" data-type="c" data-title="(C). Coffee">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-c-prickly-pear add-tooltip" data-theme="theme-prickly-pear" data-type="c" data-title="(C). Prickly pear">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
							<a href="#" class="demo-theme demo-c-dark add-tooltip" data-theme="theme-dark" data-type="c" data-title="(C). Dark">
								<div class="demo-theme-brand"></div>
								<div class="demo-theme-head"></div>
								<div class="demo-theme-nav"></div>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="pad-all text-left">
				<hr class="hr-sm">
				<p class="demo-set-save-text">* All settings will be saved automatically.</p>
				<button id="demo-reset-settings" class="btn btn-primary btn-labeled fa fa-refresh mar-btm">Restore Default Settings</button>
			</div>
		</div>
		<button id="demo-set-btn" class="btn btn-sm"><i class="fa fa-cog fa-2x"></i></button>
	</div>
	<!--===================================================-->
	<!-- END SETTINGS -->

	
    <!--JAVASCRIPT-->
    <!--=================================================-->

    <!--jQuery [ REQUIRED ]-->
    <script src="<?php echo base_url(); ?>assets/admin/js/jquery-2.1.1.min.js"></script>


    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>


    <!--Fast Click [ OPTIONAL ]-->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/fast-click/fastclick.min.js"></script>

    
    <!--Nifty Admin [ RECOMMENDED ]-->
    <script src="<?php echo base_url(); ?>assets/admin/js/nifty.min.js"></script>


    <!--Switchery [ OPTIONAL ]-->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/switchery/switchery.min.js"></script>


    <!--Bootstrap Select [ OPTIONAL ]-->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/bootstrap-select/bootstrap-select.min.js"></script>


    <!--DataTables [ OPTIONAL ]-->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/datatables/media/js/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/plugins/datatables/media/js/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
    

    <!--Demo script [ DEMONSTRATION ]-->
    <script src="<?php echo base_url(); ?>assets/admin/js/demo/nifty-demo.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyB1a2NAsRAQICTnCaOZa6wFPgNBRz4rOXM&sensor=false&amp;libraries=places"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.js"></script>
    <!--DataTables Sample [ SAMPLE ]-->
  <script src="//cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>

  <script>
        $(document).ready(function(){
	    	$("#location").geocomplete();
                $('#discover-table').DataTable({
                    "ordering": false,
                    "searching": false,
                    "bLengthChange": false,
                });
                
                $(document).on("click",".submit-btn, .reset_form",function(e){ 
                    e.preventDefault();
                     $('#favorite_trip')[0].reset();
                });
                
                $(document).on("click",".delete_discover_trip",function(e){ 
                        e.preventDefault();
                        var elem = $(this);
                        var _value = elem.attr("data-id");
                        var url = elem.attr("href");

                        $.ajax({
                                url: url,
                                type: "post",
                                data: { id: _value },
                                dataType: "json",
                                success: function (response) {
                                        if(response.error == 1){
                                                elem.closest("tr").remove();
                                        }else{
                                                alert("Some error are exist. please try again!!");
                                        }
                                },
                        });
                });
                
                $("#userfile").on('change', function () {
                    var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
                    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                        var error = "Only "+fileExtension.join(', ')+" formats are allowed.";
                        $(this).next("span.help-block").text(error);
                        $("#userfile").closest("div").find("img").attr('src', "");
                        $("#userfile").closest("div").addClass(" has-error");
                        $(this).val('').clone(true)
                    }else{
                        readURL(this);
                    }
                });
                            
                 $('#sortable').sortable({
                    axis: 'y',
                    stop: function (event, ui) {

                        var orderval= $('#sortable').sortable('toArray');
                        var table = "discover_trips"; 
                        var where = "discover_trip_id";
                        $.ajax({
                                  url: "<?php echo base_url(); ?>admin/update_order",
                                  type:'POST',
                                  data: { table: table, orderval:orderval, where:where },
                                  success: function(data)
                                  {  
                                         //$('#tdid'+img_id).parent().remove();
                                  }
                          });
                    }
            });
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#userfile").closest("div").find("img").attr('src', e.target.result);
                    $("#userfile").closest("div").removeClass(" has-error");
                    $("#userfile").closest("div").find("span.help-block").text("");
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
  </script>
</body>

<!-- Mirrored from www.themeon.net/nifty/v2.3/tables-datatable.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 12 Apr 2016 05:38:49 GMT -->
</html>