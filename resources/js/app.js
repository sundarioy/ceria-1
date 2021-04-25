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
import ParentReports from './components/Reports/ParentReports.vue';
import ParentReportDetail from './components/Reports/ParentReportDetail.vue';

// TEACHER
import AssignmentCreation from './components/Assignments/Teacher/AssignmentCreation.vue';
import TeacherAssignments from './components/Assignments/Teacher/TeacherAssignments.vue';
import TeacherAssignmentsGraded from './components/Assignments/Teacher/TeacherAssignmentsGraded.vue';
import TeacherAssignmentDetail from './components/Assignments/Teacher/TeacherAssignmentDetail.vue';
import TeacherClasses from './components/Classes/TeacherClasses.vue';
import TeacherClassDetail from './components/Classes/TeacherClassDetail.vue';
import TeacherReportAddIndicator from './components/Reports/TReportAddIndicator.vue';
import TeacherReportAddTema from './components/Reports/TReportAddTema.vue';
import TeacherReportStudentList from './components/Reports/TReportStudentList.vue';
import TeacherReportStudentReports from './components/Reports/TReportStudentReports.vue';
import TeacherReportDetail from './components/Reports/TReportDetail.vue';
import TeacherReportInsert from './components/Reports/TReportInsert.vue';

//ACHIEVEMENTS
import Achievements from './components/Achievements/Achievements.vue';

//REMINDER
import Reminders from './components/Reminders/Reminders.vue';

//BULETIN
import Buletins from './components/Buletins/Buletins.vue';
import BuletinCreate from './components/Buletins/BuletinCreate.vue';
import BuletinDetail from './components/Buletins/BuletinDetail.vue';
import BuletinsApproval from './components/Buletins/BuletinsApproval.vue';
import BuletinDetailReview from './components/Buletins/BuletinDetailReview.vue';
import ParentBuletins from './components/Buletins/ParentBuletins.vue';
import Test from './components/Buletins/tes.vue';
import All from './components/Buletins/All.vue';


//PRESENCES
import Presences from './components/Presences/Presences.vue';
import TeacherPresences from './components/Presences/TeacherPresences.vue';
import TeacherPresencesDetail from './components/Presences/TeacherPresencesDetail.vue';

import App from './components/App.vue';
import Login from './components/Login.vue';


import VueMoment from 'vue-moment';
import moment from 'moment-timezone';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';


import 'vuejs-datatable/dist/themes/bootstrap-4.esm';
import { VuejsDatatableFactory } from 'vuejs-datatable';



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
Vue.use( VuejsDatatableFactory );
Vue.component('example', require('./components/ExampleComponent.vue').default);
Vue.component('header-dash', require('./components/HeaderDashboard.vue').default);
Vue.component('sidebar', require('./components/SideBar.vue').default);
Vue.component('sidebar-teacher', require('./components/SideBarTeacher.vue').default);
Vue.component('parent-assignment', require('./components/ParentAssignments.vue').default);
Vue.component('parent-class', require('./components/Classes/ParentClasses.vue').default);
Vue.component('assignment-detail', require('./components/Assignments/AssignmentDetail.vue').default);
Vue.component('t-asmtForum-pane', require('./components/Assignments/ForumPane.vue').default);

// TEACHER ASSIGNMENT DETAIL
Vue.component('t-asmtDetail-pane', require('./components/Assignments/Teacher/TAsmtDetailPane.vue').default);
Vue.component('t-asmtSubmission-pane', require('./components/Assignments/Teacher/TAsmtSubmissionPane.vue').default);


// PARENT ASSIGNMENT DETAIL
Vue.component('p-asmtDetail-pane', require('./components/Assignments/Parent/PAsmtDetailPane.vue').default);


// MOMENT
Vue.use(VueMoment, {
    moment,
});

Vue.component('datatable-component', require('./components/Buletins/Datatables.vue').default);


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
  path: '/tugas-detail/:class/:id',
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
  name: 'daftar-kelas',
  path: '/daftar-kelas',
  component: TeacherClasses
}, 
{
  name: 'detail-kelas',
  path: '/detail-kelas/:id',
  component: TeacherClassDetail
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
},
{
  name: 'daftar-kehadiran',
  path: '/daftar-kehadiran',
  component: TeacherPresences
},
{
  name: 'detail-kehadiran',
  path: '/detail-kehadiran/:id',
  component: TeacherPresencesDetail
},
{
  name: 'tambah-indikator',
  path: '/tambah-indikator/',
  component: TeacherReportAddIndicator
},,
{
  name: 'tambah-tema',
  path: '/tambah-tema/',
  component: TeacherReportAddTema
},
{
  name: 'daftar-rapor',
  path: '/daftar-rapor/',
  component: TeacherReportStudentList
},
{
  name: 'daftar-rapor-siswa',
  path: '/daftar-rapor-siswa/:id',
  component: TeacherReportStudentReports
},
{
  name: 'detail-rapor',
  path: '/detail-rapor/:id/:date',
  component: TeacherReportDetail
},
{
  name: 'tambah-rapor',
  path: '/tambah-rapor/:id/:date',
  component: TeacherReportInsert
},
{
  name: 'rapor',
  path: '/rapor/',
  component: ParentReports
},
{
  name: 'rapor-detail',
  path: '/rapor-detail/:id',
  component: ParentReportDetail
},
{
  name: 'tambah-buletin',
  path: '/tambah-buletin',
  component: BuletinCreate
},
{
  name: 'buletin-detail',
  path: '/buletin-detail/:id',
  component: BuletinDetail
},
{
  name: 'buletin-approval',
  path: '/buletin-approval',
  component: BuletinsApproval
},
{
  name: 'buletin-review',
  path: '/buletin-review/:id',
  component: BuletinDetailReview
},
{
  name: 'daftar-buletin',
  path: '/daftar-buletin',
  component: ParentBuletins
},
{
  name: 'all',
  path: '/all',
  component: All
},
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

