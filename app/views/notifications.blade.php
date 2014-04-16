<script>
var type = false,
message;
@if ($message = Session::get('success'))
type = "success";
message = "{{ $message }}";
@endif
@if ($message = Session::get('error'))
type = "danger";
message = "{{ $message }}";
@endif
@if ($message = Session::get('warning'))
type = "warning";
message = "{{ $message }}";
@endif
@if ($message = Session::get('info'))
type = "info";
message = "{{ $message }}";
@endif
@if (Session::has('errors'))
type = "danger";
message = "{{ $errors->first('email') }}";
@endif
if (type) {
    $.bootstrapGrowl(message, {
        ele: 'body', // which element to append to
        type: type,
        offset: {from: 'top', amount: 50}, // 'top', or 'bottom'
        align: 'center', // ('left', 'right', or 'center')
        width: 'auto', // (integer, or 'auto')
        delay: 5000,
        allow_dismiss: true,
        stackup_spacing: 10 // spacing between consecutively stacked growls.
    });
}
</script>