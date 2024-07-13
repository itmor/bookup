<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiHttpException;
use App\Helpers\FileHelper;
use App\Models\Book;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{

    public function showAddBookForm()
    {
        return view('book.add_book');
    }

    public function addBook(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'preview_image' => 'required|string'
        ]);

        try {
            DB::beginTransaction();
            $storageId = FileHelper::add($request->input('preview_image'));

            Book::create([
                'title' => $request->input('title'),
                'author' => $request->input('author'),
                'storage_id' => $storageId
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }


        return response()->json(['message' => 'ok']);
    }

    public function show(int $id)
    {
        $book = Book::find($id);

        if (!$book) {
            abort(404);
        }

        // TODO отрефакторить там не должно быть $book->averageRating() вычисляем сразу
        $averageRating = $book->averageRating();

        return view('book.show', compact('book', 'averageRating'));
    }


    public function addRateToBook(Request $request)
    {
        $request->validate([
            'rate' => 'required',
            'book_id' => 'required',
        ]);

        $book = Book::findOrFail($request->input('book_id'));

        if (!$book) {
            throw new ApiHttpException(404, 'Книга не знайдена');
        }

        if ($book->hasUserRate()) {
            throw new ApiHttpException(404, 'Ви вже ставили оцiнку книзi');
        }

        Rating::create([
            'book_id' => $book->id,
            'rate' => $request->input('rate'),
            'user_id' => Auth::id()
        ]);
    }

    public function showSearchForm()
    {
        return view('book.search');
    }

    public function search(Request $request)
    {
        $query = $request->query('query');

        $books = Book::where('author', 'like', "%$query%")
            ->orWhere('title', 'like', "%$query%")
            ->get();

        return view('book.search_results', compact('books', 'query'));
    }


    public function getNewBooks($id)
    {
        $newBooks = Book::where('id', '>', $id)->take(10)->get();

        $newBooks = $newBooks->map(function ($book) {
            $bookArray = $book->toArray();
            unset($bookArray['storage_id']);
            $bookArray['preview_image'] = $book->getPreviewBase64();
            return $bookArray;
        });

        return response()->json(['new_books' => $newBooks]);
    }

}
