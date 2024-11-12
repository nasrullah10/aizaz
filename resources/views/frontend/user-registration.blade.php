@extends('frontend.layouts.master')
@section('title', __('Register'))
@section('content')

<div class="container">
    <div class="mb-4">
        <h1 class="text-center">Register</h1>
    </div>
    <div class="my-4 my-xl-8">
        <div class="col-md-5 mx-auto">
            <div class="border-bottom border-color-1 mb-6">
                <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26">Register</h3>
            </div>
            <p class="text-gray-90 mb-4">Create a new account today to enjoy a personalized shopping experience.</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <!-- User Type Selection (User is selected by default) -->
                <div class="form-group mb-5">
                    <label class="form-label">I am a:</label>
                    <div>
                        <label class="mr-3">
                            <input type="radio" name="user_type" value="user" onclick="toggleFields('user')" {{ old('user_type') === 'user' || old('user_type') === null ? 'checked' : '' }} required>
                            User
                        </label>
                        <label>
                            <input type="radio" name="user_type" value="vendor" onclick="toggleFields('vendor')" {{ old('user_type') === 'vendor' ? 'checked' : '' }} required>
                            Vendor
                        </label>
                    </div>
                    @error('user_type')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Common Fields (for both User and Vendor) -->
                <div class="form-group mb-4">
                    <label class="form-label" for="name">Full Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Full Name" aria-label="Full Name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="js-form-message form-group mb-5">
                    <label class="form-label" for="RegisterSrEmailExample3">Email address <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" id="RegisterSrEmailExample3" placeholder="Email address" aria-label="Email address" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" aria-label="Password" required>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label class="form-label" for="password">Password Confirmation <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" aria-label="Confirm Password" required>
                    @error('password_confirmation')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Vendor-Only Fields -->
                <div id="vendor-fields" style="display: none;">
                    <div class="form-group mb-4">
                        <label class="form-label" for="businessName">Business Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="business_name" id="businessName" placeholder="Business Name" aria-label="Business Name" value="{{ old('business_name') }}">
                        @error('business_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label" for="businessType">Business Type</label>
                        <input type="text" class="form-control" name="business_type" id="businessType" placeholder="e.g., Retailer, Wholesaler" value="{{ old('business_type') }}">
                        @error('business_type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Only for Vendor: Terms and Conditions -->
                <div id="terms-checkbox" style="display: none;" class="form-group mb-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="terms" name="terms" {{ old('terms') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="terms">I agree to the <a href="#" class="text-blue">terms and conditions</a> <span class="text-danger">*</span></label>
                    </div>
                    @error('terms')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Privacy Policy -->
                <p class="text-gray-90 mb-4">Your personal data will be used to manage your account, as described in our <a href="#" class="text-blue">privacy policy</a>.</p>

                <!-- Submit Button -->
                <div class="mb-6">
                    <button type="submit" class="btn btn-primary-dark-w px-5">Register</button>
                </div>
            </form>

            <h3 class="font-size-18 mb-3">Sign up today and you will be able to:</h3>
            <ul class="list-group list-group-borderless">
                <li class="list-group-item px-0"><i class="fas fa-check mr-2 text-green font-size-16"></i> Speed your way through checkout</li>
                <li class="list-group-item px-0"><i class="fas fa-check mr-2 text-green font-size-16"></i> Track your orders easily</li>
                <li class="list-group-item px-0"><i class="fas fa-check mr-2 text-green font-size-16"></i> Keep a record of all your purchases</li>
            </ul>
        </div>
    </div>
</div>
    <script>
        // This function will handle the display of the vendor-specific fields based on the selected user type
        function toggleFields(userType) {
            // Show/hide vendor-specific fields
            if (userType === 'vendor') {
                document.getElementById('vendor-fields').style.display = 'block';
                document.getElementById('terms-checkbox').style.display = 'block';
            } else {
                document.getElementById('vendor-fields').style.display = 'none';
                document.getElementById('terms-checkbox').style.display = 'none';
            }
        }

        // On page load, ensure that the correct fields are displayed based on the default or previously selected user type
        document.addEventListener('DOMContentLoaded', function() {
            var userType = "{{ old('user_type', 'user') }}";  // Default to 'user' if no previous value
            toggleFields(userType);
        });
    </script>
@endsection

@section('script')

@endsection
