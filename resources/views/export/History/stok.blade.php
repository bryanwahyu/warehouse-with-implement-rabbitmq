<table>
    <thead><tr>
            <th>Tipe</th>
            <th>Bahan</th>
            <th>Nama</th>
            <th>jumlah</th>
            <th>keterangan</th>
            <th>tanggal</th>
            </tr>
    </thead>
    <tbody>
        @foreach ($hists as $his)
            <tr>
                <td>{{$his->tipe}}</td>
                <td>{{$his->bahan->name}}</td>
                <td>{{$his->nama}}</td>
                <td>{{$his->jumlah}}</td>
                <td>{{$his->keterangan}}</td>
                <td>{{$his->created_at}}</td>
            </tr>
        @endforeach
    </tbody>
</table>