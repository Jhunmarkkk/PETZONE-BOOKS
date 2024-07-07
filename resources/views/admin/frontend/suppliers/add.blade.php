@extends('admin.layouts.app')

@section('title' , 'Admin-Add supplier')

@section('content')
<!-- Add user form start -->
<div class="col-12 mt-5">
    <div class="card">
    <h5 class="card-title"><b>CREATE A SUPPLIER</b></h5>
        <form action="{{ route('admin.suppliers.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <input name="supplier_name" type="text" class="form-control" placeholder="Supplier Name" aria-label="supplier_name">
                    </div>
                    <div class="col">
                        <input name="contact_number" type="numeric" class="form-control" placeholder="Contact Number" aria-label="contact_number">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <input name="address" type="text" class="form-control" placeholder="Address" aria-label="address">
                    </div>
                    <div class="col">
                            <input name="image_path" type="file" accept="image/*" aria-label="image_path">
                    </div><br><br>
                    <div class="col">
                        <select name="prod_id" class="form-control" >
                            @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->id }}</option>
                            @endforeach
                        </select>
                    </div>
            </div><br>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-primary" type="submit">Add Supplier</button>
            </div>
        </form>
    </div>
</div>
<!-- Add user form end -->
@endsection