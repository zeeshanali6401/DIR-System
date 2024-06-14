<?php

namespace App\Livewire;

use App\Exports\DirExport;
use App\Models\DIR;
use Carbon\Carbon;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;


class ExporterModal extends Component
{
    public $startDate;
    public $endDate;

    public function render()
    {
        return view('livewire.exporter-modal');
    }
    public function export()
    {
        $startDate = Carbon::parse($this->startDate)->startOfDay();
        $endDate = Carbon::parse($this->endDate)->endOfDay();
        return Excel::download(new DirExport(DIR::whereBetween('case_date_time', [$startDate, $endDate])->get()), 'DIR Export' . date("dmy") . '.csv', \Maatwebsite\Excel\Excel::CSV);
    }
}
