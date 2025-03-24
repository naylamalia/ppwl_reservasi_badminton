@extends('layouts.app')

@section('content')
<div class="container" style="background-color: #fff8dc; padding: 20px; border-radius: 10px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (Auth::user()->hasRole('Super Admin'))
                <!-- Tampilan untuk Super Admin -->
                <div class="card" style="background-color: #fffacd; border-color: #ffcc00;">
                    <div class="card-header text-center" style="background-color: #ffeb99; color: #ffcc00; font-weight: bold;">
                        {{ __('Super Admin Dashboard') }}
                    </div>
                    <div class="card-body" style="color: #ffcc00;">
                        <p class="text-center" style="font-size: 18px; font-weight: bold;">
                            {{ __('Welcome, Super Admin!') }}
                        </p>
                        <a href="{{ route('users.index') }}" class="btn btn-warning mb-2" style="font-weight: bold;">Manage Users</a>
                        <a href="{{ route('roles.index') }}" class="btn btn-warning mb-2" style="font-weight: bold;">Manage Roles</a>
                        <a href="{{ route('courts.index') }}" class="btn btn-warning mb-2" style="font-weight: bold;">Manage Courts</a>
                        <a href="{{ route('reservations.index') }}" class="btn btn-warning mb-2" style="font-weight: bold;">Manage Reservations</a>
                    </div>
                </div>
            @elseif (Auth::user()->hasRole('Admin'))
                <!-- Tampilan untuk Admin -->
                <div class="card" style="background-color: #fffacd; border-color: #ffcc00;">
                    <div class="card-header text-center" style="background-color: #ffeb99; color: #ffcc00; font-weight: bold;">
                        {{ __('Admin Dashboard') }}
                    </div>
                    <div class="card-body" style="color: #ffcc00;">
                        <p class="text-center" style="font-size: 18px; font-weight: bold;">
                            {{ __('Welcome, Admin!') }}
                        </p>
                        <a href="{{ route('courts.index') }}" class="btn btn-warning mb-2" style="font-weight: bold;">Manage Courts</a>
                        <a href="{{ route('reservations.index') }}" class="btn btn-warning mb-2" style="font-weight: bold;">Manage Reservations</a>
                    </div>
                </div>
            @elseif (Auth::user()->hasRole('User'))
                <!-- Tampilan untuk User -->
                <div class="card" style="background-color: #fffacd; border-color: #ffcc00;">
                    <div class="card-header text-center" style="background-color: #ffeb99; color: #ffcc00; font-weight: bold;">
                        {{ __('User Dashboard') }}
                    </div>
                    <div class="card-body" style="color: #ffcc00;">
                        <p class="text-center" style="font-size: 18px; font-weight: bold;">
                            {{ __('Welcome, User!') }}
                        </p>
                        <a href="{{ route('reservations.index') }}" class="btn btn-warning mb-2" style="font-weight: bold;">View Reservations</a>
                        <a href="{{ route('courts.index') }}" class="btn btn-warning mb-2" style="font-weight: bold;">View Courts</a>
                    </div>
                </div>
            @else
                <!-- Tampilan Default -->
                <div class="card" style="background-color: #fffacd; border-color: #ffcc00;">
                    <div class="card-header text-center" style="background-color: #ffeb99; color: #ffcc00; font-weight: bold;">
                        {{ __('Dashboard') }}
                    </div>
                    <div class="card-body" style="color: #ffcc00;">
                        <p class="text-center" style="font-size: 18px; font-weight: bold;">
                            {{ __('Welcome!') }}
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection