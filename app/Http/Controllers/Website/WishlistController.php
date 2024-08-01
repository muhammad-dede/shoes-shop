<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    public function index()
    {
        $data = Wishlist::where('id_user', auth()->id())->orderBy('created_at', 'desc')->get();
        return view('website.wishlist.index', compact('data'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            Wishlist::create([
                'id_user' => auth()->id(),
                'id_product' => $request->id_product,
            ]);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke wishlist');
    }

    public function delete(Wishlist $wishlist)
    {
        $wishlist->delete();
        return redirect()->route('wishlist.index')->with('success', 'Berhasil di hapus');
    }
}
