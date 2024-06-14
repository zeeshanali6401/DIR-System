<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class DirExport implements FromView
{
    protected $dirs;

    public function __construct($dirs)
    {
        $this->dirs = $dirs;
    }

    public function view(): View
    {
        return view('exports.dir-exporter', [
            'dirs' => $this->dirs
        ]);
    }
}
