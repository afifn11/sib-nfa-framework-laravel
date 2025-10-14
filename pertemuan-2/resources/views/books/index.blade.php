<!DOCTYPE html>
<html>
<head>
    <title>Books</title>
</head>
<body>
    <h1>Daftar Buku</h1>
    <ul>
        @foreach($books as $book)
            <li>{{ $book->title }} - {{ $book->author->name }}</li>
        @endforeach
    </ul>
</body>
</html>
