<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Exception;

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

    public function setPriceAttribute($value)
    {
        $product = Product::find($this->attributes['product_id']);
        if ($product) {
            $this->attributes['price'] = $product->price * $this->attributes['quantity'];
        } else {
            throw new Exception('Errssssssor creating Order');

        }
    }
}
