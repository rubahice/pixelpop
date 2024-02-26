
<div>

    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Kategori Delete</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent='destroyCategory'>

                <div class="modal-body">
                    <h6>Apakah Anda Yakin ingin mendelete Kategori ini?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Delete</button>
                </div>
            </form>

          </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3>Kategori
                        <a href="{{ url('admin/category/create') }}" class="btn btn-rounded btn-primary text-white btn-sm float-end">Tambahkan Kategori</a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->status == '1' ? 'Hidden':'Visible' }}</td>
                                <td>
                                    <a href="{{ url('admin/category/'.$category->id.'/edit') }}" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="#" wire:click="deleteCategory({{ $category->id }})" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')

<script>
    window.addEventListener('close-modal', event => {

        $('#deleteModal').modal('hide');
    });
</script>

@endpush

