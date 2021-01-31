#! /bin/bash
SYMBOL=$1
( cd /var/www/edickdev/cgi-bin/py/ && python3 img_test.py -s $SYMBOL)
