@extends('adminlte.master.master')
@section('content')
    <section class="content-header">
        <h1>
            @lang('pos.dasboard')
            <small>@lang('pos.Control panel')</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>  @lang('pos.home')</a></li>
            <li class="active"> @lang('pos.dasboard')</li>
        </ol>
    </section>


@endsection