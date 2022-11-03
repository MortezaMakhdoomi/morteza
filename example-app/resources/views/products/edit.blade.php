@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit products</h1>
        <a href="{{route('product.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')
   
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit product</h6>
        </div>
        <form method="POST" action="{{route('products.update', ['product' => product->id])}}">
            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="form-group row">

                    {{-- Name --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Name</label>
                        <input 
                            type="text" 
                            class="form-control form-control-product @error('name') is-invalid @enderror" 
                            id="exampleName"
                            placeholder="Name" 
                            name="name" 
                            value="{{ old('name') ?  old('name') : $product->name}}">

                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Price --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Price</label>
                        <input 
                            type="text" 
                            class="form-control form-control-product @error('price') is-invalid @enderror" 
                            id="examplePrice"
                            placeholder="Price" 
                            name="price" 
                            value="{{ old('price') ? old('price') : $product->price }}">

                        @error('price')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- type --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>type</label>
                        <input 
                            type="type" 
                            class="form-control form-control-product @error('type') is-invalid @enderror" 
                            id="exampletype"
                            placeholder="type" 
                            name="type" 
                            value="{{ old('type') ? old('type') : $product->type }}">

                        @error('type')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- discount --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>discount</label>
                        <select class="form-control form-control-product @error('discount') is-invalid @enderror" name="discount">
                            <option selected disabled>Select discount</option>
                            @foreach ($discounts as $discount)
                                <option value="{{$discount->id}}" 
                                    {{old('discount') ? ((old('discount') == $discount->id) ? 'selected' : '') : (($product->discount == $discount->id) ? 'selected' : '')}}>
                                    {{$discount->name}}
                                </option>
                            @endforeach
                        </select>
                        @error('discount')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- food_party --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>food_party</label>
                        <select class="form-control form-control-product @error('food_party') is-invalid @enderror" name="food_party">
                            <option selected disabled>Select food_party</option>
                            <option value="1" {{old('role_id') ? ((old('role_id') == 1) ? 'selected' : '') : (($product->food_party == 1) ? 'selected' : '')}}>Active</option>
                            <option value="0" {{old('role_id') ? ((old('role_id') == 0) ? 'selected' : '') : (($product->food_party == 0) ? 'selected' : '')}}>Inactive</option>
                        </select>
                        @error('food_party')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-product float-right mb-3">Update</button>
                <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('products.index') }}">Cancel</a>
            </div>
        </form>
    </div>

</div>


@endsection