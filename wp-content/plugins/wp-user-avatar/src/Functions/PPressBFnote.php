<?php

use ProfilePress\Core\Classes\ExtensionManager;

if ( ! class_exists('\PPressBFnote')) {

    class PPressBFnote
    {
        public function __construct()
        {
            add_action('ppress_admin_notices', array($this, 'admin_notice'));
            add_action('network_admin_notices', array($this, 'admin_notice'));

            add_action('admin_init', array($this, 'dismiss_admin_notice'));
        }

        public function dismiss_admin_notice()
        {
            if ( ! isset($_GET['ppress-adaction']) || $_GET['ppress-adaction'] != 'ppressbfnote_dismiss_adnotice') {
                return;
            }

            $url = admin_url();
            update_option('ppressbfnote_dismiss_adnotice', 'true');

            wp_redirect($url);
            exit;
        }

        public function admin_notice()
        {
            global $pagenow;

            if ($pagenow != 'index.php' && strpos(ppress_var($_GET, 'page'), 'pp-') === false) return;

            if (ExtensionManager::is_premium()) return;

            if ( ! current_user_can('administrator')) return;

            $start = strtotime('november 24th, 2021');
            $end   = strtotime('december 1st, 2021');
            $now   = time();

            if ($now < $start || $now > $end) return;

            if (get_option('ppressbfnote_dismiss_adnotice', 'false') == 'true') {
                return;
            }

            $dismiss_url = esc_url_raw(
                add_query_arg(
                    array(
                        'ppress-adaction' => 'ppressbfnote_dismiss_adnotice'
                    ),
                    admin_url()
                )
            );
            $this->notice_css();

            $bf_url = 'https://profilepress.net/pricing/?utm_source=wp-admin&utm_medium=admin-notice&utm_id=bf2021'

            ?>
            <div class="ppressbfnote-admin-notice notice notice-success">
                <div class="ppressbfnote-notice-first-half">
                    <p>
                        <?php
                        printf(
                            __('%1$sHuge Black Friday Sale%2$s: Get 25%% off your ProfilePress plugin upgrade today with the coupon %3$sBFCM2021%4$s', 'peters-login-redirect'),
                            '<span class="ppressbfnote-stylize"><strong>', '</strong></span>', '<code>', '</code>');
                        ?>
                    </p>
                    <p style="text-decoration: underline;font-size: 12px;">Hurry as the deal is expiring soon.</p>

                </div>
                <div class="ppressbfnote-notice-other-half">
                    <a target="_blank" class="button button-primary button-hero" href="<?php echo $bf_url; ?>">
                        <?php _e('Save 25% Now!', 'peters-login-redirect'); ?>
                    </a>
                    <div class="ppressbfnote-notice-learn-more">
                        <a target="_blank" href="<?php echo $bf_url; ?>">Learn more</a>
                    </div>
                </div>
                <a href="<?php echo $dismiss_url; ?>">
                    <button type="button" class="notice-dismiss">
                        <span class="screen-reader-text"><?php _e('Dismiss this notice', 'peters-login-redirect'); ?>.</span>
                    </button>
                </a>
            </div>
            <?php
        }

        public function notice_css()
        {
            ?>
            <style type="text/css">
                .ppressbfnote-admin-notice {
                    background: #fff;
                    color: #000;
                    border-left-color: #46b450;
                    position: relative;
                }

                .ppressbfnote-admin-notice .notice-dismiss:before {
                    color: #72777c;
                }

                .ppressbfnote-admin-notice .ppressbfnote-stylize {
                    line-height: 2;
                }

                .ppressbfnote-admin-notice .button-primary {
                    background: #006799;
                    text-shadow: none;
                    border: 0;
                    box-shadow: none;
                }

                .ppressbfnote-notice-first-half {
                    width: 66%;
                    display: inline-block;
                    margin: 10px 0 20px;
                }

                .ppressbfnote-notice-other-half {
                    width: 33%;
                    display: inline-block;
                    padding: 20px 0;
                    position: absolute;
                    text-align: center;
                }

                .ppressbfnote-notice-first-half p {
                    font-size: 14px;
                }

                .ppressbfnote-notice-learn-more a {
                    margin: 10px;
                }

                .ppressbfnote-notice-learn-more {
                    margin-top: 10px;
                }
            </style>
            <?php
        }

        public static function instance()
        {
            static $instance = null;

            if (is_null($instance)) {
                $instance = new self();
            }

            return $instance;
        }
    }
}