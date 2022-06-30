@extends('index')

@section('content')
<div class="content-page">
    <div class="container-fluid">
        <ventas-list
        :inventarios='@json($inventarios)'
        ></ventas-list>
    </div>
</div>
@endsection
