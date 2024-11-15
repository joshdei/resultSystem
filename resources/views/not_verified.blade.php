
   @include('header') 
   <div class="container">

      <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
    
        <img src="{{ asset('assets/img/not-found.svg') }}" class="img-fluid py-5" alt="Page Not Found">
        <h1>404</h1>
        <h2>You are not verifed yet by Admin</h2>
            
        <a class="btn" href="{{route('login')}}">Back to home</a>
        <div class="credits">
            Designed by <a href="https://bsky.app/profile/joshdei.bsky.social">Joshua Deinne</a>
        </div>
      </section>

    </div>

    @include('footer')
 