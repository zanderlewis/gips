<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DashboardCard extends Component
{
    public $title;
    public $description;
    public $link;
    public $linkText;
    public $list;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $description, $link = null, $linkText = null, $list = [])
    {
        $this->title = $title;
        $this->description = $description;
        $this->link = $link;
        $this->linkText = $linkText;
        $this->list = $list;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.dashboard-card');
    }
}