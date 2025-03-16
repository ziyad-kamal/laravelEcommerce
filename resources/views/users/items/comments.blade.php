@foreach ($comments as $comment)
    <div class="d-flex justify-content-center">
        <div class=" user">
            <span style="font-weight: bold">{{ $comment->users->name }}</span>
            {{-- calculate date difference for every comment --}}
            {{-- diff_date() is autoloaded from app\helpers\general.php --}}
            <span class="date_com"> {{ diff_date($comment->created_at) }}</span>
            <img src={{ asset('images/users/' . $comment->users->photo) }}
                class="rounded-circle" />
            <div class="users_comment">
                <div style="font-weight:600">{{ $comment->comment }}</div>
                @if ($comment->user_id == Auth::user()->id)
                    <a class="btn btn-info edit-btn" href="{{ url('comments/edit/' . $comment->id) }}">edit</a>
                    <a class="btn btn-danger delete-btn" href="{{ url('comments/delete/' . $comment->id) }}">delete</a>
                @endif
            </div>
        </div>

    </div>
@endforeach
