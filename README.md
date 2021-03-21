# Pusher Middleware

A super simple app which acts as a middleware to push message to Pusher.

## Docker
The supplied docker compose setup will run the app with ssl on port 8282 by default.  SSL certs named "default" need to be placed in `docker/nginx/ssl`.  These can generated using a commaind like...

```
openssl req -newkey rsa:2048 -nodes -keyout default.key -x509 -days 365 -out default.crt
```

## Example Request
```
https://middelware-url:8282/{pusher_key}/{pusher_channel}/{pusher_event}/{pusher_message}
```

Message should be json encoded and then base64 encoded.

## Use Case
An example use is to give MotionEye motion detection a URL that can be used to as a webhook to a message which can be consumed by clients.
