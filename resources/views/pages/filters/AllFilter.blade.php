<div class="sidebar__categories">
    <div class="section-title">
        <h4>Categories</h4>
    </div>
    <div class="categories__accordion">
        <div class="accordion" id="accordionExample">
            @foreach($parent_categories as $parent_category)
                <div class="card">
                    <div class="card-heading">
                        <a data-toggle="collapse" data-target="#collapse{{$parent_category->id}}">
                            {{$parent_category->name}}
                        </a>
                    </div>
                    <div id="collapse{{$parent_category->id}}" class="collapse" data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                @foreach($child_categories as $child_category)
                                    @if($parent_category->id == $child_category->parent_id)
                                        <li>
                                            <a href="#">
                                                {{$child_category->name}}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="sidebar__sizes">
    <div class="section-title">
        <h4>Shop Brands</h4>
    </div>
    <div class="size__list">
        @foreach($brands as $brand)
            <label for="#{{$brand->name}}">
                {{$brand->name}}
                <input type="checkbox" @if(in_array($brand->id, explode(',',$q_brands))) checked="checked" @endif
                id="#{{$brand->name}}" name="brands" value="{{$brand->id}}" onchange="productByFilterBrands()">
                <span class="checkmark"></span>
            </label>
        @endforeach
    </div>
</div>
<div class="sidebar__filter">
    <div class="section-title">
        <h4>Shop by price</h4>
    </div>
    <div class="filter-range-wrap">
        <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
             data-min="1000" data-max="20000000"></div>
        <div class="range-slider">
            <div class="price-input">
                <p>Price:</p>
                <input type="number" id="minamount" class="border py-1 px-2" name="minamount">
                <input type="number" id="maxamount" class="border py-1 px-2" name="maxamount">
            </div>
        </div>
    </div>
</div>
<div class="sidebar__color">
    <div class="section-title">
        <h4>Shop by Color</h4>
    </div>
    <div class="size__list color__list">
        @foreach($product_colors as $product_color)
            <label for="{{$product_color->name}}">
                {{$product_color->name}}
                <input type="checkbox" @if(in_array($product_color->id, explode(',',$q_colors))) checked="checked" @endif
                id="{{$product_color->name}}" name="product_color" value="{{$product_color->id}}"
                       onchange="productByFilterColors()">
                <span class="checkmark"></span>
            </label>
        @endforeach
    </div>
</div>
<div>
    <a href="{{route('product.category.all')}}">
        <button type="button" class="btn btn-danger">Clear</button>
    </a>
</div>
<form id="productFilter" action="{{route('product.category.all')}}" method="GET">
    <input type="hidden" name="sort" id="sortable" value="0">
    <input type="hidden" name="brands" id="brands" value="{{$q_brands}}">
    <input type="hidden" name="colors" id="colors" value="{{$q_colors}}">
    <input type="hidden" name="q_min" id="q_min" value="{{$q_min}}">
    <input type="hidden" name="q_max" id="q_max" value="{{$q_max}}">
    <button type="submit" name="productFilter"></button>
</form>
