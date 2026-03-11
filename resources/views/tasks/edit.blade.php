<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tugas</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background: #b8c8e8;
            font-family: Arial, sans-serif;
            min-height: 100vh;
            padding: 20px;
        }

        .page-title {
            color: #1a3a6e;
            font-weight: 900;
            font-size: 36px;
            font-family: Impact, 'Arial Black', sans-serif;
            letter-spacing: 2px;
            margin-bottom: 20px;
        }

        .form-card {
            background: #c8d8ee;
            border-radius: 16px;
            padding: 20px;
            max-width: 440px;
            border: 2px solid #8aabdc;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .field-box {
            background: #d0daf0;
            border-radius: 8px;
            padding: 10px 14px;
            cursor: default;
        }
        .field-box.clickable { cursor: pointer; }

        .field-label {
            font-weight: 700;
            font-size: 13px;
            color: #1a3a6e;
            font-family: Arial, sans-serif;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .field-hint {
            font-size: 12px;
            color: #6677aa;
            font-weight: 400;
            font-family: Arial, sans-serif;
            letter-spacing: 0.3px;
        }

        .field-input {
            width: 100%;
            border: none;
            background: transparent;
            font-size: 12px;
            color: #1a3a6e;
            font-weight: 400;
            outline: none;
            font-family: Arial, sans-serif;
            letter-spacing: 0.3px;
        }
        .field-input::placeholder { color: #6677aa; }

        /* Difficulty dropdown */
        .diff-dropdown { position: relative; }
        .diff-options {
            display: none;
            position: absolute;
            top: 100%; left: 0; right: 0;
            background: #1e3a7a;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #4a6fc0;
            z-index: 50;
            box-shadow: 0 4px 20px rgba(0,0,0,0.4);
        }
        .diff-options.open { display: block; }
        .diff-option {
            padding: 10px 14px;
            font-weight: 900;
            font-size: 16px;
            font-family: Impact, 'Arial Black', sans-serif;
            cursor: pointer;
            letter-spacing: 1px;
            border-bottom: 1px solid #2d4a8a;
            transition: background 0.15s;
        }
        .diff-option:last-child { border-bottom: none; }
        .diff-option:hover { background: #2d5aa0; }
        .diff-easy   { color: #22c55e; }
        .diff-medium { color: #eab308; }
        .diff-hard   { color: #ef4444; }

        /* Date picker overlay */
        .datepicker-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            align-items: center;
            justify-content: center;
            z-index: 100;
        }
        .datepicker-overlay.open { display: flex; }
        .datepicker-modal {
            background: #1e3a7a;
            border-radius: 16px;
            padding: 20px;
            width: 300px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.5);
            border: 2px solid #4a6fc0;
        }
        .dp-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .dp-label    { color: white;   font-weight: 700; font-size: 16px; font-family: Arial; }
        .dp-sublabel { color: #aac4f0; font-weight: 700; font-family: Arial; }
        .dp-nav {
            background: #2d5aa0; color: white;
            border: 1px solid #4a6fc0; border-radius: 6px;
            padding: 4px 10px; cursor: pointer; font-size: 16px; font-weight: 700;
        }
        .dp-grid-header {
            display: grid; grid-template-columns: repeat(7, 1fr);
            gap: 4px; margin-bottom: 6px;
        }
        .dp-grid-header div { color: #88a4d0; font-size: 10px; text-align: center; font-weight: 700; }
        .dp-grid {
            display: grid; grid-template-columns: repeat(7, 1fr);
            gap: 4px; margin-bottom: 14px;
        }
        .dp-cell {
            aspect-ratio: 1; display: flex; align-items: center; justify-content: center;
            border-radius: 50%; color: white; font-size: 12px;
            cursor: pointer; transition: background 0.15s;
        }
        .dp-cell:hover { background: #2d5aa0; }
        .dp-cell.selected { background: linear-gradient(135deg, #e84040, #ff6644); font-weight: 700; }
        .dp-cell.empty { cursor: default; }
        .dp-cell.empty:hover { background: transparent; }
        .dp-actions { display: flex; justify-content: space-between; }
        .dp-btn { border: none; border-radius: 8px; padding: 8px 18px; cursor: pointer; font-weight: 700; font-size: 13px; font-family: Arial; }
        .dp-btn-cancel  { background: #334466; color: white; }
        .dp-btn-confirm { background: #2d5aa0; color: white; }

        /* Form buttons */
        .form-actions { display: flex; justify-content: space-between; margin-top: 8px; }
        .btn-primary {
            background: #2d5aa0; color: white; border: none;
            border-radius: 8px; padding: 10px 24px;
            font-weight: 400; font-size: 14px; cursor: pointer;
            letter-spacing: 0.5px; font-family: Arial, sans-serif;
        }
        .btn-primary:hover { background: #3a6fc0; }
        .btn-back {
            background: #2d5aa0; color: white; border: none;
            border-radius: 8px; padding: 10px 24px;
            font-weight: 400; font-size: 14px; cursor: pointer;
            letter-spacing: 0.5px; font-family: Arial, sans-serif;
            text-decoration: none; display: inline-block;
        }
        .btn-back:hover { background: #3a6fc0; }
    </style>
</head>
<body>

    <div class="page-title">EDIT</div>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST" id="edit-form">
        @csrf
        @method('PUT')

        <!-- Hidden actual inputs -->
        <input type="hidden" name="deadline"  id="deadline-hidden"  value="{{ $task->deadline }}">
        <input type="hidden" name="prioritas" id="prioritas-hidden" value="{{ $task->prioritas }}">
        <input type="hidden" name="status"    value="{{ $task->status }}">

        <div class="form-card">

            <!-- Nama Tugas -->
            <div class="field-box">
                <div class="field-label">Nama Tugas:</div>
                <input
                    type="text"
                    name="nama_tugas"
                    class="field-input"
                    value="{{ $task->nama_tugas }}"
                    placeholder="Masukkan nama tugas..."
                    required
                >
            </div>

            <!-- Deadline -->
            <div class="field-box clickable" onclick="openDatePicker()">
                <div class="field-label">
                    Deadline: <span style="font-size:16px;">📅</span>
                </div>
                <div class="field-hint" id="deadline-display">
                    @php
                        $d = \Carbon\Carbon::parse($task->deadline);
                        $monthNames = ['JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC'];
                    @endphp
                    {{ $d->day . ' ' . $monthNames[$d->month - 1] . ' ' . $d->year }}
                </div>
            </div>

            <!-- Jam Deadline -->
            <div class="field-box">
                <div class="field-label">Jam Deadline:</div>
                <input
                    type="time"
                    name="deadline_time"
                    class="field-input"
                    value="{{ $task->deadline_time ?? '23:59' }}"
                    required
                >
            </div>

            <!-- Prioritas -->
            <div class="diff-dropdown">
                <div class="field-box clickable" onclick="toggleDiff()">
                    <div class="field-label">Prioritas: ▾</div>
                    @php
                        $p = strtolower($task->prioritas);
                        $diffLabel = $p === 'tinggi' ? 'HARD' : ($p === 'sedang' ? 'MEDIUM' : 'EASY');
                        $diffClass = $p === 'tinggi' ? 'diff-hard' : ($p === 'sedang' ? 'diff-medium' : 'diff-easy');
                    @endphp
                    <div class="field-hint {{ $diffClass }}" id="diff-display"
                         style="font-weight:900; font-size:16px; font-family:Impact,'Arial Black',sans-serif; letter-spacing:1px;">
                        {{ $diffLabel }}
                    </div>
                </div>
                <div class="diff-options" id="diff-options">
                    <div class="diff-option diff-easy"   onclick="selectDiff('rendah', 'EASY',   'diff-easy')">EASY</div>
                    <div class="diff-option diff-medium" onclick="selectDiff('sedang', 'MEDIUM', 'diff-medium')">MEDIUM</div>
                    <div class="diff-option diff-hard"   onclick="selectDiff('tinggi', 'HARD',   'diff-hard')">HARD</div>
                </div>
            </div>

            <!-- Actions -->
            <div class="form-actions">
                <button type="submit" class="btn-primary">Update</button>
                <a href="{{ route('tasks.index') }}" class="btn-back">Kembali</a>
            </div>

        </div>
    </form>

    <!-- Date Picker Modal -->
    <div class="datepicker-overlay" id="datepicker-overlay" onclick="closeDatePickerOutside(event)">
        <div class="datepicker-modal">
            <div class="dp-row">
                <button class="dp-nav" onclick="changeYear(-1)">‹</button>
                <span class="dp-label" id="dp-year"></span>
                <button class="dp-nav" onclick="changeYear(1)">›</button>
            </div>
            <div class="dp-row">
                <button class="dp-nav" onclick="changeMonth(-1)">‹</button>
                <span class="dp-sublabel" id="dp-month"></span>
                <button class="dp-nav" onclick="changeMonth(1)">›</button>
            </div>
            <div class="dp-grid-header">
                <div>Mo</div><div>Tu</div><div>We</div><div>Th</div><div>Fr</div><div>Sa</div><div>Su</div>
            </div>
            <div class="dp-grid" id="dp-grid"></div>
            <div class="dp-actions">
                <button class="dp-btn dp-btn-cancel"  onclick="closeDatePicker()">Batal</button>
                <button class="dp-btn dp-btn-confirm" onclick="confirmDate()">Pilih Tanggal</button>
            </div>
        </div>
    </div>

    <script>
        const FULL_MONTHS  = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        const SHORT_MONTHS = ['JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC'];

        // Init date picker from existing deadline
        const existingDeadline = '{{ $task->deadline }}';
        const initDate = existingDeadline ? new Date(existingDeadline) : new Date();
        let dpYear  = initDate.getFullYear();
        let dpMonth = initDate.getMonth();
        let dpDay   = initDate.getDate();

        // ── DIFFICULTY ──
        function toggleDiff() {
            document.getElementById('diff-options').classList.toggle('open');
        }
        function selectDiff(value, label, colorClass) {
            document.getElementById('prioritas-hidden').value = value;
            const display = document.getElementById('diff-display');
            display.textContent     = label;
            display.style.fontWeight  = '900';
            display.style.fontSize    = '16px';
            display.style.fontFamily  = "Impact, 'Arial Black', sans-serif";
            display.style.letterSpacing = '1px';
            display.className = 'field-hint ' + colorClass;
            document.getElementById('diff-options').classList.remove('open');
        }
        document.addEventListener('click', function(e) {
            const dd = document.querySelector('.diff-dropdown');
            if (!dd.contains(e.target)) document.getElementById('diff-options').classList.remove('open');
        });

        // ── DATE PICKER ──
        function openDatePicker()  {
            renderDPGrid();
            document.getElementById('datepicker-overlay').classList.add('open');
        }
        function closeDatePicker() {
            document.getElementById('datepicker-overlay').classList.remove('open');
        }
        function closeDatePickerOutside(e) {
            if (e.target === document.getElementById('datepicker-overlay')) closeDatePicker();
        }
        function changeYear(d)  { dpYear += d; renderDPGrid(); }
        function changeMonth(d) {
            dpMonth += d;
            if (dpMonth < 0)  { dpMonth = 11; dpYear--; }
            if (dpMonth > 11) { dpMonth = 0;  dpYear++; }
            renderDPGrid();
        }
        function renderDPGrid() {
            document.getElementById('dp-year').textContent  = dpYear;
            document.getElementById('dp-month').textContent = FULL_MONTHS[dpMonth];

            const firstDay    = new Date(dpYear, dpMonth, 1).getDay();
            const daysInMonth = new Date(dpYear, dpMonth + 1, 0).getDate();
            const offset      = (firstDay + 6) % 7;
            const grid        = document.getElementById('dp-grid');
            grid.innerHTML    = '';

            for (let i = 0; i < offset; i++) {
                const c = document.createElement('div');
                c.className = 'dp-cell empty';
                grid.appendChild(c);
            }
            for (let d = 1; d <= daysInMonth; d++) {
                const c = document.createElement('div');
                c.className = 'dp-cell' + (d === dpDay ? ' selected' : '');
                c.textContent = d;
                c.onclick = () => { dpDay = d; renderDPGrid(); };
                grid.appendChild(c);
            }
        }
        function confirmDate() {
            const pad = n => String(n).padStart(2, '0');
            const val = `${dpYear}-${pad(dpMonth+1)}-${pad(dpDay)}`;
            document.getElementById('deadline-hidden').value = val;
            document.getElementById('deadline-display').textContent =
                `${dpDay} ${SHORT_MONTHS[dpMonth]} ${dpYear}`;
            document.getElementById('deadline-display').style.color = '#1a3a6e';
            closeDatePicker();
        }
    </script>

</body>
</html>