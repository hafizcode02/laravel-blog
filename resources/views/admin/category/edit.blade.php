@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Category - Edit
                </div>

                <div class="card-body">
                    {!! Form::open(['route' => ['categories.update', $category->id], 'method' => 'put']) !!}

                    <div class="form-group @if($errors->has('thumbnail')) has-error @endif">
                        {!! Form::label('Thumbnail') !!}
                        {!! Form::text('thumbnail', $category->thumbnail, ['class' => 'form-control', 'placeholder' =>
                        'Thumbnail',
                        'required' => 'required']) !!}
                        @if($errors->has('thumbnail'))
                        <span class="help-block">{!! $errors->first('thumbnail') !!}</span>
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('name')) has-error @endif">
                        {!! Form::label('Name') !!}
                        {!! Form::text('name', $category->name, ['class' => 'form-control', 'placeholder' => 'Name',
                        'required' =>
                        'required']) !!}
                        @if($errors->has('name'))
                        <span class="help-block">{!! $errors->first('name') !!}</span>
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('thumbnail')) has-error @endif">
                        {!! Form::label('Publish') !!}
                        {!! Form::select('is_published', [1 => 'publish', 0 => 'draft'], isset($category->is_published)
                        ? $category->is_published : null ,
                        ['class' =>
                        'form-control']) !!}
                        @if($errors->has('is_published'))
                        <span class="help-block">{!! $errors->first('is_published') !!}</span>
                        @endif
                    </div>

                    {!! Form::submit('Update', ['class' => 'btn btn-sm btn-warning']) !!}
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
