<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\Note;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NotePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, Book $book): bool
    {
        return $user->id == $book->user_id;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Book $book, Note $note): bool
    {
        return $user->id == $book->user_id && $book->id == $note->book_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Book $book, Note $note): bool
    {
        return $user->id == $book->user_id && $book->id == $note->book_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Book $book, Note $note): bool
    {
        return $user->id == $book->user_id && $book->id == $note->book_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Note $note): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Note $note): bool
    {
        //
    }
}
