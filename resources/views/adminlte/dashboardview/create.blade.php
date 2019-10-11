@extends('adminlte.master.master')
@section('content')

        <section class="content-header">

                <script>

                    // var n = noty({
                    //     text: 'NOTY - a jquery notification library!',
                    //     animation: {
                    //         open: {height: 'toggle'},
                    //         close: {height: 'toggle'},
                    //         easing: 'swing',
                    //         speed: 500 // opening & closing animation speed
                    //     }
                    // });

                </script>

            <h1>
                @lang('pos.users')
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>  @lang('pos.home')</a></li>
                <li><a href="{{route('dashboard.users')}}"> @lang('pos.users')</a></li>

                <li class="active">   {{isset($user)?trans('pos.update'):trans('pos.create')}}</li>
            </ol>
        </section>

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">{{isset($user)?trans('pos.update'):trans('pos.create')}}</h3>

                    </div>
                    @include('adminlte.master.messageserror')
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <form role="form" id="ad" method="post" enctype="multipart/form-data" action="{{isset($user)?'/dashboard/users/edit/'.$user->id:'/dashboard/users/create'}}">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">@lang('pos.name')</label>
                                    <input type="text" class="form-control" id="name" value="{{isset($user)?$user->name:''}}"  name="name"  placeholder="@lang('pos.name')">
                                    <span class="text-danger" id="nameError"></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">@lang('pos.email')</label>
                                    <input type="email" class="form-control" name="email"  value="{{isset($user)?$user->email:''}}" id="email" placeholder="@lang('pos.email')">
                                    <span class="text-danger" id="emailError"></span>
                                </div>

                                <div class="form-group">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                            @if(isset($user))
                                                <img src="{{$user->image_path}}" alt="">
                                                @else <img src="{{asset('/uploads/image_user/default-png.png')}}" alt="">
                                                @endif
                                        </div>
                                        <div>
                                                                <span class="btn red btn-outline btn-file">
                                                                    <span class="fileinput-new btn btn-primary">@lang('pos.Select Image')  </span>
                                                                    <span class="fileinput-exists btn btn-primary" >@lang('pos.Change')  </span>
                                                                    <input type="file" name="image"> </span>
                                            <a href="javascript:;" class="btn red fileinput-exists btn btn-danger" data-dismiss="fileinput">@lang('pos.Remove')  </a>
                                        </div>
                                    </div>
                                </div>

                                @if(isset($user)==false)

                                <div class="form-group">
                                    <label for="exampleInputPassword1">@lang('pos.password')</label>
                                    <input type="password" class="form-control" name="password"  id="password" placeholder="@lang('pos.password')">
                                    <span class="text-danger" id="passwordError"></span>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">@lang('pos.passwordc')</label>
                                    <input type="password" class="form-control" name="passwordc" id="passwordc" placeholder="@lang('pos.passwordc')">
                                    <span class="text-danger" id="passwordcError"></span>

                                </div>
                                @endif
                                <h2 class="page-header">@lang('pos.permissions')</h2>
                                @php
                                 $models=['users','categories','products'];
                                $maps =['create','read','delete','update'];
                                @endphp
                                <div class="col-md-12">
                                    <!-- Custom Tabs -->
                                    <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs">
                                            @foreach($models as $index=>$model)
                                            <li class="{{$index==0?'active':''}}"><a href="#{{$model}}" data-toggle="tab" aria-expanded="true">@lang('pos.'.$model)</a></li>
                                            @endforeach
                                        </ul>
                                        <div class="tab-content">
                                            @foreach($models as $index=>$model)
                                            <div class="tab-pane {{$index==0?'active':''}}" id="{{$model}}">
                                                @foreach($maps as $map)

                                                    @if(isset($user))
                                                        <label>
                                                            <input type="checkbox" name="permissions[]" {{$user->hasPermission($map.'_'.$model)?'checked':''}} value="{{$map}}_{{$model}}"> @lang('pos.'.$map)
                                                        </label>
                                                        @else
                                                        <label>
                                                            <input type="checkbox" name="permissions[]"  value="{{$map}}_{{$model}}"> @lang('pos.'.$map)
                                                        </label>
                                                        @endif
                                                @endforeach

                                                <span class="text-danger" id="checkboxe"></span>
                                            </div>
                                            @endforeach
                                            <!-- /.tab-pane -->
                                        </div>
                                        <!-- /.tab-content -->
                                    </div>
                                    <!-- nav-tabs-custom -->
                                </div>


                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">{{isset($user)?trans('pos.update'):trans('pos.add')}}</button>
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