@extends('layouts.app')

@section('content')
    <!-- Gaya-gayaan CSS dalam baris -->
    <style>
        .container {
            margin-top: 50px;
        }

        .card-header {
            background-color: #007BFF;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        .data-container {
            margin-top: 20px;
        }

        .data-heading {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .data-value {
            font-size: 18px;
            font-weight: bold;
        }

        .text-info {
            color: #17A2B8;
        }

        .text-success {
            color: #28A745;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <!-- Bagian Header Kartu -->
                    <div class="card-header">
                        <h4 class="mb-0">Transportasi pintar</h4>
                    </div>

                    <!-- Bagian Badan Kartu -->
                    <div class="card-body data-container">
                        <!-- Item Data Jarak -->
                        <div class="data-item mb-4">
                            <h2 class="data-heading text-info">Jarak:</h2>
                            <span id="jarak" class="data-value"></span>
                        </div>

                        <!-- Item Data Status Pintu -->
                        <div class="data-item">
                            <h2 class="data-heading text-success">Status Pintu:</h2>
                            <span id="status" class="data-value"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- Skrip JavaScript menggunakan jQuery -->
@push('js')
    <script>
        $(document).ready(function(){
            // Jalankan AJAX setiap 1 detik
            setInterval(() => {
                // Kirim permintaan GET ke endpoint "/Dht11/getdata"
                $.ajax({
                    type: "GET",
                    url: "/Dht11/getdata", // nama endpoint yang diperbaiki
                    success: function (response){
                        // Perbarui elemen dengan ID "jarak" dan "status" dengan data yang diterima
                        $("#jarak").html(response.data.jarak);
                        $("#status").html(response.data.status);
                        console.log(response);
                    }
                })
            }, 1000);
        });
    </script>
@endpush