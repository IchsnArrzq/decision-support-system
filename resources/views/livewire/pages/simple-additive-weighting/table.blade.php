<div class="card w-full">
    <div class="w-full overflow-x-auto">
        <table class="table">
            <thead>
                <tr>
                    <th>Ranking</th>
                    <th>Nama</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $i => $row)
                    <tr>
                        <td>
                            @if ($i == 0)
                                🥇
                            @elseif($i == 1)
                                🥈
                            @elseif($i == 2)
                                🥉
                            @else
                                {{ $i + 1 }}
                            @endif
                        </td>
                        <td>
                            {{ $row['name'] }}
                        </td>
                        <td>
                            {{ $row['score'] }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
