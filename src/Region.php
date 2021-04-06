<?php
namespace Xiaofengit\RegionOfChina;

use Exception;

class Region
{
    protected static $types = [
        'province',
        'city',
        'district',
    ];

    public static function getTheTypeRegions($type = '', $parent = null)
    {
        // Type
        if (!in_array($type, self::$types)) {
            throw new Exception('Type is not the expected value.');
        }

        $prefix = __DIR__ . '/../data/';
        $file = $prefix . $type. '.json';
        if (!file_exists($file)) {
            throw new Exception("file:{$file} does not exist.");
        }
        $raw = \file_get_contents($file);
        if (!$raw) {
            throw new Exception("Unknow error.");
        }

        $regions = \json_decode($raw, true);
        if (!$regions) {
            throw new Exception("The raw data is not json");
        }

        // if ($parent) {
        //     $max = $parent <= 900000 ? $parent + 9900 : $parent + 99000;
        //     $min = $parent;
        //     foreach($regions as $k => $v) {
        //         if ($max < $k || $k < $min) {
        //             unset($regions[$k]);
        //         }
        //     }
        // }

        return $regions;
    }

    public static function getTheTypeRegionsForDB($type = "province", $parent = null)
    {
        $regions = self::getTheTypeRegions($type, $parent);

        $data = [];
        $i = 0;
        foreach($regions as $k => $v) {
            $data[$i] = [
                'code' => $k,
                'name' => $v,
                'parent_code' => self::computeParentCode($k),
                'type' => $type
            ];
            $i++;
        }

        return $data;
    }

    public static function computeParentCode($code = '')
    {
        $parent = null;
        $arr = str_split($code, 2);
        if (count($arr) !== 3) {
            throw new Exception('Code length error.');
        }

        // 海外
        if ($arr[0] >= 90) {
            $parent = '900000';
        } else {
            if ($arr[2] != '00') {
                $parent = $arr[0] . $arr[1]. '00';
            } else {
                $parent = $arr[0] . '0000';
            }
        }

        return $parent;
    }

    public static function getAllRegionsForDB()
    {
        $regions = [];
        foreach(self::$types as $i => $type) {
            $regions = array_merge($regions, self::getTheTypeRegionsForDB($type));
        }

        return $regions;
    }
}