<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\Note;
use App\Models\User;
use App\Policies\BookPolicy;
use App\Policies\NotePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        Book::class => BookPolicy::class,
        Note::class => NotePolicy::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('isAdminUser', function (User $user) {
            return $user->userType == "admin";
        });
    }
}
