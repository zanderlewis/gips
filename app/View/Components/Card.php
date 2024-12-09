<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{
    public $title;
    public $description;
    public $link;
    public $linkText;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $description, $link = null, $linkText = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->link = $link;
        $this->linkText = $linkText;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.card');
    }
}