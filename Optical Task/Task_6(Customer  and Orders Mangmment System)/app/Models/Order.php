<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Exception;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use function PHPUnit\Framework\throwException;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'price',
        'status',
        'order_date',
        'customer_id',
    ];

    public function product()
    {
        return $this->hasOne(Product::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }



    public function setPriceAttribute($value)
    {
        $product = Product::find($this->attributes['product_id']);
        if ($product) {
            $this->attributes['price'] = $product->price * $this->attributes['quantity'];
        } else {
            throw new Exception('Errssssssor creating Order');

        }
    }
    public function scopeByProducts($query, $product_id)
    {
        return $query->where('product_id', $product_id);
    }

}
