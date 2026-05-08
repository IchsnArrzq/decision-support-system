<div class="card w-full bg-base-100 shadow-sm">
    <div class="card-body">
        <h2 class="card-title">
            {{ $readonly ? 'Detail Value' : ($editingId ? 'Edit Value' : 'Tambah Value') }}
        </h2>

        <form wire:submit="save" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="label" for="value-alternative">
                    <span class="label-text">Alternative</span>
                </label>
                <select id="value-alternative" class="select w-full" wire:model.defer="alternative_id" @disabled($readonly)>
                    <option value="">Pilih alternative</option>
                    @foreach ($alternatives as $alternative)
                        <option value="{{ $alternative->id }}">
                            {{ $alternative->code }} - {{ $alternative->name }}
                        </option>
                    @endforeach
                </select>
                @error('alternative_id')
                    <p class="text-sm text-error mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label" for="value-criteria">
                    <span class="label-text">Criteria</span>
                </label>
                <select id="value-criteria" class="select w-full" wire:model.defer="criteria_id" @disabled($readonly)>
                    <option value="">Pilih criteria</option>
                    @foreach ($criterias as $criteria)
                        <option value="{{ $criteria->id }}">
                            {{ $criteria->code }} - {{ $criteria->name }}
                        </option>
                    @endforeach
                </select>
                @error('criteria_id')
                    <p class="text-sm text-error mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label" for="value-score">
                    <span class="label-text">Nilai</span>
                </label>
                <input
                    id="value-score"
                    type="number"
                    min="0"
                    step="0.01"
                    class="input w-full"
                    wire:model.defer="value"
                    @disabled($readonly)
                    placeholder="85"
                />
                @error('value')
                    <p class="text-sm text-error mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2 flex items-center gap-2">
                @if ($readonly)
                    <a href="{{ route('values.index') }}" class="btn btn-ghost" wire:navigate>
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
