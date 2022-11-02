<?php

namespace App\Util;

class View
{
    private static array $vars = [];

    public static function init(array $vars = [])
    {
        self::$vars = $vars;
    }

    private static function getContentView($view): string
    {
        $archive = __DIR__ . '/../../Views/' . $view . '.php';
        return file_exists($archive) ? file_get_contents($archive) : '';
    }

    public static function render($view, $vars = []): string
    {
        $contentView = self::getContentView($view);

        $vars = array_merge(self::$vars, $vars);

        $keys = array_keys($vars);
        $keys = array_map(function ($item) {
            return '{{' . $item . '}}';
        }, $keys);

        return str_replace($keys, array_values($vars), $contentView);
    }
}
