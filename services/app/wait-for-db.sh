#!/bin/sh
# wait-for-db.sh

#set -e

#shift
cmd="$1"

until mysql -h $DB_HOST -u $DB_USERNAME -p$DB_PASSWORD -D $DB_DATABASE -e '\q'; do
  >&2 echo "db is unavailable - sleeping"
  sleep 5
done

>&2 echo "db is up - executing command"
exec $cmd
