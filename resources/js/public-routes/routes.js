

//public
import Home from "../components/frontend/Home";
import About from "../components/frontend/About";
import CategoryPublic from "../components/frontend/Category";
import Single from "../components/frontend/Single";




export  const routes = [



    //public path
    { path: '/', component: Home  },
    { path: '/about', component: About  },
    { path: '/category/:slug', component:  CategoryPublic },
    { path: '/single-post/:slug', component:  Single },
    // { path: '/bar', component: Bar }
]
