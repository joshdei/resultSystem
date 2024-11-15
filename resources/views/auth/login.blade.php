@include('auth.header')
              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your email & password to login</p>
                  </div>

             
                  <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="col-12">
                      <label for="email" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" required>
                        @error('email')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @else
                          <div class="invalid-feedback">Please enter your email.</div>
                        @enderror
                      </div>
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
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                  
                    <div class="col-12">
                      <p class="small mb-0">Don't have an account? <a href="{{ route('register') }}">Create an account</a></p>
                    </div>
                  </form>
                  

                </div>
              </div>
@include('auth.footer')