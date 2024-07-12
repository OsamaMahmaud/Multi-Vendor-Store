<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Jobs\ImportProducts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;

class ImportProductController extends Controller
{
    use DispatchesJobs;
    public function create()
    {
        return view('dashboard.products.import');
    }

    public function store(Request $request)
    {
        $job = new ImportProducts($request->post('count'));
        $job->onQueue('import')->onConnection('database')->delay(now()->addSeconds(5));
        $this->dispatch($job);

        return redirect()
        ->route('dashboard.products.index')
        ->with('success', 'Import is runing...');

    }
}
