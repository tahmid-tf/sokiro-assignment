@extends('admin.admin-panel.main')

@section('content')
    <h3>Add Quantity</h3>
    <hr>
    <div id="app">
        <div>
            <form @submit="addProduct($event)">


                <div class="form-group">
                    <label for="">Example select</label>
                    <select class="form-control" id="" v-model="product_name">

                        @foreach($products as $product)

                            <option value="{{ $product->id }}">{{ $product->product_name }}</option>

                        @endforeach

                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Add Product Quantity</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Product Stock"
                           v-model="qty">
                </div>

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
                    qty: ''
                }
            },
            methods: {
                addProduct(e) {
                    e.preventDefault();

                    let formData = new FormData();
                    formData.append('product_id', this.product_name);
                    formData.append('qty', this.qty);

                    axios.post('{{ route('quantity.store') }}', formData).then(el => {
                        console.log(el);
                    });
                }
            }

        }).mount('#app')
    </script>
@endsection
