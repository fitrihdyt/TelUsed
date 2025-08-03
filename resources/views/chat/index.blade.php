<div class="container">
    <h2>Daftar Percakapan</h2>

    @forelse ($conversations as $conversation)
        @php
            $receiver = $conversation->user_one_id == auth()->id()
                ? $conversation->userTwo
                : $conversation->userOne;
        @endphp

        <div>
            <a href="{{ route('chat.show', $receiver->id) }}">
                Percakapan dengan {{ $receiver->nama }}
            </a>
        </div>
    @empty
        <p>Kamu belum memiliki percakapan.</p>
    @endforelse
</div>
