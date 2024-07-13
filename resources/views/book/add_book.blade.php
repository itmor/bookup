<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Добавление книги</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

@include('header')
<script src="{{asset('js/add_book.js')}}"></script>
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
            <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Назва книги</span>
            </div>
            <input id="title" type="text" class="form-control" placeholder="Назва" aria-label="Назва"
                   aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Автор</span>
            </div>
            <input id="author" type="text" class="form-control" placeholder="Автор" aria-label="Автор"
                   aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="preview_image">Завантажити</label>
            <input accept="image/png, image/jpeg" type="file" class="form-control" id="preview_image">
        </div>

        <button id="submit_button" type="button" class="btn btn-primary">Додати книгу</button>
        </div>
    </div>
</div>



