@extends('layouts.app')

@section('content')
<div class="flex justify-content-end">
    <a href="{{route('tags.create')}}" class="btn btn-success mb-2">Add tag</a>
</div>
<div class="card card-default">
    <div class="card-header">tags</div>
    <div class="card-body">
    @if($tags->count() > 0)
        <table class="table">
            <thead>
                <th>Name</th>
                <th>Post Count</th>
                <th></th>
            </thead>
            <tbody>
                @foreach($tags as $tag)
                    <tr>
                        <td>
                            {{$tag->name}}
                        </td>
                        <td>
                            {{$tag->posts->count()}}
                        </td>
                        <td>
                            <a href="{{route('tags.edit', $tag->id)}}" class="btn btn-info btn-sm">
                                Edit
                            </a>
                            <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $tag->id }})">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="" method="POST" id="deleteTagForm"> 
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete tag</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="font-weight-bold">
                                Are you sure you want delete this tag?
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="close-btn" data-dismiss="modal">cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="text-center font-weight-bold">No tag yet</div>
    @endif
    </div>
</div>
@endsection

@section('scripts')
    <script>
        function handleDelete(id) {
            let form = document.getElementById('deleteTagForm');
            form.action = '/tags/' + id;

            $('#deleteModal').modal('show');
            $(document).on('click', '#close-btn', function() {
                $('#deleteModal').modal('hide');
            });
        }
    </script>
@endsection