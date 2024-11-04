@extends('layouts.master_admin')
@section('content')
    <div class="row mt-5">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 d-flex justify-content-center align-items-center">
            <div class="row align-items-center" style="width: 50%;">
                <div class="col-md-3">{{ __('userpage.deposit_address') }}</div>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="address_name" placeholder="" value="">
                </div>
            </div>
        </div>
        <div class="col-12 mt-5 d-flex justify-content-center">
            <div id="edit_address_button" class="btn btn-success mt-1" style="width: 80px; margin-right: 30px;">{{ __('userpage.edit') }}</div>
        </div>
    </div>


@endsection
@section('js')

    <script>
        $(document).ready(function () {
            readAddress();
            $('#edit_address_button').click(function (){
                let address = $('#address_name').val().replace(/ /g, '');
                $.ajax({
                    url: '/admin.saveAddress',
                    headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                    data: {
                        address: address
                    },
                    type: 'POST',
                    success: function (data) {
                        if (data.msg === "ok") {
                            $('#address_name').val(data.address);
                            alert("Address entry successful");
                        }
                    },
                    error: function (jqXHR, errdata, errorThrown) {
                        console.log(errdata);
                    }
                });
            });
        });

        function readAddress() {
            $.ajax({
                url: '/admin.readAddress',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                type: 'POST',
                success: function (data) {
                    if (data.msg === "ok") {
                        $('#address_name').val(data.address);
                    }
                },
                error: function (jqXHR, errdata, errorThrown) {
                    console.log(errdata);
                }
            });
        }

    </script>
@endsection
