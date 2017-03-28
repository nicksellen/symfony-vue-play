# symfony-vue-play

playing around with symfony and vue

Run server:
```
composer install
php -S 127.0.0.1:8000
```

Run frontend:
```
cd frontend
yarn
yarn dev
```

Visit [localhost:4000](http://localhost:4000)

## TODO

- [ ] attach to server-side rendered html
- [x] output js file for each page
- [ ] add simple state management [like I added here](https://gitlab.com/foodsharing-dev/foodsharing/blob/2a90e05a23dbc643d273bfb68c5b8811a7e79609/tpl/default.php#L256)
- [ ] add [veux](https://github.com/vuejs/vuex) for state management
