<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Traits\CanLoadRelationships;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BookController extends Controller
{
    use CanLoadRelationships, AuthorizesRequests;
    private array $relations = ['user', 'notes'];


    public function __construct()
    {
        // $this->authorizeResource(Book::class, 'book');
    }

    /**
     * 
     * Display a listing of the resource.
     */
    public function index()
    {

        try {
            // $this->authorize('viewAny');
            $user = request()->user();
            $query = $this->loadRelationships(Book::where('user_id', $user->id));
            return BookResource::collection($query->latest()->get());
        } catch (AuthorizationException $e) {
            // Authorization failed, return a custom error message
            return response()->json(['error' => 'You are not authorized to view this book'], 403);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        // $this->authorize('create', $book);
        $book = Book::create([...$request->validated(), 'user_id' => $request->user()->id]);
        return new BookResource($book);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        try {
            $this->authorize('view', $book);
            $query = $this->loadRelationships($book);
            return new BookResource($query);
        } catch (AuthorizationException $e) {
            // Authorization failed, return a custom error message
            // dd($e);
            return response()->json(['error' => 'You are not authorized to view this book'], 403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, Book $book)
    {
        try {
            $this->authorize('update', $book);
            $book->update($request->validated());
            return new BookResource($book);
        } catch (AuthorizationException $e) {
            // Authorization failed, return a custom error message
            // dd($e);
            return response()->json(['error' => 'You are not authorized to update this book'], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        try {
            $this->authorize('delete', $book);
            $book->delete();
            return response()->json([
                "message" => "Book deleted successfully"
            ], 204);
        } catch (AuthorizationException $e) {
            // Authorization failed, return a custom error message
            // dd($e);
            return response()->json(['error' => 'You are not authorized to delete this book'], 403);
        }
    }
}
