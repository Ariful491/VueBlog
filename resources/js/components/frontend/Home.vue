<template>
    <div>
        <div class="container">
            <div class="row blog-page">

                <div v-for="post in posts.data" class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.0s" style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img :src="post.thumbnail"    alt="Blog">
                        </div>
                        <div class="blog-text">
                            <h2>{{post.title|subString(25)}}</h2>
                            <div class="blog-meta">
                                <p><i class="far fa-list-alt"></i>{{ post.user.name }}</p>
                                <p><i class="far fa-calendar-alt"></i>{{ post.created_at |timeFormat }}</p>
                                <p><i class="far fa-comments"></i>5</p>
                            </div>
                            <p v-html="subWithStr(post.description,100)">
                            </p>
                            <router-link :to="`/single-post/${post.slug}`" class="btn" href="">Read More <i class="fa fa-angle-right"></i></router-link>
                        </div>
                    </div>
                </div>
            </div>
<!--            <div class="row">-->
<!--                <div class="col-12">-->
<!--                    <ul class="pagination justify-content-center">-->
<!--                        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>-->
<!--                        <li class="page-item"><a class="page-link" href="#">1</a></li>-->
<!--                        <li class="page-item active"><a class="page-link" href="#">2</a></li>-->
<!--                        <li class="page-item"><a class="page-link" href="#">3</a></li>-->
<!--                        <li class="page-item"><a class="page-link" href="#">Next</a></li>-->
<!--                    </ul>-->
<!--                </div>-->
<!--            </div>-->
            <pagination :data="posts" @pagination-change-page="getResults"></pagination>

        </div>

    </div>
</template>

<script>
export default {
    name: "Home",
    data(){
        return{
            posts: {},
        }
    },
    methods:{
        getResults(page = 1) {
            axios.get('/get-all-posts?page=' + page)
                .then(response => {
                    this.posts = response.data;
                });
        },


    },
    mounted(){
      // this.$store.dispatch('getPostsAll');
        this.getResults();
    },
    computed:{
       // posts(){
       //   return   this.$store.getters.getAllposts;
       // }
    }
}
</script>

<style scoped>

</style>
