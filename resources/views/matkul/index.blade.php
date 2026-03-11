<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mata Kuliah</title>
</head>

<body>
<h1>My To-Do List Plus</h1>
<a href="{{ route('tasks.create') }}">[+] Tambah Tugas Baru</a>
<table border="1" cellpadding="10" style="margin-top: 20px; width: 100%;">
    <thead>
        <tr>
            <th>Tugas</th>
            <th>Deadline</th>
            <th>Prioritas</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($tasks as $task)
            <tr>
                <td>{{ $task->nama_tugas }}</td>
                <td>{{ $task->deadline }}</td>
                    <td>{{ $task->prioritas }}</td>
                <td>{{ $task->status }}</td>
                <td>
                    <a href="{{ route('tasks.edit', $task->id) }}">Edit</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Belum ada tugas.</td></tr>
        @endforelse
    </tbody>
</table>
</body>

</html>