<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\StavkaPorudzbine;

class Porudzbina extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'broj_stola',
        'status',
        'napomena',
        'korisnik_id',
        'isporuceno_at',
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
            'korisnik_id' => 'integer',
        ];
    }

    public function korisnik(): BelongsTo
    {
        return $this->belongsTo(Korisnik::class);
    }

    public function stavkaPorudzbines()
    {
        return $this->hasMany(\App\Models\StavkaPorudzbine::class, 'porudzbina_id');
    }

}
