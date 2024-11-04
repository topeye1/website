@extends('layouts.master_admin')
@section('content')
    <div class="row mt-5">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 d-flex justify-content-center align-items-center">
            <div class="row align-items-center" style="width: 50%;">
                <div class="col-md-3">Broker ID</div>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="broker_ID" placeholder="" value="">
                </div>
            </div>
        </div>
        <div class="col-12 mt-5 d-flex justify-content-center">
            <div id="edit_brokerID_button" class="btn btn-success mt-1" style="width: 80px; margin-right: 30px;">{{ __('userpage.edit') }}</div>
        </div>
    </div>


@endsection
@section('js')

    <script>
        $(document).ready(function () {
            readAddress();
            $('#edit_brokerID_button').click(function (){
                let broker_ID = $('#broker_ID').val().replace(/ /g, '');
                $.ajax({
                    url: '/admin.saveBrokerID',
                    headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                    data: {
                        brokerID: broker_ID
                    },
                    type: 'POST',
                    success: function (data) {
                        if (data.msg === "ok") {
                            $('#broker_ID').val(data.brokerID);
                            alert("Address entry successful");
                        }
                    },
                    error: function (jqXHR, errdata, errorThrown) {
                        console.log(errdata);
                        console.log(errorThrown);
                    }
                });
            });
        });

        function readAddress() {
            $.ajax({
                url: '/admin.readBrokerID',
                headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
                type: 'POST',
                success: function (data) {
                    if (data.msg === "ok") {
                        $('#broker_ID').val(data.brokerID);
                    }
                },
                error: function (jqXHR, errdata, errorThrown) {
                    console.log(errdata);
                    console.log(errorThrown);
                }
            });
        }

    </script>
@endsection
