  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
      @if (Auth::user()->user_type == 1)
      <li class="nav-item">
          <a class="nav-link " href="{{route('access')}}">
              <i class="bi bi-grid"></i>
              <span>Dashboard</span>
          </a>
      </li><!-- End Dashboard Nav -->
  
      <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
              <i class="bi bi-menu-button-wide"></i><span>School</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
              <li>
                  <a href="{{route('schoolinformation')}}">
                      <i class="bi bi-circle"></i><span>Add</span>
                  </a>
              </li>
              <li>
                  <a href="{{route('view_school_information')}}">
                      <i class="bi bi-circle"></i><span>View</span>
                  </a>
              </li>
          </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#assign-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Assign</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="assign-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{route('assign_teacher')}}">
                    <i class="bi bi-circle"></i><span>Class Teacher</span>
                </a>
            </li>
            <li>
                <a href="{{route('assign_head_teacher')}}">
                    <i class="bi bi-circle"></i><span>Head Teacher</span>
                </a>
            </li>
            <li>
              <a href="{{route('assign_resumption_date')}}">
                  <i class="bi bi-circle"></i><span>Add RESUMPTION Data</span>
              </a>
          </li>

          <li>
            <a href="{{route('assign_session')}}">
                <i class="bi bi-circle"></i><span>Add SESSION</span>
            </a>
        </li>

          
        </ul>
    </li><!-- End Components Nav -->
  
      <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
              <i class="bi bi-journal-text"></i><span>Head Teacher</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
              <li>
                  <a href="{{route('viewheadTeacher')}}">
                      <i class="bi bi-circle"></i><span>View</span>
                  </a>
              </li>
          </ul>
      </li><!-- End Forms Nav -->
  
      <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
              <i class="bi bi-layout-text-window-reverse"></i><span>Class</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
              <li>
                  <a href="{{route('viewClass')}}">
                      <i class="bi bi-circle"></i><span>View</span>
                  </a>
              </li>
          </ul>
      </li><!-- End Tables Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Subject</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('viewsubject')}}">
              <i class="bi bi-circle"></i><span>View</span>
            </a>
          </li>
          
        </ul>
      </li><!-- End Charts Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#marks-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Marks</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="marks-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('viewMarks')}}">
              <i class="bi bi-circle"></i><span>View</span>
            </a>
          </li>
          
        </ul>
      </li><!-- End Charts Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#others-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Others</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="others-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('viewOthers')}}">
              <i class="bi bi-circle"></i><span>View</span>
            </a>
          </li>
          
        </ul>
      </li><!-- End Charts Nav -->

  @else
      @if (Auth::user()->user_type == 2)
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Student</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('viewStudent')}}">
              <i class="bi bi-circle"></i><span>View</span>
            </a>
          </li>
          <li>
            <a href="{{route('addStudent')}}">
              <i class="bi bi-circle"></i><span>Add</span>
            </a>
          </li>
          
        </ul>
      </li><!-- End Charts Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Marks</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('addMarks')}}">
              <i class="bi bi-circle"></i><span>Add</span>
            </a>
          </li>
          <li>
            <a href="{{route('viewStudentMarks')}}">
              <i class="bi bi-circle"></i><span>View</span>
            </a>
          </li>
          
        </ul>
      </li><!-- End Icons Nav -->
      @endif
  @endif
  
      
   

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('profile')}}">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->


      <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button   @click.prevent="$root.submit();" type="submit" class="btn btn-danger"> <i class="bi bi-box-arrow-in-right"></i>Logout</button>
      </form>
     
      </li><!-- End Login Page Nav -->

    
  
    </ul>

  </aside><!-- End Sidebar-->
