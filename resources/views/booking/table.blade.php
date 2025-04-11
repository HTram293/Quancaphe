@extends('layouts.main')

@section('content')
<style>
    .booking-container {
        display: flex;
        gap: 2rem;
        max-width: 1200px;
        margin: auto;
        padding: 2rem 1rem;
    }

    /* Bên trái */
    .left-panel {
        flex: 2;
    }

    .section {
        margin-bottom: 2rem;
    }

    .section h2 {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
    }

    /* Bàn dạng grid */
    #table-area {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        gap: 12px;
    }

    .table-box {
        padding: 1rem;
        border-radius: 8px;
        cursor: pointer;
        text-align: center;
        font-weight: 600;
        border: 2px solid transparent;
        transition: 0.3s;
        background-color: white;
    }

    .table-box.selected {
        background-color: #6b7280; /* gray-500 */
        color: white;
    }

    .table-box.booked {
        background-color: #ef4444; /* red-500 */
        color: white;
        cursor: not-allowed;
    }

    .table-box.serving {
        background-color: #22c55e; /* green-500 */
        color: white;
        cursor: not-allowed;
    }

    .legend {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
    }

    .legend-color {
        width: 18px;
        height: 18px;
        border-radius: 4px;
        border: 1px solid #333;
    }

    .white { background-color: white; }
    .gray { background-color: #6b7280; }
    .red { background-color: #ef4444; }
    .green { background-color: #22c55e; }

    /* Bên phải */
    .right-panel {
        flex: 1;
        background-color: #f9fafb;
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    .summary-info p {
        margin-bottom: 0.5rem;
    }

    .btn-group {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 1.5rem;
    }

    button {
        font-weight: 500;
    }
</style>

<div class="booking-container">
    <!-- LEFT SIDE -->
    <div class="left-panel">
        <div class="section">
            <h2>Chọn vị trí bàn</h2>
            <div class="flex flex-wrap gap-3">
                @foreach ($positions as $pos)
                    <button class="px-4 py-2 rounded bg-gray-200 hover:bg-green-300 position-btn" data-type="{{ $pos }}">
                        {{ $pos }}
                    </button>
                @endforeach
            </div>
        </div>

        <div class="section">
            <h2>Chọn bàn</h2>
            <div id="table-area"></div>
        </div>

        <div class="section">
            <h2>Chú thích trạng thái bàn</h2>
            <div class="legend">
                <div class="legend-item"><span class="legend-color white"></span> Bàn trống</div>
                <div class="legend-item"><span class="legend-color red"></span> Đã đặt</div>
                <div class="legend-item"><span class="legend-color green"></span> Đang phục vụ</div>
                <div class="legend-item"><span class="legend-color gray"></span> Đã chọn</div>
            </div>
        </div>

        <div class="section">
            <label for="seating_capacity" class="block font-medium mb-1">Số lượng ghế:</label>
            <select id="seating_capacity" class="border p-2 rounded w-40">
                <option value="">-- Chọn --</option>
                @foreach ([2, 4, 6, 8] as $seat)
                    <option value="{{ $seat }}">{{ $seat }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- RIGHT SIDE -->
    <div class="right-panel">
        <h2 class="text-xl font-bold mb-4">Thông tin đặt bàn</h2>
        <div class="summary-info mb-4">
            <p><strong>Vị trí:</strong> <span id="summary-type">Chưa chọn</span></p>
            <p><strong>Bàn:</strong> <span id="summary-table">Chưa chọn</span></p>
            <p><strong>Số ghế:</strong> <span id="summary-seats">Chưa chọn</span></p>
        </div>

        <div class="btn-group">
            <button id="submit-btn" class="bg-blue-500 text-white px-4 py-2 rounded">Đặt bàn</button>
            <button id="go-payment" class="bg-green-500 text-white px-4 py-2 rounded">Tiến hành thanh toán</button>
            
        </div>
    </div>
</div>

<script>
    const tables = @json($tables);
    let selectedType = '';
    let selectedTable = '';
    let selectedSeats = '';

    document.querySelectorAll('.position-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            selectedType = btn.dataset.type;
            selectedTable = '';
            document.getElementById('summary-type').textContent = selectedType;
            document.getElementById('summary-table').textContent = 'Chưa chọn';
            renderTables(selectedType);
        });
    });

    document.getElementById('seating_capacity').addEventListener('change', e => {
        selectedSeats = e.target.value;
        document.getElementById('summary-seats').textContent = selectedSeats;
    });

    function renderTables(type) {
        const area = document.getElementById('table-area');
        area.innerHTML = '';

        let filtered = tables.filter(t => t.position === type);
        if (filtered.length < 9) {
            const clone = Array.from({ length: 9 - filtered.length }, (_, i) => ({
                table_number: `T_${type}_${i}`,
                status: ['Available', 'booked', 'Occupied'][Math.floor(Math.random() * 3)]
            }));
            filtered = filtered.concat(clone);
        }

        filtered.forEach(table => {
            const div = document.createElement('div');
            div.className = 'table-box';
            div.textContent = table.table_number;

            switch (table.status) {
    case 'Available':
        div.classList.add('available');
        div.addEventListener('click', () => {
            document.querySelectorAll('.table-box.available').forEach(i => i.classList.remove('selected'));
            div.classList.add('selected');
            selectedTable = table.table_number;
            document.getElementById('summary-table').textContent = selectedTable;
        });
        break;
    case 'booked':
        div.classList.add('booked');
        break;
    case 'Occupied': // <- fix: hiển thị đúng nếu có status này
        div.classList.add('serving');
        break;
}



            area.appendChild(div);
        });
    }

    document.getElementById('submit-btn').addEventListener('click', () => {
        if (!selectedType || !selectedTable || !selectedSeats) {
            alert("Vui lòng chọn đầy đủ vị trí, bàn và số ghế.");
            return;
        }

        fetch("{{ route('table.submit') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                selected_type: selectedType,
                selected_table: selectedTable,
                seating_capacity: selectedSeats
            })
        }).then(res => res.json()).then(data => {
            if (data.success) {
                if (confirm("Đặt bàn thành công! Bạn có muốn chuyển sang trang thanh toán?")) {
                    window.location.href = "{{ route('order') }}";
                }
            }
        });
    });

    document.getElementById('go-payment').addEventListener('click', () => {
        if (!selectedTable) {
            if (confirm("Bạn có muốn tiến hành thanh toán mà không đặt bàn?")) {
                window.location.href = "{{ route('order') }}";
            }
        } else {
            window.location.href = "{{ route('order') }}";
        }
    });
</script>
@endsection
