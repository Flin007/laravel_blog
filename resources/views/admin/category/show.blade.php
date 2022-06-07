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
                            <li class="breadcrumb-item active">Категории</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-3">
                    <div class="col-md-12 col-xl-10">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Просмотр данных категории</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <td>id</td>
                                        <td>{{ $category->id }}</td>
                                    </tr>
                                    <tr>
                                        <td>Название</td>
                                        <td>{{ $category->title }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
