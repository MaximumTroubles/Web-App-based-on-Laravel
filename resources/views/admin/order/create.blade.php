@extends('admin.layouts.index')
@section('content')
    <h2>Добавить заказ</h2>
    @include('messages.errors')
    {!! Form::open(['url' => '/admin/order', 'files' => true ])!!}
        @include('admin/order/_form')
    {!! Form::close() !!}

@endsection
@section('js')
    {{-- CKeditor --}}
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    {{-- Stand alone button --}}
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>


    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };
        CKEDITOR.replace('description', options);
        $('#lfm').filemanager('image')
    </script>
@endsection
