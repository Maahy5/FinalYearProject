@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="container mt-5 pt-5">
        <!-- Profile Header Section -->
        <h1 class="mb-4">Profile</h1>

        <!-- Profile Settings Form -->
        <form method="POST" enctype="multipart/form-data" id="profile_setup_form" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT') <!-- Assuming you want to use a PUT request to update profile data -->

            <div class="row">
                <div class="col-md-12 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>

                        <!-- Display Name and Email -->
                        <div class="mb-3">
                            <p><strong>Name:</strong> {{ $user->name }}</p>
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                            <!-- Do NOT display password, but give option to change password -->
                        </div>

                        <!-- Password Change Form -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Change Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password" />
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password" />
                        </div>

                        <!-- Update Button -->
                        <button type="submit" class="btn btn-warning">Update Profile</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
