<?php
date_default_timezone_set("Asia/Taipei");
session_start();
class DB
{
    protected $dsn = "mysql:host=localhost;charset=utf8;dbname=db22";
    protected $pdo;
    protected $table;

    public function __construct($table)
    {
        $this->table = $table;
        $this->pdo = new PDO($this->dsn, 'root', '');
    }

    protected function a2s($array)
    {
        foreach ($array as $key => $value) {
            if ($key != 'id') {
                $tmp[] = "`$key`='$value'";
            }
        }
        return $tmp;
    }

    private function sql_all($sql, $array, $other)
    {
        // 如果有設定資料表且不為空
        if (isset($this->table) && !empty($this->table)) {
            // 如果參數是陣列
            if (is_array($array)) {
                // 而且陣列不為空
                if (!empty($array)) {
                    $tmp = $this->a2s($array);
                    $sql .= " where " . join(" && ", $tmp);
                }
            } else {
                $sql .= " $array";
            }
            $sql .= $other;
            return $sql;
        }
    }

    protected function math($math, $col, $array = '', $other = '')
    {
        $sql = "select $math($col) from $this->table";
        $sql = $this->sql_all($sql, $array, $other);

        return $this->pdo->query($sql)->fetchColumn();
    }

    function sum($col, $where = '', $other = '')
    {
        return $this->math('sum', $col, $where, $other);
    }

    function max($col, $where = '', $other = '')
    {
        return $this->math('max', $col, $where, $other);
    }

    function min($col, $where = '', $other = '')
    {
        return $this->math('min', $col, $where, $other);
    }

    function count($where = '', $other = '')
    {
        $sql = "select count(*) from `$this->table`";
        $sql = $this->sql_all($sql, $where, $other);
        return $this->pdo->query($sql)->fetchColumn();
    }

    function all($where = '', $other = '')
    {
        $sql = "select * from $this->table ";
        $sql = $this->sql_all($sql, $where, $other);
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function find($id)
    {
        $sql = "select * from $this->table";
        if (is_array($id)) {
            $tmp = $this->a2s($id);
            $sql .= " where " . join(" && ", $tmp);
        } else if (is_numeric($id)) {
            $sql .= " where `id`='$id'";
        }
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }


    function del($id){
        $sql = "delete from $this->table";

        if(is_array($id)){
            $tmp= $this->a2s($id);
            $sql .= " where " .join (" && ", $tmp);
        }else if (is_numeric($id)){
            $sql .= " where `id`='$id'";
        }
        // 將sql句子帶進pdo的exec方法中
        return $this->pdo->exec($sql);
    }

    function save($array){
        // 如果有id代表是更新
        if(isset($array['id'])){
            $sql = "update `$this->table` set ";
            if(!empty($array)){
                $tmp=$this->a2s($array);
            }
            $sql.=join(",",$tmp);
            $sql.=" where `id`={$array['id']}";
        }else{
            $sql="(`".join("`,`", array_keys($array)) . "`)";
            $val ="('".join("','", $array). "')";
        }
        return $this->pdo->exec($sql);
    }

    public function q($sql){
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
// class DB 結束

function to($url){
    header("location:" .$url);
}

function dd($array){
    echo "<pre>";
print_r($array);
    echo "<pre>";
}

?>
