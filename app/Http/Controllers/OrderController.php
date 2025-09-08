<?php

namespace App\Http\Controllers;

use App\Exports\OrdersDataExport;
use App\Jobs\NotifyUserOfCompletedExportJob;
use Illuminate\Contracts\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        return view('orders.index');
    }

    public function export()
    {
        $filename = 'orders_' . now()->format('Y-m-d_H:i:s') . '.xlsx';

        (new OrdersDataExport)->queue($filename)->chain([
            new NotifyUserOfCompletedExportJob(auth()->user(), $filename)
        ]);

        return back();
    }

    public function download($filename)
    {
        $path = storage_path('app/private/' . $filename);

        if (!file_exists($path)) {
            abort(404, 'Archivo no encontrado.');
        }

        return response()->download($path);
    }
}
