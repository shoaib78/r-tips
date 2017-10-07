<div class="boxed">
    <!--CONTENT CONTAINER-->
    <!--===================================================-->
    <div id="content-container">
        <!--Page content-->
        <!--===================================================-->
        
        <div id="page-content">
          <div class="col-lg-12">
            <div class="row">
              <div class="panel">
          
                <div class="panel-heading">
                    <div class="pull-left col-md-6">
                        <h3 class="panel-title">Membership Plans</h3>
                    </div>
                    <div class="pull-right col-md-6" style="text-align: right; margin-top: 10px;">
                        <a href="<?php echo base_url("admin/plans") ?>" class="btn btn-success">Add New Plans</a>
                    </div>
                </div>
          
                <!--Panel Body-->
                <div class="panel-body">
                    <?php
                        $success = $this->session->flashdata('msg_success');
                        $error = $this->session->flashdata('msg_error');
                    ?>
                    <?php if(!empty($success)) { echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><b>'.$success.'</b></div>'; } ?>
                    <?php if(!empty($error)) { echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><b>'.$error.'</b></div>'; } ?>
                    <table id="mambership_plans" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Day</th>
                                <th>Month</th>
                                <th>Rate</th>
                                <th class="min-desktop">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
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
    <?php
    $sidebar_data = array("trip_count" => $today_count);
    $sidebar_data["membership"] = $membership;
    $this->load->view('admin/sidebar', $sidebar_data);
    ?>


</div>

<!--===================================================-->
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
<!--Panel [ SAMPLE ]-->
    <script src="<?php echo base_url(); ?>assets/admin/js/demo/ui-panels.js"></script>
 <!--DataTables Sample [ SAMPLE ]-->
  <script src="//cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
            var oTable= $('#mambership_plans').DataTable({
                "aoColumns": [
                    { "iDataSort": 1 },
                    { "iDataSort": 2 },
                    { "iDataSort": 3 },
                    { "sClass": "center", "bSortable": false },
                ],
                "sPaginationType": "full_numbers",
                "Retrieve": true,
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "iDisplayLength":10,
                "ajax": "<?php echo base_url('admin/membership_plans'); ?>",
            });

            $(document).on("click",".delete_plan",function(e){ 
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
        });
    </script>
</body>

<!-- Mirrored from www.themeon.net/nifty/v2.3/tables-datatable.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 12 Apr 2016 05:38:49 GMT -->
</html>                                                                                                                                                                                                                                                                                                                          