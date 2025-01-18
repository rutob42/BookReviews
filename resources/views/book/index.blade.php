@extends('layouts.app')

@section('content')
   <h1 class="mb-10 text-2xl">BOOKS</h1>

   <form method="GET" action="{{ route('books.index') }}" class="mb-4 flex gap-2 h-10" >
      <input type="text" placeholder="Search by title" name="title" class="input" value="{{ request('title') }}"/>
      <input type="hidden" name="filter" value="{{request('filter')}}"/>
      <button class="btn" type="submit">Search</button>
      <a href="{{ route('books.index') }}" class="btn">Clear</a>
   </form>

   <div class="flex space-x-2 mb-4 rounded-md bg-slate-100 p-2">
    @php
    $filters = [
        '' => 'latest',
        'PopularLastMonth' => 'popular last month',
        'PopularLast6Months' => 'popular last 6 months',
        'HighestRatedLastMonth' => 'highest rated last month',
        'HighestRatedLast6Months' => 'highest rated last 6 months',
    ];
    @endphp

    @foreach($filters as $key => $label)
        <a href="{{ route('books.index', [...request()->query(), 'filter' => $key]) }}" 
           class="{{ request('filter') === $key || (request('filter') === null && $key === '') ? 'filter-item-active' : 'filter-item' }}">
            {{ $label }}
        </a>
    @endforeach
</div>
   <ul>
      @forelse($books as $book)
               <li class="mb-4">
            <div class="book-item">
               <div
                  class="flex flex-wrap items-center justify-between">
                  <div class="w-full flex-grow sm:w-auto">
                  <a href="{{ route('books.show', $book->id )}}" class="book-title">{{$book->title}}</a>
                  <span class="book-author">{{$book->author}}</span>
                  </div>
                  <div>
                  <div class="book-rating">
                     {{number_format($book->reviews->avg('rating'), 1)}}
                  </div>
                  <div class="book-review-count">
                     out of 5 reviews
                  </div>
                  </div>
               </div>
            </div>
            </li>
      @empty
            <li class="mb-4">
               <div class="empty-book-item">
                  <p class="empty-text">No books found</p>
                  <a href="{{route('books.index')}}" class="reset-link">Reset criteria</a>
               </div>
            </li>
      @endforelse
   </ul>
@endsection