<?php

namespace ProfilePress\Core\ContentProtection\Frontend;

class RestrictionShortcode
{
    public function __construct()
    {
        add_shortcode('pp-restrict-content', [$this, 'shortcode_handler']);
    }

    public function shortcode_handler($atts, $content = null)
    {
        $atts = shortcode_atts(array(
            'roles'  => '',
            'users'  => '',
            'action' => 'show' // value can be "show" or "hide"
        ), $atts);

        if ($atts['action'] == 'hide') {
            return $this->rule_matches($atts['roles'], $atts['users']) ? '' : \do_shortcode($content);
        } else {
            return $this->rule_matches($atts['roles'], $atts['users']) ? \do_shortcode($content) : '';
        }
    }

    public function rule_matches($roles = [], $user_ids = [])
    {
        if (is_user_logged_in()) {

            if ( ! empty($roles)) {

                $roles = array_map('sanitize_text_field', explode(',', $roles));

                $user_roles = wp_get_current_user()->roles;

                if ( ! empty(array_intersect($roles, $user_roles))) return true;
            }

            if ( ! empty($user_ids)) {

                $user_ids = array_map('sanitize_text_field', explode(',', $user_ids));

                foreach ($user_ids as $user_id) {

                    if (is_numeric($user_id) && get_current_user_id() == absint($user_id)) {
                        return true;
                    } else {
                        $user = get_user_by('login', $user_id);
                        if ( ! $user) {
                            $user = get_user_by('email', $user_id);
                        }

                        if ($user instanceof \WP_User && get_current_user_id() == absint($user->ID)) {
                            return true;
                        }
                    }
                }
            }
        }

        return false;
    }

    public static function get_instance()
    {
        static $instance = null;

        if (is_null($instance)) {
            $instance = new self();
        }

        return $instance;
    }
}