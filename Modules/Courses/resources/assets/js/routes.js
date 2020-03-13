import Index      from './components/coupons/Index';
import Create     from './components/coupons/Create'
import Edit       from './components/coupons/Edit'

const couponsRoutes = [
    { path: '/admin/coupons', component: Index },
    { path: '/admin/coupons/create', component: Create },
    { path: '/admin/coupons/:id/edit', component: Edit }
];

export default couponsRoutes;