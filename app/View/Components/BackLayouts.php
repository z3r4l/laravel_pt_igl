<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BackLayouts extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
  
    public function __construct($title = null)
    {
        $this->title    = "PT INTER GLOBAL LOGISTIC | $title" ?? "PT INTER GLOBAL LOGISTIC"; 
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('back.layouts.main');
    }
}