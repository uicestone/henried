<?php

namespace ProfilePress\Core\Admin\SettingsPages;

use ProfilePress\Core\Classes\ExtensionManager;
use ProfilePress\Custom_Settings_Page_Api;

if ( ! defined('ABSPATH')) {
    exit;
}

abstract class AbstractSettingsPage
{
    protected $option_name;

    public static $parent_menu_url_map = [];

    private function getMenuIcon()
    {
        return 'data:image/svg+xml;base64,' . base64_encode('<?xml version="1.0" encoding="UTF-8"?><!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd"><svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 11.71 11.71"  shape-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" xmlns:v="https://vecta.io/nano"><path d="M5.85.2c3.13 0 5.66 2.53 5.66 5.65 0 3.13-2.53 5.66-5.66 5.66C2.73 11.51.2 8.98.2 5.85A5.65 5.65 0 0 1 5.85.2zM3.17 5.66l2.98-2.98c.24-.24.62-.24.86 0L8.53 4.2c.24.24.24.63 0 .87L6.12 7.48l.53.54a.64.64 0 0 1 0 .92l-.07.07a.64.64 0 0 1-.92 0l-.54-.53L3.44 6.8l-.27-.28c-.24-.23-.24-.62 0-.86zm3.21-1.22L4.93 5.89c-.12.11-.12.29 0 .4.11.11.28.11.39 0l1.46-1.45c.11-.11.11-.29 0-.4h0c-.11-.11-.29-.11-.4 0zM4.93 6.29h0z" fill="#a6aaad"/></svg>');
    }

    public function register_core_menu()
    {
        add_menu_page(
            esc_html__('ProfilePress - WordPress User Registration & Profile Plugin', 'wp-user-avatar'),
            'ProfilePress',
            'manage_options',
            PPRESS_SETTINGS_SLUG,
            '',
            $this->getMenuIcon(),
            '80.0015'
        );

        do_action('ppress_register_menu_page_' . $this->active_menu_tab() . '_' . $this->active_submenu_tab());

        do_action('ppress_register_menu_page');
    }

    /** --------------------------------------------------------------- */

    // commented out to prevent any fatal error
    //abstract function default_header_menu();

    public function header_menu_tabs()
    {
        return [];
    }

    public function header_submenu_tabs()
    {
        return [];
    }

    public function settings_page_header($active_menu, $active_submenu)
    {
        $logo_url       = PPRESS_ASSETS_URL . '/images/profilepress-logo.svg';
        $submenus_count = count($this->header_menu_tabs());
        ?>
        <div class="ppress-admin-wrap">
            <div class="ppress-admin-banner<?= ExtensionManager::is_premium() ? ' ppress-pro' : ' ppress-not-pro' ?><?= $submenus_count < 2 ? ' ppress-no-submenu' : '' ?>">
                <div class="ppress-admin-banner__logo">
                    <img src="<?= $logo_url ?>" alt="">
                </div>
                <div class="ppress-admin-banner__helplinks">
                <span><a rel="noopener" href="https://wordpress.org/support/plugin/wp-user-avatar/reviews/?filter=5#new-post" target="_blank">
                    <span class="dashicons dashicons-star-filled"></span> <?= __('Review', 'wp-user-avatar'); ?>
                </a></span>
                    <?php if (ExtensionManager::is_premium()) : ?>
                        <span><a rel="noopener" href="https://profilepress.net/submit-ticket/" target="_blank">
                        <span class="dashicons dashicons-admin-users"></span> <?= __('Support', 'wp-user-avatar'); ?>
                    </a></span>
                    <?php else : ?>
                        <span><a class="ppress-active" rel="noopener" href="https://profilepress.net/pricing/?utm_source=wp_dashboard&utm_medium=upgrade&utm_campaign=ppress_header_topright_menu" target="_blank">
                        <span class="dashicons dashicons-info"></span> <?= __('Pro Upgrade', 'wp-user-avatar'); ?>
                    </a></span>
                    <?php endif; ?>
                    <span><a rel="noopener" href="https://profilepress.net/docs/" target="_blank">
                    <span class="dashicons dashicons-book"></span> <?= __('Docs', 'wp-user-avatar'); ?>
                </a></span>
                </div>
                <div class="clear"></div>
                <?php $this->settings_page_header_menus($active_menu); ?>
            </div>
            <?php

            $submenus = $this->header_submenu_tabs();

            if ( ! empty($submenus) && count($submenus) > 1) {
                $this->settings_page_header_sub_menus($active_menu, $active_submenu);
            }

            ?>
        </div>
        <?php
    }

