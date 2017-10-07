
<div class="boxed">

    <!--CONTENT CONTAINER-->
    <!--===================================================-->
    <div id="content-container">

        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">

            <!-- Basic Data Tables -->
            <!--===================================================-->
            <div class="panel">
                <div class="panel-heading">
                   <h3 class="panel-title">User Listings</h3>
                </div>
                <div class="panel-body">
                    <table id="users" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="min-desktop">Email</th>
                                <th class="min-desktop">Username</th>
                                <th class="min-desktop">Name</th>
                                <th class="min-desktop">Gender</th>
                                <th class="min-desktop">DOB</th>
                                <th class="min-desktop">Location</th>
                                <th class="min-desktop">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <!--===================================================-->
            <!-- End Striped Table -->

        </div>
        <!--===================================================-->
        <!--End page content-->


    </div>
    <!--===================================================-->
    <!--END CONTENT CONTAINER-->



    <!--END CONTENT CONTAINER-->
    <?php
    $sidebar_data = array("trip_count" => $today_count);
    $sidebar_data["users"] = $users;
    $this->load->view('admin/sidebar', $sidebar_data);
    ?>
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

<!--View Trip Bootstrap Modal-->
        <!--===================================================-->
        <div class="modal fade" id="user-view-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!--Modal header-->
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal" type="button"><span>×</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">User Detail</h4>
                    </div>

                    <!--Modal body-->
                    <div class="modal-body">
                        
                    </div>

                    <!--Modal footer-->
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!--===================================================-->
        <!--End Default Bootstrap Modal-->

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


<!--DataTables Sample [ SAMPLE ]-->
<script src="//cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        var oTable = $('#users').DataTable({
            "aoColumns": [
            //{ "sClass": "center", "bSortable": false },
            { "iDataSort": 1 },
            { "iDataSort": 2 },
            { "iDataSort": 3 },
            { "iDataSort": 4},
            { "iDataSort": 5 },
            { "iDataSort": 6},
            { "bSortable": false },
            ],
            "sPaginationType": "full_numbers",
            //"Retrieve": true,
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "iDisplayLength":25,
            "ajax": "<?php base_url('admin/manage_users'); ?>"
        });


        $(document).on("click", ".delete_user", function (e) {
            e.preventDefault();
            var elem = $(this);
            var url = elem.attr("href");

            $.ajax({
                url: url,
                type: "post",
                dataType: "json",
                success: function (data) {
                    if (!data.error) {
                    elem.closest("tr").remove();
                        $('table').DataTable().ajax.reload();
                    } else {
                        alert(data.message);
                    }
                },
            });
        });

        $(document).on("click", ".user_view", function (e) {
            e.preventDefault();
            var elem = $(this);
            var url = elem.attr("href");

            $.ajax({
                url: url,
                type: "post",
                dataType: "json",
                success: function (data) {
                    $("#user-view-modal").find(".modal-body").empty();
                    if(!data.error){
                        $("#user-view-modal").find(".modal-body").append(data.htmlContent);
                        $("#user-view-modal").modal();
                    }else{
                        var _html = '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Errors!</p><p>Some error are exist. please try again!!</p></div>';
                        $("#user-view-modal").find(".modal-body").append(_html);
                        $("#user-view-modal").modal();
                    }
                },
            });
        });

        $(document).on("click", ".status", function (e) {
            e.preventDefault();
            var elem = $(this);
            var url = elem.attr("href");
            var status = elem.attr("data-status");
            $.ajax({
                url: url,
                type: "post",
                dataType: "json",
                data: {status:status},
                success: function (data) {
                    if (!data.error) {
                        if(data.detail.approve == 1){
                            elem.text('Deactive');
                            elem.attr('data-status',0);
                        }else{
                            elem.text('Active');
                            elem.attr('data-status',1);
                        }
                    } else {
                        alert(data.message);
                    }
                },
            });
        });
    });
</script>
</body>

<!-- Mirrored from www.themeon.net/nifty/v2.3/tables-datatable.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 12 Apr 2016 05:38:49 GMT -->
</html>