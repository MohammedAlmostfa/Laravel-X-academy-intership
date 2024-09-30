<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Models\Order;
use App\Models\Product;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrderService
{
    /**
     * Show all Orders
     * @param none
     * @return array of Order
     */
    public function showAllOrders($data)
    {

        try {
            if(isset($data['product_id'])) {
                // Fetch all Orders with selected fields and paginate
                $Orders = Order::select(['id', 'product_id', 'quantity', 'price', 'status', 'order_date', 'customer_id'])
                    ->byProducts($data['product_id'])
                    ->paginate(10);

            } else {
                $Orders = Order::select(['id','product_id', 'quantity', 'price', 'status', 'order_date', 'customer_id'])->paginate(10);

            }
            return $Orders; // Return the paginator object directly
        } catch (Exception $e) {
            Log::error('Error showing all Order: ' . $e->getMessage());
            throw new Exception('Error showing all Order');
        }

    }

    /**
     * Create a new Order
     * @param array $data
     * @return Order
     */
    public function createOrder($data)
    {
        try {
            // Create a new order with the provided data
            $order = Order::create([
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity'],
                'price' => $data['price']??0,
                'status' => $data['status']??null,
                'order_date' => $data['order_date'],
                'customer_id' => $data['customer_id'],

            ]);
            return $order;
        } catch (Exception $e) {
            Log::error('Error creating Order: ' . $e->getMessage());
            throw new Exception('Error creating Order' . $e->getMessage());
        }
    }

    /**
     * Update an existing Order
     * @param array $data
     * @param int $id
     * @return Order
     */
    public function updateOrder($data, $id)
    {
        try {
            // Find the order by ID
            $order = Order::findOrFail($id);

            // Update the order with the provided data
            $order->update([
                'product_id' => $data['product_id'] ?? $order->product_id,
                'quantity' => $data['quantity'] ?? $order->quantity,
                'status' => $data['status'] ?? $order->status,
                'order_date' => $data['order_date'] ?? $order->order_date,
                'customer_id' => $data['customer_id'] ?? $order->customer_id,
            ]);

            // Check if quantity has changed and update price accordingly
            if ((isset($data['quantity']))||(isset($data['product_id']) && $data['product_id'])) {
                $product = Product::find($order->product_id);
                if ($product) {
                    $order->price = $product->price * $data['quantity'];
                    $order->save();
                }
            }

            return $order;
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
     * @return Order
     */
    public function showOrder($id)
    {
        try {
            // Find the order by ID and select specific fields
            $order = Order::select(['id','product_id', 'quantity', 'price', 'status', 'order_date', 'customer_id'])->findOrFail($id);
            return $order;
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
    public function deleteOrder($id)
    {
        try {
            // Find the order by ID
            $order = Order::findOrFail($id);
            // Delete the order
            $order->delete();
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
