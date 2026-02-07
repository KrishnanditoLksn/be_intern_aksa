<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Division extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Kolom yang dapat diisi massal.
     */
    protected $fillable = [
        'id',
        'name',
    ];

    /**
     * Relasi ke model Employee.
     * Satu Division bisa memiliki banyak Employee.
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class, 'division_id');
    }
}
