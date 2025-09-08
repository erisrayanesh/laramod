<?php


namespace ErisRayanesh\Laramod\Contracts;


interface Module
{
    public static function name();
    public static function title();
    public static function path();
    public static function json();
}