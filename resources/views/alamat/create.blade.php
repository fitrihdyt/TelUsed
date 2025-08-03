<h2>Tambah Alamat</h2>

<form method="POST" action="{{ route('alamat.store') }}">
    @csrf
    <h4>Recipients Information</h4>
    <input type="text" name="first_name" placeholder="First Name" required>
    <input type="text" name="last_name" placeholder="Last Name">
    <input type="text" name="phone" placeholder="Phone Number" required>
    <input type="email" name="email" placeholder="E-mail Address" required>

    <h4>Shipping Address</h4>
    <input type="text" name="address_title" placeholder="Address Title" required>
    <input type="text" name="city" placeholder="City" required>
    <input type="text" name="zip_code" placeholder="Zip Code" required>
    <input type="text" name="address" placeholder="Street, Apartment etc." required>
    <input type="text" name="address2" placeholder="Street Address 2 (Optional)">
    <label>
        <input type="checkbox" name="is_personal" checked>
        Set as personal address
    </label>

    <br><br>
    <button type="submit">Confirm</button>
</form>
