@foreach ($books as $book)
    <form action="/api/books/{{$book->book_id}}" method="post"></form>
    {{csrf_field()}}
    {{method_field("GET")}}
    <div>
        <input type="submit" value="{{$book->title}}">
    </div>
@endforeach