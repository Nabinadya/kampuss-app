<!DOCTYPE html> 
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mata Kuliah</title>
</head>
<body>
    <h1>Daftar Mata Kuliah</h1>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Jurusan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($matkuls as $matkul)
                <tr>
                    <td>{{ $matkul->kode }}</td>
                    <td>{{ $matkul->nama }}</td>
                    <td>{{ $matkul->jurusan }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Belum ada data mata kuliah.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>