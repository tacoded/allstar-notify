# Installation on node
- install **notify.sh** on your node machine (modify for your web server location)
- locate **rpt.conf** node stanza for node you want notified about
- set **connpgm=/path-to-script/notify.sh 1**
- set **discpgm=/path-to-script/notify.sh 0**

# PHP Script Installation
- place **notify.php** and **astdb.txt** on your webserver with php enabled. **notify.sh** should point here
- modify webhook url as needed
