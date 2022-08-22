<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'logo',
        'email',
        'domain',
        'address',
        'industry',
        'description',
        'primary_phone',
        'secondary_phone',
    ];

    /**
     * Get all of the clients for the Company
     */
    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }

    /**
     * Get the user that owns the Company
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
