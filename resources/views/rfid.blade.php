<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelompok 9 - Smart School</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <div class="container py-3">
        <div class="text-center">
            <h2>Smart School - Kelompok 9<br>Monitoring Presensi Secara Realtime<br> Menggunakan Laravel</h2>
        </div>
    </div>
    <div class="container">
        <h6>
            Nama : <span id="nama"></span>
        </h6>
        <h6>
            Status : <span id="status"></span>
        </h6>
        <h6>
            Jam Presensi : <span id="jam"></span>
        </h6>
    </div>
    
    <div class="container py-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <center><h6>Daftar Kehadiran Siswa</h6></center>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="datatable">
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Tag ID</th>
                                        <th>Nama</th>
                                        <th>Status</th>
                                        <th>Waktu</th>
                                    </tr>
                                </thead>
                                <tbody id="rfidBody">
                                    {{-- @php $no=1; @endphp
                                    @foreach ($rfid as $val)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $val->rfid_tag }}</td>
                                            @if ($val->nama == "0")
                                                <td>{{ "Belum Terdaftar!!" }}</td>
                                            @else
                                                <td>{{ $val->nama }}</td>
                                            @endif

                                            @if ($val->status == "1")
                                                <td>{{ "Berhasil Presensi" }}</td>
                                            @else
                                                <td>{{ "Silahkan Registrasi ke Admin" }}</td>
                                            @endif
                                            <td>{{ $val->updated_at }}</td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
<script>
    $(document).ready(function () {
        setInterval(() => {
            $.ajax({
                type: "GET",
                url: "/rfid/checkRfid",
                success: function (response) {
                    // x
                    // $("#jam").html(response.data.updated_at);

                    if (response.data.nama == "0") {
                        $("#nama").html("Belum Terdaftar!!");
                    } else {
                        $("#nama").html(response.data.nama);
                    }

                    if (response.data.status == "1") {
                        $("#status").html("Berhasil Presensi");
                    } else {
                        $("#status").html("Silahkan Registrasi ke Admin");
                    }

                    var date = new Date(response.data.updated_at);
                    var formattedDateTime = date.toISOString().replace('T', ' ').replace(/\.\d+Z$/, '');
                    $("#jam").html(formattedDateTime)
                }
            });
        }, 1000);

        setInterval(() => {
            $.ajax({
                type: "GET",
                url: "/rfid/checkTable",
                success: function (response) {
                    $('#rfidBody').empty();
                    $.each(response.rfid, function(index, data) {
                        var date = new Date(data.updated_at);
                        var formattedDateTime = date.toISOString().replace('T', ' ').replace(/\.\d+Z$/, '');
                        var Ceknama = data.nama == "0" ? "Belum terdaftar!!" : data.nama;
                        var Cekstatus = data.status == "0" ? "Silahkan Registrasi ke Admin" : data.status == "1" ? "Berhasil Presensi" : "Lainnya";
                        $('#rfidBody').append('<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + data.rfid_tag + '</td>' +
                            '<td>' + Ceknama + '</td>' +
                            '<td>' + Cekstatus + '</td>' +
                            '<td>' + formattedDateTime + '</td>' +
                        '</tr>');
                    });
                }
            });
        }, 1000);
    });
</script>
</body>
</html>