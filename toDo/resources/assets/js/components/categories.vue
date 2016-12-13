<template>
    <div class="categories" v-bind:class="{active:isActive}">
        <span v-show="!haveCategories" class="categories__message">You need at least one category</span>
        <span v-show="notEmpty" class="categories__message">You are trying to delete category
            that is not empty</span>
        <span class="categories__message" @click="isActive = !isActive">Select category</span>
        <ul class="categories__list">
            <li v-for="category in categories"
                @click="makeCurrent(category)"
                class="categories__item"
            >
                <span class="categories__text">{{category.name}}</span>

                <div class="categories__controls">
                    <span
                            @click.stop='deleteCategory(category)'
                            class="categories__delete"
                        >
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </span>

                    <i class="fa fa-pencil-square-o categories__edit" aria-hidden="true"
                       @click="category.edit = !category.edit"
                    ></i>
                </div>
                <transition name="slide">
                <form class="categories__form" v-if='category.edit'>
                    <input
                            class="categories__input"
                            type="text"
                            placeholder="Edit task"
                            @focus="saveName(category.name)"
                            v-model="category.name"
                    >
                    <button class="categories__button" @click.prevent="editCategory(category)">Edit</button>
                </form>
                    </transition>
            </li>
        </ul>
        <form class="categories__form">
            <input class="categories__input" type="text" placeholder="Add category" v-model='newCategory'>
            <button class="categories__button" @click.prevent="addCategory">Add</button>
        </form>
    </div>
</template>

<script>
    export default {
        props:['categories', 'current', 'tasks'],
        data: function(){
            return{
                newCategory:'',
                haveCategories:true,
                currentCategory:'',
                oldName:'',
                notEmpty:false,
                isActive:false
            }
        },

        methods:{
            checkEmpty: function(category){
            let counter = 0;
               this.tasks.forEach(function(task){
                    if(task.category == category.name){
                        counter++
                    }
               });
               if(counter){
                    return false
               }else{
                    return true
               }
            },
            deleteCategory: function(category){
            var vm = this;
                if(this.categories.length - 1 && this.checkEmpty(category)){
                    this.categories.splice(this.categories.indexOf(category), 1);
                 }else if(!this.checkEmpty(category)){
                 vm.notEmpty = true;
                    setTimeout(function(){
                         vm.notEmpty = false;
                    }, 2000);
                }else{
                vm.haveCategories = false
                    setTimeout(function(){
                         vm.haveCategories = true
                    }, 2000);
                }
            },
            addCategory:function(){
                if(this.newCategory){
                    this.categories.push({ name: this.newCategory, edit: false });
                    this.newCategory = '';
                }
                return
            },
            editCategory: function(category){
                category.edit = !category.edit
                this.$emit('name',category.name, this.oldName);
            },
            makeCurrent: function(category){
                this.currentCategory = category.name;
                this.$emit('current',this.currentCategory);
            },
            saveName: function(oldName){
                this.oldName = oldName;
            }
        }
    }
</script>
