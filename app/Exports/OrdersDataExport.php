<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersDataExport implements FromCollection, WithHeadings, ShouldQueue, ShouldAutoSize
{
    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $orders = Order::with('products')->get();

        $rows = collect();

        foreach ($orders as $order) {
            foreach ($order->products as $product) {
                $rows->push([
                    '#' => $order->id,
                    'Fecha' => $order->order_date,
                    'Cliente' => $order->customer_name,
                    'Producto' => $product->name,
                    'Precio' => $product->pivot->price,
                    'Cantidad' => $product->pivot->quantity,
                    'Total Producto' => $order->total
                ]);
            }
        }

        return $rows;
    }

    public function headings(): array
    {
        return [
            '#',
            'Fecha',
            'Cliente',
            'Producto',
            'Precio',
            'Cantidad',
            'Total Producto'
        ];
    }
}
