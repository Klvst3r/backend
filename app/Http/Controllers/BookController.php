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
        //return ['Klvst3r'];
        /*Devolver todos los libros de la BD*/
        
        //En lugar del metodo all() utilizar paginate()
        return Book::all();
       
        //Paginar los recursos 
        //return Book::paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => ['required']

        ]);


        //return  'post';
        //return $request->all();
        //return $request;
        $book = new Book; //Nueva instancia de Eloquent 
        $book->title = $request->input('title'); //obtencion de los datos
        //$book->title = $request->name; //Se puede directamente tambien
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
        //return Book::find($book);
        
        //return Book::find(1);
        
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
        //return 'patch';
        
        

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
        return 'detele';
    }
}
