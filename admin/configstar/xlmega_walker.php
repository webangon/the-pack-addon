<?php

use Elementor\Plugin as Elementor;

class The_Pack_Nav_Walker extends Walker_Nav_Menu
{
    public function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {   

        global $wp_query;
        $buildercontent = $this->getItemBuilderContent($item->tpmegatemplate);
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $class_names = $value = '';
        $classes = empty($item->classes) ? [] : (array) $item->classes;
        if ($item->tpmega == '1') {
            $classes[] = 'thepack_mega_menu';
        }
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
        $class_names = ' class="' . esc_attr($class_names) . '"';

        if ($depth == 1) {
            $output .= $indent . '<li' . $value . $class_names . '>';
        } else {
            $output .= $indent . '<li' . $value . $class_names . '>';
        }

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $description = !empty($item->description) ? '<span>' . esc_attr($item->description) . '</span>' : '';

        if ( !is_object( $args ) ){
            return;
        }

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID);
        $item_output .= $description . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        if ($item->tpmega == '1') {
            $item_output .= sprintf('<div class="thepack-mega-menu-wrapper" %1s>%2s</div>', '', $buildercontent);
        }

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output)
    {
        $id_field = $this->db_fields['id'];
        if (is_object($args[0])) {
            $args[0]->has_children = !empty($children_elements[$element->$id_field]);
        }
        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

    private function getItemBuilderContent($template_id)
    {
        static $elementor = null;
        $elementor = Elementor::instance();

        return $elementor->frontend->get_builder_content_for_display($template_id);
    }
}
