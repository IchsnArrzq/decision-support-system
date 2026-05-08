<div class="space-y-6">
    <marquee behavior="" direction="" class="h-80">
        <div class="card bg-base-100 shadow-amber-300 w-100 text-wrap shadow-xl">
            <div class="card-body">
                <h2 class="card-title">SPK Pemilihan Kendaraan Motor - TOPSIS</h2>
                <h5>ichsan arrizqi</h5>
                <h5>231011401256</h5>
            </div>
        </div>
    </marquee>
    <div class="text-xl font-bold" id="time"></div>
    <script>
        function updateTime() {
            const now = new Date();
            document.getElementById('time').innerText = now.toLocaleDateString() + ' ' + now.toLocaleTimeString();
            // tampilkan tanggal dan waktu dalam format lokal Y-m-d H:i:s
            // document.getElementById('time').innerText = now.toISOString().slice(0, 19).replace('T', ' ');
        }
        updateTime()
        setInterval(updateTime, 1000);
    </script>
    {{-- <div class="card w-full bg-base-100 shadow-sm">
        <div class="card-body p-0">
            <div class="w-full overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Parameter / Indikator</th>
                            <th>Sifat</th>
                            <th>Bobot</th>
                            <th>Satuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($criterias as $criteria)
                            <tr>
                                <td>{{ $criteria->code }}</td>
                                <td>
                                    <div class="font-semibold">{{ $criteria->name }}</div>
                                    <div class="text-xs opacity-70">{{ $criteria->indicator }}</div>
                                </td>
                                <td class="uppercase">{{ $criteria->type }}</td>
                                <td>{{ number_format($criteria->weight, 2) }}</td>
                                <td>{{ $criteria->unit }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}

    <div class="card w-full bg-base-100 shadow-sm">
        <div class="card-body p-0">
            <div class="w-full overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Ranking</th>
                            <th>Kode</th>
                            <th>Merk</th>
                            <th>Model</th>
                            <th>Kategori</th>
                            <th>Transmisi</th>
                            <th>Harga OTR</th>
                            <th>Skor TOPSIS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($results as $row)
                            <tr>
                                <td>{{ $row['rank'] }}</td>
                                <td>{{ $row['code'] }}</td>
                                <td>{{ $row['brand'] }}</td>
                                <td>{{ $row['name'] }}</td>
                                <td>{{ $row['category'] }}</td>
                                <td>{{ $row['transmission'] }}</td>
                                <td>Rp {{ number_format($row['price'], 0, ',', '.') }}</td>
                                <td>{{ number_format($row['score'], 4) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Data alternatif dan nilai TOPSIS belum lengkap.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
