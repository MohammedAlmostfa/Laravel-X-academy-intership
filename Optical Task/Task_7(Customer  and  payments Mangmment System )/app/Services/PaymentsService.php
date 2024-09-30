<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use App\Models\Payment;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PaymentsService
{
    /**
     * Retrieve all payments with optional filters for payment date and status
     *
     * @param array $data
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     * @throws Exception
     */
    public function showAllPayments($data)
    {
        try {
            if (isset($data['payment_date'])) {
                $payments = Payment::select(['id', 'customer_id', 'amount', 'status'])
                    ->byPaymentDate($data['payment_date'])
                    ->paginate(10);
            } elseif (isset($data['status'])) {
                $payments = Payment::select(['id', 'customer_id', 'amount', 'status'])
                    ->byStatus($data['status'])
                    ->paginate(10);
            } else {
                // Fetch all payments with selected fields and paginate
                $payments = Payment::select(['id', 'customer_id', 'amount', 'status'])
                    ->paginate(10);
            }
            return $payments; // Return the paginator object directly
        } catch (Exception $e) {
            Log::error('Error showing all payments: ' . $e->getMessage());
            throw new Exception('Error showing all payments');
        }
    }

    /**
     * Create a new Payment
     * @param array $data
     * @return Payment
     */
    public function createPayment($data)
    {
        try {
            $payment = Payment::create([
                'amount' => $data['amount'],
                'payment_date' => $data['payment_date'],

                'customer_id' => $data['customer_id'],
            ]);
            return $payment;
        } catch (Exception $e) {
            Log::error('Error creating payment: ' . $e->getMessage());
            throw new Exception('Error creating payment: ' . $e->getMessage());
        }
    }

    /**
     * Update an existing Payment
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function updatePayment($data, $id)
    {
        try {
            $payment = Payment::findOrFail($id);
            $payment->update([
                'amount' => $data['amount'] ?? $payment->amount,
                'payment_date' => $data['payment_date'] ?? $payment->payment_date,
                'status' => $data['status'] ?? $payment->status,
                'customer_id' => $data['customer_id'] ?? $payment->customer_id,
            ]);
            return true;
        } catch (ModelNotFoundException $e) {
            Log::error('Payment not found: ' . $e->getMessage());
            throw new Exception('Payment not found');
        } catch (Exception $e) {
            Log::error('Error updating payment: ' . $e->getMessage());
            throw new Exception('Error updating payment');
        }
    }

    /**
     * Show a specific Payment
     * @param int $id
     * @return Payment
     */
    public function showPayment($id)
    {
        try {
            $payments = Payment::select(['id', 'customer_id', 'amount'])->paginate(10);

            $payment = Payment::select(['id', 'customer_id', 'amount'])->findOrFail($id);
            return $payment;
        } catch (ModelNotFoundException $e) {
            Log::error('Payment not found: ' . $e->getMessage());
            throw new Exception('Payment not found');
        } catch (Exception $e) {
            Log::error('Error showing payment: ' . $e->getMessage());
            throw new Exception('Error showing payment');
        }
    }

    /**
     * Delete a specific Payment
     * @param int $id
     * @return bool
     */
    public function deletePayment($id)
    {
        try {
            $payment = Payment::findOrFail($id);
            $payment->delete();
            return true;
        } catch (ModelNotFoundException $e) {
            Log::error('Payment not found: ' . $e->getMessage());
            throw new Exception('Payment not found');
        } catch (Exception $e) {
            Log::error('Error deleting payment: ' . $e->getMessage());
            throw new Exception('Error deleting payment');
        }
    }

    /**
     * Retrieve all payments for a customer by customer ID
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws Exception
     */
    public function customer_payment($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            return $customer->payments()->get();
        } catch (ModelNotFoundException $e) {
            Log::error('Customer not found: ' . $e->getMessage());
            throw new Exception('Customer not found');
        } catch (Exception $e) {
            Log::error('Error retrieving customer payment: ' . $e->getMessage());
            throw new Exception('Error retrieving customer payment: ');
        }
    }

    /**
     * Retrieve the latest payment for a customer by customer ID
     *
     * @param int $id
     * @return Payment|null
     * @throws Exception
     */
    public function lastPayment($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            return $customer->byLastPayment()->first();
        } catch (ModelNotFoundException $e) {
            Log::error('Customer not found: ' . $e->getMessage());
            throw new Exception('Customer not found');
        } catch (Exception $e) {
            Log::error('Error retrieving last payment: ' . $e->getMessage());
            throw new Exception('Error retrieving last payment: ');
        }
    }

    /**
     * Retrieve the oldest payment for a customer by customer ID
     *
     * @param int $id
     * @return Payment|null
     * @throws Exception
     */
    public function oldestPayment($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            return $customer->byOldestPayment()->first();
        } catch (ModelNotFoundException $e) {
            Log::error('Customer not found: ' . $e->getMessage());
            throw new Exception('Customer not found');
        } catch (Exception $e) {
            Log::error('Error retrieving oldest payment: ' . $e->getMessage());
            throw new Exception('Error retrieving oldest payment: ');
        }
    }

    /**
     * Retrieve the lowest payment for a customer by customer ID
     *
     * @param int $id
     * @return Payment|null
     * @throws Exception
     */
    public function lowestPayment($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            return $customer->byLowestPayment()->first();
        } catch (ModelNotFoundException $e) {
            Log::error('Customer not found: ' . $e->getMessage());
            throw new Exception('Customer not found');
        } catch (Exception $e) {
            Log::error('Error retrieving lowest payment: ');
            throw new Exception('Error retrieving lowest payment: ' . $e->getMessage());
        }
    }

    /**
     * Retrieve the highest payment for a customer by customer ID
     *
     * @param int $id
     * @return Payment|null
     * @throws Exception
     */
    public function highestPayment($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            return $customer->byHighestPayment()->first();
        } catch (ModelNotFoundException $e) {
            Log::error('Customer not found: ' . $e->getMessage());
            throw new Exception('Customer not found');
        } catch (Exception $e) {
            Log::error('Error retrieving highest payment: ');
            throw new Exception('Error retrieving highest payment: ' . $e->getMessage());
        }
    }
}
