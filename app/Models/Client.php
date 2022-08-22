<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    /**
     * Get the company that owns the Client
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the user that owns the Client
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
