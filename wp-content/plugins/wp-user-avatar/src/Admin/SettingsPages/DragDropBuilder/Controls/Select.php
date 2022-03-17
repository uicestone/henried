<?php

namespace ProfilePress\Core\Admin\SettingsPages\DragDropBuilder\Controls;


class Select
{
    public $args;

    public function __construct($args)
    {
        $this->args = wp_parse_args(
            $args,
            ['name' => '', 'value' => '', 'options' => []]
        );
    }

    public function render()
    {
        echo sprintf('<label for="%s" class="pp-label">%s</label>', esc_attr($this->args['name']), esc_attr($this->args['label']));

        echo sprintf('<select class="pp-form-control" id="%1$s" name="%1$s">', esc_attr($this->args['name']));

        foreach ($this->args['options'] as $key => $value) {

            $selected = sprintf(
                "<# if(data.%s ==  '%s') { #> selected <# } #>",
                esc_attr($this->args['name']),
                esc_attr($key)
            );

            if (is_array($value)) {
                echo "<optgroup label='" . esc_attr($key) . "'>";
                foreach ($value as $key2 => $value2) {
                    echo sprintf('<option value="%s" %s>%s</option>', esc_attr($key2), $selected, esc_attr($value2));
                }
                echo '</optgroup>';
            } else {
                echo sprintf('<option value="%s" %s>%s</option>', esc_attr($key), $selected, esc_attr($value));
            }
        }

        echo '</select>';

        if (isset($this->args['description'])) {
            printf('<div class="pp-form-control-description">%s</div>', wp_kses_post($this->args['description']));
        }
    }
}