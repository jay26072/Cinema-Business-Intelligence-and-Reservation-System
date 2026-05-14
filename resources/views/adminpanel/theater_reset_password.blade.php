@extends('adminpanel.master')

@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4>🎭 Theater List</h4>
        </div>

        <div class="card-body">

            {{-- SUCCESS MESSAGE --}}
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Theater Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>City</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($theaters as $theater)

                    <tr>
                        <td>{{ $theater->id }}</td>
                        <td>{{ $theater->theater_name }}</td>
                        <td>{{ $theater->theater_email }}</td>
                        <td>{{ $theater->theater_contact }}</td>
                        <td>{{ $theater->cityData->city_name ?? 'N/A' }}</td>

                        <td>
                            <a href="{{ url('reset-theater-password/'.$theater->id) }}"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Are you sure to Reset password?')">
                               🔑 Reset Password
                            </a>
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            No Theaters Found
                        </td>
                    </tr>

                @endforelse

                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection