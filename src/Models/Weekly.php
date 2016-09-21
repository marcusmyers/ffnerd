<?php namespace Mox\Models;

class Weekly extends Player {
  protected $stats = [
    "week",
    "name",
    "standard",
    "standardLow",
    "standardHigh",
    "ppr",
    "pprLow",
    "pprHigh",
    "injury",
    "practiceStatus",
    "gameStatus",
    "lastUpdate"
  ];

  private $attributes = [];

  public function __construct(Array $attr = [])
  {
    $this->fillable = array_merge($this->fillable, $this->stats);
    if(!empty($attr)) {
      foreach($attr as $key=>$value) {
        if(in_array($key, $this->fillable)) {
          $this->{$key} = $value;
        }
      }
    }
  }

  public function __set($key, $value)
  {
    $this->attributes[$key] = $value;
  }

  public function __get($key)
  {
    if(array_key_exists($key, $this->attributes)) {
      return $this->attributes[$key];
    }
    $trace = debug_backtrace();
    trigger_error(
      'Undefined property via __get(): ' . $key .
      ' in '. $trace[0]['file'] .
      ' on line ' . $trace[0]['line'],
      E_USER_NOTICE);
    return null;
  }

  public function toOutputArray()
  {
    $arrFormat = [
      $this->week,
      $this->name,
      $this->position,
      $this->team,
      $this->standard,
      $this->standardLow,
      $this->standardHigh,
      $this->ppr,
      $this->pprLow,
      $this->pprHigh,
      $this->injury,
      $this->practiceStatus,
      $this->gameStatus,
      $this->lastUpdate
    ];

    return $arrFormat;
  }
}
