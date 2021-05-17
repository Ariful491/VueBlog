<template>
<div class="container">
            <section class="content-header ">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Category</h1>
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
        <div class="col-md-10 card mx-auto">
            <div class="ml-auto mt-2">
                <router-link to="add-category" class="btn btn-success rounded-0 shadow-sm btn-sm"> add category </router-link>
            </div>
            <table class="table table-bordered mt-2 ">
                <thead>
                <tr>
                    <th scope="col">
                        <input type="checkbox" id="allcheck" :disabled="emptyData()" @click="selectAll"  v-model="slugsAll">
                        <label for="allcheck">Select ALl</label>

                    </th>
                    <th scope="col">#</th>
                    <th scope="col">Sl No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(category, index) in Categories" :class="trColor(category.status)">
                    <th><input type="checkbox" :value="category.slug" v-model="slugs"></th>
                    <th scope="row">{{++index}}</th>
                    <th scope="row">{{category.id}}</th>
                    <td><a href="edit">{{category.name | subString(15) }}</a></td>
                    <td>{{ category.slug }}</td>
                    <td>
                        <span class="badge badge-btn rounded-0 px-1 shadow-sm badge-primary "  v-if="category.status ==1 "   >{{ statusName(category.status) }}</span>
                       <span class="badge badge-btn rounded-0 px-1 shadow-sm bg-danger"  v-else-if="category.status ==0" >{{ statusName(category.status) }}</span>
                    </td>
                    <td>{{ category.created_at | time }}</td>
                    <td>
                        <router-link  :to="`editCategory/${category.slug}`"  class="btn btn-primary btn-sm   shadow-none"><i class="fas fa-edit mr-1 "></i> edit</router-link>
                        <button @click="removeCategory(category.slug)" class="btn btn-danger  d-flex btn-sm  shadow-none "><i class="fas fa-trash-alt mr-1 "></i> delete</button>
                    </td>
                </tr>
                <tr   v-if="!emptyData()">
                    <td colspan="2"><button :disabled="deleteBtn"  @click="removeItem(slugs)"  class="btn btn-block btn-sm btn-primary rounded-0 shadow">Delete All</button></td>
                    <td colspan="2"><button :disabled="deleteBtn"  @click="chnageStatus(slugs)"  class="btn btn-block btn-sm btn-primary rounded-0 shadow">Active</button></td>
                    <td colspan="2"><button :disabled="deleteBtn"  @click="deactiveStatus(slugs)"  class="btn btn-block btn-sm btn-primary rounded-0 shadow">InActive</button></td>
                </tr>

                <tr class="table-sm table-warning text-danger  " v-if="emptyData()">
                    <td colspan="8"  class="text-center"> <h3 class="font-weight-bolder"> Data Not found</h3></td>
                </tr>
                </tbody>

            </table>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: "Category",
    data:function (){
      return{
          slugs :[],
          slugsAll:false,
          deleteBtn:true,
      }
    },

    mounted() {
         this.$store.dispatch('getCategories');

    },
    watch: {
        slugs: function (){
            this.slugsAll = (this.slugs.length === this.Categories.length)
            if(this.slugs.length>0){
                this.deleteBtn=false
            }
            else {
                this.deleteBtn=true
            }

        }

    },

    computed:{
         Categories(){
            return  this.$store.getters.category;
        }
    },

    methods:{
        statusName: function (status){
            // if(data==1){
            //     return "Active";
            // }
            // else {
            //     return  "Inactive";
            // }
            let data = {
                0:"Inactive",
                1:"Active",
            }
            return data[status];
        },

        trColor: function (status){

            let dataTable = {
                0:"table-danger",
                1:"table-primary",
            }
            return dataTable[status];
        },

        removeCategory: function (slug){
            this.confirm(()=>{

                    let calling =this;
                    axios.get('categories-delete/'+slug)
                        .then( (response) => {
                            calling.$store.dispatch('getCategories');
                            Swal.fire(
                                'Deleted!',
                                response.data.message,
                                'success'
                            )


                        })
                        .catch((error)=>{

                        })

            })
        },
        emptyData: function (){
               return (this.Categories.length<1)
        },
        selectAll: function (event){
            if (event.target.checked == false){
                this.slugs=[];


            }
            else {
                this.Categories.forEach((category)=>{
                      this.slugs.push(category.slug)
                });

            }
        },
        removeItem: function (slugs){
            let calling=this;
           axios.post('delete-category-item',{slugs: slugs}).then((response)=>{
               calling.$store.dispatch('getCategories');
               calling.slugs =[];
               calling.slugsAll=false;
               calling.deleteBtn=true;
               toastr.success(response.data.total+' '+response.data.message)


           }).catch((error)=>{

           })
        },
        chnageStatus: function (slugs){
            let calling=this;
            axios.post('category-status-active',{slugs: slugs}).then((response)=>{
                calling.$store.dispatch('getCategories');
                calling.slugs =[];
                calling.slugsAll=false;
                calling.deleteBtn=true;
                toastr.success(response.data.total+' '+response.data.message)


            }).catch((error)=>{

            })
        },
        deactiveStatus: function (slugs){
            let calling=this;
            axios.post('category-status-inactive',{slugs: slugs}).then((response)=>{
                calling.$store.dispatch('getCategories');
                calling.slugs =[];
                calling.slugsAll=false;
                calling.deleteBtn=true;
                toastr.success(response.data.total+' '+response.data.message)


            }).catch((error)=>{

            })
        }
    }

}
</script>

<style scoped>


</style>
