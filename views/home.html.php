<!DOCTYPE html>
<html>
  <head>
    <title>Welcome to Symfony!</title>
    <?php if (app.environment == 'production'): ?>
      <link rel="stylesheet" href="/assets/home.css">
    <?php endif ?>
  </head>
  <body>
    <h1>heya</h1>
    <p>this is my home page twig template</p>
    <div id="app"></div>
    <?php if (app.environment == 'production'): ?>
      <script type="text/javascript" src="/assets/manifest.js"></script>
      <script type="text/javascript" src="/assets/vendor.js"></script>
    <?php endif ?>
    <script type="text/javascript" src="/assets/home.js"></script>
  </body>
</html>
