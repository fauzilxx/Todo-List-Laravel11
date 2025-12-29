<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow - Kelola Tugas dengan Mudah</title>
    <link rel="stylesheet" href="{{ asset('css/todo.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
    <div class="main-container">
        <header class="app-header">
            <div class="brand">
                <div class="brand-icon">
                    <img src="{{ asset('images/icon-todo.png') }}" alt="icon-todo">
                </div>
                <div class="brand-content">
                    <h1>To Do List</h1>
                    <p class="brand-tagline">Kelola tugas dengan mudah</p>
                </div>
            </div>
            <div class="header-right" style="display: flex; align-items: center; gap: 20px;">
                <div class="header-date">
                    <div class="date-label">{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l') }}</div>
                    <div class="date-value">{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y') }}</div>
                </div>
                <div class="user-menu">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-logout"
                            style="background: none; border: 1px solid #1f2937; color: #1f2937; padding: 8px 16px; border-radius: 8px; cursor: pointer; font-size: 14px; display: flex; align-items: center; gap: 8px;">
                            <span class="material-symbols-outlined" style="font-size: 20px;">logout</span>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </header>

        @if(session('success'))
            <div class="alert alert-success">
                <span class="material-symbols-outlined">check_circle</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="stats-grid">
            <div class="stat-card total">
                <div class="stat-icon">
                    <img src="{{ asset('images/bar-chart.png') }}" alt="Total">
                </div>
                <div class="stat-content">
                    <h3>{{ $stats['total'] }}</h3>
                    <p class="stat-label">Total Tugas</p>
                </div>
            </div>
            <div class="stat-card completed">
                <div class="stat-icon">
                    <span class="material-symbols-outlined">checklist</span>
                </div>
                <div class="stat-content">
                    <h3>{{ $stats['completed'] }}</h3>
                    <p class="stat-label">Selesai</p>
                </div>
            </div>
            <div class="stat-card today">
                <div class="stat-icon">
                    <span class="material-symbols-outlined">schedule</span>
                </div>
                <div class="stat-content">
                    <h3>{{ $stats['today'] }}</h3>
                    <p class="stat-label">Hari Ini</p>
                </div>
            </div>
            <div class="stat-card overdue">
                <div class="stat-icon">
                    <img src="{{ asset('images/alert.png') }}" alt="Terlambat">
                </div>
                <div class="stat-content">
                    <h3>{{ $stats['overdue'] }}</h3>
                    <p class="stat-label">Terlambat</p>
                </div>
            </div>
        </div>

        <div class="content-grid">
            <!-- Panel Tambah Tugas -->
            <div class="panel">
                <div class="panel-header">
                    <span class="material-symbols-outlined">add</span>
                    <h2 class="panel-title">Tambah Baru</h2>
                </div>

                <form method="POST" action="/tasks">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Apa yang perlu dikerjakan?</label>
                        <input type="text" name="title" class="form-input"
                            placeholder="Contoh: Menyelesaikan laporan bulanan" value="{{ old('title') }}" required
                            minlength="3">
                        @error('title')
                            <p class="form-hint" style="color: var(--danger-color);">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Tipe</label>
                            <select name="type" class="form-select">
                                <option value="">Pilih tipe...</option>
                                <option value="Tugas" {{ old('type') == 'Tugas' ? 'selected' : '' }}>Tugas</option>
                                <option value="Meeting" {{ old('type') == 'Meeting' ? 'selected' : '' }}>Meeting</option>
                                <option value="Kegiatan" {{ old('type') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Urgensi</label>
                            <select name="urgency" class="form-select">
                                <option value="">Pilih urgensi...</option>
                                <option value="Penting" {{ old('urgency') == 'Penting' ? 'selected' : '' }}>Penting
                                </option>
                                <option value="Mendesak" {{ old('urgency') == 'Mendesak' ? 'selected' : '' }}>Mendesak
                                </option>
                                <option value="Santai" {{ old('urgency') == 'Santai' ? 'selected' : '' }}>Santai</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Deadline</label>
                        <input type="date" name="deadline" class="form-input" value="{{ old('deadline') }}"
                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                        <p class="form-hint">Opsional - Pilih tanggal deadline</p>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Catatan (opsional)</label>
                        <textarea name="description" class="form-textarea"
                            placeholder="Detail tambahan...">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tags (opsional)</label>
                        <input type="text" name="tags" class="form-input"
                            placeholder="Contoh: Urgent, Pekerjaan, Pribadi" value="{{ old('tags') }}">
                        <p class="form-hint">Pisahkan dengan koma</p>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        <span>Tambah</span>
                    </button>
                </form>
            </div>

            <!-- Panel Daftar Tugas -->
            <div class="panel">
                <div class="panel-header">
                    <span class="material-symbols-outlined">note</span>
                    <h2 class="panel-title">Daftar Tugas</h2>
                </div>

                <div class="task-tabs">
                    <button class="tab-button active" onclick="showTab('aktif')">
                        AKTIF <span class="tab-count">{{ $activeTasks->count() }}</span>
                    </button>
                    <button class="tab-button" onclick="showTab('selesai')">
                        SELESAI <span class="tab-count">{{ $completedTasks->count() }}</span>
                    </button>
                </div>

                <div id="tab-aktif" class="task-list">
                    @forelse($activeTasks as $task)
                        <div class="task-card {{ $task->is_overdue ? 'overdue' : '' }}">
                            <div class="task-header">
                                <form method="POST" action="/tasks/{{ $task->id }}/toggle" style="display: inline;">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="task-checkbox">
                                        @if($task->is_done)
                                            <span class="material-symbols-outlined" style="font-size: 16px;">check</span>
                                        @endif
                                    </button>
                                </form>
                                <div style="flex: 1;">
                                    <h3 class="task-title">{{ $task->title }}</h3>

                                    @if($task->type || $task->urgency || $task->tags)
                                        <div class="task-tags">
                                            @if($task->type)
                                                <span class="tag type-{{ strtolower($task->type) }}">{{ $task->type }}</span>
                                            @endif
                                            @if($task->urgency)
                                                <span
                                                    class="tag urgency-{{ strtolower($task->urgency) }}">{{ $task->urgency }}</span>
                                            @endif
                                            @if($task->tags)
                                                @foreach($task->tags as $tag)
                                                    <span class="tag">{{ $tag }}</span>
                                                @endforeach
                                            @endif
                                        </div>
                                    @endif

                                    @if($task->description)
                                        <p class="task-description">{{ $task->description }}</p>
                                    @endif
                                </div>
                                <div class="task-actions">
                                    <form method="POST" action="/tasks/{{ $task->id }}" style="display: inline;">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-icon btn-delete"
                                            onclick="return confirm('Yakin ingin menghapus task ini?')">
                                            <span class="material-symbols-outlined">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            @if($task->deadline)
                                <div class="task-footer">
                                    <div
                                        class="task-deadline {{ $task->is_overdue ? 'overdue' : ($task->deadline->isToday() ? 'today' : '') }}">
                                        <span class="material-symbols-outlined" style="font-size: 16px;">calendar_today</span>
                                        <span>
                                            @if($task->is_overdue)
                                                Terlambat - {{ $task->formatted_deadline }}
                                            @elseif($task->deadline->isToday())
                                                Hari ini - {{ $task->formatted_deadline }}
                                            @else
                                                {{ $task->formatted_deadline }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="empty-state">
                            <div class="empty-icon"><span class="material-symbols-outlined">note</span></div>
                            <p class="empty-text">Tidak ada task aktif. Tambahkan task baru untuk memulai!</p>
                        </div>
                    @endforelse
                </div>

                <div id="tab-selesai" class="task-list" style="display: none;">
                    @forelse($completedTasks as $task)
                        <div class="task-card completed">
                            <div class="task-header">
                                <form method="POST" action="/tasks/{{ $task->id }}/toggle" style="display: inline;">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="task-checkbox checked">
                                        <span class="material-symbols-outlined"
                                            style="font-size: 16px; color: white;">check</span>
                                    </button>
                                </form>
                                <div style="flex: 1;">
                                    <h3 class="task-title">{{ $task->title }}</h3>

                                    @if($task->type || $task->urgency || $task->tags)
                                        <div class="task-tags">
                                            @if($task->type)
                                                <span class="tag type-{{ strtolower($task->type) }}">{{ $task->type }}</span>
                                            @endif
                                            @if($task->urgency)
                                                <span
                                                    class="tag urgency-{{ strtolower($task->urgency) }}">{{ $task->urgency }}</span>
                                            @endif
                                            @if($task->tags)
                                                @foreach($task->tags as $tag)
                                                    <span class="tag">{{ $tag }}</span>
                                                @endforeach
                                            @endif
                                        </div>
                                    @endif

                                    @if($task->description)
                                        <p class="task-description">{{ $task->description }}</p>
                                    @endif
                                </div>
                                <div class="task-actions">
                                    <form method="POST" action="/tasks/{{ $task->id }}" style="display: inline;">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-icon btn-delete"
                                            onclick="return confirm('Yakin ingin menghapus task ini?')">
                                            <span class="material-symbols-outlined">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            @if($task->deadline)
                                <div class="task-footer">
                                    <div class="task-deadline">
                                        <span class="material-symbols-outlined" style="font-size: 16px;">calendar_today</span>
                                        <span>{{ $task->formatted_deadline }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="empty-state">
                            <div class="empty-icon"><span class="material-symbols-outlined">checklist</span></div>
                            <p class="empty-text">Belum ada task yang selesai.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <script>
        function showTab(tabName) {
            document.getElementById('tab-aktif').style.display = 'none';
            document.getElementById('tab-selesai').style.display = 'none';
            document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
            document.getElementById('tab-' + tabName).style.display = 'flex';
            event.currentTarget.classList.add('active');
        }
    </script>
</body>

</html>