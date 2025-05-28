<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $amount
 * @property string $description
 * @property \Illuminate\Support\Carbon $due_date
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $payment_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill wherePaymentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereUserId($value)
 * @mixin \Eloquent
 */
class Bill extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'amount',
        'description',
        'due_date',
        'status',
        'payment_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'due_date' => 'datetime',
        'payment_date' => 'datetime',
    ];

    /**
     * Get the user that owns the bill.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 