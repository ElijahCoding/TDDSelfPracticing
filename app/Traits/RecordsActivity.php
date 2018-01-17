<?php

namespace App\Traits;

use App\Activity;

trait RecordsActivity
{
  protected static function bootRecordsActivity()
  {
    if (auth()->guest()) return;
     
    foreach (static::getActivitiesToRecord() as $event) {
      static::created(function($model) use ($event) {
        $model->recordActivity($event);
      });
    }
  }

  protected static function getActivitiesToRecord()
  {
    return ['created'];
  }

  protected function recordActivity($event)
  {
    $this->activity()->create([
      'user_id' => auth()->id(),
      'type' => $this->getActivityType($event),
    ]);

    // Activity::create([
    //   'user_id' => auth()->id(),
    //   'type' => $this->getActivityType($event),
    //   'subject_id' => $this->id,
    //   'subject_type' => get_class($this)
    // ]);
  }

  public function activity()
  {
    return $this->morphMany(Activity::class, 'subject');
  }

  protected function getActivityType($event)
  {
    $type = strtolower((new \ReflectionClass($this))->getShortName());

    return $event . '_' . $type;
  }
}
