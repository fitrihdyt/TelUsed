<div class="container">
    <h2>Obrolan dengan {{ $receiver->nama }}</h2>

    <div class="chat-box" style="border: 1px solid #ccc; padding: 15px; max-height: 300px; overflow-y: scroll;">
        @foreach ($messages as $message)
            <div style="margin-bottom: 10px;">
                <strong>{{ $message->sender->id == auth()->id() ? 'Kamu' : $message->sender->nama }}:</strong>
                {{ $message->message }}
                <div style="font-size: 12px; color: gray;">{{ $message->created_at->format('H:i d M Y') }}</div>
            </div>
        @endforeach
    </div>

    <form action="{{ route('chat.send', $conversation->id) }}" method="POST" style="margin-top: 20px;">
        @csrf
        <div class="form-group">
            <textarea name="message" class="form-control" rows="3" required placeholder="Tulis pesan..."></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Kirim</button>
    </form>
</div>
