<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Поиск книги</title>
</head>

@include('header')
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
            <form action="{{ route('search.results') }}" method="GET" class="d-flex">
                <input class="form-control me-2" type="text" name="query" placeholder="Знайти книгу по автору та назвi"
                       aria-label="Search">
                <button class="btn btn-primary" type="submit">Поиск</button>
            </form>
        </div>
    </div>
</div>


