## First Step GIT/HUB
- Create an account for GIT/HUB
- Access to this link and create a fork https://github.com/arnauFreightos/technical_backend_wcn.git
- Git clone in your IDE and... You can Start!


## Environment Setup

###  🐳 Needed tools

1. [Install Docker](https://www.docker.com/get-started)
3. Move to the project folder: `cd technical_backend_wcn`


## 🛠️ (Option A) Installation with docker compose

1. docker compose build
2. docker compose up -d
3. docker exec -it application bash
4. composer install


## 🛠️ (Option B) Installation with makefile for linux or WSL

Step one (optional): If you don't have instaled the package "make" for linux  , instal "make software" in linux or subsistem wsl for windows.

1. sudo apt-get update
2. sudo apt-get -y install make

Step 2: Commands

1. make start
2. make composer-install

If you want to see the available options for make tool type "make help"


## .env
copy .env.example renamed to .env.local

### ✅ Test Excecution

Url: http://localhost:1000/hello-world

##Database
MySql Access:
- Url: http://localhost:1010
- Server: mysql
- User: user
- Password: password

## How you will deliver your project?

You can do it in two different ways.

1.- Pull request to the repository

2.- Send it by email in Zip


## Good luck!