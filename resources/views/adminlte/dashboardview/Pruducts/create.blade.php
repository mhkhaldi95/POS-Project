@extends('adminlte.master.master')
@section('content')

        <section class="content-header">



            <h1>
                @lang('pos.products')
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.products.index')}}"><i class="fa fa-dashboard"></i>  @lang('pos.home')</a></li>
                <li><a href="{{route('dashboard.products.index')}}"> @lang('pos.products')</a></li>

                <li class="active">   {{isset($product)?trans('pos.update'):trans('pos.create')}}</li>
            </ol>
        </section>

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">{{isset($product)?trans('pos.update'):trans('pos.create')}}</h3>

                    </div>
                    @include('adminlte.master.messageserror')
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <form role="form" id="ad" method="post"  action="{{isset($product)?'/dashboard/products/update/'.$product->id:'/dashboard/products/store'}}" enctype="multipart/form-data">
                            @csrf

                            <div class="box-body">
                                <div class="form-group">
                                  @php
                                      $index=0;
                                      if(isset($product))
                                      $index = $product->category_id;
                                  @endphp
                                    <label>@lang('pos.categories')</label>
                                    <select class="form-control"  name="category_id" >
                                        <option value="">{{__('pos.Select a Category')}}</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{$index==$category->id? 'selected':''}} {{$category->id==$index?'selected':''}}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
{{--                                config('locales')=== local=['ar','en]--}}
                                @foreach(config('translatable.locales') as $locale)
                                    <div class="form-group">
                                        <label for="name">@lang('pos.'.$locale.'.name')</label>
{{--                                        <input type="text" class="form-control"   name="name" id="name" required value="{{isset($product)?$product->name:''}}"  placeholder="@lang('pos.name')">--}}
                                        <input type="text" class="form-control"   name="{{$locale}}[name]" id="name" required value="{{isset($product)?$product->name:old($locale.'.name')}}"  placeholder="@lang('pos.'.$locale.'.name')">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">@lang('pos.'.$locale.'.description')</label>
{{--                                        <input type="text" class="form-control"   name="name" id="name" required value="{{isset($product)?$product->name:''}}"  placeholder="@lang('pos.name')">--}}
                                        <textarea type="text" class="form-control ckeditor"   name="{{$locale}}[description]" id="description" required  placeholder="@lang('pos.'.$locale.'.description')">{{isset($product)?$product->name:old($locale.'.description')}}</textarea>
                                    </div>
                                @endforeach
                                <div class="form-group">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                            @if(isset($product))
                                                <img src="{{$product->image_path}}" alt="">
                                            @else <img src="{{asset('/uploads/image_product/imgProduct.png')}}" alt="">
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
                                <div class="form-group">
                                    <label for="purchase_price">@lang('pos.purchase_price')</label>
                                    {{--                                        <input type="text" class="form-control"   name="name" id="name" required value="{{isset($product)?$product->name:''}}"  placeholder="@lang('pos.name')">--}}
                                    <input type="number" class="form-control"   name="purchase_price" id="purchase_price" required value="{{isset($product)?$product->purchase_price:old('purchase_price')}}"  placeholder="@lang('pos.purchase_price')">
                                </div>
                                <div class="form-group">
                                    <label for="price">@lang('pos.sale_price')</label>
                                    {{--                                        <input type="text" class="form-control"   name="name" id="name" required value="{{isset($product)?$product->name:''}}"  placeholder="@lang('pos.name')">--}}
                                    <input type="number" class="form-control"   name="sale_price" id="sale_price" required value="{{isset($product)?$product->sale_price:old('sale_price')}}"  placeholder="@lang('pos.sale_price')">
                                </div>
                                <div class="form-group">
                                    <label for="stoke">@lang('pos.stoke')</label>
                                    <input type="number" class="form-control"   name="stoke" id="stoke" required value="{{isset($product)?$product->stoke:old('stoke')}}"  placeholder="@lang('pos.stoke')">
                                </div>
                            </div>


                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">{{isset($product)?trans('pos.update'):trans('pos.add')}}</button>
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