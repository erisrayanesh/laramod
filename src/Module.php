<?php


namespace ErisRayanesh\Laramod;


use ErisRayanesh\Laramod\Contracts\Module as ModuleInterface;
use Illuminate\Support\Str;

class Module implements ModuleInterface
{

    /**
     * Module Name
     * @var string
     */
    protected static $name;

    protected static $title;

    /**
     * Module base path
     * @var string
     */
    protected static $path;

    protected static $json;

    /**
     * @return string
     */
    public static function name(): string
    {
        return static::$name ?? Str::kebab(class_basename(static::class));
    }

    public static function title(): string
    {
        return static::$title ?? static::name();
    }

    public static function path(): string
    {
        return static::$path ?? __DIR__;
    }

    public static function json()
    {
        return static::$json ??= json_decode(file_get_contents(self::path() . DIRECTORY_SEPARATOR . "module.json"));
    }

}
