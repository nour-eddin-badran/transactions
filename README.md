# Transactions

## Installation Guide

* Install PHP dependencies
```cmd
composer install
```

###NOTE:

<br/>

if it throws error try

<br/>

```cmd 
 composer install --ignore-platform-reqs
 ```
 <br/>
 or remove the composer.lock

* Install node packages 
```cmd
npm install
```

 * Compile node packages
 ```cmd
 npm run dev
 ```
  
 * Migrate and seed the date 
 ```cmd
 php artisan migrate --seed
 ```
 <br/>

 
### Note: 
There is already seeded admin 
<br/>
 email: admin@example.com
 <br/>
 password: password
 <br/>

###APIs
The api link is:
localhost:8000/api/v1/auth/login
localhost:8000/api/v1/transactions
