<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{

    public $counter = 0;
    public $name = 'Your Name';

    public $task;
    public $tasks = [];

    public function render()
    {
        return view('livewire.counter');
    }

    public function add()
    {
        $this->counter++;
    }

    public function addTask() {
        $this->tasks[] = $this->task;
        $this->task = '';
    }
}
