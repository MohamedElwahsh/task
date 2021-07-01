@extends('layouts.app')

@section('content')
<div class="container">

    <div class="alert alert-success" id="success-msg" style="display: none">
        Stored successfully
    </div>

    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                الأطباء
            </div>
       
            <br>
            <table class="table table-dark table-striped">
               <thead>
                 <tr>
                   <th scope="col">#</th>
                   <th scope="col">Name</th>
                   <th scope="col">Title</th>
                   <th scope="col">Handle</th>
                 </tr>
               </thead>
               <tbody>
            @if ( isset($doctors) && $doctors -> count() > 0 )  
               @foreach( $doctors as $doctor )
                 <tr>
                   <th scope="row">{{ $doctor -> id }}</th>
                   <td>{{ $doctor -> name }}</td>
                   <td>{{ $doctor -> title }}</td>
                   <td><a type="button" class="btn btn-danger" href="{{url('delete/doctor/'.$doctor -> id)}}">Delete</td>
                 </tr>
                 @endforeach
            @endif     
               </tbody>
            </table>

        </div>
    </div>
</div>
@endsection



