<div class="card w-full bg-base-100 shadow-sm">
    <div class="card-body">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="card-title">Data Value</h2>
            <div class="flex flex-col sm:flex-row gap-2 sm:items-center">
                <input
                    type="text"
                    class="input w-full sm:max-w-xs"
                    placeholder="Cari alternative atau criteria"
                    wire:model.live.debounce.400ms="search"
                />
                <a href="{{ route('values.create') }}" class="btn btn-primary" wire:navigate>
                    Tambah
                </a>
            </div>
        </div>

        <div class="w-full overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>Alternative</th>
                        <th>Criteria</th>
                        <th>Tipe</th>
                        <th>Nilai</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($values as $row)
                        <tr>
                            <td>
                                {{ $row->alternative?->code }} - {{ $row->alternative?->name }}
                            </td>
                            <td>
                                {{ $row->criteria?->code }} - {{ $row->criteria?->name }}
                            </td>
                            <td class="uppercase">{{ $row->criteria?->type }}</td>
                            <td>{{ number_format($row->value, 2) }}</td>
                            <td class="text-right">
                                <div class="inline-flex gap-2">
                                    <a
                                        href="{{ route('values.show', $row->id) }}"
                                        class="btn btn-sm"
                                        wire:navigate
                                    >
                                        Detail
                                    </a>
                                    <a
                                        href="{{ route('values.edit', $row->id) }}"
                                        class="btn btn-sm"
                                        wire:navigate
                                    >
                                        Edit
                                    </a>
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-error"
                                        wire:click="delete({{ $row->id }})"
                                        wire:confirm="Hapus data value ini?"
                                    >
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data value.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>
            {{ $values->links() }}
        </div>
    </div>
</div>
