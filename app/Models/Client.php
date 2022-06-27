<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'position',
        'last_name',
        'first_name',
        'company_id',
        'primary_phone',
        'secondary_phone',
        'timezone',
    ];

    // A client belongs to a company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
