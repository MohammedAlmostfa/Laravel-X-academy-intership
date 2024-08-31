<?php
namespace App\Service;

use App\Models\Borrowrecord;
use Exception;
use Illuminate\Support\Facades\Auth;

class BookService
{


    /**
         /**
     * * creat book
     * *@param array $data
     * *@return array(message,status,data)
     */
    public function createBorrow($data)
    {
        try {
            $borrow = BorrowRecord::create([
                'book_id' => $data['book_id'],
                'user_id' => Auth::user()->id,
                'borrowed_at' => now(),
                'due_date' => null,
                'returned_at' => now()->addDays(14),
            ]);

            return [
                'message' => 'تمت عملية الاستعارة بنجاح',
                'data' => $borrow,
                'status' => 201,
            ];
        } catch (Exception $e) {
            return [
                'message' => 'حدث خطأ أثناء الاستعارةة: ' . $e->getMessage(),
                'status' => 500,
                'data' => null,
            ];
        }
    }

    /**
 * * show book data
 *
 * **@param $id
 * **@return array(message,status,data)
 */


    public function Showborrow($id)
    {

        $borrow = Borrowrecord::find($id);

        if (!$borrow) {
            return [
                'message' => 'الكتاب غير موجود',
                'status' => 404,
                'data' =>'لا يوجد بيانات'
            ];
        } else {

            try {
               
                return [
                    'message' => 'بيانات الكتاب',
                    'data' => $borrow,
                    'status' => 200,
                ];
            } catch (Exception $e) {
                return [
                    'message' => 'حدث خطا اثناء عمليةالعرض',
                    'status' => 500,
                    'data' => 'لم يتم عرض البيانات'
                ];
            }
        }
    }



    /**
         /**
     * * update book data
     * **@param array $data
     * **@param $id
     * **@return array(message,status,data)
     */

    public function updateborrow($newData, $id)
    {
        $book =      $borrow = Borrowrecord::find($id);

        if (!$book) {
            return [
                'message' => 'الكتاب غير موجود',
                'status' => 404,
                'data' =>'لا يوجد بيانات'
            ];
        } else {

            try {
                $book->update($newData);
                return [
                    'message' => 'تمت عملية التحديث',
                    'data' => $book,
                    'status' => 200,
                ];
            } catch (Exception $e) {
                return [
                    'message' => 'حدث خطأ أثناء التحديث',
                    'status' => 500,
                    'data' => 'لم يتم تحديث البيانات'
                ];
            }
        }
    }

    /**
     /**
 * * delet book dataa

 * *@param $id
 * *@return array
 */


    public function deleteBook($id)
    {
        $book =     $borrow = Borrowrecord::find($id);

        if (!$book) {
            return [
                'message' => 'الكتاب غير موجود',
                'status' => 404,
                'data' =>'لا يوجد بيانات'
            ];
        } else {

            try {
                $book->delete();

                return [
                    'message' => 'تمت عملية الحذف',
                    'data' => $book,
                    'status' => 200,
                ];
            } catch (Exception $e) {
                return [
                    'message' => 'حدث خطا اثناء عملية الحذف',
                    'status' => 500,
                    'data' => 'لم يتم حذف البيانات'
                ];
            }
        }
    }




}
