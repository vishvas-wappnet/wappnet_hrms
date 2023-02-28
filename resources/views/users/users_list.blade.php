












@extends('layouts.app')

@include('layouts.header')
@section('content')




 

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>



 
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                 


 <div class="row">
   <div class="col-md-12 col-lg-12 col-sm-12">
     <div class="white-box">
       <div class="row row-in">
            <div class="">
              <div class="col-in row">
                 <div class="col-md-12 col-sm-6 col-xs-6">
                    
                                                           
                                                <!-- DataTales Example -->
                                                <div class="card shadow mb-3" >
                                                    <div class="card-header py-3" >

                                                 

                                                        
  
                                                        <h2 class="m-0 font-weight-bold text-primary">All Users</h2>

                                                        <form action="" class="col-9">
                                                          <div class="form-group">
                                                            <label for=""> search </label>
                                                            <input type="text" name="search" class="form-control"  placeholder="search  by name and email  here" value="{{$search}}"/>
                                                          </div>

                                                          <button class="btn btn-primary"> Search  </button>
                                                          <a href="{{url('/user')}}" >
                                                          <button class="btn btn-primary" type="button"> reset  </button>
                                                </form> 

                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                          
                                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Name</th>
                                                                        <th>Email</th>
                                                                        <th>Edit user information</th>
                                                                        <th>Delete user</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach ($users as $user)
                                                                    <tr>
                                                                      <td style="width: 60%">{{$user->name}}</td>
                                                                      <td style="width: 100%">{{$user->email}}</td>
                                                                      <td style="width: 50%"><a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm">Edit</a></td>
                                                                       
                                                                        <td>
                                                                          {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                                                          {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                                                          {!! Form::close() !!}
                                                                      </td> 
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                                  
                                                            <div class="row">

                                                               {{$users->onEachside(1)->links()}}
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
            </div>
        </div>
    </div>

@endsection