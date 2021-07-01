@extends('layouts.app')

@section('content')
<div class="container">

    <div class="alert alert-success" id="success-msg" style="display: none">
        Stored successfully
    </div>

    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                {{ __('messages.Add your offer') }}
            </div>

            <form method=""  id="offerForm" action="" >
                @csrf
                <div class="form-group">
                    <label for="uname">{{ __('messages.Choose Offer Photo') }}:</label><br>
                    <input type="file" class="form-control" name="photo" ><br>
                 
                    <small id="photo_error" class="form-text text-danger"></small>   
                </div>

                <div class="form-group">
                    <label for="uname">{{ __('messages.Offer Name en') }}:</label><br>
                    <input type="text" class="form-control" name="name_en"  placeholder="{{ __('messages.Enter Offer Name en') }}" ><br>
                   
                    <small id="name_en_error" class="form-text text-danger"></small>
                    
                </div>

                <div class="form-group">
                    <label for="uname">{{ __('messages.Offer Name ar') }}:</label><br>
                    <input type="text" class="form-control" name="name_ar"  placeholder="{{ __('messages.Enter Offer Name ar') }}"  ><br>
                 
                    <small id="name_ar_error" class="form-text text-danger"></small>

                </div>

                <div class="form-group">
                    <label for="pwd">{{ __('messages.Offer Price') }}:</label> <br>
                    <input type="text" class="form-control"  name="price" placeholder="{{ __('messages.Enter Offer Price') }}" ><br>
                   
                    <small id="price_error" class="form-text text-danger"></small>

                </div>

                <div class="form-group">
                    <label for="pwd">{{ __('messages.Offer Details en') }}:</label><br>
                    <input type="text" class="form-control" name="details_en" placeholder="{{ __('messages.Enter Offer Details en') }}" ><br>
                    
                    <small id="details_en_error" class="form-text text-danger"></small>

                </div>

                <div class="form-group">
                    <label for="pwd">{{ __('messages.Offer Details ar') }}:</label><br>
                    <input type="text" class="form-control" name="details_ar" placeholder="{{ __('messages.Enter Offer Details ar') }}" ><br>
                    
                    <small id="details_ar_error" class="form-text text-danger"></small>

                </div>

                <button id="save-offer" class="btn btn-primary">{{ __('messages.Save Offer') }}</button>
            </form>

        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).on('click','#save-offer' , function (e) {
            e.preventDefault();
            $('#photo_error').text('');
            $('#name_ar_error').text('');
            $('#name_en_error').text('');
            $('#price_error').text('');
            $('#details_ar_error').text('');
            $('#details_en_error').text('');
            var formData = new FormData($('#offerForm')[0]);
            $.ajax({
                type        : 'post',
                enctype     : "multipart/form-data",     // used for saving photo or file
                url         : "{{route('ajax.offers.store')}}",
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

                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, val){
                        $("#" + key + "_error" ).text(val[0]);
                    });
                    // var response = $.parseJSON(reject.responseText);
                    // $.each(response.errors, function (key, val) {
                    //     $("#" + key + "_error").text(val[0]);
                    // });
                }
            });
        });

    </script>
@endsection

