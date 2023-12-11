@extends('layouts.app')

@section('stylesheet')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Page - Edit
                </div>

                <div class="card-body">
                    {!! Form::open(['route' => ['pages.update', $page->id], 'method' => 'put']) !!}

                    <div class="form-group @if($errors->has('thumbnail')) has-error @endif">
                        {!! Form::label('Thumbnail') !!}
                        {!! Form::text('thumbnail', $page->thumbnail, ['class' => 'form-control', 'placeholder' =>
                        'Thumbnail',
                        'required' => 'required']) !!}

                        @if($errors->has('thumbnail'))
                        <span class="help-block">{!! $errors->first('thumbnail') !!}</span>
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('title')) has-error @endif">
                        {!! Form::label('Title') !!}
                        {!! Form::text('title', $page->title, ['class' => 'form-control', 'placeholder' => 'Title',
                        'required'
                        => 'required']) !!}

                        @if($errors->has('title'))
                        <span class="help-block">{!! $errors->first('title') !!}</span>
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('sub_title')) has-error @endif">
                        {!! Form::label('Sub Title') !!}
                        {!! Form::text('sub_title', $page->sub_title, ['class' => 'form-control', 'placeholder' => 'Sub
                        Title',
                        'required'
                        => 'required']) !!}

                        @if($errors->has('sub_title'))
                        <span class="help-block">{!! $errors->first('sub_title') !!}</span>
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('details')) has-error @endif">
                        {!! Form::label('Details') !!}
                        {!! Form::textarea('details', $page->details, ['class' => 'form-control', 'placeholder' =>
                        'Details',
                        'required'
                        => 'required']) !!}

                        @if($errors->has('details'))
                        <span class="help-block">{!! $errors->first('details') !!}</span>
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('is_published')) has-error @endif">
                        {!! Form::label('Publish') !!}
                        {!! Form::select('is_published', [1 => 'publish', 0 => 'draft'], $page->is_published, ['class'
                        =>
                        'form-control']) !!}

                        @if($errors->has('is_published'))
                        <span class="help-block">{!! $errors->first('is_published') !!}</span>
                        @endif
                    </div>

                    {!! Form::submit('Update', ['class' => 'btn btn-sm btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace('details');
    $('#category_id').select2({
        placeholder: "Select Categories"
    }).val({!! json_encode($page->categories()->allRelatedIds()) !!}).trigger('change');
</script>
@endsection
