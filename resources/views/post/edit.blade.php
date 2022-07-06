@extends('layouts.app')
@section("content")

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('post.index') }}">Post</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Post</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <h4>Edit New Post</h4>
            <hr>
            <form action="{{ route('post.update',$post->id) }}" method="post" id="postUpdateForm" enctype="multipart/form-data">
                @csrf
                @method('put')
            </form>
                <div class="mb-3">
                    <label class="form-label" for="title">Post Title</label>
                    <input
                        type="text"
                        value="{{ old('title',$post->title) }}"
                        class="form-control @error('title') is-invalid @enderror"
                        name="title"
                        id="title"
                        form="postUpdateForm"
                    >
                    @error("title")
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="category">Select Category</label>
                    <select
                        type="text"
                        class="form-select @error('category') is-invalid @enderror"
                        name="category"
                        id="category"
                        form="postUpdateForm"
                    >
                        @foreach(\App\Models\Category::all() as $category)
                            <option
                                value="{{ $category->id }}"
                                {{ $category->id == old('category',$post->category) ? 'selected':'' }}>
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                    @error("category")
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="mb-2 d-flex">
                        @foreach($post->photos as $photo)
                            <div class=" position-relative me-2">
                                <img src="{{ asset('storage/'.$photo->name) }}" height="100" class="rounded" alt="">
                                <form action="{{ route('photo.destroy',$photo->id) }}" class="d-inline-block " method="post">
                                    @csrf
                                    @method("delete")
                                    <button class="btn btn-sm btn-danger position-absolute bottom-0 end-0">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                    <div class="">
                        <label class="form-label" for="photos">Post Photo</label>
                        <input
                            type="file"
                            class="form-control @error('photos') is-invalid @enderror @error('photos.*') is-invalid @enderror"
                            name="photos[]"
                            id="photos"
                            multiple
                            form="postUpdateForm"
                        >
                        @error("photos")
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @error("photos.*")
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="description">Post Description</label>
                    <textarea
                        type="text"
                        class="form-control @error('description') is-invalid @enderror"
                        rows="10"
                        name="description"
                        id="description"
                        form="postUpdateForm"
                    >{{ old('description',$post->description) }}</textarea>
                    @error("description")
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-between">
                    <div class="d-flex">
                        @isset($post->featured_image)
                            <img src="{{ asset("storage/".$post->featured_image) }}" height="70" class="rounded me-3" alt="">
                        @endisset
                        <div class="">
                            <label class="form-label" for="featured_image">Feature Image</label>
                            <input
                                type="file"
                                class="form-control @error('featured_image') is-invalid @enderror"
                                name="featured_image"
                                id="featured_image"
                                form="postUpdateForm"
                            >
                            @error("featured_image")
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button class="btn btn-lg btn-primary" form="postUpdateForm">Update Post</button>
                </div>
        </div>
    </div>
@endsection
