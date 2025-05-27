@extends('layout.sidebar')
@section('content')
<div class="container mt-5">
          <div class="row">
              <!-- Total Users Card -->
              <div class="col-md-5">
                  <div class="card shadow p-4">
                      <h4>Total Users</h4>
                      <p class="fs-3 fw-bold"> {{ Auth::user()->id }} </p>
                  </div>
              </div>
      
              <!-- Total Profile Paths Card -->
              <div class="col-md-5">
                  <div class="card shadow p-4">
                      <h3>Total Profile</h4>
                      <p class="fs-3 fw-bold">{{ Auth::user()->id }} </p>
                  </div>
              </div>
          </div>
        </div>
@endsection

