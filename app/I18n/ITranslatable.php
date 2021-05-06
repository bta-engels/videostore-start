<?php
namespace App\I18n;

interface ITranslatable {

    static function getLangClass();

    static function getTranslatables();

    static function getTranslatableForeignKey();
}
