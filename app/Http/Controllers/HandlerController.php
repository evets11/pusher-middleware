<?php

namespace App\Http\Controllers;

use Pusher\Pusher;

class HandlerController extends Controller
{
    public function handle($key, $channel, $event, $data)
    {
        try {
            $data = base64_decode($data);
            $data = json_decode($data, true);

            $this->handlePushover($data);
            $this->handlePusher($key, $channel, $event, $data);

            return response()->json(['message' => 'Success']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    protected function handlePushover(array $data)
    {
        $data['token'] = config('pushover.app_token');
        $data['user'] = config('pushover.user_key');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.pushover.net/1/messages.json');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);
    }

    protected function handlePusher($key, $channel, $event, array $data)
    {
        $pusher = new Pusher(
            $key,
            config('pusher.secret'),
            config('pusher.id'),
            [
                'cluster' => config('pusher.cluster'),
                'useTLS' => true
            ]
        );

        $pusher->trigger($channel, $event, $data);
    }
}
