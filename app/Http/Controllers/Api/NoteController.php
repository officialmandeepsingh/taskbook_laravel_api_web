<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NoteRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\NotesResource;
use App\Models\Book;
use App\Models\Note;
use App\Traits\CanLoadRelationships;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    use CanLoadRelationships, AuthorizesRequests;

    private array $relations = ['user', 'book'];

    /**
     * Display a listing of the resource.
     */
    public function index(Book $book)
    {
        // dd($book->notes());
        // return NotesResource::collection($book->notes()->latest()->get());


        try {
            $this->authorize('viewAny', $book);
            $user = request()->user();
            $query = $this->loadRelationships(Note::where('user_id', $user->id)->where('book_id', $book->id));
            return $query->latest()->get();
        } catch (AuthorizationException $e) {
            // Authorization failed, return a custom error message
            return response()->json(['error' => 'You are not authorized to view this note'], 403);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NoteRequest $noteRequest, Book $book, Note $note)
    {

        $note = Note::create([...$noteRequest->validated(), 'user_id' => $noteRequest->user()->id, 'book_id' => $book->id]);
        return new NotesResource($note);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book, Note $note)
    {

        // $query = $this->loadRelationships($note);
        // return new NotesResource($note);
        try {
            $this->authorize('view', [$book, $note]);
            $query = $this->loadRelationships($note);
            return new NotesResource($query);
        } catch (AuthorizationException $e) {
            // Authorization failed, return a custom error message
            // dd($e);
            return response()->json(['error' => 'You are not authorized to view this note'], 403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NoteRequest $noteRequest, Book $book, Note $note)
    {
        try {
            $this->authorize('update', [$book, $note]);
            $note->update($noteRequest->validated());
            return new NotesResource($note);
        } catch (AuthorizationException $e) {
            // Authorization failed, return a custom error message
            // dd($e);
            return response()->json(['error' => 'You are not authorized to update this note'], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book, Note $note)
    {
        try {
            $this->authorize('update', [$book, $note]);
            $note->delete();
            return response()->json([
                "message" => "Note deleted successfully"
            ], 204);
        } catch (AuthorizationException $e) {
            // Authorization failed, return a custom error message
            // dd($e);
            return response()->json(['error' => 'You are not authorized to delete this note'], 403);
        }
    }
}
