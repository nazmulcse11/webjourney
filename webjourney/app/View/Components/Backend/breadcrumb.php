<?php

namespace App\View\Components\Backend;

use Illuminate\View\Component;

class breadcrumb extends Component
{
    public $title;
    public function __construct($data)
    {
        $this->title = $data;
    }
    public function render()
    {
        return view('components.backend.breadcrumb');
    }
}
