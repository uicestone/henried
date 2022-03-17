<?php

namespace ProfilePress\Core\Classes;

/**
 * Alter default login, registration, password_reset login and logout url
 */
class ModifyRedirectDefaultLinks
{
    public function __construct()
    {
        add_action('login_form_lostpassword', array($this, 'redirect_password_reset_page'));
        add_filter('lostpassword_url', array($this, 'lost_password_url_func'), 999999999);

        add_action('login_form_login', array($this, 'redirect_login_page'));
        add_filter('login_url', array($this, 'set_login_url_func'), 999999999, 3);

        add_action('login_form_register', array($this, 'redirect_reg_page'));
        add_filter('register_url', array($this, 'register_url_func'), 999999999);

        add_filter('logout_url', array($this, 'logout_url_func'), 999999999, 2);

        add_filter('author_link', array($this, 'author_link_func'), 999999999, 2);

        add_filter('get_comment_author_url', array($this, 'comment_author_url_to_profile'), 999999999, 3);

        add_action('init', array($this, 'redirect_default_edit_profile_to_custom'));

        // redirect buddypress registration to PP custom registration page or default WP registration url if not set
        add_action('template_redirect', array($this, 'redirect_bp_registration_page'));
        add_filter('bp_get_signup_page', array($this, 'rewrite_bp_registration_url'));

        // redirect default logout page to blog homepage
        add_action('init', array($this, 'redirect_logout_page'));

        add_action('template_redirect', [$this, 'redirect_author_page']);
    }

    public function is_third_party_2fa_active()
    {
        global $pagenow;

        if ('wp-login.php' == $pagenow) {

            if (class_exists('Jetpack') && \Jetpack::is_module_active('sso')) {
                return true;
            }

            if (function_exists('wd_di') && class_exists('\WP_Defender\Model\Setting\Two_Fa')) {
                try {
                    if (wd_di()->get(\WP_Defender\Model\Setting\Two_Fa::class)->enabled) return true;
                } catch (\Exception $e) {
                }
            }

            if (defined('WORDFENCE_VERSION') || defined('WORDFENCE_LS_VERSION')) {
                return true;
            }

            if (defined('WP_2FA_VERSION')) return true;

            if (defined('SIMBA_TFA_PLUGIN_DIR')) return true;

            if (class_exists('\SG_Security\Options_Service\Options_Service') && \SG_Security\Options_Service\Options_Service::is_enabled('sg2fa')) {
                return true;
            }
        }

        return false;
    }

    /**
     * Modify the lost password url returned by wp_lostpassword_url() function.
     *
     * @param $val
     *
     * @return string
     */
    public function lost_password_url_func($val)
    {
        $page_id = ppress_get_setting('set_lost_password_url');

        if ( ! empty($page_id) && 'publish' == get_post_status($page_id)) {
            $val = get_permalink($page_id);
        }

        return apply_filters('ppress_password_reset_url', $val);
    }

    /**
     * Force redirection of default password reset to the page with custom one.
     */
    public function redirect_password_reset_page()
    {
        if ( ! apply_filters('ppress_default_password_reset_redirect_enabled', true)) return;

        $page_id = ppress_get_setting('set_lost_password_url');

        if (empty($page_id) || 'publish' != get_post_status($page_id)) return;

        wp_safe_redirect(get_permalink(absint($page_id)));
        exit;
    }

    /**
     * Modify the login url returned by wp_login_url()
     *
     * @param $url
     * @param string $redirect
     * @param bool $force_reauth
     *
     * @return string page with login shortcode
     */
    public function set_login_url_func($url, $redirect = '', $force_reauth = false)
    {
        if ( ! $this->is_third_party_2fa_active()) {
            $login_page_id = ppress_get_setting('set_login_url');

            if ( ! empty($login_page_id) && 'publish' == get_post_status($login_page_id)) {

                $url = get_permalink($login_page_id);

                if ( ! empty($redirect)) {
                    $url = add_query_arg('redirect_to', rawurlencode(wp_validate_redirect($redirect)), $url);
                }

                if ($force_reauth) {
                    $url = add_query_arg('reauth', '1', $url);
                }

                $url = esc_url_raw($url);
            }
        }

        return apply_filters('ppress_login_url', $url, $redirect, $force_reauth);
    }

    /**
     * Force redirect default login to page with login shortcode
     */
    public function redirect_login_page()
    {
        if ( ! apply_filters('ppress_default_login_redirect_enabled', true)) return;

        if ($this->is_third_party_2fa_active()) return;

        $login_page_id = ppress_get_setting('set_login_url');

        if (empty($login_page_id) || ('publish' != get_post_status($login_page_id))) return;

        $login_url = ppress_login_url();

        // retrieve the query string if available.
        $query_string = ! empty($_SERVER["QUERY_STRING"]) ? $_SERVER["QUERY_STRING"] : parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);

        // if query string is available, append to login url.
        if ( ! empty($query_string)) {
            if (strpos($login_url, '?') !== false) {
                $login_url .= "&$query_string";
            } else {
                $login_url .= "?$query_string";
            }
        }

