<!DOCTYPE html>
@extends('landing.partials.head')
@section('css')

@section('container')

<div class="register">
    <div class="container">
        <h1 class="text-center" style="font-size: 2rem;">L O G I N</h1> <!-- Adjust font size -->
        <hr class="mb-4">
        <div class="d-flex justify-content-center align-items-center">
            <div class="w-50" style="max-width: 500px;">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group col-12">
                        <label for="username">Username</label>
                        <input name="username" type="username" class="form-control" placeholder="Username">
                    </div>
                    @error('username')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="form-group col-12">
                        <label for="username">Password</label>
                        <input name="password" type="password" class="form-control" placeholder="Password">
                    </div>
                    @error('password')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
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