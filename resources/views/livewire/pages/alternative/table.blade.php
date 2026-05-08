<div class="card w-full bg-base-100 shadow-sm">
    <div class="card-body">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="card-title">Data Alternative</h2>
            <div class="flex flex-col sm:flex-row gap-2 sm:items-center">
                <input
                    type="text"
                    class="input w-full sm:max-w-xs"
                    placeholder="Cari kode, nama, brand"
                    wire:model.live.debounce.400ms="search"
                />
                <a href="{{ route('alternatives.create') }}" class="btn btn-primary" wire:navigate>
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
                        <th>Brand</th>
                        <th>Kategori</th>
                        <th>Transmisi</th>
                        <th>Harga</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($alternatives as $alternative)
                        <tr>
                            <td>{{ $alternative->code }}</td>
                            <td>{{ $alternative->name }}</td>
                            <td>{{ $alternative->brand }}</td>
                            <td>{{ $alternative->category }}</td>
                            <td>{{ $alternative->transmission }}</td>
                            <td>Rp {{ number_format($alternative->price, 0, ',', '.') }}</td>
                            <td class="text-right">
                                <div class="inline-flex gap-2">
                                    <a
                                        href="{{ route('alternatives.show', $alternative->id) }}"
                                        class="btn btn-sm"
                                        wire:navigate
                                    >
                                        Detail
                                    </a>
                                    <a
                                        href="{{ route('alternatives.edit', $alternative->id) }}"
                                        class="btn btn-sm"
                                        wire:navigate
                                    >
                                        Edit
                                    </a>
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-error"
                                        wire:click="delete({{ $alternative->id }})"
                                        wire:confirm="Hapus alternative ini?"
                                    >
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data alternative.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>
            {{ $alternatives->links() }}
        </div>
    </div>
</div>
