<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
</head>
<body>
    <style type="text/css">
        table {
            width: 100%;
            font-family: "Arial Black", Helvetica, sans-serif;
        }

        table {
            border-collapse: collapse;
            table-layout: fixed;

        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
        }

        th {
            padding: 10px;

        }

        th,
        .heading {
            background-color: #daad32;
            color: #000;
            font-size: 20px;
            text-align: center;
            font-weight: bold;
        }

        table tr td {
            font-size: 9pt;
            padding: 2px;
            border: 1px solid black;
        }

        td {
            width: 100px;
        }

        .small-font {
            font-size: 8px;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
            font-weight: bold;

        }

        .uppercase {
            text-transform: uppercase;
        }

        .checkmark{
          font-family: DejaVu Sans, sans-serif;
        }

    </style>

    {{-- <table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Email</th>
				<th>Alamat</th>
				<th>Telepon</th>
				<th>Pekerjaan</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($pegawai as $p)
			<tr>
				<td>{{ $i++ }}</td>
    <td>{{$p->nama}}</td>
    <td>{{$p->email}}</td>
    <td>{{$p->alamat}}</td>
    <td>{{$p->telepon}}</td>
    <td>{{$p->pekerjaan}}</td>
    </tr>
    @endforeach
    </tbody>
    </table> --}}
    <table class="table">
        <!-- Header Section -->
        <tr>
            <th class="uppercase" colspan="7">Formulir</th>
            <th class="uppercase" colspan="7">Pengecekan Kendaraan</th>
        </tr>
        <tr>
            <td rowspan="2" colspan="7">  <img width="50" src="{{ public_path('images/3.png') }}" alt="Image Alt Text"></td>
            <td colspan="3">No. Dokumen</td>
            <td colspan="4">F.713/UMM/00/01/17</td>
        </tr>
        <tr>
            <td colspan="3">Revisi</td>
            <td colspan="4">02</td>
        </tr>

        <tr>
            <td rowspan="2" colspan="7" class="uppercase heading">PT. NUSANTARA BUILDING INDUTRIES</td>
            <td colspan="3">Tanggal</td>
            <td colspan="4">01-03-2023</td>
        </tr>
        <tr>
            <td colspan="3">Terbitan</td>
            <td colspan="4">02</td>
        </tr>
        <tr>
            <td colspan="2">Kendaraan</td>
            <td colspan="5">{{ $vehicle->vehicles->vehicle_name }}</td>
            <td class="center" colspan="2" rowspan="3">Penggantian Selanjutnya</td>
            {{-- <td></td> --}}
            <td colspan="2">Oli Mesin</td>
            <td colspan="2"></td>
            <td>Km</td>
        </tr>
        <tr>
            <td colspan="2">Nomor Polisi</td>
            <td colspan="5">{{ $vehicle->vehicles->vehicle_number }}</td>
            {{-- <td colspan="1"></td> --}}
            <td colspan="2">Oli Gardan</td>
            <td colspan="2"></td>
            <td>Km</td>
        </tr>
        <tr>
            <td colspan="2">Bulan/Tahun</td>
            <td colspan="5">Oct 3</td>
            {{-- <td colspan="1"></td> --}}
            <td colspan="2">Oli Persneling</td>
            <td colspan="2"></td>
            <td>Km</td>
        </tr>

        <thead>
            <tr class="center">
                <td rowspan="2">
                    No.
                </td>
                <td rowspan="2" colspan="3">
                    Jenis Pemeriksaan
                </td>
                <td colspan="2">
                    Minggu 1
                </td>
                <td colspan="2">
                    Minggu 2
                </td>
                <td colspan="2">
                    Minggu 3
                </td>
                <td colspan="2">
                    Minggu 4
                </td>
                <td rowspan="2" colspan="2">
                    Keterangan
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="small-font">Baik</td>
                <td class="small-font">Tidak Baik</td>
                <td class="small-font">Baik</td>
                <td class="small-font">Tidak Baik</td>
                <td class="small-font">Baik</td>
                <td class="small-font">Tidak Baik</td>
                <td class="small-font">Baik</td>
                <td class="small-font">Tidak Baik</td>
            </tr>
            <?php $i=1; ?>

            @foreach($vehicles_checklist as $index => $checklist)
            <tr>
                <td>
                    {{ $i++ }}.
                </td>
                <td colspan="3">
                   {{ $checklist->forms->form_name }}
                </td>
                <td class="checkmark">{{ $checklist->is_good ? '✔': '' }}</td>
                <td class="checkmark">{{ !$checklist->is_good ? '✔': '' }}</td>
                <td class="checkmark">{{ $checklist->is_good ? '✔': '' }}</td>
                <td class="checkmark">{{ !$checklist->is_good ? '✔': '' }}</td>
                <td class="checkmark">{{ $checklist->is_good ? '✔': '' }}</td>
                <td class="checkmark">{{ !$checklist->is_good ? '✔': '' }}</td>
                <td class="checkmark">{{ $checklist->is_good ? '✔': '' }}</td>
                <td class="checkmark">{{ !$checklist->is_good ? '✔': '' }}</td>
                <td colspan="2">bagus</td>
            </tr>
            @endforeach

            <tr>
                <td colspan="3" class="right">
                    Dicek
                </td>
                <td colspan="2"></td>
                <td colspan="3"></td>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="3" class="right">
                    Diketahui
                </td>
                <td colspan="2"></td>
                <td colspan="3"></td>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="3" class="right">
                    Tanggal
                </td>
                <td colspan="2"></td>
                <td colspan="3"></td>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="14">
                    Catatan
                </td>
            <tr>
                <td colspan="14">
                    Dilakukan pegecekan tiap minggu
                </td>
            </tr>
            <tr>
                <td colspan="14">
                    Beri tanda <span style="font-family: DejaVu Sans, sans-serif;">✔</span> pada kolom yang dimaksud (Baik/Tidak Baik), tambahkan penjelasan di kolom keterangan saat kondisi TB
                </td>
            </tr>
            <tr>
                <td colspan="14">
                    Berikan paraf pada kolom yang tersedia setelah melakukan pengecekan
                </td>
            </tr>
            <tr>
                <td colspan="14">
                    Tanggal diisi saat melakukan pengecekan
                </td>
            </tr>
            <tr>
                <td colspan="14">
                    Setiap temuan Tidak Baik wajib dilaporkan atasan dan di tindak lanjuti
                </td>
            </tr>

        </tbody>

    </table>

</body>
</html>
