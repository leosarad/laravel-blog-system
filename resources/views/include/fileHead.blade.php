<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Blog</title>    
    <link rel='stylesheet' href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('/css/quill.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome/css/font-awesome.min.css')}}">