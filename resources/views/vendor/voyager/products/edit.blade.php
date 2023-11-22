@extends('voyager::master')

@section('content')
    <section class="container">
        <div style="margin-bottom: 30px">
            <h2>Create <b>Products</b></h2>
        </div>
        <form action="{{route('product.update',$product->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="name" value="{{old('name',$product->name)}}">
                @error('name')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="price" value="{{old('price',$product->price)}}">
                @error('price')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="discount">Chegirma narxi</label>
                <input type="number" class="form-control" id="discount" name="discount" placeholder="discount" value="{{old('discount',$product->discount)}}">
                @error('discount')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="title" value="{{old('title',$product->title)}}">
                @error('title')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" rows="3" name="description">{{$product->description}}</textarea>
                @error('description')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="weight">Weight (kg)</label>
                <input type="text" class="form-control" id="weight" name="weight" placeholder="weight" value="{{old('weight',$product->weight)}}">
                @error('weight')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="dimensions">O'lchamlari (sm x sm x sm)</label>
                <input type="text" class="form-control" id="dimensions" name="dimensions" placeholder="dimensions" value="{{old('dimensions',$product->dimensions)}}">
                @error('dimensions')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="materials">Materials</label>
                <input type="text" class="form-control" id="materials" name="materials" placeholder="materials" value="{{old('materials',$product->materials)}}">
                @error('materials')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="product_color">Product color</label>
                <select class="form-control" id="product_color" name="color_id">
                    <option value="">Tanlang</option>
                    @foreach($product_colors as $product_color)
                        <option @selected($product->color_id == $product_color->id) value="{{$product_color->id}}">{{$product_color->name}}</option>
                    @endforeach
                </select>
                @error('color_id')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="count">Product count</label>
                <input type="number" class="form-control" id="count" name="count" placeholder="count" value="{{old('count',$product->count)}}">
                @error('count')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="product_size">Product size</label>
                <select multiple class="form-control" id="product_size" name="size_id[]">
                    @foreach($product_sizes as $product_size)
                        <option @selected(in_array($product_size->id,explode(',',$product->size_id))) value="{{$product_size->id}}">{{$product_size->name}}</option>
                    @endforeach
                </select>
                @error('size_id')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="brand">Brands</label>
                <select class="form-control" id="brand" name="brand_id">
                    <option value="">Tanlang</option>
                    @foreach($brands as $brand)
                        <option @selected($product->brand_id == $brand->id) value="{{$brand->id}}">{{$brand->name}}</option>
                    @endforeach
                </select>
                @error('brand_id')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="images">Images</label>
                <input class="form-control-file" name="images[]" type="file" id="images" multiple="multiple" accept=".jpg,.png,.jpeg">
                @error('images')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="parent_category">Parent category</label>
                <select class="form-control" id="parent_category" name="parent_category_id">
                    <option value="">Tanlang</option>
                    @foreach($parent_categories as $parent_category)
                        <option @selected($product->parent_category_id == $parent_category->id) value="{{$parent_category->id}}">{{$parent_category->name}}</option>
                    @endforeach
                </select>
                @error('parent_category_id')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="child_category">Child category</label>
                <select class="form-control" id="child_category" name="child_category_id">
                    <option value="">Tanlang</option>
                </select>
                @error('child_category_id')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $('#parent_category').on('change', function() {
            var parent_id = $(this).val();
            if (parent_id !== "") {
                fetchData(parent_id);
            }
        });
        function fetchData(parent_id) {
            $.ajax({
                url: "{{route('getChildCategory')}}",
                method: 'GET',
                data: { parent_id: parent_id },
                dataType: 'json',
                success: function(data) {
                    getChildCategories(data);
                },
                error: function() {
                    console.log('Error retrieving data.');
                }
            });
        }
        function getChildCategories(data) {
            var child_category = $('#child_category');
            child_category.empty();
            for (var i = 0; i < data.data.length; i++) {
                var option = $('<option></option>').attr('value', data.data[i].id).text(data.data[i].name);
                child_category.append(option);
            }
        }
        $(document).ready(function() {
            var parent_id = $('#parent_category').val();
            fetchData(parent_id);
        });
    </script>
@endsection
