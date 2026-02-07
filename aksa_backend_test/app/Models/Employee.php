<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    use HasFactory, HasUuids;

    /**
     * Karena ID adalah UUID, kita perlu menonaktifkan auto-incrementing.
     * Trait HasUuids sebenarnya sudah menangani ini, tapi menulisnya 
     * secara eksplisit membantu mencegah error casting ke integer.
     */
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table="employees";

    /**
     * Kolom yang dapat diisi (mass assignable).
     */
    protected $fillable = [
        'id',
        'image',
        'name',
        'phone',
        'position',
        'division_id',
    ];

    /**
     * Relasi ke model Division.
     * Employee dimiliki oleh satu Division.
     */
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'division_id');
    }
}