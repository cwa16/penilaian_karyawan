<h2>Upload CSV Karyawan</h2>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form action="/import-csv" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" accept=".csv" required>
    <button type="submit">Import</button>
</form>
