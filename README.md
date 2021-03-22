# Pusher Middleware

A super simple app which acts as a middleware to push message to Pusher.

## Docker
By default the supplied docker compose setup will run the app on port 8282.

You can use SSL by creating certs named "default" in `docker/nginx/ssl`.  These can generated using a commaind like...

```
openssl req -newkey rsa:2048 -nodes -keyout docker/nginx/ssl/default.key -x509 -days 365 -out docker/nginx/ssl/default.crt
```

The nginx `app.conf` file needs to be updated to use SSL and the `docker-compose.yml` may need to be updated to use a different point depending on the setup.

## Example Request
```
https://middelware-url:8282/{pusher_key}/{pusher_channel}/{pusher_event}/{pusher_message}
```

Message should be json encoded and then base64 encoded.

## Use Case
An example use is to give MotionEye motion detection a URL that can be used to as a webhook to a message which can be consumed by clients.
