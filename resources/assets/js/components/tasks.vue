<template>
    <div class="tasks">
        <span v-show="!haveTasks || !tasksLeft" class="tasks__message">You have no more tasks from this category</span>
        <span v-show="tasksLeft" class="tasks__message">You have {{tasksLeft}} tasks from this category</span>
        <ul class="tasks__list">
                    <li v-for="task in tasks"
                        v-if="isToday(task) && (isCurrent(task) || current == 'all')&& !task.completed"
                        @click="task.edit = !task.edit "
                        class="tasks__item clearfix"
                    >
                        <input type="text" v-model="task.name" class="tasks__text">
                        <span v-show="isLate(task)" class="tasks__schedule">{{task.schedule.day}} / {{task.schedule.month}}</span>
                        <span v-show="!isLate(task)" class="tasks__schedule tasks__schedule_red">{{task.schedule.day}} / {{task.schedule.month}}</span>
                         <span @click.stop='deleteTask(task)' class="tasks__delete tasks__control">
                             <i class="fa fa-times" aria-hidden="true"></i>
                          </span>

                        <i class="fa fa-check tasks__check tasks__control" aria-hidden="true"
                           @click.stop="task.completed = !task.completed"
                        ></i>
                    </li>
        </ul>
        <form class="tasks__form clearfix">
            <input class="tasks__input tasks__input_small" type="text" placeholder="Add task" v-model='newTask'>
            <input class="tasks__input tasks__input_small" type="text" placeholder="Add category" v-model='taskCategory'>
            <div class='input-group date tasks__input tasks__input_small' id='datetimepicker1'>
                <input type='text' class="form-control date__input" placeholder="Schedule" v-model='schedule'/>
                    <span class="input-group-addon date__btn">
                        <span class="glyphicon glyphicon-calendar date__icon"></span>
                    </span>
            </div>
            <button class="tasks__button" @click.prevent="addTask">Add</button>
        </form>
        <ul class="tasks__list">
            <li
                    class="tasks__item tasks__item_completed"
                    v-for="task in tasks"
                    v-show='task.completed'
            >
                <span class="tasks__text">{{task.name}}</span>
                <span @click='deleteTask(task)' class="tasks__control">
                     <i class="fa fa-times" aria-hidden="true"></i>
                </span>
            </li>
        </ul>
        <button
                class="tasks__button"
                @click="deleteCompleted()"
                v-show="tasksCompleted"
        >Delete completed</button>
    </div>


</template>

<script>
    export default {
        props:['tasks', 'current', 'scheduled', 'today'],
        data: function(){
            return{
                newTask:'',
                taskCategory:'',
                haveTasks:true,
                schedule:'',
            }
        },
        computed:{
            tasksLeft: function(task){
                return this.tasks.filter(this.inProgress).filter(this.isCurrent).length;
            },
            tasksCompleted: function(){
                return this.tasks.filter(this.isCompleted).length
            },
            taskDate: function(){
                let date = this.schedule.split(' ');
                let time = date[1];
                let temp = date[0].split("/");
                let month = temp[0];
                let day = temp[1];
                let year = temp[2];
                return {day: day, month: month, year: year, time:time};
            }
        },
        methods:{
            isCompleted: function(task){
                return task.completed;
            },
            inProgress: function(task){
                return !task.completed;
            },
            //Check if the task is from the selected category
            isCurrent:function(task){
                if(this.current == "all"){
                    return true
                }
                else if(task.category == this.current){
                    return true
                }
                else
                    return false
            },
            //Check if the task is from the day
            isToday:function(task){
                if(task.schedule.day == this.scheduled.day){
                    return true
                }else if(this.scheduled.day == undefined){
                    return true
                }else{
                    return false
                }
            },
            isLate: function(task){
                if(task.schedule.year > this.today.year){
                    console.log('year');
                    return true
                }else if(task.schedule.month > this.today.month){
                    console.log(task.schedule.month);
                    console.log(this.today);
                    return true
                }else if(task.schedule.day > this.today.day){
                console.log('day');
                    return true
                }else{
                console.log('in time');
                    return false
                }
            },
            deleteTask: function(task){
                    this.tasks.splice(this.tasks.indexOf(task), 1);
                    var vm = this;
                    if(!this.tasks.length){
                        vm.haveTasks = false
                        setTimeout(function(){
                             vm.haveTasks = true
                        }, 1000);
                    }
            },
            addTask:function(){
                if(this.newTask && this.taskCategory){
                    this.tasks.push({
                                        name: this.newTask,
                                        category:this.taskCategory,
                                        completed: false,
                                        schedule:this.taskDate,
                                     });
                    this.$emit('category',this.taskCategory);
                    this.newTask = '';
                    this.taskCategory = '';
                    this.taskDate = '';
                };
                return
            },
            deleteCompleted: function(){
                this.$emit('delete');
            }
        }
    }
</script>
