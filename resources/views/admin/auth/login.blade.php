<!DOCTYPE html>
@extends('landing.partials.head')
@section('css')

@section('container')

<div class="register">
    <div class="container">
        <h1 class="text-center" style="font-size: 2rem;">L O G I N - A D M I N</h1> <!-- Adjust font size -->
        <hr class="mb-4">
        <div class="d-flex justify-content-center align-items-center">
            <div class="w-50" style="max-width: 500px;">
                <form action="{{ route('admin.login') }}" method="POST">
                    @csrf
                    <div class="form-group col-12">
                        <label for="username">Username</label>
                        <input name="username" type="text" class="form-control" placeholder="Username" value="{{ old('username') }}">
                        @error('username')
                        <div class="invalid-feedback" style="display: block;">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="form-group col-12">
                        <label for="password">Password</label>
                        <input name="password" type="password" class="form-control" placeholder="Password">
                        @error('password')
                        <div class="invalid-feedback" style="display: block;">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-dark btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

</html>
