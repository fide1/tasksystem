@extends('user.layouts.master')

@section('title','Task-System || Task Create')

@section('main-content')

<div class="card">
    <h5 class="card-header">Add Task</h5>
    <div class="card-body">
      <form method="post" action="{{route('task.store')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputName" class="col-form-label">Name <span class="text-danger">*</span></label>
          <input id="inputName" type="text" name="name" placeholder="Enter Name"  value="" class="form-control">
          @error('name')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="type" class="col-form-label">Type <span class="text-danger">*</span></label>
          <select name="type" class="form-control">
              <option value="public">Public</option>
              <option value="private">Private</option>
          </select>
          @error('type')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="priority" class="col-form-label">Priority <span class="text-danger">*</span></label>
          <select name="priority" class="form-control">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
          </select>
          @error('priority')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputDueDate" class="col-form-label">due Date <span class="text-danger">*</span></label>
          <input id="inputDueDate" type="date" name="dueDate" placeholder="Enter due Date"  value="" class="form-control">
          @error('dueDate')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
              <option value="on-going">on-going</option>
              <option value="not-going" id="not-going">not-going</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputDone" class="col-form-label">Done <span class="text-danger">*</span></label>
          <input id="inputDone" type="text" name="done" placeholder="Enter Done %"  value="" class="form-control">
          @error('done')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputCreatedBy" class="col-form-label">Created By <span class="text-danger">*</span></label>
          <input id="inputCreatedBy" type="text" name="createdBy" placeholder="Enter Created By"  value="{{Auth()->user()->name}}" class="form-control">
          @error('createdBy')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputAssignedTo" class="col-form-label">Assigned To <span class="text-danger">*</span></label>
          <select name="assignedTo" id="assignedTo" class="form-control">
            <option></option>
            @foreach($users as $user)
              <option value="{{$user->name}}">{{$user->name}}</option>
            @endforeach
          </select>
          @error('assignedTo')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputComments" class="col-form-label">Comments</label>
          <textarea class="form-control" id="description" name="comments"></textarea>
          @error('comments')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
        <label for="inputPhoto" class="col-form-label">File <span class="text-danger">*</span></label>
        <div class="input-group">
          <input class="form-control" type="file" name="file" value="">
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          @error('file')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning">Reset</button>
           <button class="btn btn-success" type="submit">Submit</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('styles')
@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
@endpush