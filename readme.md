**Experimental for 1.29.**

24 player support untested. 
Check commit history if you're looking for how to make your own bot 1.29 compatible.

If you want to host on 1.28 or earlier versions, change to branch: ver28_sg

**Background:**

I've made a summary of how to install and getting ghost++ up and running on a raspberry pi. I've installed it on Ubuntu 16.04 too, but I didn't keep track of every dependency I tried then.

**Overview:**
1. Installing dependencies and compiling the three main parts.
2. Configuring mysql/mariadb database
3. Create a folder with the executable and directories
4. Configuring ghost.cfg and default.cfg
5. Test the bot
6. Cronscript example


**Installation:**

**bncsutil specific:**
```console
apt-get install libgmp3-dev
cd bncsutil/src/bncsutil/
make
make install
```
Lots of warnings, but works.

**stormlib specific:**

```console
apt-get install libbz2-dev
cd Stormlib/stormlib/
make
make install
```

**ent-ghost:**

```console
apt-get install libboost-all-dev
apt-get install libgeoip-dev
apt-get install mysql-server mysql-client
apt-get install default-libmysqlclient-dev
cd ent-ghost/
make
```

**Fix mysql/mariadb:**
```console
create database ghostdb;
create user 'username'@'localhost' identified by 'password';
grant all privileges on ghostdb.* to 'username'@'localhost';

show variables like "%port%";  (port for default.cfg later)
```

Creating all the tables from a sql file:
```console
mysql -u username -p ghostdb < install.sql  (the sql file in ent-ghost/)
```

**Create a folder structure:** 
```console
~/ghost++/
	maps/
		echoisles.w3x
	mapcfgs/
		blizzard.j
		common.j
		echoisles.cfg
		wormwar.cfg	(example cfg file)
	replays/
	savegames/
	war3.exe (rename the Warcraft III.exe to war3.exe)
	Storm.dll (unused for 1.29)
	game.dll  (unused for 1.29)
	ghost++ (executable that was compiled in ent-ghost/ folder)
	
	ghost.cfg
	default.cfg
	language.cfg
	gameloaded.txt
	gameover.txt
	ipblacklist.txt
	ip-to-country.csv
	motd.txt
```
Both .j files be extracted from war3x.mpq/scripts via [ladiks-mpq-editor](https://www.hiveworkshop.com/threads/ladiks-mpq-editor-32bit.249562/)

**Configure ghost.cfg and default.cfg:**

ghost.cfg has higher priority, and therefore settings made in ghost.cfg doesn't need to be set in default.cfg.

Test if the bot can login to battle.net. For others to join a game port forwarding needs to be configured.

**Cronscript to update the mysql database:**

This needs php dependencies (yet to be included here).

Cronscript example will run testcron.php every 10 mins, which uses cronfunctions.php in the ent-ghost/ folder.
```console
crontab -e
*/10 * * * * php ~/Downloads/ghost-ent-bt/ent-ghost/testcron.php
```

**Licences**

[ent-ghost](https://github.com/uakfdotb/ent-ghost) : GNU GPL v3.

[ghost++](https://github.com/uakfdotb/ghostpp): Apache License, Version 2.0

There are some other notable licences under stormlib, bncsutil etc.

I have included the libraries here in order to make the building easier.

