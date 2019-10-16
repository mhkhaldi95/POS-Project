@extends('adminlte.master.master')
@section('content')
    @include('adminlte.master.messageserror')
    <section class="content-header">
        <h1>
            @lang('pos.clients')
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>  @lang('pos.home')</a></li>
            <li class="active"> @lang('pos.clients')</li>
        </ol>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">

                    <div class="box-header">
{{--                     هان بجيب العدد على حسب الباجينيشن   {{count($clients)}}--}}
                        <h3 class="box-title"> @lang('pos.clients')<small>{{$clients->total()}}</small></h3>
                        <div class="box-tools">
                            <form method="get" action="{{route('dashboard.clients.index')}}">

                                <div class="input-group input-group-sm hidden-xs" style="width: 250px;">

                                    <input type="text" name="search" class="form-control pull-right" placeholder="@lang('pos.Search')" value="{{request()->search}}">

                                    <div class="input-group-btn">

                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                        {{--                                        <a href="#" data-toggle="modal" data-target="#addcategory" style="margin-right: 0px;" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('pos.addd')</a>--}}
                                        @if(auth()->user()->hasPermission('create_clients'))
                                            <a href="{{route('dashboard.clients.create')}}"  class="btn btn-primary"><i class="fa fa-plus"></i>@lang('pos.add')</a>
                                        @else
                                            <a href=""  class="btn btn-primary disabled"><i class="fa fa-plus"></i>@lang('pos.add')</a>

                                        @endif
                                    </div>

                                </div>

                                <div class="input-group input-group-sm hidden-xs" style="width: 250px; display:inline-block;">




                                </div>

                            </form>

                        </div>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">

                        @if(count($clients)>0)
                        <table class="table table-hover" id="table">
                            <tbody>

                            <tr>
                                <th>#</th>
                                <th>@lang('pos.name')</th>
                                <th>@lang('pos.phone')</th>
                                <th>@lang('pos.address')</th>
                                <th>@lang('pos.actions')</th>

                            </tr>
                            @foreach($clients as $index=>$client)
                                <tr id="tr_{{$client->id}}">
                                    <td>{{$index+1}}</td>
                                    <td>{{$client->name}}</td>
                                    <td>{{implode('-', array_filter($client->phone))}}</td>
                                    <td>{{$client->address}}</td>
                                    <td>
                                        @if(auth()->user()->hasPermission('delete_clients'))
                                            <a data-value="{{$client->id}}" id="delete" class="btn btn-danger  remove-project"> <i class="fa fa-trash" aria-hidden="true"></i>@lang('pos.delete')</a>
                                        @else
                                            <a data-value="" id="delete" class="btn btn-danger disabled  remove-project"> <i class="fa fa-trash" aria-hidden="true"></i>@lang('pos.delete')</a>

                                        @endif
                                        @if(auth()->user()->hasPermission('update_clients'))
{{--                                                <a data-value="{{$client->id}}" class="btn btn-info editu" data-toggle="modal" data-target="#editclient" href=""><i class="fa fa-edit" aria-hidden="true"></i></a>--}}
                                                <a href="{{route('dashboard.clients.edit',[$client->id])}}" class="btn btn-info editu"  ><i class="fa fa-edit" aria-hidden="true"></i>@lang('pos.edit')</a>
                                        @else
                                                <a data-value="" class="btn btn-info editu disabled" data-toggle="modal" data-target="#editclient" href=""><i class="fa fa-edit" aria-hidden="true"></i>@lang('pos.edit')</a>

                                        @endif

                                    </td>

                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                            {{$clients->appends(request()->query())->links()}}
                        @else
                            <h2>@lang('pos.no_data_found')</h2>
                        @endif
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
        $(document).on("click",'.remove-project',function(){
            var id=$(this).data('value');

            swal({
                title: "@Lang('pos.sure')",
                text: "@lang('pos.Once deleted')",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        method:'POST',
                        url: "/dashboard/clients/delete/"+id,
                        data:{body:'',_token:'{{csrf_token()}}'},
                        success: function (response) {
                            var count = $('table tr').length;

                            $( "#tr_"+id).remove();
                            swal("@lang('pos.Poof deleted')", {
                                icon: "success",
                            });
                            if(count == 2){
                                location.reload();
                            }
                        }

                    })

                } else {
                    swal("@lang('pos.file is safe')");
                }
            });
        });

    </script>
    <script>
        //addclient
        $('#ad').on('submit', function(event){

            event.preventDefault();
            $('#nameError').addClass('d-none');
            $('#emailError').addClass('d-none');
            $('#passwordError').addClass('d-none');
            $('#passwordcError').addClass('d-none');


            $.ajax({
                url: "{{route('dashboard.clients.create')}}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data)
                {
                    var count = $('table tr').length;

                        var ro = '<tr id="tr_'+data.data.id+'">\n' +
                            '<td >'+count+'</td>\n' +
                            '<td>'+data.data.name+'</td>\n' +
                            '<td>'+data.data.email+'</td>\n' +
                            '\n' +
                            '<td>\n' +
                            '<a data-value="'+data.data.id+'" id="delete" class="btn btn-danger delete-post-link remove-project"> <i class="fa fa-trash" aria-hidden="true"></i></a>\n' +
                            '<a data-value="'+data.data.id+'" class="btn btn-info editu"  data-toggle="modal" data-target="#editclient" href=""><i class="fa fa-edit" aria-hidden="true"></i></a>\n' +
                            '</td>\n' +
                            '</tr>';

                        $('#addclient').modal("hide");
                        $('#table tbody').append
                        (ro);


                },
                error:function (data) {
                    var errors = data.responseJSON;
                    if($.isEmptyObject(errors) == false){
                        $.each(errors.errors,function (key,value) {
                            var ErrorID = '#'+key+'Error';
                            $(ErrorID).removeClass('d-none');
                            $(ErrorID).text(value);
                        })
                    }
                }
            })

        });

        //updateclient
        $(document).ready(function(){
            var id;

            $(document).on("click",'.editu',function (event) {
                x=event;
                target = $(x.target).parent().parent().parent();
                id=$(this).data('value');
            });


            $('#edit').on('submit', function(event){

                event.preventDefault();
                $('#nameeError').addClass('d-none');
                $('#emaileError').addClass('d-none');
                $('#passwordeError').addClass('d-none');
                $('#passwordceError').addClass('d-none');
                $.ajax({
                    url: "/dashboard/clients/edit/"+id,
                    method:"POST",
                    data:new FormData(this),
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(data)
                    {

                        var count = $('table tr').length;

                            $('#editclient').modal("hide");
                            var row = '   <tr id="tr_'+data.data.id+'">\n' +
                                '                                    <td >'+count+'</td>\n' +
                                '                                    <td>'+data.data.name+'</td>\n' +
                                '                                    <td>'+data.data.email+'</td>\n' +
                                '\n' +
                                '                                   <td>\n' +
                                '<a data-value="'+data.data.id+'" id="delete" class="btn btn-danger delete-post-link remove-project"> <i class="fa fa-trash" aria-hidden="true"></i></a>\n' +
                                '<a data-value="'+data.data.id+'" class="btn btn-info editu" data-toggle="modal" data-target="#editclient" href=""><i class="fa fa-edit" aria-hidden="true"></i></a>\n' +
                                '</td>\n' +
                                '\n' +
                                '</tr>';
                        var ro = '<tr id="tr_'+data.data.id+'">\n' +
                            '<td >'+count+'</td>\n' +
                            '<td>'+data.data.name+'</td>\n' +
                            '<td>'+data.data.email+'</td>\n' +
                            '\n' +
                            '<td>\n' +
                            '<a data-value="'+data.data.id+'" id="delete" class="btn btn-danger delete-post-link remove-project"> <i class="fa fa-trash" aria-hidden="true"></i></a>\n' +
                            '<a data-value="'+data.data.id+'" class="btn btn-info editu" data-toggle="modal" data-target="#editclient" href=""><i class="fa fa-edit" aria-hidden="true"></i></a>\n' +
                            '</td>\n' +
                            '</tr>';
                            target.replaceWith(row);

                        },
                    error:function (data) {
                        var errorss = data.responseJSON;
                        if($.isEmptyObject(errorss) == false){
                            $.each(errorss.errors,function (key,value) {
                                var ErrorID = '#'+key+'Error';
                                $(ErrorID).removeClass('d-none');
                                $(ErrorID).text(value);
                            })
                        }
                    }

                })

            });

        });

    </script>
    @endsection