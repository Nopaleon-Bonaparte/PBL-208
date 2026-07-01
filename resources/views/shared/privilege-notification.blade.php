@php
  // Ambil notifikasi privilege yang belum lama (misal 5 notifikasi terakhir)
  // berdasarkan session id_role pengguna yang login.
  $role_id = session('id_role');
  $notifications = \Illuminate\Support\Facades\DB::table('privilege_notifications')
      ->where('id_role', $role_id)
      ->orderBy('created_at', 'desc')
      ->limit(3)
      ->get();
@endphp

@if($notifications->count() > 0)
<div style="position: fixed; bottom: 20px; right: 20px; z-index: 9999; display:flex; flex-direction:column; gap:10px;">
  @foreach($notifications as $notif)
    <div style="background: white; border-left: 4px solid {{ $notif->type === 'grant' ? '#10b981' : '#ef4444' }}; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); padding: 15px; border-radius: 6px; width: 300px; display:flex; align-items:start; justify-content:space-between; animation: slideIn 0.3s ease-out;">
      <div>
        <div style="font-weight: bold; font-size:14px; color:#111827; margin-bottom: 4px;">
          @if($notif->type === 'grant')
            <span style="color:#10b981;">✅ Akses Diberikan</span>
          @else
            <span style="color:#ef4444;">⚠️ Akses Dicabut</span>
          @endif
        </div>
        <div style="font-size: 12px; color:#4b5563; line-height: 1.4;">{{ $notif->message }}</div>
        <div style="font-size: 10px; color:#9ca3af; margin-top: 6px;">{{ \Carbon\Carbon::parse($notif->created_at)->diffForHumans() }}</div>
      </div>
      <button onclick="this.parentElement.style.display='none'" style="background:none; border:none; cursor:pointer; font-size:16px; color:#9ca3af;">&times;</button>
    </div>
  @endforeach
</div>

<style>
@keyframes slideIn {
  from { transform: translateX(100%); opacity: 0; }
  to { transform: translateX(0); opacity: 1; }
}
</style>
@endif
