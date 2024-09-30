<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'payment_date',
        'status',
        'customer_id',
    ];

    // Define the relationship with the Customer model
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Scope to filter payments by status
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Scope to filter payments by payment date
    public function scopeByPaymentDate($query, $paymentDate)
    {
        return $query->where('payment_date', $paymentDate);
    }

}
