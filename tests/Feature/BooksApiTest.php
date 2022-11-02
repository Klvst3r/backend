<?php

namespace Tests\Feature;

use App\Models\Book;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BooksApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */

    function can_get_all_books()
    {

        /*$book = Book::factory()->create();

        dd($book);*/

        //Multiples libros
        
        $books = Book::factory(4)->create();

        //dd($books->count()); //Se cuentan los libros
        
        //$this->get('/api/books')->dump();
        
       /* dd(route('books.index'));

        $this->get(route('books.index'))->dump();*/

       // Obtener JSON con getJson
          
          $response = $this->getJson(route('books.index'));

          //Para verificar el fragmento de JSON pasamos un array esperando que en la respuesta vemos un lirbo con el titulo del primer libro
        
        $response->assertJsonFragment([
            'title' => $books[0]->title
        ])->assertJsonFragment([
            'title' => $books[1]->title
        ]);
        
    }
}
