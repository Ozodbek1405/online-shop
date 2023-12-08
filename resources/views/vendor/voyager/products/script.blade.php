<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'description' );
    $(function () {
        $('.product_multiple_select').each(function () {
            $(this).select2({
                theme: 'bootstrap4',
                width: 'style',
                allowClear: Boolean($(this).data('allow-clear')),
            });
        });
    });
    $('#category').on('change', function() {
        var category_id = $(this).val();
        if (category_id !== "") {
            fetchCategoryData(category_id);
        }
    });
    function fetchCategoryData(category_id) {
        $.ajax({
            url: "{{route('getParentCategory')}}",
            method: 'GET',
            data: { category_id: category_id },
            dataType: 'json',
            success: function(data) {
                getParentCategories(data);
            },
            error: function() {
                console.log('Error retrieving data.');
            }
        });
    }
    function getParentCategories(data) {
        var parent_category = $('#parent_category');
        parent_category.empty();
        for (var i = 0; i < data.data.length; i++) {
            var option = $('<option></option>').attr('value', data.data[i].id).text(data.data[i].name);
            if (data.data[i].id === {{$product->parent_category_id??0}}) {
                option.attr('selected', 'selected');
            }
            parent_category.append(option);
        }
    }
    $('#parent_category').on('change', function() {
        var parent_id = $(this).val();
        if (parent_id !== "") {
            fetchData(parent_id);
            getDataBrand(parent_id);
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
            if (data.data[i].id === {{$product->child_category_id??0}}) {
                option.attr('selected', 'selected');
            }
            child_category.append(option);
        }
    }
    function getDataBrand(parent_id) {
        $.ajax({
            url: "{{route('getBrands')}}",
            method: 'GET',
            data: { parent_id: parent_id },
            dataType: 'json',
            success: function(data) {
                brandsValue(data);
            },
            error: function() {
                console.log('Error retrieving data.');
            }
        });
    }
    function brandsValue(data) {
        var brands = $('#brand');
        brands.empty();
        for (var i = 0; i < data.data.length; i++) {
            var option = $('<option></option>').attr('value', data.data[i].id).text(data.data[i].name);
            if (data.data[i].id === {{$product->brand_id??0}}) {
                option.attr('selected', 'selected');
            }
            brands.append(option);
        }
    }
    $(document).ready(function() {
        var category_id = $('#category').val();
        var parent_id = $('#parent_category').val();
        fetchCategoryData(category_id);
        fetchCategoryData(parent_id);
        getDataBrand(parent_id);
    });
</script>
