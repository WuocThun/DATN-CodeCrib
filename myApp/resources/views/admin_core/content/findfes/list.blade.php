<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng với cột Action</title>
    <link  href="styles.css">
</head>
<style>
    body {
    font-family: Arial, sans-serif;
}

.custom-table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
    border: 1px solid #ccc;
}

.custom-table th,
.custom-table td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ddd;
}

.custom-table th {
    background-color: #f4f4f4;
}

.custom-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.custom-table .edit-btn,
.custom-table .delete-btn {
    padding: 5px 10px;
    margin-right: 5px;
    border: none;
    cursor: pointer;
    color: white;
}

.a {
    background-color: #4CAF50;
}

.custom-table .delete-btn {
    background-color: #f44336;
}

.custom-table .edit-btn:hover {
    background-color: #45a049;
}

.custom-table .delete-btn:hover {
    background-color: #e53935;
}

</style>
<body>
    <table class="custom-table">
        <thead>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
        </thead>
        <tbody>
            @if ($findfes->isNotEmpty())
            @foreach ($findfes as $findfe)
            <tr>
                   <td class="px-6 py-3 text-left">{{$findfe->id}}</td>
                    <td class="px-6 py-3 text-left">{{$findfe->title}}</td>
                    <td class="px-6 py-3 text-left">{{$findfe->description}}</td>
                    <td class="px-6 py-3 text-left">

                        @if ($findfe->image != "")

                        <img width="50" src="{{asset('uploads/rooms/avatar/'.$findfe->image)}}" alt="">

                        @endif
                    </td>
                <td>
                    <a href="{{route('findfes.edit',$findfe->id )}}" class="">Edit</a>
                    <a href="#" onclick="deleteFindfe({{$findfe->id}})" class="bg-red-600 text-sm rounded-md text-white px-3 py-2 hover:bg-red-500">Delete</a>
                                        <form id="delete-findfe-form-{{$findfe->id}}" action="{{route('findfes.destroy',$findfe->id)}}" method="POST">
                                            @csrf
                                            @method('delete')
                                        </form>
                </td>
            </tr>

            @endforeach
            @endif


        </tbody>
    </table>
    <div class="my-3">

        {{ $findfes->links() }}
            </div>
</body>



</html>


<script type="text/javascript">
    function deleteFindfe(id) {
        if (confirm("Are you sure you want to delete?")) {
           document.getElementById("delete-findfe-form-"+id).submit();
        }

    }
</script>

