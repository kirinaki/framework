<?php

namespace Kirinaki\Framework\Fieldsets;

class Field
{
    public static function image(string $id, string $label): \Carbon_Fields\Field\Field
    {
        return \Carbon_Fields\Field::make("image", $id, $label);
    }

    public static function text(string $id, string $label): \Carbon_Fields\Field\Field
    {
        return \Carbon_Fields\Field::make("text", $id, $label);
    }

    public static function textarea(string $id, string $label): \Carbon_Fields\Field\Field
    {
        return \Carbon_Fields\Field::make("textarea", $id, $label);
    }

    public static function richText(string $id, string $label): \Carbon_Fields\Field\Field
    {
        return \Carbon_Fields\Field::make("rich_text", $id, $label);
    }

    public static function complex(string $id, string $label): \Carbon_Fields\Field\Field
    {
        return \Carbon_Fields\Field::make("complex", $id, $label);
    }
}
