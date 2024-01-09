<?php

class DB
{
    private $dbHost;
    private $dbName;
    private $dbUser;
    private $dbPass;

    /**
     * DBリソースのセッター
     *
     * @param string $dbHost
     * @param string $dbName
     * @param string $dbUser
     * @param string $dbPass
     */
    public function __construct(
        string $dbHost,
        string $dbName,
        string $dbUser,
        string $dbPass
    ) {
        $this->dbHost = $dbHost;
        $this->dbName = $dbName;
        $this->dbUser = $dbUser;
        $this->dbPass = $dbPass;
    }

    /**
     * PDOインスタンスを返すDB接続
     *
     * @return object
     */
    public function dbConnect(): object
    {
        return new PDO(
            'mysql:host=' . $this->dbHost . '; dbname=' . $this->dbName . '; charset=utf8',
            $this->dbUser,
            $this->dbPass,
            [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
    }
}
