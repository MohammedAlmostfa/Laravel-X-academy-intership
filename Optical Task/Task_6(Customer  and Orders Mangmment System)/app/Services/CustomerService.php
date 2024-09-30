<?php
namespace App\Services;

use App\Models\Customer;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CustomerService
{
    /**
     * Show all customers
     * @param none
     * @return LengthAwarePaginator
     */
    public function ShowAllCustomer($data)
    {
        try {
            if (isset($data['orderstatus'])) {
                $Customers = Customer::select(['id', 'name' ])
                    ->whereHas('orders', function ($q) use ($data) {
                        $q->where('status', $data['orderstatus']);
                    })->paginate(10);
            } elseif (isset($data['order_date'])) {


                $Customers = Customer::select(['id', 'name' ])
                    ->whereHas('orders', function ($q) use ($data) {
                        $q->where('order_date', $data['order_date']);
                    })->paginate(10);

            } else {
                // Fetch all customers with selected fields and paginate
                $Customers = Customer::select(['id', 'name' ])->paginate(10);
            }
            return $Customers; // Return the paginator object directly
        } catch (Exception $e) {
            Log::error('Error showing all Customers: ' . $e->getMessage());
            throw new Exception('Error showing all Customers');
        }
    }


    /**
     * Create a new customer
     * @param array $data
     * @return bool
     */
    public function createCustomer($data)
    {
        try {
            // Create a new customer with the provided data
            $Customer = Customer::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
            ]);
            return true;
        } catch (Exception $e) {
            Log::error('Error creating Customer: ' . $e->getMessage());
            throw new Exception('Error creating Customer');
        }
    }

    /**
     * Update an existing customer
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function UpdateCustomer($data, $id)
    {
        try {
            // Find the customer by ID
            $Customer = Customer::findOrFail($id);

            // Update the customer with the provided data
            $Customer->update([
                'name' => $data['name'] ?? $Customer->name,
                'email' => $data['email'] ?? $Customer->email,
                'phone_number' => $data['phone_number'] ?? $Customer->phone_number,
            ]);

            return true;
        } catch (ModelNotFoundException $e) {
            Log::error('Customer not found: ' . $e->getMessage());
            throw new Exception('Customer not found');
        } catch (Exception $e) {
            Log::error('Error updating Customer: ' . $e->getMessage());
            throw new Exception('Error updating Customer');
        }
    }

    /**
     * Show a specific customer
     * @param int $id
     * @return Customer
     */
    public function ShowCustomer($id)
    {
        try {
            // Find the customer by ID and select specific fields
            $Customer = Customer::select(['id', 'name', 'email', 'phone_number'])->findOrFail($id);
            return $Customer;
        } catch (ModelNotFoundException $e) {
            Log::error('Customer not found: ' . $e->getMessage());
            throw new Exception('Customer not found');
        } catch (Exception $e) {
            Log::error('Error showing Customer: ' . $e->getMessage());
            throw new Exception('Error showing Customer');
        }
    }

    /**
     * Delete a specific Customer
     * @param int $id
     * @return bool
     */
    public function DeleteCustomer($id)
    {
        try {
            // Find the Customer by ID
            $Customer = Customer::findOrFail($id);
            // Delete the Customer
            $Customer->delete();
            return true;
        } catch (ModelNotFoundException $e) {
            Log::error('Customer not found: ' . $e->getMessage());
            throw new Exception('Customer not found');
        } catch (Exception $e) {
            Log::error('Error deleting Customer: ' . $e->getMessage());
            throw new Exception('Error deleting Customer');
        }
    }
    /**
   * Show a specific customer with his orders
   * @param int $id
   * @return Customer
   */

    public function ShowCustomerwithorders($id)
    {
        try {
            // Find the customer by ID and select specific fields
            $Customer = Customer::select(['id', 'name'])->with('order')->findOrFail($id);
            return $Customer;
        } catch (ModelNotFoundException $e) {
            Log::error('Customer not found: ' . $e->getMessage());
            throw new Exception('Customer not found');
        } catch (Exception $e) {
            Log::error('Error showing Customer: ' . $e->getMessage());
            throw new Exception('Error showing Customer');
        }
    }




}
