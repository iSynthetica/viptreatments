<?php
/**
 * Vendor Registration Form Template
 *
 * @version 2.0.0
 */

$settings = BA_Settings()->get_settings();

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>

<?php
if ($settings['register_form_display_title']) {
    ?>
    <h2><?php esc_html_e( 'Vendor Registration Form', 'kloe' ); ?></h2>
    <?php
}
?>

<?php
if ($settings['register_form_display_before_form_text']) {
    ?>
    <p><?php esc_html_e( 'Submit the form below to become a vendor on this store.', 'kloe' ); ?></p>
    <?php
}
?>

<form class="wcpv-shortcode-registration-form">

    <?php do_action( 'wcpv_registration_form_start' ); ?>

    <?php if ( ! is_user_logged_in() ) { ?>
        <p class="form-row form-row-first">
            <?php
            if($settings['register_form_display_labels']) {
                ?>
                <label for="wcpv-firstname"><?php esc_html_e( 'First Name', 'kloe' ); ?> <span class="required">*</span></label>
                <?php
            }
            ?>
            <input type="text" class="input-text" name="firstname" id="wcpv-firstname" value="<?php if ( ! empty( $_POST['firstname'] ) ) echo esc_attr( trim( $_POST['firstname'] ) ); ?>" tabindex="1" placeholder="<?php echo (!$settings['register_form_display_labels']) ?  __('First Name *', 'kloe') : '' ?>" />
        </p>

        <p class="form-row form-row-last">
            <?php
            if($settings['register_form_display_labels']) {
                ?>
                <label for="wcpv-lastname"><?php esc_html_e( 'Last Name', 'kloe' ); ?> <span class="required">*</span></label>
                <?php
            }
            ?>
            <input type="text" class="input-text" name="lastname" id="wcpv-lastname" value="<?php if ( ! empty( $_POST['lastname'] ) ) echo esc_attr( trim( $_POST['lastname'] ) ); ?>" tabindex="2" placeholder="<?php echo (!$settings['register_form_display_labels']) ?  __('Last Name *', 'kloe') : '' ?>" />
        </p>

        <div class="clear"></div>

        <p class="form-row form-row-wide">
            <?php
            if($settings['register_form_display_labels']) {
                ?>
                <label for="wcpv-username"><?php esc_html_e( 'Login Username', 'kloe' ); ?> <span class="required">*</span></label>
                <?php
            }
            ?>
            <input type="text" class="input-text" name="username" id="wcpv-username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( trim( $_POST['username'] ) ); ?>" tabindex="3" placeholder="<?php echo (!$settings['register_form_display_labels']) ?  __('Login Username *', 'kloe') : '' ?>" />
        </p>

        <p class="form-row form-row-first">
            <?php
            if($settings['register_form_display_labels']) {
                ?>
                <label for="wcpv-email"><?php esc_html_e( 'Email', 'kloe' ); ?> <span class="required">*</span></label>
                <?php
            }
            ?>
            <input type="email" class="input-text" name="email" id="wcpv-email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( trim( $_POST['email'] ) ); ?>" tabindex="4" placeholder="<?php echo (!$settings['register_form_display_labels']) ?  __('Email *', 'kloe') : '' ?>" />
        </p>

        <p class="form-row form-row-last">
            <?php
            if($settings['register_form_display_labels']) {
                ?>
                <label for="wcpv-confirm-email"><?php esc_html_e( 'Confirm Email', 'kloe' ); ?> <span class="required">*</span></label>
                <?php
            }
            ?>
            <input type="email" class="input-text" name="confirm_email" id="wcpv-confirm-email" value="<?php if ( ! empty( $_POST['confirm_email'] ) ) echo esc_attr( trim( $_POST['confirm_email'] ) ); ?>" tabindex="5" placeholder="<?php echo (!$settings['register_form_display_labels']) ?  __('Confirm Email *', 'kloe') : '' ?>" />
        </p>

    <?php } ?>

    <div class="clear"></div>

    <p class="form-row form-row-first">
        <?php
        if($settings['register_form_display_labels']) {
            ?>
            <label for="wcpv-vendor-vendor-name"><?php esc_html_e( 'Vendor Name', 'kloe' ); ?> <span class="required">*</span></label>
            <?php
        }
        ?>
        <input class="input-text" type="text" name="vendor_name" id="wcpv-vendor-name" value="<?php if ( ! empty( $_POST['vendor_name'] ) ) echo esc_attr( trim( $_POST['vendor_name'] ) ); ?>" tabindex="6" placeholder="<?php echo (!$settings['register_form_display_labels']) ?  __('Vendor Name *', 'kloe') : '' ?>" />
        <em class="wcpv-field-note"><?php esc_html_e( 'Important: This is the name that customers see when purchasing your products.  Please choose carefully.', 'kloe' ); ?></em>
    </p>

    <p class="form-row form-row-last">
        <?php
        if($settings['register_form_display_labels']) {
            ?>
            <label for="wcpv-phone"><?php esc_html_e('Phone', 'kloe'); ?> <span class="required">*</span></label>
            <?php
        }
        ?>
        <input type="tel" class="input-text" name="vendor-phone" id="wcpv-phone" value="<?php if ( ! empty( $_POST['vendor-phone'] ) ) echo esc_attr( trim( $_POST['vendor-phone'] ) ); ?>" tabindex="4" placeholder="<?php echo (!$settings['register_form_display_labels']) ?  __('Phone *', 'kloe') : '' ?>" />
    </p>

    <div class="clear"></div>

    <p class="form-row form-row-wide">
        <?php
        if($settings['register_form_display_labels']) {
            ?>
            <label for="wcpv-vendor-description"><?php esc_html_e( 'Please describe something about your company and what you sell.', 'kloe' ); ?> <span class="required">*</span></label>
            <?php
        }
        ?>
        <textarea class="input-text" name="vendor_description" id="wcpv-vendor-description" rows="4" tabindex="7" placeholder="<?php echo (!$settings['register_form_display_labels']) ?  __('Please describe something about your company and what you sell *', 'kloe') : '' ?>"><?php if ( ! empty( $_POST['vendor_description'] ) ) echo trim( $_POST['vendor_description'] ); ?></textarea>
    </p>

    <?php do_action( 'wcpv_registration_form' ); ?>

    <p class="form-row">
        <input type="submit" class="button qodef-btn qodef-btn-large qodef-btn-solid" name="register" value="<?php esc_attr_e( 'Register', 'kloe' ); ?>" tabindex="8" />
    </p>

    <?php do_action( 'wcpv_registration_form_end' ); ?>

</form>
