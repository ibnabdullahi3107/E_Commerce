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
                    <a href="index.html" rel="nofollow">Home</a>
                    <span></span> All Categories
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
                                    <div class="col-md-6">All Categories</div>
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.category.add') }}" style="border-radius: 25%" class="btn btn-success float-end">Add New Category</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if(Session::has('message'))
                                    <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                                @endif
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = ($categories->currentPage()-1)*$categories->perPage();
                                        @endphp
                                        @foreach($categories as $category)
                                            <tr>
                                                <td>{{++$i}}</td>
                                                <td>{{$category->name}}</td>
                                                <td>{{$category->slug}}</td>
                                                <td class="text-info">
                                                    <a href="{{ route('admin.category.edit', ['category_id' => $category->id]) }}"  class="text-muted"><i class="fi-rs-refresh"></i></a>
                                                    <a href="#" wire:click.prevent="deleteConfermation({{ $category->id }})"  class="text-muted" style="margin-left: 20px;"><i class="fi-rs-trash"></i></a>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                 
                                </table>
                                {{$categories->links()}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>
</div>




