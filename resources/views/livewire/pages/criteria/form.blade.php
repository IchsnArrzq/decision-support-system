<div class="card w-full bg-base-100 shadow-sm">
    <div class="card-body">
        <h2 class="card-title">
            {{ $readonly ? 'Detail Criteria' : ($editingId ? 'Edit Criteria' : 'Tambah Criteria') }}
        </h2>

        <form wire:submit="save" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="label" for="criteria-code">
                    <span class="label-text">Kode</span>
                </label>
                <input
                    id="criteria-code"
                    type="text"
                    class="input w-full"
                    wire:model.defer="code"
                    @disabled($readonly)
                    placeholder="C9"
                />
                @error('code')
                    <p class="text-sm text-error mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label" for="criteria-name">
                    <span class="label-text">Nama</span>
                </label>
                <input
                    id="criteria-name"
                    type="text"
                    class="input w-full"
                    wire:model.defer="name"
                    @disabled($readonly)
                    placeholder="Nama kriteria"
                />
                @error('name')
                    <p class="text-sm text-error mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label" for="criteria-indicator">
                    <span class="label-text">Indikator</span>
                </label>
                <input
                    id="criteria-indicator"
                    type="text"
                    class="input w-full"
                    wire:model.defer="indicator"
                    @disabled($readonly)
                    placeholder="Deskripsi indikator"
                />
                @error('indicator')
                    <p class="text-sm text-error mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label" for="criteria-unit">
                    <span class="label-text">Satuan</span>
                </label>
                <input
                    id="criteria-unit"
                    type="text"
                    class="input w-full"
                    wire:model.defer="unit"
                    @disabled($readonly)
                    placeholder="km/l"
                />
                @error('unit')
                    <p class="text-sm text-error mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label" for="criteria-weight">
                    <span class="label-text">Bobot</span>
                </label>
                <input
                    id="criteria-weight"
                    type="number"
                    min="0"
                    max="1"
                    step="0.01"
                    class="input w-full"
                    wire:model.defer="weight"
                    @disabled($readonly)
                    placeholder="0.10"
                />
                @error('weight')
                    <p class="text-sm text-error mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label" for="criteria-type">
                    <span class="label-text">Tipe</span>
                </label>
                <select id="criteria-type" class="select w-full" wire:model.defer="type" @disabled($readonly)>
                    <option value="benefit">Benefit</option>
                    <option value="cost">Cost</option>
                </select>
                @error('type')
                    <p class="text-sm text-error mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2 flex items-center gap-2">
                @if ($readonly)
                    <a href="{{ route('criteria.index') }}" class="btn btn-ghost" wire:navigate>
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
