<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ToDo</title>
		<link rel="stylesheet" href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/bootstrap/dist/css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
		<link rel="stylesheet" href="{{asset('css/app.css')}}">

    </head>
    <body>
	
		<div id='app'>
			<header class="header">
				<div class="container">
					<a href="#" class="header__logo header__item">ToDo</a>
					<form action="" class="header__item header__form">
						<input type="text" class="text header__input" placeholder="find task _">
					</form>
					<ul class="header__item header__nav">
						<li class="header__item">something</li>
						<li class="header__item">smth else</li>
					</ul>
				</div>
			</header>
			<div class="container relative">
				<component
						is="categories"
						:categories = 'categories'
						:current="current"
						:tasks="tasks"
						v-on:current="makeCurrent"
						v-on:name="changeName"
						v-on:schedule = "setSchedule">
				</component>
				<div class="content">
					<component
							is="tasks"
							:tasks = 'tasks'
							:current="current"
							:scheduled="scheduled"
							v-on:category="addCategory"
							v-on:delete="deleteCompleted"
					></component>
				</div>
			</div>
		</div>
		<script src="{{asset('assets/js/jquery.min.js')}}"></script>
		<script src="{{asset('assets/bootstrap/dist/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('assets/js/vue.js')}}"></script>
		<script src="{{asset('assets/js/moment.js')}}"></script>
		<script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>
		<script src="{{asset('js/app.js')}}"></script>
    </body>
</html>
