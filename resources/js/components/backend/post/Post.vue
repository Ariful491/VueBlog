<template>
<div class="container">
            <section class="content-header ">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Post</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active"><router-link to="/home">Dashboard</router-link></li>/
                                <li class="breadcrumb-item active"><router-link to="/category" class="btn btn-primary">Category</router-link></li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

    <div class="row">
        <div class="col-md-12 card mx-auto">
            <div class="ml-auto mt-2">
                <router-link to="add-post" class="btn btn-success rounded-0 shadow-sm btn-sm"> add Post </router-link>
            </div>
            <table class="table table-bordered mt-2 ">
                <thead>
                <tr>

                    <th scope="col">Sl No</th>
                    <th scope="col">#</th>
                    <th scope="col">Category</th>
                    <th scope="col">Creator</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Thumbnail</th>
                    <th scope="col">status</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(post, index) in Posts" :class="trColor(post.status)">
                    <th scope="row">{{++index}}</th>
                    <th scope="row">{{post.id}}</th>
                    <th scope="row">{{post.category.name}}</th>
                    <th scope="row">{{post.user.name}}</th>
                    <td><a href="edit">{{post.title | subString(15) }}</a></td>
                    <td v-html="post.description||subString(20)"></td>
                    <td><img :src="post.thumbnail" style="height:auto!important;width: 120px!important;"></td>
                    <td>
                        <span class="badge badge-btn rounded-0 px-1 shadow-sm badge-primary "  v-if="post.status =='published' "   >{{ post.status |Capital }}</span>
                       <span class="badge badge-btn rounded-0 px-1 shadow-sm bg-danger"  v-else-if="post.status =='draft'" >{{ post.status | Capital}}</span>
                    </td>
                    <td>{{ post.created_at | time }}</td>
                    <td>
                        <router-link  :to="`editPost/${post.slug}`"  class="btn btn-primary btn-sm   shadow-none"><i class="fas fa-edit mr-1 "></i> edit</router-link>
                        <button @click="removePost(post.slug)" class="btn btn-danger  d-flex btn-sm  shadow-none "><i class="fas fa-trash-alt mr-1 "></i> delete</button>
                    </td>
                </tr>

                <tr class="table-sm table-warning text-danger  " v-if="emptyData()">
                    <td colspan="10"  class="text-center"> <h3 class="font-weight-bolder"> Data Not found</h3></td>
                </tr>
                </tbody>

            </table>
        </div>
    </div>
</div>
</template>

<script>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

export default {
    name: "Post",
    data:function (){
        return{
            form: new Form({
                title:null,
                category_id:'',
                status:null,
                description:null,
                thumbnail:null,
            }),
            editor: ClassicEditor,
            editorConfig: {

            }


        }

    },
    mounted() {

         this.$store.dispatch('getPosts');
    },

    computed:{

        Posts(){
            return  this.$store.getters.post;
        }
    },
    methods:{


        trColor: function (status){

            let dataTable = {
                draft:"table-danger",
                published:"table-primary",
            }
            return dataTable[status];
        },

        removePost: function (slug){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let calling =this;
                    axios.get('/posts-delete/'+slug)
                        .then( (response) => {
                            calling.$store.dispatch('getPosts')
                            // toastr.success( response.data.message, {timeOut: 5000})
                            Swal.fire(
                                 'Deleted!',
                                  response.data.message,
                                 'success'
                            )

                        })
                        .catch((error)=>{

                        })
                }
            })

        },
        emptyData: function (){
               return (this.Posts.length<1)
        }

    }

}
</script>

<style scoped>


</style>
