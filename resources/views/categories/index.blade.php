@extends('layouts.app')

@section('content')
<div class="flex justify-content-end">
    <a href="{{route('categories.create')}}" class="btn btn-success mb-2">Add category</a>
</div>
<div class="card card-default">
    <div class="card-header">categories</div>
    <div class="card-body">
    @if($categories->count() > 0)
        <table class="table">
            <thead>
                <th>Name</th>
                <th>Post Count</th>
                <th></th>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>
                            {{$category->name}}
                        </td>
                        <td>
                            {{ $category->posts->count() }}
                        </td>
                        <td>
                            <a href="{{route('categories.edit', $category->id)}}" class="btn btn-info btn-sm">
                                Edit
                            </a>
                            <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $category->id }})">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="" method="POST" id="deleteCategoryForm"> 
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="font-weight-bold">
                                Are you sure you want delete this category?
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
        <div class="text-center font-weight-bold">No Category yet</div>
    @endif
    </div>
</div>
@endsection

@section('scripts')
    <script>
        function handleDelete(id) {
            let form = document.getElementById('deleteCategoryForm');
            form.action = '/categories/' + id;

            $('#deleteModal').modal('show');
            $(document).on('click', '#close-btn', function() {
                $('#deleteModal').modal('hide');
            });
        }
    </script>
@endsection