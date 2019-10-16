@extends('adminlte.master.master')
@section('content')

        <section class="content-header">



            <h1>
                @lang('pos.clients')
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.clients.index')}}"><i class="fa fa-dashboard"></i>  @lang('pos.home')</a></li>
                <li><a href="{{route('dashboard.clients.index')}}"> @lang('pos.clients')</a></li>

                <li class="active">   {{isset($client)?trans('pos.update'):trans('pos.create')}}</li>
            </ol>
        </section>

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">{{isset($client)?trans('pos.update'):trans('pos.create')}}</h3>

                    </div>
                    @include('adminlte.master.messageserror')
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <form role="form" id="ad" method="post"  action="{{isset($client)?'/dashboard/clients/update/'.$client->id:'/dashboard/clients/store'}}" enctype="multipart/form-data">
                            @csrf

                            <div class="box-body">

                                <div class="form-group">
                                    <label for="name">@lang('pos.name')</label>
                                    <input type="text" class="form-control"   name="name" id="name"  value="{{isset($client)?$client->name:old('name')}}"  placeholder="@lang('pos.name')">
                                </div>
                                <div class="form-group">
                                    <label for="phone1">@lang('pos.phone1')</label>
                                    <input type="text" class="form-control"   name="phone[]"   value="{{isset($client)?$client->phone[0]:''}}"  placeholder="@lang('pos.phone')">
                                </div>
                                <div class="form-group">
                                    <label for="phone2">@lang('pos.phone2')</label>
                                    <input type="text" class="form-control"   name="phone[]"   value="{{isset($client)?$client->phone[1]:''}}"  placeholder="@lang('pos.phone')">
                                </div>
                                <div class="form-group">
                                    <label for="address">@lang('pos.address')</label>
                                    <textarea type="text" class="form-control"   name="address" id="address"    placeholder="@lang('pos.address')">{{$client->address}}</textarea>
                                </div>
                            </div>


                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">{{isset($client)?trans('pos.update'):trans('pos.add')}}</button>
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
@section('js')
    <script>

        CKEDITOR.config.language = '{{app()->getLocale()}}';

    </script>
    @endsection