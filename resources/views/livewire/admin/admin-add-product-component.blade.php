<div>
    <style>
        nav svg{
            height: 20px;
        }
         nav .hidden{
            display: block;
         }
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="\" rel="nofollow">Home</a>
                    <span></span> Add New Product
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        
                                        <p>Add New Product</p>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.products') }}" style="border-radius: 25%" class="btn btn-success float-end">All Products</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (Session::has('message'))
                                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                                @endif
                               <form wire:submit.prevent="addProduct">
                                
                                    <div class="mb-3 mt-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter Product Name" wire:model="name" wire:keyup="generateSlug"/>
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" class="form-control" name="slug" placeholder="Enter Slug Product" wire:model="slug"/>
                                        @error('slug')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="short_description" class="form-label">Short Description</label>
                                        <textarea name="short_description" class="form-control"  cols="30" rows="10" wire:model="short_description"  placeholder="Enter Short Description"></textarea>
                                        @error('short_description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" class="form-control"  cols="30" rows="10" wire:model="description"  placeholder="Enter Description"></textarea>
                                        @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="regular_price" class="form-label">Regular Price</label>
                                        <input type="text" class="form-control" name="regular_price" placeholder="Enter Regular Price" wire:model="regular_price"/>
                                        @error('regular_price')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="sale_price" class="form-label">Sales Price</label>
                                        <input type="text" class="form-control" name="sale_price" placeholder="Enter Sale Price" wire:model="sale_price"/>
                                        @error('sale_price')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="sku" class="form-label">SKU</label>
                                        <input type="text" class="form-control" name="sku" placeholder="Enter SKU" wire:model="sku"/>
                                        @error('sku')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="stock_status" class="form-label" wire:model="stock_status">Stock Status</label>
                                        <select name="stock_status" class="form-control">
                                            <option value="instock">InStock</option>
                                            <option value="outofstock">Out of Stock</option>
                                        </select>
                                        @error('stock_status')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="featured" class="form-label" wire:model="featured">Featured</label>
                                        <select name="featured" class="form-control">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                        @error('featured')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="text" class="form-control" name="quantity" wire:model="quantity" placeholder="Enter product Quantity" wire:model="slug"/>
                                        @error('quantity')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    </div>
                                    
                                    <div class="mb-3 mt-3 file-upload">
                                        <label for="file_upload" class="form-label">Image</label>
                                        <div class="custom-file">
                                          <div class="input-group mb-3">
                                            <input id="image" name="image" type="file" wire:model="image" class="custom-file-input form-control" aria-label="File Upload" />
                                            @if ($image)
                                              <img src="{{ $image->temporaryUrl() }}" alt="Image preview" style="width: 100px; height: 100px; object-fit: cover;">
                                            @endif
                                          </div>
                                        </div>
                                        @error('image')
                                          <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                      </div>
                                      

                                    <div class="mb-3 mt-3">
                                        <label for="category_id" class="form-label">Category</label>
                                        <select name="category_id" class="form-control" wire:model="category_id">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    </div>
                            
                                        @if ($images)
                                            <div class="mb-3">
                                                <p class="fw-bold">Photo Preview:</p>
                                                <div class="row">
                                                    @foreach ($images as $image)
                                                        <div class="col-3">
                                                            <div class="card mb-3">
                                                                <img src="{{ $image->temporaryUrl() }}" class="card-img-top" alt="Preview Image">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <label for="image_upload" class="form-label">Select multiple images:</label>
                                            <input type="file" id="images" wire:model="images" name="images[]" accept="image/*" multiple class="form-control-file">
                                            <div wire:loading wire:target="images">Uploading...</div>
                                            @error('images.*') <span class="error">{{ $message }}</span> @enderror

                                        </div>
                                      
                                    

                                    <button type="submit" style="border-radius: 25%"  class="btn btn-primary float-end">Submit</button>
                               </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>
</div>