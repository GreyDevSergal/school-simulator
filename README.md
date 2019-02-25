# School simulator

## Routes

*GET `/agenda`*: receive full agenda from database

*GET `/group/get/{name}`*: receive all the data of one group, including members and schedule items.

*POST `/schedule/item/delete/{id}`*: Deletes schedule item with the given ID

*POST `/schedule/item/create`*: creates new schedule item with the given data

*POST `/schedule/item/update/{id}`*: updates given schedule item with the given data

