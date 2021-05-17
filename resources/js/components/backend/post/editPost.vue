<template>
    <div class="container">
        <section class="content-header ">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Update Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"><router-link to="/home">Dashboard</router-link></li>/
                            <li class="breadcrumb-item active"><router-link to="/category" >Category</router-link></li>
                            <li class="breadcrumb-item active"><router-link to="/add-category" class="btn btn-primary">add Category</router-link></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="row">
            <div class="col-md-6 card mx-auto">
                <div class="mt-2 ">
                    update category
                </div>
                <form   @submit.prevent="updateCategory" >
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name"  class="form-control" v-model="form.name"  :class="{ 'is-invalid': form.errors.has('name') }"  placeholder="Name">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="form-group">
                        <label>Status: </label>
                        <label for="status1">
                            <input type="radio"  class="form-check-inline" id="status1"  v-model="form.status"   name="status" value="1"    >Active
                        </label>
                        <label for="status0">
                            <input type="radio" id="status0"  class="form-check-inline"  v-model="form.status"  name="status" value="0">De Active
                        </label>
                        <span :class="{ 'is-invalid': form.errors.has('status') }"></span>
                        <has-error :form="form" field="status"></has-error>
                    </div>
                    <div class="form-group">
                        <button   :disabled="form.busy"   :class="{ 'btn-danger': form.busy == true }"      class="btn btn-primary rounded-0 float-right  shadow-lg mb-3">
                            <span v-if="form.busy"><i class="fas fa-spinner fa-pulse"></i></span>
                            <span v-else><i class="fas fa-plus-square"></i></span>

                            Update Category
                        </button>
                        <button class="float-right btn btn-light shadow-lg " type="reset">cancle</button>


                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "editPost",
    data:function (){
        return{
            form: new Form({
                id:null,
                name:null,
                status:null,
            }),

        }

    },
    methods:{
        updateCategory:function (){
            let calling =this;
            this.form.post('categories/update')
                .then(function (response) {
                    calling.DataNull();
                    toastr.success(response.data.message, {timeOut: 5000})
                    calling.$router.push('/category')
                })

        },
        categoryDetails:function (){
            let calling=this;
            axios.get("/categoryDetails/"+this.$route.params.slug)
                .then(function (response){
                   calling.form.fill(response.data.categoryDetail);
                }).catch(function (error) {
                return error
            })
        },


        DataNull:function (){
            let calling =this;
            calling.form.name=null;
            calling.form.status=null
        },

    },
    mounted() {

     this.categoryDetails();

    }

}
</script>

<style scoped>

</style>
