@extends('index')

@section('content')
<div class="content-page">
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Inicio</h1>
        </div>
        <indicadores-home
            {{-- :indicadores='@json($indicadores)' --}}
        ></indicadores-home>
    </div>
</div>
@endsection
