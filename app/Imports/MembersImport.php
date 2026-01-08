<?php

namespace App\Imports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Facades\Log;

class MembersImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, WithBatchInserts, WithChunkReading
{
    use SkipsFailures;

    protected $updateExisting;
    public $imported = 0;
    public $skipped = 0;
    public $errors = [];

    public function __construct($updateExisting = false)
    {
        $this->updateExisting = $updateExisting;
    }

    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Map various header formats to database fields
        $rowData = [
            'ashon' => $this->getValue($row, ['ashon', 'ashon']),
            'name' => $this->getValue($row, ['name', 'name']),
            'dob' => $this->parseDate($this->getValue($row, ['date_of_birth', 'dob', 'date of birth'])),
            'nid' => $this->getValue($row, ['nid', 'national_id', 'national id']),
            'gender' => $this->normalizeGender($this->getValue($row, ['gender'])),
            'fother' => $this->getValue($row, ['father', 'fother', 'father_name']),
            'mother' => $this->getValue($row, ['mother', 'mother_name']),
            'occupation' => $this->getValue($row, ['occupation']),
            'address' => $this->getValue($row, ['address']),
            'zila' => $this->getValue($row, ['zila', 'district']),
            'upazila' => $this->getValue($row, ['upazila', 'sub_district', 'sub-district']),
            'city_corporation' => $this->getValue($row, ['city_corporation', 'city corporation', 'city']),
            'word' => $this->getValue($row, ['word', 'ward']),
            'area' => $this->getValue($row, ['area']),
            'area_number' => $this->getValue($row, ['area_number', 'area number', 'area_no', 'area no']),
        ];

        // Clean up empty strings
        $rowData = array_map(function ($value) {
            return $value !== '' && $value !== null ? trim($value) : null;
        }, $rowData);

        // Skip if required fields are missing
        if (empty($rowData['name']) || empty($rowData['nid'])) {
            $this->skipped++;
            return null;
        }

        // Check if member exists
        $existingMember = Member::where('nid', $rowData['nid'])->first();

        if ($existingMember) {
            if ($this->updateExisting) {
                $existingMember->update($rowData);
                $this->imported++;
                return null; // Don't create new model
            } else {
                $this->skipped++;
                return null; // Skip duplicate
            }
        }

        $this->imported++;
        return new Member($rowData);
    }

    /**
     * Get value from row using multiple possible keys
     */
    protected function getValue(array $row, array $keys)
    {
        foreach ($keys as $key) {
            // Try exact match
            if (isset($row[$key])) {
                return $row[$key];
            }
            
            // Try case-insensitive match
            foreach ($row as $rowKey => $value) {
                if (strtolower(str_replace([' ', '_'], '', $rowKey)) === strtolower(str_replace([' ', '_'], '', $key))) {
                    return $value;
                }
            }
        }
        
        return null;
    }

    /**
     * Parse and normalize date
     */
    protected function parseDate($date)
    {
        if (empty($date)) {
            return null;
        }

        try {
            // Try to parse various date formats
            if (is_numeric($date)) {
                // Excel date serial number
                $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date);
                return $date->format('Y-m-d');
            }
            
            $date = \Carbon\Carbon::parse($date);
            return $date->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Normalize gender value
     */
    protected function normalizeGender($gender)
    {
        if (empty($gender)) {
            return null;
        }

        $gender = strtolower(trim($gender));
        
        if (in_array($gender, ['male', 'm', '1'])) {
            return 'male';
        } elseif (in_array($gender, ['female', 'f', '2'])) {
            return 'female';
        } elseif (in_array($gender, ['other', 'o', '3'])) {
            return 'other';
        }
        
        return null;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'nid' => 'required',
        ];
    }

    /**
     * @return int
     */
    public function batchSize(): int
    {
        return 1000;
    }

    /**
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000;
    }

}

