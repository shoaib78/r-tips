<?php if(!empty($trip)){ ?><style>.trip_detail table tr th {    border-width: 1px !important;}.trip_detail ul.list-inline.mar-hor {    margin: 0;}</style>
	<!-- Basic Data Tables -->
					<!--===================================================-->
					 <div class="row">
				        <div class="">
				            <div class="panel">
						<div class="panel-heading">
						<div class="pull-left col-md-6">
							<h3 class="panel-title"><?php echo ucwords($trip->title) ?> Details</h3>
						</div>
							<div class="pull-right col-md-6" style="text-align: right; margin-top: 10px;">
								
							</div>
						</div>
						<div class="panel-body">
							<table class="table table-bordered">
	        						<tbody>
	        							<tr>
	        								<th>Trips Pictures</th>
	        								<td><ul class="list-unstyled list-inline text-justify">
													<?php if(!empty($trip_pictures)){ 
														foreach($trip_pictures as $pic): ?>
															<li class="pad-btm">
																<img alt="User Pic" width="75px" src="<?php echo base_url('uploads/'.$pic->file_name); ?>" class=" img-responsive">
															</li>
														<?php 	endforeach;
													}else{ ?>
														<li class="pad-btm">
															<img alt="User Pic" width="75px" src="http://babyinfoforyou.com/wp-content/uploads/2014/10/avatar-300x300.png" class="img-responsive">
													 	</li>
													<?php } ?>
	            								</ul>
	        								</td>
	        							</tr>
	        							<tr>
	        								<th>Description</th>
	                                        <td><?php echo ucfirst($trip->description) ?></td>				
	                                    </tr>
	                                    <tr>
	                                        <th>Tags</th>
	                                        <td>
	                                            <ul class="list-inline mar-hor">
		                                    		<?php $results = explode(",",$trip->tags);
		                                    			foreach($results as $res){ ?>
		                                    		<li class="tag tag-sm"><?php echo ucfirst($res) ?></li>
		                                    		<?php } ?>		
	                        					</ul>
	                                        </td>                           
	                                    </tr>
	                                    <tr>
	                                        <th>Tips</th>
	                                        <td>
	                                            <?php echo ucfirst($trip->tips) ?>
	                                        </td>                           
	                                    </tr> 
	                                    <tr>
	                                        <th>Go There</th>
	                                        <td>
	                                             <ul class="list-inline mar-hor">
		                                    		<?php $results = explode(",",$trip->go_there);
		                                    			foreach($results as $res){ ?>
		                                    		<li class="tag tag-sm"><?php echo ucfirst($res) ?></li>
		                                    		<?php } ?>		
	                        					</ul>
	                                        </td>                           
	                                    </tr>   
	                                    <tr>
	                                		<th>Suggestion For</th>
	                                        <td>	    
	                                            <ul class="list-inline mar-hor">
		                                    		<?php $results = explode(",",$trip->suggestion_for);
		                                    			foreach($results as $res){ ?>
		                                    		<li class="tag tag-sm"><?php echo ucfirst($res) ?></li>
		                                    		<?php } ?>		
	                        					</ul>	
	                                        </td>							
	                                    </tr>
	                                    <tr>
	                                        <th>Nearby Attractions</th>
	                                        <td>
	                                         	<ul class="list-inline mar-hor">
		                                    		<?php $results = explode(",",$trip->nearby_attractions);
		                                    			foreach($results as $res){ ?>
		                                    		<li class="tag tag-sm"><?php echo ucfirst($res) ?></li>
		                                    		<?php } ?>		
	                        					</ul>    
	                                        </td>                           
	                                    </tr> 
	                                    <tr>
	                                        <th>Budget</th>
	                                        <td>
                                              	<?php echo number_format($trip->budget,2); ?>
	                                        </td>                           
	                                    </tr>
	                                    <tr>
	                                        <th>Min Budget</th>
	                                        <td>
                                              	<?php echo number_format($trip->budget_min,2); ?>
	                                        </td>                           
	                                    </tr>
	                                    <tr>
	                                        <th>Max Budget</th>
	                                        <td>
                                              	<?php echo number_format($trip->budget_max,2); ?>
	                                        </td>                           
	                                    </tr>
	                                    <tr>
	                                        <th>Check In</th>
	                                        <td>
                                              	<?php echo date("N, j F Y",strtotime($trip->check_in_date)); ?>
	                                        </td>                           
	                                    </tr>
	                                    <tr>
	                                        <th>Check Out</th>
	                                        <td>
                                              	<?php echo date("N, j F Y",strtotime($trip->check_out_date)); ?>
	                                        </td>                           
	                                    </tr>
	                                    <tr>
	                                        <th>location</th>
	                                        <td>
                                              	<ul class="list-inline mar-hor">
	                                    		<?php $results = explode(",",$trip->location);
	                                    			foreach($results as $res){ ?>
	                                    		<li class="tag tag-sm"><?php echo ucfirst($res) ?></li>
	                                    		<?php } ?>		
                        					</ul>   
	                                        </td>                           
	                                    </tr>
	                                    <tr>
	                                        <th>Neighbourhood</th>
	                                        <td>
	                                             <?php echo ucfirst($trip->neighbourhood) ?>
	                                        </td>                           
	                                    </tr> 
	                                    <tr>
	                                        <th>Action</th>
	                                        <td>
	                                             <?php if(!$trip->publish): ?>
													<a class="btn btn-info" href="<?php echo base_url('admin/publish'); ?>" data-id="<?php echo $trip->trip_id ; ?>">Publish</a>
												<?php else: ?>
													<a class="btn btn-info publish">Published</a>
												<?php endif; ?>
	                                        </td>                           
	                                    </tr> 					
	                                </tbody>
	        					</table>		
						</div>
					</div>
				        </div>
				    </div>
					<!--===================================================-->
					<!-- End Striped Table -->
<?php }else{ ?>
	<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Errors!</p><p>No data are found!!</p></div>
<?php } ?>