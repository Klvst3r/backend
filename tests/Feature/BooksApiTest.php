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

        //1. Un registro en la BD
        //$book = Book::factory()->create();

        //dd($book); //dom by die o dye dom para inspeccionar este libro
        
        //2. Multiples registros en la BD
        //$books = Book::factory(4)->create();
        //dd($books->count()); //Inspeccion de multiples inserciones

        //3. Se hace un peticion de tipo GET
        //$books = Book::factory(4)->create();
        //$this->get('/api/books')->dump(); //Se inspecciona la respuesta

        //4. Utilizando un nombre de ruta
        /*$books = Book::factory(4)->create();
        dd(route('books.index'));
        $this->get(route('books.index'))->dump();*/

        //5. Devolviendo un Fragmento con JSON con el primer resultado
        /*
        $books = Book::factory(4)->create();
        
        $response = $this->getJson(route('books.index'));

         $response->assertJsonFragment([
            'title' => $books[0]->title
        ]);
        */

        //6. Devolviendo dos libros de un Fragmento con JSON 
        $books = Book::factory(4)->create();
        
        /*$response = $this->getJson(route('books.index'));

         $response->assertJsonFragment([
            'title' => $books[0]->title
        ])->assertJsonFragment([
            'title' => $books[1]->title
        ]);*/


        //Seccion C

        //C.1 Modificamos el codigo anterior quedando de la siguiente manera
            $this->getJson(route('books.index'))
                ->assertJsonFragment([
                    'title' => $books[0]->title
                ])->assertJsonFragment([
                    'title' => $books[1]->title
                ]);
        //Posterior a esto se hace la ejecución de pruebas de test, parece que se continua en verde.
        
    }


     /** @test */

    function can_get_one_book()
    {
        //1.//Se crea un libro con factory
        /*
        $book = Book::factory()->create();

         //Un getJson a la ruta books.show, para que genere la ruta. 
        dd(route('books.show', $book)); 
        //Guardando la respuesta 
        $response->$this->getJson(route('books.show', $book));
        //Generamos la verificación
        $response->assertJsonFragment([
            'title' => $book->title
        ]); */


        //B.2. La reestructuración 
        // 
          $book = Book::factory()->create();


        //dd(route('books.show', $book)); 
        //Guardando la respuesta 
        // B.2.1. pidria ser que el  response lo estamos utilizando una sola vez, para que quede en una sola linea
        //Pasamos a la seccion C en el metodo "can_get_all_books"
        $this->getJson(route('books.show', $book))
            ->assertJsonFragment([
            'title' => $book->title
        ]);





    }

    /** @test */

    function can_create_books()
    {
        
        //2. Utilizamos un test de regresión para hacerlo falla, mediante el metodo asserJsonValidationErrorFor
        //donde enviamos un PostJson y esperamos un error de validación en el campo title 
        //es importante enviar un Json para recibir un JSON
        $this->postJson(route('books.store'),[])
        ->assertJsonValidationErrorFor('title');


        //1. No necesitamos un libro que exista en la Bd a la ruta books.store, y como segundo parametro 
        //el primer parametro es la URL, el segundo parametro son los datos que vamos a enviar. en este caso un titulo y un nuevo libro 
        //Esperando un fragmento como respuesta que contenga el mismo valor

        $this->postJson(route('books.store'), [
            'title' => 'My new book'
        ])->assertJsonFragment([
            'title' => 'My new book'
         ]);

        //Este metodo recibe un primer parametro books y como segundo parametro recibe un array con los datos a verificar
        $this ->assertDatabaseHas('books', [
           'title' => 'My new book' 
        ]);

    }
    
    /** @test */

    function can_update_books()
    {
       $books = Book::factory()->create(); 


       //VErifiacion de la validación
       $this->patchJson(route('books.update', $books),[])
        ->assertJsonValidationErrorFor('title');  

       

       $this->patchJson(route('books.update', $books), [
            'title' => 'Edited book'
       ])->assertJsonFragment([
            'title' => 'Edited book'
       ]);


       //Verificamos en la base de datos la existencia
       $this->assertDatabaseHas('books', [
             'title' => 'Edited book'
       ]);
    }



    /** @test */

    function can_delete_books()
    {
        //1. Es necesario un libro para eliminar
        $book = Book::factory()->create();

        //1.1. Delete Json a la ruta book.destroy, pasandole el libro como parametro, para que genere la ruta
        //Al final vamos a esperar nocontent es decir el status 204
        $this->deleteJson(route('books.destroy', $book))
        ->assertNoContent();

        //1.2 Finalmente podemos hacer una verificación en la BD con assertDatabaseCount
        //Diciendole que en la tabla Books, tenemos cero registro 
        //Hay que tener en cuneta que cuando utilizamos refreshdatabase, cada vez que se ejecuta un test 
        //Se ejecuta el refresco de la base de dato y cada test comienza con una BD en blanco.
        //Este test comienza con un aBd en blanco, se crean cuatro registros, luego se vuelve a refrescar la BD 
        //Va con el segundo donde verifica que solo hay un libro se ejecuta el test, luego se vuelve a refrescar la BD
        //Va con el siguiente y asi sucesivamente.
        //entonces al momento de llega a este delete  "can_delete_books", solo tendremos un libro y al mometno de eliminarlo no va haber ninguno en la base de datos.
        //Entonces lo ejecutamos y verificamos si funciona.
         
        $this->assertDatabaseCount('books', 0);
    }



    //Ahora que tenemos todas las pruebas en verde podriamos hacer unas reestructuraciones.
    //Por ejemplo vamosnos al metodo "can_get_one_book" siendo la seccion 2.
    

}
