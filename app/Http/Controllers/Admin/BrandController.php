<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Services\File\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    protected $fileService;
    protected $file_path = 'brand';

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
        $data = Brand::orderBy('name', 'asc')->get();
        return view('admin.brand.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
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
            'name' => ['required', 'string', 'max:255', 'unique:brand,name'],
            'image' => ['required', 'mimes:png,jpg', 'max:1024'],
        ], [], [
            'name' => __('Nama'),
            'image' => __('Image'),
        ]);

        DB::beginTransaction();
        try {
            $brand = Brand::create([
                'slug' => Str::slug($request->name, '-'),
                'name' => ucfirst($request->name),
                'image' => $request->hasFile('image') ? Str::uuid() . '.' . $request->image->extension() : null,
            ]);
            if ($request->hasFile('image')) $this->fileService->upload($this->file_path, $request->image, $brand->image);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }

        return redirect()->route('admin.master.brand.index')->with('success', 'Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:brand,name,' . $brand->id . ',id'],
            'image' => ['nullable', 'mimes:png,jpg', 'max:1024'],
        ], [], [
            'name' => __('Nama'),
            'image' => __('Image'),
        ]);

        DB::beginTransaction();
        try {
            $brand->update([
                'slug' => Str::slug($request->name, '-'),
                'name' => ucfirst($request->name),
            ]);
            if ($request->hasFile('image')) {
                $new_image = Str::uuid() . '.' . $request->image->extension();
                $this->fileService->remove($this->file_path, $brand->image);
                $brand->update([
                    'image' => $new_image,
                ]);
                $this->fileService->upload($this->file_path, $request->image, $new_image);
            }
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }

        return redirect()->route('admin.master.brand.index')->with('success', 'Berhasil diubah');
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
