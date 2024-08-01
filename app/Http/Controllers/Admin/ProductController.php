<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\File\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    protected $fileService;
    protected $file_path = 'product';

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::orderBy('created_at', 'desc')->get();
        return view('admin.product.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:product,name'],
            'id_brand' => ['required', 'exists:brand,id'],
            'id_category' => ['required', 'exists:category,id'],
            'description' => ['required'],
            'image_1' => ['required', 'mimes:png,jpg,jpeg', 'max:1024'],
            'image_2' => ['nullable', 'mimes:png,jpg,jpeg', 'max:1024'],
            'image_3' => ['nullable', 'mimes:png,jpg,jpeg', 'max:1024'],
            'weight' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'discount' => ['required', 'numeric'],
            'product_variant.*.size' => ['required', 'numeric'],
            'product_variant.*.qty' => ['required', 'numeric'],
        ], [], [
            'name' => __('Nama'),
            'id_brand' => __('Brand'),
            'id_category' => __('Kategori'),
            'description' => __('Deskripsi'),
            'image_1' => __('Image'),
            'image_2' => __('Image'),
            'image_3' => __('Image'),
            'weight' => __('Berat Product'),
            'price' => __('Harga Product'),
            'discount' => __('Diskon'),
            'product_variant.*.size' => __('Size'),
            'product_variant.*.qty' => __('Qty'),
        ]);

        DB::beginTransaction();
        try {
            $product = Product::create([
                'slug' => Str::slug($request->name, '-'),
                'name' => ucwords($request->name),
                'id_brand' => $request->id_brand,
                'id_category' => $request->id_category,
                'description' => $request->description,
                'image_1' => $request->hasFile('image_1') ? Str::uuid() . '.' . $request->image_1->extension() : null,
                'image_2' => $request->hasFile('image_2') ? Str::uuid() . '.' . $request->image_2->extension() : null,
                'image_3' => $request->hasFile('image_3') ? Str::uuid() . '.' . $request->image_3->extension() : null,
                'weight' => $request->weight,
                'price' => $request->price,
                'discount' => $request->discount,
            ]);
            if ($request->hasFile('image_1')) $this->fileService->upload($this->file_path, $request->image_1, $product->image_1);
            if ($request->hasFile('image_2')) $this->fileService->upload($this->file_path, $request->image_2, $product->image_2);
            if ($request->hasFile('image_3')) $this->fileService->upload($this->file_path, $request->image_3, $product->image_2);
            foreach ($request->product_variant as $key => $value) {
                $product->productVariant()->create([
                    'id_product' => $product->id,
                    'size' => $value['size'] ?? null,
                    'qty' => $value['qty'] ?? null,
                ]);
            }
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }

        return redirect()->route('admin.product.index')->with('success', 'Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:product,name,' . $product->id . ',id'],
            'id_brand' => ['required', 'exists:brand,id'],
            'id_category' => ['required', 'exists:category,id'],
            'description' => ['required'],
            'image_1' => ['nullable', 'mimes:png,jpg,jpeg', 'max:1024'],
            'image_2' => ['nullable', 'mimes:png,jpg,jpeg', 'max:1024'],
            'image_3' => ['nullable', 'mimes:png,jpg,jpeg', 'max:1024'],
            'weight' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'discount' => ['required', 'numeric'],
            'product_variant.*.size' => ['required', 'numeric'],
            'product_variant.*.qty' => ['required', 'numeric'],
        ], [], [
            'name' => __('Nama'),
            'id_brand' => __('Brand'),
            'id_category' => __('Kategori'),
            'description' => __('Deskripsi'),
            'image_1' => __('Image'),
            'image_2' => __('Image'),
            'image_3' => __('Image'),
            'weight' => __('Berat Product'),
            'price' => __('Harga Product'),
            'discount' => __('Diskon'),
            'product_variant.*.size' => __('Size'),
            'product_variant.*.qty' => __('Qty'),
        ]);

        DB::beginTransaction();
        try {
            $product->update([
                'slug' => Str::slug($request->name, '-'),
                'name' => ucwords($request->name),
                'id_brand' => $request->id_brand,
                'id_category' => $request->id_category,
                'description' => $request->description,
                'weight' => $request->weight,
                'price' => $request->price,
                'discount' => $request->discount,
            ]);
            if ($request->hasFile('image_1')) {
                $new_image_1 = Str::uuid() . '.' . $request->image_1->extension();
                if ($product->image_1) $this->fileService->remove($this->file_path, $product->image_1);
                $product->update([
                    'image_1' => $new_image_1,
                ]);
                $this->fileService->upload($this->file_path, $request->image_1, $product->image_1);
            }
            if ($request->hasFile('image_2')) {
                $new_image_2 = Str::uuid() . '.' . $request->image_2->extension();
                if ($product->image_2) $this->fileService->remove($this->file_path, $product->image_2);
                $product->update([
                    'image_2' => $new_image_2,
                ]);
                $this->fileService->upload($this->file_path, $request->image_2, $product->image_2);
            }
            if ($request->hasFile('image_3')) {
                $new_image_3 = Str::uuid() . '.' . $request->image_3->extension();
                if ($product->image_3) $this->fileService->remove($this->file_path, $product->image_3);
                $product->update([
                    'image_3' => $new_image_3,
                ]);
                $this->fileService->upload($this->file_path, $request->image_3, $product->image_3);
            }
            if ($request->product_variant) {
                $updated_product_id = [];
                foreach ($request->product_variant as $key => $value) {
                    $product_variant = $product->productVariant()->updateOrCreate([
                        'id' => $value['id']
                    ], [
                        'id_product' => $product->id,
                        'size' => $value['size'] ?? null,
                        'qty' => $value['qty'] ?? null,
                    ]);
                    $updated_product_id[] = $product_variant->id;
                }
                $product->productVariant()->whereNotIn('id', $updated_product_id)->delete();
            }
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }

        return redirect()->route('admin.product.index')->with('success', 'Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
