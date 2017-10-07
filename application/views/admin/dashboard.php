

		<div class="boxed">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div id="content-container">
				
				<!--Page Title-->
				<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				<div id="page-title">
					<h1 class="page-header text-overflow">Dashboard</h1>

					<!--Searchbox-->
					<div class="searchbox">
						<div class="input-group custom-search-form">
							<input type="text" class="form-control" placeholder="Search..">
							<span class="input-group-btn">
								<button class="text-muted" type="button"><i class="fa fa-search"></i></button>
							</span>
						</div>
					</div>
				</div>
				<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				<!--End page title-->


				<!--Breadcrumb-->
				<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				<ol class="breadcrumb">
					<li><a href="#">Home</a></li>
					<li><a href="#">Library</a></li>
					<li class="active">Data</li>
				</ol>
				<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				<!--End breadcrumb-->


		

				<!--Page content-->
				<!--===================================================-->
				<div id="page-content">
					
					<div class="row">
					    <div class="col-lg-7">
					
					        <!--Network Line Chart-->
					        <!--===================================================-->
					        <div id="demo-panel-network" class="panel">
					            <div class="panel-heading">
					                <div class="panel-control">
					                    <button id="demo-panel-network-refresh" data-toggle="panel-overlay" data-target="#demo-panel-network" class="btn"><i class="fa fa-rotate-right"></i></button>
					                    <div class="btn-group">
					                        <button class="dropdown-toggle btn" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-gear"></i></button>
					                        <ul class="dropdown-menu dropdown-menu-right">
					                            <li><a href="#">Action</a></li>
					                            <li><a href="#">Another action</a></li>
					                            <li><a href="#">Something else here</a></li>
					                            <li class="divider"></li>
					                            <li><a href="#">Separated link</a></li>
					                        </ul>
					                    </div>
					                </div>
					                <h3 class="panel-title">Network</h3>
					            </div>
					
					            <!--Morris line chart placeholder-->
					            <div id="morris-chart-network" class="morris-full-content"></div>
					
					            <!--Chart information-->
					            <div class="panel-body">
					                <div class="row">
					                    <div class="col-lg-9">
					                        <p class="text-semibold text-uppercase">CPU Temperature</p>
					                        <div class="row">
					                            <div class="col-xs-5">
					                                <div class="media">
					                                    <div class="media-left">
					                                        <span class="text-3x text-thin">43.7</span>
					                                    </div>
					                                    <div class="media-body">
					                                        <p class="mar-no">°C</p>
					                                    </div>
					                                </div>
					                            </div>
					                            <div class="col-xs-7 text-sm">
					                                <p>
					                                    <span>Min Values</span>
					                                    <span class="pad-lft text-semibold">
					                                        <span class="text-lg">27°</span>
					                                        <span class="labellabel-success mar-lft">
					                                            <i class="fa fa-caret-down text-success"></i>
					                                            <smal>23%</smal>
					                                        </span>
					                                    </span>
					                                </p>
					                                <p>
					                                    <span>Max Values</span>
					                                    <span class="pad-lft text-semibold">
					                                        <span class="text-lg">69°</span>
					                                        <span class="labellabel-danger mar-lft">
					                                            <i class="fa fa-caret-up text-danger"></i>
					                                            <smal>57%</smal>
					                                        </span>
					                                    </span>
					                                </p>
					                            </div>
					                        </div>
					
					                        <hr>
					
					                        <div class="pad-rgt">
					                            <p class="text-semibold text-uppercase"><i class="fa fa-question-circle fa-fw text-primary"></i> Today Tips </p>
					                            <p class="text-muted mar-top">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt.</p>
					                        </div>
					                    </div>
					
					                    <div class="col-lg-3">
					                        <p class="text-uppercase text-semibold">Bandwidth Usage</p>
					                        <ul class="list-unstyled">
					                            <li>
					                                <div class="media pad-btm">
					                                    <div class="media-left">
					                                        <span class="text-2x text-thin">754.9</span>
					                                    </div>
					                                    <div class="media-body">
					                                        <p class="mar-no">Mbps</p>
					                                    </div>
					                                </div>
					                            </li>
					                            <li class="pad-btm">
					                                <div class="clearfix">
					                                    <p class="pull-left mar-no">Income</p>
					                                    <p class="pull-right mar-no">70%</p>
					                                </div>
					                                <div class="progress progress-xs">
					                                    <div class="progress-bar" style="width: 70%;">
					                                        <span class="sr-only">70% Complete</span>
					                                    </div>
					                                </div>
					                            </li>
					                            <li>
					                                <div class="clearfix">
					                                    <p class="pull-left mar-no">Outcome</p>
					                                    <p class="pull-right mar-no">10%</p>
					                                </div>
					                                <div class="progress progress-xs">
					                                    <div class="progress-bar progress-bar-info" style="width: 10%;">
					                                        <span class="sr-only">10% Complete</span>
					                                    </div>
					                                </div>
					                            </li>
					                        </ul>
					                    </div>
					                </div>
					            </div>
					
					
					        </div>
					        <!--===================================================-->
					        <!--End network line chart-->
					
					    </div>
					    <div class="col-lg-5">
					        <div class="row">
					            <div class="col-sm-6 col-lg-6">
					
					                <!--Sparkline Area Chart-->
					                <div class="panel panel-success panel-colorful">
					
					                    <div class="pad-all">
					                        <p class="text-lg text-semibold"><i class="fa fa-hdd-o"></i> HDD Usage</p>
					                        <p class="mar-no">
					                            <span class="pull-right text-bold">132Gb</span>
					                            Free Space
					                        </p>
					                        <p class="mar-no">
					                            <span class="pull-right text-bold">1,45Gb</span>
					                            Used space
					                        </p>
					                    </div>
					                    <div class="pad-all text-center">
					
					                        <!--Placeholder-->
					                        <div id="demo-sparkline-area"></div>
					
					                    </div>
					                </div>
					            </div>
					            <div class="col-sm-6 col-lg-6">
					
					                <!--Sparkline Line Chart-->
					                <div class="panel panel-info panel-colorful">
					                    <div class="pad-all">
					                        <p class="text-lg text-semibold">Earning</p>
					                        <p class="mar-no">
					                            <span class="pull-right text-bold">$764</span>
					                            Today
					                        </p>
					                        <p class="mar-no">
					                            <span class="pull-right text-bold">$1,332</span>
					                            Last 7 Day
					                        </p>
					                    </div>
					                    <div class="pad-all text-center">
					
					                        <!--Placeholder-->
					                        <div id="demo-sparkline-line"></div>
					
					                    </div>
					                </div>
					            </div>
					        </div>
					        <div class="row">
					            <div class="col-sm-6 col-lg-6">
					
					                <!--Sparkline bar chart -->
					                <div class="panel panel-purple panel-colorful">
					                    <div class="pad-all">
					                        <p class="text-lg text-semibold">Sales</p>
					                        <p class="mar-no">
					                            <span class="pull-right text-bold">$764</span>
					                            Today
					                        </p>
					                        <p class="mar-no">
					                            <span class="pull-right text-bold">$1,332</span>
					                            Last 7 Day
					                        </p>
					                    </div>
					                    <div class="pad-all text-center">
					
					                        <!--Placeholder-->
					                        <div id="demo-sparkline-bar" class="box-inline"></div>
					
					                    </div>
					                </div>
					            </div>
					            <div class="col-sm-6 col-lg-6">
					
					                <!--Sparkline pie chart -->
					                <div class="panel panel-warning panel-colorful">
					                    <div class="pad-all">
					                        <p class="text-lg text-semibold">Task Progress</p>
					                        <p class="mar-no">
					                            <span class="pull-right text-bold">34</span>
					                            Completed
					                        </p>
					                        <p class="mar-no">
					                            <span class="pull-right text-bold">79</span>
					                            Total
					                        </p>
					                    </div>
					                    <div class="pad-all">
					                            <ul class="list-group list-unstyled">
					                                <li class="mar-btm">
					                                    <span class="label label-warning pull-right">15%</span>
					                                    <p>Progress</p>
					                                    <div class="progress progress-md">
					                                        <div style="width: 15%;" class="progress-bar progress-bar-light">
					                                            <span class="sr-only">15%</span>
					                                        </div>
					                                    </div>
					                                </li>
					                            </ul>
					                        <!--Placeholder-->
					                        <div id="demo-sparkline-pie" class="box-inline hidden"></div>
					                    </div>
					                </div>
					            </div>
					        </div>
					
					
					        <!--Extra Small Weather Widget-->
					        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					        <div class="panel middle">
					            <div class="media-left pad-all">
					                <canvas id="demo-weather-xs-icon" width="48" height="48"></canvas>
					            </div>
					
					            <div class="media-body">
					                <p class="text-2x mar-no text-mint">25&#176;</p>
					                <p class="text-muted mar-no">Partly Cloudy Day</p>
					            </div>
					        </div>
					
					        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					        <!--End Extra Small Weather Widget-->
					
					
					    </div>
					</div>
					
					
					<!--Tiles - Bright Version-->
					<!--===================================================-->
					<div class="row">
					    <div class="col-sm-6 col-lg-3">
					
					        <!--Registered User-->
					        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					        <div class="panel media pad-all">
					            <div class="media-left">
					                <span class="icon-wrap icon-wrap-sm icon-circle bg-success">
					                <i class="fa fa-user fa-2x"></i>
					                </span>
					            </div>
					
					            <div class="media-body">
					                <p class="text-2x mar-no text-thin">241</p>
					                <p class="text-muted mar-no">Registered User</p>
					            </div>
					        </div>
					        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					
					    </div>
					    <div class="col-sm-6 col-lg-3">
					
					        <!--New Order-->
					        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					        <div class="panel media pad-all">
					            <div class="media-left">
					                <span class="icon-wrap icon-wrap-sm icon-circle bg-info">
					                <i class="fa fa-shopping-cart fa-2x"></i>
					                </span>
					            </div>
					
					            <div class="media-body">
					                <p class="text-2x mar-no text-thin">543</p>
					                <p class="text-muted mar-no">New Order</p>
					            </div>
					        </div>
					        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					
					    </div>
					    <div class="col-sm-6 col-lg-3">
					
					        <!--Comments-->
					        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					        <div class="panel media pad-all">
					            <div class="media-left">
					                <span class="icon-wrap icon-wrap-sm icon-circle bg-warning">
					                <i class="fa fa-comment fa-2x"></i>
					                </span>
					            </div>
					
					            <div class="media-body">
					                <p class="text-2x mar-no text-thin">34</p>
					                <p class="text-muted mar-no">Comments</p>
					            </div>
					        </div>
					        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					
					    </div>
					    <div class="col-sm-6 col-lg-3">
					
					        <!--Sales-->
					        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					        <div class="panel media pad-all">
					            <div class="media-left">
					                <span class="icon-wrap icon-wrap-sm icon-circle bg-danger">
					                <i class="fa fa-dollar fa-2x"></i>
					                </span>
					            </div>
					
					            <div class="media-body">
					                <p class="text-2x mar-no text-thin">654</p>
					                <p class="text-muted mar-no">Sales</p>
					            </div>
					        </div>
					        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					
					    </div>
					</div>
					<!--===================================================-->
					<!--End Tiles - Bright Version-->
					
					<div class="row">
					    <div class="col-lg-4">
					                <!--List Todo-->
					                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					                <div class="panel panel-trans">
					                    <div class="panel-heading">
					                        <div class="panel-control">
					                            <button class="btn btn-default"><i class="fa fa-gear"></i></button>
					                        </div>
					                        <h3 class="panel-title">To do list</h3>
					                    </div>
					                    <div class="pad-ver">
					                        <ul class="list-group bg-trans list-todo mar-no">
					                            <li class="list-group-item">
					                                <label class="form-checkbox form-icon">
					                                    <input type="checkbox">
					                                    <span>Find an idea.</span>
					                                </label>
					                            </li>
					                            <li class="list-group-item">
					                                <label class="form-checkbox form-icon active">
					                                    <input type="checkbox" checked>
					                                    <span>Do some work</span>
					                                </label>
					                            </li>
					                            <li class="list-group-item">
					                                <label class="form-checkbox form-icon">
					                                    <input type="checkbox">
					                                    <span>Read the book</span>
					                                </label>
					                            </li>
					                            <li class="list-group-item">
					                                <label class="form-checkbox form-icon">
					                                    <input type="checkbox">
					                                    <span>Upgrade server</span>
					                                </label>
					                            </li>
					                            <li class="list-group-item">
					                                <label class="form-checkbox form-icon active">
					                                    <input type="checkbox" checked>
					                                    <span>Redesign my logo</span>
					                                </label>
					                            </li>
					                        </ul>
					                    </div>
					                    <div class="input-group pad-all">
					                        <input type="text" class="form-control" placeholder="New task" autocomplete="off">
					                        <span class="input-group-btn">
					                            <button type="button" class="btn btn-success"><i class="fa fa-plus"></i></button>
					                        </span>
					                    </div>
					                </div>
					                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					                <!--End todo list-->
					    </div>
					    <div class="col-lg-4">
					        <!--Weather widget-->
					        <!--===================================================-->
					        <div id="demo-weather-widget-md" class="panel panel-primary">
					            <div class="panel-heading">
					                <div class="panel-control">
					                    <button class="btn btn-default"><i class="fa fa-magic"></i></button>
					                    <button class="btn btn-default"><i class="fa fa-plus"></i></button>
					                </div>
					                <h3 class="panel-title"><i class="fa fa-map-marker fa-fw"></i> San Jose, CA</h3>
					            </div>
					
					            <!--Weather widget body-->
					            <div class="panel-body bg-primary">
					
					                <div class="media">
					                    <div class="media-left">
					                        <p class="text-4x text-thin mar-no">27&#176;</p>
					                        <p class="mar-no">21&#176; / 30&#176;</p>
					                        <p class="text-semibold text-nowrap">Partly Cloudy Day</p>
					                    </div>
					                    <div class="media-body text-center">
					                        <canvas id="demo-weather-md-icon-1" width="90" height="90"></canvas>
					                    </div>
					                </div>
					                <ul class="list-inline text-nowrap">
					                    <li><i class="fa fa-random fa-fw"></i> 17.67mph</li>
					                    <li><i class="fa fa-tint fa-fw"></i> 3%</li>
					                </ul>
					            </div>
					
					            <!--Weather widget footer-->
					            <div class="pad-all text-center">
					                <ul class="list-unstyled mar-no clearfix">
					                    <li class="col-xs-4">
					                        <div class="text-uppercase par-btm">
					                            <div class="text-semibold">Sat</div>
					                            <small class="text-muted">Cloudy</small>
					                        </div>
					                        <canvas id="demo-weather-md-icon-2" width="24" height="24"></canvas>
					                        <div class="text-sm">18 &#176; 25 &#176;</div>
					                    </li>
					                    <li class="col-xs-4">
					                        <div class="text-uppercase par-btm">
					                            <div class="text-semibold">Sun</div>
					                            <small class="text-muted">Wind</small>
					                        </div>
					                        <canvas id="demo-weather-md-icon-3" width="24" height="24"></canvas>
					                        <div class="text-sm">17 &#176; 23 &#176;</div>
					                    </li>
					                    <li class="col-xs-4">
					                        <div class="text-uppercase par-btm">
					                            <div class="text-semibold">Mon</div>
					                            <small class="text-muted">Rain</small>
					                        </div>
					                        <canvas id="demo-weather-md-icon-4" width="24" height="24"></canvas>
					                        <div class="text-sm">20 &#176; 21 &#176;</div>
					                    </li>
					                </ul>
					            </div>
					        </div>
					        <!--===================================================-->
					        <!--End Weather widget-->
					    </div>
					    <div class='col-lg-4'>
					        <div class="panel">
					            <div class="pad-all">
					                <div class="media mar-btm">
					                    <div class="media-left">
					                        <img src="<?php echo base_url(); ?>assets/admin/img/av6.png" class="img-md img-circle" alt="Avatar">
					                    </div>
					                    <div class="media-body">
					                        <p class="text-lg text-semibold mar-no">Brenda Fuller</p>
					                        <p>Project manager</p>
					                    </div>
					                </div>
					                <blockquote class="bq-sm bq-open">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt.</blockquote>
					            </div>
					
					            <div class="bord-top">
					                <ul class="list-group bord-no">
					                    <li class="list-group-item list-item-sm">
					                        <div class="media-left">
					                            <i class="fa fa-facebook-official fa-lg"></i>
					                        </div>
					                        <div class="media-body">
					                            <a href="#" class="btn-link">Facebook</a>
					                        </div>
					                    </li>
					                    <li class="list-group-item list-item-sm">
					                        <div class="media-left">
					                            <i class="fa fa-twitter fa-lg"></i>
					                        </div>
					                        <div class="media-body">
					                            <a href="#" class="btn-link">@BRfull</a>
					                            <br>
					                            Design my themes with <a href="#" class="btn-link">#Bootstrap</a> Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
					                        </div>
					                    </li>
					                    <li class="list-group-item list-item-sm">
					                        <div class="media-left">
					                            <i class="fa fa-linkedin fa-lg"></i>
					                        </div>
					                        <div class="media-body">
					                            <a href="#" class="btn-link">brendafull</a>
					                        </div>
					                    </li>
					                    <li class="list-group-item list-item-sm">
					                        <div class="media-body">
					
					                        </div>
					                    </li>
					                </ul>
					            </div>
					        </div>
					    </div>
					</div>
					
					<div class="panel">
					    <div class="panel-heading">
					        <div class="panel-control">
					            <a class="fa fa-question-circle fa-lg fa-fw unselectable add-tooltip" href="#" data-original-title="<h4 class='text-thin'>Information</h4><p style='width:150px'>This is an information bubble to help the user.</p>" data-html="true" title=""></a>
					        </div>
					        <h3 class="panel-title">Order Status</h3>
					    </div>
					
					    <!--Data Table-->
					    <!--===================================================-->
					    <div class="panel-body">
					        <div class="pad-btm form-inline">
					            <div class="row">
					                <div class="col-sm-6 table-toolbar-left">
					                    <button class="btn btn-purple btn-labeled fa fa-plus" id="demo-btn-addrow">Add</button>
					                    <button class="btn btn-default"><i class="fa fa-print"></i></button>
					                    <div class="btn-group">
					                        <button class="btn btn-default"><i class="fa fa-exclamation-circle"></i></button>
					                        <button class="btn btn-default"><i class="fa fa-trash"></i></button>
					                    </div>
					                </div>
					                <div class="col-sm-6 table-toolbar-right">
					                    <div class="form-group">
					                        <input type="text" autocomplete="off" class="form-control" placeholder="Search" id="demo-input-search2">
					                    </div>
					                    <div class="btn-group">
					                        <button class="btn btn-default"><i class="fa fa fa-cloud-download"></i></button>
					                        <div class="btn-group">
					                            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					                                <i class="fa fa-cog"></i>
					                                <span class="caret"></span>
					                            </button>
					                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
					                                <li><a href="#">Action</a></li>
					                                <li><a href="#">Another action</a></li>
					                                <li><a href="#">Something else here</a></li>
					                                <li class="divider"></li>
					                                <li><a href="#">Separated link</a></li>
					                            </ul>
					                        </div>
					                    </div>
					                </div>
					            </div>
					        </div>
					        <div class="table-responsive">
					            <table class="table table-striped">
					                <thead>
					                    <tr>
					                        <th>Invoice</th>
					                        <th>User</th>
					                        <th>Order date</th>
					                        <th>Amount</th>
					                        <th class="text-center">Status</th>
					                        <th class="text-center">Tracking Number</th>
					                    </tr>
					                </thead>
					                <tbody>
					                    <tr>
					                        <td><a href="#" class="btn-link"> Order #53431</a></td>
					                        <td>Steve N. Horton</td>
					                        <td><span class="text-muted"><i class="fa fa-clock-o"></i> Oct 22, 2014</span></td>
					                        <td>$45.00</td>
					                        <td class="text-center">
					                            <div class="label label-table label-success">Paid</div>
					                        </td>
					                        <td class="text-center">-</td>
					                    </tr>
					                    <tr>
					                        <td><a href="#" class="btn-link"> Order #53432</a></td>
					                        <td>Charles S Boyle</td>
					                        <td><span class="text-muted"><i class="fa fa-clock-o"></i> Oct 24, 2014</span></td>
					                        <td>$245.30</td>
					                        <td class="text-center">
					                            <div class="label label-table label-info">Shipped</div>
					                        </td>
					                        <td class="text-center"><i class="fa fa-plane"></i> CGX0089734531</td>
					                    </tr>
					                    <tr>
					                        <td><a href="#" class="btn-link"> Order #53433</a></td>
					                        <td>Lucy Doe</td>
					                        <td><span class="text-muted"><i class="fa fa-clock-o"></i> Oct 24, 2014</span></td>
					                        <td>$38.00</td>
					                        <td class="text-center">
					                            <div class="label label-table label-info">Shipped</div>
					                        </td>
					                        <td class="text-center"><i class="fa fa-plane"></i> CGX0089934571</td>
					                    </tr>
					                    <tr>
					                        <td><a href="#" class="btn-link"> Order #53434</a></td>
					                        <td>Teresa L. Doe</td>
					                        <td><span class="text-muted"><i class="fa fa-clock-o"></i> Oct 15, 2014</span></td>
					                        <td>$77.99</td>
					                        <td class="text-center">
					                            <div class="label label-table label-info">Shipped</div>
					                        </td>
					                        <td class="text-center"><i class="fa fa-plane"></i> CGX0089734574</td>
					                    </tr>
					                    <tr>
					                        <td><a href="#" class="btn-link"> Order #53435</a></td>
					                        <td>Teresa L. Doe</td>
					                        <td><span class="text-muted"><i class="fa fa-clock-o"></i> Oct 12, 2014</span></td>
					                        <td>$18.00</td>
					                        <td class="text-center">
					                            <div class="label label-table label-success">Paid</div>
					                        </td>
					                        <td class="text-center">-</td>
					                    </tr>
					                    <tr>
					                        <td><a href="#" class="btn-link">Order #53437</a></td>
					                        <td>Charles S Boyle</td>
					                        <td><span class="text-muted"><i class="fa fa-clock-o"></i> Oct 17, 2014</span></td>
					                        <td>$658.00</td>
					                        <td class="text-center">
					                            <div class="label label-table label-danger">Refunded</div>
					                        </td>
					                        <td class="text-center">-</td>
					                    </tr>
					                    <tr>
					                        <td><a href="#" class="btn-link">Order #536584</a></td>
					                        <td>Scott S. Calabrese</td>
					                        <td><span class="text-muted"><i class="fa fa-clock-o"></i> Oct 19, 2014</span></td>
					                        <td>$45.58</td>
					                        <td class="text-center">
					                            <div class="label label-table label-warning">Unpaid</div>
					                        </td>
					                        <td class="text-center">-</td>
					                    </tr>
					                </tbody>
					            </table>
					        </div>
					        <hr>
					        <div class="pull-right">
					            <ul class="pagination text-nowrap mar-no">
					                <li class="page-pre disabled">
					                    <a href="#">&lt;</a>
					                </li>
					                <li class="page-number active">
					                    <span>1</span>
					                </li>
					                <li class="page-number">
					                    <a href="#">2</a>
					                </li>
					                <li class="page-number">
					                    <a href="#">3</a>
					                </li>
					                <li>
					                    <span>...</span>
					                </li>
					                <li class="page-number">
					                    <a href="#">9</a>
					                </li>
					                <li class="page-next">
					                    <a href="#">&gt;</a>
					                </li>
					            </ul>
					        </div>
					    </div>
					    <!--===================================================-->
					    <!--End Data Table-->
					
					</div>
					
					
					
				</div>
				<!--===================================================-->
				<!--End page content-->


			</div>
			<!--===================================================-->
			<!--END CONTENT CONTAINER-->
			<?php $sidebar_data = array("trip_count" => $today_count);
                              $sidebar_data["dashboard"] = $dashboard;
			 $this->load->view('admin/sidebar',$sidebar_data); ?>
			<?php /*
			<!--ASIDE-->
			<!--===================================================-->
			<aside id="aside-container">
				<div id="aside">
					<div class="nano">
						<div class="nano-content">
							
							<!--Nav tabs-->
							<!--================================-->
							<ul class="nav nav-tabs nav-justified">
								<li class="active">
									<a href="#demo-asd-tab-1" data-toggle="tab">
										<i class="fa fa-comments"></i>
										<span class="badge badge-purple">7</span>
									</a>
								</li>
								<li>
									<a href="#demo-asd-tab-2" data-toggle="tab">
										<i class="fa fa-info-circle"></i>
									</a>
								</li>
								<li>
									<a href="#demo-asd-tab-3" data-toggle="tab">
										<i class="fa fa-wrench"></i>
									</a>
								</li>
							</ul>
							<!--================================-->
							<!--End nav tabs-->



							<!-- Tabs Content -->
							<!--================================-->
							<div class="tab-content">

								<!--First tab (Contact list)-->
								<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
								<div class="tab-pane fade in active" id="demo-asd-tab-1">
									<h4 class="pad-hor text-thin">
										<span class="pull-right badge badge-warning">3</span> Family
									</h4>

									<!--Family-->
									<div class="list-group bg-trans">
										<a href="#" class="list-group-item">
											<div class="media-left">
												<img class="img-circle img-xs" src="<?php echo base_url(); ?>assets/admin/img/av2.png" alt="Profile Picture">
											</div>
											<div class="media-body">
												<div class="text-lg">Stephen Tran</div>
												<span class="text-muted">Availabe</span>
											</div>
										</a>
										<a href="#" class="list-group-item">
											<div class="media-left">
												<img class="img-circle img-xs" src="<?php echo base_url(); ?>assets/admin/img/av4.png" alt="Profile Picture">
											</div>
											<div class="media-body">
												<div class="text-lg">Brittany Meyer</div>
												<span class="text-muted">I think so</span>
											</div>
										</a>
										<a href="#" class="list-group-item">
											<div class="media-left">
												<img class="img-circle img-xs" src="<?php echo base_url(); ?>assets/admin/img/av3.png" alt="Profile Picture">
											</div>
											<div class="media-body">
												<div class="text-lg">Donald Brown</div>
												<span class="text-muted">Lorem ipsum dolor sit amet.</span>
											</div>
										</a>
									</div>


									<hr>
									<h4 class="pad-hor text-thin">
										<span class="pull-right badge badge-info">4</span> Friends
									</h4>

									<!--Friends-->
									<div class="list-group bg-trans">
										<a href="#" class="list-group-item">
											<div class="media-left">
												<img class="img-circle img-xs" src="<?php echo base_url(); ?>assets/admin/img/av5.png" alt="Profile Picture">
											</div>
											<div class="media-body">
												<div class="text-lg">Betty Murphy</div>
												<span class="text-muted">Bye</span>
											</div>
										</a>
										<a href="#" class="list-group-item">
											<div class="media-left">
												<img class="img-circle img-xs" src="<?php echo base_url(); ?>assets/admin/img/av6.png" alt="Profile Picture">
											</div>
											<div class="media-body">
												<div class="text-lg">Olivia Spencer</div>
												<span class="text-muted">Thank you!</span>
											</div>
										</a>
										<a href="#" class="list-group-item">
											<div class="media-left">
												<img class="img-circle img-xs" src="<?php echo base_url(); ?>assets/admin/img/av4.png" alt="Profile Picture">
											</div>
											<div class="media-body">
												<div class="text-lg">Sarah Ruiz</div>
												<span class="text-muted">2 hours ago</span>
											</div>
										</a>
										<a href="#" class="list-group-item">
											<div class="media-left">
												<img class="img-circle img-xs" src="<?php echo base_url(); ?>assets/admin/img/av3.png" alt="Profile Picture">
											</div>
											<div class="media-body">
												<div class="text-lg">Paul Aguilar</div>
												<span class="text-muted">2 hours ago</span>
											</div>
										</a>
									</div>


									<hr>
									<h4 class="pad-hor text-thin">
										<span class="pull-right badge badge-success">Offline</span> Works
									</h4>

									<!--Works-->
									<div class="list-group bg-trans">
										<a href="#" class="list-group-item">
											<span class="badge badge-purple badge-icon badge-fw pull-left"></span> Joey K. Greyson
										</a>
										<a href="#" class="list-group-item">
											<span class="badge badge-info badge-icon badge-fw pull-left"></span> Andrea Branden
										</a>
										<a href="#" class="list-group-item">
											<span class="badge badge-pink badge-icon badge-fw pull-left"></span> Lucy Moon
										</a>
										<a href="#" class="list-group-item">
											<span class="badge badge-success badge-icon badge-fw pull-left"></span> Johny Juan
										</a>
										<a href="#" class="list-group-item">
											<span class="badge badge-danger badge-icon badge-fw pull-left"></span> Susan Sun
										</a>
									</div>

								</div>
								<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
								<!--End first tab (Contact list)-->


								<!--Second tab (Custom layout)-->
								<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
								<div class="tab-pane fade" id="demo-asd-tab-2">

									<!--Monthly billing-->
									<div class="pad-all">
										<h4 class="text-lg mar-no">Monthly Billing</h4>
										<p class="text-sm">January 2015</p>
										<button class="btn btn-block btn-success mar-top">Pay Now</button>
									</div>


									<hr>

									<!--Information-->
									<div class="text-center clearfix pad-top">
										<div class="col-xs-6">
											<span class="h4">4,327</span>
											<p class="text-muted text-uppercase"><small>Sales</small></p>
										</div>
										<div class="col-xs-6">
											<span class="h4">$ 1,252</span>
											<p class="text-muted text-uppercase"><small>Earning</small></p>
										</div>
									</div>


									<hr>

									<!--Simple Menu-->
									<div class="list-group bg-trans">
										<a href="#" class="list-group-item"><span class="label label-danger pull-right">Featured</span>Edit Password</a>
										<a href="#" class="list-group-item">Email</a>
										<a href="#" class="list-group-item"><span class="label label-success pull-right">New</span>Chat</a>
										<a href="#" class="list-group-item">Reports</a>
										<a href="#" class="list-group-item">Transfer Funds</a>
									</div>


									<hr>

									<div class="text-center">Questions?
										<p class="text-lg text-semibold"> (415) 234-53454 </p>
										<small><em>We are here 24/7</em></small>
									</div>
								</div>
								<!--End second tab (Custom layout)-->
								<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


								<!--Third tab (Settings)-->
								<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
								<div class="tab-pane fade" id="demo-asd-tab-3">
									<ul class="list-group bg-trans">
										<li class="list-header">
											<h4 class="text-thin">Account Settings</h4>
										</li>
										<li class="list-group-item">
											<div class="pull-right">
												<input class="demo-switch" type="checkbox" checked>
											</div>
											<p>Show my personal status</p>
											<small class="text-muted">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</small>
										</li>
										<li class="list-group-item">
											<div class="pull-right">
												<input class="demo-switch" type="checkbox" checked>
											</div>
											<p>Show offline contact</p>
											<small class="text-muted">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</small>
										</li>
										<li class="list-group-item">
											<div class="pull-right">
												<input class="demo-switch" type="checkbox">
											</div>
											<p>Invisible mode </p>
											<small class="text-muted">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</small>
										</li>
									</ul>


									<hr>

									<ul class="list-group bg-trans">
										<li class="list-header"><h4 class="text-thin">Public Settings</h4></li>
										<li class="list-group-item">
											<div class="pull-right">
												<input class="demo-switch" type="checkbox" checked>
											</div>
											Online status
										</li>
										<li class="list-group-item">
											<div class="pull-right">
												<input class="demo-switch" type="checkbox" checked>
											</div>
											Show offline contact
										</li>
										<li class="list-group-item">
											<div class="pull-right">
												<input class="demo-switch" type="checkbox">
											</div>
											Show my device icon
										</li>
									</ul>



									<hr>

									<h4 class="pad-hor text-thin">Task Progress</h4>
									<div class="pad-all">
										<p>Upgrade Progress</p>
										<div class="progress progress-sm">
											<div class="progress-bar progress-bar-success" style="width: 15%;"><span class="sr-only">15%</span></div>
										</div>
										<small class="text-muted">15% Completed</small>
									</div>
									<div class="pad-hor">
										<p>Database</p>
										<div class="progress progress-sm">
											<div class="progress-bar progress-bar-danger" style="width: 75%;"><span class="sr-only">75%</span></div>
										</div>
										<small class="text-muted">17/23 Database</small>
									</div>

								</div>
								<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
								<!--Third tab (Settings)-->

							</div>
						</div>
					</div>
				</div>
			</aside>
			<!--===================================================-->
			<!--END ASIDE-->
			*/ ?>
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


        <!-- SCROLL TOP BUTTON -->
        <!--===================================================-->
        <button id="scroll-top" class="btn"><i class="fa fa-chevron-up"></i></button>
        <!--===================================================-->



	</div>
	<!--===================================================-->
	<!-- END OF CONTAINER -->


	
	
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


    <!--Morris.js [ OPTIONAL ]-->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/morris-js/morris.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/admin/plugins/morris-js/raphael-js/raphael.min.js"></script>


    <!--Sparkline [ OPTIONAL ]-->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/sparkline/jquery.sparkline.min.js"></script>


    <!--Skycons [ OPTIONAL ]-->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/skycons/skycons.min.js"></script>


    <!--Switchery [ OPTIONAL ]-->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/switchery/switchery.min.js"></script>


    <!--Bootstrap Select [ OPTIONAL ]-->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/bootstrap-select/bootstrap-select.min.js"></script>


    <!--Demo script [ DEMONSTRATION ]-->
    <script src="<?php echo base_url(); ?>assets/admin/js/demo/nifty-demo.min.js"></script>


    <!--Specify page [ SAMPLE ]-->
    <script src="<?php echo base_url(); ?>assets/admin/js/demo/dashboard.js"></script>

    
	<!--

	REQUIRED
	You must include this in your project.

	RECOMMENDED
	This category must be included but you may modify which plugins or components which should be included in your project.

	OPTIONAL
	Optional plugins. You may choose whether to include it in your project or not.

	DEMONSTRATION
	This is to be removed, used for demonstration purposes only. This category must not be included in your project.

	SAMPLE
	Some script samples which explain how to initialize plugins or components. This category should not be included in your project.


	Detailed information and more samples can be found in the document.

	-->
		

</body>

<!-- Mirrored from www.themeon.net/nifty/v2.3/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 12 Apr 2016 05:37:34 GMT -->
</html>
