# Pusher Middleware

A super simple app which acts as a middleware to push message to Pusher.

## Example Request
```
https://middelware-url/{pusher_key}/{pusher_channel}/{pusher_event}/{pusher_message}
```

Message should be json encoded and then base64 encoded.

## Use Case
An example use is to give MotionEye motion detection a URL that can be used to as a webhook to a message which can be consumed by clients.
