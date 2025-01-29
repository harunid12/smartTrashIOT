@extends('layouts.main')

@section('title', 'Profile')
    
@section('content')
<div class="row">
    <!-- Basic Layout -->
    <div class="col-xxl">
      <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="mb-0">Profile Settings</h5>
        </div>
        <div class="card-body">
          <form action="{{ route('profileUpdate') }}" method="POST">
              @csrf
              @method('PUT')
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Nama</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="{{ $user->name }}" id="basic-default-name" placeholder="Admin.." />
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" name="email" value="{{ $user->email }}" id="basic-default-name" placeholder="example@mail.com" />
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" name="password" id="basic-default-name" placeholder="********" />
                <p class="text-danger">kosongkan jika tidak diubah!</p>
              </div>
            </div>
            <div class="row justify-content-end">
              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Send</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection