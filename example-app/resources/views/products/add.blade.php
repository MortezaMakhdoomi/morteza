@extends('layouts.app')

@section('title', 'Add Products')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Products</h1>
        <a href="{{route('products.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')
   
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Produt</h6>
        </div>
        <form method="POST" action="{{route('products.store')}}">
            @csrf
            <div class="card-body">
                <div class="form-group row">

                    {{-- Name --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Name</label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('name') is-invalid @enderror" 
                            id="exampleName"
                            placeholder="Name" 
                            name="name" 
                            value="{{ old('name') }}">

                        @error('first_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Price --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Price</label>
                        <input 
                            type="float" 
                            class="form-control form-control-user @error('price') is-invalid @enderror" 
                            id="examplePrice"
                            placeholder="Price" 
                            name="price" 
                            value="{{ old('price') }}">

                        @error('price')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Type --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Type</label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('type') is-invalid @enderror" 
                            id="exampleType"
                            placeholder="Type" 
                            name="type" 
                            value="{{ old('type') }}">

                        @error('type')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Discount --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Discount</label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('discount') is-invalid @enderror" 
                            id="exampleDiscount"
                            placeholder="Discount" 
                            name="discount" 
                            value="{{ old('discount') }}">

                        @error('discount')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Food Party --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Food Party</label>
                        <select class="form-control form-control-user @error('food_party') is-invalid @enderror" name="food_party">
                            <option selected disabled>Select</option>
                            <option value="1" selected>Yes</option>
                            <option value="0">No</option>
                        </select>
                        @error('food_party')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-user float-right mb-3">Save</button>
                <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('products.index') }}">Cancel</a>
            </div>
        </form>
    </div>

</div>


@endsection