Background:
I've made a summary of how to install and getting ghost++ up and running on a raspberry pi debian stretch. I've installed it on Ubuntu 16.04 too, but I didn't keep track of every library I tried then.

Overview:
1. Installing dependencies and compiling the three main parts.
2. Configuring mysql/mariadb database
3. Create a folder with the executable and directories
4. Configuring ghost.cfg and default.cfg
5. Port forwarding
6. Cronscript example

Installation:
bncsutil specific:
apt-get install libgmp3-dev
bncsutil/src/bncsutil/
make
make install
Lots of warnings, but works.

stormlib specific:
apt-get install libbz2-dev
Stormlib/stormlib/
make
make install

ent-ghost:
apt-get install libboost-all-dev
apt-get install libgeoip-dev
apt-get install mysql-server mysql-client (may be unneeded, the one below installs mariadb and some compilation stuff)
apt-get install default-libmysqlclient-dev
ent-ghost/
make

Fix mysql/mariadb to have:
	a database
	a user, with grant all privileges on the database
	get the portnumber by: show variables like "%port%";

Configure ghost.cfg and default.cfg
ghost.cfg has higher priority, and therefore settings made in ghost.cfg doesn't need to be set in default.cfg.

Create a folder structure: 
~/ghost++/
	maps/
		echoisles.w3x
	mapcfgs/
		blizzard.j (Can both be extracted from war3x.mpq)
		common.j
		echoisles.cfg
	replays/
	savedgames/
	war3.exe (rename the Warcraft III.exe to war3.exe)
	Storm.dll
	game.dll
	ghost++ (executable that was compiled in ent-ghost folder)
	ghost.cfg
	default.cfg
	some more things..

I may create a cp command.

You can test if the bot can login to battle.net. For others to join the game port forwarding needs to be configured.

Cronscript example to be added.

