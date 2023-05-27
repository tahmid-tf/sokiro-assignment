@extends('admin.admin-panel.main')

@section('content')
    <h3>Add Product</h3>
    <hr>
    <div id="app">
        <div>
            <form @submit="addProduct($event)">
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                           placeholder="Product Name" v-model="product_name">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Product Price</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Product Price"
                           v-model="product_price">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Product Stock</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Product Stock"
                           v-model="product_stock">
                </div>

                {{--                <div class="form-group">--}}
                {{--                    <label for="exampleInputPassword1">Product Quantity</label>--}}
                {{--                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">--}}
                {{--                </div>--}}

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>


    <script>
        const {createApp} = Vue

        createApp({
            data() {
                return {
                    product_name: '',
                    product_price: '',
                    product_stock: ''
                }
            },
            methods: {
                addProduct(e) {
                    e.preventDefault();

                    let formData = new FormData();
                    formData.append('product_name', this.product_name);
                    formData.append('product_price', this.product_price);
                    formData.append('product_stock', this.product_stock);

                    axios.post('{{ route('product.store') }}', formData).then(el => {
                        console.log(el);
                    });
                }
            }

        }).mount('#app')
    </script>
@endsection
