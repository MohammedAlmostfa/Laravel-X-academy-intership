<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Models\Order;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrdertService
{
    /**
     * Show all Order
     * @param none
     * @return array of Order
     */
    public function ShowAllOrder()
    {

    }


    /**
     * Create a new Order
     * @param array $data
     * @return bool
     */
    public function createOrder($data)
    {
        try {
            // Create a new product with the provided data
            $Order = Order::create([
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity'],
                'status' => $data['status'],
                  'order_date' => $data['order_date'],
                    'customer_id' => $data['customer_id'],

            ]);
            return true;
        } catch (Exception $e) {
            Log::error('Error creating Order: ' . $e->getMessage());
            throw new Exception('Error creating Order');
        }
    }

    /**
     * Update an existing Order
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function UpdateOrder($data, $id)
    {
        try {
            // Find the product by ID
            $Order = Order::findOrFail($id);

            // Update the product with the provided data
            $Order->Order([
                'product_id' => $data['product_id']??$Order->product_id,
                'quantity' => $data['quantity']??$Order->quantity,
                'status' => $data['status']??$Order->status,
                  'order_date' => $data['order_date']??$Order->order_date,
                    'customer_id' => $data['customer_id']??$Order->customer_id,

            ]);

            return true;
        } catch (ModelNotFoundException $e) {
            Log::error('Order not found: ' . $e->getMessage());
            throw new Exception('Order not found');
        } catch (Exception $e) {
            Log::error('Error updating Order: ' . $e->getMessage());
            throw new Exception('Error updating Order');
        }
    }

    /**
     * Show a specific Order
     * @param int $id
     * @return Product
     */
    public function ShowOrder($id)
    {
        try {


            // Find the product by ID and select specific fields
            $Order = Order::select(['product_id', 'quantity', 'price', 'status','order_date','customer_id'])->findOrFail($id);
            return $Order;
        } catch (ModelNotFoundException $e) {
            Log::error('Order not found: ' . $e->getMessage());
            throw new Exception('Order not found');
        } catch (Exception $e) {
            Log::error('Error showing Order: ' . $e->getMessage());
            throw new Exception('Error showing Order');
        }
    }

    /**
     * Delete a specific Order
     * @param int $id
     * @return bool
     */
    public function DeletOrder($id)
    {
        try {
            // Find the Order by ID
            $Order = Order::findOrFail($id);
            // Delete the Order
            $Order->delete();
            return true;
        } catch (ModelNotFoundException $e) {
            Log::error('Order not found: ' . $e->getMessage());
            throw new Exception('Order not found');
        } catch (Exception $e) {
            Log::error('Error deleting Order: ' . $e->getMessage());
            throw new Exception('Error deleting Order');
        }
    }
}
