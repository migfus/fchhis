<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Loading...</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="icon" href="/images/logo.png" type="image/x-icon">

  <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pace-js@latest/pace-theme-default.min.css">
  <link rel="stylesheet" href="/flat-top.css" >
  <style>
    .preload-logo-container {
      text-align: center;
      flex-direction: column;
      display: flex;
      justify-content: center;
      align-items: center;
      justify-content: space-between;
      margin: auto;
    }
    .preload-logo-item {
      position: absolute;
      top: 20%;

    }
  </style>
</head>

<body class="h-full">
	<div id="app">

    <div id="loading-bg" class="preload-logo-container">
      <div class="preload-logo-item">
        <div class="loading-bg">
          <object data="/images/logo.png" style="width: 240px; height: auto; z-index: 10"/>
        </div>

        <div class="loading-bg" style="margin-top: 0px">
          <h3>Development {{ env('VITE_VER') }}</h3>
        </div>
      </div>
    </div>

  </div>

	@vite('resources/js/app.ts')
</body>
</html>
