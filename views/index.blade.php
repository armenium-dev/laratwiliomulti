@extends('layouts.app')
<link rel="stylesheet" href="{{ url('vendor/laratwiliomulti/css/frontend.css') }}">
@section('content')
    <section class="content-header">
        <h1>LaraTwilioMulti Settings</h1>
    </section>

    <div class="content">
        @include('flash::message')

        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body">
                <ul class="settings">
                @if($settings)
                    @foreach($settings as $setting)
                        <li class="item">
                            {!! Form::open(['route' => ['laratwiliomultisettings.destroy', $setting->id], 'method' => 'delete']) !!}
                            {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                            {!! Form::close() !!}
                            <a href="{!! route('laratwiliomultisettings.edit', ['id' => $setting->id]) !!}" class="edit">
                                <i class="fa fa-user icon"></i>
                                <span class="title">{{$setting->name}}</span>
                                <span class="status @if($setting->active)active @endif">Status <i class="fa fa-check"></i></span>
                            </a>
                        </li>
                    @endforeach
                @endif
                    <li class="item add-new">
                        <a href="{!! route('laratwiliomultisettings.create') !!}">
                            <i class="fa fa-plus icon"></i>
                            <span class="title">Add new</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
