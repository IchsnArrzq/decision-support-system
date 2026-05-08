<div class="card w-full bg-base-100 shadow-sm">
    <div class="card-body">
        <h2 class="card-title">
            {{ $readonly ? 'Detail Alternative' : ($editingId ? 'Edit Alternative' : 'Tambah Alternative') }}
        </h2>

        <form wire:submit="save" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="label" for="alternative-code">
                    <span class="label-text">Kode</span>
                </label>
                <input
                    id="alternative-code"
                    type="text"
                    class="input w-full"
                    wire:model.defer="code"
                    @disabled($readonly)
                    placeholder="MTR015"
                />
                @error('code')
                    <p class="text-sm text-error mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label" for="alternative-name">
                    <span class="label-text">Nama Model</span>
                </label>
                <input
                    id="alternative-name"
                    type="text"
                    class="input w-full"
                    wire:model.defer="name"
                    @disabled($readonly)
                    placeholder="Nama model"
                />
                @error('name')
                    <p class="text-sm text-error mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label" for="alternative-brand">
                    <span class="label-text">Brand</span>
                </label>
                <input
                    id="alternative-brand"
                    type="text"
                    class="input w-full"
                    wire:model.defer="brand"
                    @disabled($readonly)
                    placeholder="Honda"
                />
                @error('brand')
                    <p class="text-sm text-error mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label" for="alternative-category">
                    <span class="label-text">Kategori</span>
                </label>
                <input
                    id="alternative-category"
                    type="text"
                    class="input w-full"
                    wire:model.defer="category"
                    @disabled($readonly)
                    placeholder="Matic"
                />
                @error('category')
                    <p class="text-sm text-error mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label" for="alternative-transmission">
                    <span class="label-text">Transmisi</span>
                </label>
                <input
                    id="alternative-transmission"
                    type="text"
                    class="input w-full"
                    wire:model.defer="transmission"
                    @disabled($readonly)
                    placeholder="Otomatis"
                />
                @error('transmission')
                    <p class="text-sm text-error mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label" for="alternative-price">
                    <span class="label-text">Harga</span>
                </label>
                <input
                    id="alternative-price"
                    type="number"
                    min="0"
                    step="1"
                    class="input w-full"
                    wire:model.defer="price"
                    @disabled($readonly)
                    placeholder="18500000"
                />
                @error('price')
                    <p class="text-sm text-error mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2 flex items-center gap-2">
                @if ($readonly)
                    <a href="{{ route('alternatives.index') }}" class="btn btn-ghost" wire:navigate>
                        Kembali
                    </a>
                @else
                    <button type="submit" class="btn btn-primary">
                        {{ $editingId ? 'Update' : 'Simpan' }}
                    </button>
                    <button type="button" class="btn btn-ghost" wire:click="cancel">
                        Batal
                    </button>
                @endif
            </div>
        </form>
    </div>
</div>
