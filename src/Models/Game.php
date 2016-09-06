<?php namespace Mox\Models;

class Game extends Model{
  protected $fillable = [
         "gameWeek",
         "gameDate",
         "awayTeam",
         "homeTeam",
         "gameTimeET",
         "tvStation",
         "winner",
         "forecast",
         "low",
         "high",
         "isDome"
       ];

  private $attributes = [];

  public function __construct(Array $attr = []) {
    if(!empty($attr)){
      foreach($attr as $key=>$value)
      {
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
    if(array_key_exists($key, $this->attributes)){
      return $this->attributes[$key];
    }
    $trace = debug_backtrace();
    trigger_error(
      'Undefined property via __get(): ' . $key .
      ' in ' . $trace[0]['file'] .
      ' on line ' . $trace[0]['line'],
      E_USER_NOTICE);
    return null;
  }

  public function outputDome()
  {
    if($this->isDome == 1) {
      return 'Yes';
    } else {
      return 'No';
    }
  }

  public function toOutputArray()
  {
    $arrFormat = [
      $this->gameWeek,
      $this->awayTeam,
      $this->homeTeam,
      $this->formatDate($this->gameDate),
      $this->gameTimeET,
      $this->tvStation,
      $this->winner,
    ];

    return $arrFormat;
  }

  public function toWeatherOutputArray()
  {
    $arrFormat = [
      $this->gameWeek,
      $this->awayTeam,
      $this->homeTeam,
      $this->formatDate($this->gameDate),
      $this->gameTimeET,
      $this->tvStation,
      $this->winner,
      $this->forecast,
      $this->low,
      $this->high,
      $this->outputDome()
    ];

    return $arrFormat;
  }
}
