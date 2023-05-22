<?php

namespace App\Exports;

use App\Models\Jadwal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JadwalExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    private $userId;

    private $rowNumber = 0;


    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }


    public function headings(): array
    {
        return [
            'nama',
            'keterangan',
            'start time',
            'finish time',
        ];
    }

    public function collection()
    {
        return Jadwal::query()
            ->select(
                'users.nama as user_id',
                'keterangan',
                'start_time',
                'finish_time',
            )->join('users', 'users.id', 'jadwals.user_id')->where('user_id', $this->userId)->get();
    }

    // public function map($row): array
    // {
    //     $this->rowNumber++;

    //     return [
    //         $this->rowNumber,
    //         $row->nama,
    //         $row->keterangan,
    //         $row->start_time,
    //         $row->finish_time,
    //         // Add other row data as needed
    //     ];
    // }
}
