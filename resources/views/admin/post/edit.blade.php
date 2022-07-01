@extends('admin.layouts.main')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Панель управления</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Главная</a></li>
                        <li class="breadcrumb-item active">Посты</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                    <div class="card-body">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Редактирование поста</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('admin.post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="post_title">Название</label>
                                        <input id="post_title"
                                               name="title"
                                               type="text"
                                               class="form-control{{ $errors->has('title') ? ' is-invalid' : ''}}"
                                               placeholder="Заголовок поста"
                                               value="{{ $post->title }}"
                                        >
                                        @error('title')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Выберите категорию</label>
                                        <select class="form-control" name="category_id">
                                            @foreach($categories as $category)
                                                <option
                                                    value="{{ $category->id }}"
                                                    {{ $category->id == $post->$category ? 'selected' : '' }}
                                                >
                                                    {{ $category->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Тэги</label>
                                        <select
                                            class="select2"
                                            name="tag_ids[]"
                                            multiple="multiple"
                                            data-placeholder="Выберите тэги"
                                            style="width: 100%;">
                                            @foreach($tags as $tag)
                                                <option
                                                    {{ is_array( $post->tags->pluck('id')->toArray()) && in_array($tag->id, $post->tags->pluck('id')->toArray()) ? 'selected' : '' }}
                                                    value="{{ $tag->id }}"
                                                >
                                                    {{ $tag->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="w-25">
                                            <img class="w-50" src="{{ Storage::url($post->main_image) }}" alt="main_image">
                                        </div>
                                        <label for="exampleInputFile">Главное изображение</label>
                                        <div class="input-group {{ $errors->has('main_image') ? ' is-invalid' : ''}}">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="main_image"
                                                       name="main_image">
                                                <label class="custom-file-label" for="main_image">Выберете
                                                    изображение</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Загрузить</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="w-25">
                                            <img class="w-50" src="{{ url('storage/'.$post->preview_image) }}" alt="preview_image">
                                        </div>
                                        <label for="exampleInputFile">Превью изображение</label>
                                        <div
                                            class="input-group  {{ $errors->has('preview_image') ? ' is-invalid' : ''}}">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="preview_image"
                                                       name="preview_image">
                                                <label class="custom-file-label" for="preview_image">Выберете
                                                    изображение</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Загрузить</span>
                                            </div>
                                        </div>
                                        @error('preview_image')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <textarea
                                            id="summernote"
                                            name="content"
                                            class="form-control{{ $errors->has('content') ? ' is-invalid' : ''}}"
                                        >
                                            {{ $post->content }}
                                        </textarea>
                                        @error('content')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Обновить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
