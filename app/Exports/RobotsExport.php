<?php

namespace App\Exports;

use \Maatwebsite\Excel\Sheet;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

class RobotsExport implements FromView, ShouldAutoSize
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

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

                $event->sheet->styleCells(
                    'A1:4C',
                    [
                        'color' => ['argb' => 'FFFF0000'],
                        'background' => [
                            'color' => ['argb' => 'FFFF0000'],
                        ],
                        'borders' => [
                            'outline' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                                'color' => ['argb' => 'FFFF0000'],
                            ],
                        ]
                    ]
                );
            },


            Sheet::class    => function(Sheet $event) {
                $event->sheet->styleCells(
                    'A1:A7',
                    [
                        'color' => ['argb' => 'FFFF0000'],
                        'background' => [
                            'color' => ['argb' => 'FFFF0000'],
                        ],
                        'borders' => [
                            'outline' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                                'color' => ['argb' => 'FFFF0000'],
                            ],
                        ]
                    ]
                );
            },
        ];
    }
}

