<template>
    <div class="container">
        <div class="row">
            <div   class="col-lg-8">
                <div class="single-content wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <img :src="postDetails.thumbnail" class="img-fluid">
                    <h2>{{postDetails.title}}</h2>
                    <p v-html="postDetails.description">
                    </p>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

export default {
name: "Single",
    data:function (){
        return{
            postDetails:[],

        }

    },
    methods:{
        PostDetails:function (){
            let calling=this;
            axios.get("/post-details/"+this.$route.params.slug)
                .then( (response)=>{
                   this.postDetails =  response.data.post;
                   //  console.log(response)
                }).catch(function (error) {
                return error
            })
        },

    },
    mounted() {
        this.PostDetails();

    },

}
</script>

<style scoped>

</style>
