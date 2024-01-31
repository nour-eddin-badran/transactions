<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DateInput extends Component
{
    public $id;

    public $name;

    public $label;

    public $type;

    public $step;

    public $required;

    public $viewMode;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $label, $name, $viewMode = 0, $required = true, $step = null, $type = null)
    {
        $this->id = $id;
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
        $this->viewMode = $viewMode;
        $this->required = $required;
        $this->step = $step;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.date-input');
    }
}
