<?php
/**
 * Created by PhpStorm.
 * User: smile
 * Date: 2/22/16
 * Time: 2:01 AM
 */
namespace app\commands;

use yii\console\Controller;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use app\components\SocketServer;

class SocketController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */

    public function actionIndex()
    {
        // TODO develop not enough
//        $server = IoServer::factory(
//            new SocketServer(),
//            35001
//        );
//
//        $server->run();

        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new SocketServer()
                )
            ),
            35001
        );
        $server->run();
    }
}