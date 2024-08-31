<?php
namespace App\Service;

use App\Models\Book;
use Exception;

class BookService
{
    /**
        * * creat book
        * *@param array $data
        * *@return array(message,status,data)
    */
    public function createBook($data)
    {
        try {
            $book = Book::create($data);
            return [
                'message' => 'تمت عملية الإضافة بنجاح',
                'data' => $book,
                'status' => 201,
            ];
        } catch (Exception $e) {
            return [
                'message' => 'حدث خطأ أثناء الإضافة: ',
                'data' => null,
                'status' => 500,
            ];
        }
    }
    //**________________________________________________________________________________________________
    /**
     * * update book data
     * **@param array $data
     * **@param $id
     * **@return array(message,status,data)
     */

    public function updateBook($newData, $id)
    {
        $book = Book::find($id);

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

    //**________________________________________________________________________________________________
    /**
     * * show book data
     * **@param $id
     * **@return array(message,status,data)
     */
    public function ShowBook($id)
    {
        // find book
        $book = Book::find($id);
        //check that book exists
        $book = Book::find($id);

        if (!$book) {
            return [
                'message' => 'الكتاب غير موجود',
                'status' => 404,
                'data' =>'لا يوجد بيانات'
            ];
        } else {

            try {
               
                return [
                    'message' => 'بيانات الكتاب',
                    'data' => $book,
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

    //**________________________________________________________________________________________________

    /**
 * * delet book dataa
 * *@param $id
 * *@return array
 */
    public function deleteBook($id)
    {
        // find book
        $book = Book::find($id);
        //check that book exists
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
