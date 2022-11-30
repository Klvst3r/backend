<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*1. Regresar todos los libros
            Book: Es el modelo de Eloquent para interacturar con la BD
            */
        //return Book::all();

        /*2. Podemos devolver un array vacio convirtiendo el resultado a JSON
        Ej.
        return ['Klvst3r'];
        */
        //return ['Klvst3r'];
        
        /* Paginacion*/
        //return Book::paginate();
        /*4. Se vicualizaran todos los libros de momento       */
       //return Book::all();
       
       //Si esta vacio el index que visualice un arreglo 
       
      /* $books = [
        'uno',
        'dos',
        'tres'
       ];
       return $books;*/
       
       //5. una modificación
       return Book::all();

       //6. Localizar un libro, generara un error
       //return Book::find(1);

            

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //1. Retornamos algo para verificar que estamos accediento a los datos con el metodo POST
        //return 'POST by Klvst3r';
        

        //2. De momento para instpeccionar el request vamos a retornarlo directamente 
        //return $request->all();

        //3. Se puede retornar directamente
        //return $request;
        

        //5. Validamos antes de crear un nuevo libro
        $request->validate([
            'title' => ['required']

        ]);

        //4. Creamos un nuevo libro
        $book = new Book; //Nueva instancia de Eloquent 
        
        $book->title = $request->input('title'); //obtencion de los datos en este caso del titulo
        
        $book->save(); //Se guarda el valor en la BD

        return $book; //Se devuelve el valor del libro
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //1 Regresando un libro
        return $book;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //1. Mensaje del Patch
        //return 'PATCH by Klvst3r';
        

        /* Actualización de datos*/ 

        //return $book;

        //return $book; Obtener el ID
        $request->validate([
            'title' => ['required']

        ]);

        $book->title = $request->input('title'); //obtencion de los datos
        $book->save(); //Se guarda el valor en la BD

        

        return $book; //Se devuelve el valor del libro
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //1. Mensaje del Verbo delete
        //return 'Delete by Klvst3r';
        $book->delete();

        return response()->noContent();
        
    }
}
