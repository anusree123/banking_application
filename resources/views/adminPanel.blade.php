@extends('layouts.adminLayout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{--Success Msg--}}
                @if (session('msg_success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('msg_success')}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="text-center">
                    <h1 class="display-4">Welcome {{$userName->name}} </h1>
                    <h4 >Email:{{$details->email}}</h4>
                    <h4 >Your Balance :{{$totalAmount}} INR</h4>
                </div>
            </div>
        </div>
    </div>
@endsection
