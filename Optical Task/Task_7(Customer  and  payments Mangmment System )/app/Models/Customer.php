<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'email',
        'phone_number',

    ];

    // Define the relationship with the Payment model

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    // Return the latest payment based on payment_date

    public function scopeByLastPayment($query)
    {
        return $this->hasOne(Payment::class)->latestOfMany('payment_date');
    }
    // Return the oldest payment based on payment_date

    public function scopeByOldestPayment($query)
    {
        return $this->hasOne(Payment::class)->oldestOfMany('payment_date');
    }
    // Return the highest payment based on amount

    public function scopeByHighestPayment()
    {
        return $this->hasOne(Payment::class)->ofMany('amount', 'max');

    }
    // Return the lowest payment based on amount

    public function scopeByLowestPayment($id)
    {
        return $this->hasOne(Payment::class)->ofMany('amount', 'min');
    }
}
