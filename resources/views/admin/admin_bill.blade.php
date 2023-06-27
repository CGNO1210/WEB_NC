@extends('layouts.client')
@section('back')
    <a href="/admin" class="btn btn-primary" style="margin-left: 8px">Back</a>
@endsection
@section('style')
    <link rel="stylesheet" href="/css/admin_course_style.css">
@endsection
@section('sidebar')
    @include('partials.admin_sidebar')
@endsection
@section('content')
    <button class="btn btn-primary mb-3 mt-3">Thêm hóa đơn</button>
    <div class="table-responsive">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name course</th>
                    <th scope="col">Chương</th>
                    <th scope="col">Bài học</th>
                    <th scope="col">Tổng thời lượng</th>
                    <th scope="col">Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < 7; $i++)
                <tr>
                    <td>asa</td>
                    <td>asdasd</td>
                    <td>sdkksdn</td>
                    <td>qqpoqal</td>
                    <td>vnlxz</td>
                    <td>
                        <a href="" class="btn btn-secondary">Edit</a>
                        <a href="" class="btn btn-danger" >Delete</a>
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>
@endsection