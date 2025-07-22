<h2>Halo {{ $order->picUser->name }},</h2>

<p>Anda telah ditugaskan sebagai PIC untuk sebuah <strong>Work Order baru</strong>.</p>

<p>Berikut informasi ringkas mengenai tugas tersebut:</p>

<ul>
    <li><strong>Judul Pekerjaan:</strong> {{ $order->title }}</li>
    <li><strong>Deskripsi:</strong> {{ $order->description }}</li>
    <li><strong>Objek Terkait:</strong> {{ $order->item?->name ?? '-' }}</li>
    <li><strong>Kategori Pekerjaan:</strong> {{ $order->category?->name ?? '-' }}</li>
    <li><strong>Tanggal Permintaan:</strong> {{ \Carbon\Carbon::parse($order->create_date)->format('d M Y') }}</li>
</ul>

<p>Silakan akses sistem Work Order untuk melihat detail lebih lanjut dan segera menangani pekerjaan ini sesuai
    prioritas. Atau klik link dibawah ini</p>
<p>
    <a href="{{ url('/order/' . $order->id) }}"
        style="background-color:#1d72b8;color:#fff;padding:10px 20px;text-decoration:none;border-radius:5px;"
        target="_blank">
        Lihat Detail Work Order
    </a>
</p>

<p>Terima kasih atas perhatian dan kerjasamanya.</p>

<p>Salam,<br>Sistem Work Order</p>
