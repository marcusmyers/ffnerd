<?php namespace Mox\Models;

class Model {
  public function formatDate($date)
  {
    list($year, $m, $d) = explode('-', $date);
    return "$m/$d/$year";
  }
}
