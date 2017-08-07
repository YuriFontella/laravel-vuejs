import VueRouter from 'vue-router'

let routes = [
  {	path: '/', component: require('./components/Home') },
  {	path: '/about', component: require('./components/About') },
  {	path: '/create', component: require('./components/Form') },
  {	path: '/login', component: require('./components/Login') },
  {	path: '/register', component: require('./components/Register') },
];

export default new VueRouter({ 
  routes,
  linkActiveClass: 'active'
});
