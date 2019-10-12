@extends('adminlte.master.master')
@section('content')

        <section class="content-header">



            <h1>
                @lang('pos.categories')
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.categories.index')}}"><i class="fa fa-dashboard"></i>  @lang('pos.home')</a></li>
                <li><a href="{{route('dashboard.categories.index')}}"> @lang('pos.categories')</a></li>

                <li class="active">   {{isset($category)?trans('pos.update'):trans('pos.create')}}</li>
            </ol>
        </section>

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">{{isset($category)?trans('pos.update'):trans('pos.create')}}</h3>

                    </div>
                    @include('adminlte.master.messageserror')
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <form role="form" id="ad" method="post"  action="{{isset($category)?'/dashboard/categories/update/'.$category->id:'/dashboard/categories/create'}}">
                            @csrf
                            <div class="box-body">
{{--                                config('locales')=== local=['ar','en]--}}
                                @foreach(config('translatable.locales') as $locale)
                                    <div class="form-group">
                                        <label for="name">@lang('pos.'.$locale.'.name')</label>
{{--                                        <input type="text" class="form-control"   name="name" id="name" required value="{{isset($category)?$category->name:''}}"  placeholder="@lang('pos.name')">--}}
                                        <input type="text" class="form-control"   name="{{$locale}}[name]" id="name" required value="{{isset($category)?$category->name:old($locale.'.name')}}"  placeholder="@lang('pos.'.$locale.'.name')">
                                    </div>
                                @endforeach

                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">{{isset($category)?trans('pos.update'):trans('pos.add')}}</button>
                            </div>
                        </form>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>



@endsection