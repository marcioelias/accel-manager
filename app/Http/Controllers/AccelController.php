<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccelController extends Controller
{

    const CRLF = "\r\n";
    const RO = "r";
    const EMPTY = "";

    const ACCEL_SESSIONS_COLUMNS = 'netns,ifname,username,ip,ip6,ip6-dp,type,rate-limit,state,uptime,uptime-raw,calling-sid,called-sid,sid,comp,rx-bytes,tx-bytes,rx-bytes-raw,tx-bytes-raw,rx-pkts,tx-pkts';

    const ACCEL_CMD = 'accel-cmd ';
    const ACCEL_CMD_SHOW_SESSIONS = 'show sessions ';
    const ACCEL_CMD_TERMINATE_IF = 'terminate if ';
    const ACCEL_TERMINATE_SOFT = ' soft';
    const ACCEL_TERMINATE_HARD = ' hard';
    const ACCEL_CHANGE_QUEUE = 'shaper change ';
    const ACCEL_CHANGE_QUEUE_TEMP = ' temp';
    const ACCEL_RESTORE_QUEUE = 'shaper restore ';

    /**
     * run a command on shell
     *
     *
     * @param Stirng $cmd Command to execute
     * @return Array
     **/
     
    private function sysExec(String $cmd) {       
        $res = self::EMPTY;
        $handle = popen($cmd, self::RO);
        if ($handle) {
            while (!feof($handle)) {
                $res .= fread($handle, 1024);
            }
            pclose($handle);
        }        
        return array_filter(explode(PHP_EOL, $res));
    }

    /**
     * Undocumented function
     *
     * @param String $cmd
     * @return void
     */
    private function sysExecDbg(String $cmd) {       
        $res = self::EMPTY;
        $handle = popen($cmd, self::RO);
        if ($handle) {
            while (!feof($handle)) {
                $res .= fread($handle, 1024);
            }
            pclose($handle);
        }        
        $res = 'netns | ifname | username |      ip       | ip6 | ip6-dp | type  | state  |   uptime   | uptime-raw |    calling-sid    |  called-sid   |        sid       | comp | rx-bytes | tx-bytes | rx-bytes-raw | tx-bytes-raw | rx-pkts | tx-pkts 
        -------+--------+----------+---------------+-----+--------+-------+--------+------------+------------+-------------------+---------------+------------------+------+----------+----------+--------------+--------------+---------+---------
         def   | pppoe0 | teste1    | 200.53.15.207 |     |        | pppoe | active | 1.10:44:28 | 125068     | FC:A6:CD:08:1B:DB | enp65s0f1.222 | 858759A1C08165D9 |      | 6.6 GiB  | 6.1 GiB  | 7103172231   | 6590431781   | 6301545 | 6324990
         def   | pppoe1 | teste2    | 200.53.15.208 |     |        | pppoe | active | 1.10:44:28 | 125068     | FC:A6:CD:08:1B:DB | enp65s0f1.222 | 858759A1C08165D9 |      | 6.6 GiB  | 6.1 GiB  | 7103172231   | 6590431781   | 6301545 | 6324990
         def   | pppoe2 | teste3    | 200.53.15.209 |     |        | pppoe | active | 1.10:44:28 | 125068     | FC:A6:CD:08:1B:DB | enp65s0f1.222 | 858759A1C08165D9 |      | 6.6 GiB  | 6.1 GiB  | 7103172231   | 6590431781   | 6301545 | 6324990
         def   | pppoe3 | teste4    | 200.53.15.210 |     |        | pppoe | active | 1.10:44:28 | 125068     | FC:A6:CD:08:1B:DB | enp65s0f1.222 | 858759A1C08165D9 |      | 6.6 GiB  | 6.1 GiB  | 7103172231   | 6590431781   | 6301545 | 6324990
         def   | pppoe4 | teste5    | 200.53.15.211 |     |        | pppoe | active | 1.10:44:28 | 125068     | FC:A6:CD:08:1B:DB | enp65s0f1.222 | 858759A1C08165D9 |      | 6.6 GiB  | 6.1 GiB  | 7103172231   | 6590431781   | 6301545 | 6324990
         def   | pppoe5 | teste6    | 200.53.15.212 |     |        | pppoe | active | 1.10:44:28 | 125068     | FC:A6:CD:08:1B:DB | enp65s0f1.222 | 858759A1C08165D9 |      | 6.6 GiB  | 6.1 GiB  | 7103172231   | 6590431781   | 6301545 | 6324990
         def   | pppoe6 | teste7    | 200.53.15.213 |     |        | pppoe | active | 1.10:44:28 | 125068     | FC:A6:CD:08:1B:DB | enp65s0f1.222 | 858759A1C08165D9 |      | 6.6 GiB  | 6.1 GiB  | 7103172231   | 6590431781   | 6301545 | 6324990
         def   | pppoe7 | teste8    | 200.53.15.214 |     |        | pppoe | active | 1.10:44:28 | 125068     | FC:A6:CD:08:1B:DB | enp65s0f1.222 | 858759A1C08165D9 |      | 6.6 GiB  | 6.1 GiB  | 7103172231   | 6590431781   | 6301545 | 6324990
         def   | pppoe8 | teste9    | 200.53.15.215 |     |        | pppoe | active | 1.10:44:28 | 125068     | FC:A6:CD:08:1B:DB | enp65s0f1.222 | 858759A1C08165D9 |      | 6.6 GiB  | 6.1 GiB  | 7103172231   | 6590431781   | 6301545 | 6324990
         def   | pppoe9 | teste10    | 200.53.15.216 |     |        | pppoe | active | 1.10:44:28 | 125068     | FC:A6:CD:08:1B:DB | enp65s0f1.222 | 858759A1C08165D9 |      | 6.6 GiB  | 6.1 GiB  | 7103172231   | 6590431781   | 6301545 | 6324990
         def   | pppoe10 | teste11    | 200.53.15.217 |     |        | pppoe | active | 1.10:44:28 | 125068     | FC:A6:CD:08:1B:DB | enp65s0f1.222 | 858759A1C08165D9 |      | 6.6 GiB  | 6.1 GiB  | 7103172231   | 6590431781   | 6301545 | 6324990
         def   | pppoe11 | teste12    | 200.53.15.218 |     |        | pppoe | active | 1.10:44:28 | 125068     | FC:A6:CD:08:1B:DB | enp65s0f1.222 | 858759A1C08165D9 |      | 6.6 GiB  | 6.1 GiB  | 7103172231   | 6590431781   | 6301545 | 6324990
         def   | pppoe12 | teste13    | 200.53.15.219 |     |        | pppoe | active | 1.10:44:28 | 125068     | FC:A6:CD:08:1B:DB | enp65s0f1.222 | 858759A1C08165D9 |      | 6.6 GiB  | 6.1 GiB  | 7103172231   | 6590431781   | 6301545 | 6324990
         def   | pppoe13 | teste14    | 200.53.15.220 |     |        | pppoe | active | 1.10:44:28 | 125068     | FC:A6:CD:08:1B:DB | enp65s0f1.222 | 858759A1C08165D9 |      | 6.6 GiB  | 6.1 GiB  | 7103172231   | 6590431781   | 6301545 | 6324990
         def   | pppoe14 | teste15    | 200.53.15.221 |     |        | pppoe | active | 1.10:44:28 | 125068     | FC:A6:CD:08:1B:DB | enp65s0f1.222 | 858759A1C08165D9 |      | 6.6 GiB  | 6.1 GiB  | 7103172231   | 6590431781   | 6301545 | 6324990
         def   | pppoe15 | teste16    | 200.53.15.222 |     |        | pppoe | active | 1.10:44:28 | 125068     | FC:A6:CD:08:1B:DB | enp65s0f1.222 | 858759A1C08165D9 |      | 6.6 GiB  | 6.1 GiB  | 7103172231   | 6590431781   | 6301545 | 6324990
         def   | pppoe16 | teste17    | 200.53.15.223 |     |        | pppoe | active | 1.10:44:28 | 125068     | FC:A6:CD:08:1B:DB | enp65s0f1.222 | 858759A1C08165D9 |      | 6.6 GiB  | 6.1 GiB  | 7103172231   | 6590431781   | 6301545 | 6324990
         def   | pppoe17 | teste18    | 200.53.15.224 |     |        | pppoe | active | 1.10:44:28 | 125068     | FC:A6:CD:08:1B:DB | enp65s0f1.222 | 858759A1C08165D9 |      | 6.6 GiB  | 6.1 GiB  | 7103172231   | 6590431781   | 6301545 | 6324990
         def   | pppoe18 | teste19    | 200.53.15.225 |     |        | pppoe | active | 1.10:44:28 | 125068     | FC:A6:CD:08:1B:DB | enp65s0f1.222 | 858759A1C08165D9 |      | 6.6 GiB  | 6.1 GiB  | 7103172231   | 6590431781   | 6301545 | 6324990
         def   | pppoe19 | teste20    | 200.53.15.226 |     |        | pppoe | active | 1.10:44:28 | 125068     | FC:A6:CD:08:1B:DB | enp65s0f1.222 | 858759A1C08165D9 |      | 6.6 GiB  | 6.1 GiB  | 7103172231   | 6590431781   | 6301545 | 6324990';
        return array_filter(explode(PHP_EOL, $res));
    }

    /**
     * Get PPPoE Sessions from Accel-PPP
     *
     * @return Array
     */
    public function getSessions() {
        $cmd = self::ACCEL_CMD.self::ACCEL_CMD_SHOW_SESSIONS.self::ACCEL_SESSIONS_COLUMNS;
        if (env('APP_DEBUG') == false) {
            return $this->sysExec($cmd);
        } else {
            return $this->sysExecDbg($cmd);
        }
    }


    /**
     * Get PPPoE Sessions from Accel-PPP
     * and return a Json object
     *
     * @return String
     */
    public function getSessionsJson() {
        $res = [];
        $sessions = $this->getSessions();
        $columns = array_map('trim', explode('|', $sessions[0]));
        for ($i = 2; $i <= count($sessions) - 1; $i++) {
            $session = explode('|', $sessions[$i]);
            foreach ($columns as $key => $column) {
                $res[$i-2][$column] = trim($session[$key]);
            }
        }

        return response()->json($res);
    }

    /**
     * Get stats of the given interface and return as a 
     * json object
     *
     * @param String $ifname
     * @return String 
     */
    public function getInterfaceStats(String $ifname) {
        if (Auth::user()->canAcessarViewGraph()) {
            $timezone = -3;
            $arr{'stamp'} = (time()+($timezone*3600))*1000;
            $arr{'rxbytes'} = intval($this->sysExec("cat /sys/class/net/".escapeshellcmd(trim($ifname))."/statistics/rx_bytes")[0]);
            $arr{'txbytes'} = intval($this->sysExec("cat /sys/class/net/".escapeshellcmd(trim($ifname))."/statistics/tx_bytes")[0]);
            $arr{'rxpackets'} = intval($this->sysExec("cat /sys/class/net/".escapeshellcmd(trim($ifname))."/statistics/rx_packets")[0]);
            $arr{'txpackets'} = intval($this->sysExec("cat /sys/class/net/".escapeshellcmd(trim($ifname))."/statistics/tx_packets")[0]);
            return response()->json($arr);
        } else {
            return response()->json($this->getHttp403());
        }
    }

    /**
     * Drop a PPPoE Session
     *
     * @param Request $request
     * @return void
     */
    public function dropSession(Request $request) {
        if (Auth::user()->canAcessarDropPppoe()) {
            $cmd = self::ACCEL_CMD.self::ACCEL_CMD_TERMINATE_IF.$request->ifname.' hard';
            try {
                $this->sysExec($cmd);
                return response()->json(true);
            } catch (\Exception $e) {
                return response()->json($e);
            }
        } else {
            return response()->json($this->getHttp403());
        }
    }

    /**
     * Change the rate-limit parameter values
     *
     * @param Request $request
     * @return void
     */
    public function changeQueue(Request $request) {    
        if (Auth::user()->canAcessarChangeRateLimit()) {    
            $queue = $request->rx.'M/'.$request->tx.'M';
            $cmd = self::ACCEL_CMD.self::ACCEL_CHANGE_QUEUE.$request->ifname.' '.$queue.self::ACCEL_CHANGE_QUEUE_TEMP;
            try {
                $this->sysExec($cmd);
                return response()->json(true);
            } catch (\Exception $e) {
                return response()->json($e);
            }
        } else {
            return response()->json($this->getHttp403());
        }
    }

    /**
     * Reset the rate-limit values to the default 
     *
     * @param Request $request
     * @return void
     */
    public function resetQueue(Request $request) {
        if (Auth::user()->canAcessarChangeRateLimit()) {    
            $cmd = self::ACCEL_CMD.self::ACCEL_RESTORE_QUEUE.$request->ifname;
            try {
                $this->sysExec($cmd);
                return response()->json(true);
            } catch (\Exception $e) {
                return response()->json($e);
            }
        } else {
            return response()->json($this->getHttp403());
        }
    }

    /**
     * return an HTTP access denied code
     *
     * @return void
     */
    private function getHttp403() {
        return ['error' => '403', 'response' => 'Access denied'];
    }

}
