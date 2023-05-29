<?php

namespace App\Http\Livewire\Admin;

use App\Models\ImageUploade;
use Carbon\Carbon;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use RealRashid\SweetAlert\Facades\Alert;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Arr;


class AdminAddProductComponent extends Component
{      
    use LivewireAlert;

    use WithFileUploads;

    public $name;
    public $slug;
    public $short_description;
    public $description;
    public $regular_price;
    public $sale_price;
    public $sku;
    public $stock_status = 'instock';
    public $featured = 0;
    public $quantity;
    public $image;
    public $category_id;

    public $images = [];

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function addProduct()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'required',
            'sku' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required',
            // 'image_upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'image|max:1024', // 1MB Max

        ]);

        $product = new Product();
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_description = $this->short_description;
        $product->description = $this->description;
        $product->regular_price = $this->regular_price;
        $product->sale_price = $this->sale_price;
        $product->sku = $this->sku;
        $product->stock_status = $this->stock_status;
        $product->featured = $this->featured;
        $product->quantity = $this->quantity;

        $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
        $this->image->storeAs('products', $imageName, 'public'); 
        $product->image = $imageName;
        
        $product->category_id = $this->category_id;


        $imagePaths = Arr::wrap($this->images);

        foreach ($imagePaths as $imagePath) {
            $imageUpload = new ImageUploade();
            $imageUpload->image_path = $imagePath;
            $imageUpload->tag = 'other';
            $imageUpload->save();
        
        }
 
        $product->save();
        $this->flash('success','Product has been Created Successfully!', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => false,
           ]);

           $this->name = "";
            $this->slug = "";
            $this->short_description = "";
            $this->description = "";
            $this->regular_price = "";
            $this->sale_price = "";
            $this->sku = "";
            $this->stock_status = 'instock';
            $this->featured = 0;
            $this->quantity = "";
            $this->image = "";
            $this->category_id ="";

        return redirect()->route('admin.products');

    }

    public function render()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        
        return view('livewire.admin.admin-add-product-component', compact('categories'));
    }
}
