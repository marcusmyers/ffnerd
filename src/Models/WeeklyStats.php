<?php namespace Mox\Models;

class WeeklyStats extends Player {
  protected $stats = [
    "week",
    "displayName",
    "passAtt",
    "passCmp",
    "passYds",
    "passTD",
    "passInt",
    "rushAtt",
    "rushYds",
    "rushTD",
    "fumblesLost",
    "receptions",
    "recYds",
    "recTD",
    "fg",
    "fgAtt",
    "xp",
    "defInt",
    "defFR",
    "defFF",
    "defSack",
    "defTD",
    "defRetTD",
    "defSafety",
    "defPA",
    "defYdsAllowed"
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
      $this->displayName,
      $this->passAtt,
      $this->passCmp,
      $this->passYds,
      $this->passTD,
      $this->passInt,
      $this->rushAtt,
      $this->rushYds,
      $this->rushTD,
      $this->fumblesLost,
      $this->receptions,
      $this->recYds,
      $this->recTD,
      $this->fg,
      $this->fgAtt,
      $this->xp,
      $this->defInt,
      $this->defFR,
      $this->defFF,
      $this->defSack,
      $this->defTD,
      $this->defRetTD,
      $this->defSafety,
      $this->defPA,
      $this->defYdsAllowed
    ];

    return $arrFormat;
  }
}
