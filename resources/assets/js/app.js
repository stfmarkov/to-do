
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('categories', require('./components/categories.vue'));
Vue.component('tasks', require('./components/tasks.vue'));

const app = new Vue({
    el: '#app',
    data:{
        current:'all',
        scheduled:'schedule',
        categories:[
            { name:'all', edit: false },
            { name:'home', edit: false },
            { name:'office', edit: false },
            { name:'weekend', edit: false },
        ],
        tasks:[
            { name:'do the dishes', category: 'home', completed:false, schedule:{day: "2", month: "12", time: "5:51", year: "2016"},},
            { name:'wash the floor', category: 'home', completed:false, schedule:{day: "16", month: "12", time: "5:51", year: "2016"},},
            { name:'star the new project', category: 'office', completed:false, schedule:{day: "15", month: "12", time: "5:51", year: "2016"},},
            { name:'call the client', category: 'office', completed:false, schedule:{day: "16", month: "12", time: "5:51", year: "2016"},},
            { name:'finish the project', category: 'office', completed:false, schedule:{day: "15", month: "12", time: "5:51", year: "2016"},},
            { name:'call John', category: 'weekend', completed:false, schedule:{day: "17", month: "12", time: "5:51", year: "2016"},},
            { name:'play football', category: 'weekend', completed:false, schedule:{day: "18", month: "12", time: "5:51", year: "2016"},},
        ]
    },
    computed:{
        today: function(){
            let date = new Date;
            let month = date.getMonth() + 1;
            let day = date.getDate();
            let year = date.getFullYear();
            return {day: day, month: month, year: year};
        },
    },
    methods:{
        makeCurrent: function(category){
            this.current = category;
        },
        setSchedule: function(schedule){
            this.scheduled = schedule;
        },
        changeName: function(newName,oldName){
            this.tasks.forEach(function(task){
                if(task.category == oldName)
                    task.category = newName;
            });
        },
        addCategory: function(newCategory){
            this.categories.forEach(function(category){
                if(category.name == newCategory)
                    return;
            });
            app.categories.push({name:newCategory, edit:false});
        },
        deleteCompleted: function(){
            for(let i = 0; i < this.tasks.length ; i++){
                if(this.tasks[i].completed){
                    this.tasks.splice(i,1);
                    i--;
                }
            }
        },
    }
});

$(function () {
    $('#datetimepicker1').datetimepicker();
});
$(function () {
    $('#datetimepicker2').datetimepicker();
});


