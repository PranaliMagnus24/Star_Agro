<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class AppliedUserExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
      public function collection()
    {
        return DB::table('registration_jobs')
            ->leftJoin('states', 'registration_jobs.state', '=', 'states.id')
            ->leftJoin('districts', 'registration_jobs.district', '=', 'districts.id')
            ->leftJoin('talukas', 'registration_jobs.taluka', '=', 'talukas.id')
            ->leftJoin('villages', 'registration_jobs.town', '=', 'villages.id')
            ->select(
                'registration_jobs.first_name',
                'registration_jobs.last_name',
                'registration_jobs.phone',
                'registration_jobs.email',
                'registration_jobs.applying_for',
                'states.name as state_name',
                'districts.district_name',
                'talukas.taluka_name',
                'villages.village_name',
                'registration_jobs.subject',
                'registration_jobs.description',
                'registration_jobs.cv'
            )
            ->latest('registration_jobs.created_at')
            ->get();
    }
     public function headings(): array
    {
        return ['First Name', 'Last Name'];
    }
}
