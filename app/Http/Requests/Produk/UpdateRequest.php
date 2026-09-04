<?php

namespace App\Http\Requests\Produk;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'name'           => 'required|string|max:255',
            'category'       => 'required|string|max:100', // <-- Ubah dari category_id ke category (string)
            'purchase_price' => 'required|integer|min:0',
            'selling_price'  => 'required|integer|min:0',
            'stock'          => 'required|integer|min:0',
            'satuan'         => 'required|string|max:50',

            // DIBUAT NULLABLE AGAR BEBAS JIKA TIDAK DIISI
            'minimum_stok'   => 'nullable|integer|min:0',

            'deskripsi'      => 'nullable|string',
            'status'         => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'foto.image'              => 'File harus berupa gambar.',
            'foto.mimes'              => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'foto.max'                => 'Ukuran gambar maksimal 2 MB.',

            'name.required'           => 'Nama produk wajib diisi.',

            'category.required'       => 'Jenis produk wajib dipilih.', // <-- Disesuaikan dengan 'category'
            'category.string'         => 'Jenis produk harus berupa teks yang valid.',

            'purchase_price.required' => 'Harga beli wajib diisi.',
            'purchase_price.integer'  => 'Harga beli harus berupa angka.',

            'selling_price.required'  => 'Harga jual wajib diisi.',
            'selling_price.integer'   => 'Harga jual harus berupa angka.',

            'stock.required'          => 'Stok wajib diisi.',
            'stock.integer'           => 'Stok harus berupa angka.',

            'satuan.required'         => 'Satuan wajib dipilih.',

            'minimum_stok.integer'    => 'Minimum stok harus berupa angka.',
        ];
    }
}