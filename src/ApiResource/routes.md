#All routes
---
## /api/register
1. PUT
- username
- password
- confirmPassword
-> create user

## /api/login_check
1. POST
- username
- password
-> return token

## /api/users/{id}
1. GET
-> return user data needed when landing in the game
- username
- money 
- clicIncome 
- lastConnection
- userworkers
- userupgrades

2. PATCH  <!-- Here or elsewhere ? -->
- username?
- money?
- clicIncome?
- lastConnection?
- userworkers?
- userupgrades?
-> update one or more data in DB

## /api/user/workers
1. PUT
- quantity
- calculatedIncome
- idWorker
- idUser
->create a new userWorker 

## /api/workers
1. GET
-> return an array of all workers
- workers

## /api/workers/{id}
1. GET
-> return all the data of one worker
- id
- name
- basePrice
- baseIncome
- idWorkerType
- upgrades

## /api/upgrades
1. GET
-> return an array of all upgrades
- upgrades

## /api/upgrades/{id}
1. GET
-> return all data of one upgrade
- upgradeName
- price
- upgradeDesc
- affectWorker
- effectIndice
- effectType