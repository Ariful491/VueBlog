<template>
    <div class="container">
        <section class="content-header ">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Update Post</h1>
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
                    update Post
                </div>
                <form   @submit.prevent="updateCategory" >
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" id="title"  class="form-control" v-model="form.title"  :class="{ 'is-invalid': form.errors.has('title') }"  placeholder="Title">
                        <has-error :form="form" field="title"></has-error>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Select Category</label>
                        <select class="form-control" id="category_id" name="category_id"  :class="{ 'is-invalid': form.errors.has('category_id') }" v-model="form.category_id">
                            <option value="">Select Category Name</option>

                            <option  v-for="category in Categories" v-if="category.status==1"  :value="category.id">{{ category.name }}</option>

                        </select>
                        <has-error :form="form" field="category_id"></has-error>
                    </div>
                    <div class="form-group">
                        <label >Description :</label>
                        <ckeditor  id="description"  class="form-control" :editor="editor" v-model="form.description" :config="editorConfig"  :class="{ 'is-invalid': form.errors.has('description') }"  placeholder="Description"></ckeditor>
                        <has-error :form="form" field="description"></has-error>
                    </div>
                    <div class="form-group">
                        <label for="thumbnail">Thumbnail :</label>
                        <input type="file" class="form-control-file" @change="loadThumbnail($event)" id="thumbnail" name="thumbnail"  :class="{ 'is-invalid': form.errors.has('thumbnail') }">

                        <img  :src="form.thumbnail"   height="80px">
                    </div>
                    <has-error :form="form" field="thumbnail"></has-error>
                    <div class="form-group">
                        <label>Status: </label>
                        <label for="status1">
                            <input type="radio"  class="form-check-inline" id="status1"  v-model="form.status"   name="status" value="published"    >Published
                        </label>
                        <label for="status0">
                            <input type="radio" id="status0"  class="form-check-inline"  v-model="form.status"  name="status" value="draft">Draft
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
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
export default {
    name: "editPost",
    data:function (){
        return{
            form: new Form({
                title:null,
                category_id:'',
                status:null,
                description:null,
                thumbnail:null,
                id:null,
            }),
            editor: ClassicEditor,

            editorConfig: {

            }


        }

    },
    methods:{
        updateCategory:function (){
            let calling =this;
            this.form.post('posts/update')
                .then(function (response) {
                    calling.DataNull();
                    toastr.success(response.data.message, {timeOut: 5000})
                    calling.$router.push('/Post')
                })

        },
        categoryDetails:function (){
            let calling=this;
            axios.get("/postDetails/"+this.$route.params.slug)
                .then(function (response){
                   calling.form.fill(response.data.post);
                }).catch(function (error) {
                return error
            })
        },





    },
    mounted() {

     this.categoryDetails();
        this.$store.dispatch('getCategories');

    },
    computed:{
        Categories(){
            return  this.$store.getters.category;
        }
    },

}
</script>

<style scoped>

</style>
