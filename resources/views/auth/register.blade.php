@include('auth.header')

<div class="card mb-3">
  <div class="card-body">
    <div class="pt-4 pb-2">
      <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
      <p class="text-center small">Enter your personal details to create account</p>
    </div>

    <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('register') }}">
      @csrf

      <div class="col-12">
        <label for="yourName" class="form-label">First Name</label>
        <input type="text" name="name" class="form-control @error('first_name') is-invalid @enderror" id="yourName" required>
        @error('first_name')
          <div class="invalid-feedback">{{ $message }}</div>
        @else
          <div class="invalid-feedback">Please, enter your first name!</div>
        @enderror
      </div>

      <div class="col-12">
        <label for="yourLastName" class="form-label">Last Name</label>
        <input type="text" name="lastname" class="form-control @error('last_name') is-invalid @enderror" id="yourLastName" required>
        @error('last_name')
          <div class="invalid-feedback">{{ $message }}</div>
        @else
          <div class="invalid-feedback">Please, enter your last name!</div>
        @enderror
      </div>

      <div class="col-12">
        <label for="yourEmail" class="form-label">Your Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="yourEmail" required>
        @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
        @else
          <div class="invalid-feedback">Please enter a valid email address!</div>
        @enderror
      </div>

      <div class="col-12">
        <label for="yourPassword" class="form-label">Password</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="yourPassword" required>
        @error('password')
          <div class="invalid-feedback">{{ $message }}</div>
        @else
          <div class="invalid-feedback">Please enter your password!</div>
        @enderror
      </div>


      <div class="col-12">
        <label for="yourPassword" class="form-label">Password confirmation</label>
        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="yourPassword" required>
        @error('password_confirmation')
          <div class="invalid-feedback">{{ $message }}</div>
        @else
          <div class="invalid-feedback">Please re-enter your password!</div>
        @enderror
      </div>


      <div class="col-12">
        <button class="btn btn-primary w-100" type="submit">Create Account</button>
      </div>
      <div class="col-12">
        <p class="small mb-0">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
      </div>
    </form>

  </div>
</div>

@include('auth.footer')
