<?php
namespace Database\Seeders\Data;

/**
 * Class Data
 * @package Database\Seeders\Data
 */
class Data
{
    /**
     * @var array
     */
    protected static $data;

    /**
     * @return mixed
     */
    public static function getDecodedData() {
        return json_decode(json_encode(static::$data));
    }

    /**
     * @return array
     */
    public static function getData() {
        return static::$data;
    }
}
