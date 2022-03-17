<?php

namespace ProfilePress\Core\Admin\SettingsPages\DragDropBuilder\Controls;


class Textarea
{
    public $args;

    public function __construct($args)
    {
        $this->args = wp_parse_args(
            $args,
            ['name' => '', 'value' => sprintf('{{{data.%s}}}', esc_attr($args['name']))]
        );
    }

    public function render()
    {
        echo sprintf('<label for="%s" class="pp-label">%s</label>', esc_attr($this->args['name']), esc_attr($this->args['label']));

        if (isset($this->args['description'])) {
            printf('<div class="pp-form-control-description">%s</div>', wp_kses_post($this->args['description']));
        }

        echo sprintf(
            '<textarea placeholder="%3$s" id="%1$s" name="%1$s" class="pp-form-control">%2$s</textarea>',
            esc_attr($this->args['name']),
            $this->args['value'],
            esc_attr(ppress_var($this->args, 'placeholder'))
        );
    }
}