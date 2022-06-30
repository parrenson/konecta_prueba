@extends('index')

@section('content')
<div class="content-page">
    <div class="container-fluid">
        <inventarios-list
        :inventarios='@json($inventarios)'
        ></inventarios-list>
    </div>
</div>
@endsection
