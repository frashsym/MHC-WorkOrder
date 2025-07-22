<h2>Halo {{ $order->reporterUser->name }},</h2>

<p>Work Order dengan judul <strong>{{ $order->title }}</strong> telah berhasil diselesaikan oleh PIC yang bertugas.</p>

<p>Terima kasih telah menggunakan Sistem Work Order. Anda dapat melihat detail penyelesaian melalui tautan di bawah ini:</p>

<p>
    <a href="{{ url('/order/' . $order->id) }}" style="background-color:#28a745;color:#fff;padding:10px 20px;text-decoration:none;border-radius:5px;" target="_blank">
        Lihat Detail Work Order
    </a>
</p>

<p>Salam,<br>Sistem Work Order</p>
