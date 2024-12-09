<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Assignments;

class ResultsPage extends Component
{   
    public $results;

    public function render()
    {
        $this->results = Assignments::where('user_id', auth()->user()->id)
            ->where('completed', true)
            ->get();
        return view('results-page');
    }
}
