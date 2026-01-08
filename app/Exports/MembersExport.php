<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MembersExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $members = Member::orderBy('id', 'desc')->get();
        
        // Return empty collection if no members
        if ($members->isEmpty()) {
            return collect([]);
        }
        
        return $members;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Ashon',
            'Name',
            'Date of Birth',
            'NID',
            'Gender',
            'Father',
            'Mother',
            'Occupation',
            'Address',
            'Zila',
            'Upazila',
            'City Corporation',
            'Word',
            'Area',
            'Area Number',
            'Created At',
            'Updated At'
        ];
    }

    /**
     * @param Member $member
     * @return array
     */
    public function map($member): array
    {
        return [
            $member->id ?? '',
            $member->ashon ?? '',
            $member->name ?? '',
            $member->dob ? ($member->dob instanceof \Carbon\Carbon ? $member->dob->format('Y-m-d') : $member->dob) : '',
            $member->nid ?? '',
            $member->gender ?? '',
            $member->fother ?? '',
            $member->mother ?? '',
            $member->occupation ?? '',
            $member->address ?? '',
            $member->zila ?? '',
            $member->upazila ?? '',
            $member->city_corporation ?? '',
            $member->word ?? '',
            $member->area ?? '',
            $member->area_number ?? '',
            $member->created_at ? ($member->created_at instanceof \Carbon\Carbon ? $member->created_at->format('Y-m-d H:i:s') : $member->created_at) : '',
            $member->updated_at ? ($member->updated_at instanceof \Carbon\Carbon ? $member->updated_at->format('Y-m-d H:i:s') : $member->updated_at) : '',
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF']
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4472C4']
                ]
            ],
        ];
    }
}

