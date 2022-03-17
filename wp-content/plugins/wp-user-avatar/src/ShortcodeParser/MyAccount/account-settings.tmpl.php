<?php

use ProfilePress\Core\Classes\PROFILEPRESS_sql;
use ProfilePress\Core\ShortcodeParser\MyAccount\MyAccountTag;

if ( ! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$current_user = get_user_by('id', get_current_user_id());

do_action('ppress_myaccount_account_settings_before_main_content');

?>
    <div class="profilepress-myaccount-notification">

        <h2><?= esc_html__('Account Settings', 'wp-user-avatar') ?></h2>

        <?php

        do_action('ppress_myaccount_account_settings_after_heading');

        $contents = MyAccountTag::account_settings_endpoint_content();

        if ( ! empty($contents)) {

            foreach ($contents as $content) {
                ?>
                <div class="profilepress-myaccount-account-settings-wrap">

                    <h3><?= $content['title']; ?></h3>

                    <div class="profilepress-myaccount-form-wrap">
                        <?= $content['content']; ?>
                    </div>

                </div>
                <?php
            }
        }
        ?>
    </div>
<?php

do_action('ppress_myaccount_account_settings_after_main_content');