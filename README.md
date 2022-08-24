## Environment Setup

###  🐳 Needed tools

1. [Install Docker](https://www.docker.com/get-started)
2. Clone this project: `git clone https://github.com/arnauFreightos/technical_backend_wcn.git`
3. Move to the project folder: `cd technical_backend_wcn`

## 🛠️ (Option A) Installation with makefile for linux or WSL

Step one (optional): If you don't have instaled the package "make" for linux  , instal "make software" in linux or subsistem wsl for windows.

1. sudo apt-get update
2. sudo apt-get -y install make

Step 2: Commands

1. make start
2. make composer-install

If you want to see the available options for make tool type "make help"

## 🛠️ (Option B) Installation with docker compose 

1. docker compose build --build-arg UID=1001 --no-cache
2. docker compose up -d
3. docker exec -it application bash
4. composer install


### ✅ Test Excecution

Url: http://localhost:1000/hello-word

##Database
MySql Access:
- Url: http://localhost:1010
- Server: mysql
- User: user
- Password: password

