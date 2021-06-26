<div class="form-group">
    <label for="client_id" class="col-sm-2 col-form-label">Cliente:</label>
    <div class="col-sm-6">
        <select class="custom-select my-1 mr-sm-2 @error('client_id') is-invalid @enderror" id="situation" name="client_id">
            <option selected>Escolher...</option>
            @foreach ($clients as $client)
            <option value="{{$client->id}}"
                @if (old('client_id')== $client->id) selected @endif>{{ $client->name }}</option>
            @endforeach
        </select>
        @error('client_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="client_id" class="col-sm-2 col-form-label">Cliente:</label>
    <div class="col-sm-6">
        <select class="custom-select my-1 mr-sm-2 @error('store_id') is-invalid @enderror" id="situation" name="store">
            <option selected>Escolher...</option>
            @foreach ($stores as $store)
            <option value="{{$store->id}}"
                @if (old('store_id')== $store->id) selected @endif>{{ $store->name }}</option>
            @endforeach
        </select>
        @error('store_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
