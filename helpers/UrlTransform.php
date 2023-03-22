<?php

namespace app\helpers;

class UrlTransform extends \yii\helpers\BaseUrl
{
    public static function getIdFromUrl($url)
    {
        parse_str(parse_url($url, PHP_URL_QUERY), $query);
        return $query['id'];
    }
}
