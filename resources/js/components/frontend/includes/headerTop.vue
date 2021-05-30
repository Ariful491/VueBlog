<template>
    <!-- Nav Bar Start -->
    <div class="navbar navbar-expand-lg bg-dark navbar-dark" >
        <div class="container-fluid">
            <router-link to="/" class="navbar-brand">Super<span>Vue</span>BLog</router-link>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav ml-auto">
                    <router-link  to="/"  class="nav-item nav-link"  exact-active-class="active"> Home </router-link>
                    <div v-for="category in activeCategories" >
                        <router-link  :to="`/category/${category.slug}`"  class="nav-item nav-link"  active-class="active" > {{ category.name }}  </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Nav Bar End -->
</template>

<script>
export default {
name: "headerTop",
    data:function (){
        return{

        }
    },

    mounted() {
        this.$store.dispatch('getActiveCategories');

    },
    watch: {


    },

    computed:{
        activeCategories(){
            return  this.$store.getters.activeCategories;
        }
    },
}
</script>

<style scoped>

</style>
