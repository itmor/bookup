<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Книга</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>


@include('header')
<link href="{{ asset('css/show_book.css') }}" rel="stylesheet">
<script src="{{asset('js/add_rate.js')}}"></script>
<div class="show-book">
    <h6>{{ $book->title }}</h6>
    <p>Author: {{ $book->author }}</p>
    <img class="show-book__preview" src="data:image/jpeg;base64,{{ $book->getPreviewBase64() }}" alt="{{ $book->name }}"
         width="200">
    <p>Added on: {{ $book->created_at }}</p>

    @if ($averageRating > 0)
        <p>Рейтинг: {{ $averageRating }}/5</p>
    @else
        <p>Нет рейтинга</p>
    @endif

    @php
        $hasUserRate = $book->hasUserRate();
    @endphp

    @if ($hasUserRate === true)
        Ви вже поставили оцiнку
    @elseif ($hasUserRate === null)
        Увiйдiть для того щоб поставить оцiнку
    @else
        <div class="book__rate">
            <select id="rate" class="form-select show-book__rate-select" aria-label="1" data-book-id="{{ $book->id }}">
                <option selected>Виберiть оцiнку</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>

            <button id="submit_rate" type="button" class="btn btn-primary">Поставити оцiнку</button>
        </div>
    @endif
</div>



