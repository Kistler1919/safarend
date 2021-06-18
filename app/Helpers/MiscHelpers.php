<?php

namespace App\Helpers;

class MiscHelpers 
{
  public function IDGenerator($model, $trow, $length, $prefix)
  {
    $length = 7;
    $data = $model::orderBy('id', 'DESC')->first();

    if (!$data) {
      $og_length = $length;
      $last_number = '';
    } else {
      $code = substr($data->$trow, strlen($prefix)+1);
      $actual_last_number = ($code / 1) * 1;
      $increment_last_number = $actual_last_number + 1;
      $last_number_len = strlen($increment_last_number);
      $og_length = $length - $last_number_len;
      $last_number = $increment_last_number;
    }

    $zeros = '';

    for ($i=0; $i < $og_length; $i++) { 
      $zeros .= "0";
    }

    return $prefix.'-'.$zeros.$last_number;
  }
}
