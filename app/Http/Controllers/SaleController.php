<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $data = Sale::with('member')
            ->when($keyword, fn($query) =>
                $query->whereHas('member', fn($q) =>
                    $q->where('name', 'like', "%$keyword%")
                )
            )
            ->latest()
            ->paginate(10);

        return view('pages.sales.index', compact('data'));
    }

    public function productSale()
    {
        $data = Product::all();
        return view('pages.sales.products', compact('data'));
    }

    public function checkout(Request $request)
    {
        $cart = json_decode($request->cart_checkout, true);
        $checkout = [];

        foreach ($cart as $item) {
            $product = Product::findOrFail($item['id']);
            $checkout[] = [
                'id' => $product->id,
                'name' => $product->name,
                'qty' => $item['qty'],
                'price' => $product->price,
            ];
        }

        return view('pages.sales.checkout', compact('checkout'));
    }

    public function paymentTransaction(Request $request)
    {
        $request->validate([
            'cart' => 'required',
            'amount_paid' => 'required|numeric',
            'sub_total' => 'required|numeric',
        ]);

        $change = $request->amount_paid - $request->sub_total;

        $sale = Sale::create([
            'member_id' => $request->member_id ?? null,
            'date' => now(),
            'no_sales' => 'INV-' . time(),
            'amount_paid' => $request->amount_paid,
            'change' => $change,
            'point_used' => 0,
            'sub_total' => $request->sub_total,
            'total' => $request->sub_total,
            'created_by' => 'Petugas',
        ]);

        $cartItems = json_decode($request->cart, true);
        foreach ($cartItems as $item) {
            $product = Product::findOrFail($item['id']);

            $sale->saleDetails()->create([
                'product_id' => $product->id,
                'product_price' => $product->price,
                'product_qty' => $item['qty'],
                'total_price' => $item['qty'] * $product->price,
            ]);

            $product->decrement('stock', $item['qty']);
        }

        return redirect()->route('sales.receipt', $sale->id);
    }

    public function showReceipt($id)
    {
        $sale = Sale::with(['member', 'saleDetails.product'])->findOrFail($id);

        $saleData = [
            'sale_id' => $sale->id,
            'member_id' => $sale->member_id,
            'member_name' => $sale->member->name ?? '-',
            'member_phone' => $sale->member->phone_number ?? '-',
            'member_point' => $sale->member->member_point ?? 0,
            'member_date' => $sale->member->date ?? '-',
            'date' => $sale->date,
            'no_sales' => $sale->no_sales,
            'amount_paid' => $sale->amount_paid,
            'change' => $sale->change,
            'point_used' => $sale->point_used,
            'total' => $sale->total,
            'sub_total' => $sale->sub_total,
            'created_at' => $sale->created_at,
            'updated_at' => $sale->updated_at,
            'created_by' => $sale->created_by,
            'products' => $sale->saleDetails->map(function ($detail) {
                return [
                    'product_name' => $detail->product->name ?? 'Produk tidak ditemukan',
                    'qty' => $detail->product_qty,
                    'price' => $detail->product_price,
                    'total' => $detail->total_price,
                ];
            })->toArray(),
        ];

        return view('pages.sales.receipt', compact('saleData'));
    }
}
