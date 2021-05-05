<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectAuthor extends Component
{
    public $options;
    public $author;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($options, $author = null)
    {
        $this->options  = $options;
        $this->author   = $author;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.select-author');
    }
}
