<div class="card w-full bg-base-100 shadow-sm">
    <div class="card-body">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="card-title">Data Criteria</h2>
            <div class="flex flex-col sm:flex-row gap-2 sm:items-center">
                <input
                    type="text"
                    class="input w-full sm:max-w-xs"
                    placeholder="Cari kode, nama, tipe"
                    wire:model.live.debounce.400ms="search"
                />
                <a href="{{ route('criteria.create') }}" class="btn btn-primary" wire:navigate>
                    Tambah
                </a>
            </div>
        </div>

        <div class="w-full overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Indikator</th>
                        <th>Satuan</th>
                        <th>Bobot</th>
                        <th>Tipe</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($criterias as $criteria)
                        <tr>
                            <td>{{ $criteria->code }}</td>
                            <td>{{ $criteria->name }}</td>
                            <td>{{ $criteria->indicator }}</td>
                            <td>{{ $criteria->unit }}</td>
                            <td>{{ number_format($criteria->weight, 2) }}</td>
                            <td class="uppercase">{{ $criteria->type }}</td>
                            <td class="text-right">
                                <div class="inline-flex gap-2">
                                    <a
                                        href="{{ route('criteria.show', $criteria->id) }}"
                                        class="btn btn-sm"
                                        wire:navigate
                                    >
                                        Detail
                                    </a>
                                    <a
                                        href="{{ route('criteria.edit', $criteria->id) }}"
                                        class="btn btn-sm"
                                        wire:navigate
                                    >
                                        Edit
                                    </a>
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-error"
                                        wire:click="delete({{ $criteria->id }})"
                                        wire:confirm="Hapus criteria ini? Nilai terkait akan ikut terhapus."
                                    >
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data criteria.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>
            {{ $criterias->links() }}
        </div>
    </div>
</div>
