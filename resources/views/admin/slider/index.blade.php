@extends('layouts.admin.master')
@section('title', 'Sliders')

@section('content')
    @include('admin.includes.message')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Sliders ({{ $sliders->total() }})</h5>
            <small class="text-muted float-end">
                <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>
                    Create</a>
            </small>
        </div>

        <div class="table-responsive text-nowrap">
            @if ($sliders->isNotEmpty())
                <table class="table">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Slogan</th>
                            <th>Order</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($sliders as $key => $slider)
                            <tr>
                                <td><strong>{{ $key + $sliders->firstItem() }}</strong></td>
                                <td class="">
                                    <a href="{{ asset('admin/images/slider/') }}/{{ $slider->image ?: 'avatar.png' }}"
                                        data-fancybox="demo" class="fancybox">
                                        <img src="{{ asset('admin/images/slider/') }}/{{ $slider->image ?: 'avatar.png' }}"
                                            alt="{{ $slider->name }}" width="80px">
                                    </a>
                                </td>
                                <td><strong>{{ $slider->title ?? '' }}</strong></td>
                                <td>{{ $slider->slogan ?? '' }}</td>
                                <td>{{ $slider->order ?? '' }}</td>
                                <td>
                                    <a href="{{ route('admin.sliders.edit', $slider->id) }}"
                                        style="float: left;margin-right: 5px;" class="btn btn-sm btn-primary"><i
                                            class="fa-solid fa-pen-to-square"></i> Edit</a>


                                    <form class="delete-form" action="{{ route('admin.sliders.destroy', $slider->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger delete_blog mr-2" id=""
                                            title="Delete" data-type="confirm"><i class="fa fa-trash"></i>
                                            Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $sliders->links() }}
            @else
                <div class="card-body">
                    <h6>No Data Found!</h6>
                </div>
            @endif
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        $('.delete_blog').click(function(e) {
            e.preventDefault();
            swal({
                    title: `Are you sure?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $(this).closest("form").submit();
                    }
                });

        });
    </script>
@endsection
