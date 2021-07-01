@extends('layouts.app')

@section('content')

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
            <div class="alert alert-success" id="success-msg" style="display: none">
                Updated successfully
            </div>
            <form method="POST" id="offerFormUpdate" action="">
                @csrf
                <input type="text" class="form-control"  value="{{$offer -> id}}" name="offer_id" style="display: none"><br>

                <div class="form-group">
                    <label for="uname">{{ __('messages.Offer Name en') }}:</label><br>
                    <input type="text" class="form-control" name="name_en" value="{{$offer -> name_en}}" placeholder="{{ __('messages.Enter Offer Name en') }}" ><br>
                    @error('name_en')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="uname">{{ __('messages.Offer Name ar') }}:</label><br>
                    <input type="text" class="form-control" name="name_ar" value="{{$offer -> name_ar}}" placeholder="{{ __('messages.Enter Offer Name ar') }}"  ><br>
                    @error('name_ar')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="pwd">{{ __('messages.Offer Price') }}:</label> <br>
                    <input type="text" class="form-control"  name="price" value="{{$offer -> price}}" placeholder="{{ __('messages.Enter Offer Price') }}" ><br>
                    @error('price')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="pwd">{{ __('messages.Offer Details en') }}:</label><br>
                    <input type="text" class="form-control" name="details_en" value="{{$offer -> details_en}}" placeholder="{{ __('messages.Enter Offer Details en') }}" ><br>
                    @error('details_en')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="pwd">{{ __('messages.Offer Details ar') }}:</label><br>
                    <input type="text" class="form-control" name="details_ar" value="{{$offer -> details_ar}}" placeholder="{{ __('messages.Enter Offer Details ar') }}" ><br>
                    @error('details_ar')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <td> <a href="" id="update-offer" class="btn btn-success">ajax-update</a></td>
            </form>

        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).on('click','#update-offer' , function (e) {
            e.preventDefault();
            var formData = new FormData($('#offerFormUpdate')[0]);
            $.ajax({
                type        : 'post',
                enctype     : "multipart/form-data",
                url         : "{{route('ajax.offers.update')}}",
                data        : formData,
                processData : false,
                contentType : false,
                cache       : false,
                success     : function (data) {
                    if(data.status == true){
                        $('#success-msg').show();
                    }
                },
                error       : function (reject){
                }
            });
        });

    </script>
@endsection
