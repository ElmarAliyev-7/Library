<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Http\Service\BookService;
use App\Models\Book;

class BookController extends Controller
{
    private $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): \Illuminate\Http\Response
    {
        $data = Book::query()
            ->select('id', 'title', 'about', 'count', 'publishing_at', 'company_id')
            ->with('company:id,name,about,email')
            ->fastPaginate();

        return response([
            'message' => 'Books data retrieved successfully',
            'books' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request): \Illuminate\Http\Response
    {
        $request->merge([
            "company_id" => $request->user('company')
        ]);

        return response([
            "message" => "Book Store successfully",
            "data" => Book::query()->create($request->only('company_id', 'title', 'about', 'count', 'publishing_at'))
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book): \Illuminate\Http\Response
    {
        return response([
            'message' => 'Book data retrieved successfully',
            'data' => $book->load([
                'company:id,name,about',
                'authors:id,name,surname'
            ])
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, int $id): \Illuminate\Http\Response
    {
        $this->bookService->getBook([
            'id' => $id,
            'company_id' => auth('company')->id()
        ])->update($request->validated());

        return response([
            "message" => "Book Update successfully",
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id): \Illuminate\Http\Response
    {
        $this->bookService->getBook([
            'id' => $id,
            'company_id' => auth('company')->id()
        ])->delete();

        return response([
            'message' => 'Book deleted successfully',
        ], 200);
    }
}
