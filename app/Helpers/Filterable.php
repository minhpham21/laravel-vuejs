<?php

namespace App\Helpers;

use Illuminate\Support\Str;

trait Filterable
{
    public function scopeFilter($query, $param)
    {
        foreach ($param as $field => $value) {
            $method = 'filter' . Str::studly($field);

            if (is_null($value) || $value === '') {
                continue;
            }

            if (method_exists($this, $method)) {
                $this->{$method}($query, $value);
                continue;
            }

            if (empty($this->filterable) || !is_array($this->filterable)) {
                continue;
            }

            if (in_array($field, $this->filterable)) {
                $query->where($field, $value);
            }

            if (key_exists($field, $this->filterable)) {
                $query->where($this->filterable[$field], $value);
            }
        }

        return $query;
    }
}