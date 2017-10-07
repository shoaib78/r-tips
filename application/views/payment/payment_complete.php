<section class="welcome_classic">
    <div class="container">
        <div class="classic_inner">
            <h1>ADVERTISEMENT PAYMENT STATUS</h1>
            <div class="search_holiday_wrap">
            </div>

        </div>
    </div>
</section>

<section class="adverise_sec">
    <div class="container">
        <div class="col-sm-8 places_form_main">
            <?php
            $success = $this->session->flashdata('payment_success');
            $error = $this->session->flashdata('payment_error');
            ?>
            <?php if (!empty($success)) {
                echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><b>' . $success . '</b></div>';
            } ?>
            <?php if (!empty($error)) {
                echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><b>' . $error . '</b></div>';
            } ?>
        </div><!-- places_form_main -->
    </div><!-- container -->
</section>