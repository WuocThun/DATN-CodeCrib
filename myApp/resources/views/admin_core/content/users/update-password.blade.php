@extends('admin_core.layouts.test')

@section('main')
    <div class="container d-flex  justify-content-center min-vh-100">
        <div class="col-md-6">
            <h2 class="text-center mb-4">{{ __('Cập nhật mật khẩu') }}</h2>

            <div class="card">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.profile.password.update') }}">
                        @csrf

                        <!-- Mật khẩu hiện tại -->
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                            <input type="password" name="current_password" id="current_password" required
                                   class="form-control @error('current_password') is-invalid @enderror">
                            @error('current_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Mật khẩu mới -->
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Mật khẩu mới</label>
                            <input type="password" name="new_password" id="new_password" required
                                   class="form-control @error('new_password') is-invalid @enderror">
                            @error('new_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Xác nhận mật khẩu mới -->
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation" required
                                   class="form-control">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                Cập nhật mật khẩu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
