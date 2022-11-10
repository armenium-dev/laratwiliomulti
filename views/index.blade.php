@extends('layouts.app')
<link rel="stylesheet" href="{{ url('vendor/laratwiliomulti/css/frontend.css') }}">
@section('content')
    <div class="nav-tabs-custom layout">

        <div class="tab-content">

            <section class="mb-20">
                <h1 class="mb-20">LaraTwilioMulti Settings</h1>
            </section>

            <div class="clearfix"></div>

            @include('flash::message')

            <div class="clearfix"></div>

            <div class="content">
                <ul class="settings">
                @if($settings)
                    @foreach($settings as $settings)

                    @endforeach
                @endif
                    <li class="item add-new">
                        <a href="{!! route('laratwiliomultisettings.create') !!}">Add new</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
@endsection
