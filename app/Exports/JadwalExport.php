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

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }


    public function headings(): array
    {
        return [
            'nama',
            'keterangan',
            'start_time',
            'finish_time',
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
}
