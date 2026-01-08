<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ashon',
        'name',
        'dob',
        'nid',
        'gender',
        'fother',
        'mother',
        'occupation',
        'address',
        'zila',
        'upazila',
        'city_corporation',
        'word',
        'area',
        'area_number',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'dob' => 'date',
        ];
    }

    /**
     * Scope a query to filter by name.
     */
    public function scopeByName($query, $name)
    {
        return $query->where('name', 'like', '%' . $name . '%');
    }

    /**
     * Scope a query to filter by NID.
     */
    public function scopeByNid($query, $nid)
    {
        return $query->where('nid', 'like', '%' . $nid . '%');
    }

    /**
     * Scope a query to filter by location.
     */
    public function scopeByLocation($query, $zila = null, $upazila = null, $cityCorporation = null)
    {
        if ($zila) {
            $query->where('zila', $zila);
        }
        if ($upazila) {
            $query->where('upazila', $upazila);
        }
        if ($cityCorporation) {
            $query->where('city_corporation', $cityCorporation);
        }
        return $query;
    }

    /**
     * Scope a query to filter by gender.
     */
    public function scopeByGender($query, $gender)
    {
        return $query->where('gender', $gender);
    }
}

