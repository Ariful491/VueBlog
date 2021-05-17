export default {

        state: {
            category_data:[],
            post_data:[],
        },
        getters: {
            category(state){
                return state.category_data
            },
            post(state){
                return state.post_data
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

            }
        },
        mutations: {
            categoryAll(state,data){
                return state.category_data = data;
            },
            postAll(state,data){
                return state.post_data = data;
            }
        }

}
