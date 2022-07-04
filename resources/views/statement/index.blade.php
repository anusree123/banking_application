@extends('layouts.adminLayout')

@section('content')
    <div class="container">
        <div class="row">
            <table class="table text-center" id="dataTable1">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">DateTime</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Type</th>
                    <th scope="col">Details</th>
                    <th scope="col">Balance</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($statement as $key => $value)
                    <tr style="backgroundColor:#fff">
                        <td>{{$key+1}}</td>
                        <td>{{$value->created_at}}</td>
                        <td>{{$value->amount}}</td>
                        <td>{{\App\Http\Constants\StatementConstant::TYPE[$value->type] }}</td>
                        <td>{{$value->details}}</td>
                        <td>{{$value->balance}}</td>


                    </tr>
                @empty
                    <div class="display-3 text-center">No Statements Found</div>
                @endforelse
                </tbody>
            </table>

        </div>
        {{ $statement->links() }}
    </div>
@endsection


