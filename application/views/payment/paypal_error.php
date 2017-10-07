<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<section class="welcome_classic">
    <div class="container">
        <div class="classic_inner">
            <h1>ADVERTISEMENT PAYMENT STATUS- PAYPAL ERROR</h1>
            <div class="search_holiday_wrap">
            </div>

        </div>
    </div>
</section>

<section class="adverise_sec">
    <div class="container">
        <div class="row clearfix">
            <div class="col-sm-8 places_form_main column">
                <div id="header" class="row clearfix">
                    <div class="col-md-6 column">
                        <div id="logo">
                            <a href="<?php echo base_url('home/advertisement');?>"><img class="img-responsive" alt="Tips and Go" src="<?php echo base_url("assets/images/logo.png") ?>"></a>
                        </div>
                    </div>
                </div>
                <h2 align="center">PayPal Error</h2>
                <div class="alert alert-info">
                    <p>Here we display PayPal errors.</p>
                </div>
                <div class="alert alert-danger well" id="paypal_errors">
                    <?php
                    foreach($errors as $error)
                    {
                        echo '<p>';
                        echo '<strong>Error Code:</strong> ' . $error[0]['L_ERRORCODE'];
                        echo '<br /><strong>Error Message:</strong> ' . $error[0]['L_LONGMESSAGE'];
                        echo '</p>';
                    }
                    ?>
                </div>
                <a class="btn btn-primary" href="<?php echo base_url('home/advertisement');?>">Payment Start Again</a>
            </div>
        </div>
    </div>
</section>