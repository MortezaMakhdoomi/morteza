@extends('layouts.app')

@section('title', 'Users List')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Products</h1>
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Add New
                    </a>
                </div>     
            </div>
        </div>


        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Products</h6>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="20%">Name</th>
                                <th width="25%">Price</th>
                                <th width="15%">Type</th>
                                <th width="15%">Discount</th>
                                <th width="15%">FoodParty</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->price }}</td>
                                    <td>{{ $user->type }}</td>
                                    <td>{{ $user->discount }}</td>
                                    <td>{{ $user->food_party ? $user->food_party->pluck('name')->first() : 'N/A' }}</td>
                                    <td>
                                        @if ($user->status == 0)
                                            <span class="badge badge-danger">Inactive<</span>
                                        @elseif ($user->status == 1)
                                            <span class="badge badge-success">active</span>
                                        @endif
                                    </td>
                                    <td style="display: flex">
                                        @if ($user->status == 0)
                                            <a href="{{ route('users.status', ['user_id' => $user->id, 'status' => 1]) }}"
                                                class="btn btn-success m-2">
                                                <i class="fa fa-check"></i>
                                            </a>
                                        @elseif ($user->status == 1)
                                            <a href="{{ route('users.status', ['user_id' => $user->id, 'status' => 0]) }}"
                                                class="btn btn-danger m-2">
                                                <i class="fa fa-ban"></i>
                                            </a>
                                        @endif
                                        <a href="{{ route('users.edit', ['user' => $user->id]) }}"
                                            class="btn btn-primary m-2">
                                            <i class="fa fa-pen"></i>
                                        </a>
                                        <a class="btn btn-danger m-2" href="#" data-toggle="modal" data-target="#deleteModal">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>

                        {{ $products->links() }}
                </div>
            </div>
        </div>

@include('products.delete-modal')

@endsection

@section('scripts')
    
@endsection

