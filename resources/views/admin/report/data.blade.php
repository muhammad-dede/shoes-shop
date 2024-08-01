@forelse ($data as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->no_order ?? '-' }}</td>
        <td>{{ $item->user?->name ?? '-' }}</td>
        <td>{{ \Carbon\Carbon::parse($item->created_at ?? '-')->isoFormat('D MMMM Y') }}
        </td>
        <td>Rp.&nbsp;{{ number_format($item->total_price ?? '0', 0, ',', '.') }}</td>
        <td>Rp.&nbsp;{{ number_format($item->discount_amount ?? '0', 0, ',', '.') }}</td>
        <td>Rp.&nbsp;{{ number_format($item->payment_amount ?? '0', 0, ',', '.') }}</td>
    </tr>
@empty
    <tr>
        <td colspan="7">
            <div class="text-center">
                {{ __('Data tidak tersedia') }}
            </div>
        </td>
    </tr>
@endforelse