        wp_safe_redirect(esc_url_raw($login_url));
        exit;
    }

    /**
     * Modify the url returned by wp_registration_url().
     *
     * @return string page url with registration shortcode.
     */
    public function register_url_func($val)
    {
        $page_id = ppress_get_setting('set_registration_url');

        if ( ! empty($page_id) && 'publish' == get_post_status($page_id)) {
            $val = get_permalink($page_id);
        }

        return apply_filters('ppress_registration_url', $val);
    }

    /**
     * force redirection of default registration to custom one
     */
    public function redirect_reg_page()
    {
        if ( ! apply_filters('ppress_default_registration_redirect_enabled', true)) return;

        $page_id = ppress_get_setting('set_registration_url');

        if (empty($page_id) || 'publish' != get_post_status($page_id)) return;

        $reg_url = ppress_registration_url();

        wp_safe_redirect(esc_url_raw($reg_url));
        exit;
    }

    /**
     * Add query string (url) to logout url which is url to redirect to after logout
     *
     * @param $logout_url string filter default login url to be modified
     * @param $redirect string where to redirect to after logout
     *
     * @return string
     */
    public function logout_url_func($logout_url, $redirect)
    {
        $set_redirect = false;

        $custom_logout_page_url = ppress_get_setting('custom_url_log_out');
        $logout_page_id         = ppress_get_setting('set_log_out_url');

        if ( ! empty($custom_logout_page_url)) {
            $set_redirect = $custom_logout_page_url;
        } elseif ( ! empty($logout_page_id)) {

            if ($logout_page_id != 'default') {

                $db_logout_url = get_permalink(absint($logout_page_id));

                $set_redirect = $db_logout_url;

                if (empty($db_logout_url) || $logout_page_id == 'current_view_page') {
                    // make redirect currently viewed page
                    $set_redirect = get_permalink();
                }
            }
        }

        if ($set_redirect) {
            $set_redirect = apply_filters('ppress_logout_redirect', $set_redirect);
            $logout_url   = esc_url_raw(add_query_arg('redirect_to', rawurlencode($set_redirect), $logout_url));
        }

        return $logout_url;
    }

    /**
     * Redirect user edit profile (/wp-admin/profile.php) to "custom edit profile" page.
     */
    public function redirect_default_edit_profile_to_custom()
    {
        if (ppress_settings_by_key('redirect_default_edit_profile_to_custom') == 'yes') {

            add_filter('edit_profile_url', function ($url) {
                $page_id = ppress_settings_by_key('edit_user_profile_url');

                if ( ! empty($page_id)) {
                    $url = esc_url_raw(get_permalink($page_id));
                }

                return $url;

            }, 9999999999);

            // Filter to disable edit profile redirect for administrator.
            $disable = apply_filters('ppress_disable_admin_edit_profile_redirect', false);

            if ($disable && current_user_can('delete_users')) return;

            if ( ! empty(ppress_get_setting('edit_user_profile_url'))) {

                $edit_user_profile_url = ppress_edit_profile_url();

                $page_viewed = esc_url_raw($_SERVER['REQUEST_URI']);

                if (isset($page_viewed) && strpos($page_viewed, 'wp-admin/profile.php') !== false) {
                    wp_safe_redirect(esc_url_raw($edit_user_profile_url));
                    exit;
                }
            }
        }
    }

    public function author_link_func($url, $author_id)
    {
        if (ppress_settings_by_key('author_slug_to_profile') == 'on') {
            $url = esc_url_raw(ppress_get_frontend_profile_url($author_id));
        }

        return $url;
    }

    /**
     * @param $url
     * @param int $id comment ID
     * @param \WP_Comment $comment
     *
     * @return string|void
     */
    public function comment_author_url_to_profile($url, $id, $comment)
    {
        if (ppress_settings_by_key('comment_author_url_to_profile') == 'on') {
            if (is_object($comment) && isset($comment->comment_author_email)) {
                $email = $comment->comment_author_email;
                $user  = get_user_by('email', $email);
                if (isset($user->user_login)) {
                    $url = esc_url_raw(ppress_get_frontend_profile_url($user->user_login));
                }
            }
        }

        return $url;
    }

    /**
     * Redirect the default logout page (/wp-login.php?loggedout=true) to blog homepage
     */
    public function redirect_logout_page()
    {
        $page_viewed = basename(esc_url_raw($_SERVER['REQUEST_URI']));

        if ($page_viewed == "wp-login.php?loggedout=true" && $_SERVER['REQUEST_METHOD'] == 'GET') {
            wp_safe_redirect(home_url());
            exit;
        }
    }

    public function redirect_bp_registration_page()
    {
        if ( ! class_exists('BuddyPress') && ! function_exists('bp_has_custom_signup_page')) {
            return;
        }

        if ( ! bp_has_custom_signup_page()) return;

        if (ppress_get_setting('redirect_bp_registration_page') == 'yes') {
            // ! bp_has_custom_signup_page()
            $page = bp_get_root_domain() . '/' . bp_get_signup_slug();

            if ($page == ppress_get_current_url()) {
                wp_safe_redirect(ppress_registration_url());
                exit;
            }
        }
    }

    /**
     * Rewrite buddypress registration url to PP custom url or WP's if not set.
     *
     * @param string $page
     *
     * @return string
     */
    public function rewrite_bp_registration_url($page)
    {
        if (ppress_get_setting('redirect_bp_registration_page') == 'yes') {

            if (apply_filters('ppress_bp_registration_url', true)) {
                $page = ppress_registration_url();
            }
        }

        return $page;
    }

    /**
     * Redirect author page to user's profile
     */
    public function redirect_author_page()
    {
        if (ppress_settings_by_key('author_slug_to_profile') == 'on' && is_author()) {
            $id = get_query_var('author');
            wp_redirect(ppress_get_frontend_profile_url($id));
            exit;
        }
    }

    public static function get_instance()
    {
        static $instance = false;

        if ( ! $instance) {
            $instance = new self;
        }

        return $instance;
    }
}