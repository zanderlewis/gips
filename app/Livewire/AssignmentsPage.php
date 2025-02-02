<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Assignments;

class AssignmentsPage extends Component
{
    public $assignments;

    public function render()
    {
        $this->assignments = Assignments::where('user_id', auth()->user()->id)
            ->where('completed', false)
            ->get();
        return view('assignments-page');
    }
}
