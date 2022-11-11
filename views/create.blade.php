@extends('layouts.app')
<link rel="stylesheet" href="{{ url('vendor/laratwiliomulti/css/frontend.css') }}">
@section('content')
    <section class="content-header">
        <h1>LaraTwilioMulti Add New Account</h1>
    </section>
    <div class="content">
        @include('flash::message')
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                {!! Form::open(['route' => 'laratwiliomultisettings.store', 'files' => true]) !!}
                    @include('LaraTwilioMultiViews::fields', ['mode' => 'create'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
