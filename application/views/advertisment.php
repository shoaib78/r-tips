<link href="<?php echo base_url(); ?>assets/css/dropzone/dropzone.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/js/dropzone/dropzone.js"></script>
<style type="text/css">
    .dropzone.dz-started .dz-message {
        display: block;
    }
    .dropzone .dz-message,.btn-custom {
        box-shadow: none;
        clear: both;
        color: #38b8e9;
        display: inline-block;
        margin: 0;
    }
    .btn-custom { width:auto; }
    .dz-default.dz-message > span{
        border: none !important;
        margin-right: 0px !important;
        padding: 0px !important;
    }
    .dropzone {
        background: white none repeat scroll 0 0;
        border: none;
        min-height: auto;
        width: 100%;
        padding: 0px;
    }
</style>
<?php
$rates = "";
foreach ($plans as $plan) {
    if (!empty($plan) && !empty($plan->plans_rate) && $plan->plans_day == 1) {
        $rates = $plan->plans_rate;
    }
}
?>
<section class="welcome_classic">
    <div class="container">
        <div class="classic_inner">
            <h1>ADVERTISEMENT</h1>
            <div class="search_holiday_wrap">
            </div>

        </div>
    </div>
</section>
<section class="adverise_sec">
    <div class="container">
        <div class="col-sm-8 places_form_main">
            <?php
            $success = $this->session->flashdata('msg_success');
            $error = $this->session->flashdata('msg_error');
            ?>
            <?php if (!empty($success)) {
                echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><b>' . $success . '</b></div>';
            } ?>
            <?php if (!empty($error)) {
                echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><b>' . $error . '</b></div>';
            } ?>
            <?php
            $value = "";
            $key = "";
            /*if(isset($plan->plans_day) && !empty($plan->plans_day)){
              $value = $plan->plans_day;
              $key = "day";
            }elseif(isset($plan->plans_month) && !empty($plan->plans_month)){
              $value = $plan->plans_month;
              $key = "month";
            }*/
            ?>
            <form method="post" id="adviretisement-form" action="<?php echo current_url() ?>">
                <div class="form-group">
                    <label class="control-label">Upload banner image <span class="asteriskField">*</span></label>
                    <div class="dropzone" id="banner_dropzone" style="border: none; padding: 0;">
                    </div>

                    <div class="col-sm-12 dropzone dz-clickable" id="preview-image">
                    </div>
                    <input type="hidden" name="banner_image" id="banner_image" value=""/>
                    <?php echo form_error('banner_image'); ?>
                </div><!-- form-group -->
                <div class="form-group">
                    <label class="control-label">Banner Link  <span class="asteriskField">*</span></label>
                    <?php
                    $data = array(
                        'name' => 'banner_link',
                        'id' => 'banner_link',
                        'value' => set_value('banner_link') ? set_value('banner_link') : '',
                        'placeholder' => 'Enter Banner Link',
                        'class' => (form_error('banner_link')) ? 'form-control error' : 'form-control'
                    );

                    echo form_input($data);
                    ?>
                    <?php echo form_error('banner_link'); ?>
                </div><!-- form-group -->
                <div class="form-group">
                    <label class="control-label">Banner Size  <span class="asteriskField">*</span></label>
                    <select class="form-control <?php echo (form_error('banner_size')) ? 'error' : ''; ?>"
                            name="banner_size" id="banner_size">
                        <option value="280x120">280x120</option>
                        <option value="480x320">480x320</option>
                        <option value="640x360">640x360</option>
                        <option value="1024x768">1024x768</option>
                    </select>
                    <?php echo form_error('banner_size'); ?>
                </div><!-- form-group -->
                <div class="form-group">
                    <label class="control-label">Banner Period <span class="asteriskField">*</span></label>
                    <div class="clearfix"></div>
                    <div class="col-sm-4 ad_form">
                        <select name="plans_duration_type" id="plans_label"
                                class="form-control <?php echo (form_error('plans_label')) ? 'error' : ''; ?>">
                            <option value="day"
                                    <?php if (isset($key) && $key == "day") { ?>selected="selected" <?php } ?>>Days
                            </option>
                            <option value="month"
                                    <?php if (isset($key) && $key == "month") { ?>selected="selected" <?php } ?>>Months
                            </option>
                        </select>
                        <?php echo form_error('plans_label'); ?>
                    </div>
                    <div class="col-sm-3 ad_form af">
                        <select data-placeholder="Choose Plans Day..." name="plans_duration" id="plans_day"
                                class="form-control <?php echo (form_error('plans_duration')) ? 'error' : ''; ?>">
                            <?php if ($key && $key == "month") { ?>
                                <option value="1"
                                        <?php if (isset($value) && $value == 1) { ?>selected="selected" <?php } ?>>1
                                </option>
                                <option value="2"
                                        <?php if (isset($value) && $value == 2) { ?>selected="selected" <?php } ?>>2
                                </option>
                                <option value="3"
                                        <?php if (isset($value) && $value == 3) { ?>selected="selected" <?php } ?>>3
                                </option>
                                <option value="6"
                                        <?php if (isset($value) && $value == 6) { ?>selected="selected" <?php } ?>>6
                                </option>
                                <option value="12"
                                        <?php if (isset($value) && $value == 12) { ?>selected="selected" <?php } ?>>12
                                </option>
                            <?php } else { ?>
                                <?php for ($i = 1; $i <= 7; $i++) { ?>
                                    <option value="<?php echo $i ?>"
                                            <?php if (isset($value) && $value == $i) { ?>selected="selected" <?php } ?>><?php echo $i ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <?php echo form_error('plans_duration'); ?>
                    <div class="clearfix"></div>
                </div><!-- form-group -->
                <div class="form-group clearf-x">
                    <label for="">Start On <span class="asteriskField">*</span></label>
                    <input data-provide="datepicker" placeholder="Start On"
                           class="date form-control <?php echo (form_error('start_date')) ? 'error' : ''; ?>"
                           name="start_date" id="start_date"
                           value="<?php echo set_value('start_date') ? set_value('start_date') : ''; ?>" type="text">
                    <?php echo form_error('start_date'); ?>
                </div>
                <div class="form-group clearf-x">
                    <label class="control-label">Number of views you want  <span class="asteriskField">*</span></label>
                    <select class="form-control <?php echo (form_error('views')) ? 'error' : ''; ?>" name="views"
                            id="views">
                        <option value="500">500</option>
                        <option value="1000">1000</option>
                        <option value="5000">5000</option>
                        <option value="10000">10000</option>
                        <option value="50000">50000</option>
                        <option value="100000">100000</option>
                    </select>
                    <?php echo form_error('views'); ?>
                </div><!-- form-group -->
                <div class="form-group clearfix">
                    <label class="control-label">Total Cost</label>
                    <div class="clearfix"></div>
                    <div class="col-sm-3 ad_form">
                        <input type="text" id="rate" name="rate" class="form-control"
                               value="<?php echo number_format($rates, 2, ',', '') . " €" ?>" disabled>

                    </div>
                </div><!-- form-group -->
                <div class="form-group text-center">
                    <button type="submit" class="places-submit btn btn-primary" onclick="pay_now();"> &nbsp; &nbsp; PAY NOW &nbsp;
                        &nbsp; </button>
                </div>
            </form>
        </div><!-- places_form_main -->
    </div><!-- container -->
</section>
<script type="text/javascript">
    var plans = <?php echo json_encode($plans); ?>;
    $(document).ready(function () {
        $("#plans_label").on("change", function (event) {
            var elem = $(this);
            var value = "";
            var rate = "";
            var periods = 1;
            var key = elem.val();
            if (elem.val() == "day") {
                for (var i = 1; i <= 7; i++) {
                    value += '<option value="' + i + '">' + i + '</option>';
                }
            } else if (elem.val() == "month") {
                value += ' <option value="1">1</option>' +
                    ' <option value="2">2</option>' +
                    ' <option value="3">3</option>' +
                    ' <option value="6">6</option>' +
                    ' <option value="12">12</option>';
            }

            if (periods && periods != "" && key && key != "") {
                $.each(plans, function (index, data) {
                    if (data.type == key) {
                        if (data.plans_day && data.plans_day == periods) {
                            rate = data.plans_rate;
                        } else if (data.plans_month && data.plans_month == periods) {
                            rate = data.plans_rate;
                        }
                    }
                });
                $("#rate").val(rate + " €");
            }

            $('#plans_day')
                .find('option')
                .remove()
                .end()
                .append(value)
                .trigger("chosen:updated");
        });
        $("#plans_day").on("change", function (event) {
            var elem = $(this);
            var __value = elem.val();
            var key = $("#plans_label").val();
            var rate = "";
            if (__value && __value != "" && key && key != "") {
                $.each(plans, function (index, value) {
                    if (value.type == key) {
                        if (value.plans_day && value.plans_day == __value) {
                            rate = value.plans_rate;
                        } else if (value.plans_month && value.plans_month == __value) {
                            rate = value.plans_rate;
                        }
                    }
                });
                $("#rate").val(rate + " €");
            }
        });

        $("#adviretisement-form").validate({
            rules:
                {
                    banner_image:{
                        required: true,
                    },
                    banner_link: {
                        required: true,
                    },
                    banner_size: {
                        required: true,
                    },
                    plans_duration_type: {
                        required: true,
                    },
                    plans_duration: {
                        required: true,
                    },
                    start_date: {
                        required: true,
                        date: true
                    },
                    views: {
                        required: true,
                    },
                },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "register_account_type") {
                    element.closest('.form-group').append(error);
                } else {
                    error.insertAfter(element);
                }
            },
            messages:
                {
                    banner_image: "Please upload valid banner image",
                    banner_link: "Please enter valid banner link",
                    banner_size: "Please select valid banner size.",
                    plans_duration_type: "Please select valid type.",
                    plans_duration:"Please select valid time duration.",
                    start_date: "Please select valid start date.",
                    views:"Please select valid advertisement view count.",
                },
            submitHandler: function(form) {
                if(!$("#banner_image").val()){
                    return false;
                }else{
                    form.submit();
                }
            }
        });
    });

    function pay_now() {
        if(!$("#banner_image").val()){
            var error = '<label id="banner_image-error" class="error" for="banner_image">Please upload valid banner image.</label>';
            $("#banner_image").after(error);
        }else{
            $("#banner_image-error").remove();
        }
        $("#adviretisement-form").submit();
    }


    /*----- For Dropzone Script ------ */
    var base_url = "<?php echo base_url(); ?>";
    Dropzone.autoDiscover = false;
    if ($('#banner_dropzone').length) {
        var myDropzone = new Dropzone("#banner_dropzone", {
            url: base_url + "ajax/banner_uploads",
            maxFiles: 1, //change limit as per your requirements
            dictRemoveFile: 'Remove',
            dictDefaultMessage: '<img id="custom_upload" src="<?php echo base_url('assets/images/fileupload.png') ?>" class="img-responsive">',
            addRemoveLinks: true,
            previewsContainer: '#preview-image',
            init: function() {
                this.on("success", function(file, response) {
                    response = JSON.parse(response);
                    if (!response.error) {
                        file.serverId = response.file_id;
                        file.filename = response.file_name;
                        $(file.previewElement).find('[data-dz-name]').html(response.file_name);
                        $("#banner_image").val(response.file_name);
                    } else if (!data.is_login) {
                        window.location.href = base_url;
                    }
                });
                this.on("removedfile", function(file) {
                    if (!file.serverId) {
                        return;
                    } // The file hasn't been uploaded
                    $.ajax({
                        url: base_url + "ajax/delete_files",
                        type: "post",
                        data: {
                            file_id: file.serverId
                        },
                        success: function(response) {
                            response = JSON.parse(response);
                            $("#banner_image").val('');
                        },
                    });
                });
            }
        });
    }
</script>