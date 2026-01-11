<table class="table main_table table-hover align-middle">
    <thead>
        <tr>
            <th>Sr.#</th>
            <th>Img</th>
            <th>Title</th>
            <th>Author</th>
            <th>Status</th>
            <th>Published At</th>
            <th width="160">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($blogs as $key => $blog)
            <tr>
                <td>{{ $key + 1 + ($blogs->currentPage() - 1) * $blogs->perPage() }}</td>
                <td>
                    @if($blog->featured_image)
                        <img src="{{ asset('storage/blogs/' . $blog->featured_image) }}"
                             alt="Blog Image"
                             style="width:60px;height:60px;object-fit:cover;border-radius:6px;">
                    @else
                        <span class="text-muted">—</span>
                    @endif
                </td>
                <td>
                    <strong>{{ $blog->title }}</strong><br>
                    <small class="text-muted">{{ $blog->subtitle }}</small>
                </td>
                <td>
                    {{ $blog->author_name }}<br>
                    <small class="text-muted">{{ $blog->author_position }}</small>
                </td>
                <td>
                    @if ($blog->is_active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-secondary">Inactive</span>
                    @endif
                </td>
                <td>
                    {{ $blog->published_at ? $blog->published_at->format('d M Y') : '-' }}
                </td>
                <td>
                    <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                    <a href="{{ route('blogs.view', $blog->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                    <button class="btn btn-sm btn-danger delete-blog" data-id="{{ $blog->id }}"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center text-muted">No blogs found</td>
            </tr>
        @endforelse
    </tbody>
</table>
