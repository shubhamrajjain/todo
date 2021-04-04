<?php

namespace App\Exports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class TaskExport implements WithHeadings, WithMapping, ShouldAutoSize, FromQuery
{
    /**
     * @return \Illuminate\Support\Collection
     */
    // public function collection()
    // {
    //     return Task::all();
    // }

    public function headings(): array
    {
        return [
            'Id',
            'Title',
            'Status',
            'Assign-To',
            'Date',
            'Priority',
            'Duration (In Days)',
            'Description'

        ];
    }
    public function map($unit): array
    {
        return [
            $unit->id,
            $unit->title,
            ($unit->status == 1) ? 'Completed' : 'Pending',
            isset($unit->user) ? $unit->user->name : 'N/A',
            date('d-M-Y', strtotime($unit->task_date)),
            $unit->priority,
            $unit->duration,
            $unit->description
        ];
    }

    public function query()
    {
        return Task::query()->with('user');
    }
}
