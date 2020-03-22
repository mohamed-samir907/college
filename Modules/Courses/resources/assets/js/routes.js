import CategoriesIndex      from './components/categories/Index';
import CategoriesCreate     from './components/categories/Create'
import CategoriesEdit       from './components/categories/Edit'

import CoursesIndex         from './components/courses/Index';
import CoursesCreate        from './components/courses/Create'
import CoursesEdit          from './components/categories/Edit'

import ContentsIndex        from './components/contents/Index';
import ContentsCreate       from './components/contents/Create'
import ContentsEdit         from './components/categories/Edit'

const courseRoutes = [
    { path: '/admin/categories', component: CategoriesIndex },
    { path: '/admin/categories/create', component: CategoriesCreate },
    { path: '/admin/categories/:id/edit', component: CategoriesEdit },

    { path: '/admin/courses', component: CoursesIndex },
    { path: '/admin/courses/create', component: CoursesCreate },
    { path: '/admin/courses/:id/edit', component: CoursesEdit },

    { path: '/admin/contents', component: ContentsIndex },
    { path: '/admin/contents/create', component: ContentsCreate },
    { path: '/admin/contents/:id/edit', component: ContentsEdit },
];

export default courseRoutes;
