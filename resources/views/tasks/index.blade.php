<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tugas</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #8aa8d8;
            font-family: Arial, sans-serif;
            min-height: 100vh;
            padding: 16px;
            display: flex;
            gap: 16px;
        }

        /* ── LEFT COLUMN ── */
        .left-col {
            display: flex;
            flex-direction: column;
            gap: 12px;
            flex-shrink: 0;
        }

        /* Hourglass widget */
        .hourglass-widget {
            background: linear-gradient(135deg, #1a3a6e 0%, #2d5aa0 100%);
            border-radius: 16px;
            padding: 14px 10px 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            width: 150px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            border: 2px solid #3a6fc4;
        }

        .hourglass-widget svg {
            display: block;
        }

        #realtime-clock {
            color: white;
            font-family: 'Courier New', monospace;
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 1px;
            text-shadow: 0 0 10px rgba(120, 180, 255, 0.8);
            white-space: nowrap;
        }

        /* Calendar widget */
        .calendar-widget {
            background: #f5e6d0;
            border-radius: 12px;
            padding: 10px;
            width: 150px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.25);
            border: 2px solid #d4a87a;
        }

        .cal-header {
            display: flex;
            gap: 6px;
            align-items: flex-start;
            margin-bottom: 6px;
        }

        .cal-month-name {
            font-size: 32px;
            font-weight: 900;
            color: #1a3a6e;
            font-family: Georgia, serif;
            line-height: 1;
        }

        .cal-year {
            font-size: 10px;
            color: #555;
            margin-top: 2px;
        }

        .cal-day-headers {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1px;
            margin-bottom: 3px;
        }

        .cal-day-header {
            font-size: 7px;
            color: #888;
            text-align: center;
            font-weight: 600;
        }

        .cal-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1px;
        }

        .cal-cell {
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8px;
            border-radius: 50%;
            color: #333;
        }

        .cal-cell.today {
            background: #2d5aa0;
            color: white;
            font-weight: 700;
        }

        .cal-cell.has-task {
            background: linear-gradient(135deg, #e84040, #ff8844);
            color: white;
            font-weight: 700;
        }

        /* ── RIGHT COLUMN ── */
        .right-col {
            flex: 1;
            min-width: 0;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
        }

        .title {
            font-weight: 900;
            font-size: 36px;
            font-family: Impact, 'Arial Black', sans-serif;
            color: #1a3a6e;
            letter-spacing: 3px;
            text-shadow: 2px 2px 0 rgba(0, 0, 0, 0.15);
        }

        .btn-tambah {
            background: #2d5aa0;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 18px;
            font-weight: 400;
            font-size: 14px;
            cursor: pointer;
            font-family: Arial, sans-serif;
            letter-spacing: 0.5px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.25);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-tambah:hover {
            background: #3a6fc0;
        }

        /* Task list container */
        .task-list {
            background: linear-gradient(180deg, #3a5fa8 0%, #4a6fbe 100%);
            border-radius: 14px;
            padding: 12px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
            border: 1px solid #6a8fd8;
        }

        /* Task card */
        .task-card {
            background: linear-gradient(90deg, #2a4a8c 0%, #3a5fa8 100%);
            border-radius: 10px;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            border: 1px solid #4a6fc0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            transition: opacity 0.3s;
        }

        .task-card.selesai {
            opacity: 0.5;
        }

        .task-info {
            flex: 1;
            min-width: 0;
        }

        .task-name {
            color: white;
            font-weight: 700;
            font-size: 13px;
            font-family: Georgia, serif;
        }

        .task-difficulty {
            font-weight: 900;
            font-size: 22px;
            font-family: Impact, 'Arial Black', sans-serif;
            letter-spacing: 1px;
        }

        .diff-easy {
            color: #22c55e;
            text-shadow: 0 0 12px #22c55e88;
        }

        .diff-medium {
            color: #eab308;
            text-shadow: 0 0 12px #eab30888;
        }

        .diff-hard {
            color: #ef4444;
            text-shadow: 0 0 12px #ef444488;
        }

        .btn-hapus {
            background: none;
            border: none;
            color: #aac4f0;
            font-size: 10px;
            cursor: pointer;
            padding: 0;
            font-family: Arial, sans-serif;
            font-weight: 600;
            text-decoration: underline;
            letter-spacing: 0.5px;
        }

        .task-deadline {
            text-align: center;
            min-width: 60px;
        }

        .deadline-label {
            color: #aac4f0;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .deadline-time {
            color: white;
            font-weight: 700;
            font-size: 22px;
            letter-spacing: 1px;
            font-family: monospace;
        }

        .task-right {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 6px;
        }

        .task-date {
            color: white;
            font-weight: 900;
            font-size: 18px;
            font-family: Georgia, serif;
            white-space: nowrap;
        }

        .task-actions {
            display: flex;
            gap: 6px;
        }

        .btn-action {
            color: white;
            border: 1px solid #7ab0f0;
            border-radius: 6px;
            padding: 4px 10px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            letter-spacing: 0.5px;
            font-family: Arial, sans-serif;
            text-decoration: none;
            display: inline-block;
        }

        .btn-edit {
            background: #2d5aa0;
        }

        .btn-selesai {
            background: #1e4080;
            border: none;
        }

        .btn-action:hover {
            opacity: 0.85;
        }

        .empty-state {
            color: #aac4f0;
            text-align: center;
            padding: 30px;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <!-- LEFT COLUMN -->
    <div class="left-col">

        <!-- Hourglass -->
        <div class="hourglass-widget">
            <svg id="hourglass-svg" width="80" height="100" viewBox="0 0 80 100">
                <defs>
                    <clipPath id="topClip">
                        <polygon points="10,5 70,5 45,50 35,50" />
                    </clipPath>
                    <clipPath id="botClip">
                        <polygon points="35,50 45,50 70,95 10,95" />
                    </clipPath>
                    <filter id="glow">
                        <feGaussianBlur stdDeviation="2" result="coloredBlur" />
                        <feMerge>
                            <feMergeNode in="coloredBlur" />
                            <feMergeNode in="SourceGraphic" />
                        </feMerge>
                    </filter>
                </defs>
                <!-- Top sand -->
                <rect id="sand-top" x="0" y="5" width="80" height="36" fill="#60a0e8" opacity="0.85"
                    clip-path="url(#topClip)" />
                <!-- Bottom sand -->
                <rect id="sand-bot" x="0" y="59" width="80" height="0" fill="#4080d0" opacity="0.85"
                    clip-path="url(#botClip)" />
                <!-- Stream -->
                <line id="sand-stream" x1="40" y1="50" x2="40" y2="56" stroke="#a0c8ff" stroke-width="2"
                    opacity="0.9" />
                <!-- Outline -->
                <polygon points="10,5 70,5 45,50 35,50" fill="none" stroke="#7ab8f5" stroke-width="2.5"
                    stroke-linejoin="round" filter="url(#glow)" />
                <polygon points="35,50 45,50 70,95 10,95" fill="none" stroke="#7ab8f5" stroke-width="2.5"
                    stroke-linejoin="round" filter="url(#glow)" />
                <rect x="8" y="3" width="64" height="5" rx="2.5" fill="#7ab8f5" filter="url(#glow)" />
                <rect x="8" y="92" width="64" height="5" rx="2.5" fill="#7ab8f5" filter="url(#glow)" />
                <!-- Stars -->
                <circle cx="20" cy="20" r="1.5" fill="white" opacity="0.6" />
                <circle cx="60" cy="30" r="1" fill="white" opacity="0.5" />
                <circle cx="25" cy="75" r="1.5" fill="white" opacity="0.5" />
            </svg>
            <div id="realtime-clock">00:00</div>
        </div>

        <!-- Calendar -->
        <div class="calendar-widget">
            <div class="cal-header">
                <div class="cal-month-name" id="cal-month"></div>
                <div class="cal-year" id="cal-year"></div>
            </div>
            <div class="cal-day-headers">
                <div class="cal-day-header">Mo</div>
                <div class="cal-day-header">Tu</div>
                <div class="cal-day-header">We</div>
                <div class="cal-day-header">Th</div>
                <div class="cal-day-header">Fr</div>
                <div class="cal-day-header">Sa</div>
                <div class="cal-day-header">Su</div>
            </div>
            <div class="cal-grid" id="cal-grid"></div>
        </div>

    </div>

    <!-- RIGHT COLUMN -->
    <div class="right-col">
        <div class="header">
            <div class="title">TASK LIST</div>
            <a href="{{ route('tasks.create') }}" class="btn-tambah">⊕ Tambah Tugas</a>
        </div>

        <div class="task-list">
            @forelse($tasks as $task)
                @php
                    $diffClass = match (strtolower($task->prioritas)) {
                        'tinggi' => 'diff-hard',
                        'sedang' => 'diff-medium',
                        default => 'diff-easy',
                    };
                    $diffLabel = match (strtolower($task->prioritas)) {
                        'tinggi' => 'HARD',
                        'sedang' => 'MEDIUM',
                        default => 'EASY',
                    };
                    $deadlineDate = \Carbon\Carbon::parse($task->deadline);
                    $monthNames = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];
                    $dateStr = $deadlineDate->day . ' ' . $monthNames[$deadlineDate->month - 1];
                    $timeStr = $task->deadline_time ?? '23:59';
                @endphp

                <div class="task-card {{ $task->status == 'Selesai' ? 'selesai' : '' }}" id="task-{{ $task->id }}">

                    <div class="task-info">
                        <div class="task-name">{{ $task->nama_tugas }}</div>
                        <div class="task-difficulty {{ $diffClass }}">{{ $diffLabel }}</div>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-hapus"
                                onclick="return confirm('Hapus tugas ini?')">HAPUS</button>
                        </form>
                    </div>

                    <div class="task-deadline">
                        <div class="deadline-label">DEADLINE</div>
                        <div class="deadline-time">{{ $timeStr }}</div>
                    </div>

                    <div class="task-right">
                        <div class="task-date">{{ $dateStr }}</div>
                        <div class="task-actions">
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn-action btn-edit">EDIT</a>
                            <form action="{{ route('tasks.update', $task->id) }}" method="POST" style="display:inline;">
                                @csrf @method('PUT')
                                <input type="hidden" name="status"
                                    value="{{ $task->status == 'Selesai' ? 'Belum Selesai' : 'Selesai' }}">
                                <input type="hidden" name="nama_tugas" value="{{ $task->nama_tugas }}">
                                <input type="hidden" name="deadline" value="{{ $task->deadline }}">
                                <input type="hidden" name="prioritas" value="{{ $task->prioritas }}">
                                <button type="submit" class="btn-action btn-selesai">SELESAI</button>
                            </form>
                        </div>
                    </div>

                </div>
            @empty
                <div class="empty-state">Belum ada tugas. Tambahkan tugas baru!</div>
            @endforelse
        </div>
    </div>

    <script>
        // ── REAL-TIME CLOCK ──
        function updateClock() {
            const now = new Date();
            const h = String(now.getHours()).padStart(2, '0');
            const m = String(now.getMinutes()).padStart(2, '0');
            document.getElementById('realtime-clock').textContent = h + ' : ' + m;
        }
        updateClock();
        setInterval(updateClock, 1000);

        // ── CALENDAR ──
        const MONTHS = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];
        // Deadline dates from Laravel (day numbers of current month)
        const deadlineDays = new Set([
            @foreach($tasks as $task)
                @php
                    $d = \Carbon\Carbon::parse($task->deadline);
                    $now = \Carbon\Carbon::now();
                @endphp
                @if($d->month == $now->month && $d->year == $now->year)
                    {{ $d->day }},
                @endif
            @endforeach
        ]);

        function buildCalendar() {
            const now = new Date();
            const year = now.getFullYear();
            const month = now.getMonth();
            const today = now.getDate();

            document.getElementById('cal-month').textContent = MONTHS[month];
            document.getElementById('cal-year').textContent = String(year).slice(-2);

            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const startOffset = (firstDay + 6) % 7;

            const grid = document.getElementById('cal-grid');
            grid.innerHTML = '';

            for (let i = 0; i < startOffset; i++) {
                const cell = document.createElement('div');
                cell.className = 'cal-cell';
                grid.appendChild(cell);
            }
            for (let d = 1; d <= daysInMonth; d++) {
                const cell = document.createElement('div');
                cell.className = 'cal-cell';
                cell.textContent = d;
                if (deadlineDays.has(d)) cell.classList.add('has-task');
                else if (d === today) cell.classList.add('today');
                grid.appendChild(cell);
            }
        }
        buildCalendar();

        // ── HOURGLASS ANIMATION ──
        const DURATION = 8000;
        let start = performance.now();
        let flipped = false;

        function animateHourglass(now) {
            const elapsed = (now - start) % (DURATION * 2);
            const cycle = elapsed < DURATION ? 0 : 1;
            const t = (elapsed % DURATION) / DURATION;

            const sandTop = document.getElementById('sand-top');
            const sandBot = document.getElementById('sand-bot');
            const stream = document.getElementById('sand-stream');
            const svg = document.getElementById('hourglass-svg');

            const topH = Math.max(0, (1 - t) * 36);
            const botH = Math.min(36, t * 36);

            sandTop.setAttribute('y', String(5 + (36 - topH)));
            sandTop.setAttribute('height', String(topH));
            sandBot.setAttribute('y', String(95 - botH));
            sandBot.setAttribute('height', String(botH));

            stream.style.opacity = topH > 1 ? '0.9' : '0';

            const shouldFlip = cycle === 1;
            if (shouldFlip !== flipped) {
                flipped = shouldFlip;
                svg.style.transform = flipped ? 'rotate(180deg)' : 'none';
                svg.style.transition = 'transform 0.6s ease';
            }

            requestAnimationFrame(animateHourglass);
        }
        requestAnimationFrame(animateHourglass);
    </script>

</body>

</html>