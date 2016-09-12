<?php namespace Mox\Models;

class K extends Player {
  protected $kstats = [
    "xp",
    "fg",
    "fantasyPoints"
  ];

  private $attributes = [];

  public function __construct(Array $attr = [])
  {
    $this->fillable = array_merge($this->fillable, $this->kstats);
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
      $this->displayName,
      $this->team,
      $this->xp,
      $this->fg,
      $this->fantasyPoints
    ];

    return $arrFormat;
  }
}
