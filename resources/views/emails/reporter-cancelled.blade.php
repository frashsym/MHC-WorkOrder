<h2>Halo {{ $order->reporterUser->name }},</h2>

<p>Kami ingin memberitahukan bahwa Work Order dengan judul <strong>{{ $order->title }}</strong> telah <strong>dibatalkan</strong>.</p>

<p><strong>Alasan pembatalan:</strong> {{ $order->description }}</p>

<p>Jika Anda memerlukan klarifikasi lebih lanjut, silakan hubungi departemen terkait atau periksa detail Work Order melalui tautan berikut:</p>

<p>
    <a href="{{ url('/order/' . $order->id) }}" style="background-color:#dc3545;color:#fff;padding:10px 20px;text-decoration:none;border-radius:5px;" target="_blank">
        Lihat Detail Work Order
    </a>
</p>

<p>Terima kasih atas pengertiannya.</p>

<p>Salam,<br>Sistem Work Order</p>
