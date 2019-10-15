@extends('adminlte.master.master')
@section('content')
    @include('adminlte.master.messageserror')
    <section class="content-header">
        <h1>
            @lang('pos.products')
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>  @lang('pos.home')</a></li>
            <li class="active"> @lang('pos.products')</li>
        </ol>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">

                    <div class="box-header">
{{--                     هان بجيب العدد على حسب الباجينيشن   {{count($products)}}--}}
                        <h3 class="box-title"> @lang('pos.products')<small>{{$products->total()}}</small></h3>

                        <div class="box-tools">
                            <form method="get" action="{{route('dashboard.products.index')}}">

                                <div class="input-group input-group-sm hidden-xs" style="width: 250px;">
                                    <select class="form-control" name="category_id">
                                        <option value="">@lang('pos.all_categories')</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}} " {{request()->category_id == $category->id? 'selected':''}}>{{$category->name}}</option>
                                            @endforeach
                                    </select>
                                   <div class="row">
                                       <div class="form-group col-md-6">
                                           <input type="text" name="search" class="form-control" placeholder="@lang('pos.Search')" value="{{request()->search}}">
                                       </div>
                                       <div class="form-group col-md-2">
                                           <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                       </div>
                                   </div>





                                    <div class="input-group-btn">

{{--                                        <a href="#" data-toggle="modal" data-target="#addproduct" style="margin-right: 0px;" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('pos.addd')</a>--}}
                                    @if(auth()->user()->hasPermission('create_products'))
                                            <a href="{{route('dashboard.products.create')}}"  class="btn btn-primary"><i class="fa fa-plus"></i>@lang('pos.add')</a>
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

                        @if(count($products)>0)
                        <table class="table table-hover" id="table">
                            <tbody>

                            <tr>
                                <th>#</th>
                                <th>@lang('pos.name')</th>
                                <th>@lang('pos.description')</th>
                                <th>@lang('pos.category')</th>
                                <th>@lang('pos.image')</th>
                                <th>@lang('pos.sale_price')</th>
                                <th>@lang('pos.purchase_price')</th>
                                <th>@lang('pos.profit_percent')</th>
                                <th>@lang('pos.stoke')</th>
                                <th>@lang('pos.actions')</th>

                            </tr>
                            @foreach($products as $index=>$product)
                                <tr id="tr_{{$product->id}}">
                                    <td>{{$index+1}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{!! $product->description !!}</td>
                                    <td>{{$product->category->name}}</td>
                                    <td><img style="width: 100px" class="img-thumbnail" src="{{$product->image_path}}" alt=""> </td>
                                    <td>{{$product->sale_price}}</td>
                                    <td>{{$product->purchase_price}}</td>
                                    <td>{{$product->profit_percent}}</td>
                                    <td>{{$product->stoke}}</td>

                                    <td>
                                        @if(auth()->user()->hasPermission('delete_products'))
                                            <a data-value="{{$product->id}}" id="delete" class="btn btn-danger  remove-project"> <i class="fa fa-trash" aria-hidden="true"></i>@lang('pos.delete')</a>
                                        @else
                                            <a data-value="" id="delete" class="btn btn-danger disabled  remove-project"> <i class="fa fa-trash" aria-hidden="true"></i>@lang('pos.delete')</a>

                                        @endif
                                        @if(auth()->user()->hasPermission('update_products'))
{{--                                                <a data-value="{{$product->id}}" class="btn btn-info editu" data-toggle="modal" data-target="#editproduct" href=""><i class="fa fa-edit" aria-hidden="true"></i></a>--}}
                                                <a href="{{route('dashboard.products.edit',[$product->id])}}" class="btn btn-info editu"  ><i class="fa fa-edit" aria-hidden="true"></i>@lang('pos.edit')</a>
                                        @else
                                                <a data-value="" class="btn btn-info editu disabled" data-toggle="modal" data-target="#editproduct" href=""><i class="fa fa-edit" aria-hidden="true"></i>@lang('pos.edit')</a>

                                        @endif

                                    </td>

                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                            {{$products->appends(request()->query())->links()}}
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
                        url: "/dashboard/products/delete/"+id,
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
        //addproduct
        $('#ad').on('submit', function(event){

            event.preventDefault();
            $('#nameError').addClass('d-none');
            $('#emailError').addClass('d-none');
            $('#passwordError').addClass('d-none');
            $('#passwordcError').addClass('d-none');


            $.ajax({
                url: "{{route('dashboard.products.create')}}",
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
                            '<a data-value="'+data.data.id+'" class="btn btn-info editu"  data-toggle="modal" data-target="#editproduct" href=""><i class="fa fa-edit" aria-hidden="true"></i></a>\n' +
                            '</td>\n' +
                            '</tr>';

                        $('#addproduct').modal("hide");
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

        //updateproduct
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
                    url: "/dashboard/products/edit/"+id,
                    method:"POST",
                    data:new FormData(this),
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(data)
                    {

                        var count = $('table tr').length;

                            $('#editproduct').modal("hide");
                            var row = '   <tr id="tr_'+data.data.id+'">\n' +
                                '                                    <td >'+count+'</td>\n' +
                                '                                    <td>'+data.data.name+'</td>\n' +
                                '                                    <td>'+data.data.email+'</td>\n' +
                                '\n' +
                                '                                   <td>\n' +
                                '<a data-value="'+data.data.id+'" id="delete" class="btn btn-danger delete-post-link remove-project"> <i class="fa fa-trash" aria-hidden="true"></i></a>\n' +
                                '<a data-value="'+data.data.id+'" class="btn btn-info editu" data-toggle="modal" data-target="#editproduct" href=""><i class="fa fa-edit" aria-hidden="true"></i></a>\n' +
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
                            '<a data-value="'+data.data.id+'" class="btn btn-info editu" data-toggle="modal" data-target="#editproduct" href=""><i class="fa fa-edit" aria-hidden="true"></i></a>\n' +
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