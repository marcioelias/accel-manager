<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColumnsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Truncating columns table');
        $this->truncateColumnsTable();        

        DB::table('columns')->insert([
            [
                'column' => 'netns',
                'label' => 'Namespace',
                'visible' => false,
                'type' => 'text'
            ],
            [
                'column' => 'ifname',
                'label' => 'Interface',
                'visible' => true,
                'type' => 'text'
            ],
            [
                'column' => 'username',
                'label' => 'User',
                'visible' => true,
                'type' => 'text'
            ],
            [
                'column' => 'ip',
                'label' => 'IPv4',
                'visible' => true,
                'type' => 'ipv4'
            ],
            [
                'column' => 'ip6',
                'label' => 'IPv6',
                'visible' => false,
                'type' => 'text'
            ],
            [
                'column' => 'ip6-dp',
                'label' => 'IPv6-PD',
                'visible' => false,
                'type' => 'text'
            ],
            [
                'column' => 'type',
                'label' => 'Type',
                'visible' => false,
                'type' => 'text'
            ],
            [
                'column' => 'rate-limit',
                'label' => 'Rate Limit',
                'visible' => true,
                'type' => 'text'
            ],
            [
                'column' => 'state',
                'label' => 'State',
                'visible' => true,
                'type' => 'text'
            ],
            [
                'column' => 'uptime',
                'label' => 'Uptime',
                'visible' => true,
                'type' => 'number'
            ],
            [
                'column' => 'uptime-raw',
                'label' => 'Uptime Raw',
                'visible' => false,
                'type' => 'number'
            ],
            [
                'column' => 'calling-sid',
                'label' => 'Calling SID',
                'visible' => false,
                'type' => 'text'
            ],
            [
                'column' => 'called-sid',
                'label' => 'Called SID',
                'visible' => false,
                'type' => 'text'
            ],
            [
                'column' => 'sid',
                'label' => 'SID',
                'visible' => false,
                'type' => 'text'
            ],
            [
                'column' => 'comp',
                'label' => 'Compactation',
                'visible' => false,
                'type' => 'text'
            ],
            [
                'column' => 'rx-bytes',
                'label' => 'RX Bytes',
                'visible' => true,
                'type' => 'number'
            ],
            [
                'column' => 'tx-bytes',
                'label' => 'TX Bytes',
                'visible' => true,
                'type' => 'number'
            ],
            [
                'column' => 'rx-bytes-raw',
                'label' => 'RX Bytes Raw',
                'visible' => false,
                'type' => 'number'
            ],
            [
                'column' => 'tx-bytes-raw',
                'label' => 'TX Bytes Raw',
                'visible' => false,
                'type' => 'number'
            ],
            [
                'column' => 'rx-pkts',
                'label' => 'RX Packets',
                'visible' => true,
                'type' => 'number'
            ],
            [
                'column' => 'tx-pkts',
                'label' => 'TX Packets',
                'visible' => true,
                'type' => 'number'
            ],
        ]);
    }

    /**
     * Truncates the column table
     *
     * @return    void
     */
    public function truncateColumnsTable()
    {
        DB::table('columns')->truncate();
    }
}
