@extends('layouts.app')

@section('content')

<h1>jarak: <span id="jarak"></span></h1>
<h1>status: <span id="status"></span></h1>

@endsection

@push('js')
<script>
    $(document).ready(function () {
        setInterval(() => {
            $.ajax({
                type: "GET",
                url: "/Dht11/getdata",
                success: function (response) {
                    $("#jarak").html(response.datajarak);
                    $("#status").html(response.datastatus);
                    console.log(response);
                }
            });
        }, 1000);
    });
</script>
@endpush