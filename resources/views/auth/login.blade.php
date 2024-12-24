@extends('mylogin')

@section('content')
<form action="{{ route('login-proses') }}" method="POST">
    @csrf
    <div class="row gy-3 overflow-hidden">
      <div class="col-12">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" name="email" required>
          <label for="text" class="form-label">Email</label>
        </div>
      </div>
      <div class="col-12">
        <div class="form-floating mb-3">
          <input type="password" class="form-control" name="password" required>
          <label for="password" class="form-label">Password</label>
        </div>
      </div>
      <div class="col-12">
        <div class="d-grid">
          <button class="btn btn-dark btn-lg mb-3" type="submit">Log in</button>
        </div>
      </div>
    </div>
  </form>
@endsection
