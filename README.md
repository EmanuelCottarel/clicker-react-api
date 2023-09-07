# BackSymfony
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

<!-- 2. [ ] **PATCH**
- username?
- money?
- clicIncome?
- lastConnection?
- userworkers? (foreach)
- userupgrades?
-> update one or more data in DB -->

## /api/users/{id}
<!-- 1. [ ] **DELETE**
-> delete user -->

2. [x] **PATCH**
- money?
- clicIncome?
-> update user.money or user.clicIncome

## /api/user/workers
1. [ ] **POST**
- quantity
- calculatedIncome
- idWorker
- idUser
-> create a new userWorker

2. [ ] **DELETE**
- idUser
-> delete all userWorkers related to this user (useFull if ascension)

## /api/user/workers/{id}
1. [ ] **PATCH**
- quantity?
- calculatedIncome?
-> update given value(s) i for targeted userWorker

## /api/user/upgrades
1. [ ] **POST**
- idUser
- idUpgrade
-> create new userUpgrade

2. [ ] **DELETE**
- idUser
-> delete all userUpgrades related to this user (useFull if ascension)

## /api/workers
1. [ ] **GET**
-> return an array of all workers
- workers

## /api/workers/{id}
1. [ ] **GET**
-> return all the data of one worker
- name
- basePrice
- baseIncome
- idWorkerType
- upgrades

## /api/upgrades
1. [ ] **GET**
-> return an array of all upgrades
- upgrades

## /api/upgrades/{id}
1. [ ] **GET**
-> return all data of one upgrade
- upgradeName
- price
- upgradeDesc
- affectWorker
- effectIndice
- effectType
