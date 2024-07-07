
@extends('admin.layouts.app')

@section('title' , 'Admin-Expenses')

@section('content')
<!-- Users list start -->
<div class="main-content-inner">
    <div class="row">
        <table class="table">
            <thead class="table-dark">
              <tr>
                <th>Id</th>
                <th>Expense Name</th>
                <th>Date</th>
                <th>Expense Amount</th>
                <th>Payment</th>
                <th>Expense Image</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($expenses as $expense)
                <tr>
                  <td>{{ $expense->id }}</td>
                  <td>{{ $expense->expense_name }}</td>
                  <td>{{ $expense->expense_date }}</td>
                  <td>{{ $expense->expense_amount }}</td>
                  <td>{{ $expense->expense_payment }}</td>
                  <td>
                        @if ($expense->expense_img)
                        <img src="{{ asset('storage/' . $expense->expense_img) }}" alt="Expense Image" width="160" height="160"> 
                        @else
                        No Image
                        @endif
                    |</td>
                  <!-- <td>{{ $expense->created_at }}</td> -->
                  <td>
                    <form action="{{ route('admin.expenses.destroy' , $expense->id ) }}" method="POST" id="prepare-form">
                      @csrf
                      @method('delete')
                        <button type="submit" id="button-delete"><span class="ti-trash"></span></button>
                    </form>
                    |
                    <a href="{{ route('admin.expenses.edit' , $expense->id) }}" id="a-black"><span class="ti-pencil"></span></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center">
            {{ $expenses->links() }}
          </ul>
        </nav>  
    </div>
</div>
<!-- Pagination Links -->
<div class="mt-3">
    {{ $expenses->links() }}
</div>
<!-- Expenses list end -->
@endsection