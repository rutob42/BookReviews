@extends('layouts.app')

@section('content')
<h1 class="mb-10 text-2xl">Add review for {{$book->title}}</h1>
<form method="POST" action="{{ route('books.review.store', $book}}">
    @csrf
    <label for="review">Review</label>
    <textarea name="review" id="review" required class="input mb-4"></textarea>
    <label for="rating">Rating</label>
    <select name="rating" id="rating" class="input mb-4">
        <option value="">Select a rating</option>
        @for ($=1; $i < 5; $i++)
           <option value="{{$i}}">{{i}}</option>
        @endfor
    </select>

    <button type="button" class="btn">Add review</button>
</form>
@endsection