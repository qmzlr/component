<?php

namespace App;

use Aura\SqlQuery\QueryFactory;
use PDO;

class QueryBuilder
{
    private PDO $pdo;
    private QueryFactory $queryFactory;

    public function __construct(PDO $pdo, QueryFactory $queryFactory)
    {
        $this->pdo = $pdo;
        $this->queryFactory = $queryFactory;
    }

    public function getAll($table): array|false
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])
            ->from($table);
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($table, $data): void
    {
        $insert = $this->queryFactory->newInsert()
            ->into($table)
            ->cols($data);
        $sth = $this->pdo->prepare($insert->getStatement());
        -d($insert->getBindValues());
        $sth->execute($insert->getBindValues());
    }

    public function update($table, $data, $where): void
    {
        $update = $this->queryFactory->newUpdate()
            ->table($table)
            ->cols($data)
            ->where('id = :id', ['id' => $where]);
        $sth = $this->pdo->prepare($update->getStatement());
        $sth->execute($update->getBindValues());
    }

    public function delete($table, $where): void
    {
        $delete = $this->queryFactory->newDelete()
            ->from($table)
            ->where('id = :id', ['id' => $where]);
        $sth = $this->pdo->prepare($delete->getStatement());
        $sth->execute($delete->getBindValues());
    }

    public function getOne(string $table, int $id)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])
            ->from($table)
            ->where('id = :id', ['id' => $id]);
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        return $sth->fetch(PDO::FETCH_ASSOC);
    }
}