<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <router-link to="/" class="navbar-brand" >Главная</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link to="/add" class="nav-link" >Добавить</router-link>
                    </li>
                </ul>
            </div>
        </nav>


        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Продукты</div>

                        <div class="card-body">

                            <b-table
                                    id="my-table"
                                    :fields="fields"
                                    :items="products"
                                    :per-page="perPage"
                                    :current-page="currentPage"
                            >
                                <template #cell(actions)="data">
                                    <router-link :to="'/edit/'+data.item.id" class="btn btn-link" >Редактировать</router-link>
                                    <button class="btn btn-link" @click="deleteProduct(data.item.id)">Удалить</button>
                                </template>
                            </b-table>

                            <p class="mt-3">Страница: {{ currentPage }}</p>

                            <b-pagination
                                    v-model="currentPage"
                                    :total-rows="rows"
                                    :per-page="perPage"
                                    aria-controls="my-table"
                            ></b-pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                fields: [
                    'id',
                    'name',
                    'price',
                    { key: 'actions', label: 'Actions' }
                ],
                perPage: 25,
                currentPage: 1,
                products: []
            }
        },
        mounted() {
            this.getProducts();
        },
        computed: {
            rows() {
                return this.products.length
            }
        },
        methods: {
            async getProducts() {
                axios.get('/api/products')
                    .then(res => {
                        this.products = res.data.data;
                    }).catch(err => {
                        console.log(err);
                    });
            },
            async deleteProduct(product_id) {
                axios.delete('/api/products/'+product_id).then(response => {
                    if (response.data === true) {
                        this.getProducts();
                        alert('Продукт успешно удален!');
                    } else {
                        alert('Ошибка удаления!');
                    }
                }).catch(err => {
                    console.log(err);
                });

            }
        }

    }
</script>
