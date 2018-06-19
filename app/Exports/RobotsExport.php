<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class RobotsExport implements FromView
{
    public function __construct($data)
    {
        $this->result = $data;
    }

    public function view(): View
    {
        return view('exports.robots', [
            'result' => $this->result
        ]);
    }
}