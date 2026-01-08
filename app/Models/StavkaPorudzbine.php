<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StavkaPorudzbine extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'porudzbina_id',
        'koktel_id',
        'kolicina',
        'jedinicna_cena',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'porudzbina_id' => 'integer',
            'koktel_id' => 'integer',
            'jedinicna_cena' => 'decimal',
        ];
    }

    public function porudzbina(): BelongsTo
    {
        return $this->belongsTo(Porudzbina::class);
    }

    public function koktel(): BelongsTo
    {
        return $this->belongsTo(Koktel::class);
    }
}
