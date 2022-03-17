<div class="ppress-content-restriction-shortcode-doc">
    <p>
        <?php
        printf(
            esc_html__('To restrict contents in a post or page, we provide the below shortcode. %sLearn more%s', 'wp-user-avatar'),
            '<a target="_blank" href="https://profilepress.net/article/wordpress-content-restriction-shortcodes/">', '</a>'
        ); ?>
    </p>
    <div style="padding:5px;margin: 0 1px;background: #f0f0f1;background: rgba(0,0,0,.07);">
        [pp-restrict-content ...]
        <br><?php esc_html_e('Content to restrict will go here', 'wp-user-avatar') ?><br>
        [/pp-restrict-content]
    </div>
</div>