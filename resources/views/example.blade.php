{{-- Example page showing how to use the layout with logout button --}}
@extends('layouts.app')

@section('title', 'Example Page')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Example Page</h1>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">This page automatically has:</h5>
                    <ul>
                        <li>Navigation bar at the top</li>
                        <li>Logout button (when authenticated)</li>
                        <li>Login/Register buttons (when guest)</li>
                        <li>User information display</li>
                        <li>Admin panel link (for admins)</li>
                        <li>Responsive design</li>
                    </ul>
                </div>
            </div>

            @auth
                <div class="alert alert-success mt-4">
                    <h4>You are logged in!</h4>
                    <p>Username: <strong>{{ Auth::user()->name }}</strong></p>
                    <p>Email: <strong>{{ Auth::user()->email }}</strong></p>
                    <p>Role: <strong>{{ ucfirst(Auth::user()->role) }}</strong></p>

                    @if(Auth::user()->isAdmin())
                        <hr>
                        <p class="mb-0">🔐 You have admin access!
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-danger">Go to Admin Panel</a>
                        </p>
                    @endif
                </div>
            @else
                <div class="alert alert-info mt-4">
                    <h4>You are not logged in</h4>
                    <p>Please <a href="{{ route('login') }}">login</a> or <a href="{{ route('register') }}">register</a> to see personalized content.</p>
                </div>
            @endauth

            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Code for this page:</h5>
                </div>
                <div class="card-body">
                    <pre><code>&#64;extends('layouts.app')

&#64;section('title', 'Example Page')

&#64;section('content')
    &lt;!-- Your content here --&gt;
&#64;endsection</code></pre>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
