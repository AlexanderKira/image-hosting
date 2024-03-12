@extends('layouts.app')

@section('title')
    Главная страница
@endsection
@section('content')
    <x-image.image_upload_form/>
    <x-image.images/>
@endsection
