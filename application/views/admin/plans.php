<!--Chosen [ OPTIONAL ]-->
<link href="<?php echo base_url(); ?>assets/admin/plugins/chosen/chosen.min.css" rel="stylesheet">
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
          
                <!--Panel heading-->
                <div class="panel-heading">
                   <h3 class="panel-title">Add New Plans</h3>
                </div>
          
                <!--Panel Body-->
                <div class="panel-body">
                    <?php
                        $success = $this->session->flashdata('msg_success');
                        $error = $this->session->flashdata('msg_error');
                    ?>
                    <?php if(!empty($success)) { echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><b>'.$success.'</b></div>'; } ?>
                    <?php if(!empty($error)) { echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><b>'.$error.'</b></div>'; } ?>
                    <?php
                          $value = "";
                          $key = "";
                          if(isset($plan->plans_day) && !empty($plan->plans_day)){
                            $value = $plan->plans_day;
                            $key = "day";
                          }elseif(isset($plan->plans_month) && !empty($plan->plans_month)){
                            $value = $plan->plans_month;
                            $key = "month";
                          }
                    ?>
                    <form class="form-horizontal" action="<?php echo current_url() ?>" method="post">
                          <div class="form-group">
                              <label class="control-label" for="plans_rate">Plans Periods </label>
                              <div class="controls">
                                  <select data-placeholder="Choose Plans Periods..." name="plans_duration_type" id="plans_label" tabindex="2">
                                    <option value="day" <?php if(isset($key) && $key == "day") { ?>selected="selected" <?php } ?>>Days</option>
                                    <option value="month" <?php if(isset($key) && $key == "month") { ?>selected="selected" <?php } ?>>Months</option>
                                  </select>

                                  <select data-placeholder="Choose Plans Day..." name="plans_duration" id="plans_day" tabindex="2">
                                    <?php if($key && $key == "month"){ ?>
                                          <option value="1" <?php if(isset($value) && $value == 1) { ?>selected="selected" <?php } ?>>1</option>
                                          <option value="2" <?php if(isset($value) && $value == 2) { ?>selected="selected" <?php } ?>>2</option>
                                          <option value="3" <?php if(isset($value) && $value == 3) { ?>selected="selected" <?php } ?>>3</option>
                                          <option value="6" <?php if(isset($value) && $value == 6) { ?>selected="selected" <?php } ?>>6</option>
                                          <option value="12" <?php if(isset($value) && $value == 12) { ?>selected="selected" <?php } ?>>12</option>
                                    <?php }else{ ?>
                                          <?php for($i=1; $i<=7; $i++){ ?>
                                            <option value="<?php echo $i ?>" <?php if(isset($value) && $value == $i) { ?>selected="selected" <?php } ?>><?php echo $i ?></option>
                                          <?php } ?>
                                    <?php } ?>
                                  </select>
                                  <?php //echo form_input($data); ?>
                              </div>    
                          </div>

                          <div class="form-group">
                              <label class="control-label" for="plans_rate">Plan Rate </label>
                              <div class="controls">
                                  <?php
                                  $data = array(
                                      'name' => 'plans_rate',
                                      'id' => 'plans_rate',
                                      'value' => set_value('plans_rate') ? set_value('plans_rate') : (isset($plan->plans_rate) ? $plan->plans_rate : ''),
                                      'placeholder' => 'Enter plan Rate',
                                      'class' => 'form-control'
                                  );

                                echo form_input($data);
                                ?>
                              </div>    
                          </div>
                          
                          <div class="form-group text-center">
                              <button type="submit" class="edit-profile btn btn-primary">
                                &nbsp; &nbsp;  Save Plans Info &nbsp; &nbsp; 
                               </button>
                          </div>
                      </form>
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

<!--Chosen [ OPTIONAL ]-->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/chosen/chosen.jquery.min.js"></script>
<!--DataTables [ OPTIONAL ]-->
<script src="<?php echo base_url(); ?>assets/admin/plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>


<!--Demo script [ DEMONSTRATION ]-->
<script src="<?php echo base_url(); ?>assets/admin/js/demo/nifty-demo.min.js"></script>
<!--Panel [ SAMPLE ]-->
    <script src="<?php echo base_url(); ?>assets/admin/js/demo/ui-panels.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      //$('#plans_day, #plans_label').chosen();
      $('#plans_label').chosen({width:'200px'});
      $('#plans_day').chosen({width:'250px'});
    });

    $("#plans_label").on("change",function(event) {
        var elem = $(this);
        var value = "";
        if(elem.val() == "day"){
          for(var i = 1; i<=7; i++){
             value += '<option value="'+i+'">'+i+'</option>';
          }
        }else if(elem.val() == "month"){
           value += ' <option value="1">1</option>'+
                      ' <option value="2">2</option>'+
                      ' <option value="3">3</option>'+
                      ' <option value="6">6</option>'+
                      ' <option value="12">12</option>';
        }

        $('#plans_day')
            .find('option')
            .remove()
            .end()
            .append(value)
            .trigger("chosen:updated");
    });
  </script>
</body>

<!-- Mirrored from www.themeon.net/nifty/v2.3/tables-datatable.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 12 Apr 2016 05:38:49 GMT -->
</html>                                                                                                                                                                                                                                                                                                                          