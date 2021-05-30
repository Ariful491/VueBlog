export default {

        state: {
            category_data:[],
            post_data:[],
            activeCategory:[],
            allPosts:[],
        },
        getters: {
            category(state){
                return state.category_data
            },
            post(state){
                return state.post_data
            },
            activeCategories(state){
                return state.activeCategory
            },
            getAllposts(state){
                return state.allPosts
            }
        },
        actions:{
            getCategories(data){
                 axios.get('/categories')
                     .then( (response) => {

                          data.commit("categoryAll", response.data.categories )

                     })
                     .catch((error)=>{


                         console.log(error)

                     })
            },
            getPosts(post){
                axios.get('/posts')
                    .then( (response) => {
                        post.commit("postAll",response.data.posts )

                    })
                    .catch((error)=>{
                        console.log(error)
                    })

            },
            getActiveCategories(activeCategory){
                axios.get('/activeCategory')
                    .then( (response) => {

                        activeCategory.commit("activeCategory",response.data.activeCategories )
                        // console.log(response.data.activeCategories)

                    })
                    .catch((error)=>{


                        console.log(error)

                    })

            },
            getPostsAll(posts){
                axios.get('/get-all-posts')
                    .then((response)=>{
                       posts.commit("allActivePosts",response.data.posts)
                    })
                    .catch((error)=>{
                        console.log(error)
                    })
            }


        },
        mutations: {
            categoryAll(state,data){
                return state.category_data = data;
            },
            postAll(state,data){
                return state.post_data = data;
            },
            activeCategory(state,data){
                return state.activeCategory = data;
            },
            allActivePosts(state,data){
                return state.allPosts = data;
            }
        }

}
