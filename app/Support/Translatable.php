<?php

namespace App\Support;

use Illuminate\Support\Facades\App;

trait Translatable
{
    public function __get($key)
    {
        if (isset($this->translatedAttributes) && in_array($key, $this->translatedAttributes)) {
            $key = App::getLocale() . '_' . $key ;
        }
        return parent::__get($key);
    }
}
