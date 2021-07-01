@extends('layouts.app')

@section('content')
<div class="container">

    <div class="alert alert-success" id="success-msg" style="display: none">
        Stored successfully
    </div>

    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                المستشفيات
            </div>
       
            <br>
            <table class="table table-dark table-striped">
               <thead>
                 <tr>
                   <th scope="col">#</th>
                   <th scope="col">Name</th>
                   <th scope="col">Address</th>
                   <th scope="col">Handle</th>
                 </tr>
               </thead>
               <tbody>
            @if ( isset($hospitals) && $hospitals -> count() > 0 )  
               @foreach( $hospitals as $hospital )
                 <tr>
                   <th scope="row">{{$hospital -> id}}</th>
                   <td>{{$hospital -> name}}</td>
                   <td>{{$hospital -> address}}</td>
                   <td>
                   <a type="button" class="btn btn-success" href="{{url('doctors/'.$hospital -> id)}}">Doctors</a>
                   <a href="{{ url('delete/hospital/'.$hospital -> id) }}" class="btn btn-danger">Delete</a>
                   </td>
                 </tr>
                 @endforeach
            @endif   
               </tbody>
            </table>

        </div>
    </div>
</div>
@endsection



