<?php

/*
    This file is part of Freies Magazin email distribution software.

    Freies Magazin email distribution software is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Freies Magazin email distribution software is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Freies Magazin email distribution software.  If not, see <http://www.gnu.org/licenses/>
*/

define("LOGFILE", "/home/monochromec/httpdocs/fm/error.log");

function errLog($msg) {
    $func = debug_backtrace();
    error_log(sprintf("[%s] in %s: %s\n", date('Y-m-d H:i:s'), $func[1]['function'], $msg), 3, LOGFILE);
}

class DB extends SQLite3
{
    const defPerm = 0644;
    const NAME = 'adr.db';
    protected function createDB($dbN) {
        parent::__construct($dbN);
        errLog('In createDB');
        var_dump($dbN);
        parent::exec('DROP TABLE IF EXISTS adr');
        parent::exec('CREATE TABLE adr (date INTEGER, email VARCHAR(255), epub INTEGER, active INTEGER)');
    }
    public function __construct($db = self::NAME) {
        if (file_exists($db)) {
            errLog('file_exists');
            if (! is_readable($db) || ! is_writeable($db)) {
                unlink($db);
                errLog('unlink');
                $this->createDB($db);
            } else {
                parent::__construct($db);
            }
        } else {
            errLog('File doesn\'t exist');
            $this->createDB($db);
        }
// Change to default fiel permissions if not correct        
        $mod = fileperms($db);
        errLog(sprintf('File perms: 0%o', $mod & 0777));
        if ($mod & 0777 != self::defPerm) {
            chmod($db, self::defPerm);
        }
    }
    public function __destruct() {
        parent::close();
    }
    // If entry already present, just active to one
    public function insert($email, $epub) {
        if (! $this->check($email, 0)) {
            errLog(sprintf('Full insert: %s', $email));
            parent::exec(sprintf("INSERT INTO adr (date, email, epub, active) VALUES(%u, '%s', %u, 1)", time(), $email, $epub));
        } else {
            errLog(sprintf('Update: %s', $email));
            parent::exec(sprintf("UPDATE adr SET active=1, epub=%u WHERE email='%s'", $epub, $email));
        }            
    }
    public function delete($email) {
        errLog(sprintf('Delete email: %s', $email));
        parent::exec(sprintf("UPDATE adr SET active=0 WHERE email='%s'", $email));
    }
    public function check($email, $act = 1) {
        $quer = parent::query(sprintf("SELECT * FROM adr WHERE email='%s' AND active=%u", $email, $act));
        $num = $this->numRows($quer);
        errLog(sprintf('checkNum: %d', $num));
        return $num > 0;
    }
    public function numRows($result) {
        $nrows = 0;
        $result->reset();
        while ($result->fetchArray())
            $nrows++;
        $result->reset();
        return $nrows;
    }
}
