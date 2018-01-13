<?php

namespace App\Filters;

use App\User;
use App\Filters\Filters;
use Illuminate\Http\Request;

abstract class Filters
{
  protected $filters = [];

  protected $request;

  protected $builder;

  public function __construct(Request $request)
  {
    $this->request = $request;
  }

  public function apply($builder)
  {
    $this->builder = $builder;

    foreach ($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }
    // if ($this->request->has('by')) {
    //   $this->by($this->request->by);
    // }

    return $this->builder;

  }

  public function getFilters()
    {
        return $this->request->intersect($this->filters);
    }
}
