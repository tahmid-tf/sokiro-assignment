@extends('admin.admin-panel.main')

@section('content')
    <h3>View Quantity</h3>
    <hr>
    <div id="app">
        <th></th>

        <div class="d-flex justify-content-end">
            <input type="text" placeholder="Search" v-model="inputData">
        </div>
        <br>

        <table style="width: 100%; border: 1px solid #55667B">
            <tr>
                <th style="border: 1px solid #55667B">Serial</th>
                <th style="border: 1px solid #55667B">Product Name</th>
                <th style="border: 1px solid #55667B">Product Quantity</th>

            </tr>


            <tr v-for="(item, index) in dataRow">
                <th style="border: 1px solid #55667B">@{{ index + 1 }}</th>
                <th style="border: 1px solid #55667B">@{{ item.product_name }}</th>
                <th style="border: 1px solid #55667B">@{{ item.qty }}</th>
            </tr>
        </table>


        {{-- --------------------------------- Pagination ------------------------------------ --}}

        <div class="container mt-4 d-flex justify-content-center">

            <ul class="pagination">

                <div v-if="lastPage > 1">
                    <li :class="{ active : paginate === currentPage }" v-for="paginate in lastPage">

                        <div v-if="inputData == ''">
                            <span @click="mainData(paginate)">@{{ paginate }}</span>
                        </div>
                        <div v-else>
                            <span @click="searchData(paginate, inputData)">@{{ paginate }}</span>
                        </div>

                    </li>
                </div>


            </ul>
        </div>


        {{-- --------------------------------- Pagination ------------------------------------ --}}

    </div>


    <script>
        const {createApp} = Vue

        createApp({
            data() {
                return {
                    dataRow: [],
                    lastPage: 0,
                    currentPage: 0,
                    inputData: '',
                }
            },
            methods: {
                mainData(paginatedListNumber = '') {
                    let url;
                    if (paginatedListNumber == '') {
                        url = window.location.origin + '/quantity_json-data';
                    } else {
                        url = window.location.origin + '/quantity_json-data?page=' + paginatedListNumber;
                    }
                    axios.get(url).then(el => {
                        this.dataRow = el.data.data;
                        this.lastPage = el.data.last_page;
                        this.currentPage = el.data.current_page;
                    })
                },

                searchData(paginatedListNumber = '', search = '') {
                    let url;
                    if (paginatedListNumber == '') {
                        url = window.location.origin + '/quantity_json-data_search/' + search;
                    } else {
                        url = window.location.origin + `/quantity_json-data_search/${search}?page=` + paginatedListNumber;
                    }
                    axios.get(url).then(el => {
                        this.dataRow = el.data.data;
                        this.lastPage = el.data.last_page;
                        this.currentPage = el.data.current_page;
                    })
                },
            },

            watch: {
                inputData(event) {
                    if (event == '') {
                        this.mainData();
                        console.log("working")
                    } else {
                        this.searchData('', event);
                        console.log("working")

                    }
                }
            },
            mounted() {
                this.mainData();
            }

        }).mount('#app')
    </script>
@endsection