    public function settings_page_header_menus($active_menu)
    {
        $menus = $this->header_menu_tabs();

        if (count($menus) < 2) return;
        ?>
        <div class="ppress-header-menus">
            <nav class="ppress-nav-tab-wrapper nav-tab-wrapper">
                <?php foreach ($menus as $menu) : ?>
                    <?php
                    $id                             = sanitize_text_field(ppress_var($menu, 'id', ''));
                    $url                            = esc_url_raw(! empty($menu['url']) ? $menu['url'] : add_query_arg('view', $id));
                    self::$parent_menu_url_map[$id] = $url;
                    ?>
                    <a href="<?php echo esc_url(remove_query_arg(wp_removable_query_args(), $url)); ?>" class="ppress-nav-tab nav-tab<?= $id == $active_menu ? ' ppress-nav-active' : '' ?>">
                        <?php echo sanitize_text_field($menu['label']) ?>
                    </a>
                <?php endforeach; ?>
            </nav>
        </div>
        <?php
    }

    public function settings_page_header_sub_menus($active_menu, $active_submenu)
    {
        $submenus = $this->header_submenu_tabs();

        if (count($submenus) < 2) return;

        $active_menu_url = self::$parent_menu_url_map[$active_menu];

        $submenus = wp_list_filter($submenus, ['parent' => $active_menu]);

        echo '<ul class="subsubsub">';

        foreach ($submenus as $submenu) {

            printf(
                '<li><a href="%s"%s>%s</a></li>',
                esc_url(add_query_arg('section', $submenu['id'], $active_menu_url)),
                $active_submenu == $submenu['id'] ? ' class="ppress-current"' : '',
                $submenu['label']
            );
        }
        echo '</ul>';
    }

    public function active_menu_tab()
    {
        static $cache = null;

        if (is_null($cache) && strpos(ppressGET_var('page'), 'pp') !== false) {
            $cache = isset($_GET['view']) ? sanitize_text_field($_GET['view']) : $this->default_header_menu();
        }

        return $cache;
    }

    public function active_submenu_tab()
    {
        static $cache = null;

        if (is_null($cache) && strpos(ppressGET_var('page'), 'pp') !== false) {

            $active_menu = $this->active_menu_tab();

            $submenu_tabs      = wp_list_filter($this->header_submenu_tabs(), ['parent' => $active_menu]);
            $first_submenu_tab = '';
            if ( ! empty($submenu_tabs)) {
                $first_submenu_tab = array_values($submenu_tabs)[0]['id'];
            }

            $cache = isset($_GET['section']) && ppressGET_var('view', 'general', true) == $active_menu ? sanitize_text_field($_GET['section']) : $first_submenu_tab;
        }

        return $cache;
    }

    public function admin_page_callback()
    {
        $active_menu = $this->active_menu_tab();

        $active_submenu = $this->active_submenu_tab();

        $this->settings_page_header($active_menu, $active_submenu);

        do_action('ppress_admin_settings_page_' . $active_menu);

        do_action('ppress_admin_settings_submenu_page_' . $active_menu . '_' . $active_submenu);
    }
    /** --------------------------------------------------------------- */

    /**
     * Register core settings.
     *
     * @param Custom_Settings_Page_Api $instance
     * @param bool $remove_sidebar
     */
    public static function register_core_settings(Custom_Settings_Page_Api $instance, $remove_sidebar = false)
    {
        if ( ! $remove_sidebar) {
            $instance->sidebar(self::sidebar_args());
        }
    }

    public static function sidebar_args()
    {
        $sidebar_args = [
            [
                'section_title' => esc_html__('Need Support?', 'wp-user-avatar'),
                'content'       => self::sidebar_support_docs(),
            ],
            [
                'section_title' => esc_html__('Check out MailOptin', 'wp-user-avatar'),
                'content'       => self::mailoptin_ad_block(),
            ]
        ];

        if (defined('MAILOPTIN_DETACH_LIBSODIUM')) {
            unset($sidebar_args[1]);
        }

        return $sidebar_args;
    }

