<?php

namespace Tests\Feature;

use App\Models\Book;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BooksApiTest extends TestCase
{
    use RefreshDatabase;

    function can_get_all_books()
    {

        $books = Book::factory(4)->create();

        //dd($book);
        //dd($books->count());
        

        $this->get('/api/books')->dump();
    }
}
