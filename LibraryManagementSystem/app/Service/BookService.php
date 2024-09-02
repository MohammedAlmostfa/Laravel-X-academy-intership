<?php
namespace App\Service;

use App\Models\Book;
use Exception;

class BookService
{
    public function showfilterbooks($data)
    {
        try {
   
            $query = Book::with('rating');
            // check of the parameters that user need to filter the book

            if (!empty($data['author'])) {
                $query->byAuthor($data['author']);
            }

            if (!empty($data['category'])) {
                $query->byCategory($data['category']);
            }

            if (!empty($data['case'])) {
                $query->byCase($data['case']);
            }
            // GET the book
            $books = $query->get();
            //return $books;
            return [
                'message' => 'الكتب',
                'data' => $books,
                'status' => 200,
            ];
        } catch (Exception $e) {
            return [
                'message' => 'حدث خطأ أثناء العرض: ',
                'data' => null,
                'status' => 500,
            ];
        }
    }

    //**________________________________________________________________________________________________

    /**
        * * creat book
        * *@param array $data
        * *@return array(message,status,data)
    */
    public function createBook($data)
    {
        try {
            // create book
            $book = Book::create($data);

            //reurn response
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
     * *@param array $data
     * *@param $id
     * *@return array(message,status,data)
     */
    public function updateBook($data, $id)
    {
        // find the book
        $book = Book::find($id);
        // check if the book is  excite
        if (!$book) {
            return [
                'message' => 'الكتاب غير موجود',
                'status' => 404,
                'data' =>'لا يوجد بيانات'
            ];
        } else {
            try {
                //filter null vules of data
                $filteredData = array_filter($data, function ($value) {
                    return !is_null($value);
                });
                // update data
                $book->update($filteredData);
                //reurn response wirh data
                return [
                    'message' => 'تمت عملية التحديث',
                    'data' => $book,
                    'status' => 200,
                ];
            } catch (Exception $e) {
                //reurn response
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
        try {
            // find book
            $book = Book::with('ratings')->find($id);
            //check that book exists
            if (!$book) {
                return [
                    'message' => 'الكتاب غير موجود',
                    'data' => $book,
                    'status' => 404,
                   
                ];
            } else {

               
                return [
                'message' => 'بيانات الكتاب',
                 'data' => $book,
                'status' => 200,
];
            }
        } catch (Exception $e) {
            return [
                'message' => 'حدث خطا اثناء عمليةالعرض',
                'status' => 500,
              
            ];
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
        try {
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

            
                $book->delete();

                return [
                    'message' => 'تمت عملية الحذف',
                    'data' => $book,
                    'status' => 200,
                ];
            }
        } catch (Exception $e) {
            return [
                'message' => 'حدث خطا اثناء عملية الحذف',
                'status' => 500,
                'data' => 'لم يتم حذف البيانات'
            ];
        }
    }
    







}
