@extends('admin.layouts.app')

@section('title', 'Admin-Suppliers')

@section('content')
<!-- Suppliers table start -->
<div class="main-content-inner">
    <div class="row">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>Supplier Name</th>
                        <th>Contact Number</th>
                        <th>Address</th>
                        <th>Image</th>
                        <th>Product ID</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suppliers as $supplier)
                    <tr>
                        <td>{{ $supplier->supplier_name }}</td>
                        <td>{{ $supplier->contact_number }}</td>
                        <td>{{ $supplier->address }}</td>
                        <td>
                            @if ($supplier->image_path)
                            <img src="{{ asset('storage/' . $supplier->image_path) }}" alt="Supplier Image" width = "160" height = "160">
                            @else
                            No Image
                            @endif
                        </td>
                        <td>{{ $supplier->prod_id }}</td>
                        <td>
                        <form action="{{ route('admin.suppliers.destroy' , $supplier->id ) }}" method="POST" id="prepare-form">
                      @csrf
                      @method('delete')
                        <button type="submit" id="button-delete"><span class="ti-trash"></span></button>
                        </form>
                        |
                        <a href="{{ route('admin.suppliers.edit' , $supplier->id) }}" id="a-black"><span class="ti-pencil"></span></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center">
            {{ $suppliers->links() }}
          </ul>
        </nav>  
    </div>
</div>

<!-- Pagination Links -->
<div class="mt-3">
    {{ $suppliers->links() }}
</div>
<!-- Suppliers table end -->
@endsection