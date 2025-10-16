<!DOCTYPE html>
<html>
<head>
    <title>Daftar Buku</title>
     <style>
        body { font-family: sans-serif; }
        table { border-collapse: collapse; width: 80%; margin: 20px auto; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h1>Daftar Buku</h1>
    <table>
        <thead>
            <tr>
                <th>Judul</th>
                <th>Author</th>
                <th>Genre</th>
                <th>Harga</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author->name ?? 'N/A' }}</td>
                    <td>{{ $book->genre->name ?? 'N/A' }}</td>
                    <td>Rp {{ number_format($book->price, 2, ',', '.') }}</td>
                    <td>{{ $book->stock }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
