<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
				<meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>
    </head>
    <body>
        <div id="app">
						<router-link to="/">Home</router-link>
						<router-link to="/about">About</router-link>
						<router-link to="/login">Login</router-link>
						<router-link to="/register">Cadastro</router-link>

						<router-view></router-view>
        </div>


        <script type="text/javascript">
        window.Laravel =  <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
        </script>
        <script src="/js/app.js" type="text/javascript"></script>
    </body>
</html>
