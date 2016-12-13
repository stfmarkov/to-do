<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ToDo</title>
		<link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css">
		<link rel="stylesheet" href="/public/css/app.css">

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
						v-on:name="changeName">
				</component>
				<div class="content">
					<component
							is="tasks"
							:tasks = 'tasks'
							:current="current"
							v-on:category="addCategory"
							v-on:delete="deleteCompleted"

					></component>
				</div>
			</div>
		</div>

		<script src="/bower_components/jquery/dist/jquery.min.js"></script>
		<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="/bower_components/vue/dist/vue.js"></script>
		<script src="/bower_components/moment/moment.js"></script>
		<script src="/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
		<script src="/public/js/app.js"></script>

    </body>
</html>
