@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-lg px-4 py-4 min-h-screen relative">
    
    <div class="animate-fade-in flex items-center justify-between mb-4">
        <div>
            <h1 class="text-xl font-bold text-foreground">Tim Karyawan</h1>
            <p class="text-sm text-muted-foreground">{{ count($employees) }} anggota tim</p>
        </div>
        <button onclick="toggleModal('addEmployeeModal')" class="h-10 w-10 flex items-center justify-center rounded-xl bg-primary text-primary-foreground hover:bg-primary/90 shadow-card">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        </button>
    </div>

    <div class="space-y-3 pb-20">
        @foreach($employees as $employee)
        <div class="animate-slide-up rounded-2xl border border-border bg-card p-4 shadow-card hover:border-border/80 transition relative">
            
            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="absolute top-2 right-2" onsubmit="return confirm('Hapus data karyawan ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="p-2 text-muted-foreground hover:text-destructive transition-colors">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            </form>

            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-accent text-2xl">
                    👨‍💼
                </div>
                
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2">
                        <p class="truncate text-sm font-semibold text-foreground">{{ $employee->name }}</p>
                        <span class="shrink-0 rounded-full px-2 py-0.5 text-[10px] font-medium {{ $employee->status == 'active' ? 'bg-success/10 text-success' : 'bg-warning/10 text-warning' }}">
                            {{ ucfirst($employee->status) }}
                        </span>
                    </div>
                    <p class="text-xs text-muted-foreground">{{ $employee->role }}</p>
                </div>
            </div>

            <div class="mt-3 flex flex-wrap gap-3 border-t border-border pt-3">
                <div class="flex items-center gap-1.5 text-xs text-muted-foreground">
                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    {{ $employee->phone }}
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div id="addEmployeeModal" class="fixed inset-0 z-[60] hidden">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity" onclick="toggleModal('addEmployeeModal')"></div>
        <div class="absolute bottom-0 left-0 right-0 bg-card rounded-t-3xl p-6 animate-slide-in-bottom max-w-lg mx-auto border-t border-border shadow-2xl">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-foreground">Tambah Karyawan</h2>
                <button onclick="toggleModal('addEmployeeModal')" class="p-2 bg-secondary rounded-full text-secondary-foreground">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <form action="{{ route('employees.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="space-y-1">
                    <label class="text-xs font-medium text-muted-foreground">Nama Lengkap</label>
                    <input type="text" name="name" required class="w-full rounded-xl bg-background border border-border px-4 py-3 text-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary text-foreground">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-xs font-medium text-muted-foreground">Jabatan</label>
                        <select name="role" class="w-full rounded-xl bg-background border border-border px-4 py-3 text-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary text-foreground">
                            <option value="Kasir">Kasir</option>
                            <option value="Gudang">Gudang</option>
                            <option value="Supervisor">Supervisor</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-medium text-muted-foreground">Status</label>
                        <select name="status" class="w-full rounded-xl bg-background border border-border px-4 py-3 text-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary text-foreground">
                            <option value="active">Aktif</option>
                            <option value="cuti">Cuti</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-medium text-muted-foreground">No. HP</label>
                    <input type="text" name="phone" required class="w-full rounded-xl bg-background border border-border px-4 py-3 text-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary text-foreground">
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-medium text-muted-foreground">Tanggal Bergabung</label>
                    <input type="date" name="joined_at" required class="w-full rounded-xl bg-background border border-border px-4 py-3 text-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary text-foreground">
                </div>

                <button type="submit" class="w-full bg-primary text-primary-foreground font-bold py-3 rounded-xl shadow-lg active:scale-95 transition-transform mt-2">
                    Simpan Data
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.toggle('hidden');
    }
</script>
@endsection