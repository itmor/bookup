<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Знайденi книги</title>
</head>

@include('header')
<link href="{{ asset('css/index.css') }}" rel="stylesheet">

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Результаты поиска по запросу "{{ $query }}"</h1>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        @if($books->isEmpty())
            <div class="col-12">
                <p>Книг не знайдено</p>
            </div>
        @else
            @foreach($books as $book)
                <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="book">
                        <a class="book__link" href="/book/{{$book->id}}"></a>
                        <div>
                            <img src="data:image/jpeg;base64,{{ $book->getPreviewBase64() }}" alt="{{ $book->name }}"
                                 width="100%">
                        </div>
                        <div>Ім'я: {{ $book->title }}</div>
                        <div>Автор книги: {{ $book->author }}</div>
                        <div>Дата: {{ $book->created_at }}</div>
                        @php
                            $averageRating = $book->averageRating();
                        @endphp
                        @if ($averageRating > 0)
                            <div>Рейтинг: {{ $averageRating }}/5</div>
                        @else
                            <div>Рейтинг вiдсутнiй</div>
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>


