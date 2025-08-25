<?php

namespace App\Exports;

use App\Models\Order;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrderExport implements FromCollection, WithHeadings, WithMapping
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $q = Order::with([
            'department',
            'category',
            'item',
            'picUser',
            'reporterUser',
            'progress',
            'priority'
        ]);

        if (!empty($this->filters['department_id']))
            $q->where('department_id', $this->filters['department_id']);
        if (!empty($this->filters['item_id']))
            $q->where('item_id', $this->filters['item_id']);

        if (!empty($this->filters['date_range'])) {
            switch ($this->filters['date_range']) {
                case 'today':
                    $q->whereDate('created_at', today());
                    break;
                case 'week':
                    $q->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'month':
                    $q->whereMonth('created_at', now()->month);
                    break;
                case 'year':
                    $q->whereYear('created_at', now()->year);
                    break;
                case 'custom':
                    $q->whereBetween('created_at', [
                        $this->filters['start_date'] ?? now()->startOfYear(),
                        $this->filters['end_date'] ?? now(),
                    ]);
                    break;
            }
        }

        return $q->get();
    }

    // ==== Helper aman untuk format tanggal/waktu ====
    private function fmtDate($value, string $format = 'Y-m-d')
    {
        if (empty($value))
            return 'None';
        try {
            if ($value instanceof \DateTimeInterface)
                return $value->format($format);
            return Carbon::parse($value)->format($format);
        } catch (\Throwable $e) {
            return 'None';
        }
    }

    private function fmtDateTime($value, string $format = 'Y-m-d H:i')
    {
        return $this->fmtDate($value, $format);
    }

    private function val($value)
    {
        return ($value === null || $value === '') ? 'None' : $value;
    }
    // =================================================

    public function map($o): array
    {
        return [
            $this->val($o->id),
            $this->val($o->letter_number),
            $this->val($o->title),
            $this->val($o->description),
            $this->val(optional($o->department)->name),
            $this->val(optional($o->category)->name),
            $this->val(optional($o->item)->name),
            $this->val(optional($o->picUser)->name),
            $this->val(optional($o->reporterUser)->name),
            $this->val(optional($o->progress)->name),
            $this->val(optional($o->priority)->name),

            // tanggal tanpa angka-angka berantakan
            $this->fmtDate($o->start_date),
            $this->fmtDate($o->due_date),

            // kalau create_date itu DATE, akan rapi; kalau string pun diparse
            $this->fmtDate($o->create_date),

            // time: kalau mau tetap string, cukup val()
            $this->val($o->create_time),

            // datetime rapi
            $this->fmtDateTime($o->started_at),
            $this->fmtDateTime($o->paused_at),
            $this->fmtDateTime($o->resume_at),

            $this->val($o->total_duration),

            // created_at/updated_at dirapikan ke Y-m-d
            $this->fmtDate($o->created_at),
            $this->fmtDate($o->updated_at),
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nomor Order',
            'Judul',
            'Deskripsi',
            'Departemen',
            'Kategori',
            'Objek',
            'PIC',
            'Pelapor',
            'Progress',
            'Prioritas',
            'Tanggal Mulai',
            'Batas Waktu',
            'Tanggal Dibuat (Custom)',
            'Jam Dibuat (Custom)',
            'Waktu Mulai',
            'Waktu Dijeda',
            'Waktu Dilanjutkan',
            'Durasi Total',
            'Created At',
            'Updated At',
        ];
    }
}
