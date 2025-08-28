@extends('user.layouts.app')

    @section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Dashboard') }}</div>
                        <div class="card-body">
                            Welcome to User Dashboard

                            @if (Auth::guard('user')->user())
                                <p>Logged in as: {{ Auth::guard('user')->user()->name }}</p>
                            @else
                                <p>Not logged in</p>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection