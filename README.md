# BackSymfony

## To load fixtures
- symfony console d:f:l
---
# EndPoints API
---
## /api/register
1. [x] **POST**
- username
- password
-> create user

## /api/login_check
1. [x] **POST**
- username
- password
-> return token

## /api/user/data
1. [x] **GET**
-> return user data needed when landing in the game
- username
- money 
- clicIncome 
- lastConnection
- userworkers
- userupgrades

## /api/user/reset
1. [x] **GET**
-> reset all user related data


## /api/users/{id}
<!-- 1. [ ] **DELETE**
-> delete user only if admin routes -->

2. [x] **PATCH**
- money?
- clicIncome?
- lastConnection?
-> update user.money, user.clicIncome, user.lastConnection

## /api/user/workers
1. [x] **POST**
- quantity
- calculatedIncome
- idWorker
- idUser
-> create a new userWorker

## /api/user/workers/{id}
1. [x] **PATCH**
- quantity?
- calculatedIncome?
-> update given value(s) i for targeted userWorker
-> might be better with a dto but need a processor in this case 

## /user/addupgrades/{id}
1. [x] **Get**
-> create new userUpgrade

## /api/workers
1. [x] **GET**
-> return an array of all workers
- workers

## /api/workers/{id}
1. [x] **GET**
-> return all the data of one worker
- name
- basePrice
- baseIncome
- idWorkerType
- upgrades

## /api/upgrades
1. [x] **GET**
-> return an array of all upgrades
- upgrades

## /api/upgrades/{id}
1. [x] **GET**
-> return an upgrade

## /api/upgrade/{id}
1. [x] **GET**
-> return all data of one upgrade
- upgradeName
- price
- upgradeDesc
- affectWorker
- effectIndice
- effectType