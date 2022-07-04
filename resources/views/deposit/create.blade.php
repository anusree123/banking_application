
@extends('layouts.AdminLayout')

@section('content')
    <div class="container">
        <h3 class="text-center">Deposit Amount</h3>


        <div class="row">
            <div class="offset-md-3 col-md-6">
                <form method="POST" action="/deposit/store" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="full_name"> Amount</label>
                        <input type="text" name="amount" class="form-control @error('amount') is-invalid @enderror" id="amount">
                        @error('amount')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>



                    <button type="submit" class="btn btn-primary btn-block">Deposit</button>
                </form>
            </div>
        </div>
    </div>

@endsection
