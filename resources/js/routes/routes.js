import dashboard from "../components/backend/home/dashboard";
import Category from "../components/backend/category/Category";
import AddCategory from "../components/backend/category/AddCategory";
import editCategory from "../components/backend/category/editCategory";

import AddPost from "../components/backend/post/AddPost";
import Post from "../components/backend/post/Post";
import editPost from "../components/backend/post/editPost";





export  const routes = [
    { path: '/home', component:dashboard  },
    { path: '/category', component:Category  },
    { path: '/add-category', component:AddCategory  },
    { path: '/editCategory/:slug', component:editCategory  },

    { path: '/Post', component:Post  },
    { path: '/add-post', component:AddPost  },
    { path: '/editPost/:slug', component:editPost  },


]
