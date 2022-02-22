<?php

namespace App\Helpers;
use Illuminate\Http\UploadedFile;

class Utils
{
    public static function dataTree($data, $parent_id = 0, $level = 0)
    {
        $result = [];
        foreach ($data as $item) {
            if ($item['parent_id'] == $parent_id && $item['active']) {
                $result[] = array_merge($item, ['level' => $level]);
                $child = self::dataTree($data, $item['id'], $level + 1);
                $result = array_merge($result, $child);
            }
        }
        return  $result;
    }

    public static function categoriesMap($categoryList)
    {
        $html = '';
        foreach (self::dataTree($categoryList) as $item) {
            $html .= "<span>" . str_repeat('|----', $item['level']) . " {$item['title']} </span> <br>";
        }
        return $html;
    }

    public static function uploadedFile(UploadedFile $file, string $folder, string $disk)
    {
        $path = $file->store($folder, $disk);
        return str_replace($folder . "/", '', $path);
    }
}