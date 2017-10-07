<!--MAIN NAVIGATION-->

<!--===================================================-->

<nav id="mainnav-container">

    <div id="mainnav">



        <!--Shortcut buttons-->

        <!--================================-->

        <div id="mainnav-shortcut">

            <ul class="list-unstyled">

                <li class="col-xs-4" data-content="Additional Sidebar">

                    <a id="demo-toggle-aside" class="shortcut-grid" href="#">

                        <i class="fa fa-magic"></i>

                    </a>

                </li>

                <li class="col-xs-4" data-content="Notification">

                    <a id="demo-alert" class="shortcut-grid" href="#">

                        <i class="fa fa-bullhorn"></i>

                    </a>

                </li>

                <li class="col-xs-4" data-content="Page Alerts">

                    <a id="demo-page-alert" class="shortcut-grid" href="#">

                        <i class="fa fa-bell"></i>

                    </a>

                </li>

            </ul>

        </div>

        <!--================================-->

        <!--End shortcut buttons-->





        <!--Menu-->

        <!--================================-->

        <div id="mainnav-menu-wrap">

            <div class="nano">

                <div class="nano-content">

                    <ul id="mainnav-menu" class="list-group">



                        <!--Category name-->

                        <li class="list-header">Navigation</li>



                        <!--Menu list item-->

                        <li class="active-link <?php echo isset($dashboard)?'active':'' ?>">

                            <a href="<?php echo base_url("admin"); ?>" title="Dashboard">

                                <i class="fa fa-dashboard "></i>

                                <span class="menu-title">

                                    <strong>Dashboard</strong>

                                    <span class="label label-success pull-right">Top</span>

                                </span>

                            </a>

                        </li>

                        <li class="active-link <?php echo isset($users)?'active':'' ?>">

                            <a href="<?php echo base_url("admin/manage_users"); ?>" title="Users">

                                <i class="fa fa-users"></i>

                                <span class="menu-title">

                                    <strong>Users</strong>

                                </span>

                            </a>

                        </li>

                        <li class="active-link <?php echo isset($trip_categories)?'active':'' ?>">

                            <a href="<?php echo base_url("admin/trip_categories"); ?>" title="Trips Categories">

                                <i class="fa fa-sitemap"></i>

                                <span class="menu-title">

                                    <strong>Trips Categories</strong>

                                </span>

                            </a>

                        </li>

                        

                        <li class="active-link <?php echo isset($trip)?'active':'' ?>">

                            <a href="<?php echo base_url("admin/trips"); ?>" title="Trips">

                                <i class="fa fa-bus"></i>

                                <span class="menu-title">

                                    <strong>Trips</strong>

                                    <span class="label label-success pull-right"><?php echo ($trip_count > 0) ? $trip_count : 0; ?></span>

                                </span>

                            </a>

                        </li>

                        <li class="active-link <?php echo isset($favorite_trips)?'active':'' ?>">

                            <a href="<?php echo base_url("admin/favorite_trips"); ?>" title="Trips">

                                <i class="fa fa-car"></i>

                                <span class="menu-title">

                                    <strong>Favorite Trips</strong>

                                </span>

                            </a>

                        </li>

                        <li class="active-link <?php echo isset($discover_trips)?'active':'' ?>">

                            <a href="<?php echo base_url("admin/discover_trips"); ?>" title="Trips">

                                <i class="fa fa-subway"></i>

                                <span class="menu-title">

                                    <strong>Discovered Trips</strong>

                                </span>

                            </a>

                        </li>

                        <li class="active-link <?php echo (isset($wishtips) || isset($wishtips_category) || isset($wishtips_report))?'active':'' ?>">
                            <a href="<?php echo base_url("admin/manage_wishtips"); ?>" title="Wishtips">
                                <i class="fa fa-map-marker"></i>
                                <span class="menu-title"><strong>Manage Wishtips</strong></span>
                                <i class="arrow"></i>
                            </a>

                            <!--Submenu-->
                            <ul class="collapse">
                                <li class="<?php echo isset($wishtips)?'active':'' ?>">
                                    <a href="<?php echo base_url("admin/manage_wishtips"); ?>" title="Manage Wishtips" ><i class="fa fa-map-marker"></i></i> Manage Wishtips</a>
                                </li>
                                <li class="<?php echo isset($wishtips_category)?'active':'' ?>">
                                    <a href="<?php echo base_url("admin/wishtips_category"); ?>" title="Wishtips Category"><i class="fa fa-list"></i> Wishtips Category</a>
                                </li>
                                <li class="<?php echo isset($wishtips_report)?'active':'' ?>">
                                    <a href="<?php echo base_url("admin/wishtips_report"); ?>" title="Wishtips Category"><i class="fa fa-question-circle"></i> Wishtips Report</a>
                                </li>
                            </ul>
                        </li>

                        <li class="active-link <?php echo (isset($advertisment) || isset($membership))?'active':'' ?>">
                            <a href="<?php echo base_url("admin/manage_advertisment"); ?>" title="Advertisments">
                                <i class="fa fa-image"></i>
                                <span class="menu-title"><strong>Manage Advertisment</strong></span>
                                <i class="arrow"></i>
                            </a>
            
                            <!--Submenu-->
                            <ul class="collapse">
                                <li class="<?php echo isset($advertisment)?'active':'' ?>">
                                    <a href="<?php echo base_url("admin/manage_advertisment"); ?>" title="Manage Advertisment" ><i class="fa fa-clipboard"></i> Manage Advertisment</a>
                                </li>
                                <li class="<?php echo isset($membership)?'active':'' ?>">
                                    <a href="<?php echo base_url("admin/membership_plans"); ?>" title="Advertisment Membership Plans"><i class="fa fa-money"></i> Advertisment Membership Plans</a>
                                </li>
                            </ul>
                        </li>

                        <li class="active-link <?php echo isset($batch)?'active':'' ?>">

                            <a href="<?php echo base_url("admin/manage_batch"); ?>" title="Trips">

                                <i class="fa fa-gift"></i>

                                <span class="menu-title">

                                    <strong>Manage Batch</strong>

                                </span>

                            </a>

                        </li>

                        <li class="active-link <?php echo isset($credit)?'active':'' ?>">

                            <a href="<?php echo base_url("admin/manage_credit_points"); ?>" title="Trips">

                                <i class="fa fa-usd"></i>

                                <span class="menu-title">

                                    <strong>Manage Credit Points</strong>

                                </span>

                            </a>

                        </li>

                        <li class="active-link <?php echo isset($settings)?'active':'' ?>">

                            <a href="<?php echo base_url("admin/settings"); ?>" title="Trips">

                                <i class="fa fa-gear"></i>

                                <span class="menu-title">

                                    <strong>Settings</strong>

                                </span>

                            </a>

                        </li>

                    </ul>

                </div>

            </div>

        </div>

        <!--================================-->

        <!--End menu-->



    </div>

</nav>

<!--===================================================-->

<!--END MAIN NAVIGATION-->

