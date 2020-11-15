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

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Редактирование продукта</div>

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Название</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="name" v-model="name" >
                                <strong v-if="errors" >{{errors.name[0]}}</strong>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-2 col-form-label">Цена</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="price" v-model="price">
                                <strong v-if="errors" >{{errors.price[0]}}</strong>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary" @click="editProduct()">Редактировать</button>
                            </div>
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
                name: '',
                price: 0,
                errors: null
            }
        },
        mounted() {
            this.getProduct(this.$route.params.product_id);
        },
        methods: {
            async getProduct(product_id) {
                axios.get('/api/products/'+product_id)
                    .then(res => {
                        this.name = res.data.data.name;
                        this.price = res.data.data.price;
                    }).catch(err => {
                        console.log(err);
                    });
            },
            async editProduct() {
                const params = {
                    name: this.name,
                    price: this.price
                };
                axios.put('/api/products/'+this.$route.params.product_id, params).then(response => {
                    if (typeof response.data.errors !== "undefined") {
                        this.errors = response.data.errors;
                    } else {
                        alert('Продукт успешно отредактирован.');
                        this.$router.push("/");
                    }

                }).catch(err => {
                    console.log(err);
                });

            }
        }
    }
</script>
