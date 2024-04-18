edit
<div class="row mb-3">
    <label for="id_kategori" class="col-sm-3 col-form-label">Kategori</label>
    <div class="col-sm-9">
        <select name="id_kategori" id="id_kategori" class="form-control @error('id_kategori') is-invalid @enderror">
            <option value="">- Pilih -</option>
            @forelse($kategori as $item)
            <option value="{{ $item->id_kategori }}">{{ $item->keterangan }}</option>
            @empty
            @endforelse
        </select>
        @error('id_kategori')
        <div class="alert alert-danger mt-2">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

create
<div class="row mb-3">
    <label for="id_kategori" class="col-sm-3 col-form-label">Kategori</label>
    <div class="col-sm-9">
        <select name="id_kategori" id="id_kategori" class="form-control @error('id_kategori') is-invalid @enderror">
            <option value="">- Pilih -</option>
            @foreach($kategori as $item)
            <option value="{{ $item->id }}">{{ $item->keterangan }}</option>
            @endforeach
        </select>
        @error('id_kategori')
        <div class="alert alert-danger mt-2">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>