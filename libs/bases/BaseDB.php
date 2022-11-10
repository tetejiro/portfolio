<?php
abstract class BaseDB
{
    private $dbh = null;
    public function connect(): bool
    {
        try
        {
            $this->dbh = new PDO($this->getConnectionString(), $this->getId(), $this->getPassword());
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return true;
        }
        catch (Exception $e)
        {
            print 'データベース接続失敗です。'.$e->getMessage();
            return false;
        }
    }
    public function select(string $sql, array $params)
    {
        $stmt = $this->dbh->prepare($sql, $params);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function disconnect(): void
    {
        $this->dbh = null;
    }
    abstract protected function getConnectionString(): string;
    abstract protected function getId(): string;
    abstract protected function getPassword(): string;
}
