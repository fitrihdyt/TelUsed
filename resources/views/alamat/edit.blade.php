<h2>Edit Alamat</h2>

<form method="POST" action="{{ route('alamat.update', $alamat->id) }}">
    @csrf
    @method('PUT')

    <h4>Recipients Information</h4>
    <input type="text" name="first_name" value="{{ old('first_name', $alamat->first_name) }}" required>
    <input type="text" name="last_name" value="{{ old('last_name', $alamat->last_name) }}">
    <input type="text" name="phone" value="{{ old('phone', $alamat->phone) }}" required>
    <input type="email" name="email" value="{{ old('email', $alamat->email) }}" required>

    <h4>Shipping Address</h4>
    <input type="text" name="address_title" value="{{ old('address_title', $alamat->address_title) }}" required>
    <input type="text" name="city" value="{{ old('city', $alamat->city) }}" required>
    <input type="text" name="zip_code" value="{{ old('zip_code', $alamat->zip_code) }}" required>
    <input type="text" name="address" value="{{ old('address', $alamat->address) }}" required>
    <input type="text" name="address2" value="{{ old('address2', $alamat->address2) }}">
    <label>
        <input type="checkbox" name="is_personal" {{ $alamat->is_personal ? 'checked' : '' }}>
        Set as personal address
    </label>

    <br><br>
    <button type="submit">Update</button>
</form>
