#!/bin/bash

docker compose start && sleep 6 && docker exec -it curso_CC-app npm run watch-poll

