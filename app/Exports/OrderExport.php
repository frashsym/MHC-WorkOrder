<?php

namespace App\Exports;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OrderExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $q = Order::with(['department', 'category', 'item', 'picUser', 'reporterUser']);

        // Paksa engineering untuk role_id 4 (sama seperti filter() controller)
        $user = Auth::user();
        if ($user && $user->role_id === 4) {
            $q->where('department_id', 2);
        } else {
            // filter department jika ada dan bukan string kosong
            if (isset($this->filters['department_id']) && $this->filters['department_id'] !== '') {
                $q->where('department_id', $this->filters['department_id']);
            }
        }

        // filter item/objek kalau ada dan bukan string kosong
        if (isset($this->filters['item_id']) && $this->filters['item_id'] !== '') {
            $q->where('item_id', $this->filters['item_id']);
        }

        // filter waktu (mengikuti pola di controller filter())
        if (!empty($this->filters['date_range']) && $this->filters['date_range'] !== 'custom') {
            $now = now();
            switch ($this->filters['date_range']) {
                case 'today':
                    $q->whereDate('create_date', $now->toDateString());
                    break;
                case 'week':
                    // data 7 hari terakhir (sama semantik dengan subWeek)
                    $q->where('create_date', '>=', $now->copy()->subWeek());
                    break;
                case 'month':
                    $q->where('create_date', '>=', $now->copy()->subMonth());
                    break;
                case 'year':
                    $q->where('create_date', '>=', $now->copy()->subYear());
                    break;
            }
        } elseif (
            isset($this->filters['start_date']) && $this->filters['start_date'] !== ''
            && isset($this->filters['end_date']) && $this->filters['end_date'] !== ''
        ) {
            // custom range
            $start = $this->filters['start_date'];
            $end = $this->filters['end_date'];
            $q->whereBetween('create_date', [$start, $end]);
        }

        // Urutkan paling baru berdasarkan created_at
        return $q->orderBy('created_at', 'desc')->get();
    }

    // Helper untuk tanggal + waktu rapi
    private function fmtDateTime($value, string $format = 'Y-m-d H:i')
    {
        if (empty($value))
            return 'None';
        try {
            if ($value instanceof \DateTimeInterface) {
                return $value->format($format);
            }
            return Carbon::parse($value)->format($format);
        } catch (\Throwable $e) {
            return 'None';
        }
    }

    private function val($value)
    {
        return ($value === null || $value === '') ? 'None' : $value;
    }

    // Map per baris
    public function map($o): array
    {
        return [
            $this->val($o->letter_number),
            $this->val($o->title),
            $this->val($o->description),
            $this->val(optional($o->department)->name),
            $this->val(optional($o->category)->name),
            $this->val(optional($o->item)->name),
            $this->val(optional($o->picUser)->name),
            $this->val(optional($o->reporterUser)->name),
            $this->fmtDateTime($o->created_at),
            $this->fmtDateTime($o->updated_at),
        ];
    }

    // Header
    public function headings(): array
    {
        return [
            'Nomor Order',
            'Judul',
            'Deskripsi',
            'Departemen',
            'Kategori',
            'Objek',
            'PIC',
            'Pelapor',
            'Created At',
            'Updated At',
        ];
    }

    // Styling: tiap header cell punya background warna berbeda; isi pakai Times New Roman 12
    public function styles(Worksheet $sheet)
    {
        // definisi font/header umum
        $headerFontArray = [
            'font' => [
                'bold' => true,
                'size' => 13,
                'name' => 'Arial',
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        // Warna background per header cell (A1..J1)
        $colors = [
            'A1' => '1F77B4', // biru
            'B1' => '8C564B', // coklat
            'C1' => '2CA02C', // hijau
            'D1' => '9467BD', // ungu
            'E1' => 'FF7F0E', // oranye
            'F1' => '17BECF', // cyan
            'G1' => 'D62728', // merah
            'H1' => 'BCBD22', // kuning kehijauan
            'I1' => '7F7F7F', // abu
            'J1' => 'E377C2', // pink
        ];

        foreach ($colors as $cell => $color) {
            $sheet->getStyle($cell)->applyFromArray($headerFontArray);
            $sheet->getStyle($cell)->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setRGB($color);
        }

        // Lebarkan kolom sedikit supaya teks nggak ke-wrap aneh
        $sheet->getColumnDimension('A')->setWidth(18); // Nomor Order
        $sheet->getColumnDimension('B')->setWidth(30); // Judul
        $sheet->getColumnDimension('C')->setWidth(40); // Deskripsi
        $sheet->getColumnDimension('D')->setWidth(18); // Departemen
        $sheet->getColumnDimension('E')->setWidth(18); // Kategori
        $sheet->getColumnDimension('F')->setWidth(18); // Objek
        $sheet->getColumnDimension('G')->setWidth(20); // PIC
        $sheet->getColumnDimension('H')->setWidth(20); // Pelapor
        $sheet->getColumnDimension('I')->setWidth(20); // Created At
        $sheet->getColumnDimension('J')->setWidth(20); // Updated At

        // Tinggi header
        $sheet->getRowDimension(1)->setRowHeight(26);

        // Style isi (baris 2 .. akhir)
        $highestRow = $sheet->getHighestRow();
        if ($highestRow < 2)
            $highestRow = 2;
        $sheet->getStyle('A2:J' . $highestRow)->applyFromArray([
            'font' => [
                'name' => 'Times New Roman',
                'size' => 12,
                'color' => ['rgb' => '000000'],
            ],
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
            ],
        ]);
    }
}
