<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = $request->input('title');
        $filter = $request->input('filter', '');

        // Start building the query
        $booksQuery = Book::query()->when($title, fn($query, $title) => $query->title($title));

        // Apply the filter directly to the query
        if ($filter) {
            switch ($filter) {
                case 'PopularLastMonth':
                    $booksQuery->popularLastMonth();
                    break;
                case 'PopularLast6Months':
                    $booksQuery->popularLast6Months();
                    break;
                case 'HighestRatedLastMonth':
                    $booksQuery->highestRatedLastMonth();
                    break;
                case 'HighestRatedLast6Months':
                    $booksQuery->highestRatedLast6Months();
                    break;
                default:
                    // No action needed for unexpected filter values
                    break;
            }
        }

        // Get the filtered books collection
        $books = $booksQuery->get();

        return view('book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Logic for displaying the form to create a new book
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Logic for storing a new book
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Logic for displaying a specific book
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Logic for displaying the form to edit a specific book
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Logic for updating a specific book
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Logic for removing a specific book
    }
}