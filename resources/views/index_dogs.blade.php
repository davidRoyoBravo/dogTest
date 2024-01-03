@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Dogs</div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
            <div class="card-footer">
                <a href="{{route('dog.create')}}">Create new Dog</a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
