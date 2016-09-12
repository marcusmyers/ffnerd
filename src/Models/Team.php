<?php namespace Mox\Models;

class Team extends Model {
  protected $fillable = [
    "code",
    "fullName",
    "shortName"
  ];

  private $attributes = [];

  public function __construct(Array $attr = [])
  {
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
      $this->code,
      $this->fullName,
      $this->shortName,
    ];

    return $arrFormat;
  }
}
