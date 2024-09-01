<?php
namespace App\Service;

use App\Models\Book;
use App\Models\BorrowRecord;
use Exception;
use Illuminate\Support\Facades\Auth;

class BorrowrecordService
{




  
    /**
     * * creat book
     * *@param array $data
     * *@return array(message,status,data)
     */
    public function createBorrow($data)
    {
        try {

            // create boorrow record
            $borrow = BorrowRecord::create([
                'book_id' => $data['book_id'],
                'user_id' => Auth::user()->id,
                'borrowed_at' => date('Y-m-d'),
                'due_date' => null,
                'returned_at' => now()->addDays(14),
            ]);

            //Update book case
            $book = Book::find($data['book_id']);
            $book->update([
               'case'=>'Borrowed',
            ]);

            //return messegge
            return [
                'message' => 'تمت عملية الاستعارة بنجاح',
                'data' => $borrow,
                'status' => 201,
            ];
        } catch (Exception $e) {
            return [
                'message' => 'حدث خطأ أثناء الاستعارة: ',
                'status' => 500,
                'data' => null,
            ];
        }
    }
    //**________________________________________________________________________________________________
    /**
 ** update book data
     * **@param array $data
     * **@param $id
     * **@return array(message,status,data)
     */

    public function updateBorrow($id)
    {
        // Find the borrow record
        $borrow = BorrowRecord::find($id);
        // Find the book
        $book = Book::find($borrow['book_id']);

        // Check the status of the book
        if ($book['case'] == 'existing') {
            return [
                'message' => 'الكتاب غير مستعار',
                'status' => 404,
                'data' => 'لا يوجد بيانات'
            ];
        }

        // Check the status of who borrowed the book
        if (Auth::check() && Auth::user()->id != $borrow['user_id']) {
            return [
                'message' => 'لم تقم انت باستعارة الكتاب',
                'data' => $borrow,
                'status' => 403,
            ];
        } else {
            
           
            try {
                //Update book case
                $book->update([
                    'case' => 'existing',
                ]);

                // Return the book
                // inster the date of  return
                $borrow->update([
                    'due_date' => now(),
                ]);
                // return meessegw
                return [
                    'message' => 'تمت عملية الإعادة',
                    'data' => $borrow,
                    'status' => 200,
                ];
            } catch (Exception $e) {
                return [
                    'message' => 'حدث خطأ أثناء عملية الإعادة',
                    'status' => 500,
                    'data' => 'لم يتم تحديث البيانات'
                ];
            }
        }
    }


    //**________________________________________________________________________________________________
    /**
 * * delet book dataa
 * *@param $id
 * *@return array
 */

    public function deleteBook($id)
    {
        $book = Borrowrecord::find($id);

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
