<?php

namespace App\Exports;

use App\Data\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserExport implements FromCollection, ShouldQueue, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function headings(): array
    {
        return ['Name', 'Email', 'Mobile', 'Location', 'Gender'];
    }

    public function collection()
    {
        return User::all();
    }

    public function map($user): array
    {
        $values = [
            $user->name,
            $user->email,
            $user->phone,
            $user->location,
            $user->gender,
        ];
        return $values;
    }
}
