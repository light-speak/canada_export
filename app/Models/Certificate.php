<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $address_id
 * @property string $destination_country
 * @property string $certificate_type
 * @property string $purpose
 * @property int $copies
 * @property string $language
 * @property bool $is_manufacturer
 * @property string $invoice_path
 * @property string $manufacturing_statement_path
 * @property string $delivery_type
 * @property string $shipping_method
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Address|null $address
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Certificate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Certificate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Certificate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Certificate whereAddressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Certificate whereCertificateType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Certificate whereCopies($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Certificate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Certificate whereDeliveryType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Certificate whereDestinationCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Certificate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Certificate whereInvoicePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Certificate whereIsManufacturer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Certificate whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Certificate whereManufacturingStatementPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Certificate wherePurpose($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Certificate whereShippingMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Certificate whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Certificate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Certificate whereUserId($value)
 * @mixin \Eloquent
 */
class Certificate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'destination_country',
        'certificate_type',
        'purpose',
        'copies',
        'language',
        'is_manufacturer',
        'invoice_path',
        'manufacturing_statement_path',
        'delivery_type',
        'shipping_method',
        'address_id',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_manufacturer' => 'boolean',
        'copies' => 'integer',
    ];

    /**
     * Get the user that owns the certificate.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the shipping address for the certificate.
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * Get the products included in this certificate.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'certificate_products')
            ->withTimestamps();
    }
} 