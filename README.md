# Eclipx PHP Coding Test

Backend - using PHP Laravel framework

Frontend - using React Library

## Installation Backend

Use Docker to set up the environment

```bash
#build Dockerfile
docker build . -f docker build . -f PhpDockerfile --no-cache

#run container
docker-compose up
```

Setup backend with Laravel
```bash
#go to src/api_registration folder and install packages
composer install

#copy .env.example to .env

#go to php-test container
docker exec -it php-test

#api_registration folder
cd api_registration

#add registration column to invoice table
php artisan migrate --path=/database/migrations/2021_09_30_014839_add_registration_column_to_invoices_table.php

#seed data into registration
php artisan db:seed --class=InvoiceSeeder

#unit test
php artisan test
```

There are two APIs provided:

http://localhost:8080/api/invoices

http://localhost:8080/api/invoices/39058

## Installation Frontend

```
#go to src
git clone git@github.com:amanda-lan/react-simple-table-ui.git

#go to /react-simple-table-ui
npm install

#strat the project on port 3000
npm start

#Run ESlint to analyzes your code to quickly find problems
npx eslint . --fix

#unit test
npm run test
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
