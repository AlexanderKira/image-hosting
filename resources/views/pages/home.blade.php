@extends('layouts.app')

@section('title')
    Главная страница
@endsection
@section('content')
    <x-image.image_upload_form/>
    <div class="d-flex justify-content-center">
        {{ $images->links() }}
    </div>
        <div class="album py-5 bg-body-tertiary">
            <div class="container">
                <x-image.images_search/>
                @if($images->total() > 0)
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach($images as $key => $image)
                        <div class="col">
                            <div class="card shadow-sm img-thumbnail">
                                <img src="{{ $image->preview_path }}" alt="{{ $image->title }}" data-bs-toggle="modal" data-bs-target="#imageModal{{ $key }}">
                                <div class="text-center">
                                    <div class="blog-post-meta">{{ $image->title }}</div>
                                    <div class="blog-post-meta">{{ $image->created_at }}</div>
                                    <form action="{{ route('image.download', ['image' => $image->id]) }}" method="post">
                                        @csrf
                                        <input type="submit" class="btn btn-success col-8 w-100 h-100" value="Скачать">
                                    </form>
                                    <form action="{{ route('image.delete', ['image' => $image->id]) }}" method="post">
                                        @csrf
                                        <input type="submit" class="btn btn-light col-8 w-100 h-100" value="Удалить">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal window for viewing an image -->
                        <div class="modal fade" id="imageModal{{ $key }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $key }}" aria-hidden="true">
                            <div class="modal-dialog modal-fullscreen">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{ $image->path }}" class="img-fluid" alt="{{ $image->title }}" style="width: 100vw; height: 100vh; object-fit: contain;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
    <div class="album py-5 bg-body-tertiary">
        <div class="container">
            <h2 class="fw-light text-center text-secondary">Нет изображений</h2>
        </div>
    </div>
    @endif
    <div class="d-flex justify-content-center">
        {{ $images->links() }}
    </div>
@endsection
