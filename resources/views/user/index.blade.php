@extends('user.layouts.master')
@section('title','Task-System || DASHBOARD')
@section('main-content')
<div class="container-fluid">
    @include('user.layouts.notification')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

      <!-- Category -->
      <div class="col-xl-3 col-md-6 mb-4 btn assigned">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a class="assigned">Assigned Tasks</a></div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\Task::countAssignedTasks(Auth()->user()->name)}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-sitemap fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Products -->
      <div class="col-xl-3 col-md-6 mb-4 btn completed">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Completed Tasks</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\Task::countCompletedTasks(Auth()->user()->name)}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-cubes fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Order -->
      <div class="col-xl-3 col-md-6 mb-4 btn pending">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pending Tasks</div>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{\App\Task::countPendingTasks(Auth()->user()->name)}}</div>
                  </div>
                  
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--Posts-->
      <div class="col-xl-3 col-md-6 mb-4 btn overDue">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Overdue Tasks</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\Task::countOverDueTasks(Auth()->user()->name)}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-folder fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">

      <!-- Area Chart -->
      <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs card-header">
            <li class="nav-item card">
              <a class="nav-link active" data-toggle="tab" href="#home">Daily</a>
            </li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane container active" id="home">
              <br>
              <div class="container">
                <input id="inputDate" type="date" name="dueDate" class="form-control col-md-3" onchange="myFunction();">
              </div>
              <br>
              <div class="table-responsive">
                <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Task key</th>
                      <th>Task Name</th>
                      <th>Due date</th>
                      <th>Status</th>
                      <th>Created_at</th>
                    </tr>
                  </thead>
                  <tbody class="tbody">
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    
    </div>
    <!-- Content Row -->
    
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    $(document).ready(function(){
      $(".assigned").click(function(){
        $('tbody').empty();
        $.ajax({
          type: 'get',
          url: "/user/task/assignedTasks",
          success: function(data) {
            var i;
            for(i = 0 ; i < data.length ; i ++) {
              $('tbody').append('<tr><td>'+data[i]['id']+'</td><td>'+data[i]['name']+'</td><td>'+data[i]['dueDate']+'</td><td>'+data[i]['status']+'</td><td>'+data[i]['created_at']+'</td></tr>');
            }
          }
        });
      });
      $(".completed").click(function(){
        $('tbody').empty();
        $.ajax({
          type: 'get',
          url: "/user/task/completedTasks",
          success: function(data) {
            var i;
            for(i = 0 ; i < data.length ; i ++) {
              $('tbody').append('<tr><td>'+data[i]['id']+'</td><td>'+data[i]['name']+'</td><td>'+data[i]['dueDate']+'</td><td>'+data[i]['status']+'</td><td>'+data[i]['created_at']+'</td></tr>');
            }
          }
        });
      });
      $(".pending").click(function(){
        $('tbody').empty();
        $.ajax({
          type: 'get',
          url: "/user/task/pendingTasks",
          success: function(data) {
            var i;
            for(i = 0 ; i < data.length ; i ++) {
              $('tbody').append('<tr><td>'+data[i]['id']+'</td><td>'+data[i]['name']+'</td><td>'+data[i]['dueDate']+'</td><td>'+data[i]['status']+'</td><td>'+data[i]['created_at']+'</td></tr>');
            }
          }
        });
      });
      $(".overDue").click(function(){
        $('tbody').empty();
        $.ajax({
          type: 'get',
          url: "/user/task/overDueTasks",
          success: function(data) {
            var i;
            for(i = 0 ; i < data.length ; i ++) {
              $('tbody').append('<tr><td>'+data[i]['id']+'</td><td>'+data[i]['name']+'</td><td>'+data[i]['dueDate']+'</td><td>'+data[i]['status']+'</td><td>'+data[i]['created_at']+'</td></tr>');
            }
          }
        });
      });
    }); 

  function myFunction() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("inputDate");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    var cnt = 0;
    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[4];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          cnt++;
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
</script>
@endpush