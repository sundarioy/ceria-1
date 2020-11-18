/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

 window.Vue = require('vue');

 import VueRouter from 'vue-router';
 import VueAxios from 'vue-axios'; 
 import Axios from 'axios';
 import VueSweetalert2 from 'vue-sweetalert2'; 
 import Datepicker from 'vuejs-datepicker';
 import VueTimepicker from 'vue2-timepicker';
 import VModal from 'vue-js-modal';
// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';


//LOGIN

// PARENT
import ParentAssignments from './components/ParentAssignments.vue';
import AssignmentsSubmitted from './components/Assignments/AssignmentsSubmitted.vue';
import AssignmentsUnsubmitted from './components/Assignments/AssignmentsUnsubmitted.vue';
import AssignmentDetail from './components/Assignments/AssignmentDetail.vue';
import AssignmentDetailSubmitted from './components/Assignments/AssignmentDetailSubmitted.vue';
import ParentClasses from './components/Classes/ParentClasses.vue';

// TEACHER
import AssignmentCreation from './components/Assignments/Teacher/AssignmentCreation.vue';
import TeacherAssignments from './components/Assignments/Teacher/TeacherAssignments.vue';
import TeacherAssignmentsGraded from './components/Assignments/Teacher/TeacherAssignmentsGraded.vue';
import TeacherAssignmentDetail from './components/Assignments/Teacher/TeacherAssignmentDetail.vue';

//ACHIEVEMENTS
import Achievements from './components/Achievements/Achievements.vue';

//REMINDER
import Reminders from './components/Reminders/Reminders.vue';

//BULETIN
import Buletins from './components/Buletins/Buletins.vue';

//PRESENCES
import Presences from './components/Presences/Presences.vue';

import App from './components/App.vue';
import Login from './components/Login.vue';


import VueMoment from 'vue-moment';
import moment from 'moment-timezone';
 


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.use(VueRouter,VueAxios,Axios,Datepicker,VueTimepicker,VModal);
Vue.use(VueSweetalert2);
Vue.component('example', require('./components/ExampleComponent.vue').default);
Vue.component('header-dash', require('./components/HeaderDashboard.vue').default);
Vue.component('sidebar', require('./components/SideBar.vue').default);
Vue.component('parent-assignment', require('./components/ParentAssignments.vue').default);
Vue.component('parent-class', require('./components/Classes/ParentClasses.vue').default);
Vue.component('assignment-detail', require('./components/Assignments/AssignmentDetail.vue').default);

// TEACHER ASSIGNMENT DETAIL
Vue.component('t-asmtDetail-pane', require('./components/Assignments/Teacher/TAsmtDetailPane.vue').default);
Vue.component('t-asmtSubmission-pane', require('./components/Assignments/Teacher/TAsmtSubmissionPane.vue').default);


// PARENT ASSIGNMENT DETAIL
Vue.component('p-asmtDetail-pane', require('./components/Assignments/Parent/PAsmtDetailPane.vue').default);


// MOMENT
Vue.use(VueMoment, {
    moment,
});


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


 const routes = [
 {
  name: 'tugas',
  path: '/tugas/open',
  component: ParentAssignments
},
{
  name: 'tugas-closed',
  path: '/tugas-closed',
  component: AssignmentsSubmitted
},
{
  name: 'tugas-open',
  path: '/tugas-open',
  component: AssignmentsUnsubmitted
},
{
  name: 'tugas-detail',
  path: '/tugas-detail/:id',
  component: AssignmentDetail
},
{
  name: 'tugas-closed-detail',
  path: '/tugas-closed-detail',
  component: AssignmentDetailSubmitted
},
{
  name: 'tugas-create',
  path: '/tugas-create',
  component: AssignmentCreation
},
{
  name: 'tugas-ungraded',
  path: '/tugas-ungraded',
  component: TeacherAssignments
},
{
  name: 'tugas-graded',
  path: '/tugas-graded',
  component: TeacherAssignmentsGraded
},
{
  name: 'tugas-ungraded-detail',
  path: '/tugas-ungraded-detail/:id',
  component: TeacherAssignmentDetail
},
{
  name: 'kelas',
  path: '/kelas',
  component: ParentClasses
}, 
{
  name: 'prestasi',
  path: '/prestasi',
  component: Achievements
},
{
  name: 'buletin',
  path: '/buletin',
  component: Buletins
},
{
  name: 'pengingat',
  path: '/pengingat',
  component: Reminders
},
{
  name: 'kehadiran',
  path: '/kehadiran',
  component: Presences
}
];

const router = new VueRouter({ 
	mode: 'history', 
	routes: routes
});


//----------- OGIN COMPONENT ------------
const routesLogin = [
{
  name: 'login',
  path: '/login',
  component: Login
},
];

const routerLogin = new VueRouter({ 
  mode: 'history', 
  routes: routesLogin
});

const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');
const vue = new Vue(Vue.util.extend({ routerLogin }, Login)).$mount('#app');

