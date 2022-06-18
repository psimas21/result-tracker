<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'results';
    protected $fillable = [
        'user_id',
        'party_id',
        'lga_id',
        'ward_id',
        'pu_id',
        'vote_count',
    ];

    public function party()
    {
        return $this->belongsTo(Party::class);
    }

}
