<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Assignments;

class Dashboard extends Component
{
    public $assignments;
    public $results;

    public function render()
    {
        $this->assignments = Assignments::where('user_id', auth()->user()->id)
            ->where('completed', false)
            ->count();
        
        $this->results = Assignments::where('user_id', auth()->user()->id)
            ->where('completed', true)
            ->count();

        return view('dashboard');
    }
}