<?php

namespace Kirinaki\Framework\Wordpress\Walkers;

class HierarchicalWalker extends Walker
{
    public $tree_type = ['post_type', 'taxonomy', 'custom'];
    public $db_fields = ['parent' => 'menu_item_parent', 'id' => 'db_id'];

    protected $menu_array = [];
    protected $current_level = [];

    public function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {
        $item_data = [
            'ID' => $item->ID,
            "depth" => $depth,
            'title' => $item->title,
            'url' => $item->url,
            'menu_order' => $item->menu_order,
            'type' => $item->type,
            'type_label' => $item->type_label,
            'target' => $item->target,
            'attr_title' => $item->attr_title,
            'xfn' => $item->xfn,
            'children' => []
        ];

        if ($item->menu_item_parent) {
            $this->current_level[$item->menu_item_parent]['children'][$item->ID] = &$item_data;
        } else {
            $this->menu_array[$item->ID] = &$item_data;
        }

        $this->current_level[$item->ID] = &$item_data;
    }

    public function toArray()
    {
        return $this->menu_array;
    }
}
