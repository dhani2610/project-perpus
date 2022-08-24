<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>

<body>

    <h3>Data Denda Buku Siswa SMA N 2 Bangko</h3>

    <table id="customers">
        <tr>
            <th>No</th>
            <th>Nama Peminjam</th>
            <th>Jumlah Denda</th>
            <th>Tanggal Pengembalian</th>



        </tr>
        @php
            $no = 1;
        @endphp
        @foreach ($datadenda as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->nama_anggota }}</td>
                <td>{{ $item->jumlah_denda }}</td>
                <td>{{ $item->created_at }}</td>


            </tr>
        @endforeach

    </table>

</body>

</html>
