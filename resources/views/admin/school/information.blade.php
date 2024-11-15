@include('header')

@include('topheader')
@include('sidebar')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Form Elements</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Elements</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">School Information Form</h5>

              <!-- General Form Elements -->
              <form method="POST" action="{{route('uploadSchoolData')}}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">School Name</label>
                  <div class="col-sm-10">
                    <input name="school_name" type="text" class="form-control" placeholder="school name" required>
                  </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">School Motto</label>
                    <div class="col-sm-10">
                      <input name="school_motto" type="text" class="form-control" placeholder="school motto" required>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">School Address</label>
                    <div class="col-sm-10">
                      <input name="school_address" type="address" class="form-control" placeholder="school address" required>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">School Phone Number</label>
                    <div class="col-sm-10">
                      <input name="school_phone" type="phone" class="form-control" placeholder="school phone number" required>
                    </div>
                  </div>

                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">School Email</label>
                  <div class="col-sm-10">
                    <input name="school_email" type="email" class="form-control" placeholder="school email" required>
                  </div>
                </div>
               
             
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">School Logo</label>
                  <div class="col-sm-10">
                    <input name="school_logo" class="form-control" type="file" id="formFile">
                  </div>
                </div>
               

           
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Submit Button</label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit Form</button>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>

   
      </div>
    </section>
@include('footer')