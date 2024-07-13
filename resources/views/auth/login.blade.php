<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Логин</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

@include('header')
<script src="{{asset('js/login.js')}}"></script>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="mb-3">
                <label for="login" class="form-label">Логин</label>
                <input type="text" class="form-control" id="login" placeholder="Введите логин">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" class="form-control" id="password" placeholder="Введите пароль">
            </div>
            <button type="submit" class="btn btn-primary" id="submit_login">Войти</button>
        </div>
    </div>
</div>


