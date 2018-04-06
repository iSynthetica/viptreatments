<?php

?>

<form class="get-free-book-form" method="post" action="">
    <?php wp_nonce_field(basename( __FILE__ ), 'snth_woo_service'); ?>

    <div class="form-group">
        <span class="form-control-wrap your_name">
            <input type="text" placeholder="Enter your name (*)" aria-invalid="false" aria-required="true" id="your_name" class="form-control form-text" value="" name="client_name" required>
        </span>
    </div>

    <div class="form-group">
        <span class="form-control-wrap your_email">
            <input type="email" placeholder="Enter your email (*)" aria-invalid="false" aria-required="true" id="your_email" class="form-control form-text" value="" name="client_email" required>
        </span>
    </div>

    <div style="opacity: 0;height: 15px;" class="separator  normal   "></div>

    <div class="form-group">
        <input type="submit" class="wpcf7-form-control wpcf7-submit" value="Send">
    </div>
    <div class="wpcf7-response-output wpcf7-display-none"></div>
</form>