    public static function sidebar_support_docs()
    {
        $link_icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="linkIcon"><path d="M18.2 17c0 .7-.6 1.2-1.2 1.2H7c-.7 0-1.2-.6-1.2-1.2V7c0-.7.6-1.2 1.2-1.2h3.2V4.2H7C5.5 4.2 4.2 5.5 4.2 7v10c0 1.5 1.2 2.8 2.8 2.8h10c1.5 0 2.8-1.2 2.8-2.8v-3.6h-1.5V17zM14.9 3v1.5h3.7l-6.4 6.4 1.1 1.1 6.4-6.4v3.7h1.5V3h-6.3z"></path></svg>';

        $content = '<p>';

        $support_url = 'https://wordpress.org/support/plugin/wp-user-avatar/';

        if (ExtensionManager::is_premium()) {
            $support_url = 'https://profilepress.net/submit-ticket/';
        }

        $content .= sprintf(
            esc_html__('Whether you need help or have a new feature request, let us know. %sRequest Support%s', 'wp-user-avatar'),
            '<a class="ppress-link" href="' . $support_url . '" target="_blank">', $link_icon . '</a>'
        );

        $content .= '</p>';

        $content .= '<p>';
        $content .= sprintf(
            esc_html__('Detailed documentation is also available on the plugin website. %sView Knowledge Base%s', 'wp-user-avatar'),
            '<a class="ppress-link" href="https://profilepress.net/docs/" target="_blank">', $link_icon . '</a>'
        );

        $content .= '</p>';

        $content .= '<p>';
        $content .= sprintf(
            esc_html__('If you are enjoying ProfilePress and find it useful, please consider leaving a ★★★★★ review on WordPress.org. %sLeave a Review%s', 'wp-user-avatar'),
            '<a class="ppress-link" href="https://wordpress.org/support/plugin/wp-user-avatar/reviews/?filter=5#new-post" target="_blank">', $link_icon . '</a>'
        );
        $content .= '</p>';

        return $content;
    }

    public static function mailoptin_ad_block()
    {
        $content = '<p>';
        $content .= sprintf(
            esc_html__('Use the coupon code %s10PERCENTOFF%s to save %s off MailOptin.', 'wp-user-avatar'),
            '<code>', '</code>', '10%'
        );

        $content .= '</p>';

        $content .= '<a href="https://mailoptin.io/?utm_source=wp_dashboard&utm_medium=profilepress-admin-sidebar&utm_campaign=mailoptin" target="_blank"><img style="width: 100%" src="' . PPRESS_ASSETS_URL . '/images/admin/mo-pro-upgrade.jpg"></a>';

        return $content;
    }

    protected function page_dropdown($id, $appends = [], $args = ['skip_append_default_select' => false])
    {
        $default_args = [
            'name'             => PPRESS_SETTINGS_DB_OPTION_NAME . "[$id]",
            'show_option_none' => esc_html__('Select...', 'wp-user-avatar'),
            'selected'         => ppress_get_setting($id, ''),
            'echo'             => false
        ];

        if ( ! empty($appends)) {
            unset($default_args['show_option_none']);
        }

        $html = wp_dropdown_pages(
            array_replace($default_args, $args)
        );

        if ( ! empty($appends)) {
            $addition = '';

            if (ppress_var($args, 'skip_append_default_select') === false) {
                $addition .= '<option value="">' . esc_html__('Select...', 'wp-user-avatar') . '</option>';
            }

            foreach ($appends as $append) {
                $key           = $append['key'];
                $label         = $append['label'];
                $disabled_attr = ppress_var($append, 'disabled') === true ? ' disabled' : '';
                $addition      .= "<option value=\"$key\"" . selected(ppress_get_setting($id), $key, false) . $disabled_attr . '>' . $label . '</option>';
            }

            $html = ppress_append_option_to_select($addition, $html);
        }

        return $html;
    }

    protected function custom_text_input($id, $placeholder = '')
    {
        $placeholder = ! empty($placeholder) ? $placeholder : esc_html__('Custom URL Here', 'wp-user-avatar');
        $value       = ppress_get_setting($id, '');

        return "<input placeholder=\"$placeholder\" name=\"" . PPRESS_SETTINGS_DB_OPTION_NAME . "[$id]\" type=\"text\" class=\"regular-text code\" value=\"$value\">";
    }
}