@extends('layouts.app')


@section('content')
    <div class="alert alert-success" id="success-msg" style="display: none">
        Deleted successfully
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }} <span class="sr-only">(current)</span></a>
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>


    <div class="flex-center position-ref full-height">
        <div class="content">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">{{ __('messages.Offer Number') }}</th>
                    <th scope="col">{{ __('messages.Offer Name') }}</th>
                    <th scope="col">{{ __('messages.Offer Price') }}</th>
                    <th scope="col">{{ __('messages.Offer Details') }}</th>
                    <th scope="col">{{ __('messages.Offer Image') }}</th>
                    <th scope="col">{{ __('messages.Operations') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($offers as $offer)
                    <tr class="offerRaw{{ $offer -> id }}">
                        <th scope="row">{{ $offer -> id }}</th>
                        <td>{{ $offer -> name }}</td>
                        <td>{{ $offer -> price }}</td>
                        <td>{{ $offer -> details }}</td>
                        <td><img style="display: block" src="{{asset('images/offers/'.$offer -> photo)}}"></td>

                        <td> <a href="{{ url('offers/edit/'.$offer -> id) }}" class="btn btn-success">{{ __('messages.edit') }}</a></td>
                        <td> <a href="{{ url('offers/delete/'.$offer -> id) }}" class="btn btn-success">{{ __('messages.delete') }}</a></td>

                        <td> <a href="{{ route('ajax.offers.edit' , $offer -> id) }}"  class="btn btn-success">ajax-edit</a></td>
                        <td> <a href="" offer_id="{{$offer -> id}}" id="" class="delete-offer btn btn-success">ajax-delete</a></td>


                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).on('click','.delete-offer' , function (e) {
            e.preventDefault();
           var offer_id = $(this).attr('offer_id');
            $.ajax({
                type        : 'post',
                url         : "{{route('ajax.offers.delete')}}",
                data        : {
                    '_token': "{{csrf_token()}}",
                    'id'    :  offer_id,
                },

                success     : function (data) {
                    if(data.status == true){
                        $('#success-msg').show();
                    }
                    $('.offerRaw'+data.id).remove();

                },
                error       : function (reject){
                }
            });
        });
    </script>
@endsection

