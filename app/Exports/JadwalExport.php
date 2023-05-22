<?php

namespace App\Exports;

use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class JadwalExport implements WithStyles, FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $userId;
    protected $line;


    public function __construct(int $userId)
    {
        $this->userId = $userId;
        $this->line = 0;
    }


    // public function headings(): array
    // {
    //     return [
    //         'Nama',
    //         'Keterangan',
    //         'Waktu mulai',
    //         'Waktu berakhir',
    //     ];
    // }

    // public function collection()
    // {
    //     return Jadwal::query()
    //         ->select(
    //             'users.nama as user_id',
    //             'keterangan',
    //             'start_time',
    //             'finish_time',
    //         )->join('users', 'users.id', 'jadwals.user_id')->where('user_id', $this->userId)->get();
    // }

    public function view(): View
    {
        $jadwal = Jadwal::with('rUser')->where('user_id', $this->userId)->get();
        $user = User::find($this->userId);
        $this->line = count($jadwal);
        return view('admin.user.user_excel', compact('user', 'jadwal'));
    }

    public function styles(Worksheet $sheet)
    {
        $baris = 3 + $this->line;
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(7);
        $sheet->getColumnDimension('C')->setWidth(11);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);
        return [
            'A1:E2' => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => 'thick'
                    ]
                ],
                'font' => [
                    'size' => '12',
                    'bold' => true
                ],
                'alignment' => [
                    'horizontal' => 'center',
                    'vertical' => 'center'
                ]
            ],
            'A3:E3' => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => 'thin'
                    ]
                ],
                'font' => [
                    'bold' => true
                ],
                'alignment' => [
                    'horizontal' => 'left',
                ],
                'fill' => [
                    'fillType'   => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => "ffff00"],
                ],
            ],
            'A4:E' . $baris => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => 'thin'
                    ]
                ],
                'alignment' => [
                    'horizontal' => 'left',
                ],
                'fill' => [
                    'fillType'   => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => "ffff00"],
                ],
            ]

        ];
    }
}
