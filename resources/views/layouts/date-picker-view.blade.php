<div class="input-group">
    <div class="direction-key" id="direction-left"><i class="fas fa fa-chevron-left"></i></div>
    <div class="input-group-prepend">
        <div class="input-group-text">
            <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
        </div>
    </div>
    <input id="input_datepicker_1" class="form-control" placeholder="YYYY-MM-DD" type="text" style="display: block">
    <input id="input_datepicker_2" class="form-control" placeholder="YYYY-MM" type="text" style="display: none">
    <input id="input_datepicker_3" class="form-control" placeholder="YYYY" type="text" style="display: none">

    <div class="direction-key" id="direction-right"><i class="fas fa fa-chevron-right"></i></div>
</div>

<script>
    $(document).ready(function () {
        $("#input_datepicker_1").datepicker( {
            language: "{{session()->get('locale')}}",
            format: "yyyy-mm-dd",
            autoclose: true,
            orientation: "bottom auto"
        });
        $("#input_datepicker_2").datepicker( {
            minViewMode: 1,
            maxViewMode: 2,
            autoclose: true,
            language: "{{session()->get('locale')}}",
            format: "yyyy-mm",
            orientation: "bottom auto"
        });
        $("#input_datepicker_3").datepicker( {
            minViewMode: 2,
            maxViewMode: 2,
            autoclose: true,
            language: "{{session()->get('locale')}}",
            format: "yyyy",
            orientation: "bottom auto"
        });
    });
</script>
