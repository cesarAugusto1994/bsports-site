<?php

namespace App\Helpers;

class Helper
{
    public static function getConfig($slug)
    {
        $result = false;

        if(!session()->has('config')) {
            return false;
        }

        $config = session()->get('config');

        $data = $config->filter(function($item) use ($slug) {
          if($item->key == $slug) {
              return $item->value;
          }
          return false;
        });

        if($data->first() !== null) {
            $data = $data->first();
            if($data->ativo) {
                $result = $data->value;
            }
        }

        return $result;
    }
}
